<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>I NEED TO CHECK</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    @yield('stylesheet')
</head>
<body>
        
    <div class="wrapper">
        <div class="row">
            <div class="col-12" id="sidebar" style="z-index: 2">
                <div class="toggle-btn" onclick="toggleSidebar()">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul style="padding-left: 20px;">
                <div class="text-center">
                    <img class="user-image" src="{{ asset("img/img_profile/$user->img_profile")}}" alt="profile">
                    <h3 style="color: #fff;">{{ $user->name }}</h3>                    
                </div>
                    <a href="{{ url('/') }}"><li>หน้าแรก</li></a>
                    <a href="{{ route('profile', $user->id) }}"><li>ข้อมูลส่วนตัว</li></a>
                    <a href="{{ url('/statistic') }}"><li>สถิติ</li></a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><li>ออกจากระบบ</li></a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
    <!-- desktop -->
    <div class="d-none d-sm-block">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="{{ asset('img\bannerQR.png')}}" alt="First slide" class="banner">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{ asset('img\banner.png')}}" alt="Second slide" class="banner">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- mobile -->
    <div class="d-sm-none">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="{{ asset('img\bannerQR.png')}}" alt="First slide" class="banner-mobile">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{ asset('img\banner.png')}}" alt="Second slide" class="banner-mobile">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <main class="container" style="padding-top: 50px;position: relative;">
        @yield('content')
    </main>
    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    @yield('javascript')
</body>
</html>
