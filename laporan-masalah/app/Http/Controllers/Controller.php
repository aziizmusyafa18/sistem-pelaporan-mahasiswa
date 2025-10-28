<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Laporan::with('mahasiswa')->latest();
        if ($request->filled('status') && in_array($request->status, ['baru','diproses','selesai'])) {
            $query->where('status', $request->status);
        }
        $laporans = $query->paginate(10)->withQueryString();
        return view('laporan.index', compact('laporans'));
    }
}
