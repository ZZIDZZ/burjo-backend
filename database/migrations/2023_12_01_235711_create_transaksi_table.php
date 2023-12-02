<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->foreignId('idpelanggan')->nullable()->constrained('pelanggan');
            $table->foreignId('idmeja')->nullable()->constrained('meja');
            $table->foreignId('idpengguna')->nullable()->constrained('pengguna');
            $table->foreignId('idpromosi')->nullable()->constrained('promosi');
            $table->date('tanggal')->nullable();
            $table->time('waktu')->nullable();
            $table->bigInteger('shift')->nullable();
            $table->double('total', 16, 2)->nullable();
            $table->string('namapelanggan')->nullable();
            $table->string('metodepembayaran')->nullable();
            $table->double('totaldiskon', 16, 2)->nullable();
            $table->timestampsTz($precision = 0);
        });

        // insert 4 new transaksi, 2 for each idpengguna (2 and 6)
        // status (baru, diproses, disajikan, selesai),
        DB::table('transaksi')->insert([
            [
                'idpelanggan' => 1,
                'idmeja' => 1,
                'idpengguna' => 2,
                'idpromosi' => 1,
                'tanggal' => Carbon::now(),
                'waktu' => '00:00:00',
                'shift' => 1,
                'total' => 10000,
                'namapelanggan' => 'Pelanggan 1',
                'metodepembayaran' => 'tunai',
                'totaldiskon' => 0,
                'status' => 'baru', // 'baru', 'diproses', 'disajikan', 'selesai'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idpelanggan' => 2,
                'idmeja' => 2,
                'idpengguna' => 2,
                'idpromosi' => 2,
                'tanggal' => Carbon::now(),
                'waktu' => '00:00:00',
                'shift' => 1,
                'total' => 20000,
                'namapelanggan' => 'Pelanggan 2',
                'metodepembayaran' => 'tunai',
                'totaldiskon' => 0,
                'status' => 'diproses', // 'baru', 'diproses', 'disajikan', 'selesai'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idpelanggan' => 3,
                'idmeja' => 5,
                'idpengguna' => 6,
                'idpromosi' => 3,
                'tanggal' => Carbon::now(),
                'waktu' => '00:00:00',
                'shift' => 1,
                'total' => 30000,
                'namapelanggan' => 'Pelanggan 3',
                'metodepembayaran' => 'tunai',
                'totaldiskon' => 0,
                'status' => 'disajikan', // 'baru', 'diproses', 'disajikan', 'selesai'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idpelanggan' => 4,
                'idmeja' => 6,
                'idpengguna' => 6,
                'idpromosi' => 4,
                'tanggal' => Carbon::now(),
                'waktu' => '00:00:00',
                'shift' => 1,
                'total' => 40000,
                'namapelanggan' => 'Pelanggan 4',
                'metodepembayaran' => 'tunai',
                'totaldiskon' => 0,
                'status' => 'selesai', // 'baru', 'diproses', 'disajikan', 'selesai'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
