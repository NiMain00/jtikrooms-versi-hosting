@extends('layouts.stitch')

@section('title', 'Dashboard Admin - JTIKROOMS')

@section('content')
@php
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
@endphp

<div class="pointer-events-none absolute -top-40 right-10 w-[500px] h-[500px] bg-primary-fixed/25 rounded-full blur-3xl"></div>
<div class="pointer-events-none absolute top-96 -left-20 w-[450px] h-[450px] bg-secondary-fixed/20 rounded-full blur-3xl"></div>
<div class="w-full px-space-xl py-space-lg relative z-10">
    <div class="flex flex-col w-full gap-space-lg">
        <!-- 1. Top Admin Gradient Banner -->
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-primary via-primary-container to-secondary-container p-space-xl shadow-xl text-on-primary">
            <!-- Decorative Circuit Line Elements -->
            <div class="pointer-events-none absolute inset-0 opacity-15">
                <svg class="w-full h-full" fill="none" preserveaspectratio="none" viewbox="0 0 800 240">
                    <path d="M-50 40 H250 L320 110 H600 L680 190 H900" stroke="currentColor" stroke-dasharray="8 6" stroke-width="3"></path>
                    <path d="M100 -20 V100 L180 180 V260" stroke="currentColor" stroke-width="2"></path>
                    <circle cx="250" cy="40" fill="currentColor" r="6"></circle>
                    <circle cx="320" cy="110" fill="currentColor" r="6"></circle>
                    <circle cx="680" cy="190" fill="currentColor" r="6"></circle>
                </svg>
            </div>
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-space-md">
                <div class="flex items-start gap-space-md">
                    <div class="w-14 h-14 rounded-2xl bg-surface-container-lowest/20 backdrop-blur-md flex items-center justify-center shadow-inner shrink-0">
                        <span class="material-symbols-outlined text-surface text-[32px]">admin_panel_settings</span>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <div class="flex items-center gap-space-xs flex-wrap">
                            <h1 class="font-headline-lg text-headline-lg font-bold tracking-tight text-on-primary">Administrator Panel — JTIK ROOM'S</h1>
                            <span class="px-2.5 py-0.5 rounded-full bg-surface-container-lowest/25 font-label-sm text-label-sm font-bold uppercase tracking-wider backdrop-blur-sm">Super Admin</span>
                        </div>
                        <p class="font-body-md text-body-md text-on-primary/85 mt-1">
                            Selamat datang kembali, <span class="font-semibold text-on-primary">{{ session('user') }}</span>. Berikut adalah ringkasan aktivitas hari ini.
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-space-xs self-start lg:self-auto bg-inverse-surface/30 backdrop-blur-md px-space-md py-space-xs rounded-full shadow-sm">
                    <span class="w-2.5 h-2.5 rounded-full bg-surface-container-lowest animate-ping"></span>
                    <span class="w-2.5 h-2.5 -ml-3 rounded-full bg-surface-container-lowest"></span>
                    <span class="font-label-md text-label-md text-on-primary tracking-tight">Server Sinkron Real-Time (Laravel API Connected)</span>
                </div>
            </div>
        </section>

        <!-- 2. Metric Overview Cards -->
        <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-md">
            <!-- Card 1: Total Ruangan -->
            <div class="rounded-2xl p-space-lg bg-surface-container-lowest/90 backdrop-blur-xl shadow-md hover:shadow-xl transition-all duration-300 flex items-center justify-between group">
                <div class="flex flex-col">
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-bold">Total Fasilitas</span>
                    <div class="flex items-baseline gap-space-2xs mt-1">
                        <span class="font-display-lg text-display-lg text-primary font-extrabold">{{ $totalRooms }}</span>
                        <span class="font-title-md text-title-md text-on-surface-variant">Ruangan</span>
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-primary-fixed/50 text-on-primary-fixed-variant flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-[30px]">meeting_room</span>
                </div>
            </div>
            
            <!-- Card 2: Tersedia Saat Ini -->
            <div class="rounded-2xl p-space-lg bg-surface-container-lowest/90 backdrop-blur-xl shadow-md hover:shadow-xl transition-all duration-300 flex items-center justify-between group">
                <div class="flex flex-col">
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-bold">Tersedia Saat Ini</span>
                    <div class="flex items-baseline gap-space-2xs mt-1">
                        <span class="font-display-lg text-display-lg text-on-surface font-extrabold">{{ $availableRooms }}</span>
                    </div>
                    <div class="flex items-center gap-1.5 mt-2 font-body-sm text-body-sm text-on-surface-variant">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        <span>Siap digunakan</span>
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-surface-container text-primary flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-[30px]">check_circle</span>
                </div>
            </div>
            
            <!-- Card 3: Total Pengguna -->
            <div class="rounded-2xl p-space-lg bg-surface-container-lowest/90 backdrop-blur-xl shadow-md hover:shadow-xl transition-all duration-300 flex items-center justify-between group">
                <div class="flex flex-col">
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-bold">Basis Pengguna</span>
                    <div class="flex items-baseline gap-space-2xs mt-1">
                        <span class="font-display-lg text-display-lg text-primary font-extrabold">{{ $totalUsers }}</span>
                        <span class="font-title-md text-title-md text-on-surface-variant">Terdaftar</span>
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-surface-container text-primary flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-[30px]">group</span>
                </div>
            </div>
            
            <!-- Card 4: Booking Hari Ini -->
            <div class="rounded-2xl p-space-lg bg-surface-container-lowest/90 backdrop-blur-xl shadow-md hover:shadow-xl transition-all duration-300 flex items-center justify-between group">
                <div class="flex flex-col">
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-bold">Aktivitas Hari Ini</span>
                    <div class="flex items-baseline gap-space-2xs mt-1">
                        <span class="font-display-lg text-display-lg text-secondary-container font-extrabold">{{ $todayBookings }}</span>
                        <span class="font-title-md text-title-md text-on-surface-variant">Sesi Aktif</span>
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-secondary-fixed text-on-secondary-fixed-variant flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-[30px]">calendar_today</span>
                </div>
            </div>
        </section>

        <!-- 3. Two Column Main Dashboard Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-start">
            <!-- LEFT COLUMN (Span 7) -->
            <div class="lg:col-span-7 flex flex-col gap-space-lg">
                <!-- Akses Cepat Menu Launcher -->
                <section class="rounded-3xl p-space-lg bg-surface-container-lowest/90 backdrop-blur-xl shadow-md flex flex-col gap-space-md">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-space-xs">
                            <span class="material-symbols-outlined text-primary text-[26px]">grid_view</span>
                            <h2 class="font-headline-md text-headline-md text-on-surface font-bold">Akses Cepat Menu</h2>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-space-sm">
                        <!-- Launcher 1 -->
                        <a href="{{ route('rooms.index') }}" class="p-space-md rounded-2xl bg-surface-container-low hover:bg-surface-container hover:-translate-y-1 transition-all duration-200 flex flex-col gap-space-xs group shadow-sm">
                            <div class="w-11 h-11 rounded-xl bg-primary-fixed text-on-primary-fixed-variant flex items-center justify-center group-hover:bg-primary group-hover:text-on-primary transition-colors">
                                <span class="material-symbols-outlined text-[24px]">meeting_room</span>
                            </div>
                            <span class="font-title-md text-title-md text-on-surface font-bold mt-1">Manajemen Ruangan</span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">Kelola daftar lab dan fasilitas</p>
                        </a>
                        <!-- Launcher 2 -->
                        <a href="{{ route('users.index') }}" class="p-space-md rounded-2xl bg-surface-container-low hover:bg-surface-container hover:-translate-y-1 transition-all duration-200 flex flex-col gap-space-xs group shadow-sm">
                            <div class="w-11 h-11 rounded-xl bg-surface-container text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-on-primary transition-colors">
                                <span class="material-symbols-outlined text-[24px]">manage_accounts</span>
                            </div>
                            <span class="font-title-md text-title-md text-on-surface font-bold mt-1">User & Kelas</span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">Kelola akun perwakilan</p>
                        </a>
                        <!-- Launcher 3 -->
                        <a href="{{ route('admin.information.index') }}" class="p-space-md rounded-2xl bg-surface-container-low hover:bg-surface-container hover:-translate-y-1 transition-all duration-200 flex flex-col gap-space-xs group shadow-sm">
                            <div class="w-11 h-11 rounded-xl bg-surface-container text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-on-primary transition-colors">
                                <span class="material-symbols-outlined text-[24px]">info</span>
                            </div>
                            <span class="font-title-md text-title-md text-on-surface font-bold mt-1">Pusat Informasi</span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">Ubah info beranda utama</p>
                        </a>
                        <!-- Launcher 4 -->
                        <a href="{{ route('reports.index') }}" class="p-space-md rounded-2xl bg-surface-container-low hover:bg-surface-container hover:-translate-y-1 transition-all duration-200 flex flex-col gap-space-xs group shadow-sm">
                            <div class="w-11 h-11 rounded-xl bg-secondary-fixed text-on-secondary-fixed-variant flex items-center justify-center group-hover:bg-secondary-container group-hover:text-on-primary transition-colors">
                                <span class="material-symbols-outlined text-[24px]">bar_chart</span>
                            </div>
                            <span class="font-title-md text-title-md text-on-surface font-bold mt-1">Analytics & Laporan</span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">Unduh rekapitulasi okupansi</p>
                        </a>
                        <!-- Launcher 5 -->
                        <a href="{{ route('admin.comments.index') }}" class="p-space-md rounded-2xl bg-surface-container-low hover:bg-surface-container hover:-translate-y-1 transition-all duration-200 flex flex-col gap-space-xs group relative shadow-sm">
                            <div class="w-11 h-11 rounded-xl bg-surface-container-high text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-on-primary transition-colors">
                                <span class="material-symbols-outlined text-[24px]">mark_email_unread</span>
                            </div>
                            <span class="font-title-md text-title-md text-on-surface font-bold mt-1">Pesan Masuk</span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">Ulasan dan pertanyaan</p>
                        </a>
                    </div>
                </section>
                
                <!-- Status Live Ruangan -->
                <section class="rounded-3xl p-space-lg bg-surface-container-lowest/90 backdrop-blur-xl shadow-md flex flex-col gap-space-md">
                    <div class="flex items-center justify-between flex-wrap gap-space-xs">
                        <div class="flex items-center gap-space-xs">
                            <span class="material-symbols-outlined text-secondary-container text-[24px]">sensors</span>
                            <h2 class="font-headline-md text-headline-md text-on-surface font-bold">Status Live Ruangan</h2>
                        </div>
                        <div class="flex items-center gap-space-xs font-label-sm text-label-sm">
                            <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-error"></span>Terpakai</span>
                            <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-primary"></span>Tersedia</span>
                            <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-secondary-container"></span>Maintenance</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-space-sm">
                        @foreach($rooms as $room)
                            @php
                                $statusInfo = $roomStatus[$room->name] ?? ['status' => 'available'];
                                $isOccupied = $statusInfo['status'] === 'occupied';
                                $isAvailable = $statusInfo['status'] === 'available';
                                
                                $activeBooking = null;
                                if ($isOccupied) {
                                    $activeBooking = Booking::where('room_name', $room->name)
                                        ->where('status', 'active')
                                        ->where('waktu_berakhir', '>', now()->timezone('Asia/Makassar'))
                                        ->first();
                                }
                            @endphp
                            
                            @if($isOccupied)
                            <div class="p-space-md rounded-2xl bg-error-container/40 flex flex-col justify-between gap-space-xs shadow-sm">
                                <div class="flex items-center justify-between">
                                    <span class="font-title-md text-title-md font-bold text-on-surface">{{ $room->display_name ?? $room->name }}</span>
                                    <span class="flex items-center gap-1 px-2 py-0.5 rounded-full bg-error text-on-error font-label-sm text-label-sm font-bold uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-on-error animate-ping"></span>
                                        Terpakai
                                    </span>
                                </div>
                                <div class="mt-2 flex flex-col gap-0.5">
                                    <span class="font-label-md text-label-md font-semibold text-on-surface-variant">{{ $activeBooking->username ?? 'Kelas' }}</span>
                                    <span class="font-body-sm text-body-sm font-bold text-error flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">hourglass_top</span> Selesai {{ $activeBooking ? $activeBooking->waktu_berakhir->timezone('Asia/Makassar')->format('H:i') : '' }}
                                    </span>
                                </div>
                            </div>
                            @elseif($isAvailable)
                            <div class="p-space-md rounded-2xl bg-surface-container-low flex flex-col justify-between gap-space-xs shadow-sm">
                                <div class="flex items-center justify-between">
                                    <span class="font-title-md text-title-md font-bold text-on-surface">{{ $room->display_name ?? $room->name }}</span>
                                    <span class="flex items-center gap-1 px-2 py-0.5 rounded-full bg-surface-container text-primary font-label-sm text-label-sm font-bold uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                        Tersedia
                                    </span>
                                </div>
                                <div class="mt-2 flex flex-col gap-0.5">
                                    <span class="font-label-md text-label-md text-on-surface-variant">Kapasitas {{ $room->capacity }} Kursi</span>
                                    <span class="font-body-sm text-body-sm text-primary font-semibold">Siap digunakan</span>
                                </div>
                            </div>
                            @else
                            <div class="p-space-md rounded-2xl bg-secondary-fixed/40 flex flex-col justify-between gap-space-xs shadow-sm">
                                <div class="flex items-center justify-between">
                                    <span class="font-title-md text-title-md font-bold text-on-surface">{{ $room->display_name ?? $room->name }}</span>
                                    <span class="flex items-center gap-1 px-2 py-0.5 rounded-full bg-secondary-container text-on-primary font-label-sm text-label-sm font-bold uppercase tracking-wider">
                                        <span class="material-symbols-outlined text-[12px]">build</span>
                                        Maintenance
                                    </span>
                                </div>
                                <div class="mt-2 flex flex-col gap-0.5">
                                    <span class="font-label-md text-label-md text-on-surface-variant">Dalam Perawatan</span>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </section>
            </div>
            
            <!-- RIGHT COLUMN (Span 5): Pemakaian Saat Ini -->
            <div class="lg:col-span-5 flex flex-col gap-space-lg">
                <section class="rounded-3xl p-space-lg bg-surface-container-lowest/90 backdrop-blur-xl shadow-md flex flex-col gap-space-md">
                    <div class="flex items-center justify-between flex-wrap gap-2 pb-space-xs">
                        <div class="flex flex-col">
                            <div class="flex items-center gap-space-xs">
                                <span class="material-symbols-outlined text-secondary-container text-[24px]">live_tv</span>
                                <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold">Pemakaian & Verifikasi</h2>
                            </div>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">Monitoring Langsung Aktivitas Sesi</span>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-bold uppercase tracking-wider">
                            {{ $activeBookings->count() }} Sesi Berjalan
                        </span>
                    </div>
                    <div class="flex flex-col gap-space-md">
                        @forelse($activeBookings as $booking)
                            @php
                                $waktuBerakhir = $booking->waktu_berakhir->timezone('Asia/Makassar');
                                $sekarang = now()->timezone('Asia/Makassar');
                                $timeLeft = $waktuBerakhir->diff($sekarang);
                                $hoursLeft = $timeLeft->h;
                                $minutesLeft = $timeLeft->i;
                                $isExpired = $sekarang > $waktuBerakhir;
                            @endphp
                            
                            <div class="p-space-md rounded-2xl bg-surface-container-low flex flex-col gap-space-sm shadow-sm transition-all hover:bg-surface-container">
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-space-xs">
                                        <span class="w-3 h-3 rounded-full bg-error animate-pulse"></span>
                                        <span class="font-title-md text-title-md font-bold text-on-surface">{{ $booking->room_name }}</span>
                                    </div>
                                    <span class="px-2.5 py-0.5 rounded-full bg-primary-container text-on-primary font-label-sm text-label-sm font-bold">
                                        {{ $booking->username }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-space-sm">
                                    <div class="flex flex-col min-w-0">
                                        <span class="font-title-md text-title-md text-on-surface font-semibold truncate">{{ $booking->mata_kuliah ?? '-' }}</span>
                                        <span class="font-body-sm text-body-sm text-on-surface-variant truncate">Dosen Pengampu: {{ $booking->dosen ?? '-' }}</span>
                                        <div class="flex items-center gap-space-xs mt-1">
                                            <span class="material-symbols-outlined text-[15px] text-primary">schedule</span>
                                            <span class="font-label-sm text-label-sm text-on-surface font-semibold">{{ $booking->waktu_mulai->timezone('Asia/Makassar')->format('H:i') }} - {{ $booking->waktu_berakhir->timezone('Asia/Makassar')->format('H:i') }} WITA</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-space-2xs">
                                    @if(!$isExpired)
                                    <span class="px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed-variant font-label-md text-label-md font-bold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">timelapse</span>
                                        {{ $hoursLeft > 0 ? $hoursLeft.'j '.$minutesLeft.'m' : $minutesLeft.'m' }} Tersisa
                                    </span>
                                    @else
                                    <span class="px-3 py-1 rounded-full bg-error-container text-on-error-container font-label-md text-label-md font-bold flex items-center gap-1">
                                        Selesai
                                    </span>
                                    @endif
                                    
                                    <div class="flex items-center gap-space-xs">
                                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 rounded-full bg-error text-on-error font-label-sm text-label-sm font-bold flex items-center gap-1 hover:opacity-90 transition-all shadow-sm" onclick="return confirm('Yakin ingin menghentikan secara paksa booking ini?')">
                                                <span class="material-symbols-outlined text-[16px]">cancel</span>
                                                <span>Stop Sesi</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-space-lg text-center bg-surface-container-low rounded-2xl">
                                <span class="material-symbols-outlined text-[48px] text-on-surface-variant mb-2">event_available</span>
                                <h4 class="font-title-md text-on-surface font-bold">Tidak Ada Kelas Aktif</h4>
                                <p class="text-on-surface-variant text-sm mt-1">Seluruh ruangan saat ini dalam keadaan kosong.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
                
                <section class="rounded-3xl p-space-lg bg-surface-container-lowest/90 backdrop-blur-xl shadow-md flex items-center justify-between gap-space-md">
                    <div class="flex flex-col min-w-0">
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary font-bold">Master Passcode Digital</span>
                        <h4 class="font-title-lg text-title-lg font-bold text-on-surface mt-1">Sistem Penguncian Terpusat</h4>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Server tersinkronisasi otomatis setiap 60 detik.</p>
                    </div>
                    <div class="w-16 h-16 bg-surface-container-lowest p-2 rounded-2xl shadow-sm flex items-center justify-center shrink-0 text-primary">
                        <span class="material-symbols-outlined text-[32px]">sync</span>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script>
// Auto refresh data every 60 seconds
setInterval(() => {
    window.location.reload();
}, 60000);
</script>
@endsection