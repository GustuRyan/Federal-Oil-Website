<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            // Mengubah kolom menjadi nullable
            $table->unsignedBigInteger('product_id')->nullable()->change();
            $table->integer('amount')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            // Mengembalikan kolom ke non-nullable
            $table->unsignedBigInteger('product_id')->nullable(false)->change();
            $table->integer('amount')->nullable(false)->change();
        });
    }
};
