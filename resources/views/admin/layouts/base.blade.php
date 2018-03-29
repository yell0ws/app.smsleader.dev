<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="{{ asset('assets/plugins/bootstrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/animate.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/jquery-notify/notify.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('css')
    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/main.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-notify/notify.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}" type="text/javascript"></script>
    @yield('js')
    <script type="text/javascript">
    $(function () {
        @yield('script')
    });
    </script>
</head>
<body>
<div class="header navbar navbar-inverse ">
    <div class="navbar-inner">
        <div class="header-seperation">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/img/logox2light.png') }}" class="logo"/>
            </a>
        </div>
        <div class="header-quick-nav">
        <div class="pull-left">
            <div class="chat-toggler">
                <div class="profile-pic">
                    <img src="https://scontent-fra3-1.xx.fbcdn.net/v/t1.0-1/c0.0.160.160/p160x160/14317356_935187816626851_1587266056910082644_n.jpg?oh=e8f6ebb015f8fdf1fc288a0acb95f2c5&oe=58C45DB8">
                  </div>
                    <div class="user-details">
                      <div class="username">
                        Witaj <span class="bold"> {{ Auth::user()->username }}</span>!
                      </div>
                    </div>
                </div>
            </div>
            <div class="pull-right">
            <!--
                <div class="chat-toggler">
                    <div class="user-details">
                      <div class="balance">
                     <span class="label label-success">Twoje środki: {{ Auth::user()->balance }} zł</span>
                      </div>
                    </div>
                </div>
                -->
                <ul class="nav quick-section">
                <!--
                    <li class="quicklinks">
                        <a data-toggle="dropdown" class="dropdown-toggle pull-right " href="#" id="user-options">
                            <i class="fa fa-cog"></i>
                        </a>
                        <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                          <li>
                            <a href="{{ route('setting.account') }}"> <i class="fa fa-cog"></i> Ustawienia konta</a>
                            <a href="{{ route('setting.personal') }}"> <i class="fa fa-cogs"></i> Dane osobowe</a>
                            <a href="{{ route('setting.password') }}"> <i class="fa fa-lock"></i> Zmiana hasła</a>
                          </li>
                        </ul>
                    </li>
                    -->
                        <li class="quicklinks">
                        <a href="{{ route('dashboard') }}">
                          <i class="fa fa-undo"></i>
                        </a>
                    </li>
                    <li class="quicklinks">
                        <a href="{{ route('auth.signout') }}">
                          <i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="page-container row-fluid">
    <div class="page-sidebar " id="main-menu">
        <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
            <ul>
                <p class="menu-title sm">Panel Administratora</p>
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ Request::is('/') ? 'active' : '' }}"><i class="fa fa-home"></i> <span class="title">Panel</span></a>
                </li>
                <li>
                    <a href="{{ route('admin.user.list') }}" class="{{ Request::is('admin/users/*') ? 'active' : '' }}"> <i class="fa fa-users"></i> <span class="title">Zarządzaj użytkownikami</span> </a>
                </li>
                <li>
                    <a href="{{ route('admin.withdraw.list') }}" class="{{ Request::is('admin/programs/*') ? 'active' : '' }}"> <i class="fa fa-gift"></i> <span class="title">Zarządzaj programami</span> </a>
                </li>
                <li>
                    <a href="{{ route('admin.withdraw.list') }}" class="{{ Request::is('admin/withdraws/*') ? 'active' : '' }}"> <i class="fa fa-exchange"></i> <span class="title">Zarządzaj wypłatami</span> </a>
                </li>
                <li>
                    <a href=""> <i class="fa fa-area-chart"></i> <span class="title">Statystyki</span> <span class=" arrow"></span> </a>
                    <ul class="sub-menu">
                        <li> <a href="{{ route('widget.download') }}"><i class="fa fa-area-chart"></i> Ogólne</a> </li>
                        <li> <a href="{{ route('widget.download') }}"><i class="fa fa-list"></i> Lista leadów</a> </li>
                    </ul>
                </li>
            </ul>
        <div class="clearfix"></div>
        </div>
    </div>
    <div class="page-content">
        <div class="clearfix"></div>
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>
</div>
</div>
</body>
</html>