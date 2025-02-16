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
        Schema::create('user_queue', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('queue');
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->text('issue')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_queue');
    }
};
