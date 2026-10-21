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
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('package_code', 32)->index();
            $table->string('destination');
            $table->string('title');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedSmallInteger('travelers_count')->default(2);
            $table->decimal('price', 10, 2);
            $table->string('status', 32)->default('upcoming')->index();
            $table->string('tier', 64)->default('Signature Gold');
            $table->string('image_url')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacations');
    }
};
