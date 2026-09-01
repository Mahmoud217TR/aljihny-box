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
        Schema::create('dues', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->string('period');
            $table->foreignId('member_id')->constrained('members', 'id')->onDelete('cascade');
            $table->decimal('amount', 12, 2)->unsigned()->default(0);
            $table->string('currency', 3);
            $table->timestampTz('due_date');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dues');
    }
};
