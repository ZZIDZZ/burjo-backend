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
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('setguard:api');
    }

    public function list(){
        // filter by role, if role = 1 (pemilik) then show all status transaksi,
        // if role = 2 (petugas kasir) then show all
        // if role = 3 (petugas pengantar pesanan) then show all
        // if role = 4 (petugas dapur) then show only baru, diproses

        $role = auth()->user()->role;
        $whereStatusRole = "";
        if($role == 4){
            $whereStatusRole = " AND transaksi.status IN ('baru', 'diproses')";
        }

        $transaksi = DB::select("SELECT transaksi.*, pengguna.namapengguna, pengguna.username as username_pengguna, pelanggan.namapelanggan, meja.kodemeja, warung.namawarung, warung.kodewarung, promosi.namapromosi, pengguna.kodepengguna
        FROM transaksi
        LEFT JOIN pengguna ON pengguna.id = transaksi.idpengguna
        LEFT JOIN pelanggan ON pelanggan.id = transaksi.idpelanggan
        LEFT JOIN meja ON meja.id = transaksi.idmeja
        LEFT JOIN warung ON warung.id = meja.idwarung
        LEFT JOIN promosi ON promosi.id = transaksi.idpromosi
        ORDER BY transaksi.id DESC $whereStatusRole
        ");

        return response()->json(["data" => $transaksi]);
    }

    public function history(){
        // histori kasir waiter
        // - selesai doang
        // histori koki
        // - siap disajikan
        // - selesai

        $role = auth()->user()->role;
        $whereStatusRole = "";
        if($role == 2){
            $whereStatusRole = " AND transaksi.status IN ('selesai')";
        }else if($role == 3){
            $whereStatusRole = " AND transaksi.status IN ('disajikan', 'selesai')";
        }else if($role == 4){
            $whereStatusRole = " AND transaksi.status IN ('disajikan', 'selesai')";
        }

        $transaksi = DB::select("SELECT transaksi.*, pengguna.namapengguna, pengguna.username as username_pengguna, pelanggan.namapelanggan, meja.kodemeja, warung.namawarung, warung.kodewarung, promosi.namapromosi, pengguna.kodepengguna
        FROM transaksi
        LEFT JOIN pengguna ON pengguna.id = transaksi.idpengguna
        LEFT JOIN pelanggan ON pelanggan.id = transaksi.idpelanggan
        LEFT JOIN meja ON meja.id = transaksi.idmeja
        LEFT JOIN warung ON warung.id = meja.idwarung
        LEFT JOIN promosi ON promosi.id = transaksi.idpromosi
        ORDER BY transaksi.id DESC $whereStatusRole
        ");

        return response()->json(["data" => $transaksi]);
    }

    public function updateStatusTransaksi($id){
        $statuses = ["baru", "diproses", "disajikan", "selesai"];
        $transaksi = Transaksi::find($id);
        if(!$transaksi){
            throw new CoreException("Transaksi tidak ditemukan");
        }
        if($transaksi->status != "selesai"){
            $index = array_search($transaksi->status, $statuses);
            $transaksi->status = $statuses[$index + 1];
        }
        $transaksi->save();

        return response()->json(["data" => $transaksi]);
    }

    public function detail($id){
        // find transaksi by id
        $transaksi = Transaksi::select("transaksi.*", "pengguna.namapengguna", "pengguna.username as username_pengguna", "pelanggan.namapelanggan", "meja.kodemeja", "warung.namawarung", "warung.kodewarung", "promosi.namapromosi", "pengguna.kodepengguna")
        ->leftjoin("pengguna", "pengguna.id", "transaksi.idpengguna")
        ->leftjoin("pelanggan", "pelanggan.id", "transaksi.idpelanggan")
        ->leftjoin("meja", "meja.id", "transaksi.idmeja")
        ->leftjoin("warung", "warung.id", "meja.idwarung")
        ->leftjoin("promosi", "promosi.id", "transaksi.idpromosi")
        ->where("transaksi.id", $id);

        if($transaksi->count() == 0){
            throw new CoreException("Transaksi tidak ditemukan");
        }

        // list detail transaksi with idtransaksi
        $detail = DetailTransaksi::select("detail_transaksi.*", "menu.namamenu", "menu.kategori", "menu.harga", "menu.gambar")
        ->leftjoin("menu", "menu.id", "detail_transaksi.idmenu")
        ->where("detail_transaksi.idtransaksi", $id)
        ->get();

        return response()->json([
            "data" => $transaksi->first(), 
            "detail_transaksi" => $detail
        ]);
    }

    public function create(Request $request){
        $input = $request->all();
        // check meja exist in database based on kodemeja
        $idwarung = auth()->user()->idwarung;
        $kode_meja = $input["kodemeja"];
        $meja = DB::table("meja")->where("kodemeja", $kode_meja)->where("idwarung", $idwarung)->first();
        if(!$meja){
            throw new CoreException("Meja $kode_meja tidak ditemukan pada warung ini");
        }
        $idmeja = $meja->id;
        $inputNewTransaksi = [
            "idmeja" => $idmeja,
            "idpengguna" => auth()->user()->id,
            "tanggal" => Carbon::now(),
            "waktu" => Carbon::now(),
            "shift" => $input["shift"],
            "namapelanggan" => $input["namapelanggan"],
            "metodepembayaran" => $input["metodepembayaran"],
            "status" => "baru",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ];
        $newTransaksi = new Transaksi();
        $newTransaksi->fill($inputNewTransaksi);
        $newTransaksi->save();

        $detail_transaksi = $input["detail_transaksi"];
        $jumlahtransaksi = 0;
        foreach($detail_transaksi as $detail){
            $menu = DB::table("menu")->where("id", $detail["idmenu"])->first();
            $inputNewDetailTransaksi = [
                "idtransaksi" => $newTransaksi->id,
                "idmenu" => $detail["idmenu"],
                "jumlah" => $detail["jumlah"],
                "harga" => $menu->harga,
                "subtotal" => $menu->harga * $detail["jumlah"],
                "status" => "baru",
                "namamenu" => $menu->namamenu,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ];
            $jumlahtransaksi += $menu->harga * $detail["jumlah"];
            $newDetailTransaksi = new DetailTransaksi();
            $newDetailTransaksi->fill($inputNewDetailTransaksi);
            $newDetailTransaksi->save();
        }
    }
}
