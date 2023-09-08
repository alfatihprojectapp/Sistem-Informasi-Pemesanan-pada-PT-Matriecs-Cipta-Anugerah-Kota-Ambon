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
        Schema::create('perumahan', function (Blueprint $table) {
            $table->id('id_perumahan');
            $table->string('nama_perumahan');
            $table->integer('harga');
            $table->integer('uang_muka');
            $table->integer('angsuran');
            $table->string('type');
            $table->integer('jumlah');
            $table->integer('stok');
            $table->longText('fasilitas');
            $table->longText('informasi_lain')->nullable();
            $table->string('image_1');
            $table->string('image_2');
            $table->string('image_3');
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
        Schema::dropIfExists('perumahan');
    }
};
