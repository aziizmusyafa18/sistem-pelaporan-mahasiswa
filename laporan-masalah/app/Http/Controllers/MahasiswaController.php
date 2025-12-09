<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $search = request()->input('search');

        $mahasiswas = \App\Models\Mahasiswa::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                             ->orWhere('nim', 'like', "%{$search}%");
            })
            ->orderBy('nama')
            ->paginate(10);

        return view('mahasiswa.index', compact('mahasiswas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required','string','max:100'],
            'nim'  => ['required','string','max:20','unique:mahasiswas,nim'],
            'email_prefix' => ['required','string','max:50'],
            'password' => ['required','string','min:8'],
        ]);

        $email = $validated['email_prefix'] . '@mahasiswa.com';

        $validator = Validator::make(['email' => $email], [
            'email' => ['unique:users,email'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('mahasiswa.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $validated['nama'],
            'email' => $email,
            'password' => Hash::make($validated['password']),
            'role' => 'mahasiswa',
        ]);

        $lastMahasiswa = Mahasiswa::orderBy('id', 'desc')->first();
        $nextIdNumber = 1;
        if ($lastMahasiswa) {
            $lastId = $lastMahasiswa->id;
            $lastIdNumber = (int) substr($lastId, 1);
            $nextIdNumber = $lastIdNumber + 1;
        }
        $newId = 'M' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);

        $mahasiswa = Mahasiswa::create([
            'id' => $newId,
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'email' => $email,
            'password' => $validated['password'],
            'user_id' => $user->id,
        ]);

        $user->mahasiswa_id = $mahasiswa->id;
        $user->save();

        return redirect()->route('mahasiswa.index')->with('success','Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Mahasiswa $mahasiswa)
{
    return view('mahasiswa.show', compact('mahasiswa'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => ['required','string','max:100'],
            'nim'  => ['required','string','max:20','unique:mahasiswas,nim,'.$mahasiswa->id],
            'email'=> ['required','email','max:100','unique:mahasiswas,email,'.$mahasiswa->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $updateData = [
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'email' => $validated['email'],
        ];

        if ($request->filled('password')) {
            $updateData['password'] = $validated['password'];
        }

        $mahasiswa->update($updateData);

        // Find the associated user and update their details
        if ($mahasiswa->user) {
            $user = $mahasiswa->user;
            $user->name = $validated['nama'];
            $user->email = $validated['email'];

            if ($request->filled('password')) {
                $user->password = Hash::make($validated['password']);
            }

            $user->save();
        }


        return redirect()->route('mahasiswa.index')->with('success','Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(\App\Models\Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success','Data mahasiswa berhasil dihapus.');
    }
}
