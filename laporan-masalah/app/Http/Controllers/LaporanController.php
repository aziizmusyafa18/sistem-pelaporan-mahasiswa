<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Mahasiswa;
use App\Models\StatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->role === 'dpa') {
            // DPA sees all reports, ordered by latest
            $laporans = Laporan::with('mahasiswa')->latest()->paginate(10);
        } else {
            // Mahasiswa sees only their own reports
            $laporans = Laporan::where('mahasiswa_id', $user->mahasiswa_id)->latest()->paginate(10);
        }

        return view('laporan.index', compact('laporans'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->mahasiswa_id) {
            return back()->withErrors(['akun' => 'Akun Anda tidak terhubung dengan data mahasiswa manapun. Silakan hubungi admin.'])->withInput();
        }

         $validated = $request->validate([
        'judul' => ['required','string','max:150'],
        'deskripsi' => ['required','string','max:2000'],
    ]);

    $nomorLaporan = $this->generateNomorLaporan();

    $laporan = \App\Models\Laporan::create([
        'judul' => $validated['judul'],
        'deskripsi' => $validated['deskripsi'],
        'nomor_laporan' => $nomorLaporan,
        'status' => 'baru',
        'mahasiswa_id' => auth()->user()->mahasiswa_id, // otomatis ambil user login
    ]);

        return redirect()->route('laporan.show', $laporan)
            ->with('success','Laporan berhasil dibuat dengan nomor tiket: '.$nomorLaporan);
    }

    private function generateNomorLaporan(): string
    {
        // Format: LAP-YYYYMMDD-HHMMSS-AB12
        return 'LAP-'.now()->format('Ymd-His').'-'.Str::upper(Str::random(4));
    }

    public function show(Laporan $laporan)
    {
        $laporan->load('mahasiswa');
        return view('laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        return view('laporan.edit', compact('laporan','mahasiswas'));
    }

    public function update(Request $request, Laporan $laporan)
    {

        // Authorize that the logged in user is the owner of the report
        if ($laporan->mahasiswa_id !== auth()->user()->mahasiswa_id) {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => ['required','string','max:150'],
            'deskripsi' => ['required','string','max:2000'],
        ]);

        $laporan->update($validated);

        return redirect()->route('laporan.show', $laporan)->with('success','Laporan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Laporan $laporan)
    {
        $validated = $request->validate([
            'status' => ['required','in:baru,diproses,selesai'],
        ]);

        $laporan->update([
            'status' => $validated['status'],
            'tanggal_update_status_terakhir' => now(),
        ]);

        \App\Models\StatusHistory::create([
            'laporan_id' => $laporan->id,
            'status' => $validated['status'],
        ]);

        return redirect()->back()->with('success','Laporan berhasil diselesaikan.');
    }

    public function destroy(Laporan $laporan)
    {
        $user = auth()->user();

        // DPA can delete any report
        if ($user->role === 'dpa') {
            $laporan->delete();
            return redirect()->route('admin.laporan.index')->with('success','Laporan berhasil dihapus.');
        }

        // Mahasiswa can only delete their own report
        if ($user->role === 'mahasiswa' && $laporan->mahasiswa_id === $user->mahasiswa_id) {
            $laporan->delete();
            return redirect()->route('laporan.index')->with('success','Laporan berhasil dihapus.');
        }

        // If neither condition is met, abort with 403
        abort(403);
    }
}