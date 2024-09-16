<!DOCTYPE html>
<html lang="en">
<head>
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/styles.css') }}" rel="stylesheet" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Course Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add other meta tags and stylesheets as needed -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/bootstrap4/bootstrap.min.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/ruangan1.css') }}">

    <!-- RRQ -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
    <link href="{{ asset('assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/adminlte3.2/dist/img/favicon.png') }}">

    <style type="text/css">
        .deskripsi{
          color: white;
          font-family: Verdana, Arial, Helvetica, sans-serif;
        }
        .deskripsi2{
          color: white;
          font-family:  Helvetica, sans-serif;
          font-size: 15px;
          margin-top: 0PX;
          margin-bottom: 10PX;
        }
        .deskripsi3{
          color: black;
          font-family:  Helvetica, sans-serif;
          font-size: 14px;
          margin-top: 10PX;
        }
        .deskripsi4{
          color: black;
          font-family:  Helvetica, sans-serif;
          font-size: 11px;
          margin-top: 20PX;
        }
        .spek{
          margin: auto;
        }
        .spek-fasilitas{
          margin: auto;
          width: 70px;
          height: 70px;
        }
        .cardview{
          /* background-color: white; */
          width: 100px;
          height: 100px;
          padding-top: 10px;
          padding-bottom: 10px;
          margin-top: 10px;
          margin-left: 20px;
        }
        .cardview2{
          /*background-color: white;*/
          width: 100px;
          height: 100px;
          padding-top: 10px;
          padding-bottom: 10px;
          margin-top: 10px;
          margin-left: 20px;
        }
        .cardview3{
          background-color: white;
          width: 180px;
          height: 120px;
          padding-bottom: 10px;
          margin-top: 10px;
          margin-left: 20px;
        }
        .cardview4{
          background-color: #f5d908;
          width: 150px;
          padding-bottom: 10px;
          margin-top: 10px;
          margin-left: 10px;
        }
        .center 
        {
          margin: 0;
          position: absolute;
          top: 50%;
          left: 50%;
          -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
        }
        .button-pesan{
                    appearance: button;
                    background-color: #17a2b8;
                    background-image: none;
                    border: 1px solid #0059ab;
                    border-radius: 4px;
                    box-shadow: #fff 4px 4px 0 0, #000 4px 4px 0 1px;
                    box-sizing: border-box;
                    color: #000;
                    cursor: pointer;
                    display: inline-block;
                    font-family: ITCAvantGardeStd-Bk,Arial,sans-serif;
                    font-size: 14px;
                    font-weight: 400;
                    line-height: 20px;
                    /*margin: 100% 0px 0px -40px;*/
                    margin-left: -15%;
                    overflow: visible;
                    padding: 12px 40px;
                    text-align: center;
                    text-transform: none;
                    touch-action: manipulation;
                    user-select: none;
                    -webkit-user-select: none;
                    vertical-align: middle;
                    white-space: nowrap;
                }
                .button-pesan:hover {
                  appearance: button;
                    background-color: #17a2b8;
                    background-image: none;
                    border: 1px solid #0059ab;
                    border-radius: 4px;
                    box-shadow: #fff 4px 4px 0 0, #000 4px 4px 0 1px;
                    box-sizing: border-box;
                    color: #000;
                    cursor: pointer;
                    display: inline-block;
                    font-family: ITCAvantGardeStd-Bk,Arial,sans-serif;
                    font-size: 14px;
                    font-weight: 400;
                    line-height: 20px;
                    overflow: visible;
                    /*padding: 12px 40px;*/
                    text-align: center;
                    text-transform: none;
                    touch-action: manipulation;
                    user-select: none;
                    -webkit-user-select: none;
                    vertical-align: middle;
                    white-space: nowrap;
                }
    </style>
</head>
<body>

<div class="super_container">
    <!-- Header -->
    <header class="header d-flex flex-row" style="top: 10px; height: 70px;">
        @include('navbarMenu2')
    </header>

    <!-- Home -->
    <div class="row" style="margin-top: 100px;width: 100%;height:100%;background-color: #0059ab;margin-left: 0px;margin-right: 0px;">
        <div class="col-md-6" style="width: 100%">
            <div style="width: 100%;margin: 20px 20px 20px 20px;">

                    <center><h2 class="deskripsi"><b>{{ $ruangan->nama_ruangan}}</b></h2></center>
                    <h4 class="deskripsi" style="margin-top: 20px;">Spesifikasi</h4>
                    <div class=" row">
                        <div class="col-md-12 row">
                            <div  class="cardview">
                                <center><div style="border-radius: 50%;width: 80px;height: 80px;background-color: #f5d908">
                                    <img class="spek" src="{{ asset('assets/foto/capacity.png') }}">
                                </div></center>
                                <center><p class="deskripsi2">{{ $ruangan->kapasitas_ruangan }} Orang</p></center>
                            </div>
                            <div class="cardview">
                                <center><div style="border-radius: 50%;width: 80px;height: 80px;background-color: #f5d908">
                                    <img class="spek" src="{{ asset('assets/foto/pin-point.png') }}">
                                </div></center>
                                <center><p class="deskripsi2">{{ $ruangan->lokasi_ruangan }}</p></center>
                            </div>
                        </div>
                    </div>
                    <h4 class="deskripsi" style="margin-top: 25px;">Fasilitas</h4>
                    <div class="row">
                        <div class="col-md-12 row">
                            <div class="form-group">
                                <div id="dataFasilitas" class="text-warning" style="display: flex; flex-wrap: wrap;">
                                    @if($fasilitasDetail->count() > 0)
                                        @foreach ($fasilitasDetail as $fasilitas)
                                            <div style="border-radius: 50%; width: 80px; height: 80px; background-color:  #f5d908; margin-right: 10px;">
                                                <img class="spek-fasilitas center" src="{{ asset($fasilitas->foto_fasilitas) }}" width="50">
                                            </div>
                                        @endforeach
                                    @else
                                        <p>Tidak ada detail fasilitas untuk ruangan ini.</p>
                                    @endif
                                </div>
                            </div>
                        </div>                                                                                        
                    </div>
                    <!-- PIC -->
                    <h4 class="deskripsi" style="margin-top: 10px;">PIC</h4>
                    <div class=" row">
                        <div class="col-md-12 row">
                            <div  class="cardview4" style="border: solid;">
                                <center><p class="deskripsi3"><b>Koordinator Lab</b></p></center>
                                <center><p class="deskripsi4">{{ $ruangan->koor_upt }} </p></center>
                            </div>
                            <div  class="cardview4" style="border: solid;">
                                <center><p class="deskripsi3"><b>PIC Lab</b></p></center>
                                <center><p class="deskripsi4">{{ $ruangan->pic_lab }} </p></center>
                            </div>
                            <div  class="cardview4" style="border: solid;">
                                <center><p class="deskripsi3"><b>Admin Lab 1</b></p></center>
                                <center><p class="deskripsi4"><b>{{ $ruangan->admin_lab1 }} </b></p></center>
                            </div>
                            <div  class="cardview4" style="border: solid;">
                                <center><p class="deskripsi3"><b>Admin Lab 2</b></p></center>
                                <center><p class="deskripsi4">{{ $ruangan->admin_lab2 }} </p></center>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-md-6" style="padding-right: 30px;">
            <div class="slider slider-nav" style="width: 100%; margin-top: 20px;">
                @foreach([$ruangan->foto1, $ruangan->foto2, $ruangan->foto3, $ruangan->foto4] as $foto)
                    <img style="max-height: 620px; max-width: 100%;" src="{{ asset($foto) }}" />
                @endforeach
            </div>
        </div>
    </div>

    <footer class="footer" style="padding-top: 0px;margin-top: 0px;">
        <div class="container">
            <div class="footer_bar d-flex flex-column flex-sm-row align-items-center">
                <div class="footer_copyright">
                    <span>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | Polteknik Astra</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </span>
                </div>
            </div>

        </div>
    </footer>
</div>

<!-- Add your scripts at the end of the body -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    $('.slider-nav').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        focusOnSelect: true
    });

    $('a[data-slide]').click(function(e) {
        e.preventDefault();
        var slideno = $(this).data('slide');
        $('.slider-nav').slick('slickGoTo', slideno - 1);
    });
</script>
<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('assets/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/scrollTo/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('assets/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('assets/dist/js/scripts.js') }}"></script>

</body>
</html>
