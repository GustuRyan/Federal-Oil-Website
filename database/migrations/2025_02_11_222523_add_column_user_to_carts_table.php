<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down() {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['customer_id']);
        });
    }
};