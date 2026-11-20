<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BookingManagementController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\MasterServiceController;
use App\Http\Controllers\Admin\PaymentReconciliationController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\Customer\AddressController;
use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\Provider\EarningsController;
use App\Http\Controllers\Provider\ProviderBookingController;
use App\Http\Controllers\Provider\ProviderDashboardController;
use App\Http\Controllers\Provider\ProviderProfileController;
use App\Http\Controllers\Provider\ProviderServiceController;
use App\Http\Controllers\Provider\VerificationUploadController;
use App\Http\Controllers\Public\Auth\AuthController;
use App\Http\Controllers\Public\CategoryCatalogController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ServiceCatalogController;
use App\Http\Controllers\Public\StaticPagesController;
use App\Http\Controllers\Public\TechnicianDirectoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (no auth required)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/daftar', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/daftar', [AuthController::class, 'register'])->name('register.post');
    Route::get('/daftar-teknisi', [AuthController::class, 'showProviderRegister'])->name('provider.register');
    Route::post('/daftar-teknisi', [AuthController::class, 'registerProvider'])->name('register.provider.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Customer Routes  (prefix: /pelanggan)
|--------------------------------------------------------------------------
*/

Route::prefix('pelanggan')
    ->name('customer.')
    ->middleware(['auth', 'role:customer'])
    ->group(function () {

        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        // Bookings
        Route::get('/pesanan', [BookingController::class, 'index'])->name('bookings.index');
        Route::get('/pesanan/buat', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('/pesanan', [BookingController::class, 'store'])->name('bookings.store');
        Route::get('/pesanan/{booking_code}', [BookingController::class, 'show'])->name('bookings.show');
        Route::post('/pesanan/{booking_code}/batalkan', [BookingController::class, 'cancel'])->name('bookings.cancel');

        // Payment page (Midtrans Snap)
        Route::get('/pesanan/{booking_code}/bayar', function (string $booking_code) {
            $booking = \App\Models\Booking::where('booking_code', $booking_code)
                ->where('customer_id', auth()->id())
                ->with(['items', 'customer'])
                ->firstOrFail();

            $snapToken = null;
            $clientKey = config('midtrans.client_key');
            $isProduction = config('midtrans.is_production', false);

            try {
                if (config('midtrans.server_key')) {
                    $service = app(\App\Services\MidtransPaymentService::class);
                    $data = $service->createSnapToken($booking);
                    $snapToken = $data['token'];
                    $clientKey = $data['client_key'];
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Payment page error: ' . $e->getMessage());
            }

            return view('customer.bookings.payment', compact('booking', 'snapToken', 'clientKey', 'isProduction'));
        })->name('bookings.payment');

        // Reviews
        Route::get('/pesanan/{booking_code}/ulasan', [ReviewController::class, 'create'])->name('reviews.create');
        Route::post('/pesanan/{booking_code}/ulasan', [ReviewController::class, 'store'])->name('reviews.store');

        // Addresses
        Route::get('/alamat', [AddressController::class, 'index'])->name('addresses.index');
        Route::post('/alamat', [AddressController::class, 'store'])->name('addresses.store');
        Route::put('/alamat/{address}', [AddressController::class, 'update'])->name('addresses.update');
        Route::delete('/alamat/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
        Route::post('/alamat/{address}/utama', [AddressController::class, 'setPrimary'])->name('addresses.primary');

        // Chat
        Route::get('/pesan', function () {
            return view('customer.chat.index');
        })->name('chat.index');

        // Notifications
        Route::get('/notifikasi', function () {
            return view('customer.notifications.index');
        })->name('notifications.index');
        Route::post('/notifikasi/baca-semua', function () {
            return back()->with('success', 'Semua notifikasi telah ditandai dibaca.');
        })->name('notifications.read-all');

        // Favorites
        Route::get('/favorit', function () {
            $favorites = collect();
            return view('customer.favorites.index', compact('favorites'));
        })->name('favorites.index');
        Route::delete('/favorit/{user}', function (\App\Models\User $user) {
            return back()->with('success', 'Dihapus dari favorit.');
        })->name('favorites.destroy');

        // Complaints (customer side)
        Route::get('/pengaduan', function () {
            $complaints = \App\Models\Complaint::where('customer_id', auth()->id())
                ->with('booking')->latest()->paginate(10);
            return view('customer.complaints.index', compact('complaints'));
        })->name('complaints.index');
        Route::post('/pengaduan', function (\Illuminate\Http\Request $request) {
            $request->validate([
                'booking_id' => 'required|exists:bookings,id',
                'subject'    => 'required|string|max:200',
                'description'=> 'required|string|max:2000',
            ]);
            \App\Models\Complaint::create([
                'booking_id'    => $request->booking_id,
                'customer_id'   => auth()->id(),
                'ticket_number' => \App\Models\Complaint::generateTicketNumber(),
                'subject'       => $request->subject,
                'description'   => $request->description,
                'status'        => 'open',
                'priority'      => 'medium',
            ]);
            return back()->with('success', 'Pengaduan berhasil dikirim. Tim kami akan segera merespons.');
        })->name('complaints.store');
    });

/*
|--------------------------------------------------------------------------
| Provider Routes  (prefix: /teknisi)
| ★ MUST be registered BEFORE the public /teknisi/{username} catch-all
|--------------------------------------------------------------------------
*/

Route::prefix('teknisi')
    ->name('provider.')
    ->middleware(['auth', 'role:provider'])
    ->group(function () {

        // Profile (accessible always, even before verified)
        Route::get('/profil', [ProviderProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profil', [ProviderProfileController::class, 'update'])->name('profile.update');
        Route::put('/profil/password', [ProviderProfileController::class, 'updatePassword'])->name('profile.password');
        Route::put('/profil/ketersediaan', [ProviderProfileController::class, 'toggleAvailability'])->name('profile.availability');

        // Verification (accessible before verified)
        Route::get('/verifikasi', [VerificationUploadController::class, 'index'])->name('verification.index');
        Route::post('/verifikasi/upload', [VerificationUploadController::class, 'upload'])->name('verification.upload');

        // Routes that require verified status
        Route::middleware('provider.verified')->group(function () {
            Route::get('/dashboard', [ProviderDashboardController::class, 'index'])->name('dashboard');

            Route::get('/pesanan', [ProviderBookingController::class, 'index'])->name('bookings.index');
            Route::get('/pesanan/{booking_code}', [ProviderBookingController::class, 'show'])->name('bookings.show');
            Route::post('/pesanan/{booking_code}/status', [ProviderBookingController::class, 'updateStatus'])->name('bookings.update-status');

            Route::get('/layanan-saya', [ProviderServiceController::class, 'index'])->name('services.index');
            Route::post('/layanan-saya', [ProviderServiceController::class, 'store'])->name('services.store');
            Route::delete('/layanan-saya/{providerService}', [ProviderServiceController::class, 'destroy'])->name('services.destroy');
            Route::post('/layanan-saya/{providerService}/toggle', [ProviderServiceController::class, 'toggleActive'])->name('services.toggle');

            Route::get('/penghasilan', [EarningsController::class, 'index'])->name('earnings.index');

            // Chat
            Route::get('/pesan', function () {
                return view('provider.chat.index');
            })->name('chat.index');
        });
    });

/*
|--------------------------------------------------------------------------
| Admin Routes  (prefix: /admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Users & Technicians
        Route::get('/pengguna', [UserManagementController::class, 'index'])->name('users.index');
        Route::post('/pengguna', [UserManagementController::class, 'store'])->name('users.store');
        Route::put('/pengguna/{user}/toggle', [UserManagementController::class, 'toggle'])->name('users.toggle');
        Route::delete('/pengguna/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');

        // Verifications
        Route::get('/verifikasi', [VerificationController::class, 'index'])->name('verifications.index');
        Route::post('/verifikasi/{profile}/setujui', [VerificationController::class, 'approve'])->name('verifications.approve');
        Route::post('/verifikasi/{profile}/tolak', [VerificationController::class, 'reject'])->name('verifications.reject');
        Route::get('/verifikasi/dokumen/{document}', [VerificationController::class, 'viewDocument'])->name('verifications.document');

        // Categories
        Route::get('/kategori', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/kategori', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/kategori/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/kategori/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Services
        Route::get('/layanan', [MasterServiceController::class, 'index'])->name('services.index');
        Route::post('/layanan', [MasterServiceController::class, 'store'])->name('services.store');
        Route::put('/layanan/{service}', [MasterServiceController::class, 'update'])->name('services.update');
        Route::delete('/layanan/{service}', [MasterServiceController::class, 'destroy'])->name('services.destroy');

        // Bookings
        Route::get('/pesanan', [BookingManagementController::class, 'index'])->name('bookings.index');
        Route::post('/pesanan/{booking_code}/batalkan', [BookingManagementController::class, 'forceCancel'])->name('bookings.cancel');

        // Payments
        Route::get('/pembayaran', [PaymentReconciliationController::class, 'index'])->name('payments.index');
        Route::post('/pembayaran/{payment}/lunas', [PaymentReconciliationController::class, 'markAsPaid'])->name('payments.mark-paid');

        // Complaints
        Route::get('/pengaduan', [AdminComplaintController::class, 'index'])->name('complaints.index');
        Route::post('/pengaduan/{complaint}/status', [AdminComplaintController::class, 'updateStatus'])->name('complaints.update-status');

        // Settings
        Route::get('/pengaturan', function () {
            $settings = \App\Models\CommissionSetting::current();
            return view('admin.settings.index', compact('settings'));
        })->name('settings.index');
        Route::put('/pengaturan', function (\Illuminate\Http\Request $request) {
            $request->validate([
                'platform_commission_percent' => 'required|numeric|min:0|max:100',
                'min_withdrawal_amount'       => 'required|numeric|min:0',
                'warranty_days'               => 'required|integer|min:0|max:365',
                'auto_complete_hours'         => 'required|integer|min:1|max:168',
            ]);
            \App\Models\CommissionSetting::current()->update($request->only([
                'platform_commission_percent',
                'min_withdrawal_amount',
                'warranty_days',
                'auto_complete_hours',
            ]));
            return back()->with('success', 'Pengaturan platform berhasil disimpan.');
        })->name('settings.update');
    });

/*
|--------------------------------------------------------------------------
| Public Catalog & Static Pages
| ★ Wildcard {username} is registered AFTER all /teknisi/* panel routes
|--------------------------------------------------------------------------
*/

Route::name('public.')->group(function () {
    Route::get('/kategori', [CategoryCatalogController::class, 'index'])->name('categories.index');
    Route::get('/layanan', [ServiceCatalogController::class, 'index'])->name('services.index');
    Route::get('/layanan/{slug}', [ServiceCatalogController::class, 'show'])->name('services.show');
    Route::get('/teknisi', [TechnicianDirectoryController::class, 'index'])->name('technicians.index');
    Route::get('/teknisi/{username}', [TechnicianDirectoryController::class, 'show'])->name('technicians.show');
    Route::get('/tentang', [StaticPagesController::class, 'about'])->name('about');
    Route::get('/cara-kerja', [StaticPagesController::class, 'howItWorks'])->name('how-it-works');
    Route::get('/faq', [StaticPagesController::class, 'faq'])->name('faq');
    Route::get('/kontak', [StaticPagesController::class, 'contact'])->name('contact');
    Route::post('/kontak', [StaticPagesController::class, 'sendContact'])->name('contact.send');
    Route::get('/syarat-ketentuan', [StaticPagesController::class, 'terms'])->name('terms');
    Route::get('/kebijakan-privasi', [StaticPagesController::class, 'privacy'])->name('privacy');
});

/*
|--------------------------------------------------------------------------
| Midtrans Webhook
|--------------------------------------------------------------------------
*/

Route::post('/api/midtrans/webhook', function (\Illuminate\Http\Request $request) {
    try {
        $service = app(\App\Services\MidtransPaymentService::class);
        $service->handleWebhook($request->all());
        return response()->json(['status' => 'ok']);
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Midtrans webhook error: ' . $e->getMessage());
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
    }
})->name('midtrans.webhook');
