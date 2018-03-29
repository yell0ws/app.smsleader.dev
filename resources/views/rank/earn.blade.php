@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - Ranking użytkowników - {{ $time }} @endsection

@section('content')
<div class="subheader tabs">
	<div class="background-pattern"></div>
	<div class="background-color"></div>
	<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
	<div class="content">
		<span class="title"><i class="ion-trophy"></i> Ranking <span class="subtitle">użytkowników</span></span>
	</div>
	<div class="tabs">
		<a href="{{ route('rank.today') }}" class="{{ Request::is('top/today') ? 'active' : '' }}">Dzisiaj</a>
		<a href="{{ route('rank.yesterday') }}" class="{{ Request::is('top/yesterday') ? 'active' : '' }}">Wczoraj</a>
		<a href="{{ route('rank.week') }}" class="{{ Request::is('top/week') ? 'active' : '' }}">Ostatnie 7 dni</a>
		<a href="{{ route('rank.month') }}" class="{{ Request::is('top/month') ? 'active' : '' }}">Ostatnie 30 dni</a>
		<a href="{{ route('rank.all') }}" class="{{ Request::is('top/all') ? 'active' : '' }}">Od początku</a>
	</div>
</div>
</div>
</div>
<div class="content">
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
		<div class="grid simple">
		<div class="grid-body no-padding">
	        <table class="table no-margin">
	        <thead>
	          	          <tr>
	          	<th class="text-center" style="width:25%">Miejsce</th>
	            <th class="text-center" style="width:37%">Nazwa użytkownika</th>
	            <th class="text-center" style="width:37%">Zarobek</th>
	          </tr>
	        </thead>
	        <tbody>
	        @if (count($users) === 0)
	        <tr><td class="text-center" colspan="6">Lista rankingowa jest pusta!</td></tr>
	        @else
	        @php ($i = 1)
	        @foreach ($users as $user)
	        <tr>
	          	<td class="text-center"><span class="label">{{ $i++ }}</span></td>
	            <td class="text-center">@if($user->rank_view == 'show') {{ $user->username }} @else Anonimowy @endif</td>
	            <td class="text-center"><span class="label label-success">{{ $user->sumamount }} zł</span></td>
	        </tr>
			@endforeach
			@endif
	        </tbody>
	      </table>
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