@extends('layouts.stitch')

@section('title', 'QR Code Scanner - JTIKROOMS')

@section('content')
<div class="p-space-md lg:p-space-xl flex flex-col items-center justify-center min-h-[calc(100vh-100px)] relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-1/4 -left-20 w-64 h-64 bg-primary/10 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-1/4 -right-20 w-64 h-64 bg-secondary/10 rounded-full blur-3xl -z-10"></div>

    <div class="max-w-md w-full flex flex-col gap-space-lg">
        <!-- Header -->
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-primary-container text-on-primary-container mb-4 shadow-sm">
                <span class="material-symbols-outlined text-4xl">qr_code_scanner</span>
            </div>
            <h1 class="font-display-sm text-3xl font-bold text-on-surface mb-2">Scan QR Ruangan</h1>
            <p class="font-body-md text-on-surface-variant">Arahkan kamera Anda ke QR Code yang tertempel di pintu ruangan untuk melihat status dan melakukan booking.</p>
        </div>

<!-- Scanner Container -->
        <div class="bg-surface-container-lowest p-4 rounded-3xl shadow-lg border border-outline-variant/30 relative">
            <div class="aspect-square w-full bg-black rounded-2xl overflow-hidden relative" id="reader-container">
                <!-- Wrapper for html5-qrcode -->
                <div id="reader" class="w-full h-full"></div>
                
                <!-- Overlay Frame (Optional if we want custom UI, but we can keep it as overlay) -->
                <div class="absolute inset-0 pointer-events-none border-[40px] border-black/40 z-10">
                    <!-- Corner markers -->
                    <div class="absolute top-0 left-0 w-8 h-8 border-t-4 border-l-4 border-primary rounded-tl-lg"></div>
                    <div class="absolute top-0 right-0 w-8 h-8 border-t-4 border-r-4 border-primary rounded-tr-lg"></div>
                    <div class="absolute bottom-0 left-0 w-8 h-8 border-b-4 border-l-4 border-primary rounded-bl-lg"></div>
                    <div class="absolute bottom-0 right-0 w-8 h-8 border-b-4 border-r-4 border-primary rounded-br-lg"></div>
                    
                    <!-- Scan line animation -->
                    <div class="absolute top-0 left-0 right-0 h-0.5 bg-primary/80 shadow-[0_0_10px_rgba(0,88,190,0.8)] w-full animate-[scan_2s_ease-in-out_infinite]"></div>
                </div>
            </div>
            
            <div id="scan-status" class="mt-4 py-3 px-4 rounded-xl bg-surface-container font-label-md text-center text-on-surface-variant flex items-center justify-center gap-2">
                <span class="material-symbols-outlined animate-spin">sync</span>
                Sedang menginisialisasi kamera...
            </div>
        </div>

        <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 w-full py-4 bg-surface-container-lowest hover:bg-surface-container-low text-on-surface font-label-lg font-bold rounded-2xl border border-outline-variant/30 transition-all shadow-sm">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            Kembali ke Beranda
        </a>
    </div>
</div>

<style>
@keyframes scan {
    0% { top: 0; opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { top: 100%; opacity: 0; }
}
/* Menyembunyikan border bawaan html5-qrcode */
#reader { border: none !important; }
#reader video { object-fit: cover; }
</style>

<!-- Load html5-qrcode JS Library -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let statusEl = document.getElementById('scan-status');
    let isProcessing = false;

    // Inisialisasi Html5Qrcode
    const html5QrCode = new Html5Qrcode("reader");

    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
        if (isProcessing) return;
        isProcessing = true; // cegah double scan

        statusEl.innerHTML = '<span class="material-symbols-outlined text-emerald-600">check_circle</span> <span class="text-emerald-800 font-bold">QR Ditemukan! Memverifikasi...</span>';
        statusEl.className = 'mt-4 py-3 px-4 rounded-xl bg-emerald-100 font-label-md text-center flex items-center justify-center gap-2';
        
        // Hentikan kamera saat memproses
        html5QrCode.stop().then(() => {
            console.log("Scanner stopped.");
        }).catch(err => console.log(err));

        let roomName = decodedText;
        
        // Ekstrak nama ruangan jika QR berisi URL lengkap
        if (decodedText.startsWith('http://') || decodedText.startsWith('https://')) {
            if (decodedText.includes('/room/')) {
                roomName = decodeURIComponent(decodedText.split('/room/')[1].split('?')[0]);
            } else if (decodedText.includes('/booking/create/')) {
                roomName = decodeURIComponent(decodedText.split('/booking/create/')[1].split('?')[0]);
            }
        }
        
        // Verifikasi ke server
        fetch('{{ route('qr.verify') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ room_name: roomName })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                alert('Gagal memverifikasi QR Code ruangan.');
                isProcessing = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan jaringan saat memverifikasi QR.');
            isProcessing = false;
        });
    };

    const config = { fps: 10, qrbox: { width: 250, height: 250 }, aspectRatio: 1.0 };

    // Mulai kamera (kamera belakang)
    html5QrCode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback)
    .then(() => {
        statusEl.innerHTML = '<span class="material-symbols-outlined text-primary">filter_center_focus</span> <span class="text-primary font-bold">Arahkan kamera ke QR Code</span>';
        statusEl.className = 'mt-4 py-3 px-4 rounded-xl bg-primary/10 font-label-md text-center flex items-center justify-center gap-2';
    })
    .catch(err => {
        statusEl.innerHTML = '<span class="material-symbols-outlined text-error">error</span> <span class="text-error font-bold">Kamera gagal diakses</span>';
        statusEl.className = 'mt-4 py-3 px-4 rounded-xl bg-error-container font-label-md text-center flex items-center justify-center gap-2';
        console.error("Gagal memulai scanner:", err);
    });
});
</script>
@endsection