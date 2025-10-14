<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $dosens = \App\Models\Dosen::orderBy('nama')->paginate(10);
        return view('dosen.index', compact('dosens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required','string','max:100'],
            'nidn' => ['required','string','max:20','unique:dosens,nidn'],
            'email'=> ['required','email','max:100','unique:dosens,email'],
        ]);
        \App\Models\Dosen::create($validated);
        return redirect()->route('dosen.index')->with('success','Data dosen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Dosen $dosen)
    {
        return view('dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\Dosen $dosen)
    {
        $validated = $request->validate([
            'nama' => ['required','string','max:100'],
            'nidn' => ['required','string','max:20','unique:dosens,nidn,'.$dosen->id],
            'email'=> ['required','email','max:100','unique:dosens,email,'.$dosen->id],
        ]);
        $dosen->update($validated);
        return redirect()->route('dosen.index')->with('success','Data dosen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success','Data dosen berhasil dihapus.');
    }
}
