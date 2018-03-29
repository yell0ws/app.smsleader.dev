@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - Ustawienia konta @endsection

@section('content')
<div class="subheader tabs">
	<div class="background-pattern"></div>
	<div class="background-color"></div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
			<div class="content">
				<span class="title"><i class="ion-gear-b"></i> Ustawienia <span class="subtitle">konta</span></span>
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
				<form action="{{ route('setting.account') }}" method="POST">
					{{ csrf_field() }}
					<div class="form-group border{{ $errors->has('lead_sound') ? ' has-error' : '' }}">
						<label class="form-label">Powiadomienie dźwiękowe</label>
							<select class="form-control" id="lead_sound" name="lead_sound">
								<option value="0" @if(old('lead_sound') == 0) selected @elseif(Auth::user()->profile->lead_sound == 0) selected @endif>Wyłącz</option>
								<option value="1" @if(old('lead_sound') == 1) selected @elseif(Auth::user()->profile->lead_sound == 1) selected @endif>Gang albani: Z nieba leci hajs</option>
								<option value="2" @if(old('lead_sound') == 2) selected @elseif(Auth::user()->profile->lead_sound == 2) selected @endif>Popek: Raz na jakiś czas</option>
								<option value="3" @if(old('lead_sound') == 3) selected @elseif(Auth::user()->profile->lead_sound == 3) selected @endif>Abba: Money money money</option>
								<option value="4" @if(old('lead_sound') == 4) selected @elseif(Auth::user()->profile->lead_sound == 4) selected @endif>Sobota - Jeszcze będzie hajs</option>
								<option value="5" @if(old('lead_sound') == 5) selected @elseif(Auth::user()->profile->lead_sound == 5) selected @endif>TEDE - Ziomuś potwierdzam przelew</option>
								<option value="6" @if(old('lead_sound') == 6) selected @elseif(Auth::user()->profile->lead_sound == 6) selected @endif>Aloe Blacc - I Need A Dollar</option>
								<option value="7" @if(old('lead_sound') == 7) selected @elseif(Auth::user()->profile->lead_sound == 7) selected @endif>BAS Tajpan - Hajs</option>
								<option value="8" @if(old('lead_sound') == 8) selected @elseif(Auth::user()->profile->lead_sound == 8) selected @endif>Cash</option>
								<option value="9" @if(old('lead_sound') == 9) selected @elseif(Auth::user()->profile->lead_sound == 9) selected @endif>Snoop Dogg - Money Money Money</option>
							</select>
							<audio id="lead_sound_player" style="display: none;"></audio>
					   @if ($errors->has('lead_sound'))
			                <span class="help-block">
			                    {{ $errors->first('lead_sound') }}
			                </span>
			            @endif	
					</div>
					<div class="form-group border{{ $errors->has('rank_view') ? ' has-error' : '' }}">
						<label class="form-label">Widoczność w rankingu</label>
							<select class="form-control" id="rank_view" name="rank_view">
								<option value="show" @if(old('rank_view') == 'show') selected @elseif(Auth::user()->profile->rank_view == 'show') selected @endif>Pokazuj mnie jawnie</option>
							</select>
					   @if ($errors->has('rank_view'))
			                <span class="help-block">
			                    {{ $errors->first('rank_view') }}
			                </span>
			            @endif	
					</div>
					<div class="form-group border{{ $errors->has('chat_view') ? ' has-error' : '' }}">
						<label class="form-label">Widoczność na komunikatorze</label>
							<select class="form-control" id="chat_view" name="chat_view">
								<option value="show" @if(old('chat_view') == 'show') selected @elseif(Auth::user()->profile->chat_view == 'show') selected @endif>Pokazuj moją obecność</option>
								<option value="hide" @if(old('chat_view') == 'hide') selected @elseif(Auth::user()->profile->chat_view == 'hide') selected @endif>Ukryj moją obecność</option>
							</select>
					   @if ($errors->has('chat_view'))
			                <span class="help-block">
			                    {{ $errors->first('chat_view') }}
			                </span>
			            @endif	
					</div>
					<div class="form-group border last{{ $errors->has('gg_number') ? ' has-error' : '' }}">
						<div class="alert alert-info no-margin m-b-20 m-t-5">
							<ol class="no-margin p-l-20 p-r-20">
								<li>Wprowadź swój numer Gadu-Gadu poniżej.</li>
								<li>Dodaj numer naszego BOTA: <span class="bold">777487</span> do listy kontaktów!</li>
								<li>Wyślij dowolną wiadomość na numer naszego BOTA!</li>
							</ol>
						</div>
						<label class="form-label">Powiadomienia Gadu-Gadu</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="fa fa-comments-o"></i></div>
								<input type="text" class="form-control" id="gg_number" name="gg_number" placeholder="Numer Gadu-Gadu" @if(old('gg_number')) value="{{ old('gg_number') }}" @else value="{{ Auth::user()->profile->gg_number }}" @endif>
							</div>
					   @if ($errors->has('gg_number'))
			                <span class="help-block">
			                    {{ $errors->first('gg_number') }}
			                </span>
			            @endif
					</div>
					<div class="grid-footer">
						<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Zapisz ustawienia konta</button>
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
@endsection

@section('script')
Setting.init();
@endsection