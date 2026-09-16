@extends('layouts.stitch')

@section('title', 'Informasi Publik - Dasher')

@section('content')
<div class="p-space-md lg:p-space-xl flex flex-col gap-space-lg max-w-5xl mx-auto">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-space-md">
        <div>
            <h1 class="font-headline-md text-headline-md font-bold text-on-surface flex items-center gap-space-xs">
                <span class="material-symbols-outlined text-primary text-3xl">campaign</span>
                Papan Informasi Publik
            </h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1">
                Kelola informasi yang tampil di halaman beranda / publik sistem JTIK ROOM'S.
            </p>
        </div>
        
        <a href="{{ route('admin.information.edit') }}" class="flex items-center gap-2 px-4 py-2.5 bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-semibold text-sm rounded-xl transition-all shadow-sm">
            <span class="material-symbols-outlined text-lg">edit_document</span>
            Edit Konten Informasi
        </a>
    </div>

    <!-- Alert / Flash Messages -->
    @if(session('success'))
    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-start gap-3 shadow-sm">
        <span class="material-symbols-outlined text-emerald-600">check_circle</span>
        <p class="font-body-md text-body-md font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Information Card -->
    <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl shadow-sm overflow-hidden flex flex-col">
        <div class="px-space-md py-4 border-b border-outline-variant/20 bg-surface-container-lowest">
            <h3 class="font-title-md text-title-md font-bold text-on-surface flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">visibility</span>
                Preview Tampilan Publik
            </h3>
        </div>
        
        <div class="p-space-xl bg-surface">
            <!-- Isi Konten Teks -->
            <div class="prose prose-slate max-w-none font-body-md text-on-surface bg-white p-space-lg rounded-xl border border-outline-variant/30 shadow-sm min-h-[200px]">
                @if(!empty($information->content))
                    {!! nl2br(e($information->content)) !!}
                @else
                    <div class="flex flex-col items-center justify-center text-on-surface-variant/50 py-10 h-full">
                        <span class="material-symbols-outlined text-5xl mb-2">article</span>
                        <p class="italic font-medium">Belum ada teks informasi tambahan.</p>
                    </div>
                @endif
            </div>

            <!-- Bagian File Attachment -->
            @if(!empty($information->file_path))
            <div class="mt-space-lg">
                <h4 class="font-label-md text-label-md uppercase font-bold text-on-surface-variant mb-3">Lampiran Panduan / File</h4>
                <div class="flex items-center justify-between p-4 bg-primary/5 border border-primary/20 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary-container text-on-primary-container rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined">picture_as_pdf</span>
                        </div>
                        <div>
                            <p class="font-title-sm font-bold text-on-surface">Panduan Pemakaian Ruang JTIK</p>
                            <p class="font-body-sm text-on-surface-variant text-xs mt-0.5">PDF Document</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $information->file_path) }}" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-white border border-outline-variant/50 text-on-surface hover:bg-surface-container-low font-semibold text-sm rounded-lg transition-all shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                        Lihat Dokumen
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection