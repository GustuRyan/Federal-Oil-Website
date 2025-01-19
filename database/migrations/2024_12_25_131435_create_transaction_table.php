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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('invoice');
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->float('total_cost');
            $table->enum('payment_methods', ['tunai', 'kredit', 'transfer']); 
            $table->enum('payment_status', ['lunas', 'belum lunas']);        
            $table->text('description')->nullable();
        });        
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
