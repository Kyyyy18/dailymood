<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyMood - Loading...</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #11a8d2 0%, #0e94ba 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loading-container {
            text-align: center;
        }

        .logo {
            font-size: 48px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 15px;
        }

        .subtitle {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 40px;
            letter-spacing: 2px;
            font-weight: 500;
        }

        .loader {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .loader-dot {
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            animation: bounce 1.2s ease-in-out infinite;
        }

        .loader-dot:nth-child(1) { animation-delay: 0s; }
        .loader-dot:nth-child(2) { animation-delay: 0.15s; }
        .loader-dot:nth-child(3) { animation-delay: 0.3s; }

        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
            40% { transform: scale(1.2); opacity: 1; }
        }

        .progress-bar {
            width: 220px;
            height: 4px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 10px;
            margin: 0 auto;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #ffffff;
            border-radius: 10px;
            animation: progress 2s ease-out forwards;
        }

        @keyframes progress {
            from { width: 0%; }
            to { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="loading-container">
        <div class="logo">DailyMood</div>
        <div class="subtitle">PELACAKAN MOOD HARIAN</div>
        <div class="loader">
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
        </div>
        <div class="progress-bar">
            <div class="progress-fill"></div>
        </div>
        
        <p style="margin-top: 20px; color: rgba(255,255,255,0.7); font-size: 12px; display: none;" id="manual-link">
            Jika tidak dialihkan, <a href="{{ route('dashboard') }}" style="color: white; text-decoration: underline;">klik di sini</a>
        </p>
    </div>

    <script>
        // Tampilkan link manual jika loading terlalu lama (misal 5 detik)
        setTimeout(function() {
            document.getElementById('manual-link').style.display = 'block';
        }, 5000);

        setTimeout(function() {
            window.location.href = "{{ route('dashboard') }}";
        }, 2300);
    </script>
</body>
</html>
