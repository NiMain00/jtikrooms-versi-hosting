@extends('layouts.stitch')

@section('title', 'Tambah Perwakilan Kelas - Dasher')

@section('content')
<div class="p-space-md lg:p-space-xl flex flex-col gap-space-lg max-w-3xl mx-auto">
    <!-- Header Section -->
    <div class="flex items-center gap-space-sm mb-2">
        <a href="{{ route('users.index') }}" class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-colors">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <h1 class="font-headline-sm text-headline-sm font-bold text-on-surface">
            Tambah Perwakilan Kelas Baru
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

    <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl shadow-sm overflow-hidden p-space-lg">
        <h2 class="font-title-md text-title-md font-bold text-on-surface mb-6 border-b border-outline-variant/20 pb-3 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">person_add</span>
            Informasi Kelas (JTIK UNM)
        </h2>
        
        <form action="{{ route('users.store') }}" method="POST" class="flex flex-col gap-space-md">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                <!-- Program Studi -->
                <div class="flex flex-col gap-1.5">
                    <label for="prodi" class="font-label-md text-label-md font-semibold text-on-surface">Program Studi <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="prodi" id="prodi" required
                                class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface appearance-none">
                            <option value="" disabled {{ old('prodi') ? '' : 'selected' }}>Pilih Program Studi</option>
                            <option value="PTIK" {{ old('prodi') == 'PTIK' ? 'selected' : '' }}>Pendidikan Teknik Informatika dan Komputer (PTIK)</option>
                            <option value="TEKOM" {{ old('prodi') == 'TEKOM' ? 'selected' : '' }}>Teknik Komputer (TEKOM)</option>
                            <option value="TRKJ" {{ old('prodi') == 'TRKJ' ? 'selected' : '' }}>Teknik Rekayasa Komputer Jaringan (TRKJ)</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">arrow_drop_down</span>
                    </div>
                </div>

                <!-- Kelas -->
                <div class="flex flex-col gap-1.5">
                    <label for="kelas" class="font-label-md text-label-md font-semibold text-on-surface">Kelas <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="kelas" id="kelas" required
                                class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface appearance-none">
                            <option value="" disabled {{ old('kelas') ? '' : 'selected' }}>Pilih Kelas</option>
                            <option value="A" {{ old('kelas') == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('kelas') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ old('kelas') == 'C' ? 'selected' : '' }}>C</option>
                            <option value="D" {{ old('kelas') == 'D' ? 'selected' : '' }}>D</option>
                            <option value="E" {{ old('kelas') == 'E' ? 'selected' : '' }}>E</option>
                            <option value="F" {{ old('kelas') == 'F' ? 'selected' : '' }}>F</option>
                            <option value="G" {{ old('kelas') == 'G' ? 'selected' : '' }}>G</option>
                            <option value="H" {{ old('kelas') == 'H' ? 'selected' : '' }}>H</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">arrow_drop_down</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                <!-- Angkatan -->
                <div class="flex flex-col gap-1.5">
                    <label for="angkatan" class="font-label-md text-label-md font-semibold text-on-surface">Tahun Angkatan <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="angkatan" id="angkatan" required
                                class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface appearance-none">
                            <option value="" disabled {{ old('angkatan') ? '' : 'selected' }}>Pilih Angkatan</option>
                            @for($i = date('Y'); $i >= date('Y') - 7; $i--)
                                <option value="{{ $i }}" {{ old('angkatan') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">arrow_drop_down</span>
                    </div>
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-1.5">
                    <label for="password" class="font-label-md text-label-md font-semibold text-on-surface">Password Default <span class="text-error">*</span></label>
                    <input type="password" name="password" id="password" required minlength="6"
                           class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface"
                           placeholder="Minimal 6 karakter">
                    <p class="font-body-sm text-on-surface-variant mt-1 text-xs">Username akan di-generate otomatis berdasarkan kombinasi (misal: tekomA23)</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 mt-4 pt-4 border-t border-outline-variant/20">
                <a href="{{ route('users.index') }}" class="px-6 py-2.5 font-label-lg font-semibold text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high rounded-xl transition-all">
                    Batal
                </a>
                <button type="submit" class="flex items-center gap-2 px-6 py-2.5 bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-lg font-semibold rounded-xl transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Simpan Perwakilan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection