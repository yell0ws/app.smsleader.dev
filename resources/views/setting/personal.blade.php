@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - Dane osobowe @endsection

@section('content')
<div class="subheader tabs">
	<div class="background-pattern"></div>
	<div class="background-color"></div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
	<div class="content">
		<span class="title"><i class="ion-person"></i> Dane <span class="subtitle">osobowe</span></span>
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
			<form action="{{ route('setting.personal') }}" method="POST">
				{{ csrf_field() }}
					<div class="form-group border{{ $errors->has('account_type') ? ' has-error' : '' }}">
						<label class="form-label">Rodzaj konta</label>
							<select class="form-control" id="account_type" name="account_type">
								<option value="private" @if(old('account_type') == 'private') selected @elseif(Auth::user()->profile->account_type == 'private') selected @endif>Konto prywatne</option>
								<option value="company" @if(old('account_type') == 'company') selected @elseif(Auth::user()->profile->account_type == 'company') selected @endif>Konto firmowe</option>
							</select>
						@if ($errors->has('account_type'))
		                    <span class="help-block">
		                        {{ $errors->first('account_type') }}
		                    </span>
		                @endif			
					</div>
					<div id="settings-company">
						<div class="form-group border{{ $errors->has('company_name') ? ' has-error' : '' }}">
							<label class="form-label">Nazwa firmy</label>
								<div class="input-group transparent">
									<div class="input-group-addon"><i class="ion-compose"></i></div>
									<input type="text" class="form-control" id="company_name" name="company_name" placeholder="Nazwa firmy" @if(old('company_name')) value="{{ old('company_name') }}" @else value="{{ Auth::user()->profile->company_name }}" @endif>
								</div>
						   @if ($errors->has('company_name'))
			                    <span class="help-block">
			                        {{ $errors->first('company_name') }}
			                    </span>
			                @endif	
						</div>
						<div class="form-group border{{ $errors->has('nip') ? ' has-error' : '' }}">
							<label class="form-label">NIP</label>
								<div class="input-group transparent">
									<div class="input-group-addon"><i class="ion-compose"></i></div>
									<input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" @if(old('nip')) value="{{ old('nip') }}" @else value="{{ Auth::user()->profile->nip }}" @endif>
								</div>
						   @if ($errors->has('nip'))
			                    <span class="help-block">
			                        {{ $errors->first('nip') }}
			                    </span>
			                @endif	
						</div>
					</div>
					<div class="form-group border{{ $errors->has('pesel') ? ' has-error' : '' }}">
						<label class="form-label">Pesel</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="ion-compose"></i></div>
								<input type="text" class="form-control" id="pesel" name="pesel" placeholder="Pesel" @if(old('pesel')) value="{{ old('pesel') }}" @else value="{{ Auth::user()->profile->pesel }}" @endif>
							</div>
					   @if ($errors->has('pesel'))
		                    <span class="help-block">
		                        {{ $errors->first('pesel') }}
		                    </span>
		                @endif	
					</div>
					<div class="form-group border{{ $errors->has('first_name') ? ' has-error' : '' }}">
						<label class="form-label">Imię</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="ion-compose"></i></div>
								<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Imię" @if(old('first_name')) value="{{ old('first_name') }}" @else value="{{ Auth::user()->profile->first_name }}" @endif>
							</div>
					   @if ($errors->has('first_name'))
		                    <span class="help-block">
		                        {{ $errors->first('first_name') }}
		                    </span>
		                @endif	
					</div>
					<div class="form-group border{{ $errors->has('last_name') ? ' has-error' : '' }}">
						<label class="form-label">Nazwisko</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="ion-compose"></i></div>
								<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nazwisko" @if(old('last_name')) value="{{ old('last_name') }}" @else value="{{ Auth::user()->profile->last_name }}" @endif>
							</div>
					   @if ($errors->has('last_name'))
		                    <span class="help-block">
		                        {{ $errors->first('last_name') }}
		                    </span>
		                @endif	
					</div>
					<div class="form-group border{{ $errors->has('address') ? ' has-error' : '' }}">
						<label class="form-label">Adres</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="ion-compose"></i></div>
								<input type="text" class="form-control" id="address" name="address" placeholder="Adres (ulica / numer budynku / mieszkania)" @if(old('address')) value="{{ old('address') }}" @else value="{{ Auth::user()->profile->address }}" @endif>
							</div>
					   @if ($errors->has('address'))
		                    <span class="help-block">
		                        {{ $errors->first('address') }}
		                    </span>
		                @endif	
					</div>
					<div class="form-group border{{ $errors->has('city') ? ' has-error' : '' }}">
						<label class="form-label">Miasto</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="ion-compose"></i></div>
								<input type="text" class="form-control" id="city" name="city" placeholder="Miasto" @if(old('city')) value="{{ old('city') }}" @else value="{{ Auth::user()->profile->city }}" @endif>
							</div>
					   @if ($errors->has('city'))
		                    <span class="help-block">
		                        {{ $errors->first('city') }}
		                    </span>
		                @endif	
					</div>
					<div class="form-group border last{{ $errors->has('zip_code') ? ' has-error' : '' }}">
						<label class="form-label">Kod pocztowy</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="ion-compose"></i></div>
								<input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Kod pocztowy" @if(old('zip_code')) value="{{ old('zip_code') }}" @else value="{{ Auth::user()->profile->zip_code }}" @endif>
							</div>
					   @if ($errors->has('zip_code'))
		                    <span class="help-block">
		                        {{ $errors->first('zip_code') }}
		                    </span>
		                @endif	
					</div>
					<div class="grid-footer">
					<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Zapisz dane osobowe</button>
					</div>
	        </form>
			</div>
		</div>
	</div>
</div>
</div>
@endsection

@section('css')
<link href="{{ asset('assets/plugins/choices/choices.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="{{ asset('assets/plugins/choices/choices.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-inputmask/jquery.inputmask.min.js') }}" type="text/javascript"></script>
@endsection

@section('script')
Setting.init();
@endsection