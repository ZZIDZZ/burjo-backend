<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksi";

    // Schema::create('transaksi', function (Blueprint $table) {
    //     $table->bigIncrements('id')->unsigned();
    //     $table->foreignId('idpelanggan')->nullable()->constrained('pelanggan');
    //     $table->foreignId('idmeja')->nullable()->constrained('meja');
    //     $table->foreignId('idpengguna')->nullable()->constrained('pengguna');
    //     $table->foreignId('idpromosi')->nullable()->constrained('promosi');
    //     $table->date('tanggal')->nullable();
    //     $table->time('waktu')->nullable();
    //     $table->bigInteger('shift')->nullable();
    //     $table->double('total', 16, 2)->nullable();
    //     $table->string('namapelanggan')->nullable();
    //     $table->string('metodepembayaran')->nullable();
    //     $table->double('totaldiskon', 16, 2)->nullable();
    //     $table->timestampsTz($precision = 0);
    // });

    protected $fillable = [
        'idpelanggan',
        'idmeja',
        'idpengguna',
        'idpromosi',
        'tanggal',
        'waktu',
        'shift',
        'total',
        'namapelanggan',
        'metodepembayaran',
        'totaldiskon',
        'status',
    ];
}
