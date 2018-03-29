@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - Lista poleconych @endsection

@section('content')
<div class="subheader tabs">
	<div class="background-pattern"></div>
	<div class="background-color"></div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
	<div class="content">
		<span class="title"><i class="ion-person-stalker"></i> Poleceni</span>
	</div>
	<div class="tabs">
		<a href="{{ route('referral.list') }}" class="{{ Request::is('referrals/list') ? 'active' : '' }}">Lista poleconych</a>
		<a href="{{ route('support.faq') }}" class="{{ Request::is('support/faq') ? 'active' : '' }}">Materiały</a>
	</div>
</div>
</div>
</div>
<div class="content">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
<div class="row">
<div class="col-md-4 m-b-30">
	<div class="tiles green">
		<div class="tiles-body">
			<i class="fa fa-trophy icon-bg"></i>
			<div class="tiles-title"> Twoi poleceni zarobili</div>
			<div class="heading">
				<span class="animate-number" data-value="{{ $sumReferralsAmount }}" data-animation-duration="1000">0.00</span> zł 
			</div>
		</div>
	</div>
</div>
<div class="col-md-4 m-b-30">
	<div class="tiles red">
		<div class="tiles-body">
			<i class="fa fa-line-chart icon-bg"></i>
			<div class="tiles-title"> Liczba poleconych</div>
			<div class="heading">
				<span class="animate-number" data-value="{{ $referralsCount }}" data-animation-duration="1000">0</span>
			</div>
		</div>
	</div>
</div>
<div class="col-md-4 m-b-30">
	<div class="tiles blue">
		<div class="tiles-body">
			<i class="fa fa-usd icon-bg"></i>
			<div class="tiles-title">Aktualna prowizja</div>
			<div class="heading"> 
				<span class="animate-number" data-value="{{ Auth::user()->referral_provision }}" data-animation-duration="1000">0</span> %
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
		<div class="grid simple">
		<div class="grid-body no-padding">
	        <table class="table no-margin">
	        <thead>
	          	          <tr>
	            <th class="text-center" style="width:15%">Nazwa użytkownika</th>
	            <th class="text-center" style="width:15%">Data rejestracji</th>
	            <th class="text-center" style="width:15%">Zarobek</th>
	          </tr>
	        </thead>
	        <tbody>
	       	@if (count($referrals) === 0)
	        <tr><td class="text-center" colspan="6">Twoja lista poleconych jest pusta!</td></tr>
	        @else
	        @foreach ($referrals as $referral)
	        <tr>
	          	<td class="text-center">{{ $referral->username }}</td>
	          	<td class="text-center">{{ $referral->created_at }}</td>
	            <td class="text-center">{{ $referral->sumamount }} zł</td>
	        </tr>
			@endforeach
			@endif
	        </tbody>
	      </table>
	      {{ $referrals->links() }}
		</div>
		</div>
	</div>
</div>
</div>
@endsection

@section('css')
@endsection

@section('js')
<script src="{{ asset('assets/plugins/numberAnimate/animateNumber.min.js') }}" type="text/javascript"></script>
@endsection