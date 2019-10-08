<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaCandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ma_candidats', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->enum('jenis_kelamin',['LAKI-LAKI', 'PEREMPUAN']);
            $table->string('alamat');
            $table->enum('agama',['ISLAM', 'KRISTEN','KATOLIK', 'HINDU', 'BUDHA']);
            $table->string('pekerjaan');
            $table->string('warga_negara');
            $table->string('no_ktp');
            $table->string('pas_foto')->nullable();
            $table->string('ktp')->nullable();
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
        Schema::dropIfExists('ma_candidats');
    }
}
