@extends('layouts.app')

@section('title', 'Dashboard Kelas - JTIK ROOMS')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kelas.css') }}?v={{ time() }}">
@endpush

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

<div class="dashboard-kelas">
    
    <div class="dashboard-header" data-animate>
        <h2><i class="fas fa-chalkboard"></i> Dashboard Kelas</h2>
    </div>

    <!-- Hero Section / Welcome Card -->
    <div class="hero-glass-card" data-animate style="--item-index: 0;">
        <div class="hero-content">
            <h3>Selamat Datang, {{ session('user') }}! 👋</h3>
            <p>Kelola penggunaan ruangan Anda dengan mudah. Gunakan fitur pemindaian QR code untuk melakukan booking secara instan tepat di depan pintu ruangan.</p>
        </div>
        <div class="hero-action">
            <a href="{{ route('qr.scanner') }}" class="btn-scan-main">
                <i class="fas fa-qrcode"></i> Scan QR Code
            </a>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="stats-grid-modern">
        <div class="stat-glass-card" data-animate style="--item-index: 1;">
            <div class="stat-icon-wrapper bg-grad-primary">
                <i class="fas fa-door-open"></i>
            </div>
            <div class="stat-details">
                <span class="stat-value">{{ $activeBookings->count() }}</span>
                <span class="stat-title">Booking Aktif</span>
            </div>
        </div>
        
        <div class="stat-glass-card" data-animate style="--item-index: 2;">
            <div class="stat-icon-wrapper bg-grad-info">
                <i class="fas fa-calendar-week"></i>
            </div>
            <div class="stat-details">
                <span class="stat-value">{{ $totalBookings }}</span>
                <span class="stat-title">Booking Minggu Ini</span>
            </div>
        </div>
        
        <div class="stat-glass-card" data-animate style="--item-index: 3;">
            <div class="stat-icon-wrapper bg-grad-success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-details">
                <span class="stat-value">{{ $completedBookings }}</span>
                <span class="stat-title">Selesai (Mingguan)</span>
            </div>
        </div>
    </div>

    <div class="dashboard-layout">
        <!-- Left Column: Active Bookings -->
        <div class="glass-section" data-animate style="--item-index: 4;">
            <h4 class="section-title"><i class="fas fa-clock text-primary"></i> Booking Aktif Anda</h4>
            
            <div class="booking-items">
                @forelse($activeBookings as $booking)
                    @php
                        $waktuBerakhir = $booking->waktu_berakhir->timezone('Asia/Makassar');
                        $timeLeft = $waktuBerakhir->diffInMinutes($now, false);
                        $isAlmostOver = ($timeLeft > -15 && $timeLeft < 0); // Sisa < 15 menit
                    @endphp
                    
                    <div class="booking-card-modern {{ $isAlmostOver ? 'almost-over' : '' }}">
                        <div class="b-header">
                            <h5 class="b-room-name">{{ $booking->room_name }}</h5>
                            <span class="b-badge">
                                <i class="fas fa-circle" style="font-size: 0.5rem;"></i> 
                                {{ $isAlmostOver ? 'Segera Berakhir' : 'Berlangsung' }}
                            </span>
                        </div>
                        
                        <div class="b-details">
                            <div class="b-item">
                                <span>Mata Kuliah</span>
                                <strong>{{ $booking->mata_kuliah }}</strong>
                            </div>
                            <div class="b-item">
                                <span>Dosen Pengampu</span>
                                <strong>{{ $booking->dosen }}</strong>
                            </div>
                            <div class="b-item">
                                <span>Sisa Waktu</span>
                                <strong>{{ $waktuBerakhir->diffForHumans($now) }} ({{ $waktuBerakhir->format('H:i') }})</strong>
                            </div>
                        </div>
                        
                        <div class="b-actions">
                            <form action="{{ route('booking.cancel', $booking->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-end" onclick="return confirm('Yakin ingin mengakhiri penggunaan ruangan {{ $booking->room_name }}?')">
                                    <i class="fas fa-stop-circle me-1"></i> Akhiri Sesi
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-bed"></i>
                        <p>Belum ada aktivitas booking saat ini.<br><small class="text-muted">Gunakan tombol Scan QR untuk memulai.</small></p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right Column: Guide -->
        <div class="glass-section" data-animate style="--item-index: 5;">
            <h4 class="section-title"><i class="fas fa-info-circle text-info"></i> Panduan Singkat</h4>
            
            <div class="guide-list">
                <div class="guide-step">
                    <div class="g-num">1</div>
                    <div class="g-text">
                        <h6>Datang ke Ruangan</h6>
                        <p>Pastikan Anda sudah berada di depan ruangan yang ingin digunakan.</p>
                    </div>
                </div>
                <div class="guide-step">
                    <div class="g-num">2</div>
                    <div class="g-text">
                        <h6>Scan QR Code</h6>
                        <p>Klik tombol Scan QR di atas dan arahkan kamera ke barcode di pintu.</p>
                    </div>
                </div>
                <div class="guide-step">
                    <div class="g-num">3</div>
                    <div class="g-text">
                        <h6>Isi Form & Gunakan</h6>
                        <p>Isi mata kuliah dan jam berakhir. Ruangan otomatis terkunci untuk Anda.</p>
                    </div>
                </div>
                <div class="guide-step">
                    <div class="g-num">4</div>
                    <div class="g-text">
                        <h6>Akhiri Tepat Waktu</h6>
                        <p>Jangan lupa klik "Akhiri Sesi" jika kelas sudah selesai lebih cepat.</p>
                    </div>
                </div>
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
