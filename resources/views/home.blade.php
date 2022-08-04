@extends('layouts.app')

@section('content')
    <!-- start banner -->
    <section class="bg-img screen-height cover-background beach-banner" data-overlay-dark="3"
        data-background="img/banner/bg-05.jpg">

        <!-- start banner text -->
        <div class="container h-100">
            <div class="header-text text-center display-table h-100 ml-auto mr-auto">
                <div class="display-table-cell vertical-align-bottom">
                    <div class="bg-white-opacity padding-40px-top padding-35px-bottom padding-40px-lr border-radius-3">

                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" name="tgl" placeholder="Tanggal" id="tgl">
                                </div>
                            </div>
                            <div class="col-md-6 margin-15px-top">
                                <form method="get" action="{{ url('cari') }}">
                                    @csrf
                                    <input type="hidden" name="date" placeholder="date" id="date">

                                    <button type="submit" class="butn no-margin-bottom btn-block">Cari Gedung</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end banner text -->
    </section>
    <!-- end banner -->

    <!-- start about us section -->
    <section>
        <div class="container lg-container">
            <div class="row margin-90px-bottom md-margin-70px-bottom sm-margin-50px-bottom align-items-end">
                <div class="col-md-6 about">
                    <h2 class="no-margin-bottom xs-margin-20px-bottom">Journey after your expectations, with
                        Fivestar hotel</h2>
                </div>
                <div class="col-md-6">

                    <div class="padding-20px-left xs-no-padding-left">

                        <p class="margin-30px-bottom xs-margin-20px-bottom">Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                            text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                            it to make a type specimen book. It has survived not only five centuries, but also the
                            leap into electronic typesetting, remaining essentially unchanged.</p>
                        <a href="about.html">
                            <h6 class="font-italic font-size17 no-margin-bottom">See what makes Fivestar<i
                                    class="fas fa-arrow-right margin-10px-left vertical-align middle font-size12"></i>
                            </h6>
                        </a>

                    </div>

                </div>
            </div>
            <div class="row portfolio">
                <div class="col-md-5">
                    <div class="text-center padding-5px-all">
                        <img src="img/portfolio/1.jpg" alt="" />
                        <h6 class="no-margin-bottom font-size18 font-italic margin-20px-top">Natural food</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center portfolio-block1 padding-5px-all">
                        <img src="img/portfolio/2.jpg" alt="" />
                        <h6 class="no-margin-bottom font-size18 font-italic margin-20px-top">People</h6>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center portfolio-block2 padding-5px-all">
                        <img src="img/portfolio/3.jpg" alt="" />
                        <h6 class="no-margin-bottom font-size18 font-italic margin-20px-top">Nature</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about us section -->

    <!-- start services section -->
    <section>
        <div class="container lg-container">
            <div class="text-center margin-70px-bottom xs-margin-30px-bottom">
                <h3 class="margin-10px-bottom">Hotel Services</h3>
                <p class="no-margin-bottom">Lorem Ipsum is simply dummy printing</p>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-3 md-margin-30px-bottom">
                    <div class="bg-white border padding-40px-all h-100">
                        <span class="margin-20px-bottom font-size40 text-theme-color display-inline-block"><i
                                class="ti-ticket"></i></span>
                        <h3 class="font-size20 margin-20px-bottom sm-margin-10px-bottom">24-hour reception</h3>
                        <p class="no-margin-bottom">Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry.</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 md-margin-30px-bottom">
                    <div class="bg-white border padding-40px-all h-100">
                        <span class="margin-20px-bottom font-size40 text-theme-color display-inline-block"><i
                                class="ti-eraser"></i></span>
                        <h3 class="font-size20 margin-20px-bottom sm-margin-10px-bottom">Room service</h3>
                        <p class="no-margin-bottom">Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry.</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 xs-margin-30px-bottom">
                    <div class="bg-white border padding-40px-all h-100">
                        <span class="margin-20px-bottom font-size40 text-theme-color display-inline-block"><i
                                class="ti-bookmark"></i></span>
                        <h3 class="font-size20 margin-20px-bottom sm-margin-10px-bottom">Airport pick up</h3>
                        <p class="no-margin-bottom">Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry.</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="bg-white border padding-40px-all h-100">
                        <span class="margin-20px-bottom font-size40 text-theme-color display-inline-block"><i
                                class="ti-file"></i></span>
                        <h3 class="font-size20 margin-20px-bottom sm-margin-10px-bottom">Free wifi</h3>
                        <p class="no-margin-bottom">Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end services section -->

    <!-- start popular things section -->
    <section>
        <div class="container-fluid no-padding">
            <div class="bg-light-gray">
                <div class="row align-items-center no-gutters">
                    <div class="col-lg-6">
                        <div class="row no-gutters">
                            <div class="col-md-6">
                                <div class="featured-1 position-relative overflow-hidden">
                                    <div class="featured-img">
                                        <img src="img/content/room-1.jpg" alt="" />
                                    </div>
                                    <div class="featured-text">
                                        <h4 class="margin-5px-bottom">
                                            <a href="single-room.html"
                                                class="font-size28 md-font-size24 text-white font-weight-500">Single
                                                room</a>
                                        </h4>
                                        <span class="font-size18 md-font-size16 text-white">Starting from $120 /
                                            night</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="featured-1 position-relative overflow-hidden">
                                    <div class="featured-img">
                                        <img src="img/content/room-2.jpg" alt="" />
                                    </div>
                                    <div class="featured-text">
                                        <h4 class="margin-5px-bottom">
                                            <a href="single-room.html"
                                                class="font-size28 md-font-size24 text-white font-weight-500">Double
                                                room</a>
                                        </h4>
                                        <span class="font-size18 md-font-size16 text-white">Starting from $200 /
                                            night</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="featured-1 position-relative overflow-hidden">
                                    <div class="featured-img">
                                        <img src="img/content/room-3.jpg" alt="" />
                                    </div>
                                    <div class="featured-text">
                                        <h4 class="margin-5px-bottom">
                                            <a href="single-room.html"
                                                class="font-size28 md-font-size24 text-white font-weight-500">Family
                                                apartment</a>
                                        </h4>
                                        <span class="font-size18 md-font-size16 text-white">Starting from $300 /
                                            night</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="featured-1 position-relative overflow-hidden">
                                    <div class="featured-img">
                                        <img src="img/content/room-4.jpg" alt="" />
                                    </div>
                                    <div class="featured-text">
                                        <h4 class="margin-5px-bottom">
                                            <a href="single-room.html"
                                                class="font-size28 md-font-size24 text-white font-weight-500">Premium
                                                apartment</a>
                                        </h4>
                                        <span class="font-size18 md-font-size16 text-white">Starting from $400 /
                                            night</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-center rooms sm-padding-30px-tb">
                            <h3
                                class="font-size48 md-font-size42 sm-font-size38 xs-font-size34 position-relative padding-30px-bottom md-padding-20px-bottom ms-margin-20px-bottom sm-padding-15px-bottom sm-margin-15px-bottom margin-30px-bottom">
                                Our Rooms</h3>
                            <p
                                class="width-65 md-width-85 xs-width-95 text-extra-dark-gray center-col margin-40px-bottom sm-margin-25px-bottom">
                                It is a long established fact that a reader will be distracted by the readable
                                content of a page when looking at its layout. The point of using Lorem Ipsum is that
                                it has a more-or-less normal.</p>
                            <a href="our-rooms.html" class="butn">show all rooms</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end popular things section -->

    <!-- start testimonial section -->
    <section>
        <div class="container">
            <div class="text-center margin-50px-bottom xs-margin-30px-bottom">
                <h3 class="margin-10px-bottom">Testimonial</h3>
                <p class="no-margin-bottom">Lorem Ipsum is simply dummy printing</p>
            </div>
            <div class="owl-carousel owl-theme text-center" id="testmonials-carousel">
                <div>
                    <img class="rounded-circle margin-30px-bottom" src="img/testmonials/t-1.jpg" alt="" />
                    <p
                        class="line-height-35 xs-line-height-30 font-size18 xs-font-size16 text-extra-dark-gray margin-30px-bottom xs-margin-25px-bottom width-60 md-width-65 sm-width-85 xs-width-100 center-col font-italic">
                        "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                        been the industry's standard dummy text ever since the 1500s, when an unknown printer."</p>
                    <h6 class="font-size18 no-margin-bottom">Isabel Rowla</h6>
                    <small>Customer</small>
                </div>

                <div>
                    <img class="rounded-circle margin-30px-bottom" src="img/testmonials/t-2.jpg" alt="" />
                    <p
                        class="line-height-35 xs-line-height-30 font-size18 xs-font-size16 text-extra-dark-gray margin-30px-bottom xs-margin-25px-bottom width-60 md-width-65 sm-width-85 xs-width-100 center-col font-italic">
                        "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                        been the industry's standard dummy text ever since the 1500s, when an unknown printer."</p>
                    <h6 class="font-size18 no-margin-bottom">James Martin</h6>
                    <small>Customer</small>
                </div>

                <div>
                    <img class="rounded-circle margin-30px-bottom" src="img/testmonials/t-3.jpg" alt="" />
                    <p
                        class="line-height-35 xs-line-height-30 font-size18 xs-font-size16 text-extra-dark-gray margin-30px-bottom xs-margin-25px-bottom width-60 md-width-65 sm-width-85 xs-width-100 center-col font-italic">
                        "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                        been the industry's standard dummy text ever since the 1500s, when an unknown printer."</p>
                    <h6 class="font-size18 no-margin-bottom">Joe Shepard</h6>
                    <small>Customer</small>
                </div>
            </div>
        </div>
    </section>
    <!-- end testimonial section -->

    <!-- start blog section -->
    <section>
        <div class="container lg-container">
            <div class="text-center margin-50px-bottom xs-margin-30px-bottom">
                <h3 class="margin-10px-bottom">Our Blog</h3>
                <p class="no-margin-bottom">Lorem Ipsum is simply dummy printing </p>
            </div>
            <div class="row">
                <div class="col-lg-4 sm-margin-30px-bottom">
                    <div class="h-100">
                        <img src="img/blog/blog-03.jpg" alt="" />
                        <div class="padding-25px-top padding-20px-lr">
                            <div
                                class="font-size12 text-uppercase text-theme-color font-weight-700 margin-10px-bottom letter-spacing-2">
                                January 22, 2020</div>
                            <h5 class="margin-30px-bottom sm-margin-20px-bottom font-size26 md-font-size24"><a
                                    href="blog-details.html" class="text-extra-dark-gray">Mother world host your
                                    travels</a></h5>
                            <a href="blog-details.html" class="font-weight-600">View Details<i
                                    class="fas fa-arrow-right margin-10px-left vertical-align middle font-size12"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 sm-margin-30px-bottom">
                    <div class="h-100">
                        <img src="img/blog/blog-04.jpg" alt="" />
                        <div class="padding-25px-top padding-20px-lr">
                            <div
                                class="font-size12 text-uppercase text-theme-color font-weight-700 margin-10px-bottom letter-spacing-2">
                                February 2, 2020</div>
                            <h5 class="margin-30px-bottom sm-margin-20px-bottom font-size26 md-font-size24"><a
                                    href="blog-details.html" class="text-extra-dark-gray">Food, wine with all
                                    things permissive.</a></h5>
                            <a href="blog-details.html" class="font-weight-600">View Details<i
                                    class="fas fa-arrow-right margin-10px-left vertical-align middle font-size12"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="h-100">
                        <img src="img/blog/blog-05.jpg" alt="" />
                        <div class="padding-25px-top padding-20px-lr">
                            <div
                                class="font-size12 text-uppercase text-theme-color font-weight-700 margin-10px-bottom letter-spacing-2">
                                February 27, 2020</div>
                            <h5 class="margin-30px-bottom sm-margin-20px-bottom font-size26 md-font-size24"><a
                                    href="blog-details.html" class="text-extra-dark-gray">Getting low-cost airfare
                                    for last minute trip</a></h5>
                            <a href="blog-details.html" class="font-weight-600">View Details<i
                                    class="fas fa-arrow-right margin-10px-left vertical-align middle font-size12"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end blog section -->

    <!-- start extra section -->
    <section class="no-padding">
        <div class="container-fluid no-padding">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div class="padding-ten-tb bg-img" data-overlay-dark="5" data-background="img/content/04.jpg">
                        <div class="position-relative z-index-1 text-center extra-1">
                            <h3 class="text-white">Restaurant & Food</h3>
                            <a href="#">
                                <h6 class="font-italic font-size17 text-white no-margin-bottom letter-spacing-1">
                                    See what makes Fivestar<i
                                        class="fas fa-arrow-right margin-10px-left vertical-align middle font-size12"></i>
                                </h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="padding-ten-tb bg-img" data-overlay-dark="5" data-background="img/content/05.jpg">
                        <div class="position-relative z-index-1 text-center extra-1">
                            <h3 class="text-white">Rooms & Apartments</h3>
                            <a href="#">
                                <h6 class="font-italic font-size17 text-white no-margin-bottom letter-spacing-1">
                                    See what makes Fivestar<i
                                        class="fas fa-arrow-right margin-10px-left vertical-align middle font-size12"></i>
                                </h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end extra section -->
@endsection

@push('customScript')
    <script>
        $(document).ready(function() {

            function convertDate(date) {
                var dates = new Date(date);
                var yyyy = dates.getFullYear().toString();
                var mm = (dates.getMonth() + 1).toString();
                var dd = dates.getDate().toString();

                var mmChars = mm.split('');
                var ddChars = dd.split('');

                return yyyy + '-' + (mmChars[1] ? mm : "0" + mmChars[0]) + '-' + (ddChars[1] ? dd : "0" + ddChars[
                    0]);
            }

            $("#tgl").on('change', function() {
                var tgl = $(this).val();
                var tgl_convert = convertDate(tgl);
                $("#date").val(tgl_convert);
            });


            $("#btn-cari").click(function() {
                cariJadwal();
            });

            function cariJadwal() {
                $(".result").html('');
                var tanggal = $("#tanggal").val();
                tanggal = convertDate(tanggal);
                var gedung = $("#gedung").val();
                console.log(tanggal);
                field = $(".field").val();
                $.ajax({
                    type: "GET",
                    url: "api/cek-gedung?tanggal=" + tanggal + "&id_gedung=" + gedung,
                    success: function(data) {
                        console.log(data);
                        if (data.success) {
                            $(".result").html('<h5 class="text-center mb-0 pb-0 mr-3">' + data.message +
                                '</h5> <a href="{{ url('/booking') }}" class="btn btn-primary btn-sm">Lanjutkan Booking</a>'
                            );
                        } else {
                            $(".result").html('<h5 class="text-center mb-0 pb-0">' + data.message +
                                '</h5>');
                        }
                    }
                });
            }
        });
    </script>
@endpush
