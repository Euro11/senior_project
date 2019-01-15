<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Backend : Teacher</title>
    <link rel="stylesheet" href="{{ asset('css/backend/sidebar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/backend/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/DataTables/datatables.min.css')}}"/>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    @yield('stylesheet')
</head>
<body>
<div class="nav-side-menu">
    <div class="brand">Brand Logo</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                    <a href="{{ url('/') }}"><i class="fas fa-home sidebar-icon"></i> Dashboard</a>
                </li>
                
                <li>
                    <a href="#"><i class="far fa-calendar-check sidebar-icon"></i> Check Attendance</a>
                </li>
                
                <li>
                    <a href="{{ url('/managesubject')}}"><i class="fa fa-cogs fa-lg fa-fw sidebar-icon"></i> Manage Subject</a>
                </li>

                <li>
                    <a href="{{ url('/manageuser') }}"><i class="fas fa-users-cog sidebar-icon"></i> Manage Users</a>
                </li>

                <li>
                    <a href="{{ url('/role') }}"><i class="fas fa-users sidebar-icon"></i> Users Role & Week</a>
                </li>
                
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt sidebar-icon"></i>{{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
     </div>
</div>

<div class="main">
    @yield('content')
</div>
<script src="{{ asset('js/backend/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/backend/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/backend/DataTables/datatables.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#datatables').DataTable( {
            responsive: true,
        } );
    } );
</script>
@yield('javascript')
</body>
</html>