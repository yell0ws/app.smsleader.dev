<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/scrollbar/css/scrollbar.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/animate/css/animate.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/notify/css/notify.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('css')
    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/main.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/notify/js/notify.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/scrollbar/js/scrollbar.min.js') }}" type="text/javascript"></script>
    @yield('js')
    <script type="text/javascript">
    $(function () {
        Main.init();
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
                <div class="chat-toggler">
                    <div class="user-details">
                      <div class="balance">
                        <span class="label label-success" style="font-size: 13px;font-weight: 400;">Dostępne środki: <span class="bold">{{ Auth::user()->balance }} PLN</span>
                      </div>
                    </div>
                </div>
                <ul class="nav quick-section">
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
                <p class="menu-title sm">Dashboard</p>
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ Request::is('/') ? 'active' : '' }}"><i class="ion-home"></i> <span class="title">Pulpit</span></a>
                </li>
                @if (Auth::user()->admin)
                <li>
                    <a href="{{ route('admin.dashboard') }}"><i class="ion-settings indigo"></i> <span class="title">Panel Administratora</span></a>
                </li>
                @endif
                <p class="menu-title sm">Strefa zarabiania</p>
                <li>
                    <a class="{{ Request::is('programs/*') ? 'active' : '' }}"><i class="fa fa-gift orange"></i><span class="title">Programy Partnerskie</span> <span class=" arrow"></span> </a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('program.list') }}"><i class="fa fa-circle"></i>Programy MO/MT</a></li>
                        <li><a href="{{ route('program.configuration') }}"><i class="fa fa-circle"></i>Moje konfiguracje</a></li>
                    </ul>
                </li>
                <li>
                    <a class="{{ Request::is('widgets/*') ? 'active' : '' }}"> <i class="fa fa-puzzle-piece blue"></i> <span class="title">Widgety</span> <span class=" arrow"></span> </a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('widget.player') }}"><i class="fa fa-circle"></i>Player</a></li>
                        <li><a href="{{ route('widget.locker') }}"><i class="fa fa-circle"></i>Content Locker</a></li>
                    </ul>
                </li>
                <li>
                    <a><i class="ion-stats-bars red"></i> <span class="title">Statystyki</span> <span class="arrow"></span> </a>
                    <ul class="sub-menu">
                        <li><a href=""><i class="fa fa-circle"></i>Ogólne</a></li>
                        <li><a href=""><i class="fa fa-circle"></i>Lista leadów</a></li>
                    </ul>
                </li>
                                <li>
                    <a href="{{ route('referral.list') }}" class="{{ Request::is('referrals/*') ? 'active' : '' }}"> <i class="ion-person-stalker purple"></i> <span class="title">Poleceni</span> </a>
                </li>
                <li>
                    <a href="{{ route('rank.today') }}" class="{{ Request::is('top/*') ? 'active' : '' }}"> <i class="ion-trophy yellow"></i> <span class="title">Ranking (TOP 20)</span> </a>
                </li>

                <p class="menu-title sm">Zarządzanie kontem</p>
                                <li>
                    <a href="{{ route('setting.account') }}" class="{{ Request::is('settings/*') ? 'active' : '' }}"><i class="ion-gear-b green"></i> <span class="title">Ustawienia konta</span> </a>
                </li>
                <li>
                    <a class="{{ Request::is('payouts/*') ? 'active' : '' }}"><i class="ion-arrow-swap brown"></i> <span class="title">Wypłaty</span> <span class=" arrow"></span> </a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('payout.withdraw') }}"><i class="fa fa-circle"></i>Wypłata środków</a></li>
                        <li><a href="{{ route('payout.history') }}"><i class="fa fa-circle"></i>Historia wypłat</a></li>
                    </ul>
                </li>

                <p class="menu-title sm">Strefa pomocy</p>
                <li>
                    <a href="{{ route('support.faq') }}" class="{{ Request::is('support/faq') ? 'active' : '' }}"><i class="ion-help-buoy lime"></i> <span class="title">FAQ</span></a>
                </li>
                <li>
                    <a href="{{ route('support.contact') }}" class="{{ Request::is('support/contact') ? 'active' : '' }}"><i class="ion-paper-airplane cyan"></i> <span class="title">Kontakt</span></a>
                </li>
            </ul>
        <div class="clearfix"></div>
        </div>
    </div>
    <div class="page-content">
            @yield('content')
    </div>
</div>
</body>
</html>