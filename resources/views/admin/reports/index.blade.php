@extends('layouts.stitch')

@section('title', 'Laporan & Analytics - JTIKROOMS')

@section('styles')
<style>
    .chart-container { position: relative; height: 300px; width: 100%; }
    
    @media print {
        header, aside, .print-hidden { display: none !important; }
        main, .pl-\[260px\] { padding-left: 0 !important; padding-top: 0 !important; }
        .print-card { box-shadow: none !important; border: 1px solid #e2e8f0 !important; break-inside: avoid; }
        body { background: white !important; }
    }
</style>
@endsection

@section('content')
<div class="p-space-md lg:p-space-xl flex flex-col gap-space-lg max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-space-md">
        <div>
            <h1 class="font-headline-md text-headline-md font-bold text-on-surface flex items-center gap-space-xs">
                <span class="material-symbols-outlined text-primary text-3xl">analytics</span>
                Laporan & Analytics
            </h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1">
                Analisis data okupansi: <strong class="text-primary">{{ $labelPeriode }}</strong>
            </p>
        </div>
        
        <div class="flex flex-wrap items-center gap-space-sm print-hidden">
            <!-- Filter Periode -->
            <div class="flex items-center bg-surface-container-low p-1 rounded-xl border border-outline-variant/30 shadow-sm">
                <a href="{{ route('reports.index', ['periode' => 'hari_ini']) }}" 
                   class="px-4 py-2 text-sm font-semibold rounded-lg transition-all {{ $periode == 'hari_ini' ? 'bg-white text-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container-highest/50' }}">
                   Hari Ini
                </a>
                <a href="{{ route('reports.index', ['periode' => 'minggu_ini']) }}" 
                   class="px-4 py-2 text-sm font-semibold rounded-lg transition-all {{ $periode == 'minggu_ini' ? 'bg-white text-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container-highest/50' }}">
                   Minggu Ini
                </a>
                <a href="{{ route('reports.index', ['periode' => 'total']) }}" 
                   class="px-4 py-2 text-sm font-semibold rounded-lg transition-all {{ $periode == 'total' ? 'bg-white text-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container-highest/50' }}">
                   Total
                </a>
            </div>

            <!-- Action Buttons -->
            <a href="{{ route('reports.export', ['periode' => $periode]) }}" class="flex items-center gap-2 px-4 py-2.5 bg-emerald-100 text-emerald-800 hover:bg-emerald-200 font-semibold text-sm rounded-xl transition-all shadow-sm">
                <span class="material-symbols-outlined text-lg">download</span>
                Excel
            </a>
            <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2.5 bg-primary-container text-on-primary-container hover:bg-primary-fixed font-semibold text-sm rounded-xl transition-all shadow-sm">
                <span class="material-symbols-outlined text-lg">print</span>
                Cetak
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-md">
        <!-- Total Booking -->
        <div class="print-card bg-surface-container-lowest border border-outline-variant/30 p-space-md rounded-2xl shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-primary/5 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Total Booking</p>
                    <h3 class="font-display-sm text-3xl font-bold text-on-surface">{{ $totalBookings }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary-container flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-2xl">book_online</span>
                </div>
            </div>
        </div>
        
        <!-- Success Rate -->
        <div class="print-card bg-surface-container-lowest border border-outline-variant/30 p-space-md rounded-2xl shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-emerald-500/5 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Success Rate</p>
                    <h3 class="font-display-sm text-3xl font-bold text-on-surface">{{ $successRate }}%</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-2xl">check_circle</span>
                </div>
            </div>
        </div>

        <!-- Top User -->
        <div class="print-card bg-surface-container-lowest border border-outline-variant/30 p-space-md rounded-2xl shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-amber-500/5 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Top User {{ $periode == 'hari_ini' ? '(Hari Ini)' : '' }}</p>
                    <h3 class="font-title-lg text-title-lg font-bold text-on-surface truncate pr-2">{{ $topUser->username ?? '-' }}</h3>
                    @if($topUser)
                    <p class="font-body-sm text-body-sm text-amber-600 font-semibold mt-1">{{ $topUser->total }} Booking</p>
                    @endif
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-2xl">workspace_premium</span>
                </div>
            </div>
        </div>

        <!-- Cancelled -->
        <div class="print-card bg-surface-container-lowest border-t-4 border-t-error border-x border-b border-outline-variant/30 p-space-md rounded-2xl shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-error/5 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="font-label-sm text-label-sm uppercase tracking-wider text-error font-semibold mb-1">Dibatalkan</p>
                    <h3 class="font-display-sm text-3xl font-bold text-on-surface">{{ $cancelledBookings }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-error-container text-on-error-container flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-2xl">cancel</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-md">
        <!-- Tren Global -->
        <div class="lg:col-span-2 print-card bg-surface-container-lowest border border-outline-variant/30 rounded-2xl shadow-sm overflow-hidden flex flex-col">
            <div class="px-space-md py-4 border-b border-outline-variant/20 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">monitoring</span>
                <h3 class="font-title-md text-title-md font-bold text-on-surface">Tren Global (7 Hari)</h3>
            </div>
            <div class="p-space-md flex-1">
                <div class="chart-container">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Ruangan Populer -->
        <div class="lg:col-span-1 print-card bg-surface-container-lowest border border-outline-variant/30 rounded-2xl shadow-sm overflow-hidden flex flex-col">
            <div class="px-space-md py-4 border-b border-outline-variant/20 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">pie_chart</span>
                    <h3 class="font-title-md text-title-md font-bold text-on-surface">Populer</h3>
                </div>
                @if($periode != 'total')
                <span class="text-xs text-on-surface-variant font-medium bg-surface-container-high px-2 py-1 rounded-md">{{ $labelPeriode }}</span>
                @endif
            </div>
            <div class="p-space-md flex-1 flex flex-col justify-center">
                <div class="chart-container">
                    <canvas id="roomChart"></canvas>
                </div>
                @if(count($roomLabels) == 0)
                    <p class="text-center font-body-sm text-body-sm text-on-surface-variant mt-4">Belum ada data untuk periode ini</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="print-card bg-surface-container-lowest border border-outline-variant/30 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-space-md py-4 border-b border-outline-variant/20 flex items-center gap-2 bg-surface-container-lowest">
            <span class="material-symbols-outlined text-primary">history</span>
            <h3 class="font-title-md text-title-md font-bold text-on-surface">Riwayat Booking - {{ $labelPeriode }}</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-surface-container-low border-b border-outline-variant/30">
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md w-[180px]">WAKTU</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md">PEMINJAM</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md">RUANGAN</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md">KEGIATAN</th>
                        <th class="font-label-md text-label-md text-on-surface-variant font-semibold py-3 px-space-md w-[120px]">STATUS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @forelse($recentBookings as $booking)
                    <tr class="hover:bg-surface-container-lowest/50 transition-colors">
                        <td class="py-3 px-space-md">
                            <span class="font-body-sm text-body-sm text-on-surface-variant">{{ $booking->created_at->format('d M Y, H:i') }}</span>
                        </td>
                        <td class="py-3 px-space-md">
                            <span class="font-title-sm text-title-sm font-bold text-on-surface">{{ $booking->username }}</span>
                        </td>
                        <td class="py-3 px-space-md">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-primary-container text-on-primary-container border border-primary/20">
                                {{ $booking->room_name }}
                            </span>
                        </td>
                        <td class="py-3 px-space-md">
                            <span class="font-body-md text-body-md text-on-surface">{{ $booking->mata_kuliah ?? '-' }}</span>
                        </td>
                        <td class="py-3 px-space-md">
                            @if($booking->status == 'cancelled')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-bold bg-error-container text-on-error-container">
                                    Dibatalkan
                                </span>
                            @elseif($booking->status == 'completed' || $booking->waktu_berakhir < now())
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-bold bg-surface-variant text-on-surface-variant">
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800">
                                    Aktif
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 px-4 text-center">
                            <div class="flex flex-col items-center justify-center text-on-surface-variant/60">
                                <span class="material-symbols-outlined text-5xl mb-2">inbox</span>
                                <p class="font-body-md text-body-md">Tidak ada data booking untuk periode <strong>{{ $labelPeriode }}</strong></p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Styling constants for charts matching Stitch UI
    const gridColor = 'rgba(203, 213, 225, 0.3)';
    const textColor = '#64748b';
    const primaryColor = '#0058be';
    
    // 1. CHART TREN (Garis)
    const ctxTrend = document.getElementById('trendChart').getContext('2d');
    new Chart(ctxTrend, {
        type: 'line',
        data: {
            labels: {!! json_encode($dates) !!},
            datasets: [{
                label: 'Total Booking',
                data: {!! json_encode($trendData) !!},
                borderColor: primaryColor,
                backgroundColor: 'rgba(0, 88, 190, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: primaryColor,
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { family: 'Outfit', size: 14 },
                    bodyFont: { family: 'Outfit', size: 13, weight: 'bold' },
                    cornerRadius: 8,
                    displayColors: false
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    ticks: { stepSize: 1, color: textColor, font: { family: 'Outfit' } },
                    grid: { color: gridColor, borderDash: [4, 4] },
                    border: { display: false }
                },
                x: {
                    ticks: { color: textColor, font: { family: 'Outfit' } },
                    grid: { display: false },
                    border: { display: false }
                }
            }
        }
    });

    // 2. CHART POPULER (Donat)
    @if(count($roomLabels) > 0)
    const ctxRoom = document.getElementById('roomChart').getContext('2d');
    new Chart(ctxRoom, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($roomLabels) !!},
            datasets: [{
                data: {!! json_encode($roomData) !!},
                backgroundColor: ['#0058be', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#0ea5e9'],
                borderWidth: 2,
                borderColor: '#ffffff',
                hoverOffset: 4
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: { 
                legend: { 
                    position: 'bottom',
                    labels: { 
                        usePointStyle: true, 
                        padding: 20, 
                        color: textColor,
                        font: { family: 'Outfit', size: 12 }
                    } 
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    bodyFont: { family: 'Outfit', size: 13, weight: 'bold' },
                    cornerRadius: 8
                }
            }
        }
    });
    @endif
});
</script>
@endsection