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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('namapelanggan')->nullable();
            $table->date('tanggaldaftar')->nullable();
            $table->bigInteger('poin')->nullable();
            $table->string('status')->nullable()->comment('aktif, nonaktif');
            $table->timestampsTz($precision = 0);
        });

        // insert 4 new pelanggan
        DB::table('pelanggan')->insert([
            [
                'namapelanggan' => 'Pelanggan 1',
                'tanggaldaftar' => '2021-01-01',
                'poin' => 0,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'namapelanggan' => 'Pelanggan 2',
                'tanggaldaftar' => '2021-01-01',
                'poin' => 100,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'namapelanggan' => 'Pelanggan 3',
                'tanggaldaftar' => '2021-01-01',
                'poin' => 1000,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'namapelanggan' => 'Pelanggan 4',
                'tanggaldaftar' => '2021-01-01',
                'poin' => 999999999,
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
        Schema::dropIfExists('pelanggan');
    }
};
