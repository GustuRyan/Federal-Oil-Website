<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('receivables', function (Blueprint $table) {
            $table->enum('payment_status', ['lunas', 'belum lunas'])->change();
        });
    }

    public function down(): void
    {
        Schema::table('receivables', function (Blueprint $table) {
            $table->enum('payment_status', ['lunas', 'belum_lunas'])->change();
        });
    }
};
