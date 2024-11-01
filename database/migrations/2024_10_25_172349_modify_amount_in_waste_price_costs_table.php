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
        Schema::table('waste_price_costs', function (Blueprint $table) {
            $table->integer('amount')->nullable()->change(); // Buat amount menjadi nullable
            // atau
            // $table->integer('amount')->default(0)->change(); // Set nilai default
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('waste_price_costs', function (Blueprint $table) {
            $table->integer('amount')->nullable(false)->change(); // Kembalikan ke tidak nullable
            // atau
            // $table->integer('amount')->default(null)->change(); // Hapus default jika ditambahkan
        });
    }
};
