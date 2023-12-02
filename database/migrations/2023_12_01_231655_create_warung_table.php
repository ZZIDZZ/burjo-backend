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
        Schema::create('warung', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('namawarung')->nullable();
            $table->string('kodewarung')->nullable();
            $table->text('logo')->nullable();
            $table->timestampsTz($precision = 0);
        });
        // create new warung named burjo holic 1 and 2
        DB::table('warung')->insert([
            [
                'namawarung' => 'Burjo Holic 1',
                'kodewarung' => 'WT1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'namawarung' => 'Burjo Holic 2',
                'kodewarung' => 'WT2',
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
        Schema::dropIfExists('warung');
    }
};
