<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-between mb-4">
                      <h2 class="text-xl font-semibold">Daftar Laporan</h2>
                      @cannot('isDPA')
                        <a href="{{ route('laporan.create') }}" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">+ Buat Laporan</a>
                      @endcannot
                    </div>

                    <x-alert-success />
                    <form method="GET" class="mb-3">
                      <select name="status" class="border rounded px-2 py-1 w-full sm:w-auto text-sm sm:text-base" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        @foreach (['baru','diproses','selesai'] as $s)
                          <option value="{{ $s }}" {{ request('status')===$s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                      </select>
                    </form>

                    <!-- Responsive Table Container -->
                    <div class="overflow-x-auto -mx-4 sm:-mx-6 lg:mx-0">
                      <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                          <table class="min-w-full divide-y divide-gray-300 bg-white">
                            <thead class="bg-blue-900">
                              <tr>
                                <th scope="col" class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">No</th>
                                <th scope="col" class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">Nomor Tiket</th>
                                <th scope="col" class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">Judul</th>
                                <th scope="col" class="hidden md:table-cell px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">Pelapor</th>
                                <th scope="col" class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">Status</th>
                                <th scope="col" class="hidden lg:table-cell px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">Tanggal</th>
                                <th scope="col" class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-center text-xs sm:text-sm font-semibold text-white">Aksi</th>
                              </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                              @forelse ($laporans as $index => $laporan)
                                <tr class="hover:bg-gray-50">
                                  <td class="whitespace-nowrap px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-xs sm:text-sm text-gray-900">{{ $laporans->firstItem() + $index }}</td>
                                  <td class="whitespace-nowrap px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-xs sm:text-sm font-mono text-gray-900">{{ $laporan->nomor_laporan }}</td>
                                  <td class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-xs sm:text-sm text-gray-900">
                                    <div class="max-w-xs truncate">{{ $laporan->judul }}</div>
                                  </td>
                                  <td class="hidden md:table-cell px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-xs sm:text-sm text-gray-900">{{ optional($laporan->mahasiswa)->nama }}</td>
                                  <td class="whitespace-nowrap px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-xs sm:text-sm">
                                    @php
                                      $color = $laporan->status === 'selesai' ? 'green' : ($laporan->status === 'diproses' ? 'yellow' : 'red');
                                    @endphp
                                    <span class="inline-flex rounded-full px-2 py-0.5 sm:py-1 text-xs font-semibold leading-5 bg-{{ $color }}-100 text-{{ $color }}-800">
                                      {{ ucfirst($laporan->status) }}
                                    </span>
                                  </td>
                                  <td class="hidden lg:table-cell whitespace-nowrap px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-xs sm:text-sm text-gray-500">
                                    {{ $laporan->tanggal_update_status_terakhir ? \Carbon\Carbon::parse($laporan->tanggal_update_status_terakhir)->isoFormat('D MMM YYYY') : '-' }}
                                  </td>
                                  <td class="whitespace-nowrap px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-xs sm:text-sm">
                                    <div class="flex items-center justify-center gap-1 sm:gap-2">
                                      @can('isDPA')
                                      <a href="{{ route('admin.laporan.show', $laporan) }}" class="inline-flex items-center justify-center p-1 sm:px-2 sm:py-1 border border-blue-500 text-blue-600 rounded text-xs hover:bg-blue-50" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                      </a>
                                      @else
                                      <a href="{{ route('laporan.show', $laporan) }}" class="inline-flex items-center justify-center p-1 sm:px-2 sm:py-1 border border-blue-500 text-blue-600 rounded text-xs hover:bg-blue-50" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                      </a>
                                      @endcan

                                      @cannot('isDPA')
                                      <a href="{{ route('laporan.edit', $laporan) }}" class="inline-flex items-center justify-center p-1 sm:px-2 sm:py-1 border border-yellow-500 text-yellow-600 rounded text-xs hover:bg-yellow-50" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                      </a>
                                      @endcannot

                                      @can('isDPA')
                                        @if($laporan->status !== 'selesai')
                                        <form action="{{ route('admin.laporan.updateStatus', $laporan) }}" method="POST" class="inline-block">
                                          @csrf @method('PATCH')
                                          <input type="hidden" name="status" value="{{ $laporan->status === 'baru' ? 'diproses' : 'selesai' }}">
                                          <button type="submit" class="inline-flex items-center justify-center p-1 sm:px-2 sm:py-1 border border-green-500 text-green-600 rounded text-xs hover:bg-green-50" title="{{ $laporan->status === 'baru' ? 'Proses' : 'Selesai' }}">
                                            @if($laporan->status === 'baru')
                                              <span class="hidden sm:inline">Proses</span>
                                              <i class="bi bi-play-fill sm:hidden"></i>
                                            @else
                                              <i class="bi bi-check-lg"></i>
                                            @endif
                                          </button>
                                        </form>
                                        @endif
                                      @endcan

                                      <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus laporan?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center p-1 sm:px-2 sm:py-1 border border-red-500 text-red-600 rounded text-xs hover:bg-red-50" title="Hapus">
                                          <i class="bi bi-trash"></i>
                                        </button>
                                      </form>
                                    </div>
                                  </td>
                                </tr>
                              @empty
                                <tr>
                                  <td colspan="7" class="px-4 py-8 text-center text-sm text-gray-500">
                                    Belum ada laporan
                                  </td>
                                </tr>
                              @endforelse
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                    <div class="mt-4 px-4 sm:px-0">
                      {{ $laporans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>