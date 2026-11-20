# HomeService — Panduan Instalasi Lengkap

> **Platform Marketplace Jasa Rumah Tangga**  
> "Your Home, Our Service."

---

## Prasyarat

Pastikan sudah terinstall:
- **PHP 8.1+** (via XAMPP di `D:\xampp\php\php.exe`)
- **Composer** (di `D:\xampp\php\composer.phar`)
- **MySQL 5.7+** (via XAMPP / Laragon)
- **Laragon** (web server lokal)
- **Git** (opsional)

---

## Langkah Instalasi

### 1. Buat Project Laravel Baru

Buka Command Prompt dan jalankan:

```bash
cd D:\laragon\www

php D:\xampp\php\composer.phar create-project laravel/laravel homeservice "10.*"
```

> Tunggu hingga selesai (~2–5 menit tergantung koneksi internet)

---

### 2. Salin File Project

Salin **semua file dan folder** dari `D:\home servis tugas\` ke dalam `D:\laragon\www\homeservice\`:

```
D:\home servis tugas\app\          → D:\laragon\www\homeservice\app\
D:\home servis tugas\config\       → D:\laragon\www\homeservice\config\
D:\home servis tugas\database\     → D:\laragon\www\homeservice\database\
D:\home servis tugas\public\css\   → D:\laragon\www\homeservice\public\css\
D:\home servis tugas\public\js\    → D:\laragon\www\homeservice\public\js\
D:\home servis tugas\resources\    → D:\laragon\www\homeservice\resources\
D:\home servis tugas\routes\       → D:\laragon\www\homeservice\routes\
```

> **Catatan:** Jangan overwrite `public/index.php` dan `bootstrap/app.php` yang sudah dibuat Laravel — gunakan yang ada di folder Laravel.

---

### 3. Konfigurasi Environment

```bash
cd D:\laragon\www\homeservice

# Copy environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

Buka `.env` dan sesuaikan:

```env
APP_NAME=HomeService
APP_URL=http://homeservice.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homeservice
DB_USERNAME=root
DB_PASSWORD=

# Midtrans (opsional untuk development)
MIDTRANS_SERVER_KEY=
MIDTRANS_CLIENT_KEY=
MIDTRANS_IS_PRODUCTION=false
```

---

### 4. Buat Database

Buka **phpMyAdmin** (http://localhost/phpmyadmin) atau jalankan:

```sql
CREATE DATABASE homeservice CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

### 5. Jalankan Migrasi & Seeder

```bash
cd D:\laragon\www\homeservice

# Jalankan migrasi (buat semua 18 tabel)
php artisan migrate

# Jalankan seeder (isi data demo)
php artisan db:seed

# Atau keduanya sekaligus
php artisan migrate --seed
```

---

### 6. Storage Link

```bash
php artisan storage:link
```

---

### 7. Konfigurasi Laragon Virtual Host

1. Buka Laragon
2. Klik kanan icon Laragon → **Sites** → **Add**
3. Tambahkan:
   - **Document Root:** `D:\laragon\www\homeservice\public`
   - **Server Name:** `homeservice.test`
4. Klik **Save**
5. Restart Laragon

Atau tambahkan manual ke `C:\laragon\etc\nginx\sites-enabled\homeservice.test.conf`:

```nginx
server {
    listen 80;
    server_name homeservice.test;
    root "D:/laragon/www/homeservice/public";
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

---

### 8. Tambahkan ke Hosts File

Buka `C:\Windows\System32\drivers\etc\hosts` sebagai Administrator:

```
127.0.0.1   homeservice.test
```

---

### 9. Akses Website

Buka browser dan akses:

| URL | Keterangan |
|-----|-----------|
| http://homeservice.test | Homepage |
| http://homeservice.test/login | Login |
| http://homeservice.test/daftar | Daftar Pelanggan |
| http://homeservice.test/daftar-teknisi | Daftar Teknisi |

---

## Akun Demo (setelah `php artisan db:seed`)

| Role | Email | Password |
|------|-------|----------|
| **Admin** | admin@homeservice.id | password123 |
| **Pelanggan** | pelanggan@homeservice.id | password123 |
| **Teknisi** | teknisi@homeservice.id | password123 |

---

## URL Dashboard

| Dashboard | URL |
|-----------|-----|
| Admin | http://homeservice.test/admin/dashboard |
| Pelanggan | http://homeservice.test/pelanggan/dashboard |
| Teknisi | http://homeservice.test/teknisi/dashboard |

---

## Konfigurasi Midtrans (Pembayaran Online)

1. Daftar akun di https://midtrans.com
2. Masuk ke Sandbox Dashboard
3. Ambil **Server Key** dan **Client Key**
4. Isi di file `.env`:

```env
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxx
MIDTRANS_IS_PRODUCTION=false
```

5. Set Webhook URL di Midtrans Dashboard:
   - **Notification URL:** `http://homeservice.test/api/midtrans/webhook`

---

## Struktur Halaman

### Public Website (14 halaman)
- `/` — Homepage
- `/kategori` — Semua Kategori
- `/layanan` — Daftar Layanan
- `/layanan/{slug}` — Detail Layanan
- `/teknisi` — Daftar Teknisi
- `/teknisi/{id}` — Profil Teknisi
- `/tentang` — Tentang HomeService
- `/cara-kerja` — Cara Kerja
- `/faq` — FAQ
- `/kontak` — Kontak
- `/syarat-ketentuan` — Syarat & Ketentuan
- `/kebijakan-privasi` — Kebijakan Privasi
- `/login` — Login
- `/daftar` — Daftar
- `/daftar-teknisi` — Daftar Teknisi

### Customer Dashboard
- `/pelanggan/dashboard` — Overview
- `/pelanggan/profil` — Edit Profil
- `/pelanggan/pesanan` — Daftar Pesanan
- `/pelanggan/pesanan/buat` — Buat Pesanan
- `/pelanggan/pesanan/{code}` — Detail Pesanan
- `/pelanggan/pesanan/{code}/bayar` — Halaman Bayar
- `/pelanggan/pesanan/{code}/ulasan` — Beri Ulasan
- `/pelanggan/alamat` — Kelola Alamat
- `/pelanggan/pesan` — Chat
- `/pelanggan/notifikasi` — Notifikasi
- `/pelanggan/favorit` — Teknisi Favorit
- `/pelanggan/pengaduan` — Pengaduan

### Provider (Teknisi) Dashboard
- `/teknisi/dashboard` — Overview
- `/teknisi/profil` — Edit Profil
- `/teknisi/pesanan` — Kelola Pesanan
- `/teknisi/layanan-saya` — Layanan yang Ditawarkan
- `/teknisi/penghasilan` — Penghasilan
- `/teknisi/verifikasi` — Upload Dokumen Verifikasi
- `/teknisi/pesan` — Chat dengan Pelanggan

### Admin Dashboard
- `/admin/dashboard` — Overview Platform
- `/admin/pengguna` — Manajemen Pengguna
- `/admin/verifikasi` — Verifikasi Teknisi
- `/admin/kategori` — Kelola Kategori
- `/admin/layanan` — Kelola Layanan Master
- `/admin/pesanan` — Monitoring Pesanan
- `/admin/pembayaran` — Rekonsiliasi Pembayaran
- `/admin/pengaduan` — Manajemen Pengaduan
- `/admin/pengaturan` — Pengaturan Platform

---

## Teknologi

| Layer | Teknologi |
|-------|-----------|
| Backend | PHP 8.1, Laravel 10 |
| Frontend | Blade, Vanilla CSS/JS |
| Database | MySQL |
| Auth | Laravel built-in Auth |
| Payment | Midtrans Snap |
| Icons | Bootstrap Icons 1.11.3 |
| Fonts | Google Fonts (Poppins + Inter) |
| Server | Laragon + XAMPP PHP |

---

## Troubleshooting

### Error: `Class 'App\Http\Middleware\EnsureUserRole' not found`
Jalankan: `php artisan optimize:clear`

### Error: Database connection refused
Pastikan MySQL di Laragon/XAMPP sudah berjalan.

### Halaman tidak ditemukan (404)
Pastikan Laragon sudah dikonfigurasi dengan benar dan file `.htaccess` ada di `public/`.

### Composer tidak ditemukan
Gunakan: `php D:\xampp\php\composer.phar <command>`

### Storage tidak bisa diakses
Jalankan: `php artisan storage:link`

---

## Support

Jika ada masalah instalasi, periksa:
1. `storage/logs/laravel.log` untuk error detail
2. Pastikan folder `storage/` dan `bootstrap/cache/` bisa ditulis (write permission)
3. Jalankan `php artisan config:clear` dan `php artisan cache:clear`
