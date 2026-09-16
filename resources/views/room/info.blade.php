@extends('layouts.stitch')

@section('title', ($room->display_name ?? $room->name) . ' - Detail Ruangan')

@section('content')

@php
    use Illuminate\Support\Facades\DB;
    
    // Normalize facilities into array
    $facilities = $room->facilities ?? [];
    if (is_string($facilities)) {
        $decoded = json_decode($facilities, true);
        $facilities = is_array($decoded) ? $decoded : [];
    } elseif (is_null($facilities)) {
        $facilities = [];
    }

    $now = now()->timezone('Asia/Makassar')->format('Y-m-d H:i:s');
    $roomStatus = DB::select("
        SELECT 
            r.*,
            CASE 
                WHEN EXISTS (
                    SELECT 1 
                    FROM bookings b 
                    WHERE b.room_name = r.name 
                    AND b.status = 'active'
                    AND b.waktu_mulai <= ?
                    AND b.waktu_berakhir > ?
                ) THEN 'occupied'
                ELSE r.status
            END as real_time_status
        FROM rooms r
        WHERE r.name = ?
    ", [$now, $now, $room->name])[0] ?? $room;

    $isOccupied = $roomStatus->real_time_status == 'occupied';
    
    $activeBooking = $isOccupied ? \App\Models\Booking::where('room_name', $room->name)
        ->where('status', 'active')
        ->where('waktu_mulai', '<=', now()->timezone('Asia/Makassar'))
        ->where('waktu_berakhir', '>', now()->timezone('Asia/Makassar'))
        ->first() : null;

    $todayQueues = \App\Models\Queue::where('room_id', $room->id)
        ->whereDate('created_at', \Carbon\Carbon::today('Asia/Makassar'))
        ->count();
@endphp

<div class="pointer-events-none absolute -top-40 right-10 w-[500px] h-[500px] bg-primary-fixed/25 rounded-full blur-3xl"></div>
<div class="pointer-events-none absolute top-96 -left-20 w-[450px] h-[450px] bg-secondary-fixed/20 rounded-full blur-3xl"></div>
<div class="w-full px-space-xl py-space-lg relative z-10">
    <div class="flex flex-col w-full">
        
        <!-- Top Breadcrumb & Metadata Strip -->
        <div class="flex flex-wrap items-center justify-between gap-space-sm mb-space-lg">
            <nav class="flex items-center gap-space-xs font-body-sm text-body-sm text-surface-variant">
                <a class="hover:text-primary transition-colors flex items-center gap-1" href="{{ url('/') }}">
                    <span class="material-symbols-outlined text-sm">home</span>
                    <span>Dashboard</span>
                </a>
                <span class="material-symbols-outlined text-xs text-outline-variant">chevron_right</span>
                <span class="font-semibold text-primary">{{ $room->display_name ?? $room->name }}</span>
            </nav>
            <div class="flex items-center gap-space-xs px-space-sm py-1 rounded-full bg-surface-container-high/60 backdrop-blur-md shadow-sm">
                <span class="inline-block w-2 h-2 rounded-full bg-primary animate-ping"></span>
                <span class="font-label-sm text-label-sm text-on-surface-variant font-medium">Sinkronisasi Jadwal: Real-Time</span>
            </div>
        </div>

        <!-- Two Columns Workspace Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">
            
            <!-- LEFT COLUMN: Visual Showcase & Specifications (~45%) -->
            <div class="lg:col-span-5 flex flex-col gap-space-lg">
                <!-- Media Showcase Card -->
                <div class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden shadow-xl bg-surface-container-highest group">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                         src="/img/ruangan.jpg" 
                         onerror="this.src='https://via.placeholder.com/1200x500/e2e8f0/64748b?text=TIDAK+ADA+GAMBAR'"
                         alt="Foto Ruangan">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-inverse-surface/80 via-transparent to-black/30 pointer-events-none"></div>
                    
                    <!-- Top Live Status Badge -->
                    <div class="absolute top-4 right-4 z-10">
                        @if($isOccupied)
                            <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-error-container/90 backdrop-blur-md shadow-lg text-on-error-container">
                                <span class="w-2.5 h-2.5 rounded-full bg-error animate-pulse"></span>
                                <span class="font-label-md text-label-md font-semibold">Sedang Digunakan</span>
                            </div>
                        @elseif($room->status == 'maintenance')
                            <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-secondary-container/90 backdrop-blur-md shadow-lg text-on-secondary-container">
                                <span class="w-2.5 h-2.5 rounded-full bg-secondary animate-pulse"></span>
                                <span class="font-label-md text-label-md font-semibold">Maintenance</span>
                            </div>
                        @else
                            <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-md shadow-lg">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span class="font-label-md text-label-md font-semibold text-on-surface">Tersedia untuk Reservasi</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="absolute bottom-4 left-4 z-10 flex items-center gap-2 px-3 py-1.5 rounded-xl bg-inverse-surface/75 backdrop-blur-md text-on-primary">
                        <span class="material-symbols-outlined text-sm">photo_camera</span>
                        <span class="font-label-sm text-label-sm tracking-wide">Foto Ilustrasi Ruangan</span>
                    </div>
                </div>

                <!-- Specifications & Facilities Glassmorphic Card -->
                <div class="rounded-2xl p-space-lg bg-surface-container-lowest/85 backdrop-blur-xl shadow-lg relative overflow-hidden">
                    <div class="absolute -right-12 -top-12 w-32 h-32 bg-primary-fixed/30 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="absolute -left-12 -bottom-12 w-32 h-32 bg-secondary-fixed/30 rounded-full blur-2xl pointer-events-none"></div>
                    
                    <div class="flex items-center justify-between mb-space-md relative z-10">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-xl bg-primary-container text-on-primary flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-base">tune</span>
                            </div>
                            <h2 class="font-title-lg text-title-lg font-bold text-on-surface">Spesifikasi & Fasilitas Ruangan</h2>
                        </div>
                    </div>
                    
                    <!-- Spec Grid Items -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm relative z-10">
                        
                        <div class="p-space-sm rounded-xl bg-surface-container-low/70 flex items-start gap-3 transition-colors hover:bg-surface-container-high/60">
                            <div class="p-2 rounded-lg bg-primary/10 text-primary shrink-0">
                                <span class="material-symbols-outlined text-lg">category</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-label-sm text-label-sm text-on-surface-variant font-medium">Tipe Ruangan</span>
                                <span class="font-body-md text-body-md font-semibold text-on-surface truncate">
                                    @if($room->type === 'lab') Laboratorium
                                    @elseif($room->type === 'kelas') Kelas
                                    @else Ruangan Umum
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-space-sm rounded-xl bg-surface-container-low/70 flex items-start gap-3 transition-colors hover:bg-surface-container-high/60">
                            <div class="p-2 rounded-lg bg-secondary/10 text-secondary shrink-0">
                                <span class="material-symbols-outlined text-lg">groups</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-label-sm text-label-sm text-on-surface-variant font-medium">Kapasitas</span>
                                <span class="font-body-md text-body-md font-semibold text-on-surface truncate">{{ $room->capacity ?? '40' }} Orang</span>
                            </div>
                        </div>
                        
                        <div class="p-space-sm rounded-xl bg-surface-container-low/70 flex items-start gap-3 transition-colors hover:bg-surface-container-high/60 sm:col-span-2">
                            <div class="p-2 rounded-lg bg-tertiary/10 text-tertiary shrink-0">
                                <span class="material-symbols-outlined text-lg">location_on</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-label-sm text-label-sm text-on-surface-variant font-medium">Lokasi</span>
                                <span class="font-body-md text-body-md font-semibold text-on-surface">Lantai {{ $room->lantai ?? '1' }} - {{ $room->location ?? 'Gedung JTIK' }}</span>
                            </div>
                        </div>

                        @if(count($facilities) > 0)
                            @foreach($facilities as $index => $fac)
                                @php
                                    $facLower = strtolower($fac);
                                    $icon = 'check_circle';
                                    if (str_contains($facLower, 'wifi') || str_contains($facLower, 'internet')) $icon = 'wifi';
                                    elseif (str_contains($facLower, 'ac') || str_contains($facLower, 'pendingin')) $icon = 'ac_unit';
                                    elseif (str_contains($facLower, 'proyektor') || str_contains($facLower, 'lcd') || str_contains($facLower, 'projector')) $icon = 'videocam';
                                    elseif (str_contains($facLower, 'papan') || str_contains($facLower, 'board')) $icon = 'tv';
                                    elseif (str_contains($facLower, 'kursi') || str_contains($facLower, 'meja')) $icon = 'chair';
                                    elseif (str_contains($facLower, 'komputer') || str_contains($facLower, 'pc')) $icon = 'desktop_windows';
                                @endphp
                                <div class="p-space-sm rounded-xl bg-surface-container-low/70 flex items-start gap-3 transition-colors hover:bg-surface-container-high/60">
                                    <div class="p-2 rounded-lg bg-primary/10 text-primary shrink-0">
                                        <span class="material-symbols-outlined text-lg">{{ $icon }}</span>
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="font-body-md text-body-md font-semibold text-on-surface">{{ $fac }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-space-sm rounded-xl bg-surface-container-low/70 flex items-start gap-3 transition-colors hover:bg-surface-container-high/60">
                                <div class="p-2 rounded-lg bg-primary/10 text-primary shrink-0">
                                    <span class="material-symbols-outlined text-lg">videocam</span>
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="font-body-md text-body-md font-semibold text-on-surface">Proyektor LCD</span>
                                </div>
                            </div>
                            <div class="p-space-sm rounded-xl bg-surface-container-low/70 flex items-start gap-3 transition-colors hover:bg-surface-container-high/60">
                                <div class="p-2 rounded-lg bg-primary/10 text-primary shrink-0">
                                    <span class="material-symbols-outlined text-lg">ac_unit</span>
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="font-body-md text-body-md font-semibold text-on-surface">AC Split (2 Unit)</span>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Identity, Status, Real-Time Timeline & Actions (~55%) -->
            <div class="lg:col-span-7 flex flex-col gap-space-lg">
                <!-- Room Title & Identification Header -->
                <div class="flex flex-col gap-space-xs">
                    <div class="flex flex-wrap items-center justify-between gap-space-xs">
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 rounded-full bg-surface-container text-primary font-mono font-bold text-label-md">
                                KODE: {{ $room->name }}
                            </span>
                            <button class="flex items-center gap-1 text-primary hover:text-on-primary-fixed-variant transition-colors p-1 rounded-md hover:bg-surface-container" id="copyBtn" onclick="copyCode('{{ $room->name }}')">
                                <span class="material-symbols-outlined text-base">content_copy</span>
                                <span class="font-label-sm text-label-sm font-semibold" id="copyFeedback">Salin Kode</span>
                            </button>
                        </div>
                        <span class="font-label-sm text-label-sm text-on-surface-variant bg-surface-container-high/50 px-2.5 py-1 rounded-md">
                            Lantai {{ $room->lantai ?? '1' }}
                        </span>
                    </div>
                    
                    <h1 class="font-headline-xl text-headline-xl text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary font-black tracking-tight mt-1">
                        {{ $room->display_name ?? $room->name }}
                    </h1>
                    <p class="font-body-md text-body-md text-on-surface-variant">
                        {{ $room->description ?? 'Ruangan ini didesain untuk kenyamanan proses belajar mengajar.' }}
                    </p>
                </div>

                <!-- Large Status Highlight Card -->
                <div class="rounded-2xl p-space-md bg-surface-container-lowest/90 backdrop-blur-xl shadow-md flex items-center justify-between flex-wrap gap-space-md">
                    <div class="flex items-center gap-space-md">
                        <div class="w-12 h-12 rounded-2xl bg-surface-container-low flex items-center justify-center shrink-0">
                            <div class="relative flex items-center justify-center">
                                <span class="w-5 h-5 rounded-full {{ $isOccupied ? 'bg-error' : ($room->status == 'available' ? 'bg-emerald-500' : 'bg-secondary') }}"></span>
                                <span class="absolute w-7 h-7 rounded-full {{ $isOccupied ? 'bg-error/40' : ($room->status == 'available' ? 'bg-emerald-500/40' : 'bg-secondary/40') }} animate-ping"></span>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-2">
                                <span class="font-title-lg text-title-lg font-bold text-on-surface">
                                    @if($isOccupied) Sedang Digunakan
                                    @elseif($room->status == 'available') Tersedia Sekarang
                                    @else Maintenance
                                    @endif
                                </span>
                                <span class="px-2 py-0.5 rounded-full 
                                    {{ $isOccupied ? 'bg-error-container text-on-error-container' : ($room->status == 'available' ? 'bg-emerald-100 text-emerald-800' : 'bg-secondary-container text-on-secondary-container') }} 
                                    font-label-sm text-label-sm font-bold">
                                    @if($isOccupied) OCCUPIED
                                    @elseif($room->status == 'available') READY
                                    @else UNAVAILABLE
                                    @endif
                                </span>
                            </div>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">
                                @if($isOccupied) Ruangan sedang digunakan oleh kelas lain
                                @else Ruangan bebas dari jadwal reguler saat ini
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                @if($activeBooking)
                    @php
                        $waktuBerakhir = \Carbon\Carbon::parse($activeBooking->waktu_berakhir)->timezone('Asia/Makassar');
                        $sekarang = now()->timezone('Asia/Makassar');
                        $sisaWaktu = $waktuBerakhir->diff($sekarang);
                        $hours = $sisaWaktu->h;
                        $minutes = $sisaWaktu->i;
                    @endphp
                    <!-- Occupancy Active Session Details -->
                    <div class="rounded-2xl p-space-lg bg-surface-container-lowest/85 backdrop-blur-xl shadow-lg flex flex-col gap-space-md border border-error/20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-error">
                                <span class="material-symbols-outlined text-sm font-bold">cell_tower</span>
                                <h3 class="font-title-md text-title-md font-bold text-on-surface">Kelas Berlangsung</h3>
                            </div>
                            <span class="font-label-sm text-label-sm font-bold text-error">Sisa Waktu: {{ $hours > 0 ? $hours.'j ' : '' }}{{ $minutes }}m</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant font-medium">KELAS PENGGUNA</span>
                                <p class="font-body-md text-body-md font-semibold">{{ $activeBooking->username }}</p>
                            </div>
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant font-medium">MATA KULIAH</span>
                                <p class="font-body-md text-body-md font-semibold">{{ $activeBooking->mata_kuliah }}</p>
                            </div>
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant font-medium">DOSEN</span>
                                <p class="font-body-md text-body-md font-semibold">{{ $activeBooking->dosen }}</p>
                            </div>
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant font-medium">WAKTU BERAKHIR</span>
                                <p class="font-body-md text-body-md font-semibold">{{ $waktuBerakhir->format('H:i') }} WITA</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Interactive Action Panel -->
                <div class="rounded-2xl p-space-lg bg-surface-container-lowest/90 backdrop-blur-xl shadow-xl flex flex-col gap-space-md mt-4">
                    <div class="flex flex-col gap-1">
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">Aksi Reservasi Cepat</span>
                        <h3 class="font-title-md text-title-md font-bold text-on-surface">Mulai Reservasi atau Antrean Ruang</h3>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-space-sm">
                        <a href="{{ route('dashboard.kelas') }}" class="flex-1 py-4 px-space-md rounded-xl font-label-lg text-label-lg font-bold text-white shadow-[0_8px_20px_-4px_rgba(59,130,246,0.45)] bg-gradient-to-r from-primary to-secondary-container hover:opacity-95 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-xl">dashboard_customize</span>
                            <span>Lihat Dashboard Antrian & Booking Ruangan</span>
                        </a>
                        @if(session('role') === 'admin')
                        <button type="button" onclick="alert('Anda login sebagai Administrator. Hanya perwakilan kelas yang diizinkan membuat booking/reservasi.')" class="py-3.5 px-space-md rounded-xl font-label-lg text-label-lg font-semibold text-primary bg-surface-container-low hover:bg-surface-container-high transition-all flex items-center justify-center gap-2 shadow-sm">
                            <span class="material-symbols-outlined text-xl">block</span>
                            <span>Akses Booking Ditolak</span>
                        </button>
                        @elseif(session()->has('user'))
                        <a href="{{ route('booking.create', ['roomName' => $room->name]) }}" class="py-3.5 px-space-md rounded-xl font-label-lg text-label-lg font-semibold text-primary bg-surface-container-low hover:bg-surface-container-high transition-all flex items-center justify-center gap-2 shadow-sm">
                            <span class="material-symbols-outlined text-xl">qr_code_scanner</span>
                            <span>Mulai Booking Baru</span>
                        </a>
                        @else
                        <button type="button" onclick="showLoginPrompt()" class="py-3.5 px-space-md rounded-xl font-label-lg text-label-lg font-semibold text-primary bg-surface-container-low hover:bg-surface-container-high transition-all flex items-center justify-center gap-2 shadow-sm">
                            <span class="material-symbols-outlined text-xl">qr_code_scanner</span>
                            <span>Mulai Booking Baru</span>
                        </button>
                        @endif
                    </div>
                </div>
                
                <!-- Comments & Reports -->
                <div class="rounded-2xl p-space-lg bg-surface-container-lowest/85 backdrop-blur-xl shadow-lg flex flex-col gap-space-md mt-4">
                    <h3 class="font-title-md text-title-md font-bold text-on-surface border-b pb-2">Laporan & Diskusi</h3>
                    
                    @if(session('loggedin'))
                    <form action="{{ route('comments.store') }}" method="POST" class="flex flex-col gap-2 mb-2">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <textarea name="body" rows="2" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all font-body-md text-on-surface resize-none" placeholder="Tuliskan laporan kerusakan fasilitas atau komentar ruangan di sini..." required maxlength="500"></textarea>
                        
                        <div class="flex items-center justify-between mt-1">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="anonymous" value="1" class="w-4 h-4 text-primary bg-surface-container-low border-outline-variant/50 rounded focus:ring-primary/20">
                                <span class="font-label-sm text-label-sm text-on-surface-variant group-hover:text-on-surface transition-colors">Sembunyikan Identitas (Anonim)</span>
                            </label>
                            
                            <button type="submit" class="px-4 py-2 bg-primary text-on-primary font-label-md font-bold rounded-lg hover:bg-primary-container hover:text-on-primary-container transition-colors shadow-sm flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[18px]">send</span>
                                Kirim
                            </button>
                        </div>
                    </form>
                    @else
                    <div class="p-3 bg-surface-container-low rounded-xl text-center flex flex-col items-center justify-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-on-surface-variant">lock</span>
                        <p class="font-label-sm text-on-surface-variant">Silakan login sebagai kelas untuk menulis laporan/komentar.</p>
                    </div>
                    @endif

                    <div class="flex flex-col gap-space-sm max-h-[300px] overflow-y-auto pr-2">
                        @forelse($room->comments ?? [] as $comment)
                            <div class="p-space-sm rounded-xl {{ $comment->type === 'report' ? 'bg-error-container/30' : 'bg-surface-container-low/50' }} flex items-start gap-3">
                                <div class="p-2 rounded-lg {{ $comment->type === 'report' ? 'bg-error/10 text-error' : 'bg-primary/10 text-primary' }} shrink-0">
                                    <span class="material-symbols-outlined text-lg">{{ $comment->type === 'report' ? 'flag' : 'chat' }}</span>
                                </div>
                                <div class="flex flex-col min-w-0 flex-1">
                                    <div class="flex justify-between items-center">
                                        <span class="font-label-sm text-label-sm text-on-surface font-semibold">
                                            @if($comment->is_anonymous) Anonim @else {{ $comment->user->nama_kelas ?? ($comment->user->name ?? 'Perwakilan Kelas') }} @endif
                                        </span>
                                    </div>
                                    <p class="font-body-sm text-body-sm text-on-surface mt-1">{{ $comment->body }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="font-body-sm text-body-sm text-on-surface-variant text-center py-4">Belum ada komentar atau laporan.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
  function copyCode(code) {
    navigator.clipboard.writeText(code).then(() => {
      const fb = document.getElementById('copyFeedback');
      if (fb) {
        fb.innerText = 'Tersalin!';
        setTimeout(() => {
          fb.innerText = 'Salin Kode';
        }, 2000);
      }
    });
  }

  function deleteComment(commentId) {
      if (confirm('Apakah Anda yakin ingin menghapus komentar ini?')) {
          document.getElementById('delete-form-' + commentId).submit();
      }
  }
  
  function showLoginPrompt() {
      // 1. Tampilkan Pop-up
      const popupHtml = `
          <div id="login-prompt-overlay" class="fixed inset-0 bg-inverse-surface/50 backdrop-blur-sm z-[100] flex items-center justify-center opacity-0 transition-opacity duration-300">
              <div class="bg-surface-container-lowest p-space-xl rounded-3xl shadow-2xl max-w-md w-full mx-4 transform scale-95 transition-transform duration-300 flex flex-col items-center text-center border border-outline-variant/30">
                  <div class="w-20 h-20 bg-primary-container text-on-primary-container rounded-full flex items-center justify-center mb-6">
                      <span class="material-symbols-outlined text-4xl">lock_person</span>
                  </div>
                  <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface mb-2">Akses Ditolak</h2>
                  <p class="font-body-lg text-on-surface-variant mb-8">Untuk melakukan booking ruangan, silakan <b>Login</b> terlebih dahulu sebagai perwakilan kelas.</p>
                  <button onclick="closeLoginPrompt()" class="w-full py-3.5 rounded-xl bg-primary text-on-primary font-label-lg font-bold shadow-sm hover:bg-primary-container hover:text-on-primary-container transition-colors">
                      Mengerti
                  </button>
              </div>
          </div>
      `;
      document.body.insertAdjacentHTML('beforeend', popupHtml);
      
      // 2. Tampilkan Panah Penunjuk ke Tombol Login di Sidebar
      const arrowHtml = `
          <div id="login-pointer-arrow" class="fixed left-[270px] bottom-[25px] z-[105] flex items-center gap-4 opacity-0 transition-all duration-500 translate-x-4 pointer-events-none">
              
              <!-- Panah SVG Animasi -->
              <div class="relative flex items-center animate-[bounce-left_1s_infinite]">
                  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-error drop-shadow-[0_0_10px_rgba(186,26,26,0.6)]">
                      <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
              </div>

              <!-- Tooltip Elegan -->
              <div class="bg-surface-container-lowest text-on-surface border border-error/30 px-5 py-3 rounded-2xl font-body-md font-medium shadow-[0_8px_30px_rgba(186,26,26,0.2)] relative flex items-center gap-2">
                  <div class="absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-4 bg-surface-container-lowest border-l border-b border-error/30 rotate-45"></div>
                  <span class="material-symbols-outlined text-error text-[20px]">touch_app</span>
                  <span>Silakan klik <b class="text-error">Masuk Sistem</b></span>
              </div>
          </div>
      `;
      // Hanya tampilkan panah jika layar cukup lebar (sidebar terlihat)
      if (window.innerWidth > 768) {
          document.body.insertAdjacentHTML('beforeend', arrowHtml);
      }
      
      // Animasikan masuk
      setTimeout(() => {
          document.getElementById('login-prompt-overlay').classList.remove('opacity-0');
          document.getElementById('login-prompt-overlay').firstElementChild.classList.remove('scale-95');
          if (document.getElementById('login-pointer-arrow')) {
              document.getElementById('login-pointer-arrow').classList.remove('opacity-0', 'translate-x-4');
          }
      }, 10);
      
      // Highlight tombol login di sidebar
      const loginBtn = document.getElementById('login-btn-sidebar');
      if (loginBtn) {
          loginBtn.classList.add('ring-4', 'ring-error/50', 'bg-error', 'text-on-error', 'shadow-[0_0_20px_rgba(186,26,26,0.5)]');
          loginBtn.classList.remove('bg-primary-container', 'text-on-primary-container', 'shadow-sm');
      }
  }
  
  function closeLoginPrompt() {
      const overlay = document.getElementById('login-prompt-overlay');
      const arrow = document.getElementById('login-pointer-arrow');
      
      if (overlay) {
          overlay.classList.add('opacity-0');
          overlay.firstElementChild.classList.add('scale-95');
          setTimeout(() => overlay.remove(), 300);
      }
      if (arrow) {
          arrow.classList.add('opacity-0', 'translate-x-4');
          setTimeout(() => arrow.remove(), 300);
      }
      
      // Kembalikan tombol login seperti semula
      const loginBtn = document.getElementById('login-btn-sidebar');
      if (loginBtn) {
          loginBtn.classList.remove('ring-4', 'ring-error/50', 'bg-error', 'text-on-error', 'shadow-[0_0_20px_rgba(186,26,26,0.5)]');
          loginBtn.classList.add('bg-primary-container', 'text-on-primary-container', 'shadow-sm');
      }
  }
</script>

<style>
    @keyframes bounce-left {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(-25%); }
    }
</style>

@endsection