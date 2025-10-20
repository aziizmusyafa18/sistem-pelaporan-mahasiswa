<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <x-alert-success />

                    <div class="bg-white rounded shadow p-4">
                      <div class="mb-2"><span class="font-semibold">Nomor Tiket:</span> <span class="font-mono">{{ $laporan->nomor_laporan }}</span></div>
                      <div class="mb-2"><span class="font-semibold">Judul:</span> {{ $laporan->judul }}</div>
                      <div class="mb-2"><span class="font-semibold">Pelapor:</span> {{ optional($laporan->mahasiswa)->nama }} ({{ optional($laporan->mahasiswa)->nim }})</div>
                      <div class="mb-2"><span class="font-semibold">Status:</span> <span class="px-2 py-1 rounded bg-gray-100 border">{{ ucfirst($laporan->status) }}</span></div>
                      <div class="mb-4"><span class="font-semibold">Deskripsi:</span><br>{{ $laporan->deskripsi }}</div>

                      <div class="flex items-center gap-2">
                        @cannot('isDPA')
                            <a href="{{ route('laporan.edit', $laporan) }}" class="px-4 py-2 rounded bg-yellow-500 text-white hover:bg-yellow-600">Edit</a>
                        @endcannot
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded border hover:bg-gray-50">Kembali</a>
                        @can('isDPA')
                          <form action="{{ route('admin.laporan.updateStatus', $laporan) }}" method="POST" class="inline-block ml-3">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="{{ $laporan->status === 'baru' ? 'diproses' : 'selesai' }}">
                            <button type="submit" class="text-green-600 hover:underline">
                              {{ $laporan->status === 'baru' ? 'Proses' : ($laporan->status === 'diproses' ? 'Selesaikan' : '') }}
                            </button>
                          </form>
                        @endcan
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>