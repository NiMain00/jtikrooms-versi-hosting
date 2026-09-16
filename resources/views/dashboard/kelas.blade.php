@extends('layouts.stitch')

@section('title', 'Dashboard Kelas - JTIK ROOMS')

@section('content')
@php
    use App\Models\Booking;
    use Carbon\Carbon;
    
    // Set Timezone
    $now = now()->timezone('Asia/Makassar');
    $startOfWeek = $now->copy()->startOfWeek();
    $endOfWeek = $now->copy()->endOfWeek();

    // 1. Booking Aktif (Realtime)
    $activeBookings = Booking::where('username', session('user'))
        ->where('status', 'active')
        ->where('waktu_berakhir', '>', $now)
        ->orderBy('waktu_berakhir')
        ->get();
        
    // 2. Total Booking (RESET MINGGUAN)
    $totalBookings = Booking::where('username', session('user'))
        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
        ->count();

    // 3. Booking Selesai (RESET MINGGUAN)
    $completedBookings = Booking::where('username', session('user'))
        ->where('status', 'completed')
        ->whereBetween('updated_at', [$startOfWeek, $endOfWeek])
        ->count();
@endphp

<div class="pointer-events-none absolute -top-40 right-10 w-[500px] h-[500px] bg-primary-fixed/25 rounded-full blur-3xl"></div>
<div class="pointer-events-none absolute top-96 -left-20 w-[450px] h-[450px] bg-secondary-fixed/20 rounded-full blur-3xl"></div>
<div class="w-full px-space-xl py-space-lg relative z-10">
    <div class="flex flex-col w-full gap-space-xl">
        
        <!-- Hero Section -->
        <section class="relative overflow-hidden rounded-[28px] bg-gradient-to-br from-primary via-primary-container to-secondary-container p-space-xl text-on-primary shadow-xl">
            <div class="pointer-events-none absolute -right-16 -top-16 w-80 h-80 rounded-full bg-secondary-fixed/20 blur-2xl"></div>
            <div class="pointer-events-none absolute -left-12 -bottom-12 w-72 h-72 rounded-full bg-primary-fixed/20 blur-2xl"></div>
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
                <div class="max-w-2xl flex flex-col gap-space-xs">
                    <div class="inline-flex items-center gap-space-xs px-space-sm py-1 rounded-full bg-on-primary/15 backdrop-blur-md self-start text-on-primary font-label-sm text-label-sm uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-secondary-fixed animate-pulse"></span>
                        <span>Akses Portal Mahasiswa • Kelas {{ session('user') }}</span>
                    </div>
                    <h1 class="font-headline-xl text-headline-xl text-on-primary font-extrabold tracking-tight">
                        Selamat Datang, {{ session('user') }}! 👋
                    </h1>
                    <p class="font-body-lg text-body-lg text-on-primary/90 leading-relaxed">
                        Kelola peminjaman laboratorium dan ruangan kelas untuk kegiatan perkuliahan angkatan Anda dengan cepat dan transparan.
                    </p>
                </div>
                <!-- Action QR Card -->
                <div class="flex flex-col sm:flex-row lg:flex-col items-center gap-space-sm p-space-md rounded-2xl bg-on-primary/10 backdrop-blur-md shadow-inner">
                    <div class="flex items-center justify-center w-14 h-14 rounded-xl bg-on-primary/20 text-on-primary">
                        <span class="material-symbols-outlined text-[36px]">qr_code_scanner</span>
                    </div>
                    <a href="{{ route('qr.scanner') }}" class="flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container-lowest text-on-surface font-label-lg text-label-lg font-semibold shadow-md hover:bg-surface-container-high transition-all active:scale-95">
                        <span class="material-symbols-outlined text-secondary text-[20px]">photo_camera</span>
                        <span>Scan QR Code Masuk Ruangan</span>
                    </a>
                </div>
            </div>
        </section>
        
        <!-- Metrics Row -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
            <!-- Stat 1 -->
            <div class="flex items-center gap-space-md p-space-lg rounded-2xl bg-surface-container-lowest/80 backdrop-blur-md shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary-container text-on-primary-container">
                    <span class="material-symbols-outlined">meeting_room</span>
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Booking Aktif</span>
                    <div class="flex items-baseline gap-space-xs">
                        <span class="font-headline-md text-headline-md text-on-surface font-bold">{{ $activeBookings->count() }}</span>
                        <span class="font-title-md text-title-md text-primary font-semibold">Ruangan</span>
                    </div>
                    <span class="font-body-sm text-body-sm text-on-surface-variant truncate">Sesi sedang berjalan</span>
                </div>
            </div>
            <!-- Stat 2 -->
            <div class="flex items-center gap-space-md p-space-lg rounded-2xl bg-surface-container-lowest/80 backdrop-blur-md shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-secondary-container text-on-secondary-container">
                    <span class="material-symbols-outlined">calendar_month</span>
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Booking Minggu Ini</span>
                    <div class="flex items-baseline gap-space-xs">
                        <span class="font-headline-md text-headline-md text-on-surface font-bold">{{ $totalBookings }}</span>
                        <span class="font-title-md text-title-md text-secondary font-semibold">Sesi</span>
                    </div>
                    <span class="font-body-sm text-body-sm text-on-surface-variant truncate">Terjadwal di sistem perkuliahan</span>
                </div>
            </div>
            <!-- Stat 3 -->
            <div class="flex items-center gap-space-md p-space-lg rounded-2xl bg-surface-container-lowest/80 backdrop-blur-md shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-surface-container-high text-primary">
                    <span class="material-symbols-outlined">task_alt</span>
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Selesai (Mingguan)</span>
                    <div class="flex items-baseline gap-space-xs">
                        <span class="font-headline-md text-headline-md text-on-surface font-bold">{{ $completedBookings }}</span>
                        <span class="font-title-md text-title-md text-on-surface font-semibold">Sesi Tuntas</span>
                    </div>
                    <span class="font-body-sm text-body-sm text-on-surface-variant truncate">Log presensi & check-out diverifikasi</span>
                </div>
            </div>
        </section>
        
        <!-- Two Column Main Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg">
            
            <!-- Left Column (8 cols = 2/3) -->
            <div class="lg:col-span-8 flex flex-col gap-space-lg">
                <div class="flex items-center justify-between">
                    <h2 class="font-title-lg text-title-lg text-on-surface font-bold">Booking Aktif Anda</h2>
                </div>
                
                @forelse($activeBookings as $booking)
                    @php
                        $waktuBerakhir = Carbon::parse($booking->waktu_berakhir)->timezone('Asia/Makassar');
                        $timeLeft = $waktuBerakhir->diffInMinutes($now, false);
                        $isAlmostOver = ($timeLeft > -15 && $timeLeft < 0);
                        
                        $sisaWaktuInfo = $waktuBerakhir->diff($now);
                        $jam = $sisaWaktuInfo->h;
                        $menit = $sisaWaktuInfo->i;
                    @endphp
                    <!-- Active Booking Card -->
                    <section class="flex flex-col rounded-3xl bg-surface-container-lowest/90 backdrop-blur-md shadow-md p-space-lg border {{ $isAlmostOver ? 'border-secondary' : 'border-transparent' }}">
                        <div class="flex flex-wrap items-center justify-between gap-space-sm mb-space-md">
                            <div class="flex items-center gap-space-xs">
                                <span class="flex h-3 w-3 relative">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-primary"></span>
                                </span>
                                <span class="font-label-sm text-label-sm uppercase font-bold tracking-wider text-primary">Status Live</span>
                            </div>
                            <span class="px-space-sm py-0.5 rounded-full {{ $isAlmostOver ? 'bg-secondary text-on-secondary' : 'bg-primary-fixed text-on-primary-fixed' }} font-label-sm text-label-sm font-semibold flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full {{ $isAlmostOver ? 'bg-on-secondary' : 'bg-primary' }} animate-pulse"></span>
                                {{ $isAlmostOver ? 'Segera Berakhir' : 'Sesi Berlangsung' }}
                            </span>
                        </div>
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-space-md pb-space-md">
                            <div class="flex flex-col min-w-0">
                                <h2 class="font-headline-md text-headline-md text-on-surface font-bold">
                                    {{ $booking->room_name }}
                                </h2>
                            </div>
                            <!-- Inline Timer Gauge SVG -->
                            <div class="flex items-center gap-space-sm p-space-xs px-space-sm rounded-xl bg-surface-container-low">
                                <span class="material-symbols-outlined text-secondary text-[36px]">timer</span>
                                <div class="flex flex-col">
                                    <span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Sisa Durasi</span>
                                    <span class="font-title-md text-title-md text-secondary font-bold">{{ $jam > 0 ? $jam.' Jam ' : '' }}{{ $menit }} Menit</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- 2x2 Data Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm p-space-md rounded-2xl bg-surface-container-low/70 my-space-xs">
                            <div class="flex items-start gap-space-sm p-space-xs">
                                <div class="p-2 rounded-xl bg-surface-container-lowest text-primary shadow-sm">
                                    <span class="material-symbols-outlined">menu_book</span>
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Mata Kuliah</span>
                                    <span class="font-title-md text-title-md text-on-surface font-semibold truncate">{{ $booking->mata_kuliah }}</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-space-sm p-space-xs">
                                <div class="p-2 rounded-xl bg-surface-container-lowest text-primary shadow-sm">
                                    <span class="material-symbols-outlined">person</span>
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Dosen Pengampu</span>
                                    <span class="font-title-md text-title-md text-on-surface font-semibold truncate">{{ $booking->dosen }}</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-space-sm p-space-xs sm:col-span-2">
                                <div class="p-2 rounded-xl bg-surface-container-lowest text-primary shadow-sm">
                                    <span class="material-symbols-outlined">schedule</span>
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Waktu Berakhir</span>
                                    <span class="font-title-md text-title-md text-on-surface font-semibold">{{ $waktuBerakhir->format('H:i') }} WITA</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Footer -->
                        <div class="flex flex-wrap items-center justify-end gap-space-md pt-space-md">
                            <form action="{{ route('booking.cancel', $booking->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-error text-on-error font-label-lg text-label-lg font-semibold shadow-md hover:bg-error/90 active:scale-95 transition-all" onclick="return confirm('Yakin ingin mengakhiri penggunaan ruangan {{ $booking->room_name }}?')">
                                    <span class="material-symbols-outlined text-[20px]">stop_circle</span>
                                    <span>Akhiri Sesi Sekarang</span>
                                </button>
                            </form>
                        </div>
                    </section>
                @empty
                    <div class="flex flex-col items-center justify-center p-space-xl rounded-3xl bg-surface-container-lowest/80 border border-dashed border-outline-variant text-center">
                        <span class="material-symbols-outlined text-[48px] text-surface-variant mb-space-sm">meeting_room</span>
                        <h3 class="font-title-lg text-title-lg text-on-surface font-bold">Belum Ada Aktivitas Booking</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-2 max-w-sm">Gunakan tombol Scan QR Code untuk memulai sesi peminjaman ruangan baru.</p>
                    </div>
                @endforelse

            </div>
            
            <!-- Right Column (4 cols = 1/3) -->
            <div class="lg:col-span-4 flex flex-col gap-space-lg">
                <!-- Panduan Singkat Peminjaman -->
                <section class="flex flex-col rounded-3xl bg-surface-container-lowest/90 backdrop-blur-md shadow-md p-space-lg">
                    <div class="flex items-center gap-space-xs mb-space-sm">
                        <span class="material-symbols-outlined text-primary">menu_book</span>
                        <h2 class="font-title-lg text-title-lg text-on-surface font-bold">Panduan Singkat Peminjaman</h2>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-md">
                        Alur 4 langkah mudah untuk memastikan ruangan perkuliahan tercatat rapi tanpa tumpang tindih jadwal.
                    </p>
                    <!-- 4 Step Flow -->
                    <ol class="flex flex-col gap-space-md relative">
                        <!-- Step 1 -->
                        <li class="flex items-start gap-space-sm">
                            <div class="flex items-center justify-center w-7 h-7 rounded-full bg-primary-container text-on-primary-container font-label-sm text-label-sm font-bold shrink-0 shadow-sm">1</div>
                            <div class="flex flex-col">
                                <span class="font-label-lg text-label-lg font-bold text-on-surface">Pilih Ruangan</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Cek ketersediaan dan fasilitas di menu <strong>Ruangan</strong> sebelum memilih slot kosong.</span>
                            </div>
                        </li>
                        <!-- Step 2 -->
                        <li class="flex items-start gap-space-sm">
                            <div class="flex items-center justify-center w-7 h-7 rounded-full bg-primary-container text-on-primary-container font-label-sm text-label-sm font-bold shrink-0 shadow-sm">2</div>
                            <div class="flex flex-col">
                                <span class="font-label-lg text-label-lg font-bold text-on-surface">Datang Ke Ruangan</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Pastikan Anda sudah berada di depan ruangan yang ingin digunakan.</span>
                            </div>
                        </li>
                        <!-- Step 3 -->
                        <li class="flex items-start gap-space-sm">
                            <div class="flex items-center justify-center w-7 h-7 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-bold shrink-0 shadow-sm">3</div>
                            <div class="flex flex-col">
                                <span class="font-label-lg text-label-lg font-bold text-on-surface">Scan & Isi Form</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Scan QR Code di pintu lab, lalu isi mata kuliah dan estimasi waktu selesai.</span>
                            </div>
                        </li>
                        <!-- Step 4 -->
                        <li class="flex items-start gap-space-sm">
                            <div class="flex items-center justify-center w-7 h-7 rounded-full bg-primary-container text-on-primary-container font-label-sm text-label-sm font-bold shrink-0 shadow-sm">4</div>
                            <div class="flex flex-col">
                                <span class="font-label-lg text-label-lg font-bold text-on-surface">Selesai & Checkout</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Klik <strong>"Akhiri Sesi"</strong> saat perkuliahan selesai agar status ruangan kembali tersedia.</span>
                            </div>
                        </li>
                    </ol>
                    
                    <div class="mt-space-lg p-space-md rounded-2xl bg-surface-container-high/60 flex items-start gap-space-sm">
                        <div class="p-2 rounded-xl bg-secondary-container text-on-secondary-container shrink-0 shadow-sm">
                            <span class="material-symbols-outlined text-[20px]">support_agent</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-label-md text-label-md font-bold text-on-surface">Butuh Bantuan Teknisi?</span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Kendala proyektor, AC, atau PC lab? Hubungi Helpdesk JTIK <strong>Ext. 104</strong>.</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-refresh setiap 1 menit untuk update waktu real-time
setTimeout(() => {
    window.location.reload();
}, 60000);
</script>
@endsection
