@extends('layouts.base')

@section('title'){{ config('app.name') }} - Nowy widget Player @endsection

@section('content')
<div class="subheader">
  <div class="background-pattern"></div>
  <div class="background-color"></div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
  <div class="content">
    <span class="title"><i class="ion-play"></i> Nowy widget - <span class="subtitle">Player</span></span>
  </div>
</div>
</div>
</div>
<div class="content">
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
		<div class="grid simple m-b-120">
		<div class="grid-body no-padding">
		@include ('layouts.partials.notifications')
<div id="widget-locker-new">
	<div class="navbar">
	  <div class="navbar-inner">
	    <div class="container">
	<ul>
	  	<li><a href="#step-general" data-toggle="tab">Ustawienia ogólne</a></li>
		<li><a href="#step-appearance" data-toggle="tab">Ustawienia wyglądu</a></li>
		<li><a href="#step-player" data-toggle="tab">Ustawienia odtwarzacza</a></li>
		<li><a href="#step-payment" data-toggle="tab">Model płatności</a></li>
	</ul>
	 </div>
	  </div>
	</div>
	<form action="" method="POST">
	{{ csrf_field() }}
	<div class="tab-content">
	    <div class="tab-pane" id="step-general">
				<div class="form-group border{{ $errors->has('name') ? ' has-error' : '' }}">
				<label class="form-label">Nazwa widgetu <span class="help semi-bold">(Nazwa ułatwi Ci identyfikację leadów, widoczna wyłącznie dla Ciebie)</span></label>
					<div class="input-group transparent">
						<div class="input-group-addon"><i class="fa fa-edit"></i></div>
						<input type="text" class="form-control" id="name" name="name" placeholder="Nazwa widgetu" @if(old('name')) value="{{ old('name') }}" @endif>
					</div>
					@if ($errors->has('name'))
						<span class="help-block">
							{{ $errors->first('name') }}
						</span>
					@endif	
				</div>
								<div class="form-group border{{ $errors->has('redirect') ? ' has-error' : '' }}">
					<label class="form-label bold">Przekierowanie <span class="help semi-bold">(Przekierowanie po poprawnym dokonaniu płatności. <span class="bold">Pozostaw puste jeżeli chcesz wyłączyć przekierowanie!</span>)</span></label>
						<div class="input-group transparent">
							<div class="input-group-addon"><i class="fa fa-link"></i></div>
							<input type="url" class="form-control" id="redirect" name="redirect" pattern="https?://.+" placeholder="Przekierowanie" @if(old('redirect')) value="{{ old('redirect') }}" @endif>
						</div>
						@if ($errors->has('redirect'))
							<span class="help-block">
								{{ $errors->first('redirect') }}
							</span>
						@endif	
				</div>
	    </div>
	    	    <div class="tab-pane" id="step-appearance">

	    	    			<div class="form-group border{{ $errors->has('color-background') ? ' has-error' : '' }}" id="color-background">
						<label class="form-label bold">Kolor tła</label>
							<input type="text" class="form-control" data-plugin="minicolors" id="color-background-input" name="color-background" @if(old('color-background')) value="{{ old('color-background') }}" @else value="#000000" @endif>
						@if ($errors->has('color-background'))
							<span class="help-block">
								{{ $errors->first('color-background') }}
							</span>
						@endif	
						</div>
						<div class="form-group border{{ $errors->has('color-button') ? ' has-error' : '' }}" id="color-button">
						<label class="form-label bold">Kolor przycisku</label>
							<input type="text" class="form-control" data-plugin="minicolors" id="color-button-input" name="color-button" @if(old('text-button')) value="{{ old('color-button') }}" @else value="#4CAF50" @endif>
						@if ($errors->has('color-button'))
							<span class="help-block">
								{{ $errors->first('color-button') }}
							</span>
						@endif	
						</div>
						<div class="form-group border{{ $errors->has('text-intro') ? ' has-error' : '' }}">
						<label class="form-label bold">Treść zachęty</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="fa fa-edit"></i></div>
								<input type="text" class="form-control" id="text-intro" name="text-intro" placeholder="Treść zachęty" @if(old('text-intro')) value="{{ old('text-intro') }}" @else value="Dostęp zablokowany! Wykup premium." @endif>
							</div>
						@if ($errors->has('text-intro'))
							<span class="help-block">
								{{ $errors->first('text-intro') }}
							</span>
						@endif	
						</div>
						<div class="form-group border{{ $errors->has('text-button') ? ' has-error' : '' }}">
						<label class="form-label bold">Treść przycisku</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="fa fa-edit"></i></div>
								<input type="text" class="form-control" id="text-button" name="text-button" placeholder="Treść przycisku" @if(old('text-button')) value="{{ old('text-button') }}" @else value="Odblokuj" @endif>
							</div>
						@if ($errors->has('text-button'))
							<span class="help-block">
								{{ $errors->first('text-button') }}
							</span>
						@endif	
						</div>
												<div class="form-group border{{ $errors->has('auto-rule') ? ' has-error' : '' }}">
							<label class="form-label bold">Automatycznie zaakceptowany regulamin</label>
							<input type="checkbox" data-plugin="labelauty" data-labelauty="Nie|Tak" id="auto-rule" name="auto-rule" value="1">
							@if ($errors->has('auto-rule'))
								<span class="help-block">
									{{ $errors->first('auto-rule') }}
								</span>
							@endif
						</div>
	    </div>
	    	    <div class="tab-pane" id="step-player">

	    	    		<div class="form-group border">
				<label class="form-label bold">Adres URL okładki</label>
					<div class="input-group transparent">
					<div class="input-group-addon"><i class="fa fa-edit"></i></div>
					<input type="text" class="form-control" id="coverurl" name="coverurl" placeholder="Adres URL okładki - np. http://i.imgur.com/AtsZMnt.jpg">
					</div>
				</div>
				<div class="col-md-4">
												<div class="form-group border">
				<label class="form-label bold">Użyj gotowej okładki</label>
					<select class="form-control" id="coverdefault">
											<option value="0">Wybierz gotową okładkę</option>
				<option value="{{ url('/assets/img/widgets/player/posters/multikino.png') }}">Multikino</option>
							<option value="{{ url('/assets/img/widgets/player/posters/paramount.png') }}">Paramount</option>
						</select>
				</div>	
				</div>

				<div class="row">
				<div class="col-md-8">
												<div class="form-group">
				<label class="form-label bold">Adres URL zajawki <span class="help semi-bold">(wyłącznie format mp4 lub youtube)</span></label>
					<div class="input-group transparent">
					<div class="input-group-addon"><i class="fa fa-edit"></i></div>
					<input type="text" class="form-control" id="videourl" name="videourl" placeholder="Adres URL zajawki - np. https://youtu.be/7jLK6SXaW9M">
					</div>
				</div>	
				</div>	
				<div class="col-md-4">
												<div class="form-group">
				<label class="form-label bold">Użyj gotowej zajawki</label>
					<select class="form-control" id="videodefault">
							<option value="0">Wybierz gotowa zajawke</option>
							<option value="{{ url('/assets/video/widgets/player/multikino.mp4') }}">Multikino</option>
							<option value="{{ url('/assets/video/widgets/player/paramount.mp4') }}">Paramount</option>
						</select>
				</div>	
				</div>
				</div>
																<div class="form-group">
				<label class="form-label bold">Czas <span class="help semi-bold">(Ile sekund ma upłynąć do pojawienia się okna z płatnością. Ustaw <span class="bold">0</span> aby okno z płatnościa pojawiło się natychmiast)</span></label>
					<div class="input-group transparent">
					<div class="input-group-addon"><i class="fa fa-edit"></i></div>
					<input type="text" class="form-control" id="time" name="time" placeholder="Czas w sekundach - np. 60" value="5">
					</div>
				</div>
				<div class="row">
				<div class="col-md-3">
					<div class="form-group {{ $errors->has('auto-rule') ? ' has-error' : '' }}">
							<label class="form-label bold">Ikona +18</label>
							<input type="checkbox" data-plugin="labelauty" data-labelauty="Ukryta|Widoczna" id="adult" name="adult" value="1">
							@if ($errors->has('auto-rule'))
								<span class="help-block">
									{{ $errors->first('auto-rule') }}
								</span>
							@endif
						</div>
						</div>
						<div class="col-md-3">
						<div class="form-group {{ $errors->has('auto-rule') ? ' has-error' : '' }}">
							<label class="form-label bold">Autostart</label>
							<input type="checkbox" data-plugin="labelauty" data-labelauty="Nieaktywny|Aktywny" id="autostart" name="autostart" value="1">
							@if ($errors->has('auto-rule'))
								<span class="help-block">
									{{ $errors->first('auto-rule') }}
								</span>
							@endif
						</div>
						</div>
												<div class="col-md-3">
						<div class="form-group {{ $errors->has('auto-rule') ? ' has-error' : '' }}">
							<label class="form-label bold">Pasek sterowania</label>
							<input type="checkbox" data-plugin="labelauty" data-labelauty="Ukryty|Widoczny" id="controls" name="controls" value="1" checked>
							@if ($errors->has('auto-rule'))
								<span class="help-block">
									{{ $errors->first('auto-rule') }}
								</span>
							@endif
						</div>
						</div>
																		<div class="col-md-3">
						<div class="form-group {{ $errors->has('auto-rule') ? ' has-error' : '' }}">
							<label class="form-label bold">Pasek postępu</label>
							<input type="checkbox" data-plugin="labelauty" data-labelauty="Ukryty|Widoczny" id="progress" name="progress" value="1" checked>
							@if ($errors->has('auto-rule'))
								<span class="help-block">
									{{ $errors->first('auto-rule') }}
								</span>
							@endif
						</div>
						</div>
						<div class="col-md-12">
						<div class="alert alert-info"><i class="fa fa-info-circle"></i> Opcja <span class="bold">pasek postępu</span> będzie działać wyłącznie z aktywnym <span class="bold">paskiem sterowania</span>!</div>
						</div>
						</div>
						</div>

	    	    <div class="tab-pane" id="step-payment">
				<div class="form-group border{{ $errors->has('payment') ? ' has-error' : '' }}">
				<label class="form-label">Model płatności <span class="help semi-bold">(Możesz wybrać maksymalnie 3 modele płatności. Kolejność wyboru ma znaczenie)</span></label>
					<select class="form-control" id="payment" name="payment[]" multiple data-placeholder="Wybierz model płatności">
						@foreach ($mo as $mo)
							<option value="{{ $mo->id }}" data-type="{{ $mo->type }}" data-number="{{ $mo->number }}" data-message="{{ $mo->message }}">{{ $mo->name }} - Stawka: {{ Auth::user()->tier->rate($mo->rate,$mo->name) }} zł
							</option>
						@endforeach
							@foreach ($mt as $mt)
								<option value="{{ $mt->id }}" data-type="{{ $mt->type }}" data-number="{{ $mt->number }}" data-message="{{ $mt->message }}">{{ $mt->name }} - Stawka: {{ Auth::user()->tier->rate($mt->rate,$mt->name) }} zł
								</option>
							@endforeach
					</select>
				@if ($errors->has('payment'))
                    <span class="help-block">
                        {{ $errors->first('payment') }}
                    </span>
                 @endif
				</div>

	    </div>
	    </div>
	    <a class="btn btn-success btn-small m-t-25 m-l-25 m-b-25" id="refresh"><i class="fa fa-refresh m-r-5"></i> Odśwież podgląd</a>
						            <div class="player-widget">
            	  <video id="player" class="video-js vjs-16-9 vjs-big-play-centered vjs-default-skin vjs-big-play-button" poster="/assets/img/widgets/player/posters/paramount.png">
  <source src="/assets/video/widgets/player/paramount.mp4" type='video/mp4'>
  					</video>	
  <div class="adult-icon" style="display: none;"></div>
  <div class="content-locker-layer" style="display: none;"></div>
                    	<div class="content-locker" id="content-locker" style="display: none;">
            		<div class="intro-text" id="intro">
            			Dostęp zablokowany! Wykup premium.
            		</div>
	            	<div class="payment">
	            		<div class="instruction">
	            		<span id="text">Aby kontynuować wyślij SMS na numer</span><br>
	            			<div id="mo">
								<span class="bold" id="payment-number">92022</span> o treści <span class="bold" id="payment-message">ag.logowanie</span>
							</div>
	            		</div>
	            		<div class="code" id="code">
	            			<input type="text" class="form-control text-center" placeholder="Tutaj wprowadź otrzymany kod">
	            		</div>
	            	</div>
            		<div class="rule-text" style="display: none;">
            			Klikając w "Kontynuuj", oświadczam, że zapoznałem/am się z regulaminem i go akceptuję. (czytaj więcej)
            		</div>
            		<div class="rule-checkbox">
            		               <div class="form-group checkbox">
                        <div class="checkbox check-success">
                        <input type="checkbox" id="rule_accept" name="rule_accept">
                        <label for="rule_accept">Akceptuję postanowienia <a href="">regulaminu</a></label>
                    </div>
                </div>
            		</div>
                	<div class="action">
                		<a class="btn btn-success btn-block" id="button">Odblokuj</a>
                	</div>
            	</div>
            </div>
	    	            <div class="actionbar">
	            		<ul class="pager wizard">
			<li class="previous"><a class="btn btn-success" id="previous"><i class="fa fa-angle-double-left"></i> Wstecz</a></li>
		  	<li class="next"><a class="btn btn-success" id="next">Dalej <i class="fa fa-angle-double-right"></i></a></li>
		  	<li class="finish"><button type="submit" class="btn btn-success finish"><i class="fa fa-floppy-o"></i> Stwórz</button></li>
					</ul>
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
<link href="{{ asset('assets/plugins/jquery-checkbox/checkbox.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/plugins/color-picker/color-picker.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/plugins/videojs/videojs.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="http://vjs.zencdn.net/5.14.1/video.js"></script>
<script src="{{ asset('assets/plugins/choices/choices.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/color-picker/color-picker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-checkbox/checkbox.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-wizard/bootstrap.wizard.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	PlayerWidget.init();
});
</script>
	<script>
	$(document).ready(function() {
	  	$('#widget-locker-new').bootstrapWizard();
	});
	</script>
@endsection