@extends('layouts.app')

@section('title', 'Dashboard Ruangan')

@section('content')
<div class="header">
    <h2><i class="fas fa-th-list me-2"></i>Dashboard List Ruangan</h2>
</div>

<div class="search-bar">
    <input type="text" class="search-input" placeholder="Cari ruangan..." />
    <button class="search-button"><i class="fas fa-search"></i></button>
</div>

<div class="filter-bar d-flex justify-content-between align-items-center flex-wrap mb-3">
    <div>
        <button class="filter-button active" data-filter="all">Semua Ruangan</button>
        <button class="filter-button" data-filter="kelas">Ruangan Kelas</button>
        <button class="filter-button" data-filter="lab">Laboratorium</button>
        <button class="filter-button" data-filter="other">Ruangan Lainnya</button>
    </div>
    <div class="d-flex align-items-center mt-2 mt-md-0">
        <label class="me-3" style="cursor: pointer; display: flex; align-items: center; gap: 5px;">
            <input type="checkbox" id="filter-available-only"> Hanya Tersedia
        </label>
        <div class="text-muted small">
            <i class="fas fa-sync-alt" id="refresh-icon"></i> Terakhir diperbarui: <span id="last-updated-time">Belum</span>
        </div>
    </div>
</div>

<!-- Color Legend -->
<div class="mb-4 d-flex flex-wrap gap-3 align-items-center" style="font-size: 0.85rem; padding: 10px 15px; background: white; border-radius: 8px; border: 1px solid var(--abu-medium);">
    <span class="fw-bold me-2"><i class="fas fa-info-circle text-primary"></i> Keterangan Status:</span>
    <span class="d-flex align-items-center gap-1"><span style="width: 12px; height: 12px; background: rgba(16, 185, 129, 0.9); border-radius: 50%; display: inline-block;"></span> Tersedia</span>
    <span class="d-flex align-items-center gap-1"><span style="width: 12px; height: 12px; background: rgba(239, 68, 68, 0.9); border-radius: 50%; display: inline-block;"></span> Sedang Digunakan</span>
    <span class="d-flex align-items-center gap-1"><span style="width: 12px; height: 12px; background: rgba(245, 158, 11, 0.9); border-radius: 50%; display: inline-block;"></span> Maintenance</span>
</div>

<div class="room-list">
    @forelse($rooms as $room)
        <div class="room-card" 
             x-data="roomCard()"
             x-on:mouseenter="isHovered = true"
             x-on:mouseleave="isHovered = false"
             :class="{ 'ring-2 ring-indigo-500': isHovered }"
             data-status="{{ $room->activeBooking ? 'occupied' : 'available' }}">
            
            <div class="room-image-container">
                <img :src="`/img/ruangan.jpg`" 
                     alt="Room"
                     class="room-image"
                     loading="lazy">
                
                {{-- Badge Status Otomatis dari Relationship --}}
                <div class="room-status-badge {{ $room->activeBooking ? 'status-occupied' : 'status-available' }}">
                    <i class="fas {{ $room->activeBooking ? 'fa-user-lock' : 'fa-check-circle' }}"></i>
                    {{ $room->activeBooking ? 'Terpakai' : 'Tersedia' }}
                </div>
            </div>
            
            <div class="room-info">
                <h3 class="room-name">{{ $room->name }}</h3>
                <p class="room-code text-sm text-gray-500">{{ $room->display_name }}</p>
                
                <div class="room-meta-grid">
                    <div class="meta-item">
                        <i class="fas fa-users"></i> {{ $room->capacity }} Kursi
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-layer-group"></i> Lantai {{ $room->lantai ?? '1' }}
                    </div>
                </div>
                
                <button class="btn-info-detail"
                        x-on:click="checkAvailability('{{ $room->name }}')"
                        :disabled="isBooking">
                    <i class="fas fa-info-circle"></i>
                    <span x-text="isBooking ? 'Checking...' : 'Info Selengkapnya'"></span>
                </button>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-20">
            <p class="text-gray-500">Tidak ada ruangan ditemukan.</p>
        </div>
    @endforelse
</div>
@endsection