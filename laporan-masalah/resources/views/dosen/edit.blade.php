<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Dosen') }}
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

                    <form action="{{ route('dosen.update', $dosen) }}" method="POST" class="bg-white p-4 rounded shadow max-w-xl">
                      @csrf @method('PUT')
                      <div class="mb-3">
                        <label class="block mb-1">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama', $dosen->nama) }}" class="w-full border rounded px-3 py-2" required>
                      </div>

                      <div class="mb-3">
                        <label class="block mb-1">NIDN</label>
                        <input type="text" name="nidn" value="{{ old('nidn', $dosen->nidn) }}" class="w-full border rounded px-3 py-2" required>
                      </div>

                      <div class="mb-4">
                        <label class="block mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $dosen->email) }}" class="w-full border rounded px-3 py-2" required>
                      </div>

                      <div class="flex items-center gap-2">
                        <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Update</button>
                        <a href="{{ route('dosen.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">Batal</a>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>