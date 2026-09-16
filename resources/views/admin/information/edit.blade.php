@extends('layouts.stitch')

@section('title', 'Edit Informasi Publik - Dasher')

@section('content')
<div class="p-space-md lg:p-space-xl flex flex-col gap-space-lg max-w-4xl mx-auto">
    <!-- Header Section -->
    <div class="flex items-center gap-space-sm mb-2">
        <a href="{{ route('admin.information.index') }}" class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-colors">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <h1 class="font-headline-sm text-headline-sm font-bold text-on-surface">
            Edit Informasi Publik
        </h1>
    </div>

    <!-- Error Validation -->
    @if ($errors->any())
    <div class="p-4 bg-error-container/30 border border-error/20 rounded-xl mb-4">
        <div class="flex items-start gap-3 text-error">
            <span class="material-symbols-outlined">warning</span>
            <div>
                <p class="font-label-lg font-bold">Terjadi Kesalahan</p>
                <ul class="list-disc list-inside mt-1 font-body-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Form Container -->
    <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl shadow-sm overflow-hidden p-space-lg">
        <form action="{{ route('admin.information.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-space-md">
            @csrf
            @method('PUT')

            <!-- Teks Informasi -->
            <div class="flex flex-col gap-1.5">
                <label for="content" class="font-label-md text-label-md font-semibold text-on-surface">Teks Pengumuman Utama <span class="text-error">*</span></label>
                <p class="font-body-sm text-on-surface-variant mb-1">Teks ini akan ditampilkan di halaman depan Pusat Informasi Mahasiswa.</p>
                <textarea name="content" id="content" rows="8" required
                          class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface resize-y">{{ old('content', $information->content ?? '') }}</textarea>
            </div>

            <!-- Upload File -->
            <div class="flex flex-col gap-1.5">
                <label for="file" class="font-label-md text-label-md font-semibold text-on-surface">Lampiran Dokumen Panduan (PDF)</label>
                <p class="font-body-sm text-on-surface-variant mb-1">Upload file PDF yang berisi panduan teknis pemakaian ruang JTIK. (Biarkan kosong jika tidak ingin mengubah file saat ini)</p>
                
                @if(!empty($information->file_path))
                <div class="mb-3 flex items-center justify-between p-3 rounded-xl border border-primary/20 bg-primary/5">
                    <div class="flex items-center gap-3 text-primary font-medium font-body-sm">
                        <span class="material-symbols-outlined">description</span>
                        File Saat Ini Tersedia
                    </div>
                    <a href="{{ asset('storage/' . $information->file_path) }}" target="_blank" class="text-xs font-bold uppercase tracking-wider text-primary hover:underline">Lihat File</a>
                </div>
                @endif
                
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-outline-variant/30 border-dashed rounded-xl bg-surface-container-lowest hover:bg-surface-container-low transition-colors group relative cursor-pointer" onclick="document.getElementById('file').click()">
                    <div class="space-y-2 text-center">
                        <span class="material-symbols-outlined text-4xl text-on-surface-variant/50 group-hover:text-primary transition-colors">upload_file</span>
                        <div class="flex flex-col text-sm text-on-surface-variant">
                            <span class="font-semibold text-primary">Klik untuk unggah PDF baru</span>
                            <span>atau drag and drop kesini</span>
                        </div>
                        <p class="text-xs text-on-surface-variant/50">Hanya format PDF, maksimal 2MB</p>
                    </div>
                    <input id="file" name="file" type="file" class="sr-only" accept=".pdf">
                </div>
                <p id="file-name-display" class="font-body-sm text-body-sm text-primary font-medium mt-1 hidden"></p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 mt-4 pt-4 border-t border-outline-variant/20">
                <a href="{{ route('admin.information.index') }}" class="px-6 py-2.5 font-label-lg font-semibold text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high rounded-xl transition-all">
                    Batal
                </a>
                <button type="submit" class="flex items-center gap-2 px-6 py-2.5 bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-lg font-semibold rounded-xl transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">publish</span>
                    Publikasikan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('file').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        const display = document.getElementById('file-name-display');
        if (fileName) {
            display.textContent = 'File terpilih: ' + fileName;
            display.classList.remove('hidden');
        } else {
            display.classList.add('hidden');
        }
    });
</script>
@endsection