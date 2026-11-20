<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with realistic production-ready demo data.
     */
    public function run(): void
    {
        // 1. Commission Settings
        DB::table('commission_settings')->insert([
            'platform_commission_percent' => 10.00,
            'min_withdrawal_amount' => 50000.00,
            'warranty_days' => 14,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Core Users (Admin, Customer, Provider)
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Super Administrator HQ',
            'email' => 'admin@homeservice.id',
            'phone' => '08001466373',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $customerId = DB::table('users')->insertGetId([
            'name' => 'Dian Anggraini',
            'email' => 'pelanggan@homeservice.id',
            'phone' => '081234567890',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $providerId = DB::table('users')->insertGetId([
            'name' => 'Budi Santoso',
            'email' => 'teknisi@homeservice.id',
            'phone' => '081298765432',
            'password' => Hash::make('password123'),
            'role' => 'provider',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Provider Profile
        $profileId = DB::table('provider_profiles')->insertGetId([
            'user_id' => $providerId,
            'nik' => '3174052108890003',
            'expertise' => 'Spesialis AC & Pendingin Ruangan',
            'experience_years' => 7,
            'bio' => 'Teknisi AC bersertifikat BNSP Refrigerasi. Berpengalaman menangani sistem pendingin split, inverter, dan komersial.',
            'primary_service_area' => 'Jakarta Selatan, Depok & Tangsel',
            'rating' => 4.90,
            'total_reviews' => 320,
            'completed_jobs' => 348,
            'verification_status' => 'verified',
            'is_available' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Provider Documents (KTP Verified)
        DB::table('provider_documents')->insert([
            'provider_profile_id' => $profileId,
            'document_type' => 'ktp',
            'file_path' => 'documents/ktp_budi_santoso_verified.jpg',
            'status' => 'approved',
            'admin_note' => 'Dokumen NIK dan foto KTP fisik cocok dengan data Dukcapil.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 5. 10 Kategori Layanan Rumah Tangga
        $categoriesData = [
            ['name' => 'Service AC', 'slug' => 'service-ac', 'icon' => 'bi-snow', 'description' => 'Perawatan rutin, cuci AC, isi freon, dan perbaikan kompresor mati.'],
            ['name' => 'Instalasi Listrik', 'slug' => 'instalasi-listrik', 'icon' => 'bi-lightning-charge', 'description' => 'Pemasangan jalur kabel baru, box sekring MCB, dan penangkal petir.'],
            ['name' => 'Perbaikan Listrik', 'slug' => 'perbaikan-listrik', 'icon' => 'bi-plug', 'description' => 'Perbaikan korsleting darurat, saklar terbakar, dan stop kontak rusak.'],
            ['name' => 'Plumbing & Saluran Air', 'slug' => 'plumbing', 'icon' => 'bi-droplet-half', 'description' => 'Saluran mampet, kran bocor, perbaikan pompa air, dan instalasi toren.'],
            ['name' => 'Cleaning Service', 'slug' => 'cleaning-service', 'icon' => 'bi-stars', 'description' => 'Deep cleaning rumah/kos, cuci sofa, poles marmer, dan sanitasi ubin.'],
            ['name' => 'Perbaikan Perabot', 'slug' => 'perbaikan-perabot', 'icon' => 'bi-hammer', 'description' => 'Reparasi engsel lemari, kitchen set, meja kursi kayu patah.'],
            ['name' => 'Tukang Bangunan', 'slug' => 'tukang-bangunan', 'icon' => 'bi-bricks', 'description' => 'Pasang ubin keramik, tambal atap bocor, plamir dinding, dan renovasi teras.'],
            ['name' => 'Pengecatan Rumah', 'slug' => 'pengecatan-rumah', 'icon' => 'bi-brush', 'description' => 'Pengecatan interior & exterior dinding, waterproofing dak beton anti bocor.'],
            ['name' => 'Pengendalian Hama', 'slug' => 'pengendalian-hama', 'icon' => 'bi-shield-shaded', 'description' => 'Anti rayap pondasi tanah, fogging nyamuk DBD, dan penanganan kecoa.'],
            ['name' => 'Perbaikan Elektronik', 'slug' => 'perbaikan-elektronik', 'icon' => 'bi-tv', 'description' => 'Servis mesin cuci, kulkas, dispenser air panas, microwave dan TV LED.']
        ];

        foreach ($categoriesData as $c) {
            $catId = DB::table('categories')->insertGetId([
                'name' => $c['name'],
                'slug' => $c['slug'],
                'icon' => $c['icon'],
                'description' => $c['description'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Add standard service for AC
            if ($c['slug'] === 'service-ac') {
                $serviceId = DB::table('services')->insertGetId([
                    'category_id' => $catId,
                    'name' => 'Cuci & Maintenance AC Split (0.5 - 2 PK)',
                    'slug' => 'cuci-maintenance-ac-split',
                    'description' => 'Pembersihan evaporator, talang air, filter udara, dan kompresor luar secara teliti.',
                    'base_price' => 75000.00,
                    'estimated_duration_minutes' => 60,
                    'image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?q=80&w=800&auto=format&fit=crop',
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Link to Budi's services
                DB::table('provider_services')->insert([
                    'provider_profile_id' => $profileId,
                    'service_id' => $serviceId,
                    'custom_price' => 75000.00,
                    'is_available' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 6. Customer Address
        $addressId = DB::table('addresses')->insertGetId([
            'user_id' => $customerId,
            'label' => 'Rumah Pribadi',
            'recipient_name' => 'Dian Anggraini',
            'recipient_phone' => '081234567890',
            'address_line' => 'Jl. Tebet Barat Dalam Raya No. 42B, RT 04 / RW 02, Tebet Barat',
            'city' => 'Jakarta Selatan',
            'postal_code' => '12810',
            'landmark_note' => 'Rumah pagar hitam samping laundry express',
            'is_primary' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 7. Initial Active Booking (HS-2026-001)
        $bookingId = DB::table('bookings')->insertGetId([
            'booking_code' => 'HS-2026-001',
            'customer_id' => $customerId,
            'provider_id' => $providerId,
            'address_id' => $addressId,
            'booking_date' => now()->toDateString(),
            'booking_time_slot' => '09:00 - 11:00',
            'customer_notes' => 'AC kamar tidur bocor air menetes dan angin kurang dingin.',
            'total_amount' => 75000.00,
            'platform_fee' => 7500.00,
            'provider_net_amount' => 67500.00,
            'status' => 'on_the_way',
            'payment_method' => 'cash',
            'payment_status' => 'unpaid',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 8. Booking Item Snapshot
        DB::table('booking_items')->insert([
            'booking_id' => $bookingId,
            'service_name' => 'Cuci & Maintenance AC Split (0.5 - 2 PK)',
            'unit_price' => 75000.00,
            'quantity' => 1,
            'subtotal' => 75000.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 9. Booking Status Log
        DB::table('booking_status_logs')->insert([
            [
                'booking_id' => $bookingId,
                'from_status' => null,
                'to_status' => 'pending',
                'notes' => 'Pesanan berhasil dibuat oleh pelanggan.',
                'created_at' => now()->subMinutes(45),
                'updated_at' => now()->subMinutes(45),
            ],
            [
                'booking_id' => $bookingId,
                'from_status' => 'pending',
                'to_status' => 'accepted',
                'notes' => 'Pesanan dikonfirmasi oleh teknisi Budi Santoso.',
                'created_at' => now()->subMinutes(30),
                'updated_at' => now()->subMinutes(30),
            ],
            [
                'booking_id' => $bookingId,
                'from_status' => 'accepted',
                'to_status' => 'on_the_way',
                'notes' => 'Teknisi berangkat menuju alamat pelanggan.',
                'created_at' => now()->subMinutes(15),
                'updated_at' => now()->subMinutes(15),
            ],
        ]);
    }
}
