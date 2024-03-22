<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('club1_id');
            $table->unsignedBigInteger('club2_id');
            $table->integer('score1');
            $table->integer('score2');
            $table->timestamps();

            $table->foreign('club1_id')->references('club_id')->on('clubs')->onDelete('cascade');
            $table->foreign('club2_id')->references('club_id')->on('clubs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
};
