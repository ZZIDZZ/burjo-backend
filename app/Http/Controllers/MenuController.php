<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('setguard:api');
    }

    public function list(){
        $id_warung_user = auth('api')->user()->idwarung;
        // list menu
        $menu = Menu::select("menu.*", "warung.namawarung", "warung.kodewarung")
        ->leftjoin("warung", "warung.id", "menu.idwarung")
        ->where("menu.idwarung", $id_warung_user)
        ->orderBy("menu.id", "desc")
        ->get();

        return response()->json(
            ["data" => $menu]
        );
    }
}
