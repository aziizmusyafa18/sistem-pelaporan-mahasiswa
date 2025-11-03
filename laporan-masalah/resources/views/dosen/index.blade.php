<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-between mb-4">
                      <h2 class="text-xl font-semibold">Daftar Dosen</h2>
                      <a href="{{ route('dosen.create') }}" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">+ Tambah Dosen</a>
                    </div>

                    <x-alert-success />

                    <table class="w-full border-collapse bg-white rounded shadow">
                      <thead>
                        <tr class="bg-blue-900 text-center text-white">
                          <th class="px-4 py-2 border">ID</th>
                          <th class="px-4 py-2 border">Nama</th>
                          <th class="px-4 py-2 border">NIDN</th>
                          <th class="px-4 py-2 border">Email</th>
                          <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($dosens as $index => $dosen)
                          <tr class="text-center">
                            <td class="px-4 py-2 border">{{ $dosen->id }}</td>
                            <td class="px-4 py-2 border">{{ $dosen->nama }}</td>
                            <td class="px-4 py-2 border">{{ $dosen->nidn }}</td>
                            <td class="px-4 py-2 border">{{ $dosen->email }}</td>
                            <td class="px-4 py-2 border">
                                <div class="flex items-center justify-center p-2">
                                    <a href="{{ route('dosen.show', $dosen) }}" class="text-blue-700 hover:underline">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('dosen.edit', $dosen) }}" class="ml-3 text-yellow-600 hover:underline">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('dosen.destroy', $dosen) }}" method="POST" class="inline-block ml-3" onsubmit="return confirm('Yakin hapus data?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                          </tr>
                        @empty
                          <tr><td colspan="5" class="px-4 py-6 border text-center text-gray-500">Belum ada data</td></tr>
                        @endforelse
                      </tbody>
                    </table>

                    <div class="mt-4">
                      {{ $dosens->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
