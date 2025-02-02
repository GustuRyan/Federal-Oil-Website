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
        Schema::create('spends', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('spending_type', allowed:['biaya operasional', 'biaya suku cadang', 'gaji']);
            $table->text('distributor')->nullable();
            $table->float('total_cost');
            $table->enum('payment_methods', allowed: ['tunai', 'kredit', 'transfer']);
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spends');
    }
};