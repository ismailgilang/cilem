<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function create()
    {
        $data = User::all();
        return view('menu.user.index', compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name'           => 'required|string|max:255',
            'last_name'          => 'required|string|max:255',
            'nik'    => 'nullable|string',
            'email'    => 'required|string',  // sesuaikan rule jika perlu numeric atau format tertentu
            'username'          => 'required|string',
            'password'         => 'required|string',
            'role'       => 'required|string',
        ]);

        // Simpan ke database
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'nik' => $request->nik,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('user.create')->with('success', 'Data user berhasil disimpan.');
    }
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('menu.user.edit', compact('data'));
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'nik'        => 'required|string',
            'email'      => 'required|string',
            'username'   => 'required|string',
            'password'   => 'nullable|string', // ubah menjadi nullable
            'role'       => 'required|string',
        ]);

        $data = User::findOrFail($id);
        $input = $request->all();

        // Jika password kosong, jangan update field password
        if (empty($input['password'])) {
            unset($input['password']);
        } else {
            // Jika diisi, hash password-nya
            $input['password'] = Hash::make($input['password']);
        }

        $data->update($input);
        return redirect()->route('user.create')->with('success', 'Data User berhasil diupdate.');
    }

    public function destroy($id)
    {
        $cilem = User::findOrFail($id);
        $cilem->delete();

        return redirect()->route('user.create')->with('success', 'Data User berhasil dihapus.');
    }
}
