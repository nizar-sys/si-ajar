<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('rombel');
            $table->unsignedBigInteger('wali_kelas')->default(null);
            $table->foreign('wali_kelas')->references('id')->on('users')->onUpdate('cascade');
            $table->unsignedBigInteger('ketua_kelas')->default(null);
            $table->foreign('ketua_kelas')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('tb_kelas');
    }
}
