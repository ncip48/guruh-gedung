@extends('layouts.app')
@section('title', 'Pesan')
@section('content')
    <!-- start page title section -->
    <section class="page-title-section bg-img cover-background" data-overlay-dark="4"
        data-background="img/banner/lapangan2.jpg">
        <div class="container">
            <h1>Reservasi Gedung</h1>
        </div>
    </section>
    <!-- end page title section -->

    <!-- start booking-form section -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 sm-margin-50px-bottom">
                    <h4 class="text-uppercase letter-spacing-1 margin-30px-bottom font-size24">Form Reservasi</h4>
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">*Nama lengkap</label>
                                    <input id="name" name="name" placeholder="John Doe" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">*Email</label>
                                    <input id="email" name="email" placeholder="johndoe@gmail.com" type="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">*Nomor Handphone</label>
                                    <input id="phone" name="phone" placeholder="085156842765" type="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Gedung</label>
                                    <input class="form-control" type="text" value="{{ $gedung->nama }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Tanggal</label>
                                    <input class="form-control" type="text" value="{{ $date }}" readonly>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 popular-things">
                    <div class="padding-30px-left sm-no-padding-left">
                        <h4 class="text-uppercase letter-spacing-1 margin-30px-bottom font-size24">Total Harga</h4>
                        <div class="theme-shadow border-radius-3 margin-30px-bottom">
                            <img src={{ asset('/img/produk/' . $gedung->foto) }} alt="{{ $gedung->nama }}" />
                            <div class="border-bottom padding-25px-all d-flex justify-content-between">
                                <h5 class="font-size17 no-margin-bottom">@currency($gedung->harga)</h5>
                                <ul class="rate no-margin-bottom">
                                </ul>
                            </div>
                            <div>
                                <div class="row align-items-center text-center padding-15px-tb">
                                    <div class="col-md-12">
                                        <button type="submit" class="butn">Pesan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- end booking-form section -->
@endsection
