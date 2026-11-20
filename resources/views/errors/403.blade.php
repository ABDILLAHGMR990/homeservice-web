<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Akses Ditolak | HomeService</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #F7F8FA;
            color: #202938;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            padding: 32px 16px;
        }
        .error-container { text-align: center; max-width: 480px; }
        .error-code { font-family: 'Poppins', sans-serif; font-size: 96px; font-weight: 700; color: #142B49; line-height: 1; margin-bottom: 8px; }
        .error-code span { color: #DC4444; }
        .error-title { font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 600; margin-bottom: 12px; }
        .error-desc { color: #687386; font-size: 15px; line-height: 1.6; margin-bottom: 32px; }
        .error-icon { font-size: 56px; color: #DC4444; opacity: 0.3; margin-bottom: 24px; }
        .btn-home { display: inline-flex; align-items: center; gap: 8px; background: #142B49; color: #fff; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 15px; transition: background 0.2s; }
        .btn-home:hover { background: #1a3a60; color: #fff; }
        .btn-back { display: inline-flex; align-items: center; gap: 8px; border: 1.5px solid #E5E9EF; color: #687386; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 15px; margin-left: 12px; transition: all 0.2s; }
        .btn-back:hover { border-color: #142B49; color: #142B49; }
        .hs-brand { display: flex; align-items: center; gap: 10px; justify-content: center; margin-bottom: 40px; }
        .hs-brand-logo { width: 36px; height: 36px; background: #142B49; border-radius: 8px; display: flex; align-items: center; justify-content: center; }
        .hs-brand-name { font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 700; color: #142B49; }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="hs-brand">
            <div class="hs-brand-logo">
                <i class="bi bi-house-fill" style="color:#F59E0B;font-size:18px;"></i>
            </div>
            <span class="hs-brand-name">HomeService</span>
        </div>

        <div class="error-icon"><i class="bi bi-shield-x"></i></div>

        <div class="error-code">4<span>0</span>3</div>
        <div class="error-title">Akses Tidak Diizinkan</div>
        <p class="error-desc">
            Anda tidak memiliki izin untuk mengakses halaman ini.
            Pastikan Anda sudah login dengan akun yang sesuai.
        </p>

        <div>
            <a href="{{ url('/') }}" class="btn-home"><i class="bi bi-house"></i> Ke Beranda</a>
            <a href="javascript:history.back()" class="btn-back"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
    </div>
</body>
</html>
