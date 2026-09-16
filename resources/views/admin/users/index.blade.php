@extends('layouts.stitch')

@section('title', 'Manajemen Perwakilan Kelas - Dasher')

@section('content')
<div class="p-space-md lg:p-space-xl flex flex-col gap-space-lg max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-space-md">
        <div>
            <h1 class="font-headline-md text-headline-md font-bold text-on-surface flex items-center gap-space-xs">
                <span class="material-symbols-outlined text-primary text-3xl">group</span>
                Manajemen Perwakilan Kelas
            </h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1">
                Kelola akun perwakilan kelas (User) untuk sistem JTIK ROOM'S.
            </p>
        </div>
        
        <a href="{{ route('users.create') }}" class="flex items-center gap-2 px-4 py-2.5 bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-semibold text-sm rounded-xl transition-all shadow-sm">
            <span class="material-symbols-outlined text-lg">person_add</span>
            Tambah Kelas Baru
        </a>
    </div>

    <!-- Alert / Flash Messages -->
    @if(session('success'))
    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-start gap-3 shadow-sm">
        <span class="material-symbols-outlined text-emerald-600">check_circle</span>
        <p class="font-body-md text-body-md font-medium">{{ session('success') }}</p>
    </div>
    @endif
    @if(session('error'))
    <div class="p-4 bg-error-container/30 border border-error/20 text-error rounded-xl flex items-start gap-3 shadow-sm">
        <span class="material-symbols-outlined">warning</span>
        <p class="font-body-md text-body-md font-medium">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Data Table -->
    <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-surface-container-low border-b border-outline-variant/30">
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md w-16">NO</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md">KELAS / PRODI</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md">ANGKATAN</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md">USERNAME</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md text-right w-40">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @forelse($users as $index => $user)
                    <tr class="hover:bg-surface-container-lowest/50 transition-colors">
                        <td class="py-3 px-space-md">
                            <span class="font-body-sm text-body-sm text-on-surface-variant">{{ $index + 1 }}</span>
                        </td>
                        <td class="py-3 px-space-md">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama_kelas ?? $user->prodi . ' ' . $user->kelas) }}&background=0058be&color=fff&rounded=true" alt="Avatar" class="w-10 h-10 rounded-full shadow-sm">
                                <div class="flex flex-col">
                                    <span class="font-title-sm text-title-sm font-bold text-on-surface">{{ $user->nama_kelas ?? ($user->prodi . ' ' . $user->kelas) }}</span>
                                    <span class="font-body-sm text-body-sm text-on-surface-variant">Prodi: {{ $user->prodi }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-space-md">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-surface-variant text-on-surface-variant">
                                {{ $user->angkatan }}
                            </span>
                        </td>
                        <td class="py-3 px-space-md">
                            <span class="font-body-md text-body-md text-primary bg-primary/10 px-2.5 py-1 rounded-md font-bold">{{ $user->username }}</span>
                        </td>
                        <td class="py-3 px-space-md text-right">
                            <div class="flex justify-end gap-2">
                                <form action="{{ route('users.reset-password', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin reset password menjadi default (password123)?')">
                                    @csrf
                                    <button type="submit" class="p-2 text-primary hover:bg-primary-container/50 rounded-lg transition-colors" title="Reset Password ke Default">
                                        <span class="material-symbols-outlined text-[20px]">lock_reset</span>
                                    </button>
                                </form>
                                <a href="{{ route('users.edit', $user->id) }}" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
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
                        <td colspan="5" class="py-12 px-4 text-center">
                            <div class="flex flex-col items-center justify-center text-on-surface-variant/60">
                                <span class="material-symbols-outlined text-5xl mb-2">group_off</span>
                                <p class="font-body-md text-body-md font-medium text-on-surface">Belum ada perwakilan kelas terdaftar</p>
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