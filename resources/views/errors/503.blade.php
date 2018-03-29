<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} - Nie odnaleziono strony</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('assets/plugins/bootstrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/animate.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
    @yield('css')
    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
    @yield('js')
    </head>
  <body style="background-image: url('{{ asset('assets/img/bglight.png') }}')">
    <div class="error-wrapper container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="error-container">
            <div class="error-main">
              <div class="error-number"> Przerwa techniczna </div>
              <div class="error-description"> Przepraszamy ale aktualnie serwis jest niedostępny z powodu prac modernizacyjnych. Za utrudenia przepraszamy!</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>