@extends('layouts.stitch')

@section('title', 'Tambah Ruangan - Dasher')

@section('content')
<div class="p-space-md lg:p-space-xl flex flex-col gap-space-lg max-w-3xl mx-auto">
    <!-- Header Section -->
    <div class="flex items-center gap-space-sm mb-2">
        <a href="{{ route('rooms.index') }}" class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-colors">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <h1 class="font-headline-sm text-headline-sm font-bold text-on-surface">
            Tambah Ruangan Baru
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
        <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-space-md">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                <!-- Nama Ruangan (Kode) -->
                <div class="flex flex-col gap-1.5">
                    <label for="name" class="font-label-md text-label-md font-semibold text-on-surface">Kode / Nama Singkat <span class="text-error">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface placeholder:text-on-surface-variant/50" 
                           placeholder="Misal: AE 101">
                </div>
                
                <!-- Nama Tampilan Lengkap -->
                <div class="flex flex-col gap-1.5">
                    <label for="display_name" class="font-label-md text-label-md font-semibold text-on-surface">Nama Tampilan <span class="text-error">*</span></label>
                    <input type="text" name="display_name" id="display_name" value="{{ old('display_name') }}" required
                           class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface placeholder:text-on-surface-variant/50" 
                           placeholder="Misal: Lab Komputer Jaringan">
                </div>

                <!-- Tipe Ruangan -->
                <div class="flex flex-col gap-1.5">
                    <label for="type" class="font-label-md text-label-md font-semibold text-on-surface">Tipe Ruangan <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="type" id="type" required
                                class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface appearance-none">
                            <option value="">-- Pilih Tipe --</option>
                            <option value="kelas" {{ old('type') == 'kelas' ? 'selected' : '' }}>Ruang Kelas</option>
                            <option value="lab" {{ old('type') == 'lab' ? 'selected' : '' }}>Laboratorium</option>
                            <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">arrow_drop_down</span>
                    </div>
                </div>

                <!-- Kapasitas -->
                <div class="flex flex-col gap-1.5">
                    <label for="capacity" class="font-label-md text-label-md font-semibold text-on-surface">Kapasitas (Orang) <span class="text-error">*</span></label>
                    <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}" required min="1"
                           class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface placeholder:text-on-surface-variant/50" 
                           placeholder="Misal: 40">
                </div>

                <!-- Luas -->
                <div class="flex flex-col gap-1.5">
                    <label for="luas" class="font-label-md text-label-md font-semibold text-on-surface">Luas (m²) <span class="text-error">*</span></label>
                    <input type="number" name="luas" id="luas" value="{{ old('luas') }}" required min="5" max="500" step="0.1"
                           class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface placeholder:text-on-surface-variant/50" 
                           placeholder="Misal: 48.5">
                </div>
                
                <!-- Status -->
                <div class="flex flex-col gap-1.5">
                    <label for="status" class="font-label-md text-label-md font-semibold text-on-surface">Status Awal <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="status" id="status" required
                                class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface appearance-none">
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Tersedia (Bisa dipinjam)</option>
                            <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Sedang Digunakan</option>
                            <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Dalam Perawatan</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">arrow_drop_down</span>
                    </div>
                </div>

                <!-- Lantai -->
                <div class="flex flex-col gap-1.5">
                    <label for="lantai" class="font-label-md text-label-md font-semibold text-on-surface">Lantai</label>
                    <input type="text" name="lantai" id="lantai" value="{{ old('lantai') }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface placeholder:text-on-surface-variant/50" 
                           placeholder="Misal: 1">
                </div>
                
                <!-- Lokasi -->
                <div class="flex flex-col gap-1.5">
                    <label for="location" class="font-label-md text-label-md font-semibold text-on-surface">Gedung / Lokasi</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface placeholder:text-on-surface-variant/50" 
                           placeholder="Misal: Gedung JTIK">
                </div>
            </div>

            <!-- Fasilitas (Checkboxes) -->
            <div class="flex flex-col gap-1.5 mt-2">
                <label class="font-label-md text-label-md font-semibold text-on-surface">Fasilitas Standar</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @php $facilitiesInput = old('facilities', []); @endphp
                    @foreach(['AC', 'Proyektor LCD', 'Whiteboard', 'WiFi', 'Komputer PC', 'Sistem Audio'] as $fac)
                    <label class="flex items-center gap-2 cursor-pointer p-3 rounded-xl border border-outline-variant/30 hover:bg-surface-container-low transition-colors group">
                        <input type="checkbox" name="facilities[]" value="{{ $fac }}" {{ in_array($fac, $facilitiesInput) ? 'checked' : '' }} class="w-4 h-4 text-primary bg-surface-container-low border-outline-variant/50 rounded focus:ring-primary/20">
                        <span class="font-body-sm text-on-surface group-hover:text-primary transition-colors">{{ $fac }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Fasilitas Tambahan (Custom) -->
            <div class="flex flex-col gap-1.5 mt-2">
                <label for="custom_facilities" class="font-label-md text-label-md font-semibold text-on-surface">Fasilitas Tambahan (Pisahkan dengan koma)</label>
                <input type="text" name="custom_facilities" id="custom_facilities" value="{{ old('custom_facilities') }}"
                       class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface placeholder:text-on-surface-variant/50" 
                       placeholder="Misal: Podium, Meja Bundar, Dispenser">
            </div>

            <!-- Deskripsi -->
            <div class="flex flex-col gap-1.5 mt-2">
                <label for="description" class="font-label-md text-label-md font-semibold text-on-surface">Deskripsi Singkat</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface placeholder:text-on-surface-variant/50 resize-none" 
                          placeholder="Deskripsi atau catatan khusus untuk ruangan ini...">{{ old('description') }}</textarea>
            </div>

            <!-- Foto Ruangan -->
            <div class="flex flex-col gap-1.5 mt-2">
                <label for="image" class="font-label-md text-label-md font-semibold text-on-surface">Foto Ruangan (Opsional)</label>
                
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-outline-variant/30 border-dashed rounded-xl bg-surface-container-lowest hover:bg-surface-container-low transition-colors group relative cursor-pointer" onclick="document.getElementById('image').click()">
                    <div class="space-y-2 text-center">
                        <span class="material-symbols-outlined text-4xl text-on-surface-variant/50 group-hover:text-primary transition-colors">add_photo_alternate</span>
                        <div class="flex flex-col text-sm text-on-surface-variant">
                            <span class="font-semibold text-primary">Klik untuk upload foto</span>
                            <span>atau drag and drop kesini</span>
                        </div>
                        <p class="text-xs text-on-surface-variant/50">PNG, JPG, JPEG maksimal 2MB</p>
                    </div>
                    <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                </div>
                <!-- File name display placeholder -->
                <p id="file-name-display" class="font-body-sm text-body-sm text-primary font-medium mt-1 hidden"></p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 mt-4 pt-4 border-t border-outline-variant/20">
                <a href="{{ route('rooms.index') }}" class="px-6 py-2.5 font-label-lg font-semibold text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high rounded-xl transition-all">
                    Batal
                </a>
                <button type="submit" class="flex items-center gap-2 px-6 py-2.5 bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-lg font-semibold rounded-xl transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Simpan Ruangan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Simple script to show selected file name
    document.getElementById('image').addEventListener('change', function(e) {
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