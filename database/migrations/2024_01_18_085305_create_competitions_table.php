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
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('event_date');
            $table->string('event_location');
            $table->integer('prize_pool')->unsigned()->nullable()->default(0);
            $table->enum('sports_type', array('100m sprint','3km run', 'spear throwing','football','tennis'));
            $table->timestamps();
            $table->index('event_date');
            //check for event_date after today.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
