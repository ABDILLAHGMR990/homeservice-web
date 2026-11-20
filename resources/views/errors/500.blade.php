<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 — Server Error | HomeService</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #F7F8FA; color: #202938; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 32px 16px; }
        .error-container { text-align: center; max-width: 480px; }
        .error-code { font-family: 'Poppins', sans-serif; font-size: 96px; font-weight: 700; color: #142B49; line-height: 1; margin-bottom: 8px; }
        .error-code span { color: #EBAA32; }
        .error-title { font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 600; margin-bottom: 12px; }
        .error-desc { color: #687386; font-size: 15px; line-height: 1.6; margin-bottom: 32px; }
        .error-icon { font-size: 56px; color: #EBAA32; opacity: 0.4; margin-bottom: 24px; }
        .btn-home { display: inline-flex; align-items: center; gap: 8px; background: #142B49; color: #fff; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 15px; }
        .hs-brand { display: flex; align-items: center; gap: 10px; justify-content: center; margin-bottom: 40px; }
        .hs-brand-logo { width: 36px; height: 36px; background: #142B49; border-radius: 8px; display: flex; align-items: center; justify-content: center; }
        .hs-brand-name { font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 700; color: #142B49; }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="hs-brand">
            <div class="hs-brand-logo"><i class="bi bi-house-fill" style="color:#F59E0B;font-size:18px;"></i></div>
            <span class="hs-brand-name">HomeService</span>
        </div>
        <div class="error-icon"><i class="bi bi-exclamation-triangle"></i></div>
        <div class="error-code">5<span>0</span>0</div>
        <div class="error-title">Terjadi Kesalahan Server</div>
        <p class="error-desc">Server sedang mengalami gangguan. Tim kami sudah diberitahu dan sedang menangani masalah ini. Silakan coba lagi beberapa saat.</p>
        <a href="{{ url('/') }}" class="btn-home"><i class="bi bi-house"></i> Kembali ke Beranda</a>
    </div>
</body>
</html>
