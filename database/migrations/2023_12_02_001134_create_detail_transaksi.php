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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->foreignId('idtransaksi')->nullable()->constrained('transaksi');
            $table->foreignId('idmenu')->nullable()->constrained('menu');
            $table->string('namamenu')->nullable();
            $table->double('harga', 16, 2)->nullable();
            $table->double('jumlah', 16, 2)->nullable();
            $table->double('subtotal', 16, 2)->nullable();
            $table->string('status')->nullable()->comment('aktif, batal');
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
        Schema::dropIfExists('detail_transaksi');
    }
};
