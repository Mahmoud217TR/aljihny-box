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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members', 'id')->onDelete('cascade');
            $table->foreignId('transaction_id')->constrained('transactions', 'id')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('admins', 'id')->onDelete('cascade');
            $table->decimal('amount', 12, 2)->unsigned()->default(0);
            $table->string('currency', 3);
            $table->timestampTz('payed_at');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
