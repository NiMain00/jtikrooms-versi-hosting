@extends('layouts.stitch')

@section('title', 'Katalog Ruangan JTIK')

@section('content')
<div class="w-full relative z-10">
    
    @php
        $occupiedCount = $rooms->filter(function($r) { return $r->activeBooking != null || $r->status == 'occupied'; })->count();
        $maintenanceCount = $rooms->where('status', 'maintenance')->count();
        $availableCount = $rooms->count() - $occupiedCount - $maintenanceCount;
    @endphp

    <!-- DESKTOP VIEW (Hidden on Mobile) -->
    <div class="hidden md:flex flex-col w-full px-space-xl py-space-lg gap-space-xl max-w-7xl mx-auto">
        <!-- Title Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-sm">
            <div class="flex flex-col">
                <div class="flex items-center gap-2 mb-1">
                    <span class="inline-block w-2.5 h-2.5 rounded-full bg-orange-500"></span>
                    <span class="text-xs uppercase tracking-wider text-slate-500 font-bold">Portal Peminjaman Terintegrasi</span>
                </div>
                <h1 class="text-4xl tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-blue-500 font-extrabold pb-1">
                    Katalog Ruangan JTIK
                </h1>
                <p class="text-base text-slate-600 mt-1 max-w-2xl">
                    Jelajahi dan pinjam ruang kuliah serta laboratorium secara real-time dengan status mutakhir.
                </p>
            </div>
            
            <!-- Quick Metrics Counter Strip -->
            <div class="flex flex-wrap items-center gap-4 bg-white px-5 py-3 rounded-full shadow-sm border border-slate-200">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <div class="flex flex-col leading-tight">
                        <span class="text-sm font-extrabold text-slate-800">{{ max(0, $availableCount) }}</span>
                        <span class="text-xs font-semibold text-slate-600">Tersedia</span>
                    </div>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-600"></span>
                    <div class="flex flex-col leading-tight">
                        <span class="text-sm font-extrabold text-slate-800">{{ $occupiedCount }}</span>
                        <span class="text-xs font-semibold text-slate-600">Digunakan</span>
                    </div>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-orange-500"></span>
                    <div class="flex flex-col leading-tight">
                        <span class="text-sm font-extrabold text-slate-800">{{ $maintenanceCount }}</span>
                        <span class="text-xs font-semibold text-slate-600">Perawatan</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- HERO BANNER -->
        <div class="relative w-full rounded-[2rem] overflow-hidden p-10 text-white bg-gradient-to-br from-blue-700 via-blue-500 to-sky-400 shadow-lg">
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-10">
                <div class="max-w-2xl flex flex-col gap-3">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md w-fit border border-white/10">
                        <span class="material-symbols-outlined text-white text-[18px]">sensors</span>
                        <span class="text-xs uppercase font-bold text-white tracking-wider">Sistem Monitoring Terpusat v2.4</span>
                    </div>
                    <h2 class="text-4xl font-extrabold tracking-tight text-white leading-tight mt-2">
                        Cek dan Gunakan Ruangan JTIK
                    </h2>
                    <p class="text-base text-white/90 font-medium mt-1">
                        Lihat ketersediaan ruangan secara real-time, pantau jadwal kuliah & praktikum, serta ajukan reservasi kelas hanya dalam 3 langkah terverifikasi.
                    </p>
                    <div class="flex flex-wrap items-center gap-4 pt-4">
                        @if(session()->has('user'))
                        <a href="#desktop-grid" class="px-6 py-2.5 rounded-full bg-white text-blue-700 text-sm font-bold transition-all flex items-center gap-2 shadow-md hover:bg-blue-50">
                            <span class="material-symbols-outlined text-[18px]">edit_calendar</span>
                            <span>Pinjam Ruangan Sekarang</span>
                        </a>
                        @endif
                        <a href="#desktop-grid" class="px-6 py-2.5 rounded-full bg-white/20 hover:bg-white/30 backdrop-blur-md text-white text-sm font-bold transition-all flex items-center gap-2 border border-white/20 shadow-sm">
                            <span>Telusuri Daftar</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_downward</span>
                        </a>
                    </div>
                </div>
                <!-- Right Side Glass Badge Card -->
                <div class="bg-white/10 backdrop-blur-md rounded-[1.5rem] p-5 flex flex-col gap-4 shadow-xl border border-white/20 min-w-[320px]">
                    <div class="flex items-center justify-between w-full gap-4">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-orange-400"></span>
                            <span class="text-sm font-bold text-white">Node JTIK-IoT Aktif</span>
                        </div>
                        <span class="text-[10px] bg-white/20 px-2.5 py-1 rounded-full font-mono text-white font-bold tracking-wider">RT-SYNC</span>
                    </div>
                    <div class="flex items-center gap-4 w-full bg-black/10 p-3 rounded-2xl">
                        <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center shadow-md shrink-0">
                            <span class="material-symbols-outlined text-3xl text-slate-800">qr_code_scanner</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] uppercase tracking-wider text-orange-200 font-bold">Akses Cepat</span>
                            <span class="text-base font-bold text-white">Scan Smart Key</span>
                            <span class="text-xs text-white/80">Presensi & Akses Pintu</span>
                        </div>
                    </div>
                    <button class="w-full py-2.5 rounded-xl bg-white text-blue-700 text-sm font-bold text-center hover:bg-slate-50 transition-colors flex items-center justify-center gap-2 shadow-md mt-1" onclick="alert('Panduan Peminjaman Ruangan:\n1. Pilih ruangan yang berstatus Tersedia.\n2. Klik Peminjaman.\n3. Dosen pembimbing/pengampu melakukan validasi digital.\n4. Kunci cerdas RFID/QR akan diterbitkan ke akun Anda.')">
                        <span class="material-symbols-outlined text-[18px] text-orange-500">menu_book</span>
                        <span>Panduan Booking Ruang</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- SEARCH AND FILTER -->
        <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex flex-col gap-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <!-- Filters -->
                <div class="flex flex-wrap items-center gap-2">
                    <button class="category-btn active px-5 py-2 rounded-full bg-blue-700 text-white font-semibold text-sm shadow-sm transition-all" data-category="all">Semua Tipe</button>
                    <button class="category-btn px-5 py-2 rounded-full bg-white text-slate-600 font-medium text-sm border border-slate-200 shadow-sm transition-all hover:bg-slate-50" data-category="kelas">Kelas Teori</button>
                    <button class="category-btn px-5 py-2 rounded-full bg-white text-slate-600 font-medium text-sm border border-slate-200 shadow-sm transition-all hover:bg-slate-50" data-category="lab">Laboratorium Komputer</button>
                    <button class="category-btn px-5 py-2 rounded-full bg-white text-slate-600 font-medium text-sm border border-slate-200 shadow-sm transition-all hover:bg-slate-50" data-category="other">Ruang Seminar & Ujian</button>
                </div>

                <!-- "Hanya Tersedia" Toggle -->
                <div class="flex items-center gap-3">
                    <label class="relative inline-flex items-center cursor-pointer" for="availableToggle">
                        <input type="checkbox" id="availableToggle" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                    <span class="text-sm font-medium text-slate-600">Hanya Tersedia</span>
                </div>
                
                <!-- Search -->
                <div class="relative w-full md:w-[300px]">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
                    <input type="text" id="desktopSearchInput" class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-full text-sm font-medium focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all text-slate-700 placeholder-slate-400" placeholder="Cari ruangan, lab, atau fasilitas..." />
                </div>
            </div>
        </div>

        <!-- STATUS INDICATOR LEGEND -->
        <div class="flex flex-wrap items-center justify-between gap-4 px-1">
            <div class="flex items-center gap-2 text-xs text-slate-500 font-semibold uppercase tracking-wider">
                <span>Status Indikator:</span>
                <div class="flex items-center gap-1.5 ml-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="text-emerald-700 font-bold">Tersedia (Ready)</span>
                </div>
                <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 border border-red-200">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    <span class="text-red-700 font-bold">Terpakai (In Use)</span>
                </div>
                <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-orange-50 border border-orange-200">
                    <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                    <span class="text-orange-700 font-bold">Perawatan (Maintenance)</span>
                </div>
            </div>
            <div class="flex items-center gap-1.5 text-xs text-slate-400">
                <span class="material-symbols-outlined text-[14px]">sync</span>
                <span>Sinkronisasi otomatis setiap 60 detik</span>
            </div>
        </div>

        <!-- Desktop Room Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="desktop-grid">
            @forelse($rooms as $room)
                @php
                    $isOccupied = $room->activeBooking != null || $room->status == 'occupied';
                    $isMaintenance = $room->status == 'maintenance';
                    
                    if ($isOccupied) {
                        $statusText = 'Terpakai';
                        $statusClass = 'red';
                    } elseif ($isMaintenance) {
                        $statusText = 'Perawatan';
                        $statusClass = 'orange';
                    } else {
                        $statusText = 'Tersedia';
                        $statusClass = 'emerald';
                    }
                    
                    $bgClass = $statusClass == 'emerald' ? 'bg-emerald-500' : 'bg-'.$statusClass.'-500';
                    
                    $typeLabel = match(strtolower($room->type ?? '')) {
                        'lab' => 'LABORATORIUM',
                        'kelas' => 'KELAS TEORI',
                        'other' => 'RUANG SEMINAR',
                        default => 'RUANGAN',
                    };
                    
                    $typeLabelColor = match(strtolower($room->type ?? '')) {
                        'lab' => 'text-blue-700 bg-blue-50',
                        'kelas' => 'text-emerald-700 bg-emerald-50',
                        'other' => 'text-purple-700 bg-purple-50',
                        default => 'text-slate-700 bg-slate-50',
                    };
                    
                    // Format location description
                    $locationDesc = $room->location ?? 'Gedung JTIK';
                    if ($room->lantai) {
                        $locationDesc .= ', Lantai ' . $room->lantai;
                    }
                    if ($room->name) {
                        $locationDesc .= ' (Ruang ' . $room->name . ')';
                    }
                @endphp
                <div class="desktop-room-item group bg-white rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between border border-slate-100 overflow-hidden" data-category="{{ strtolower($room->type ?? 'lainnya') }}" data-name="{{ strtolower($room->name . ' ' . ($room->display_name ?? '') . ' ' . implode(' ', $room->facilities ?? [])) }}" data-status="{{ $statusClass }}">
                    <!-- Image -->
                    <div class="flex flex-col gap-0">
                        <div class="relative w-full aspect-[4/3] overflow-hidden bg-slate-100">
                            @if($room->image)
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ asset('storage/' . $room->image) }}"/>
                            @else
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://via.placeholder.com/600x400?text=Ruangan"/>
                            @endif
                            
                            <!-- Foto Ilustrasi Badge -->
                            <div class="absolute top-3 left-3 bg-black/50 backdrop-blur-sm text-white px-2.5 py-1 rounded-lg text-[10px] font-bold flex items-center gap-1">
                                <span class="material-symbols-outlined text-[12px]">photo_camera</span>
                                <span>Foto Ilustrasi</span>
                            </div>

                            <!-- Status Badge -->
                            <div class="absolute top-3 right-3 {{ $bgClass }} text-white backdrop-blur-md px-3 py-1.5 rounded-full text-xs font-bold flex items-center gap-1.5 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-white {{ $statusClass == 'emerald' ? 'animate-ping' : '' }}"></span>
                                <span>{{ $statusText }}</span>
                            </div>
                        </div>
                        
                        <!-- Card Content -->
                        <div class="flex flex-col gap-2 p-4">
                            <!-- Type + Capacity Row -->
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded-md {{ $typeLabelColor }}">{{ $typeLabel }}</span>
                                <div class="flex items-center gap-1 text-slate-500 text-xs font-medium">
                                    <span class="material-symbols-outlined text-[16px] text-slate-400">group</span>
                                    <span>{{ $room->capacity }} Mahasiswa</span>
                                </div>
                            </div>

                            <!-- Room Name -->
                            <h3 class="text-lg text-slate-800 font-bold group-hover:text-blue-600 transition-colors leading-tight">
                                {{ $room->display_name ?? $room->name }}
                            </h3>
                            
                            <!-- Location -->
                            <p class="text-xs text-slate-500 leading-relaxed">{{ $locationDesc }}</p>

                            <!-- Maintenance Notice -->
                            @if($isMaintenance)
                                <div class="bg-orange-50 p-3 rounded-xl flex items-start gap-2 border border-orange-100 mt-1">
                                    <span class="material-symbols-outlined text-orange-500 text-[18px] mt-0.5">engineering</span>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-orange-700 font-bold">Dalam sedang melakukan upgrade</span>
                                        <span class="text-[11px] text-orange-600 mt-0.5">{{ $room->description ?? 'Teknis sedang melakukan perawatan' }}</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Active Booking Info -->
                            @if($isOccupied && $room->activeBooking)
                                <div class="bg-red-50 p-3 rounded-xl flex items-start gap-2 border border-red-100 mt-1">
                                    <span class="material-symbols-outlined text-red-500 text-[18px] mt-0.5">schedule</span>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-red-700 font-bold">Sedang Berlangsung: {{ $room->activeBooking->username ?? 'Kelas' }}</span>
                                        <span class="text-[11px] text-slate-600 mt-0.5">{{ $room->activeBooking->mata_kuliah ?? 'Kuliah' }} ({{ $room->activeBooking->waktu_mulai ? $room->activeBooking->waktu_mulai->format('H.i') : '' }} - {{ $room->activeBooking->waktu_berakhir ? $room->activeBooking->waktu_berakhir->format('H.i') : '' }} WITA)</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Facilities Pills -->
                            @if($room->facilities && count($room->facilities) > 0)
                                <div class="flex flex-wrap gap-1.5 mt-1">
                                    @foreach(array_slice($room->facilities, 0, 4) as $facility)
                                        <span class="inline-flex items-center gap-1 text-[10px] font-medium text-slate-600 bg-slate-50 border border-slate-200 px-2 py-1 rounded-lg">
                                            <span class="material-symbols-outlined text-[12px] text-blue-500">check_circle</span>
                                            {{ $facility }}
                                        </span>
                                    @endforeach
                                    @if(count($room->facilities) > 4)
                                        <span class="inline-flex items-center text-[10px] font-medium text-blue-600 bg-blue-50 border border-blue-200 px-2 py-1 rounded-lg">
                                            +{{ count($room->facilities) - 4 }} lainnya
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Bottom Section -->
                    <div class="px-4 pb-4 flex items-center justify-between border-t border-slate-100 pt-3 mt-auto">
                        @if($isOccupied && $room->activeBooking)
                            <div class="flex flex-col">
                                <span class="text-[10px] text-slate-400 font-medium">Estimasi Selesai</span>
                                <span class="text-xs font-bold text-red-600">Pukul {{ $room->activeBooking->waktu_berakhir ? $room->activeBooking->waktu_berakhir->format('H.i') : '-' }} WITA</span>
                            </div>
                            <a href="{{ route('room.info', urlencode($room->name)) }}" class="px-4 py-2 rounded-full bg-slate-100 text-slate-600 hover:bg-blue-500 hover:text-white text-xs font-bold transition-all flex items-center gap-1">
                                <span>Lihat Jadwal</span>
                                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                            </a>
                        @elseif($isMaintenance)
                            <div class="flex flex-col">
                                <span class="text-[10px] text-slate-400 font-medium">Perbaikan Siap</span>
                                <span class="text-xs font-bold text-orange-600">Besok Pagi (08.00)</span>
                            </div>
                            <span class="px-4 py-2 rounded-full bg-slate-100 text-slate-400 text-xs font-bold flex items-center gap-1 cursor-not-allowed">
                                <span>Tidak Tersedia</span>
                                <span class="material-symbols-outlined text-[14px]">lock</span>
                            </span>
                        @else
                            <div class="flex flex-col">
                                <span class="text-[10px] text-slate-400 font-medium">Jadwal Kosong Hari Ini</span>
                                <span class="text-xs font-bold text-emerald-600">10.00 - 17.00 WITA</span>
                            </div>
                            <a href="{{ route('room.info', urlencode($room->name)) }}" class="px-4 py-2 rounded-full bg-orange-50 text-orange-600 hover:bg-orange-500 hover:text-white text-xs font-bold shadow-sm transition-all flex items-center gap-1 border border-orange-200 hover:border-orange-500">
                                <span>Lihat Detail</span>
                                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-slate-500">Tidak ada ruangan ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>


    <!-- MOBILE VIEW (Hidden on Desktop) -->
    <div class="md:hidden flex flex-col px-4 py-6 w-full">
        <!-- Mobile Hero Banner -->
        <div class="bg-gradient-to-br from-blue-700 to-blue-500 rounded-3xl p-5 mb-6 shadow-lg border border-blue-400/30">
            <div class="flex items-center justify-between w-full gap-2 mb-4">
                <div class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-orange-400"></span>
                    <span class="text-xs font-bold text-white">Node JTIK-IoT Aktif</span>
                </div>
                <span class="text-[9px] bg-white/20 px-2 py-0.5 rounded-full font-mono text-white font-bold">RT-SYNC</span>
            </div>
            <div class="flex items-center gap-3 w-full bg-black/10 p-3 rounded-2xl mb-3 border border-white/10">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-md shrink-0">
                    <span class="material-symbols-outlined text-[28px] text-blue-700">qr_code_scanner</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[9px] uppercase tracking-wider text-orange-200 font-bold">Akses Cepat</span>
                    <span class="text-sm font-bold text-white leading-tight">Scan Smart Key</span>
                    <span class="text-[11px] text-white/80">Presensi & Akses Pintu</span>
                </div>
            </div>
            <button class="w-full py-2.5 rounded-xl bg-white text-blue-700 text-xs font-bold text-center flex items-center justify-center gap-2 shadow-sm" onclick="alert('Panduan Peminjaman')">
                <span class="material-symbols-outlined text-[16px]">menu_book</span>
                <span>Panduan Booking Ruang</span>
            </button>
        </div>

        <!-- Mobile Filters -->
        <div class="flex flex-wrap items-center gap-2 mb-4">
            <button class="mobile-category-btn active px-4 py-2 rounded-full bg-[#1e293b] text-white font-medium text-xs border border-transparent shadow-sm transition-all" data-category="all">Semua Tipe</button>
            <button class="mobile-category-btn px-4 py-2 rounded-full bg-white text-slate-600 font-medium text-xs border border-slate-200 shadow-sm transition-all" data-category="kelas">Ruangan Kelas</button>
            <button class="mobile-category-btn px-4 py-2 rounded-full bg-white text-slate-600 font-medium text-xs border border-slate-200 shadow-sm transition-all" data-category="lab">Laboratorium</button>
            <button class="mobile-category-btn px-4 py-2 rounded-full bg-white text-slate-600 font-medium text-xs border border-slate-200 shadow-sm transition-all" data-category="other">Seminar & Ujian</button>
        </div>

        <!-- Mobile "Hanya Tersedia" Toggle -->
        <div class="flex items-center gap-3 mb-4">
            <label class="relative inline-flex items-center cursor-pointer" for="mobileAvailableToggle">
                <input type="checkbox" id="mobileAvailableToggle" class="sr-only peer">
                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
            <span class="text-xs font-medium text-slate-600">Hanya Tersedia</span>
        </div>

        <!-- Mobile Search Box -->
        <div class="relative w-full mb-6">
            <input type="text" id="mobileSearchInput" class="w-full pl-4 pr-12 py-3 bg-white border border-slate-200 rounded-full text-sm font-medium focus:outline-none focus:border-blue-500 shadow-sm" placeholder="Cari ruangan..." />
            <button class="absolute right-1.5 top-1.5 w-9 h-9 bg-blue-700 text-white rounded-full flex items-center justify-center shadow-sm">
                <span class="material-symbols-outlined text-[18px]">search</span>
            </button>
        </div>

        <!-- Mobile Status Indicator -->
        <div class="flex flex-wrap items-center gap-2 mb-4 px-1">
            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Status:</span>
            <div class="flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-50 border border-emerald-200">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                <span class="text-[10px] text-emerald-700 font-bold">Tersedia</span>
            </div>
            <div class="flex items-center gap-1 px-2 py-0.5 rounded-full bg-red-50 border border-red-200">
                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                <span class="text-[10px] text-red-700 font-bold">Terpakai</span>
            </div>
            <div class="flex items-center gap-1 px-2 py-0.5 rounded-full bg-orange-50 border border-orange-200">
                <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                <span class="text-[10px] text-orange-700 font-bold">Perawatan</span>
            </div>
        </div>

        <!-- Mobile Room Cards List -->
        <div class="flex flex-col gap-4" id="mobile-katalog-grid">
            @forelse($rooms as $room)
                @php
                    $isOccupied = $room->activeBooking != null || $room->status == 'occupied';
                    $isMaintenance = $room->status == 'maintenance';
                    
                    if ($isOccupied) {
                        $statusText = 'Terpakai';
                        $statusClass = 'red';
                        $icon = 'cancel';
                    } elseif ($isMaintenance) {
                        $statusText = 'Perawatan';
                        $statusClass = 'orange';
                        $icon = 'build';
                    } else {
                        $statusText = 'Tersedia';
                        $statusClass = 'emerald';
                        $icon = 'check_circle';
                    }
                    
                    $bgClass = $statusClass == 'emerald' ? 'bg-emerald-500' : 'bg-'.$statusClass.'-500';
                @endphp
                <div class="mobile-room-item flex flex-row bg-white rounded-[1.25rem] shadow-sm border border-slate-200 overflow-hidden relative" data-category="{{ strtolower($room->type ?? 'lainnya') }}" data-name="{{ strtolower($room->name . ' ' . ($room->display_name ?? '') . ' ' . implode(' ', $room->facilities ?? [])) }}" data-status="{{ $statusClass }}">
                    <!-- Left Color Border indicator -->
                    <div class="absolute left-0 top-0 bottom-0 w-2 {{ $bgClass }} z-10 rounded-l-[1.25rem] opacity-90"></div>
                    
                    <!-- Image -->
                    <div class="w-[35%] min-h-full bg-slate-50 relative pl-2 py-2">
                        @if($room->image)
                            <img src="{{ asset('storage/' . $room->image) }}" class="w-full h-full object-cover rounded-l-xl border border-slate-200/50" />
                        @else
                            <img src="https://via.placeholder.com/300x400?text=Ruangan" class="w-full h-full object-cover rounded-l-xl border border-slate-200/50" />
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="w-[65%] p-3.5 flex flex-col justify-between">
                        <div class="flex justify-between items-start gap-2 mb-2">
                            <div class="min-w-0">
                                <h3 class="font-bold text-slate-800 text-sm leading-tight truncate">{{ $room->display_name ?? $room->name }}</h3>
                                <p class="text-[11px] text-slate-500 truncate mt-0.5">{{ $room->name }}</p>
                            </div>
                            <!-- Badge -->
                            <div class="{{ $bgClass }} text-white px-1.5 py-0.5 rounded flex items-center gap-1 shrink-0 shadow-sm">
                                <span class="material-symbols-outlined text-[10px]">{{ $icon }}</span>
                                <span class="text-[9px] font-bold tracking-wide">{{ $statusText }}</span>
                            </div>
                        </div>

                        <!-- Facilities (mobile - max 2) -->
                        @if($room->facilities && count($room->facilities) > 0)
                            <div class="flex flex-wrap gap-1 mb-2">
                                @foreach(array_slice($room->facilities, 0, 2) as $facility)
                                    <span class="text-[9px] font-medium text-slate-500 bg-slate-50 border border-slate-200 px-1.5 py-0.5 rounded">{{ $facility }}</span>
                                @endforeach
                            </div>
                        @endif

                        <div class="flex flex-col gap-1.5 mt-auto">
                            <div class="flex items-center gap-1.5 text-slate-500 text-[11px]">
                                <span class="material-symbols-outlined text-blue-600 text-[14px]">domain</span>
                                <span>Lantai {{ $room->lantai ?? '1' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-1.5 text-slate-500 text-[11px]">
                                    <span class="material-symbols-outlined text-emerald-600 text-[14px]">group</span>
                                    <span>{{ $room->capacity }} Mahasiswa</span>
                                </div>
                                <a href="{{ route('room.info', urlencode($room->name)) }}" class="px-4 py-1 border border-slate-200 shadow-sm text-blue-600 text-[11px] font-bold rounded-full hover:bg-blue-50 transition-colors shrink-0">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10 bg-slate-50 rounded-3xl border border-dashed border-slate-300">
                    <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">inbox</span>
                    <p class="text-slate-500 font-medium text-sm">Tidak ada ruangan ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Desktop Logic
        const desktopSearch = document.getElementById('desktopSearchInput');
        const desktopBtns = document.querySelectorAll('.category-btn');
        const desktopItems = document.querySelectorAll('.desktop-room-item');
        const availableToggle = document.getElementById('availableToggle');
        
        let dCategory = 'all';
        let dSearch = '';
        let dOnlyAvailable = false;

        function filterDesktop() {
            desktopItems.forEach(item => {
                const cat = item.getAttribute('data-category');
                const name = item.getAttribute('data-name');
                const status = item.getAttribute('data-status');
                const matchCat = dCategory === 'all' || cat.includes(dCategory);
                const matchSearch = name.includes(dSearch);
                const matchAvailable = !dOnlyAvailable || status === 'emerald';
                item.style.display = (matchCat && matchSearch && matchAvailable) ? '' : 'none';
            });
        }

        desktopBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                desktopBtns.forEach(b => {
                    b.classList.remove('bg-blue-700', 'text-white', 'border-transparent');
                    b.classList.add('bg-white', 'text-slate-600', 'border-slate-200');
                });
                e.target.classList.remove('bg-white', 'text-slate-600', 'border-slate-200');
                e.target.classList.add('bg-blue-700', 'text-white', 'border-transparent');
                
                dCategory = e.target.getAttribute('data-category');
                filterDesktop();
            });
        });

        if (desktopSearch) {
            desktopSearch.addEventListener('input', (e) => {
                dSearch = e.target.value.toLowerCase();
                filterDesktop();
            });
        }

        if (availableToggle) {
            availableToggle.addEventListener('change', (e) => {
                dOnlyAvailable = e.target.checked;
                filterDesktop();
            });
        }

        // Mobile Logic
        const mobileSearch = document.getElementById('mobileSearchInput');
        const mobileBtns = document.querySelectorAll('.mobile-category-btn');
        const mobileItems = document.querySelectorAll('.mobile-room-item');
        const mobileAvailableToggle = document.getElementById('mobileAvailableToggle');
        
        let mCategory = 'all';
        let mSearch = '';
        let mOnlyAvailable = false;

        function filterMobile() {
            mobileItems.forEach(item => {
                const cat = item.getAttribute('data-category');
                const name = item.getAttribute('data-name');
                const status = item.getAttribute('data-status');
                const matchCat = mCategory === 'all' || cat.includes(mCategory);
                const matchSearch = name.includes(mSearch);
                const matchAvailable = !mOnlyAvailable || status === 'emerald';
                item.style.display = (matchCat && matchSearch && matchAvailable) ? '' : 'none';
            });
        }

        mobileBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                mobileBtns.forEach(b => {
                    b.classList.remove('bg-[#1e293b]', 'text-white', 'border-transparent');
                    b.classList.add('bg-white', 'text-slate-600', 'border-slate-200');
                });
                e.target.classList.remove('bg-white', 'text-slate-600', 'border-slate-200');
                e.target.classList.add('bg-[#1e293b]', 'text-white', 'border-transparent');
                
                mCategory = e.target.getAttribute('data-category');
                filterMobile();
            });
        });

        if (mobileSearch) {
            mobileSearch.addEventListener('input', (e) => {
                mSearch = e.target.value.toLowerCase();
                filterMobile();
            });
        }

        if (mobileAvailableToggle) {
            mobileAvailableToggle.addEventListener('change', (e) => {
                mOnlyAvailable = e.target.checked;
                filterMobile();
            });
        }
    });
</script>
@endsection