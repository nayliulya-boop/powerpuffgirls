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
        Schema::table('vacations', function (Blueprint $table) {
            $table->string('payment_status', 32)->default('unpaid')->after('status')->index();
            $table->text('admin_notes')->nullable()->after('notes');
            $table->foreignId('reviewed_by')->nullable()->after('admin_notes')->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable()->after('reviewed_by');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method', 32);
            $table->string('bank_name', 100)->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->string('transaction_reference', 64)->unique();
            $table->string('status', 32)->default('completed');
            $table->text('notes')->nullable();
            $table->timestamp('paid_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');

        Schema::table('vacations', function (Blueprint $table) {
            $table->dropForeign(['reviewed_by']);
            $table->dropColumn(['payment_status', 'admin_notes', 'reviewed_by', 'reviewed_at']);
        });
    }
};
