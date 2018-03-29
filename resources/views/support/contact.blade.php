@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - Kontakt @endsection

@section('content')
<div class="subheader tabs">
	<div class="background-pattern"></div>
	<div class="background-color"></div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
	<div class="content">
		<span class="title"><i class="ion-paper-airplane"></i> Kontakt</span>
	</div>
	<div class="tabs">
		<a href="{{ route('support.contact') }}" class="{{ Request::is('support/contact') ? 'active' : '' }}">Formularz kontaktowy</a>
		<a href="{{ route('support.faq') }}" class="{{ Request::is('support/faq') ? 'active' : '' }}">Centrum pomocy</a>
	</div>
</div>
</div>
</div>
<div class="content">
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
		<div class="alert alert-info">
			<h4><i class="fa fa-envelope-o"></i> Kontakt za pomocą poczty</h4>
			<span class="bold">Dział ogólny</span> - {{ Setting::get('support_mail_global') }} - <i>(Bieżące sprawy, pytania odnośnie stawek, propozycje nowych programów, własne programy)</i><br>
			<span class="bold">Dział techniczny</span> - {{ Setting::get('support_mail_technical') }} - <i>(Wszelkiego rodzaju błędy dotyczące panelu oraz poszczególnych programów, widgetów)</i><br>
			<span class="bold">Dział finansowy</span> - {{ Setting::get('support_mail_finance') }} - <i>(Wszelkie sprawy związane z finansami, rozliczeniami)</i>
		</div>
		<div class="grid simple">
					<div class="grid-body no-padding">
				@include ('layouts.partials.notifications')
				<form action="{{ route('support.contact') }}" method="POST">
				{{ csrf_field() }}
					<div class="form-group border{{ $errors->has('section') ? ' has-error' : '' }}">
					<label class="form-label">Dział</label>
						<select class="form-control chosen-select" id="section" name="section">
							<option value="global">Ogólny</option>
							<option value="technical">Techniczny</option>
							<option value="finance">Finanse</option>
						</select>
						@if ($errors->has('section'))
							<span class="help-block">
								{{ $errors->first('section') }}
							</span>
						@endif			
					</div>
					<div class="form-group border{{ $errors->has('title') ? ' has-error' : '' }}">
					<label class="form-label">Tytuł wiadomości</label>
						<div class="input-group transparent">
							<div class="input-group-addon"><i class="ion-compose"></i></div>
							<input type="text" class="form-control" id="title" name="title" placeholder="Tytuł wiadomości" @if(old('title')) value="{{ old('title') }}" @endif>
						</div>
						@if ($errors->has('title'))
							<span class="help-block">
								{{ $errors->first('title') }}
							</span>
						@endif	
					</div>
					<div class="form-group border last{{ $errors->has('messages') ? ' has-error' : '' }}">
					<label class="form-label">Treść wiadomości</label>
						<textarea class="form-control" rows="12" id="messages" name="messages" placeholder="Treść wiadomości">@if(old('messages')){{ old('messages') }}@endif</textarea>
						@if ($errors->has('messages'))
							<span class="help-block">
								{{ $errors->first('messages') }}
							</span>
						@endif	
					</div>
					<div class="grid-footer">
				<button type="submit" class="btn btn-success">Wyślij wiadomość</button>
				</div>
				</form>
		</div>
		</div>
	</div>
</div>
@endsection

@section('css')
<link href="{{ asset('assets/plugins/choices/choices.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/plugins/trumbowyg/ui/trumbowyg.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="{{ asset('assets/plugins/trumbowyg/trumbowyg.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/trumbowyg/langs/pl.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/choices/choices.min.js') }}" type="text/javascript"></script>
@endsection

@section('script')
Support.init();
@endsection