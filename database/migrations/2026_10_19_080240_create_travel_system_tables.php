<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add profile fields to users table if missing
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (! Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('phone');
            }
        });

        // 1. Packages Catalog Table
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category'); // Pakej Pulau, Pakej Umrah/Haji, Honeymoon, Day Trip
            $table->string('destination');
            $table->string('duration'); // e.g. "3 Hari 2 Malam", "12 Hari 10 Malam"
            $table->decimal('price_adult', 10, 2);
            $table->decimal('price_child', 10, 2)->default(0.00);
            $table->string('featured_image')->nullable();
            $table->text('description');
            $table->json('itinerary')->nullable();
            $table->json('included')->nullable();
            $table->json('excluded')->nullable();
            $table->text('terms')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        // 2. Bookings Table
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('package_id')->constrained('packages')->cascadeOnDelete();
            $table->date('trip_date');
            $table->integer('adult_count')->default(1);
            $table->integer('child_count')->default(0);
            $table->decimal('total_price', 10, 2);
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->json('participants')->nullable(); // [[name, ic_passport, phone, type]]
            $table->text('special_notes')->nullable();
            $table->string('payment_method')->default('pending'); // toyyibpay, billplz, stripe, manual_receipt
            $table->string('payment_status')->default('pending'); // pending, paid
            $table->string('payment_receipt')->nullable();
            $table->string('status')->default('Pending'); // Pending, Confirmed, Cancelled, Completed
            $table->timestamps();
        });

        // 3. Reviews Table
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->nullable()->constrained('packages')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('author_name');
            $table->tinyInteger('rating')->default(5);
            $table->string('trip_category')->nullable();
            $table->text('review_text');
            $table->boolean('is_approved')->default(true);
            $table->timestamps();
        });

        // 4. Inquiries Table
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('subject');
            $table->text('message');
            $table->string('status')->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('packages');

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'address')) {
                $table->dropColumn('address');
            }
            if (Schema::hasColumn('users', 'phone')) {
                $table->dropColumn('phone');
            }
        });
    }
};
