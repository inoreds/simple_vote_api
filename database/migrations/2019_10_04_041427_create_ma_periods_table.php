<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ma_periods', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('period');
            $table->date('start');
            $table->date('end');
            $table->enum('status', ['AKTIF', 'NON-AKTIF']);
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
        Schema::dropIfExists('ma_periods');
    }
}
