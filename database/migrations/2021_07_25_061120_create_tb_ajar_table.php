<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAjarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ajar', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jam_mulai');
            $table->string('jam_selesai');
            $table->unsignedBigInteger('pengajar_id');
            $table->foreign('pengajar_id')->references('id')->on('users')->onUpdate('cascade');
            $table->unsignedBigInteger('mapel_id');
            $table->foreign('mapel_id')->references('id')->on('tb_mapel')->onUpdate('cascade');
            $table->unsignedBigInteger('rombel_id');
            $table->foreign('rombel_id')->references('id')->on('tb_kelas')->onUpdate('cascade');
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
        Schema::dropIfExists('tb_ajar');
    }
}
