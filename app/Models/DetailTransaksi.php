<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $table = "detail_transaksi";
    
    // Schema::create('detail_transaksi', function (Blueprint $table) {
    //     $table->bigIncrements('id')->unsigned();
    //     $table->foreignId('idtransaksi')->nullable()->constrained('transaksi');
    //     $table->foreignId('idmenu')->nullable()->constrained('menu');
    //     $table->string('namamenu')->nullable();
    //     $table->double('harga', 16, 2)->nullable();
    //     $table->double('jumlah', 16, 2)->nullable();
    //     $table->double('subtotal', 16, 2)->nullable();
    //     $table->string('status')->nullable()->comment('aktif, batal');
    //     $table->timestampsTz($precision = 0);
    // });

    protected $fillable = [
        'idtransaksi',
        'idmenu',
        'namamenu',
        'harga',
        'jumlah',
        'subtotal',
        'status',
    ];
}
