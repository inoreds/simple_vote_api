<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrPeriodVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_period_votes', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('period_id');
            $table->foreign('period_id')->references('id')->on('ma_periods');
            $table->string('name');
            $table->string('description')->nullable();
            $table->enum('status', ['NEW', 'VOTING','FINISHED']);
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
        Schema::dropIfExists('tr_period_votes');
    }
}
