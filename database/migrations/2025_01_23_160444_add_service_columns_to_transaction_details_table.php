<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable();  
            $table->integer('service_time')->nullable();  
            
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            // Menghapus kolom dan foreign key jika rollback
            $table->dropForeign(['service_id']);
            $table->dropColumn(['service_id', 'service_time']);
        });
    }

};
