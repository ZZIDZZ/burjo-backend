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
        Schema::create('aktivitas_pengguna', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            // kolom tanggal dan waktu
            $table->date('tanggal');
            $table->time('waktu');
            $table->foreignId('idpengguna')->nullable()->constrained('pengguna');
            $table->string('aktivitas', 255);
            $table->timestampsTz($precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aktivitas_pengguna');
    }
};
