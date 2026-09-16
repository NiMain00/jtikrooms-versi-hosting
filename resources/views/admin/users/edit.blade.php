@extends('layouts.stitch')

@section('title', 'Edit Perwakilan Kelas - Dasher')

@section('content')
<div class="p-space-md lg:p-space-xl flex flex-col gap-space-lg max-w-5xl mx-auto">
    <!-- Header Section -->
    <div class="flex items-center gap-space-sm mb-2">
        <a href="{{ route('users.index') }}" class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-colors">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <h1 class="font-headline-sm text-headline-sm font-bold text-on-surface">
            Edit Kelas: <span class="text-primary">{{ $user->nama_kelas ?? ($user->prodi . ' ' . $user->kelas) }}</span>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-md">
        <!-- Form Update Data Utama -->
        <div class="lg:col-span-2 bg-surface-container-lowest border border-outline-variant/30 rounded-2xl shadow-sm overflow-hidden p-space-lg">
            <h2 class="font-title-md text-title-md font-bold text-on-surface mb-4 border-b border-outline-variant/20 pb-3 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">school</span>
                Informasi Kelas (JTIK UNM)
            </h2>
            
            <form action="{{ route('users.update', $user->id) }}" method="POST" class="flex flex-col gap-space-md">
                @csrf
                @method('PUT')

                <!-- Info Username Statis -->
                <div class="p-4 bg-primary/5 border border-primary/20 rounded-xl flex flex-col gap-1">
                    <span class="font-label-sm font-bold text-primary uppercase">Username Akun</span>
                    <span class="font-title-md font-bold text-on-surface">{{ $user->username }}</span>
                    <span class="font-body-sm text-on-surface-variant">Username akan otomatis diperbarui jika Anda mengubah kombinasi Prodi, Kelas, atau Angkatan.</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                    <!-- Program Studi -->
                    <div class="flex flex-col gap-1.5">
                        <label for="prodi" class="font-label-md text-label-md font-semibold text-on-surface">Program Studi <span class="text-error">*</span></label>
                        <div class="relative">
                            <select name="prodi" id="prodi" required
                                    class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface appearance-none">
                                <option value="PTIK" {{ old('prodi', $user->prodi) == 'PTIK' ? 'selected' : '' }}>Pendidikan Teknik Informatika dan Komputer (PTIK)</option>
                                <option value="TEKOM" {{ old('prodi', $user->prodi) == 'TEKOM' ? 'selected' : '' }}>Teknik Komputer (TEKOM)</option>
                                <option value="TRKJ" {{ old('prodi', $user->prodi) == 'TRKJ' ? 'selected' : '' }}>Teknik Rekayasa Komputer Jaringan (TRKJ)</option>
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
                                @foreach(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $kls)
                                    <option value="{{ $kls }}" {{ old('kelas', $user->kelas) == $kls ? 'selected' : '' }}>{{ $kls }}</option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">arrow_drop_down</span>
                        </div>
                    </div>
                </div>

                <!-- Angkatan & Ganti Password -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                    <!-- Angkatan -->
                    <div class="flex flex-col gap-1.5">
                        <label for="angkatan" class="font-label-md text-label-md font-semibold text-on-surface">Tahun Angkatan <span class="text-error">*</span></label>
                        <div class="relative">
                            <select name="angkatan" id="angkatan" required
                                    class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface appearance-none">
                                @for($i = date('Y'); $i >= date('Y') - 7; $i--)
                                    <option value="{{ $i }}" {{ old('angkatan', $user->angkatan) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">arrow_drop_down</span>
                        </div>
                    </div>

                    <!-- Password Baru (Opsional) -->
                    <div class="flex flex-col gap-1.5">
                        <label for="password" class="font-label-md text-label-md font-semibold text-on-surface">Ganti Password</label>
                        <input type="password" name="password" id="password" minlength="6"
                               class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface"
                               placeholder="Biarkan kosong jika tidak diubah">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 mt-4 pt-4 border-t border-outline-variant/20">
                    <button type="submit" class="flex items-center gap-2 px-6 py-2.5 bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-lg font-semibold rounded-xl transition-all shadow-sm">
                        <span class="material-symbols-outlined text-[20px]">save</span>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Panel Kanan: Reset Cepat & Info -->
        <div class="lg:col-span-1 flex flex-col gap-4">
            <!-- Form Reset Password Cepat -->
            <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl shadow-sm overflow-hidden flex flex-col">
                <div class="px-space-md py-4 border-b border-outline-variant/20 bg-surface-container-lowest">
                    <h3 class="font-title-md text-title-md font-bold text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-600">lock_reset</span>
                        Reset Password Kilat
                    </h3>
                </div>
                
                <div class="p-space-lg flex flex-col gap-space-md bg-amber-50/30">
                    <p class="font-body-sm text-on-surface-variant">Klik tombol di bawah untuk mereset password kelas ini menjadi <b>password123</b> secara otomatis.</p>
                    
                    <form action="{{ route('users.reset-password', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-amber-100 text-amber-800 hover:bg-amber-200 font-bold text-sm rounded-xl transition-all shadow-sm" onsubmit="return confirm('Yakin reset password menjadi default?')">
                            <span class="material-symbols-outlined text-[20px]">warning</span>
                            Reset ke Default
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="bg-primary/5 border border-primary/20 rounded-2xl p-4">
                <h4 class="font-title-sm font-bold text-primary mb-2 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">info</span>
                    Format Penamaan
                </h4>
                <p class="font-body-sm text-on-surface-variant leading-relaxed">
                    Sistem menggunakan identitas kelas JTIK Universitas Negeri Makassar (UNM). Email tidak diperlukan karena ini adalah akun khusus untuk keperluan booking kelas.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection