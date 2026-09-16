@extends('layouts.stitch')

@section('title', 'Booking Ruangan - JTIK ROOMS')

@section('content')

<div class="pointer-events-none absolute -top-40 right-10 w-[500px] h-[500px] bg-primary-fixed/25 rounded-full blur-3xl"></div>
<div class="pointer-events-none absolute top-96 -left-20 w-[450px] h-[450px] bg-secondary-fixed/20 rounded-full blur-3xl"></div>
<div class="w-full px-space-xl py-space-lg relative z-10">
    <div class="flex flex-col w-full">
        <div class="max-w-5xl mx-auto w-full flex flex-col gap-space-lg pb-space-3xl">
            
            <!-- Top Banner & Navigation Breadcrumbs -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm pt-space-xs">
                <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md text-label-md">
                    <a class="flex items-center gap-1 hover:text-primary transition-colors text-primary font-semibold" href="{{ route('dashboard.kelas') }}">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        <span>Dashboard</span>
                    </a>
                    <span class="text-outline-variant">/</span>
                    <span class="text-tertiary">Reservasi</span>
                    <span class="text-outline-variant">/</span>
                    <span class="font-bold text-on-surface">{{ $room->display_name ?? $roomName }}</span>
                </div>
                <div class="flex items-center gap-space-xs self-start sm:self-auto px-space-sm py-1 rounded-full bg-surface-container-high text-primary font-label-sm text-label-sm shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-primary animate-ping"></span>
                    <span class="font-bold tracking-wide uppercase">Sesi Langsung Aktif</span>
                </div>
            </div>

            @if($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    @foreach($errors->all() as $error)
                        <p class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <!-- Header Block with Gradient Identity -->
            <div class="flex flex-col gap-space-2xs">
                <div class="inline-flex items-center gap-space-xs">
                    <span class="px-space-xs py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm uppercase font-bold tracking-widest">
                        Langkah 2 dari 3
                    </span>
                </div>
                <h1 class="font-headline-xl text-headline-xl tracking-tight bg-gradient-to-r from-primary via-primary-container to-secondary-container bg-clip-text text-transparent">
                    Formulir Peminjaman Ruangan
                </h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">
                    Selesaikan 3 langkah mudah untuk mengajukan reservasi ruangan JTIK. Status ketersediaan diperbarui secara real-time.
                </p>
            </div>

            <!-- Step Progress Stepper Container -->
            <div class="w-full bg-surface-container-lowest/80 backdrop-blur-xl rounded-2xl p-space-md shadow-[0_10px_25px_-5px_rgba(33,112,228,0.06)] relative overflow-hidden">
                <div class="grid grid-cols-3 relative z-10">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-space-xs sm:gap-space-sm text-center sm:text-left group cursor-pointer">
                        <div class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center font-title-md text-title-md shadow-[0_4px_12px_rgba(0,88,190,0.35)] shrink-0 transition-transform group-hover:scale-105">
                            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">check</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary font-bold">Langkah 01</span>
                            <span class="font-title-md text-title-md text-on-surface font-semibold truncate">Informasi Ruang</span>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-space-xs sm:gap-space-sm text-center sm:text-left group cursor-pointer">
                        <div class="relative flex items-center justify-center shrink-0">
                            <div class="absolute -inset-1 rounded-full bg-secondary-container/40 animate-pulse"></div>
                            <div class="w-10 h-10 rounded-full bg-secondary-container text-on-primary flex items-center justify-center font-title-md text-title-md shadow-[0_6px_16px_-2px_rgba(251,120,0,0.45)] relative z-10 transition-transform group-hover:scale-105">
                                <span>2</span>
                            </div>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">Langkah 02</span>
                            <span class="font-title-md text-title-md text-secondary font-bold truncate">Detail Penggunaan</span>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-space-xs sm:gap-space-sm text-center sm:text-left opacity-80 group cursor-pointer">
                        <div class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center font-title-md text-title-md shrink-0 transition-transform group-hover:scale-105">
                            <span>3</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline font-medium">Langkah 03</span>
                            <span class="font-title-md text-title-md text-on-surface-variant font-semibold truncate">Konfirmasi</span>
                        </div>
                    </div>
                </div>
                <div class="absolute top-[28px] left-[15%] right-[15%] h-1 bg-surface-container -z-0 hidden sm:block">
                    <div class="h-full bg-gradient-to-r from-primary via-secondary-container to-surface-container rounded-full w-1/2"></div>
                </div>
            </div>

            <form action="{{ route('booking.store') }}" method="POST" id="bookingForm" class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-start">
                @csrf
                <input type="hidden" name="room_name" value="{{ $roomName }}" id="roomInput">
                <input type="hidden" name="source" value="qr">
                
                <!-- Left Column -->
                <div class="lg:col-span-7 flex flex-col gap-space-lg">
                    <!-- Step 1: Read-Only Room Context Card -->
                    <div class="bg-surface-container-lowest/80 backdrop-blur-xl rounded-2xl p-space-lg shadow-[0_10px_25px_-5px_rgba(0,88,190,0.05)] flex flex-col gap-space-md">
                        <div class="flex items-start justify-between gap-space-sm flex-wrap">
                            <div class="flex items-center gap-space-sm">
                                <div class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center text-primary shadow-sm shrink-0">
                                    <span class="material-symbols-outlined text-[28px]">biotech</span>
                                </div>
                                <div>
                                    <div class="flex items-center gap-space-xs">
                                        <span class="font-label-sm text-label-sm uppercase tracking-wider font-bold text-primary">Langkah 1: Ruangan Terpilih</span>
                                    </div>
                                    <h3 class="font-title-lg text-title-lg text-on-surface font-bold">{{ $room->display_name ?? $roomName }}</h3>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">{{ ucfirst($room->type ?? 'Umum') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-xs">
                            <div class="p-space-xs rounded-xl bg-surface-container-low flex items-center gap-space-xs">
                                <span class="material-symbols-outlined text-primary text-[20px]">groups</span>
                                <div class="flex flex-col">
                                    <span class="font-label-sm text-label-sm text-on-surface-variant uppercase">Kapasitas</span>
                                    <span class="font-title-md text-title-md text-on-surface font-semibold">{{ $room->capacity ?? 40 }} Orang</span>
                                </div>
                            </div>
                        </div>

                        <!-- Date & Time Range Pickers -->
                        <div class="bg-surface-container-low/60 rounded-xl p-space-md flex flex-col gap-space-sm mt-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-label-md text-label-md font-semibold text-on-surface flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-primary text-[18px]">calendar_today</span>
                                    Jadwal Peminjaman
                                </span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm">
                                <div class="flex flex-col gap-1">
                                    <label class="font-label-sm text-label-sm uppercase tracking-wide text-on-surface-variant font-semibold">Waktu Mulai <span class="text-error">*</span></label>
                                    <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" required value="{{ old('waktu_mulai') }}" min="{{ now()->timezone('Asia/Makassar')->format('Y-m-d\TH:i') }}" class="w-full px-space-sm py-2 rounded-xl bg-surface-container-lowest text-on-surface font-title-md text-title-md shadow-sm border border-outline-variant focus:border-primary focus:outline-none">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label class="font-label-sm text-label-sm uppercase tracking-wide text-on-surface-variant font-semibold">Waktu Selesai <span class="text-error">*</span></label>
                                    <input type="datetime-local" name="waktu_berakhir" id="waktu_berakhir" required value="{{ old('waktu_berakhir') }}" class="w-full px-space-sm py-2 rounded-xl bg-surface-container-lowest text-on-surface font-title-md text-title-md shadow-sm border border-outline-variant focus:border-primary focus:outline-none">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 2: Detail Penggunaan Form Section -->
                    <div class="bg-surface-container-lowest/90 backdrop-blur-xl rounded-2xl p-space-lg shadow-[0_12px_28px_-6px_rgba(33,112,228,0.08)] flex flex-col gap-space-md">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-space-xs">
                                <div class="w-8 h-8 rounded-lg bg-secondary-fixed flex items-center justify-center text-secondary font-bold">2</div>
                                <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold">Detail Penggunaan Akademik</h2>
                            </div>
                            <span class="text-error font-label-sm text-label-sm font-semibold">* Wajib diisi</span>
                        </div>
                        
                        <div class="flex flex-col gap-space-md">
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-lg text-label-lg font-semibold text-on-surface flex items-center gap-1">
                                    <span>Mata Kuliah / Nama Kegiatan</span>
                                    <span class="text-error">*</span>
                                </label>
                                <div class="relative flex items-center">
                                    <span class="material-symbols-outlined absolute left-3.5 text-primary text-[20px]">menu_book</span>
                                    <input type="text" name="mata_kuliah" required value="{{ old('mata_kuliah') }}" class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-surface-container-lowest text-on-surface font-title-md text-title-md shadow-sm border border-outline-variant focus:border-primary focus:outline-none transition-all" placeholder="Contoh: Pemrograman Web Lanjut"/>
                                </div>
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-lg text-label-lg font-semibold text-on-surface flex items-center gap-1">
                                    <span>Dosen Pengampu / Penanggung Jawab</span>
                                    <span class="text-error">*</span>
                                </label>
                                <div class="relative flex items-center">
                                    <span class="material-symbols-outlined absolute left-3.5 text-secondary-container text-[20px]">person_check</span>
                                    <input type="text" name="dosen" required value="{{ old('dosen') }}" class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-surface-container-lowest text-on-surface font-title-md text-title-md shadow-sm border border-outline-variant focus:border-primary focus:outline-none transition-all" placeholder="Contoh: Dr. Ahmad, M.Kom"/>
                                </div>
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-lg text-label-lg font-semibold text-on-surface flex items-center gap-1">
                                    <span>Keterangan / Keperluan Peminjaman</span>
                                    <span class="text-on-surface-variant font-normal text-body-sm">(Opsional)</span>
                                </label>
                                <textarea name="keterangan" class="w-full p-space-sm rounded-xl bg-surface-container-lowest text-on-surface font-body-lg text-body-lg shadow-sm border border-outline-variant focus:border-primary focus:outline-none transition-all resize-none" rows="3" placeholder="Catatan tambahan...">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: Step 3 (Summary & Sticky Confirm Action) -->
                <div class="lg:col-span-5 flex flex-col gap-space-md lg:sticky lg:top-20">
                    <div class="bg-surface-container-lowest/95 backdrop-blur-2xl rounded-2xl p-space-lg shadow-[0_16px_36px_-8px_rgba(0,88,190,0.12)] flex flex-col gap-space-md">
                        <div class="flex items-center justify-between pb-space-xs">
                            <div class="flex items-center gap-space-xs">
                                <div class="w-8 h-8 rounded-lg bg-primary-container text-on-primary flex items-center justify-center font-bold">3</div>
                                <h3 class="font-title-lg text-title-lg text-on-surface font-bold">Ringkasan Pengajuan</h3>
                            </div>
                        </div>
                        
                        <div class="relative h-36 rounded-xl overflow-hidden shadow-sm group">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="/img/ruangan.jpg" onerror="this.onerror=null;this.src='/img/ruangan.jpg'"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-inverse-surface/90 via-inverse-surface/40 to-transparent flex flex-col justify-end p-space-sm">
                                <span class="font-title-md text-title-md text-on-primary font-bold">{{ $room->display_name ?? $roomName }}</span>
                            </div>
                        </div>
                        
                        <div class="p-space-sm rounded-xl bg-surface-container flex items-start gap-space-xs mt-2">
                            <span class="material-symbols-outlined text-primary text-[20px] shrink-0 mt-0.5">verified_user</span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                Dengan mengonfirmasi, Anda menyetujui SOP Laboratorium JTIK dan bertanggung jawab penuh.
                            </p>
                        </div>
                        
                        <div class="flex flex-col gap-space-xs pt-space-xs">
                            <button type="submit" class="w-full py-3.5 px-space-lg rounded-xl bg-gradient-to-r from-primary via-primary-container to-secondary-container text-on-primary font-label-lg text-label-lg font-bold shadow-[0_12px_24px_-6px_rgba(251,120,0,0.4)] hover:shadow-[0_16px_32px_-4px_rgba(251,120,0,0.5)] hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-space-xs group">
                                <span class="material-symbols-outlined text-[22px] group-hover:rotate-12 transition-transform">check_circle</span>
                                <span>Konfirmasi Booking Sekarang</span>
                            </button>
                            <a href="{{ route('dashboard.kelas') }}" class="w-full py-2.5 px-space-md rounded-xl bg-surface-container-lowest hover:bg-surface-container-high text-on-surface-variant font-label-lg text-label-lg font-semibold shadow-xs transition-colors flex items-center justify-center gap-space-xs text-center">
                                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                                <span>Kembali ke Dashboard</span>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const waktuMulaiInput = document.getElementById('waktu_mulai');
    const waktuBerakhirInput = document.getElementById('waktu_berakhir');
    const now = new Date();
    
    function formatDateTimeLocal(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    if (!waktuMulaiInput.value) {
        const defaultMulai = new Date(now.getTime() + 30 * 60000);
        waktuMulaiInput.value = formatDateTimeLocal(defaultMulai);
    }
    if (!waktuBerakhirInput.value) {
        const defaultBerakhir = new Date(now.getTime() + 120 * 60000);
        waktuBerakhirInput.value = formatDateTimeLocal(defaultBerakhir);
    }

    waktuMulaiInput.addEventListener('change', function() {
        const waktuMulai = new Date(this.value);
        const minBerakhir = new Date(waktuMulai.getTime() + 30 * 60000);
        waktuBerakhirInput.min = formatDateTimeLocal(minBerakhir);
        
        const waktuBerakhirSekarang = new Date(waktuBerakhirInput.value);
        if (waktuBerakhirSekarang < minBerakhir) {
            waktuBerakhirInput.value = formatDateTimeLocal(minBerakhir);
        }
    });

    waktuBerakhirInput.addEventListener('change', function() {
        const waktuMulai = new Date(waktuMulaiInput.value);
        const waktuBerakhir = new Date(this.value);
        const minBerakhir = new Date(waktuMulai.getTime() + 30 * 60000);
        
        if (waktuBerakhir < minBerakhir) {
            alert('Waktu berakhir harus minimal 30 menit setelah waktu mulai!');
            this.value = formatDateTimeLocal(minBerakhir);
        }
    });

    waktuMulaiInput.dispatchEvent(new Event('change'));
});
</script>

@endsection