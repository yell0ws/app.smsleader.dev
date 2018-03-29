@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - Wypłata środków @endsection

@section('content')
<div class="subheader tabs">
	<div class="background-pattern"></div>
	<div class="background-color"></div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
			<div class="content">
				<span class="title"><i class="ion-arrow-swap brown"></i> Wypłata <span class="subtitle">środków</span></span>
			</div>
			<div class="tabs">
				<a href="{{ route('payout.withdraw') }}" class="{{ Request::is('payouts/withdraw') ? 'active' : '' }}">Wypłata środków</a>
				<a href="{{ route('payout.history') }}" class="{{ Request::is('payouts/history') ? 'active' : '' }}">Historia wypłat</a>
			</div>
		</div>
	</div>
</div>
<div class="content">
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
		<div class="alert alert-info">
			<h4><i class="fa fa-info"></i> Informacje dotyczące wypłat!</h4>
			Maksymalny czas realizowania standardowej wypłaty to <span class="bold">7 dni</span>! Zazwyczaj wypłata realizowana jest w ciągu <span class="bold">24</span> godzin.
		</div>
		<div class="grid simple">
			<div class="grid-body no-padding">
			@include ('layouts.partials.notifications')
			<form action="{{route('payout.withdraw')}}" method="POST">
				{{ csrf_field() }}
				@if($withdrawBlock)
					<div class="form-group border">
						<div class="alert alert-danger no-margin">
							<i class="fa fa-warning"></i> Uzupełnij swój profil aby móc dokonywać wypłat! Możesz to zrobić w zakładce <span class="bold">Ustawienia konta > Dane osobowe</span>.
						</div>
					</div>
				@endif
				<div class="form-group border{{ $errors->has('amount') ? ' has-error' : '' }}">
				<label class="form-label bold">Kwota wypłaty</label>
					<div class="input-group transparent">
						<div class="input-group-addon"><i class="ion-cash"></i></div>
						<input type="text" class="form-control" id="amount" name="amount" placeholder="Kwota wypłaty" @if(Auth::user()->balance >= Setting::get('withdraw_standard_limit')) value="{{ Auth::user()->balance }}" @endif>
					</div>
					@if ($errors->has('amount'))
						<span class="help-block">
							{{ $errors->first('amount') }}
						</span>
					@endif
					@if(Auth::user()->balance < Setting::get('withdraw_standard_limit') and !$withdrawBlock) 
						<div class="alert alert-danger no-margin m-t-20">
							<i class="fa fa-warning"></i> Minimalna kwota wypłaty środków to <span class="bold">{{ Setting::get('withdraw_standard_limit') }} zł</span>. Twoje saldo pozwala na wypłatę <span class="bold">{{ Auth::user()->balance }} zł</span>.
						</div>
					@endif	
				</div>
				<div class="form-group border{{ $errors->has('priority') ? ' has-error' : '' }}">
					<label class="form-label bold">Priorytet wypłaty</label>
					<select class="form-control" id="priority" name="priority">
						<option value="standard">Standardowa (realizacja do 24 godzin)</option>
						@if(!Setting::get('withdraw_express_disabled'))<option value="express">Ekspresowa (realizacja do 2 godzin) - Pobrana zostanie opłata w wysokości {{ Setting::get('withdraw_express_provision') }}% od wypłacanej kwoty</option>@endif
					</select>
					@if ($errors->has('priority'))
						<span class="help-block">
							{{ $errors->first('priority') }}
						</span>
					@endif			
				</div>
				<div class="form-group border last{{ $errors->has('form') ? ' has-error' : '' }}">
				@if ((!Setting::get('withdraw_paypal_disabled') and Auth::user()->profile->paypal) or (Auth::user()->profile->bank_account and Auth::user()->profile->bank_name))
					<label class="form-label bold">Forma wypłaty</label>
						<select class="form-control" data-placeholder="Wybierz formę wypłaty środków" id="form" name="form">
							@if(Auth::user()->profile->bank_account)<option value="bank">Przelew bankowy</option>@endif
							@if(!Setting::get('withdraw_paypal_disabled') and Auth::user()->profile->paypal)<option value="paypal">Paypal</option>@endif
						</select>
						@if ($errors->has('form'))
							<span class="help-block">
								{{ $errors->first('form') }}
							</span>
						@endif	
				@else
					<div class="alert alert-danger no-margin">
						<i class="fa fa-warning"></i> Forma wypłaty nie została ustawiona! Przejdź do zakładki <span class="bold">Ustawienia konta > Ustawienia wypłaty</span> w celu zdefiniowania formy wypłaty.
					</div>
				@endif
				</div>
				<div class="grid-footer">
				<button type="submit" class="btn btn-success" @if((Auth::user()->balance < Setting::get('withdraw_standard_limit') or !Auth::user()->profile->paypal) and (Auth::user()->balance < Setting::get('withdraw_standard_limit') or !Auth::user()->profile->bank_account) or $withdrawBlock or Setting::get('withdraw_disabled')) disabled @endif><i class="fa fa-reply"></i> Zleć wypłatę</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
@include('sweet::alert')
@endsection

@section('css')
<link href="{{ asset('assets/plugins/sweetAlert/sweetAlert.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/plugins/choices/choices.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="{{ asset('assets/plugins/sweetAlert/sweetAlert.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/numberAnimate/animateNumber.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/choices/choices.min.js') }}" type="text/javascript"></script>
@endsection

@section('script')
Payout.init();
@endsection