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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions', 'id')->onDelete('cascade');
            $table->foreignId('account_id')->constrained('accounts', 'id')->onDelete('cascade');
            $table->string('type');
            $table->decimal('amount', 12, 2)->unsigned()->default(0);
            $table->string('currency', 3);
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry');
    }
};
