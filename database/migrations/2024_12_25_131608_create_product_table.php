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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->integer('product_code')->unique();
            $table->string('product_name');
            $table->string('product_category');
            $table->string('brand')->nullable();
            $table->string('model');
            $table->integer('first_stocks');
            $table->integer('latest_stock');
            $table->float('buying_price');
            $table->float('selling_price');
            $table->string('unit_type');
            $table->dateTime('in_date');
            $table->date('expired_date');
            $table->text('description')->nullable();
            $table->string('shelf_location')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};