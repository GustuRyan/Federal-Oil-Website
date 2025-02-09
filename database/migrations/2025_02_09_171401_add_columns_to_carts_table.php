<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('carts', function (Blueprint $table) {
            $table->integer('queue')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->text('issue')->nullable();
        });
    }

    public function down() {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['queue', 'price', 'issue']);
        });
    }
};
