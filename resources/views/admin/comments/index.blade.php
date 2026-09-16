@extends('layouts.stitch')

@section('title', 'Pesan Masuk & Komentar - Dasher')

@section('content')
<div class="p-space-md lg:p-space-xl flex flex-col gap-space-lg max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-space-md">
        <div>
            <h1 class="font-headline-md text-headline-md font-bold text-on-surface flex items-center gap-space-xs">
                <span class="material-symbols-outlined text-primary text-3xl">mark_email_unread</span>
                Pesan Masuk & Komentar
            </h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1">
                Kelola ulasan, laporan masalah, dan komentar yang masuk dari halaman detail ruangan.
            </p>
        </div>
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
            <table class="w-full text-left border-collapse min-w-[1000px]">
                <thead>
                    <tr class="bg-surface-container-low border-b border-outline-variant/30">
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md w-[200px]">PENGIRIM</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md w-[200px]">RUANGAN</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md">TIPE & PESAN</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md w-32">STATUS</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md text-right w-40">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @forelse($comments as $comment)
                    <tr class="hover:bg-surface-container-lowest/50 transition-colors {{ $comment->is_resolved ? 'opacity-70' : '' }}">
                        <td class="py-4 px-space-md">
                            <div class="flex items-center gap-3">
                                @if($comment->is_anonymous)
                                    <div class="w-10 h-10 rounded-full bg-surface-variant flex items-center justify-center text-on-surface-variant shrink-0">
                                        <span class="material-symbols-outlined">person_off</span>
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="font-title-sm font-bold text-on-surface italic truncate">Anonim</span>
                                        <span class="font-body-sm text-on-surface-variant truncate">{{ $comment->created_at->format('d M, H:i') }}</span>
                                    </div>
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name ?? 'User') }}&background=0058be&color=fff&rounded=true" alt="Avatar" class="w-10 h-10 rounded-full shadow-sm">
                                    <div class="flex flex-col">
                                        <span class="font-title-sm font-bold text-on-surface">{{ $comment->user->name ?? 'Pengguna (Dihapus)' }}</span>
                                        <span class="font-body-sm text-on-surface-variant">{{ $comment->created_at->format('d M, H:i') }}</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-space-md">
                            <span class="inline-flex items-center gap-1 font-title-sm font-bold bg-primary-container text-on-primary-container px-2.5 py-1 rounded-md">
                                <span class="material-symbols-outlined text-[16px]">meeting_room</span>
                                {{ $comment->room->name ?? 'Ruangan Dihapus' }}
                            </span>
                        </td>
                        <td class="py-4 px-space-md">
                            <div class="flex flex-col gap-1">
                                @if($comment->type === 'report')
                                    <span class="inline-flex items-center gap-1 text-xs font-bold text-error">
                                        <span class="material-symbols-outlined text-[14px]">flag</span> LAPORAN KENDALA
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-xs font-bold text-primary">
                                        <span class="material-symbols-outlined text-[14px]">chat_bubble</span> KOMENTAR UMUM
                                    </span>
                                @endif
                                <p class="font-body-md text-on-surface leading-relaxed mt-1">{{ $comment->content }}</p>
                            </div>
                        </td>
                        <td class="py-4 px-space-md">
                            @if($comment->is_resolved)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                    <span class="material-symbols-outlined text-[14px]">check</span> Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                    <span class="material-symbols-outlined text-[14px]">pending</span> Menunggu
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-space-md text-right">
                            <div class="flex justify-end gap-2">
                                @if(!$comment->is_resolved)
                                <form action="{{ route('admin.comments.resolve', $comment->id) }}" method="POST" class="inline" onsubmit="return confirm('Tandai masalah/komentar ini sebagai selesai?')">
                                    @csrf
                                    <button type="submit" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Tandai Selesai">
                                        <span class="material-symbols-outlined text-[20px]">task_alt</span>
                                    </button>
                                </form>
                                @endif
                                
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pesan ini secara permanen?')">
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
                                <span class="material-symbols-outlined text-5xl mb-2">mark_email_read</span>
                                <p class="font-body-md text-body-md font-medium text-on-surface">Pesan masuk kosong</p>
                                <p class="font-body-sm text-body-sm mt-1">Belum ada komentar atau laporan dari pengguna.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination (if exists) -->
        @if(method_exists($comments, 'links') && $comments->hasPages())
        <div class="px-space-md py-4 border-t border-outline-variant/30">
            {{ $comments->links() }}
        </div>
        @endif
    </div>
</div>
@endsection