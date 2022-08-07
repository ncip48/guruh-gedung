<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Midtrans\CreateSnapTokenService;

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
            $cek_tersedia = Reservasi::where('tanggal', $date)->where('id_gedung', $ged->id)->where('status', '!=', 3)->where('status', '!=', 4)->count();
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

    public function booking(Request $request)
    {
        $rand = rand(1231, 7879);
        $kode = 'GDG' . $rand;
        $transaction = Reservasi::create([
            'kode' => $kode,
            'id_user' => 0,
            'id_gedung' => $request->gedung,
            'total' => $request->total,
            'tanggal' => $request->date,
            'status' => 0,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);
        return redirect('order?kode=' . $transaction->kode);
    }

    public function order(Request $request)
    {
        $order = Reservasi::where('kode', $request->kode)->first();
        $product = Gedung::find($order->id_gedung);
        $snapToken = $order->snap_token;
        if (empty($snapToken)) {
            // Jika snap token masih NULL, buat token snap dan simpan ke database

            $midtrans = new CreateSnapTokenService($order, $product);
            $snapToken = $midtrans->getSnapToken();

            $order->snap_token = $snapToken;
            $order->save();
        }

        return view('order', compact('order', 'snapToken'));
    }
}
