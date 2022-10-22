<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Http\Controllers\MailerController;
use App\Models\BuktiPembayaran;
use App\Models\Rekening;
use Illuminate\Support\Facades\Redirect;

class ReservasiController extends Controller
{

    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
    }

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
        //select * from gedung;
        $gedung = Gedung::where('status', 1)->get();
        $tersedia = [];
        //loop buat nyari gedung yg kosong
        foreach ($gedung as $ged) {
            //ngecek select COUNT(*) from reservasi where tanggal and id_gedung and status != 3 or status != 4
            $cek_tersedia = Reservasi::where('tanggal', $date)->where('id_gedung', $ged->id)->where('status', '!=', 3)->where('status', '!=', 4)->count();
            //jika count nya 1 maka tidak tersedia alisa false
            $ged->tersedia = $cek_tersedia == 1 ? false : true;
            //simpan ke variabel tersedia
            $tersedia[] = $ged;
        }
        //return ke view
        return view('cari', compact('tersedia', 'date'));
    }

    public function reservasi(Request $request)
    {
        //ambil data sama gedung by parameter misal url reservasi?date=xx&gedung=xx
        $date = $request->date;
        $id_gedung = $request->gedung;
        //select where sam
        //select * from gedung where id_gedung gitu
        $gedung = Gedung::find($id_gedung);
        //file view ada di resources/view
        return view('reservasi', compact('date', 'gedung'));
    }

    public function booking(Request $request)
    {
        //validasi input sam :v
        $request->validate(
            [
                'nama' => 'required',
                'email' => 'required|email',
                'no_hp' => 'required'
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Format email salah',
                'no_hp.required' => 'No HP tidak boleh kosong'
            ]
        );

        //cek validasi biar gak dobel
        $cek = Reservasi::where('tanggal', $request->date)->where('id_gedung', $request->gedung)->where('status', '!=', 3)->where('status', '!=', 4)->count();
        if ($cek > 0) {
            return Redirect::back()->withErrors(['msg' => 'Gedung ini sudah dipesan']);
        }
        //bikin kode transaksi acak
        $rand = rand(1231, 7879);
        $kode = 'GDG' . $rand;
        //input ke tabel reservasi sam :v sama aja query
        //insert into reservasi kode,id,blabla values $kode, 0, blabla
        $transaction = Reservasi::create([
            'kode' => $kode,
            'id_user' => 0,
            'id_gedung' => $request->gedung,
            'total' => $request->total,
            'tanggal' => $request->date,
            'status' => 0,
            'nama' => $request->title . ' ' . $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);
        MailerController::sendMail($request->email, $transaction->kode);
        //redirect ke url
        return redirect('order?kode=' . $transaction->kode);
    }



    public function order(Request $request)
    {
        // //kalo ini gausah di otak atik sam aku juga gatau :v
        // $order = Reservasi::where('kode', $request->kode)->first();
        // $product = Gedung::find($order->id_gedung);
        // $snapToken = $order->snap_token;
        // if (empty($snapToken)) {
        //     // Jika snap token masih NULL, buat token snap dan simpan ke database
        //     $midtrans = new CreateSnapTokenService($order, $product);
        //     $snapToken = $midtrans->getSnapToken();

        //     $order->snap_token = $snapToken;
        //     $order->save();
        // }

        // //bca = bank
        // //mandiri = echannel

        // if ($order->status != 0) {
        //     $midtrans = \Midtrans\Transaction::status($request->kode);
        //     // var_dump($midtrans);
        //     return view('order', compact('order', 'snapToken', 'product', 'midtrans'));
        // }
        // return view('order', compact('order', 'snapToken', 'product'));
        $id = $request->kode;
        $transaction = Reservasi::select('reservasi.*', 'gedung.nama as product_name', 'gedung.harga as product_price')->where('reservasi.kode', $id)->join('gedung', 'gedung.id', '=', 'reservasi.id_gedung')->first();
        $rekening = Rekening::where('rekening.id', $transaction->id_rekening)->join('bank', 'rekening.id_bank', '=', 'bank.id')->first();
        $proof = BuktiPembayaran::where('id_reservasi', $transaction->id)->count();
        $bukti = BuktiPembayaran::where('id_reservasi', $transaction->id)->first();
        $order = Reservasi::where('kode', $request->kode)->first();
        $product = Gedung::find($order->id_gedung);
        $data['product'] = $product;
        $data['order'] = $order;
        $data['result'] = $transaction;
        $data['rekening'] = $rekening;
        $data['proof'] = $proof;
        $data['bukti'] = $bukti;
        return view('order', $data);
    }

    public function payment(Request $request)
    {
        $code = $request->id_reservasi;
        $transaction = Reservasi::where('id', $code)->first();
        $transaction->status = 2;
        $transaction->payment_type = $request->payment_type;
        $transaction->id_rekening = $request->payment_type == "bank" ? $request->id_rekening : null;
        $transaction->save();
        // return redirect()->route('home')->with('success', 'Booking canceled successfully');
        return Redirect::back()->with('status', 'Silahkan melakukan pembayaran');
    }

    public function cancel(Request $request)
    {
        $code = $request->kode;
        $transaction = Reservasi::where('kode', $code)->first();
        $transaction->status = 3;
        $transaction->save();
        // return redirect()->route('home')->with('success', 'Booking canceled successfully');
        return Redirect::back()->with('status', 'Booking berhasil dibatalkan');
    }

    public function proof(Request $request)
    {
        $fileimage = $request->file('image');
        $nameimage = time() . '.' . $fileimage->getClientOriginalExtension();
        $fileimage->move(public_path('img/bukti'), $nameimage);

        $fullPathUriImage = '/img/bukti/' . $nameimage;

        $code = $request->id_reservasi;
        $transaction = Reservasi::where('id', $code)->first();
        $transaction->status = 2;
        $transaction->save();

        BuktiPembayaran::create([
            'id_reservasi' => $code,
            'gambar' => $fullPathUriImage,
        ]);
        // return redirect()->route('home')->with('success', 'Booking canceled successfully');
        return Redirect::back()->with('status', 'Silahkan menunggu konfirmasi dari admin');
    }
}
