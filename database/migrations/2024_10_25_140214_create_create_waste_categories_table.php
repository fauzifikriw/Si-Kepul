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
        Schema::create('waste_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->default(0);
            $table->string('name');
            $table->longText('image')->nullable();
            $table->string('description');
            $table->tinyInteger('recyclable')->nullable();
            $table->tinyInteger('hazardous')->nullable();
            $table->string('disposal_method')->nullable();
            $table->string('environmental_impact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_categories');
    }
};

