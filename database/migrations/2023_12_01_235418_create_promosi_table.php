<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        Schema::create('promosi', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('namapromosi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->bigInteger('jumlahpoin')->nullable();
            $table->text('gambar')->nullable();
            $table->timestampsTz($precision = 0);
        });

        // insert 4 new promosi
        DB::table('promosi')->insert([
            [
                'namapromosi' => 'Promosi 1',
                'deskripsi' => 'Promosi 1',
                'jumlahpoin' => 10,
                'gambar' => 'https://cdn.discordapp.com/attachments/1179985192346206278/1180190480802254849/nut-nnn.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'namapromosi' => 'Promosi 2',
                'deskripsi' => 'Promosi 2',
                'jumlahpoin' => 20,
                'gambar' => 'https://cdn.discordapp.com/attachments/1179985192346206278/1180190480802254849/nut-nnn.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'namapromosi' => 'Promosi 3',
                'deskripsi' => 'Promosi 3',
                'jumlahpoin' => 100,
                'gambar' => 'https://cdn.discordapp.com/attachments/1179985192346206278/1180190480802254849/nut-nnn.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'namapromosi' => 'Promosi 4',
                'deskripsi' => 'Promosi 4',
                'jumlahpoin' => 400,
                'gambar' => 'https://cdn.discordapp.com/attachments/1179985192346206278/1180190480802254849/nut-nnn.png',
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
        Schema::dropIfExists('promosi');
    }
};
