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
                    <div class="mb-4">
                        <p class="font-semibold">Nomor Laporan:</p>
                        <p>{{ $laporan->nomor_laporan }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="font-semibold">Judul:</p>
                        <p>{{ $laporan->judul }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="font-semibold">Deskripsi:</p>
                        <p>{{ $laporan->deskripsi }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="font-semibold">Status:</p>
                        <p>{{ ucfirst($laporan->status) }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="font-semibold">Mahasiswa:</p>
                        <p>{{ $laporan->mahasiswa->nama }} ({{ $laporan->mahasiswa->nim }})</p>
                    </div>
                    <div class="flex items-center gap-2">
                        @can('isDPA')
                            <a href="{{ route('admin.laporan.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">Kembali</a>
                        @else
                            <a href="{{ route('laporan.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">Kembali</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
