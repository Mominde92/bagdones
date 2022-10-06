<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"/>

        {{-- Title Section --}}
        <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

        {{-- Meta Data --}}
        <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />

        <!--Google font-->
        <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

        <!--icon css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/font-awesome.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/themify.css') }}">


        <!--Slick slider css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/slick.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/slick-theme.css') }}">

        <!--Animate css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/animate.css') }}">
        <!-- Bootstrap css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/bootstrap.css') }}">

        <!-- Theme css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/color2.css') }}" media="screen" id="color">

        {{-- Includable CSS --}}
        @yield('styles')
    </head>

    <body class="bg-light">
    
    @yield('content')
        {{-- Includable JS --}}
        
<!-- footer start -->
<footer>
  <div class="footer1">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="footer-main">
            <div class="footer-box">
              <div class="footer-title mobile-title">
                <h5>about</h5>
              </div>
              <div class="footer-contant">
                <div class="footer-logo">
                  <a href="#">
                    <img src="{{asset('media/logos/bagdones_logo.png')}}" class="img-fluid" alt="logo">
                  </a>
                </div>
                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.</p>
                <ul class="paymant">
                  <li><a href="javascript:void(0)"><img src="{{ asset('frontend/assets/images/layout-1/pay/1.png')}}" class="img-fluid" alt="pay"></a></li>
                  <li><a href="javascript:void(0)"><img src="{{ asset('frontend/assets/images/layout-1/pay/2.png')}}" class="img-fluid" alt="pay"></a></li>
                  <li><a href="javascript:void(0)"><img src="{{ asset('frontend/assets/images/layout-1/pay/3.png')}}" class="img-fluid" alt="pay"></a></li>
                  <li><a href="javascript:void(0)"><img src="{{ asset('frontend/assets/images/layout-1/pay/4.png')}}" class="img-fluid" alt="pay"></a></li>
                  <li><a href="javascript:void(0)"><img src="{{ asset('frontend/assets/images/layout-1/pay/5.png')}}" class="img-fluid" alt="pay"></a></li>
                </ul>
              </div>
            </div>
            <div class="footer-box">
              <div class="footer-title">
                <h5>my account</h5>
              </div>
              <div class="footer-contant">
                <ul>
                  <li><a href="javascript:void(0)">about us</a></li>
                  <li><a href="javascript:void(0)">contact us</a></li>
                  <li><a href="javascript:void(0)">terms &amp; conditions</a></li>
                  <li><a href="javascript:void(0)">returns &amp; exchanges</a></li>
                  <li><a href="javascript:void(0)">shipping &amp; delivery</a></li>
                </ul>
              </div>
            </div>
            <div class="footer-box">
              <div class="footer-title">
                <h5>contact us</h5>
              </div>
              <div class="footer-contant">
                <ul class="contact-list">
                  <li><i class="fa fa-map-marker"></i>big deal store demo store <br> india-<span>3654123</span></li>
                  <li><i class="fa fa-phone"></i>call us: <span>123-456-7898</span></li>
                  <li><i class="fa fa-envelope-o"></i>email us: support@bigdeal.com</li>
                  <li><i class="fa fa-fax"></i>fax <span>123456</span></li>
                </ul>
              </div>
            </div>
     
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="subfooter dark-footer ">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-md-8 col-sm-12">
          <div class="footer-left">
            <p>201022 Powered by pixel strap</p>
          </div>
        </div>
        <div class="col-xl-6 col-md-4 col-sm-12">
          <div class="footer-right">
            <ul class="sosiyal">
              <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
              <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
              <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
              <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>
              <li><a href="javascript:void(0)"><i class="fa fa-rss"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- footer end -->
        @yield('scripts')
       
        
        <!-- latest jquery-->
        <script src="{{ asset('frontend/assets/js/jquery-3.3.1.min.js')}}"></script>

        <!-- slick js-->
        <script src="{{ asset('frontend/assets/js/slick.js')}}"></script>

        <!-- popper js-->
        <script src="{{ asset('frontend/assets/js/popper.min.js')}}" ></script>
        <script src="{{ asset('frontend/assets/js/bootstrap-notify.min.js')}}"></script>

        <!-- menu js-->
        <script src="{{ asset('frontend/assets/js/menu.js')}}"></script>

        <!-- timer js -->
        <script src="{{ asset('frontend/assets/js/timer2.js')}}"></script>

        <!-- Bootstrap js-->
        <script src="{{ asset('frontend/assets/js/bootstrap.js')}}"></script>

        <!-- tool tip js -->
        <script src="{{ asset('frontend/assets/js/tippy-popper.min.js')}}"></script>
        <script src="{{ asset('frontend/assets/js/tippy-bundle.iife.min.js')}}"></script>

        <!-- father icon -->
        <script src="{{ asset('frontend/assets/js/feather.min.js')}}"></script>
        <script src="{{ asset('frontend/assets/js/feather-icon.js')}}"></script>

        <!-- Theme js-->
        <script src="{{ asset('frontend/assets/js/modal.js')}}"></script>
        <script src="{{ asset('frontend/assets/js/script.js')}}"></script>
        
    </body>
</html>

