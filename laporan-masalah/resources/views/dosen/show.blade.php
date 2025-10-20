<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="bg-white rounded shadow p-4 max-w-xl">
                      <div class="mb-2"><span class="font-semibold">Nama:</span> {{ $dosen->nama }}</div>
                      <div class="mb-2"><span class="font-semibold">NIDN:</span> {{ $dosen->nidn }}</div>
                      <div class="mb-4"><span class="font-semibold">Email:</span> {{ $dosen->email }}</div>

                      <a href="{{ route('dosen.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>