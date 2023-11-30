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
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('role', 255);
            $table->text('description')->nullable();
            $table->timestampsTz($precision = 0);

        });
        // create role 'mahasiswa', 'operator', dosen_wali', 'departemen'
        DB::table('roles')->insert([
            [
                'role' => 'pemilik',
                'description' => 'Pemilik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'petugas_kasir',
                'description' => 'Petugas Kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'petugas_pengantar_pesanan',
                'description' => 'Petugas Pengantar Pesanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'petugas_dapur',
                'description' => 'Petugas Dapur',
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
        Schema::dropIfExists('roles');
    }
};
