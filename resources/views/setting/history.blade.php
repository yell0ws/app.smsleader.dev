@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - Historia aktywności @endsection

@section('content')
<div class="subheader tabs">
	<div class="background-pattern"></div>
	<div class="background-color"></div>
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
		<div class="content">
			<span class="title"><i class="ion-navicon-round"></i> Historia <span class="subtitle">aktywności</span></span>
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
		<div class="panel-table">
		<div class="panel-head withdraw">
		<ul>
		<li>Data</li>
		<li>Data</li>
		<li>Data</li>
		</ul>
		</div>
		<div class="panel-list">
				<div class="panel-list">
		<div class="amount">{{ $withdraw->amount }} PLN</div>
		</div>
				<div class="panel-list">
		ewdwedew
		</div>
				<div class="panel-list">
		ewdwedew
		</div>

		</div>
		{{ $logs->links() }}
				</div>
		</div>
	</div>
</div>
@endsection

@section('css')
@endsection

@section('js')
@endsection