<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservasi;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reservasis = Reservasi::when($request->input('name'), function ($query, $name) {
            return $query->where('kode', 'like', '%' . $name . '%');
        })->when($request->input('status'), function ($query, $name) {
            return $query->where('status', $name);
        })
            ->select('*')
            ->orderBy('tanggal', 'desc')
            ->paginate(10);
        return view('admin.reservasi.index', compact('reservasis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservasi $reservasi)
    {
        $reservasi->delete();
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dihapus');
    }

    public function proses(Reservasi $reservasi)
    {
        $reservasi->update([
            'status' => 1
        ]);
        $pesan = 'Pembayaran dengan kode $_KODE_$ atas nama $_NAMA_$ telah berhasil di proses, silahkan cek link berikut untuk melihat detail reservasi anda: $_LINK_$';
        $pesan = str_replace('$_KODE_$', $reservasi->kode, $pesan);
        $pesan = str_replace('$_LINK_$', url('reservasi/' . $reservasi->kode), $pesan);
        $pesan = str_replace('$_NAMA_$', $reservasi->nama, $pesan);
        $this->sendWhatsapp($reservasi->no_hp, $pesan);
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil diupdate');
    }

    public static function sendWhatsapp($no_tujuan, $pesan)
    {
        $api_key   = '1eda928e1e1f698a3bf94aca67f539ab72a12ad5'; // API KEY Anda
        $id_device = '959'; // ID DEVICE yang di SCAN (Sebagai pengirim)
        $url   = 'https://api.watsap.id/send-message'; // URL API
        $no_hp = $no_tujuan; // No.HP yang dikirim (No.HP Penerima)
        $pesan = $pesan; // Pesan yang dikirim

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0); // batas waktu response
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_POST, 1);

        $data_post = [
            'id_device' => $id_device,
            'api-key' => $api_key,
            'no_hp'   => $no_hp,
            'pesan'   => $pesan
        ];
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data_post));
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($curl);
        curl_close($curl);
    }
}
