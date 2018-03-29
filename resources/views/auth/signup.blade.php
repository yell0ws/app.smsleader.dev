@extends('layouts.auth')

@section('title') {{ Setting::get('site_title') }} - Dołącz do nas już teraz! @endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 col-sm-8 col-md-6 col-lg-4 col-lg-offset-4 col-md-offset-3 col-sm-offset-2 col-xs-offset-1">
            <div class="grid simple">
                <div class="grid-body">
                <h4>Dołącz do nas już teraz!</h4>
                @include ('layouts.partials.notifications')
                <form action="{{ route('auth.signup') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                    <div class="input-group transparent">
                    <div class="input-group-addon"><i class="material-icons">person_pin</i></div>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nazwa użytkownika" @if(old('username')) value="{{ old('username') }}" @endif>
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
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <div class="input-group transparent">
                    <div class="input-group-addon"><i class="material-icons">lock_outline</i></div>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Hasło">
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <div class="input-group transparent">
                    <div class="input-group-addon"><i class="material-icons">lock_outline</i></div>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Powtórz hasło">
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            {{ $errors->first('password_confirmation') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
                    {!! Recaptcha::render() !!}
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            {{ $errors->first('g-recaptcha-response') }}
                        </span>
                    @endif
                </div>
                <div class="form-group checkbox {{ $errors->has('rule_accept') ? 'has-error' : '' }}">
                        <div class="checkbox check-success">
                        <input id="rule_accept" name="rule_accept" type="checkbox">
                        <label for="rule_accept">Oświadczam, że zapoznałem się i akceptuję postanowienia <a href="">Regulaminu</a> oraz <a href="">Polityki Prywatności</a></label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block" @if (Setting::get('signup_disabled')) disabled @endif>Zarejestruj się</button>
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