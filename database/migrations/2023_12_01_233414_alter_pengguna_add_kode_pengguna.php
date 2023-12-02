<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
        // pengguna table, add kodepengguna collumn, and then update the existing usernames with the new kodepengguna
        Schema::table('pengguna', function (Blueprint $table) {
            $table->string('kodepengguna')->nullable();
            $table->foreignId('idwarung')->nullable()->constrained('warung');
        });
        DB::table('pengguna')->update([
            'kodepengguna' => 'WT1202310X01',
            'idwarung' => 1,
        ]);

        // create 4 new pengguna, with idwarung 2
        DB::table('pengguna')->insert([
            [
                'username' => 'pemilik2',
                'password' => bcrypt('1234'),
                'namapengguna' => 'Pemilik 2',
                'idrole' => 1,
                'kodepengguna' => 'WT2202310X01',
                'idwarung' => 2,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username' => 'petugas_kasir2',
                'password' => bcrypt('1234'),
                'namapengguna' => 'Petugas Kasir 2',
                'idrole' => 2,
                'kodepengguna' => 'WT2202310X01',
                'idwarung' => 2,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username' => 'petugas_pengantar_pesanan2',
                'password' => bcrypt('1234'),
                'namapengguna' => 'Petugas Pengantar Pesanan 2',
                'idrole' => 3,
                'kodepengguna' => 'WT2202310X01',
                'idwarung' => 2,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username' => 'petugas_dapur2',
                'password' => bcrypt('1234'),
                'namapengguna' => 'Petugas Dapur 2',
                'idrole' => 4,
                'kodepengguna' => 'WT2202310X01',
                'idwarung' => 2,
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
