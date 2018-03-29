@extends('layouts.auth')

@section('title') {{ Setting::get('site_title') }} - Resetuj hasło @endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 col-sm-8 col-md-6 col-lg-4 col-lg-offset-4 col-md-offset-3 col-sm-offset-2 col-xs-offset-1">
            <div class="grid simple">
                <div class="grid-body">
                    <h4>Resetuj hasło</h4>
                    @include ('layouts.partials.notifications')    
                    <form action="{{ route('auth.password.forgot') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                            <div class="input-group transparent">
                                <div class="input-group-addon"><i class="material-icons">person_pin</i></div>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Nazwa użytkownika">
                            </div>
                            @if ($errors->has('username'))
                                <span class="help-block">
                                    {{ $errors->first('username') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <div class="input-group transparent">
                                <div class="input-group-addon"><i class="material-icons">mail</i></div>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Adres email" @if(old('email')) value="{{ old('email') }}" @endif>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        @if(Session::get('forgotcaptcha'))
                            <div class="form-group {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
                                {!! Recaptcha::render() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        {{ $errors->first('g-recaptcha-response') }}
                                    </span>
                                @endif
                            </div>
                        @endif
                        <button type="submit" class="btn btn-block btn-success">Wyślij</button>
                    </form>
                    <hr>
                    <a href="{{ route('auth.signin') }}" class="btn btn-label pull-left"><i class="fa fa-home"></i> Powrót do strony logowania</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('sweet::alert')
@endsection

@section('css')
<link href="{{ asset('assets/plugins/sweetAlert/sweetAlert.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="{{ asset('assets/plugins/sweetAlert/sweetAlert.min.js') }}" type="text/javascript"></script>
@endsection