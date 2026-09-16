@extends('layouts.stitch')

@section('title', 'Manajemen Ruangan - Dasher')

@section('content')
<div class="p-space-md lg:p-space-xl flex flex-col gap-space-lg max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-space-md">
        <div>
            <h1 class="font-headline-md text-headline-md font-bold text-on-surface flex items-center gap-space-xs">
                <span class="material-symbols-outlined text-primary text-3xl">meeting_room</span>
                Manajemen Ruangan
            </h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1">
                Kelola daftar ruangan laboratorium dan kelas yang tersedia untuk dipinjam.
            </p>
        </div>
        
        <a href="{{ route('rooms.create') }}" class="flex items-center gap-2 px-4 py-2.5 bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-semibold text-sm rounded-xl transition-all shadow-sm">
            <span class="material-symbols-outlined text-lg">add</span>
            Tambah Ruangan
        </a>
    </div>

    <!-- Alert / Flash Messages -->
    @if(session('success'))
    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-start gap-3 shadow-sm">
        <span class="material-symbols-outlined text-emerald-600">check_circle</span>
        <p class="font-body-md text-body-md font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Data Table -->
    <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-surface-container-low border-b border-outline-variant/30">
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md w-16">NO</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md w-32">FOTO</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md">NAMA RUANGAN</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md w-32">KAPASITAS</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md w-40">STATUS</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md w-48 text-right">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @forelse($rooms as $index => $room)
                    <tr class="hover:bg-surface-container-lowest/50 transition-colors">
                        <td class="py-3 px-space-md">
                            <span class="font-body-sm text-body-sm text-on-surface-variant">{{ $index + 1 }}</span>
                        </td>
                        <td class="py-3 px-space-md">
                            @if($room->image)
                                <img src="{{ asset('storage/' . $room->image) }}" alt="Foto Ruangan" class="w-12 h-12 object-cover rounded-lg shadow-sm border border-outline-variant/20">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-surface-container-high flex items-center justify-center text-on-surface-variant/50 border border-outline-variant/20">
                                    <span class="material-symbols-outlined">image_not_supported</span>
                                </div>
                            @endif
                        </td>
                        <td class="py-3 px-space-md">
                            <span class="font-title-sm text-title-sm font-bold text-on-surface">{{ $room->name }}</span>
                        </td>
                        <td class="py-3 px-space-md">
                            <span class="font-body-md text-body-md text-on-surface flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm text-on-surface-variant">person</span>
                                {{ $room->capacity }}
                            </span>
                        </td>
                        <td class="py-3 px-space-md">
                            @if($room->status == 'available')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Tersedia
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Digunakan
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-space-md text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('rooms.print', $room->id) }}" target="_blank" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Download QR Code (PDF)">
                                    <span class="material-symbols-outlined text-[20px]">print</span>
                                </a>
                                <a href="{{ route('rooms.edit', $room->id) }}" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus ruangan ini? Semua data terkait (booking, dll) mungkin akan terpengaruh.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-error hover:bg-error-container/50 rounded-lg transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 px-4 text-center">
                            <div class="flex flex-col items-center justify-center text-on-surface-variant/60">
                                <span class="material-symbols-outlined text-5xl mb-2">meeting_room</span>
                                <p class="font-body-md text-body-md font-medium text-on-surface">Belum ada ruangan terdaftar</p>
                                <p class="font-body-sm text-body-sm mt-1">Silakan tambahkan ruangan baru untuk mulai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection