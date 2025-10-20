<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Laporan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                      <div class="mb-4 rounded border border-red-200 bg-red-50 p-3 text-red-700">
                        <ul class="list-disc pl-5">
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    <form action="{{ route('laporan.store') }}" method="POST" class="bg-white p-4 rounded shadow max-w-2xl">
                      @csrf

                      <div class="mb-3">
                        <label class="block mb-1">Judul Laporan</label>
                        <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border rounded px-3 py-2" required>
                      </div>

                      <div class="mb-4">
                        <label class="block mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="5" class="w-full border rounded px-3 py-2" required>{{ old('deskripsi') }}</textarea>
                      </div>

                      <div class="flex items-center gap-2">
                        <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Kirim Laporan</button>
                        <a href="{{ route('laporan.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">Batal</a>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>