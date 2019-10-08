<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrPeriodVoteDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_period_vote_details', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('period_vote_id');
            $table->foreign('period_vote_id')->references('id')->on('tr_period_votes');
            $table->string('candidat_period_id');
            $table->foreign('candidat_period_id')->references('id')->on('tr_candidat_periods');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_period_vote_details');
    }
}
