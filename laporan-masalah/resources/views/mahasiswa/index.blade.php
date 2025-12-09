<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex items-center justify-between mb-4">
                        {{-- <h2 class="text-xl font-semibold">Daftar Mahasiswa</h2> --}}
                        <a href="{{ route('mahasiswa.create') }}" class="px-3 py-1.5 sm:px-4 sm:py-2 rounded bg-blue-600 text-white hover:bg-blue-700 text-sm sm:text-base whitespace-nowrap">
                          <i class="fas fa-plus"></i>
                          <span class="hidden sm:inline">Tambah Mahasiswa</span>
                          <span class="sm:hidden">Tambah</span>
                        </a>
                    </div>

                    <div class="mb-4">
                        <form action="{{ route('mahasiswa.index') }}" method="GET">
                            <div class="flex flex-col sm:flex-row gap-2">
                              <input type="text" name="search" class="flex-1 border rounded sm:rounded-l sm:rounded-r-none px-3 py-2 text-sm sm:text-base" placeholder="Cari berdasarkan nama atau NIM..." value="{{ $search ?? '' }}">
                              <button type="submit" class="px-4 py-2 rounded sm:rounded-r sm:rounded-l-none bg-gray-600 text-white hover:bg-gray-700 text-sm sm:text-base">Cari</button>
                            </div>
                        </form>
                    </div>

                    <x-alert-success />

                    <!-- Responsive Table Container -->
                    <div class="overflow-x-auto -mx-4 sm:-mx-6 lg:mx-0">
                      <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                          <table class="min-w-full divide-y divide-gray-300 bg-white">
                            <thead class="bg-blue-900">
                              <tr>
                                <th scope="col" class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">ID</th>
                                <th scope="col" class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">Nama</th>
                                <th scope="col" class="hidden md:table-cell px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">NIM</th>
                                <th scope="col" class="hidden lg:table-cell px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">Email</th>
                                <th scope="col" class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-center text-xs sm:text-sm font-semibold text-white">Aksi</th>
                              </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                              @forelse ($mahasiswas as $index => $mahasiswa)
                                <tr class="hover:bg-gray-50">
                                  <td class="whitespace-nowrap px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-xs sm:text-sm text-gray-900">{{ $mahasiswa->id }}</td>
                                  <td class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-xs sm:text-sm text-gray-900">{{ $mahasiswa->nama }}</td>
                                  <td class="hidden md:table-cell whitespace-nowrap px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-xs sm:text-sm text-gray-900">{{ $mahasiswa->nim }}</td>
                                  <td class="hidden lg:table-cell px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-xs sm:text-sm text-gray-500">{{ $mahasiswa->email }}</td>
                                  <td class="whitespace-nowrap px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-xs sm:text-sm">
                                    <div class="flex items-center justify-center gap-1 sm:gap-2">
                                      <a href="{{ route('mahasiswa.show', $mahasiswa) }}" class="inline-flex items-center justify-center p-1 sm:px-2 sm:py-1 text-blue-700 hover:text-blue-900" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                      </a>
                                      <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="inline-flex items-center justify-center p-1 sm:px-2 sm:py-1 text-yellow-600 hover:text-yellow-800" title="Edit">
                                        <i class="fas fa-edit"></i>
                                      </a>
                                      <form action="{{ route('mahasiswa.destroy', $mahasiswa) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus data?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center p-1 sm:px-2 sm:py-1 text-red-600 hover:text-red-800" title="Hapus">
                                          <i class="fas fa-trash"></i>
                                        </button>
                                      </form>
                                    </div>
                                  </td>
                                </tr>
                              @empty
                                <tr>
                                  <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-500">
                                    Belum ada data atau data tidak ditemukan
                                  </td>
                                </tr>
                              @endforelse
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                    <div class="mt-4 px-4 sm:px-0">
                        {{ $mahasiswas->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>