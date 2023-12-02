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
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->foreignId('idwarung')->nullable()->constrained('warung');
            $table->string('namamenu')->nullable();
            $table->string('kategori')->nullable();
            $table->text('gambar')->nullable();
            $table->double('harga', 16, 2)->nullable();
            $table->timestampsTz($precision = 0);
        });

        // insert menu on each warung, named mie dog dog, nasi ayam bali, and nasi goreng
        DB::table('menu')->insert([
            [
                'idwarung' => 1,
                'namamenu' => 'Mie Dog Dog',
                'kategori' => 'Makanan',
                'gambar' => 'https://cdn.discordapp.com/attachments/1179985192346206278/1180183339014037554/photo.jpg',
                'harga' => 10000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idwarung' => 1,
                'namamenu' => 'Nasi Ayam Bali',
                'kategori' => 'Makanan',
                'gambar' => 'https://cdn.discordapp.com/attachments/1179985192346206278/1180183949138477206/19050620-1787029584943305-7590537062755860480-n-149b6905b6a6cc13560971ea21762e16-d7dcd03b48b71198379154f8db0ec250.png',
                'harga' => 15000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idwarung' => 1,
                'namamenu' => 'Nasi Goreng',
                'kategori' => 'Makanan',
                'gambar' => 'https://cdn.discordapp.com/attachments/1179985192346206278/1180184135650783273/094669300_1550287561-rosalinda222_fried-2509089_1920.png',
                'harga' => 12000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idwarung' => 2,
                'namamenu' => 'Mie Dog Dog',
                'kategori' => 'Makanan',
                'gambar' => 'https://cdn.discordapp.com/attachments/1179985192346206278/1180183339014037554/photo.jpg',
                'harga' => 10000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idwarung' => 2,
                'namamenu' => 'Nasi Ayam Bali',
                'kategori' => 'Makanan',
                'gambar' => 'https://cdn.discordapp.com/attachments/1179985192346206278/1180183949138477206/19050620-1787029584943305-7590537062755860480-n-149b6905b6a6cc13560971ea21762e16-d7dcd03b48b71198379154f8db0ec250.png',
                'harga' => 15000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idwarung' => 2,
                'namamenu' => 'Nasi Goreng',
                'kategori' => 'Makanan',
                'gambar' => 'https://cdn.discordapp.com/attachments/1179985192346206278/1180184135650783273/094669300_1550287561-rosalinda222_fried-2509089_1920.png',
                'harga' => 12000,
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
        Schema::dropIfExists('menu');
    }
};
