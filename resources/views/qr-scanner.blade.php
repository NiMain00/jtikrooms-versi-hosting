@extends('layouts.app')

@section('title', 'Scan QR Code - JTIK ROOM\'S')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-qrcode me-2"></i>Scan QR Code
                    </h4>
                </div>
                <div class="card-body text-center">
                    <p class="text-muted">Arahkan kamera ke QR code di pintu ruangan</p>
                    
                    <div id="reader" class="border rounded" style="width: 100%; height: 400px; background: #f8f9fa;"></div>
                    
                    <div class="mt-3">
                        <button id="btn-start" class="btn btn-success">
                            <i class="fas fa-play me-2"></i>Start Camera
                        </button>
                        <button id="btn-stop" class="btn btn-danger" style="display: none;">
                            <i class="fas fa-stop me-2"></i>Stop Camera
                        </button>
                    </div>

                    <!-- Bantuan Kamera (Troubleshooting) -->
                    <div class="mt-3 text-start alert alert-info py-2 px-3" style="font-size: 0.85rem; max-width: 400px; margin: 0 auto;">
                        <i class="fas fa-question-circle me-1"></i> <strong>Kamera tidak muncul?</strong>
                        <ul class="mb-0 ps-3 mt-1">
                            <li>Pastikan Anda telah memberikan izin akses kamera pada browser.</li>
                            <li>Gunakan browser Chrome/Safari versi terbaru.</li>
                            <li>Pastikan berada di ruangan dengan pencahayaan cukup.</li>
                        </ul>
                    </div>

                    <div id="scan-result" class="mt-4 p-3 border rounded bg-light" style="display: none;">
                        <h5>Hasil Scan:</h5>
                        <p id="result-text" class="fw-bold fs-5 text-primary"></p>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <button id="btn-buka" class="btn btn-primary"><i class="fas fa-external-link-alt me-2"></i>Buka</button>
                            <button id="btn-batal" class="btn btn-secondary"><i class="fas fa-times me-2"></i>Batal & Pindai Ulang</button>
                        </div>
                    </div>

                    <div class="mt-4">
                        <p class="text-muted mb-2">Kamera bermasalah? Ketik kode ruangan manual (misal: AE 101):</p>
                        <div class="input-group" style="max-width: 300px; margin: 0 auto;">
                            <input type="text" id="manual-code" class="form-control" placeholder="Kode Ruangan">
                            <button id="btn-manual" class="btn btn-primary">Buka</button>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('dashboard.kelas') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>

<script>
let html5QrcodeScanner = null;

document.getElementById('btn-start').addEventListener('click', function() {
    startScanner();
});

document.getElementById('btn-stop').addEventListener('click', function() {
    stopScanner();
});

function startScanner() {
    if (typeof Html5QrcodeScanner === 'undefined') {
        alert('ERROR: Library tidak terload!');
        return;
    }

    try {
        html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { 
                fps: 10, 
                qrbox: { width: 250, height: 250 }
            },
            false
        );

        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        
        document.getElementById('btn-start').style.display = 'none';
        document.getElementById('btn-stop').style.display = 'inline-block';
        
    } catch (error) {
        alert('Error: ' + error.message);
    }
}

function stopScanner() {
    if (html5QrcodeScanner) {
        html5QrcodeScanner.clear().catch(error => {
            console.log("Scanner stopped");
        });
        html5QrcodeScanner = null;
    }
    document.getElementById('btn-start').style.display = 'inline-block';
    document.getElementById('btn-stop').style.display = 'none';
}

function onScanSuccess(decodedText, decodedResult) {
    console.log('QR Code scanned:', decodedText);
    
    // STOP SCANNER
    stopScanner();
    
    // Tampilkan hasil
    document.getElementById('scan-result').style.display = 'block';
    document.getElementById('result-text').innerText = decodedText;
    
    document.getElementById('btn-buka').onclick = function() {
        processQRResult(decodedText);
    };
    
    document.getElementById('btn-batal').onclick = function() {
        document.getElementById('scan-result').style.display = 'none';
        startScanner();
    };
}

function processQRResult(decodedText) {
    // Set session sebelum redirect (gunakan fetch API)
    fetch('/set-qr-session', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ from_qr: true })
    })
    .then(response => response.json())
    .then(data => {
        window.location.href = decodedText.startsWith('http') ? decodedText : '/room/' + decodedText;
    })
    .catch(error => {
        console.error('Error setting session:', error);
        window.location.href = decodedText.startsWith('http') ? decodedText : '/room/' + decodedText;
    });
}

document.getElementById('btn-manual').addEventListener('click', function() {
    const code = document.getElementById('manual-code').value.trim();
    if(code) {
        processQRResult(code);
    }
});

function onScanFailure(error) {
    // Ignore errors
}
</script>

<style>
#reader video {
    border-radius: 10px;
    width: 100% !important;
}
</style>
@endsection