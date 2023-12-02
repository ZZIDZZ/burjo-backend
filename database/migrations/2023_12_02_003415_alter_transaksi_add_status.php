<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        // status (baru, diproses, disajikan, selesai),
        Schema::table('transaksi', function (Blueprint $table) {
            $table->string('status')->nullable()->comment('baru, diproses, disajikan, selesai');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table(
            'transaksi',
            function (Blueprint $table) {
                $table->dropColumn('status');
            }
        );
    }
};
