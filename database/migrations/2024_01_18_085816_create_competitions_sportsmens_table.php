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
        Schema::create('competitions_sportsmans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competitions_id');
            $table->unsignedBigInteger('sportsmans_id');
            $table->timestamps();

            $table->foreign('competitions_id')->references('id')->on('competitions')->onDelete('cascade');
            $table->foreign('sportsmans_id')->references('id')->on('sportsmans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions_sportsmans');
    }
};
