@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - Ustawienia wypłat @endsection

@section('content')
<div class="subheader tabs">
	<div class="background-pattern"></div>
	<div class="background-color"></div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
	<div class="content">
		<span class="title"><i class="ion-reply"></i> Ustawienia <span class="subtitle">wypłat</span></span>
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
			<form action="{{ route('setting.payout') }}" method="POST">
			{{ csrf_field() }}
					<div class="form-group border{{ $errors->has('bank_name') ? ' has-error' : '' }}">
					<label class="form-label">Nazwa banku</label>
						<div class="input-group transparent">
							<div class="input-group-addon"><i class="fa fa-university"></i></div>
							<input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Nazwa banku" @if(old('bank_name')) value="{{ old('bank_name') }}" @else value="{{ Auth::user()->profile->bank_name }}" @endif>
						</div>
					   @if ($errors->has('bank_name'))
		                    <span class="help-block">
		                        {{ $errors->first('bank_name') }}
		                    </span>
		                @endif	
					</div>
					<div class="form-group border @if(Setting::get('withdraw_paypal_disabled')) last @endif {{ $errors->has('bank_account') ? ' has-error' : '' }}">
					<label class="form-label">Numer konta bankowego</label>
						<div class="input-group transparent">
							<div class="input-group-addon"><i class="fa fa-university"></i></div>
							<input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="Numer konta bankowego" @if(old('bank_account')) value="{{ old('bank_account') }}" @else value="{{ Auth::user()->profile->bank_account }}" @endif>
						</div>
					   @if ($errors->has('bank_account'))
		                    <span class="help-block">
		                        {{ $errors->first('bank_account') }}
		                    </span>
		                @endif	
					</div>
					@if(!Setting::get('withdraw_paypal_disabled'))
						<div class="form-group border last{{ $errors->has('paypal') ? ' has-error' : '' }}">
						<label class="form-label">Identyfikator Paypal</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="fa fa-paypal"></i></div>
								<input type="text" class="form-control" id="paypal" name="paypal" placeholder="Identyfikator Paypal" @if(old('paypal')) value="{{ old('paypal') }}" @else value="{{ Auth::user()->profile->paypal }}" @endif>
							</div>
						   @if ($errors->has('paypal'))
			                    <span class="help-block">
			                        {{ $errors->first('paypal') }}
			                    </span>
			                @endif	
						</div>
					@endif
					<div class="grid-footer">
					<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Zapisz ustawienia wypłat</button>
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
<script src="{{ asset('assets/plugins/jquery-inputmask/jquery.inputmask.min.js') }}" type="text/javascript"></script>
@endsection

@section('script')
Setting.init();
@endsection