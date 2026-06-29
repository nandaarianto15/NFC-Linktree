<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Scanner Simulator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Library QR Scanner -->
    <script src="https://unpkg.com/html5-qrcode"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen flex flex-col items-center justify-center p-4">

    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 text-center">
        <h2 class="text-xl font-bold mb-2">Scan QR Kartu Anda</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Arahkan kamera ke QR Code yang ada di dashboard user.</p>
        
        <!-- Wadah Kamera Scan -->
        <div id="reader" class="overflow-hidden rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600"></div>
        
        <!-- Form Input Terkunci -->
        <div class="mt-6">
            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Hasil Token Terdeteksi</label>
            <input type="text" id="token-input" readonly 
                   class="w-full text-center bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-xl py-3 px-4 focus:outline-none font-mono text-sm" 
                   placeholder="Menunggu scan QR...">
        </div>
    </div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // decodedText berisi URL penuh dari QR, misal: http://localhost:8000/p/XYZ123
            document.getElementById('token-input').value = decodedText;
            
            // Hentikan kamera agar tidak scan berkali-kali
            html5QrcodeScanner.clear().then(() => {
                // Beri jeda 1 detik agar user sempat melihat inputan terisi, lalu redirect
                setTimeout(() => {
                    window.location.href = decodedText;
                }, 1000);
            }).catch(error => {
                console.error("Gagal menghentikan scanner: ", error);
                window.location.href = decodedText;
            });
        }

        function onScanFailure(error) {
            // Diabaikan saja agar konsol tidak penuh log error frame kamera yang miss scan
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 15, qrbox: { width: 250, height: 250 } }, /* verbose= */ false
        );
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</body>
</html>