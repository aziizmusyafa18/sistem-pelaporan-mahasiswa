<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900">
                    @if(auth()->user()->role === 'mahasiswa')
                      <p class="mb-3 text-sm sm:text-base">Selamat datang, <span class="font-semibold">{{ auth()->user()->name }}</span>. Berikut laporan yang kamu buat:</p>
                      @foreach ($laporans as $laporan)
                        @if ($laporan->status === 'selesai')
                          <div class="bg-green-100 border border-green-400 text-green-700 px-3 sm:px-4 py-2 sm:py-3 rounded relative mb-3 sm:mb-4 text-sm sm:text-base" role="alert">
                            <strong class="font-bold">Laporan Selesai!</strong>
                            <span class="block sm:inline">Laporan Anda dengan nomor tiket <span class="font-mono">{{ $laporan->nomor_laporan }}</span> telah diselesaikan oleh admin.</span>
                          </div>
                        @endif
                      @endforeach
                    @else
                      <p class="mb-3 text-sm sm:text-base">Selamat datang <span class="font-semibold">Admin DPA</span>, berikut semua laporan mahasiswa:</p>
                    @endif

                    <!-- Responsive Table Container -->
                    <div class="overflow-x-auto -mx-4 sm:-mx-6 lg:mx-0">
                      <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                          <table class="min-w-full divide-y divide-gray-300 bg-white">
                            <thead class="bg-blue-900">
                              <tr>
                                <th scope="col" class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">Nomor</th>
                                <th scope="col" class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">Judul</th>
                                <th scope="col" class="hidden md:table-cell px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">Pelapor</th>
                                <th scope="col" class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">Status</th>
                                <th scope="col" class="hidden lg:table-cell px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-white">Tanggal</th>
                                <th scope="col" class="px-2 sm:px-3 lg:px-4 py-2 sm:py-3 text-center text-xs sm:text-sm font-semibold text-white">Aksi</th>
                              </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                              @forelse ($laporans as $laporan)
                                <tr class="hover:bg-gray-50">
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

                                      @can('isDPA')
                                        @if($laporan->status !== 'selesai')
                                          <form action="{{ route('admin.laporan.updateStatus', $laporan) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="{{ $laporan->status === 'baru' ? 'diproses' : 'selesai' }}">
                                            <button type="submit" class="inline-flex items-center justify-center p-1 sm:px-2 sm:py-1 border border-green-500 text-green-600 rounded text-xs hover:bg-green-50" title="{{ $laporan->status === 'baru' ? 'Proses' : 'Selesai' }}">
                                              <i class="bi bi-{{ $laporan->status === 'baru' ? 'arrow-repeat' : 'check-lg' }}"></i>
                                            </button>
                                          </form>
                                        @endif
                                      @endcan

                                      <form action="{{ auth()->user()->role === 'dpa' ? route('admin.laporan.destroy', $laporan) : route('laporan.destroy', $laporan) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus laporan?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center p-1 sm:px-2 sm:py-1 border border-red-500 text-red-600 rounded text-xs hover:bg-red-50" title="Hapus">
                                          <i class="bi bi-trash"></i>
                                        </button>
                                      </form>
                                    </div>
                                  </td>
                                </tr>
                              @empty
                                <tr>
                                  <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500">
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
