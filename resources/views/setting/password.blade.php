@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - Zmiana hasła @endsection

@section('content')
<div class="subheader tabs">
	<div class="background-pattern"></div>
	<div class="background-color"></div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
	<div class="content">
		<span class="title"><i class="ion-locked"></i> Zmiana <span class="subtitle">hasła</span></span>
	</div>
	<div class="tabs">
		<a href="{{ route('setting.account') }}" class="{{ Request::is('settings/account') ? 'active' : '' }}">Ustawienia konta</a>
		<a href="{{ route('setting.personal') }}" class="{{ Request::is('settings/personal') ? 'active' : '' }}">Dane osobowe</a>
		<a href="{{ route('setting.password') }}" class="{{ Request::is('settings/password') ? 'active' : '' }}">Zmiana hasła</a>
		<a href="{{ route('setting.payout') }}" class="{{ Request::is('settings/payout') ? 'active' : '' }}">Ustawienia wypłat</a>
		<a href="{{ route('setting.history') }}" class="{{ Request::is('settings/history') ? 'active' : '' }}">Historia aktywności</a>
	</div>
</div>
</div>
</div>
<div class="content">
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
		<div class="grid simple">
		<div class="grid-body no-padding">
		@include ('layouts.partials.notifications')   
		<form action="{{ route('setting.password') }}" method="POST">
		{{ csrf_field() }}
				<div class="form-group border{{ $errors->has('old_password') ? ' has-error' : '' }}">
				<label class="form-label">Aktualne hasło</label>
					<div class="input-group transparent">
						<div class="input-group-addon"><i class="fa fa-lock"></i></div>
						<input type="password" class="form-control" id="old_password" name="old_password" placeholder="Aktualne hasło">
					</div>
			    @if ($errors->has('old_password'))
                    <span class="help-block">
                        {{ $errors->first('old_password') }}
                    </span>
                @endif	
				</div>
				<div class="form-group border{{ $errors->has('new_password') ? ' has-error' : '' }}">
				<label class="form-label">Nowe hasło</label>
					<div class="input-group transparent">
						<div class="input-group-addon"><i class="fa fa-lock"></i></div>
						<input type="password" class="form-control" id="new_password" name="new_password" placeholder="Nowe hasło">
					</div>
			   @if ($errors->has('new_password'))
                    <span class="help-block">
                        {{ $errors->first('new_password') }}
                    </span>
                @endif	
				</div>
				<div class="form-group border last{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
				<label class="form-label">Powtórz nowe hasło</label>
					<div class="input-group transparent">
						<div class="input-group-addon"><i class="fa fa-lock"></i></div>
						<input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Powtórz nowe hasło">
					</div>
			   @if ($errors->has('new_password_confirmation'))
                    <span class="help-block">
                        {{ $errors->first('new_password_confirmation') }}
                    </span>
                @endif	
				</div>
				<div class="grid-footer">
				<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Zmień hasło</button>
				</div>
        </form>
		</div>
		</div>
	</div>
</div>
</div>
@endsection

@section('css')
@endsection

@section('js')
@endsection