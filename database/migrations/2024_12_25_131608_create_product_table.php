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

# Data Stok Barang
// 1. Kode Barang (unik)
// 2. Nama Barang (suku cadang, aksesoris, dll.)
// 3. Kategori (jenis suku cadang, aksesoris, dll.)
// 4. Merek (merek suku cadang)
// 5. Model (model suku cadang)
// 6. Stok Awal (jumlah awal)
// 7. Stok Sekarang (jumlah terkini)
// 8. Harga Beli (harga pembelian)
// 9. Harga Jual (harga penjualan)
// 10. Satuan (unit, pcs, kg, dll.)
// 11. Tanggal Masuk (tanggal barang masuk)
// 12. Tanggal Kadaluarsa (jika ada)
// 13. Keterangan (opsional)
// Tambah lokasi barang (rak 1, rak2)