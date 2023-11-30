<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
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
        Schema::create('pengguna', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('namapengguna')->nullable();
            $table->foreignId('idrole')->nullable()->constrained('roles');
            $table->string('status')->nullable();
            $table->text('foto')->nullable();
            $table->rememberToken();
            $table->timestampsTz($precision = 0);
        });
        // create user with role 'pemilik', 'petugas_kasir', 'petugas_pengantar_pesanan', 'petugas_dapur'
        DB::table('pengguna')->insert([
            [
                'username' => 'pemilik',
                'password' => bcrypt('1234'),
                'namapengguna' => 'Pemilik',
                'idrole' => 1,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'petugas_kasir',
                'password' => bcrypt('1234'),
                'namapengguna' => 'Petugas Kasir',
                'idrole' => 2,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'petugas_pengantar_pesanan',
                'password' => bcrypt('1234'),
                'namapengguna' => 'Petugas Pengantar Pesanan',
                'idrole' => 3,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'petugas_dapur',
                'password' => bcrypt('1234'),
                'namapengguna' => 'Petugas Dapur',
                'idrole' => 4,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
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
        Schema::dropIfExists('pengguna');
    }
};
