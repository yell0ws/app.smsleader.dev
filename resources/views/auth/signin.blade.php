@extends('layouts.auth')

@section('title') {{ Setting::get('site_title') }} - Zaloguj się do panelu @endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 col-sm-8 col-md-6 col-lg-4 col-lg-offset-4 col-md-offset-3 col-sm-offset-2 col-xs-offset-1">
            <div class="grid simple">
                <div class="grid-body">
                <h4>Zaloguj się do panelu</h4>
                @include ('layouts.partials.notifications')            
                <form action="{{ route('auth.signin') }}" method="POST" id="signinForm">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <div class="input-group transparent">
                        <div class="input-group-addon"><i class="material-icons">mail</i></div>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Adres email">
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
                @if(Session::get('signincaptcha'))
                    <div class="form-group {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
                    {!! Recaptcha::render() !!}
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            {{ $errors->first('g-recaptcha-response') }}
                        </span>
                    @endif
                </div>
                @endif
                <div class="form-group checkbox">
                    <div class="checkbox check-success">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Zapamiętaj mnie</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block" @if (Setting::get('signin_disabled')) disabled @endif>Zaloguj się</button>
                </form>
                <hr>
                <a href="{{ route('auth.signup') }}" class="btn btn-primary btn-label pull-left"><i class="fa fa-user-circle-o"></i> Dołącz do nas już teraz!</a>
                <a href="{{ route('auth.password.forgot') }}" class="btn btn-label pull-right"><i class="fa fa-question-circle"></i> Nie pamiętasz hasła?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    $('#signinForm').formValidation({
        framework: 'bootstrap',
        icon: {
            required: 'glyphicon glyphicon-asterisk',
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                trigger: 'blur',
                validators: {
                    notEmpty: {
                        message: 'Pole nazwa widgetu jest wymagane'
                    },
                }
            },

            password: {
                trigger: 'blur',
                validators: {
                    notEmpty: {
                        message: 'Pole adres strony jest wymagane'
                    },
                }
            },
        }
    });

  });
</script>

@include('sweet::alert')
@endsection

@section('css')
<link href="{{ asset('assets/plugins/sweetAlert/sweetAlert.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="{{ asset('assets/plugins/sweetAlert/sweetAlert.min.js') }}" type="text/javascript"></script>
@endsection