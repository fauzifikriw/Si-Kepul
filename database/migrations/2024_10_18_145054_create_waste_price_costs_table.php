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
        Schema::create('waste_price_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('waste_id'); // Mengubah tipe data menjadi unsignedBigInteger
            $table->tinyInteger('is_valuable')->default(0);
            $table->integer('amount');
            $table->string('unit');
            $table->integer('price_cost');
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('waste_id')->references('id')->on('waste_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_price_costs');
    }
};
