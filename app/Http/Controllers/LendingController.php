<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lending;
use App\Models\LendingDetail;
use App\Models\Item;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lendings = Lending::with('lendingDetails.item')->get();
        return view('staff.lendings.index', compact('lendings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        return view('staff.lendings.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'item_id' => 'required|array',
            'quantity' => 'required|array',
        ]);

        // --- TAHAP 1: CEK SEMUA STOK DULU ---
        foreach ($request->item_id as $key => $id) {
            $item = Item::find($id);
            $qty = $request->quantity[$key];

            if ($item && $qty > $item->total_stock) {
                // Kalau ada satu saja yang kurang, LANGSUNG GAGALKAN
                return redirect()->back()->withInput()->with('error', "Stok {$item->name} tidak cukup! (Sisa: {$item->total_stock})");
            }
        }

        // --- TAHAP 2: KALAU LOLOS SEMUA, BARU SIMPAN ---

        // 1. Simpan Header
        $lending = Lending::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'lend_date' => now(),
            'status' => 'borrowed'
        ]);

        // 2. Simpan Detail & Update Stok
        foreach ($request->item_id as $key => $id) {
            $qty = $request->quantity[$key];

            LendingDetail::create([
                'lending_id' => $lending->id,
                'item_id' => $id,
                'quantity' => $qty,
            ]);

            $item = Item::find($id);
            $item->total_stock -= (int) $qty;
            $item->save();
        }

        return redirect()->route('lendings.index')->with('success', 'Peminjaman berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($item_id)
    {
        $item = Item::findOrFail($item_id);

        // Ambil semua detail peminjaman untuk item ini yang belum dikembalikan
        $details = LendingDetail::with('lending')
            ->where('item_id', $item_id)
            ->whereHas('lending', function ($q) {
                $q->where('status', 'borrowed');
            })->get();

        return view('admin.items.detail', compact('item', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lending = Lending::with('lendingDetails.item')->findOrFail($id);

        $lending->update([
            'status' => 'returned',
            'return_date' => now(),
        ]);

        foreach ($lending->lendingDetails as $detail) {
            $item = Item::find($detail->item_id);
            if ($item) {
                $item->total_stock += $detail->quantity; // Stok kembali karena dikembalikan
                $item->save();
            }
        }

        return redirect()->route('lendings.index')->with('success', 'Peminjaman berhasil dikembalikan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // 1. Cari data Lending beserta detailnya
        $lending = Lending::with('LendingDetails')->findOrFail($id);

        // 2. KEMBALIKAN STOK: Looping semua barang yang ada di detail
        foreach ($lending->LendingDetails as $detail) {
            $item = Item::find($detail->item_id);

            if ($item) {
                // Tambahkan kembali stok yang tadi dipinjam
                $item->total_stock += $detail->quantity;

                // Jika kamu punya kolom lending_total, kurangi juga:
                // $item->total_lending -= $detail->quantity;

                $item->save();
            }
        }

        // 3. Hapus data (LendingDetail akan otomatis terhapus jika pakai cascade di DB)
        $lending->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus dan stok telah dikembalikan!');
    }
}
