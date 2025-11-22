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
                      <select name="status" class="border rounded px-2 py-1" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        @foreach (['baru','diproses','selesai'] as $s)
                          <option value="{{ $s }}" {{ request('status')===$s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                      </select>
                    </form>
                    <table class="w-full border-collapse bg-white rounded shadow">
                      <thead>
                        <tr class="bg-blue-900 text-center text-white">
                          <th class="px-4 py-2 border">No</th>
                          <th class="px-4 py-2 border">Nomor Tiket</th>
                          <th class="px-4 py-2 border">Judul</th>
                          <th class="px-4 py-2 border">Pelapor</th>
                          <th class="px-4 py-2 border">Status</th>
                          <th class="px-4 py-2 border">Tanggal Update Status</th>
                          <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        @forelse ($laporans as $index => $laporan)
                          <tr>
                            <td class="px-4 py-2 border">{{ $laporans->firstItem() + $index }}</td>
                            <td class="px-4 py-2 border font-mono">{{ $laporan->nomor_laporan }}</td>
                            <td class="px-4 py-2 border">{{ $laporan->judul }}</td>
                            <td class="px-4 py-2 border">{{ optional($laporan->mahasiswa)->nama }}</td>
                            <td class="px-4 py-2 border">
                              @php
                                $color = $laporan->status === 'selesai' ? 'green' : ($laporan->status === 'diproses' ? 'yellow' : 'red');
                              @endphp
                              <span class="px-2 py-1 rounded bg-{{ $color }}-100 text-{{ $color }}-800 border border-{{ $color }}-200 text-sm">{{ ucfirst($laporan->status) }}</span>
                            </td>
                            <td class="px-4 py-2 border">{{ $laporan->tanggal_update_status_terakhir ? \Carbon\Carbon::parse($laporan->tanggal_update_status_terakhir)->isoFormat('D MMMM YYYY, HH:mm') : '-' }}</td>
                            <td class="px-4 py-2 border whitespace-nowrap">
                              <div class="flex items-center justify-center gap-2">
                                @can('isDPA')
                                <a href="{{ route('admin.laporan.show', $laporan) }}" class="px-2 py-1 border border-blue-500 text-blue-600 rounded-md text-sm hover:bg-blue-50"><i class="bi bi-eye"></i></a>
                                @else
                                <a href="{{ route('laporan.show', $laporan) }}" class="px-2 py-1 border border-blue-500 text-blue-600 rounded-md text-sm hover:bg-blue-50"><i class="bi bi-eye"></i></a>
                                @endcan
                                
                                @cannot('isDPA')
                                <a href="{{ route('laporan.edit', $laporan) }}" class="px-2 py-1 border border-yellow-500 text-yellow-600 rounded-md text-sm hover:bg-yellow-50"><i class="bi bi-pencil-square"></i></a>
                                @endcannot
                                
                                <!-- Tombol Ubah Status Cepat -->
                                @can('isDPA')
                                  @if($laporan->status !== 'selesai')
                                  <form action="{{ route('admin.laporan.updateStatus', $laporan) }}" method="POST" class="inline-block">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="{{ $laporan->status === 'baru' ? 'diproses' : 'selesai' }}">
                                    <button type="submit" class="px-2 py-1 border border-green-500 text-green-600 rounded-md text-sm hover:bg-green-50">
                                      @if($laporan->status === 'baru')
                                        Proses
                                      @else
                                        <i class="bi bi-check-lg"></i>
                                      @endif
                                    </button>
                                  </form>
                                  @endif
                                @endcan

                                <!-- Hapus -->
                                <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus laporan?')">
                                  @csrf @method('DELETE')
                                  <button type="submit" class="px-2 py-1 border border-red-500 text-red-600 rounded-md text-sm hover:bg-red-50"><i class="bi bi-trash"></i></button>
                                </form>
                              </div>
                            </td>
                          </tr>
                        @empty
                          <tr><td colspan="7" class="px-4 py-6 border text-center text-gray-500">Belum ada laporan</td></tr>
                        @endforelse
                      </tbody>
                    </table>

                    <div class="mt-4">
                      {{ $laporans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>