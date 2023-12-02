<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\CoreException;
use App\Models\AktivitasPengguna;
use App\Models\Pengguna;
use Illuminate\Support\Carbon;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('setguard:api');
    }

    public function list(){
        // list transaksi
        $transaksi = Transaksi::select("transaksi.*", "pengguna.namapengguna", "pengguna.username as username_pengguna", "pelanggan.namapelanggan", "meja.kodemeja", "warung.namawarung", "warung.kodewarung", "promosi.namapromosi", "pengguna.kodepengguna")
        ->leftjoin("pengguna", "pengguna.id", "transaksi.idpengguna")
        ->leftjoin("pelanggan", "pelanggan.id", "transaksi.idpelanggan")
        ->leftjoin("meja", "meja.id", "transaksi.idmeja")
        ->leftjoin("warung", "warung.id", "meja.idwarung")
        ->leftjoin("promosi", "promosi.id", "transaksi.idpromosi")
        ->orderBy("transaksi.id", "desc")
        ->get();

        return response()->json(["data" => $transaksi]);
    }
}
