<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('status');
            $table->integer('matchday')->nullable();
            $table->string('homeTeamName')->nullable();
            $table->string('awayTeamName')->nullable();
            $table->string('result_GoalsHomeTeam')->nullable();
            $table->string('result_GoalsAwayTeam')->nullable();
            $table->string('halfTime_result_GoalsHomeTeam')->nullable();
            $table->string('halfTime_result_GoalsAwayTeam')->nullable();
            $table->string('extraTime_result_GoalsHomeTeam')->nullable();
            $table->string('extraTime_result_GoalsAwayTeam')->nullable();
            $table->string('penaltyShootout_result_GoalsHomeTeam')->nullable();
            $table->string('penaltyShootout_result_GoalsAwayTeam')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matchs');
    }
}
