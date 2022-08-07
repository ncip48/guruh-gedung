<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasiController extends Controller
{
    //check a vailability of a table by time and date
    public function cekGedung(Request $request)
    {
        //mendapatkan tanggal dari request json / ajax
        $tanggal = $request->tanggal;
        //mendapatkan id_gedung dari request json / ajax
        $id_gedung = $request->id_gedung;
        //validasi euy
        if ($tanggal == "NaN-NaN-NaN" && !$id_gedung) {
            return ResponseController::response(false, '', null);
        }
        if ($tanggal == "NaN-NaN-NaN") {
            return ResponseController::response(false, 'Mohon isi tanggal dahulu', null);
        }
        if (!$id_gedung) {
            return ResponseController::response(false, 'Mohon pilih gedung dahulu', null);
        }

        $cek_tersedia = Reservasi::where('tanggal', $tanggal)->where('id_gedung', $id_gedung)->count();

        if ($cek_tersedia == 1) {
            return ResponseController::response(false, 'Gedung tidak tersedia', null);
        } else {
            return ResponseController::response(true, 'Gedung tersedia', null);
        }
    }

    public function index()
    {
        //get gedung all ~> (SELECT * FROM gedung)
        $gedung = Gedung::all();
        //ini di file resources/views/home.blade.php
        //compact tuh artine ngebawa parameter contone parameter $gedung dilempar ke view home.blade.php
        //jadi nanti di home.blade.php kita bisa mengambil data gedung dari $gedung
        return view('home', compact('gedung'));
    }

    public function search(Request $request)
    {
        $date = $request->date;
        $gedung = Gedung::all();
        $tersedia = [];
        foreach ($gedung as $ged) {
            $cek_tersedia = Reservasi::where('tanggal', $date)->where('id_gedung', $ged->id)->count();
            $ged->tersedia = $cek_tersedia == 1 ? false : true;
            $tersedia[] = $ged;
        }
        // return ResponseController::response(true, 'Sukses', $tersedia);
        return view('cari', compact('tersedia', 'date'));
    }

    public function reservasi(Request $request)
    {
        $date = $request->date;
        $id_gedung = $request->gedung;
        $gedung = Gedung::find($id_gedung);
        return view('reservasi', compact('date', 'gedung'));
    }
}
