<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->role === 'mahasiswa')
                      <p class="mb-3">Selamat datang, {{ auth()->user()->name }}. Berikut laporan yang kamu buat:</p>
                    @else
                      <p class="mb-3">Selamat datang Admin DPA, berikut semua laporan mahasiswa:</p>
                    @endif

                    <table class="w-full border-collapse bg-white rounded shadow">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-4 py-2 border">Nomor</th>
                                <th class="px-4 py-2 border">Judul</th>
                                <th class="px-4 py-2 border">Pelapor</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporans as $laporan)
                            <tr>
                                <td class="px-4 py-2 border font-mono">{{ $laporan->nomor_laporan }}</td>
                                <td class="px-4 py-2 border">{{ $laporan->judul }}</td>
                                <td class="px-4 py-2 border">{{ optional($laporan->mahasiswa)->nama }}</td>
                                <td class="px-4 py-2 border">{{ ucfirst($laporan->status) }}</td>
                                <td class="px-4 py-2 border whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        {{-- Lihat Button --}}
                                        @can('isDPA')
                                            <a href="{{ route('admin.laporan.show', $laporan) }}" class="px-2 py-1 border border-blue-500 text-blue-600 rounded-md text-sm hover:bg-blue-50">Lihat</a>
                                        @else
                                            <a href="{{ route('laporan.show', $laporan) }}" class="px-2 py-1 border border-blue-500 text-blue-600 rounded-md text-sm hover:bg-blue-50">Lihat</a>
                                        @endcan

                                        {{-- Quick Status Change Button for DPA --}}
                                        @can('isDPA')
                                            @if($laporan->status !== 'selesai')
                                            <form action="{{ route('admin.laporan.updateStatus', $laporan) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="{{ $laporan->status === 'baru' ? 'diproses' : 'selesai' }}">
                                                <button type="submit" class="px-2 py-1 border border-green-500 text-green-600 rounded-md text-sm hover:bg-green-50">
                                                    {{ $laporan->status === 'baru' ? 'Proses' : 'Selesaikan' }}
                                                </button>
                                            </form>
                                            @endif
                                        @endcan

                                        {{-- Delete Button --}}
                                        <form action="{{ auth()->user()->role === 'dpa' ? route('admin.laporan.destroy', $laporan) : route('laporan.destroy', $laporan) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus laporan?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 border border-red-500 text-red-600 rounded-md text-sm hover:bg-red-50">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 border text-center text-gray-500">Belum ada laporan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $laporans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
