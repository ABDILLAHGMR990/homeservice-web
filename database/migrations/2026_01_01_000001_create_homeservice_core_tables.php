<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for HomeService v1.0.
     * Generates all 18 production tables fully harmonized.
     */
    public function up(): void
    {
        // 1. Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->enum('role', ['customer', 'provider', 'admin'])->default('customer');
            $table->string('avatar')->nullable();
            $table->enum('status', ['active', 'suspended', 'pending'])->default('active');
            $table->boolean('is_active')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Provider Profiles Table
        Schema::create('provider_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nik', 16)->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('expertise')->nullable();
            $table->integer('experience_years')->default(1);
            $table->text('bio')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('primary_service_area')->nullable();
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->decimal('rating_avg', 3, 2)->default(5.00);
            $table->integer('total_reviews')->default(0);
            $table->integer('completed_jobs')->default(0);
            $table->integer('total_jobs_done')->default(0);
            $table->enum('verification_status', ['unverified', 'pending', 'verified', 'rejected'])->default('pending');
            $table->timestamp('verified_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->boolean('is_available')->default(true);
            $table->string('avatar')->nullable();
            $table->timestamps();
        });

        // 3. Provider Documents Table
        Schema::create('provider_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_profile_id')->constrained('provider_profiles')->onDelete('cascade');
            $table->string('document_type'); // ktp, selfie_ktp, certificate, skck, portfolio
            $table->string('file_path');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_note')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });

        // 4. Categories Table
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 5. Services Table (Master Catalog)
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('base_price', 12, 2)->default(0);
            $table->string('price_unit')->default('per_visit');
            $table->integer('estimated_duration_minutes')->default(60);
            $table->integer('duration_estimate')->default(60);
            $table->string('image')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 6. Provider Services Table
        Schema::create('provider_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_profile_id')->constrained('provider_profiles')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->decimal('custom_price', 12, 2)->nullable();
            $table->integer('custom_duration')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_available')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 7. Addresses Table
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('label')->default('Rumah');
            $table->string('recipient_name');
            $table->string('recipient_phone')->nullable();
            $table->string('phone')->nullable();
            $table->text('address_line');
            $table->string('rt_rw', 20)->nullable();
            $table->string('kelurahan', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('city')->default('Jakarta');
            $table->string('province')->default('DKI Jakarta');
            $table->string('postal_code', 10)->nullable();
            $table->string('landmark_note')->nullable();
            $table->string('notes')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });

        // 8. Provider Areas Table
        Schema::create('provider_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_profile_id')->constrained('provider_profiles')->onDelete('cascade');
            $table->string('area_name')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('province')->nullable();
            $table->integer('radius_km')->default(15);
            $table->timestamps();
        });

        // 9. Bookings Table
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code', 32)->unique();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('provider_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('set null');
            $table->date('booking_date');
            $table->string('booking_time_slot')->nullable();
            $table->string('booking_time')->nullable();
            $table->text('customer_notes')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('platform_fee', 12, 2)->default(0);
            $table->decimal('provider_net_amount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2);
            $table->enum('status', ['pending', 'accepted', 'on_the_way', 'in_progress', 'completed', 'cancelled', 'rejected'])->default('pending');
            $table->enum('payment_method', ['cash', 'midtrans', 'online'])->default('cash');
            $table->enum('payment_status', ['unpaid', 'pending', 'paid', 'refunded'])->default('unpaid');
            $table->json('address_snapshot')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();
        });

        // 10. Booking Items Table (Snapshot of prices)
        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
            $table->string('service_name')->nullable();
            $table->string('service_name_snapshot')->nullable();
            $table->decimal('unit_price', 12, 2)->nullable();
            $table->decimal('service_price_snapshot', 12, 2)->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('subtotal', 12, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 11. Booking Status Logs Table (Audit trail)
        Schema::create('booking_status_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('from_status')->nullable();
            $table->string('to_status');
            $table->foreignId('changed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 12. Payments Table
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('invoice_number', 64)->nullable()->unique();
            $table->string('payment_method')->default('cash');
            $table->string('payment_channel')->nullable();
            $table->decimal('amount', 12, 2);
            $table->decimal('platform_fee', 12, 2)->default(0);
            $table->decimal('provider_earning', 12, 2)->default(0);
            $table->enum('payment_gateway', ['cash', 'midtrans'])->default('cash');
            $table->string('midtrans_order_id')->nullable();
            $table->string('midtrans_transaction_id')->nullable();
            $table->string('midtrans_snap_token')->nullable();
            $table->text('midtrans_snap_url')->nullable();
            $table->string('midtrans_payment_type')->nullable();
            $table->json('midtrans_raw_response')->nullable();
            $table->string('status')->default('pending');
            $table->timestamp('settled_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 13. Payment Transactions Table (Commission Ledger)
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->foreignId('provider_id')->constrained('users')->onDelete('cascade');
            $table->decimal('gross_amount', 12, 2);
            $table->decimal('platform_commission', 12, 2);
            $table->decimal('net_amount', 12, 2);
            $table->string('type')->default('order_payout'); // order_payout, commission_deduction, wallet_withdrawal
            $table->timestamps();
        });

        // 14. Reviews Table
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('provider_id')->constrained('users')->onDelete('cascade');
            $table->integer('rating')->default(5);
            $table->text('comment');
            $table->text('provider_reply')->nullable();
            $table->timestamp('provider_replied_at')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // 15. Messages Table (Chat)
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->text('message')->nullable();
            $table->text('body')->nullable();
            $table->string('type')->default('text');
            $table->string('attachment_path')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        // 16. Notifications Table
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->string('link_url')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // 17. Complaints Table (Garansi Layanan)
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->string('ticket_number', 32)->unique();
            $table->string('issue_category')->nullable();
            $table->string('subject')->nullable();
            $table->text('description');
            $table->string('evidence_path')->nullable();
            $table->string('status')->default('open'); // open, in_review, waiting_info, resolved, closed
            $table->string('priority')->default('medium'); // low, medium, high, urgent
            $table->text('resolution_notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->foreignId('resolved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });

        // 18. Commission Settings Table
        Schema::create('commission_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('platform_commission_percent', 5, 2)->default(10.00);
            $table->decimal('min_withdrawal_amount', 12, 2)->default(50000.00);
            $table->integer('warranty_days')->default(14);
            $table->integer('max_booking_days_advance')->default(30);
            $table->integer('auto_complete_hours')->default(48);
            $table->string('midtrans_server_key')->nullable();
            $table->string('midtrans_client_key')->nullable();
            $table->boolean('is_production')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commission_settings');
        Schema::dropIfExists('complaints');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('payment_transactions');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('booking_status_logs');
        Schema::dropIfExists('booking_items');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('provider_areas');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('provider_services');
        Schema::dropIfExists('services');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('provider_documents');
        Schema::dropIfExists('provider_profiles');
        Schema::dropIfExists('users');
    }
};
