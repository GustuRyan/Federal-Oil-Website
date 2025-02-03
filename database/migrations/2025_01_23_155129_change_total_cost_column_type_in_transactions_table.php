<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('total_cost', 15, 2)->change(); 
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->float('total_cost')->change(); 
        });
    }
};
