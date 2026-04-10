@extends('dashboard')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-table me-2 text-green"></i> Tabel Items</h5>
                    <div class="d-flex justify-content-end gap-2 mb-3">
                        <a href="{{ route('export.item') }}" class="btn bg-green btn-sm px-3 shadow-sm text-white">
                            Export
                        </a>
                        <a href="{{ route('items.create') }}" class="btn bg-green btn-sm px-3 shadow-sm text-white">
                            <i class="fas fa-plus me-1"></i> Add
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Total</th>
                                    <th>Repair</th>
                                    <th>Lending</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $index => $item)
                                    <tr>
                                        <td>{{ $index . 1 }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->total_stock }}</td>
                                        <td>{{ $item->repair }}</td>
                                        <td>
                                            @php
                                                // 1. Ambil semua detail peminjaman untuk item ini
                                                // 2. Filter yang statusnya cuma 'borrowed'
                                                // 3. Jumlahkan (sum) kolom quantity
                                                $totalDipinjam = $item->lendingDetails
                                                    ->filter(function ($detail) {
                                                        return $detail->lending &&
                                                            $detail->lending->status == 'borrowed';
                                                    })
                                                    ->sum('quantity');
                                            @endphp

                                            @if ($totalDipinjam > 0)
                                                <a href="{{ route('items.detail', $item->id) }}" class="fw-bold text-primary">
                                                    {{ $totalDipinjam }}
                                                </a>
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('items.edit', $item->id) }}"
                                                class="btn btn-sm btn-info text-white">Edit</a>
                                            <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
