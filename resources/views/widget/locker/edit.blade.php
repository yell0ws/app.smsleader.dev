@extends('layouts.base')

@section('title'){{ config('app.name') }} - Nowy widget Content Locker @endsection

@section('content')
<div class="page-title">
	<h3><i class="fa fa-pencil-square-o"></i> Edytuj - <span class="semi-bold">{{ $locker->name }}</span></h3>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="grid simple vertical green">
		<div class="grid-body">
		@include ('layouts.partials.notifications')
		<form action="" method="POST">
		{{ csrf_field() }}

		<div class="row">
		<div class="col-md-6">
		<h4 class="p-t-10"><i class="fa fa-cogs m-r-5"></i> Ustawienia ogólne</h4>
		<hr>
			<div class="well">
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label class="form-label">Nazwa widgetu <span class="help semi-bold">(Nazwa ułatwi Ci identyfikację leadów, widoczna wyłącznie dla Ciebie)</span></label>
					<div class="input-group transparent">
						<div class="input-group-addon"><i class="fa fa-edit"></i></div>
						<input type="text" class="form-control" id="name" name="name" placeholder="Nazwa widgetu" @if(old('name')) value="{{ old('name') }}" @else value="{{ $locker->name }}" @endif>
					</div>
					@if ($errors->has('name'))
						<span class="help-block">
							{{ $errors->first('name') }}
						</span>
					@endif	
				</div>
				<div class="form-group{{ $errors->has('domain') ? ' has-error' : '' }}">
				<label class="form-label">Nazwa domeny <span class="help semi-bold">(Wprowadź nazwę domeny na której zamieścisz widget)</span></label>
					<div class="input-group transparent">
						<div class="input-group-addon"><i class="fa fa-edit"></i></div>
						<input type="text" class="form-control" id="domain" name="domain" placeholder="Nazwa domeny" @if(old('domain')) value="{{ old('domain') }}" @else value="{{ $locker->domain }}" @endif>
					</div>
					@if ($errors->has('domain'))
						<span class="help-block">
							{{ $errors->first('domain') }}
						</span>
					@endif	
				</div>
				<div class="alert alert-info"><i class="fa fa-info-circle"></i> Nazwa domeny jest nam potrzebna do celów weryfikacyjnych.</div>

				<div class="form-group{{ $errors->has('payment') ? ' has-error' : '' }}">
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
				<div class="form-group{{ $errors->has('redirect') ? ' has-error' : '' }}">
					<label class="form-label bold">Przekierowanie <span class="help semi-bold">(Przekierowanie po poprawnym dokonaniu płatności. <span class="bold">Pozostaw puste jeżeli chcesz wyłączyć przekierowanie!</span>)</span></label>
						<div class="input-group transparent">
							<div class="input-group-addon"><i class="fa fa-link"></i></div>
							<input type="url" class="form-control" id="redirect" name="redirect" placeholder="Przekierowanie" @if(old('redirect')) value="{{ old('redirect') }}" @else value="{{ $locker->redirect }}" @endif>
						</div>
						@if ($errors->has('redirect'))
							<span class="help-block">
								{{ $errors->first('redirect') }}
							</span>
						@endif	
				</div>
			</div>
			</div>
			<div class="col-md-6">
							<h4 class="p-t-10"><i class="fa fa-eyedropper m-r-5"></i> Ustawienia wyglądu</h4>
			<hr>
			<div class="well">
						<div class="form-group{{ $errors->has('color_background') ? ' has-error' : '' }}">
						<label class="form-label bold">Kolor tła</label>
							<input type="text" class="form-control" data-plugin="minicolors" id="color-background-input" name="color_background" @if(old('color_background')) value="{{ old('color_background') }}" @else value="#{{ $locker->color_background }}" @endif>
						@if ($errors->has('color_background'))
							<span class="help-block">
								{{ $errors->first('color_background') }}
							</span>
						@endif	
						</div>
						<div class="form-group m-t-20 {{ $errors->has('color_button') ? ' has-error' : '' }}">
						<label class="form-label bold">Kolor przycisku</label>
							<input type="text" class="form-control" data-plugin="minicolors" id="color-button-input" name="color_button" @if(old('color_button')) value="{{ old('color_button') }}" @else value="#{{ $locker->color_button }}" @endif>
						@if ($errors->has('color_button'))
							<span class="help-block">
								{{ $errors->first('color_button') }}
							</span>
						@endif	
						</div>
						<div class="form-group{{ $errors->has('text_intro') ? ' has-error' : '' }}">
						<label class="form-label bold">Treść zachęty</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="fa fa-edit"></i></div>
								<input type="text" class="form-control" id="text-intro" name="text_intro" placeholder="Treść zachęty" @if(old('text_intro')) value="{{ old('text_intro') }}" @else value="{{ $locker->text_intro }}" @endif>
							</div>
						@if ($errors->has('text_intro'))
							<span class="help-block">
								{{ $errors->first('text_intro') }}
							</span>
						@endif	
						</div>
						<div class="form-group{{ $errors->has('text_button') ? ' has-error' : '' }}">
						<label class="form-label bold">Treść przycisku</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="fa fa-edit"></i></div>
								<input type="text" class="form-control" id="text-button" name="text_button" placeholder="Treść przycisku" @if(old('text_button')) value="{{ old('text_button') }}" @else value="{{ $locker->text_button }}" @endif>
							</div>
						@if ($errors->has('text_button'))
							<span class="help-block">
								{{ $errors->first('text_button') }}
							</span>
						@endif	
						</div>
												<div class="form-group {{ $errors->has('auto_rule') ? ' has-error' : '' }}">
							<label class="form-label bold">Automatycznie zaakceptowany regulamin</label>
							<input type="checkbox" data-plugin="labelauty" data-labelauty="Nie|Tak" id="auto-rule" name="auto_rule" @if(old('auto_rule')) checked @elseif($locker->auto_rule) checked @endif>
							@if ($errors->has('auto_rule'))
								<span class="help-block">
									{{ $errors->first('auto_rule') }}
								</span>
							@endif
						</div>
			</div>
            </div>
            			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
			            <h4 class="p-t-10"><i class="fa fa-eye m-r-5"></i> Szybki podgląd</h4>
			<hr>
            <div class="content-locker-background m-b-30">
            <div class="content-locker-layer"></div>
            	<div class="content-locker" id="content-locker">
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
			</div>
            </div>
			<button type="submit" class="btn btn-success btn-block">Zapisz</button>
        </form>
		</div>
		</div>
	</div>
</div>
@endsection

@section('css')
<link href="{{ asset('assets/plugins/select/select.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/plugins/jquery-checkbox/checkbox.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/plugins/color-picker/color-picker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="{{ asset('assets/plugins/select/select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/color-picker/color-picker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-checkbox/checkbox.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {

	Widget.init();

	$("#payment").change(function() {
		var mode = [];
  		var payment_1;
  		var payment_2; 
  		var payment_3;

  		var service = [];
  		var n = 0;
  				$("ul.chosen-results li.result-selected").each(function() {
  					var item = service.push($(this).data('option-array-index'))
	 		console.log(item);
		});


		if (mode[0]) {
			if (mode[0]['type'] == 'mt'){
				$("#content-locker #mo").hide();
				$('#code input').attr("placeholder", "Wpisz swój numer telefonu...");
				$("#content-locker #text").text('Aby kontynuować wprowadź swój numer telefonu');
			}else if(mode[0]['type'] == 'mo'){
				$("#content-locker #mo").show();
				$("#content-locker #mt").hide();
				$("#content-locker #mo #payment-number").text(mode[0]['number']);
				$("#content-locker #mo #payment-message").text(mode[0]['message']);
				$("#content-locker #text").text('Aby kontynuować wyślij SMS na numer');
				$('#code input').attr("placeholder", "Tutaj wprowadź otrzymany kod");
			}
		}else{
			$("#content-locker #mo").show();
			$("#content-locker #mt").hide();
			$("#content-locker #mo #payment-number").text('92550');
			$("#content-locker #mo #payment-message").text('ZGARNIJ');
			$("#content-locker #text").text('Aby kontynuować wyślij SMS na numer');
			$('#code input').attr("placeholder", "Tutaj wprowadź otrzymany kod");
		}
	});
});

</script>
@endsection