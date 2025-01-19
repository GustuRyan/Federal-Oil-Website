<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); 
            $table->timestamps(); 
            $table->string('name'); 
            $table->text('address'); 
            $table->string('phone_number')->unique(); 
            $table->string('email')->unique(); 
            $table->string('motorcycle_type'); 
            $table->text('description')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};