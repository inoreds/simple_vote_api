<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrCandidatPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_candidat_periods', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('period_id');
            $table->foreign('period_id')->references('id')->on('ma_periods');
            $table->string('candidat_id')->unique();
            $table->foreign('candidat_id')->references('id')->on('ma_candidats');
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
        Schema::dropIfExists('tr_candidat_periods');
    }
}
