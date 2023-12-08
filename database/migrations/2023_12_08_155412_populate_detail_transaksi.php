<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('detail_transaksi', function (Blueprint $table) {
        //     $table->bigIncrements('id')->unsigned();
        //     $table->foreignId('idtransaksi')->nullable()->constrained('transaksi');
        //     $table->foreignId('idmenu')->nullable()->constrained('menu');
        //     $table->string('namamenu')->nullable();
        //     $table->double('harga', 16, 2)->nullable();
        //     $table->double('jumlah', 16, 2)->nullable();
        //     $table->double('subtotal', 16, 2)->nullable();
        //     $table->string('status')->nullable()->comment('aktif, batal');
        //     $table->timestampsTz($precision = 0);
        // });

        // insert detail transaksi on each transaksi
        DB::table('detail_transaksi')->insert([
            [
                'idtransaksi' => 1,
                'idmenu' => 1,
                'namamenu' => 'Mie Dog Dog',
                'harga' => 10000,
                'jumlah' => 2,
                'subtotal' => 20000,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idtransaksi' => 1,
                'idmenu' => 2,
                'namamenu' => 'Nasi Ayam Bali',
                'harga' => 15000,
                'jumlah' => 1,
                'subtotal' => 15000,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idtransaksi' => 2,
                'idmenu' => 3,
                'namamenu' => 'Nasi Goreng',
                'harga' => 12000,
                'jumlah' => 1,
                'subtotal' => 12000,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idtransaksi' => 3,
                'idmenu' => 4,
                'namamenu' => 'Mie Dog Dog',
                'harga' => 10000,
                'jumlah' => 1,
                'subtotal' => 10000,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idtransaksi' => 3,
                'idmenu' => 5,
                'namamenu' => 'Nasi Ayam Bali',
                'harga' => 15000,
                'jumlah' => 1,
                'subtotal' => 15000,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idtransaksi' => 3,
                'idmenu' => 6,
                'namamenu' => 'Nasi Goreng',
                'harga' => 12000,
                'jumlah' => 1,
                'subtotal' => 12000,
                'status' => 'aktif',
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
        //
    }
};
