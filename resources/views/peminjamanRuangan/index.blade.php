<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/styles.css') }}" rel="stylesheet" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Course Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                
        .flex {
          display: flex;
        }
        .margin{
            margin: 10px 10px 10px 10px;
        }
        .button-pesan{
            appearance: button;
            background-color: #0059ab;
            background-image: none;
            border: 1px solid #0059ab;
            border-radius: 4px;
            box-shadow: #fff 4px 4px 0 0, #000 4px 4px 0 1px;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-family: ITCAvantGardeStd-Bk,Arial,sans-serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
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
            background-color: #0059ab;
            background-image: none;
            border: 1px solid #0059ab;
            border-radius: 4px;
            box-shadow: #fff 4px 4px 0 0, #000 4px 4px 0 1px;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-family: ITCAvantGardeStd-Bk,Arial,sans-serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            overflow: visible;
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
    <!-- Home -->
    <div class="super_container">
        <!-- Header -->
        <header class="header d-flex flex-row" style="top: 10px; height: 70px;">
            @include('navbarMenu2')
        </header>
    </div>
    <center>
        <div class="page--home" style="width: 100%;">
            <div class="division ">
                <ul class="division__list slider slider-nav" style="margin-top: 100px;">
                    @foreach($ruangan as $row)
                        <li class="division__list--item margin" style="width: 450px;">
                            <div class="item--inner">
                                <div class="item__wrapper">
                                    <div class="img" style="background-image: url({{ asset($row->foto1) }});"></div>
                                </div>
                            </div>
                            <div class="item--content" style="height: 100%">
                                <div style="vertical-align: top;height: 100%">
                                    <span class="" style="font-family: 'Cambria';font-size: 40px;color: white;font-style: bold;">{{ $row->nama_ruangan }}</span>
                                </div>
                                <div style="vertical-align: bottom;height: 20%">
                                    <a href="{{ route('peminjamanRuangan.detail', ['id' => $row->ruangan_id]) }}" class="button-pesan">LIHAT RUANGAN</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </center>
        <!-- Footer Content -->

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
         $('.slider-nav').slick({
           slidesToShow: 5,
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

</body>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('assets/dist/js/scripts.js') }}"></script>

</html>
