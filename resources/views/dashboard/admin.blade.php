@extends('layouts.app')

@section('title', "Dashboard Admin - JTIKROOMS")

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}" />
@endpush

@section('content')
@php
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
@endphp

<div class="content-wrapper">
    <!-- Header -->
    <div class="admin-header-modern" data-animate style="--item-index: 0;">
        <div class="ah-text">
            <h1><i class="fas fa-user-shield"></i> Administrator Panel</h1>
            <p>Selamat datang kembali, <strong>{{ session('user') }}</strong>. Berikut adalah ringkasan aktivitas hari ini.</p>
        </div>
        <div class="ah-avatar">
            <i class="fas fa-user-cog"></i>
        </div>
    </div>

    <!-- Real-time Statistics -->
    <div class="stats-grid-admin">
        <div class="stat-card-glass" data-animate style="--item-index: 1;">
            <div class="sc-icon primary"><i class="fas fa-door-open"></i></div>
            <div class="sc-content">
                <span class="sc-value">{{ $totalRooms }}</span>
                <span class="sc-label">Total Ruangan</span>
            </div>
        </div>
        
        <div class="stat-card-glass" data-animate style="--item-index: 2;">
            <div class="sc-icon success"><i class="fas fa-check-circle"></i></div>
            <div class="sc-content">
                <span class="sc-value">{{ $availableRooms }}</span>
                <span class="sc-label">Tersedia Saat Ini</span>
            </div>
        </div>
        
        <div class="stat-card-glass" data-animate style="--item-index: 3;">
            <div class="sc-icon info"><i class="fas fa-users"></i></div>
            <div class="sc-content">
                <span class="sc-value">{{ $totalUsers }}</span>
                <span class="sc-label">Total Pengguna</span>
            </div>
        </div>
        
        <div class="stat-card-glass" data-animate style="--item-index: 4;">
            <div class="sc-icon warning"><i class="fas fa-calendar-check"></i></div>
            <div class="sc-content">
                <span class="sc-value">{{ $todayBookings }}</span>
                <span class="sc-label">Booking Hari Ini</span>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="admin-content-grid">
        <!-- Left Column (Menu & Live Status) -->
        <div class="left-col">
            <!-- App Launcher Menu -->
            <div class="glass-panel mb-4" data-animate style="--item-index: 5;">
                <div class="panel-header">
                    <h3><i class="fas fa-layer-group text-primary"></i> Akses Cepat Menu</h3>
                </div>
                
                <div class="launcher-grid">
                    <button class="launcher-btn" onclick="window.location.href='{{ route('rooms.index') }}'">
                        <div class="lb-icon p"><i class="fas fa-door-open"></i></div>
                        <div class="lb-text">
                            <span class="lb-title">Manajemen Ruang</span>
                            <span class="lb-desc">Kelola fasilitas ruangan</span>
                        </div>
                    </button>
                    
                    <button class="launcher-btn" onclick="window.location.href='{{ route('users.index') }}'">
                        <div class="lb-icon s"><i class="fas fa-users-cog"></i></div>
                        <div class="lb-text">
                            <span class="lb-title">Manajemen User</span>
                            <span class="lb-desc">Kelola akun perwakilan</span>
                        </div>
                    </button>
                    
                    <button class="launcher-btn" onclick="window.location.href='{{ route('admin.information.index') }}'">
                        <div class="lb-icon i"><i class="fas fa-info-circle"></i></div>
                        <div class="lb-text">
                            <span class="lb-title">Pusat Informasi</span>
                            <span class="lb-desc">Ubah info beranda utama</span>
                        </div>
                    </button>
                    
                    <button class="launcher-btn" onclick="window.location.href='{{ route('reports.index') }}'">
                        <div class="lb-icon w"><i class="fas fa-chart-bar"></i></div>
                        <div class="lb-text">
                            <span class="lb-title">Analytics Laporan</span>
                            <span class="lb-desc">Unduh data rekapitulasi</span>
                        </div>
                    </button>
                    
                    <button class="launcher-btn" onclick="window.location.href='{{ route('admin.comments.index') }}'">
                        <div class="lb-icon pu"><i class="fas fa-comments"></i></div>
                        <div class="lb-text">
                            <span class="lb-title">Pesan Masuk</span>
                            <span class="lb-desc">Ulasan dan pertanyaan</span>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Compact Rooms Live Status -->
            <div class="glass-panel" data-animate style="--item-index: 6;">
                <div class="panel-header">
                    <h3><i class="fas fa-satellite-dish text-success"></i> Status Live Ruangan</h3>
                    <span class="panel-badge">{{ $rooms->count() }} Fasilitas</span>
                </div>
                
                <div class="live-rooms-grid">
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
                        
                        <div class="live-room-item">
                            <div class="lr-icon {{ $statusInfo['status'] }}">
                                <i class="fas fa-door-{{ $isAvailable ? 'open' : 'closed' }}"></i>
                                @if($isOccupied) <div class="lr-pulse"></div> @endif
                            </div>
                            <span class="lr-name">{{ $room->display_name ?? $room->name }}</span>
                            <span class="lr-status {{ $statusInfo['status'] }}">
                                @if($isAvailable) Tersedia @elseif($isOccupied) Terpakai @else Maintenance @endif
                            </span>
                            @if($isOccupied && $activeBooking)
                                <span class="lr-time">Sampai {{ $activeBooking->waktu_berakhir->timezone('Asia/Makassar')->format('H:i') }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column (Active Bookings) -->
        <div class="glass-panel" data-animate style="--item-index: 7;">
            <div class="panel-header">
                <h3><i class="fas fa-list-alt text-warning"></i> Pemakaian Saat Ini</h3>
                <span class="panel-badge">{{ $activeBookings->count() }} Berjalan</span>
            </div>
            
            <div class="bookings-list-modern">
                @forelse($activeBookings as $booking)
                    <div class="booking-item-glass">
                        <div class="bi-header">
                            <div class="bi-room"><i class="fas fa-map-marker-alt"></i> {{ $booking->room_name }}</div>
                            <div class="bi-user">{{ $booking->username }}</div>
                        </div>
                        
                        <div class="bi-details">
                            <div class="bi-detail"><i class="fas fa-book"></i> {{ $booking->mata_kuliah ?? '-' }}</div>
                            <div class="bi-detail"><i class="fas fa-user-graduate"></i> {{ $booking->dosen ?? '-' }}</div>
                        </div>
                        
                        <div class="bi-footer">
                            <div class="bi-time">
                                <i class="fas fa-clock"></i> 
                                {{ $booking->waktu_mulai->timezone('Asia/Makassar')->format('H:i') }} - {{ $booking->waktu_berakhir->timezone('Asia/Makassar')->format('H:i') }} WITA
                            </div>
                            <div class="bi-actions">
                                @php
                                    $waktuBerakhir = $booking->waktu_berakhir->timezone('Asia/Makassar');
                                    $sekarang = now()->timezone('Asia/Makassar');
                                    $timeLeft = $waktuBerakhir->diff($sekarang);
                                    $hoursLeft = $timeLeft->h;
                                    $minutesLeft = $timeLeft->i;
                                    $isExpired = $sekarang > $waktuBerakhir;
                                @endphp
                                
                                @if(!$isExpired)
                                    <span class="time-badge-modern {{ $hoursLeft > 0 ? 'warning' : 'danger' }}">
                                        {{ $hoursLeft > 0 ? $hoursLeft.'j '.$minutesLeft.'m' : $minutesLeft.'m' }}
                                    </span>
                                @else
                                    <span class="time-badge-modern danger">Selesai</span>
                                @endif

                                <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn-cancel-modern" title="Batalkan Pemakaian" onclick="return confirm('Yakin ingin menghapus secara paksa booking ruangan {{ $booking->room_name }} oleh kelas {{ $booking->username }}? Data akan tercatat dibatalkan oleh admin.')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-glass">
                        <i class="fas fa-calendar-check"></i>
                        <h4>Tidak Ada Kelas Aktif</h4>
                        <p>Seluruh ruangan saat ini dalam keadaan kosong dan tersedia.</p>
                    </div>
                @endforelse
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