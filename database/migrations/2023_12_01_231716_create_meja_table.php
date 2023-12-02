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
        Schema::create('meja', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->foreignId('idwarung')->nullable()->constrained('warung');
            $table->string('kodemeja')->nullable();
            $table->timestampsTz($precision = 0);
        });
        // create new meja with kodemeja A1, A2, B1, B2 for each warung
        DB::table('meja')->insert([
            [
                'idwarung' => 1,
                'kodemeja' => 'A1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idwarung' => 1,
                'kodemeja' => 'A2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idwarung' => 1,
                'kodemeja' => 'B1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idwarung' => 1,
                'kodemeja' => 'B2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idwarung' => 2,
                'kodemeja' => 'A1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idwarung' => 2,
                'kodemeja' => 'A2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idwarung' => 2,
                'kodemeja' => 'B1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idwarung' => 2,
                'kodemeja' => 'B2',
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
        Schema::dropIfExists('meja');
    }
};
