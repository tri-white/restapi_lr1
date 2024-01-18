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
        Schema::create('competitions_sportsmens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competition_id');
            $table->unsignedBigInteger('sportsman_id');
            $table->timestamps();

            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
            $table->foreign('sportsman_id')->references('id')->on('sportsmens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions_sportsmens');
    }
};
