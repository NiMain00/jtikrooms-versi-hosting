@extends('layouts.stitch')

@section('title', 'Pusat Informasi - JTIKROOMS')

@section('content')
<div class="p-space-md lg:p-space-xl flex flex-col gap-space-lg max-w-5xl mx-auto">
    <!-- Hero Section -->
    <div class="bg-surface-container-lowest rounded-3xl p-space-xl shadow-sm border border-outline-variant/30 flex flex-col md:flex-row items-center gap-space-xl overflow-hidden relative">
        <div class="absolute right-0 top-0 w-64 h-64 bg-primary/5 rounded-bl-full -mr-10 -mt-10"></div>
        <div class="absolute left-0 bottom-0 w-40 h-40 bg-secondary/5 rounded-tr-full -ml-10 -mb-10"></div>
        
        <div class="flex-1 relative z-10 flex flex-col items-center md:items-start text-center md:text-left gap-4">
            <span class="px-3 py-1 rounded-full bg-primary-container text-on-primary-container font-label-sm uppercase tracking-wider font-bold">Pusat Bantuan</span>
            <h1 class="font-display-sm text-4xl lg:text-5xl font-bold text-on-surface">Informasi & <br/> Panduan Pengguna</h1>
            <p class="font-body-lg text-on-surface-variant max-w-lg mt-2">Temukan informasi tata tertib penggunaan laboratorium, panduan peminjaman ruang, serta file kelengkapan lainnya di bawah ini.</p>
        </div>
        
        <div class="relative z-10 hidden md:block">
            <span class="material-symbols-outlined text-[120px] text-primary opacity-90 drop-shadow-lg">info</span>
        </div>
    </div>

    <!-- Konten Informasi Admin -->
    <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl shadow-sm p-space-xl relative">
        <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface flex items-center gap-2 mb-6 border-b border-outline-variant/20 pb-4">
            <span class="material-symbols-outlined text-primary text-2xl">campaign</span>
            Pengumuman Terbaru
        </h2>
        
        <div class="prose prose-slate max-w-none font-body-md text-on-surface leading-relaxed space-y-4">
            @if(isset($information) && !empty($information->content))
                {!! nl2br(e($information->content)) !!}
            @else
                <div class="flex flex-col items-center justify-center text-on-surface-variant/50 py-8 bg-surface-container-low rounded-xl">
                    <span class="material-symbols-outlined text-4xl mb-2">article</span>
                    <p class="font-medium">Belum ada pengumuman khusus dari administrator.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Lampiran Panduan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md mt-4">
        @if(isset($information) && !empty($information->file_path))
        <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl p-space-md shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-error-container text-on-error-container flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">picture_as_pdf</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-title-md font-bold text-on-surface">Panduan Pemakaian Ruang</h3>
                    <p class="font-body-sm text-on-surface-variant mt-1 mb-3">Unduh dokumen panduan lengkap berbentuk PDF terkait SOP Laboratorium.</p>
                    <a href="{{ asset('storage/' . $information->file_path) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-surface-container text-on-surface hover:bg-surface-container-high font-semibold text-sm rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-[18px]">download</span>
                        Download PDF
                    </a>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl p-space-md shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary-container flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">qr_code_scanner</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-title-md font-bold text-on-surface">Gunakan Fitur Scan QR</h3>
                    <p class="font-body-sm text-on-surface-variant mt-1 mb-3">Untuk mempercepat proses peminjaman, gunakan menu Scanner saat berada di depan ruangan.</p>
                    <a href="{{ route('qr.scanner') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-semibold text-sm rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                        Buka Scanner
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer / Kontak -->
    <div class="mt-8 text-center text-on-surface-variant/70 font-body-sm">
        <p>Jika Anda menemukan kendala, silakan hubungi tim IT Support / Admin JTIK.</p>
    </div>
</div>
@endsection