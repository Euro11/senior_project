<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fontend</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

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
                    <a href="{{ route('checkattendance.show', $user->id) }}"><li>เช็คชื่อ</li></a>
                    <a href="{{ route('statistic.show', $user->id) }}"><li>สถิติ</li></a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><li>ออกจากระบบ</li></a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
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
