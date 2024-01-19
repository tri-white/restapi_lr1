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
        Schema::create('sportsmen_regulations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('regulations_id');
            $table->unsignedBigInteger('sportsmen_id');
            $table->date('completion_date');
            $table->timestamps();

            $table->foreign('regulations_id')->references('id')->on('regulations')->onDelete('cascade');
            $table->foreign('sportsmen_id')->references('id')->on('sportsmen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sportsmen_regulations');
    }
};
