<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Mahasiswa') }}
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

                    <form action="{{ route('mahasiswa.store') }}" method="POST" class="max-w-xl">
                        @csrf
                        <div class="mb-3">
                            <label class="block mb-1">Nama</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div class="mb-3">
                            <label class="block mb-1">NIM</label>
                            <input type="text" name="nim" value="{{ old('nim') }}" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1">Email</label>
                            <div class="flex">
                                <input type="text" name="email_prefix" value="{{ old('email_prefix') }}" class="w-full border rounded-l px-3 py-2" required>
                                <span class="border border-l-0 rounded-r px-3 py-2 bg-gray-100 text-gray-500">@mahasiswa.com</span>
                                <input type="hidden" name="email" value="{{ old('email_prefix') ? old('email_prefix') . '@mahasiswa.com' : '' }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1">Password</label>
                            <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                            <a href="{{ route('mahasiswa.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>