<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        return redirect()->route('users.admin');
    }

    public function indexAdmin()
    {
        $users = User::where('role', 'admin')->get();
        return view('admin.users_admin.index', compact('users'));
    }

    public function indexStaff()
    {
        $users = User::where('role', 'staff')->get();
        return view('admin.users_staff.index', compact('users'));
    }
    
    public function reset($id) 
    {
        $user = User::findOrFail($id);
        $newPass = substr($user->email, 0, 4) . $user->id;

        $user->update(['password' => Hash::make($newPass)]);

        return back()->with('success', "Password baru: " . $newPass);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users_admin.create');
    }

        // Fungsi untuk nampilin form Add Admin
    public function createAdmin() 
    {
        return view('admin.user_admin.create'); // Manggil file di folder user_admin
    }

    // Fungsi untuk nampilin form Add Staff
    public function createStaff() 
    {
        return view('admin.user_staff.create'); // Manggil file di folder user_staff
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|max:255',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt('rahasia'); // Isi asal dulu
        $user->save(); // Save agar dapat ID asli

        $passText = substr($user->email, 0, 4) . $user->id; // Ambil ID asli
        $user->update(['password' => bcrypt($passText)]); // Update password yang bener

        // Balik ke halaman sesuai rolenya
        $route = ($user->role == 'admin') ? 'users.admin' : 'users.staff';
        return redirect()->route($route)->with('success', "User Berhasil Ditambah! Password: " . $passText);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users_admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Jika input password diisi, maka ubah. Jika kosong, biarkan yang lama.
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        
        $route = ($user->role == 'admin') ? 'users.admin' : 'users.staff';
        return redirect()->route($route)->with('success', "Data berhasil diupdate!");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editStaff(string $id)
    {
        $user = User::findOrFail($id);
        return view('staff.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStaff(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Jika input password diisi, maka ubah. Jika kosong, biarkan yang lama.
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        
        return redirect()->route('staff.users.index')->with('success', "Data berhasil diupdate!");
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
