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
        Schema::table('destinations', function (Blueprint $table) {
            $table->unsignedSmallInteger('capacity')->default(10)->after('duration_days');
            $table->text('amenities')->nullable()->after('capacity');
            $table->date('start_date')->nullable()->after('amenities');
            $table->date('end_date')->nullable()->after('start_date');
            $table->boolean('is_active')->default(true)->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn(['capacity', 'amenities', 'start_date', 'end_date', 'is_active']);
        });
    }
};
