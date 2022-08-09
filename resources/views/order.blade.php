@extends('layouts.app')
@section('title', 'Order')
@section('content')
@php
if ($order->status == 0){
$text = "Belum dibayar";
$color = "text-primary";
$icon = "far fa-hourglass";
}elseif ($order->status == 1){
$text = "Pembayaran berhasil";
$color = "text-success";
$icon = "far fa-check-circle";
}elseif ($order->status == 2){
$text = "Pembayaran sedang diproses";
$color = "text-warning";
$icon = "far fa-clock";
}elseif ($order->status == 3){
$text = "Pembayaran dibatalkan";
$color = "text-danger";
$icon = "far fa-times-circle";
}elseif ($order->status == 4){
$text = "Pembayaran kadaluarsa";
$color = "text-danger";
$icon = "far fa-times-circle";
}elseif ($order->status == 5){
$text = "Menunggu pembayaran";
$color = "text-primary";
$icon = "far fa-clock";
}
@endphp

<!-- start page title section -->
<section class="page-title-section bg-img cover-background" data-overlay-dark="4" data-background="img/banner/lapangan2.jpg">
    <div class="container">
        <h1>Rincian Pemesanan</h1>
    </div>
</section>
<!-- end page title section -->

<!-- start booking-form section -->
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5">
                <div class="card p-4 border-0" style="box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.52);">
                    <div class="card-header text-center bg-white border-0">
                        <h6 class="m-0 {{$color}}">{{ $text }}</h6>
                        <i class="{{$icon}} {{$color}} mt-3 mb-3 fa-3x" aria-hidden="true"></i>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                Kode Pesanan
                            </div>
                            <div class="col-12 col-md-6 text-right font-weight-bold">
                                {{$order->kode}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                Items
                            </div>
                            <div class="col-12 col-md-6 text-right">
                                {{$product->nama}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                Tanggal
                            </div>
                            <div class="col-12 col-md-6 text-right">
                                @dateonly($order->created_at)
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                Nama Pemesan
                            </div>
                            <div class="col-12 col-md-6 text-right">
                                {{$order->nama}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                Email
                            </div>
                            <div class="col-12 col-md-6 text-right">
                                {{$order->email}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                No HP
                            </div>
                            <div class="col-12 col-md-6 text-right">
                                {{$order->no_hp}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                Status
                            </div>
                            <div class="col-12 col-md-6 text-right">
                                {{$text}}
                            </div>
                        </div>
                        @if(isset($midtrans))
                        <hr />
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    Metode Pembayaran
                                </div>
                                <div class="col-12 col-md-6 text-right">
                                    @if($midtrans->payment_type == 'bank' || $midtrans->payment_type == 'bank_transfer' || $midtrans->payment_type == 'echannel')
                                        Transfer Bank
                                    @else
                                        {{strtoupper($midtrans->payment_type)}}
                                    @endif
                                </div>
                            </div>
                            @if($midtrans->payment_type == 'bank' || $midtrans->payment_type == 'bank_transfer' || $midtrans->payment_type == 'echannel')
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        Nama Bank
                                    </div>
                                    <div class="col-12 col-md-6 text-right">
                                        @if($midtrans->payment_type == 'bank' || $midtrans->payment_type == 'bank_transfer')
                                            @if(isset($midtrans->permata_va_number))
                                                Permata
                                            @else
                                                {{strtoupper($midtrans->va_numbers[0]->bank)}}
                                            @endif
                                        @elseif ($midtrans->payment_type == 'echannel')
                                            Mandiri
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        No VA
                                    </div>
                                    <div class="col-12 col-md-6 text-right font-weight-bold">
                                        @if($midtrans->payment_type == 'bank' || $midtrans->payment_type == 'bank_transfer')
                                            @if(isset($midtrans->permata_va_number))
                                                {{$midtrans->permata_va_number}}
                                            @else
                                                {{$midtrans->va_numbers[0]->va_number}}
                                            @endif
                                        @elseif ($midtrans->payment_type == 'echannel')
                                            {{$midtrans->bill_key}}
                                        @endif
                                    </div>
                                </div>
                            @else
                                @if($order->status != '4' && $order->status != '3' && $order->status != '1')
                                <div class="row" id="checktime">
                                    <div class="col-12 col-md-6">
                                        QR
                                    </div>
                                        <div class="col-12 col-md-6 text-right">
                                            @if($midtrans->payment_type == 'gopay')
                                            <img src="https://api.sandbox.midtrans.com/v2/{{ $midtrans->payment_type }}/{{ $midtrans->transaction_id }}/qr-code"
                                                alt="" style="width:250px;object-fit:contain" />
                                            @endif
                                        </div>
                                </div>
                                @endif
                            @endif
                            @if ($midtrans->transaction_status !== 'settlement')
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-md-6">Batas Pembayaran</div>
                                    <div class="col-12 col-md-6 text-right font-weight-bold" id="time_expired"></div>
                                </div>
                            @endif
                        @endif
                        <hr />
                        <div class="row">
                            <div class="col-12 col-md-6">
                                Harga
                            </div>
                            <div class="col-12 col-md-6 text-right">
                                @currency($product->harga)
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 font-weight-bold">
                                Total
                            </div>
                            <div class="col-12 col-md-6 font-weight-bold text-right">
                                @currency($order->total)
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-0 bg-white">
                        <div id="checktime">
                            @if ($order->status == 0 || $order->status == 5)
                            <button class="butn no-margin-bottom btn-block" id="pay-button">Bayar Sekarang</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end booking-form section -->
@endsection

@push('customScript')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
</script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('y');

        snap.pay('{{ $snapToken }}', {
            // Optional
            onSuccess: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log(result)
                location.reload();
            },
            // Optional
            onPending: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log(result)
                location.reload();
            },
            // Optional
            onError: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log(result)
                location.reload();
            },
            onClose: function(result) {
                location.reload();
            }
        });
    });
</script>
<script>
        function addMinutes(date, minutes) {
            return new Date(date + minutes * 60000).getTime();
        }
        // Mengatur waktu akhir perhitungan mundur
        var date = "{{ isset($midtrans) ? $midtrans->transaction_time : 0 }}";
        var dates = new Date(date).getTime();
        var countDownDate = addMinutes(dates, 15);
        document.getElementById("time_expired").innerHTML = "Checking...";
        // Memperbarui hitungan mundur setiap 1 detik
        var x = setInterval(function() {
            // Untuk mendapatkan tanggal dan waktu hari ini
            var now = new Date().getTime();
            // console.log(countDownDate)
            // console.log(now)
            // Temukan jarak antara sekarang dan tanggal hitung mundur
            var distance = countDownDate - now
            console.log(distance)
            // Perhitungan waktu untuk hari, jam, menit dan detik
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Keluarkan hasil dalam elemen dengan id = "time_expired"
            document.getElementById("time_expired").innerHTML = 
                minutes + "m " + seconds + "s ";
            // Jika hitungan mundur selesai, tulis beberapa teks
            if (distance < 25200000) {
                clearInterval(x);
                document.getElementById("time_expired").innerHTML = "EXPIRED";
                document.getElementById("checktime").style.display = "none";
            }
        }, 1000);
    </script>
@endpush