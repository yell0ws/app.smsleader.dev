@extends('layouts.base')

@section('title'){{ config('app.name') }} - Nowy widget - Content Locker @endsection

@section('content')
<div class="subheader">
	<div class="background-pattern"></div>
	<div class="background-color"></div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
			<div class="content">
				<span class="title"><i class="ion-unlocked"></i> Nowy widget - <span class="subtitle">Content Locker</span></span>
			</div>
		</div>
	</div>
</div>
<div class="content">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
		@include ('layouts.partials.notifications')
			<div class="grid simple m-b-120">
				<div class="grid-body no-padding">
				<div id="WidgetLockerWizard">
				<div class="navbar">
					<div class="navbar-inner">
						<ul>
							<li><a href="#step-general" data-toggle="tab"><span class="step">1</span> Ustawienia ogólne</a></li>
							<li><a href="#step-appearance" data-toggle="tab"><span class="step">2</span> Ustawienia wyglądu</a></li>
							<li><a href="#step-payment" data-toggle="tab"><span class="step">3</span> Model płatności</a></li>
						</ul>
					</div>
				</div>

				<form method="POST" id="WidgetLockerForm">
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

						<div class="form-group border{{ $errors->has('domain') ? ' has-error' : '' }}">
							<label class="form-label">Adres strony <span class="help semi-bold">(Wprowadź adres strony na której zamieścisz widget)</span></label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="fa fa-edit"></i></div>
								<input type="url" class="form-control" id="domain" name="domain" placeholder="Adres strony" @if(old('domain')) value="{{ old('domain') }}" @endif>
							</div>
							@if ($errors->has('domain'))
								<span class="help-block">
									{{ $errors->first('domain') }}
								</span>
							@endif	
						</div>

						<div class="form-group border{{ $errors->has('redirect') ? ' has-error' : '' }}">
							<label class="form-label">Adres przekierowania <span class="help semi-bold">(Pozostaw puste jeżeli chcesz wyłączyć przekierowanie)</span></label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="fa fa-link"></i></div>
								<input type="url" class="form-control" id="redirect" name="redirect" placeholder="Adres przekierowania" @if(old('redirect')) value="{{ old('redirect') }}" @endif>
							</div>
							@if ($errors->has('redirect'))
								<span class="help-block">
									{{ $errors->first('redirect') }}
								</span>
							@endif	
						</div>
					</div>

				    <div class="tab-pane" id="step-appearance">
				    <div class="group-border">
				    <div class="row">
				    <div class="col-md-6">
				    		<div class="form-group{{ $errors->has('color_background') ? ' has-error' : '' }}">
							<label class="form-label"><span class="label">Content locker</span> Kolor tła</label>
							<input type="text" class="form-control" data-plugin="minicolors" id="lockerBackgroundColor" name="lockerBackgroundColor" @if(old('color-background')) value="{{ old('color_background') }}" @else value="#000000" @endif>
							@if ($errors->has('color_background'))
								<span class="help-block">
									{{ $errors->first('color_background') }}
								</span>
							@endif	
						</div>
						</div>
						<div class="col-md-6">
											<div class="form-group{{ $errors->has('color_background') ? ' has-error' : '' }}">
							<label class="form-label"><span class="label">Content locker</span> Kolor czcionki</label>
							<input type="text" class="form-control" data-plugin="minicolors" id="boxFontColor" name="lockerFontColor" @if(old('color-background')) value="{{ old('color_background') }}" @else value="#5F5F5F" @endif>
							@if ($errors->has('color_background'))
								<span class="help-block">
									{{ $errors->first('color_background') }}
								</span>
							@endif	
						</div>
						</div>
						</div>
						</div>
				    <div class="group-border">
				    <div class="row">
				    <div class="col-md-6">
				    		<div class="form-group{{ $errors->has('color_background') ? ' has-error' : '' }}">
							<label class="form-label"><span class="label">Pole tekstowe</span> Kolor tła</label>
							<input type="text" class="form-control" data-plugin="minicolors" id="filedBackgroundColor" name="filedBackgroundColor" @if(old('color-background')) value="{{ old('color_background') }}" @else value="#000000" @endif>
							@if ($errors->has('color_background'))
								<span class="help-block">
									{{ $errors->first('color_background') }}
								</span>
							@endif	
						</div>
						</div>
						<div class="col-md-6">
						<div class="form-group{{ $errors->has('color_background') ? ' has-error' : '' }}">
							<label class="form-label"><span class="label">Pole tekstowe</span> Kolor czcionki</label>
							<input type="text" class="form-control" data-plugin="minicolors" id="fieldFontColor" name="fieldFontColor" @if(old('color-background')) value="{{ old('color_background') }}" @else value="#5F5F5F" @endif>
							@if ($errors->has('color_background'))
								<span class="help-block">
									{{ $errors->first('color_background') }}
								</span>
							@endif	
						</div>
						</div>
						</div>
						</div>
					
												    <div class="group-border">
				    <div class="row">
				    <div class="col-md-6">

				    							<div class="form-group{{ $errors->has('color_button') ? ' has-error' : '' }}">
							<label class="form-label"><span class="label">Przycisk</span> Kolor tła</label>
								<input type="text" class="form-control" data-plugin="minicolors" id="buttonBackgroundColor" name="buttonBackgroundColor" @if(old('color_button')) value="{{ old('color_button') }}" @else value="#4CAF50" @endif>
							@if ($errors->has('color_button'))
								<span class="help-block">
									{{ $errors->first('color_button') }}
								</span>
							@endif	
						</div>
						</div>
						<div class="col-md-6">

						<div class="form-group{{ $errors->has('color_button') ? ' has-error' : '' }}">
							<label class="form-label"><span class="label">Przycisk</span> Kolor czcionki</label>
								<input type="text" class="form-control" data-plugin="minicolors" id="buttonFontColor" name="buttonFontColor" @if(old('color_button')) value="{{ old('color_button') }}" @else value="#FFFFFF" @endif>
							@if ($errors->has('color_button'))
								<span class="help-block">
									{{ $errors->first('color_button') }}
								</span>
							@endif	
						</div>
						</div>
						</div>
					</div>

									    <div class="group-border">
				    <div class="row">
				    <div class="col-md-6">
						<div class="form-group{{ $errors->has('text_intro') ? ' has-error' : '' }}">
							<label class="form-label"><span class="label">Własny</span> Tekst zachęty</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="fa fa-edit"></i></div>
								<input type="text" class="form-control" id="introTextInput" name="introTextInput" placeholder="Treść zachęty" @if(old('text_intro')) value="{{ old('text_intro') }}" @endif>
							</div>
							@if ($errors->has('text_intro'))
								<span class="help-block">
									{{ $errors->first('text_intro') }}
								</span>
							@endif	
						</div>
						</div>
						<div class="col-md-6">
				    <div class="form-group{{ $errors->has('rank_view') ? ' has-error' : '' }}">
						<label class="form-label"><span class="label">Wybierz gotowy</span> Tekst zachęty</label>
							<select class="form-control" id="introTextSelect" data-plugin="choices">
								<option value="notselect">Wybierz tekst zachęty z listy</option>
								<option>Pokazuj mnie anonimowo</option>
								<option>Nie pokazuj mnie wcale</option>
							</select>
					   @if ($errors->has('rank_view'))
			                <span class="help-block">
			                    {{ $errors->first('rank_view') }}
			                </span>
			            @endif	
					</div>
						</div>
						</div>
						</div>
															    <div class="group-border">
				    <div class="row">
				    <div class="col-md-6">
						<div class="form-group{{ $errors->has('text_button') ? ' has-error' : '' }}">
							<label class="form-label"><span class="label">Własny</span> Tekst przycisku</label>
							<div class="input-group transparent">
								<div class="input-group-addon"><i class="fa fa-edit"></i></div>
								<input type="text" class="form-control" id="buttonTextInput" name="buttonTextInput" placeholder="Treść przycisku" @if(old('text_button')) value="{{ old('text_button') }}" @endif>
							</div>
							@if ($errors->has('text_button'))
								<span class="help-block">
									{{ $errors->first('text_button') }}
								</span>
							@endif	
						</div>
						</div>
						<div class="col-md-6">
							<div class="form-group{{ $errors->has('rank_view') ? ' has-error' : '' }}">
						<label class="form-label"><span class="label">Wybierz gotowy</span> Tekst przycisku</label>
							<select class="form-control" id="buttonTextSelect" data-plugin="choices">
							<option value="notselect">Wybierz tekst przycisku z listy</option>
								<option>Pokazuj mnie anonimowo</option>
								<option>Nie pokazuj mnie wcale</option>
							</select>
					   @if ($errors->has('rank_view'))
			                <span class="help-block">
			                    {{ $errors->first('rank_view') }}
			                </span>
			            @endif	
					</div>
						</div>
						</div>
						</div>

						<div class="form-group border{{ $errors->has('auto_rule') ? ' has-error' : '' }}">
							<label class="form-label">Automatycznie zaakceptowany regulamin</label>
							<input type="checkbox" data-plugin="labelauty" data-labelauty="Nie|Tak" id="auto_rule" name="auto_rule" value="1">
								@if ($errors->has('auto_rule'))
									<span class="help-block">
										{{ $errors->first('auto_rule') }}
									</span>
								@endif
							</div>
				    </div>

					<div class="tab-pane" id="step-payment">
						<div class="form-group border{{ $errors->has('payment') ? ' has-error' : '' }}">
							<label class="form-label">Model płatności <span class="help semi-bold">(Możesz wybrać maksymalnie 3 modele płatności. Kolejność wyboru ma znaczenie)</span></label>
								<select class="" id="payment" name="payment[]" multiple>
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

				<h4 class="p-r-10 p-l-25 m-b-15 m-t-25 m-b-30"><i class="fa fa-search m-r-5"></i> Podgląd</h4>
	            <div class="content-locker-background">
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
	            			Klikając "<span id="rule-text-button"></span>", oświadczam, że zapoznałem/am się z <a href="https://leadprize.pl/regulamin.pdf">regulaminem</a> i go akceptuję.
	            		</div>
	            		<div class="rule-checkbox">
	            		               <div class="form-group checkbox">
	                        <div class="checkbox check-success">
	                        <input type="checkbox" id="rule_accept" name="rule_accept">
	                        <label for="rule_accept">Akceptuję <a href="https://leadprize.pl/regulamin.pdf">regulamin</a> usługi</label>
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
						<li class="previous"><a class="btn btn-success"><i class="fa fa-arrow-circle-left"></i> Wstecz</a></li>
						<li class="next"><a class="btn btn-success">Dalej <i class="fa fa-arrow-circle-right"></i></a></li>
						<li class="finish"><button type="submit" id="submitWidgetLocker" name="submitWidgetLocker" class="btn btn-success finish" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Stwórz</button></li>
					</ul>
				</div>

				</form>
				</div>
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
<link href="{{ asset('assets/plugins/formvalidation/css/formvalidation.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="{{ asset('assets/plugins/choices/choices.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/color-picker/color-picker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-checkbox/checkbox.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-wizard/bootstrap.wizard.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/formvalidation/js/formvalidation.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/formvalidation/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {

	$('#WidgetLockerForm').on('init.field.fv', function(e, data) {
            // data.fv      --> The FormValidation instance
            // data.field   --> The field name
            // data.element --> The field element

            var $icon      = data.element.data('fv.icon'),
                options    = data.fv.getOptions(),                      // Entire options
                validators = data.fv.getOptions(data.field).validators; // The field validators

            if (validators.notEmpty && options.icon && options.icon.required) {
                // The field uses notEmpty validator
                // Add required icon
                $icon.addClass(options.icon.required).show();
            }
        }).formValidation({
        framework: 'bootstrap',
        icon: {
        	required: 'glyphicon glyphicon-asterisk',
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		excluded: ':disabled',
        fields: {
            name: {
            	trigger: 'blur',
                validators: {
                    notEmpty: {
                        message: 'Pole nazwa widgetu jest wymagane'
                    },
                      regexp: {
                        regexp: /^[0-9A-z\s]+$/i,
                        message: 'The full name can consist of alphabetical characters and spaces only'
                    }
                }
            },

            domain: {
            	trigger: 'blur',
                validators: {
                    notEmpty: {
                        message: 'Pole adres strony jest wymagane'
                    },
                    uri:{
                    	message: 'must be url'
                    },
                }
            },
            redirect: {
                validators: {
                    uri:{
                    	message: 'must be url'
                    },
                }
            },
                        lockerBackgroundColor: {
            	trigger: 'blur',
            	validators: {
            		            	              notEmpty: {
                        message: 'Pole adres strony jest wymagane'
                    },
            		color: {
                        type: ['hex'],
                        message: 'The value is not valid color'
                    }
            	}
            },
                        lockerFontColor: {
            	trigger: 'blur',

            	validators: {
            		            	              notEmpty: {
                        message: 'Pole adres strony jest wymagane'
                    },
            		color: {
                        type: ['hex'],
                        message: 'The value is not valid color'
                    }
            	}
            },

                        filedBackgroundColor: {
            	trigger: 'blur',

            	validators: {
            		            	              notEmpty: {
                        message: 'Pole adres strony jest wymagane'
                    },
            		color: {
                        type: ['hex'],
                        message: 'The value is not valid color'
                    }
            	}
            },

                        fieldFontColor: {
            	trigger: 'blur',

            	validators: {
            		            	              notEmpty: {
                        message: 'Pole adres strony jest wymagane'
                    },
            		color: {
                        type: ['hex'],
                        message: 'The value is not valid color'
                    }
            	}
            },

            buttonBackgroundColor: {
            	trigger: 'blur',
            	validators: {
            		            	              notEmpty: {
                        message: 'Pole adres strony jest wymagane'
                    },
            		color: {
                        type: ['hex'],
                        message: 'The value is not valid color'
                    }
            	}
            },

            buttonFontColor: {
            	trigger: 'blur',
            	validators: {

            		color: {
            			            	              notEmpty: {
                        message: 'Pole adres strony jest wymagane'
                    },
                        type: ['hex'],
                        message: 'The value is not valid color'
                    }
            	}
            },

            buttonTextInput: {
            	trigger: 'blur',
            	validators: {
            		              notEmpty: {
                        message: 'Pole adres strony jest wymagane'
                    },
            		regexp: {
                        regexp: /^[0-9A-zĄĆĘŁŃÓŚŹŻąćęłńóśźż!.?,\s]{3,45}$/i,
                        message: 'The full name can consist of alphabetical characters and spaces only'
                    }
            	}
            },

            introTextInput: {
            	trigger: 'blur',
            	validators: {
            		              notEmpty: {
                        message: 'Pole adres strony jest wymagane'
                    },
            		regexp: {
                        regexp: /^[0-9A-zĄĆĘŁŃÓŚŹŻąćęłńóśźż!.?,\s]{3,45}$/i,
                        message: 'The full name can consist of alphabetical characters and spaces only'
                    }
            	}
            },
        }
    });

	LockerWidget.init();

	$("#payment").on('change', function() {
		var service = [];
		var payment = [];
  		$("ul.dropdown-menu li.selected").each(function(i, el) {
	 		service.push($(el).data('original-index'));
	 		var type = $('#payment option:eq('+ service[i] +')').data('type');
	 		var message = $('#payment option:eq('+ service[i] +')').data('message');
	 		var number = $('#payment option:eq('+ service[i] +')').data('number');

	 		payment.push({type: type, message: message, number: number});
		});

  		console.log(payment);

		if ($('ul.chosen-choices li.search-choice')) {
			if (payment[0]['type'] == 'mt'){
				$("#content-locker #mo").hide();
				$('#code input').attr("placeholder", "Wpisz swój numer telefonu...");
				$("#content-locker #text").text('Aby kontynuować wprowadź swój numer telefonu');
			}else if(payment[0]['type'] == 'mo'){
				$("#content-locker #mo").show();
				$("#content-locker #mt").hide();
				$("#content-locker #mo #payment-number").text(payment[0]['number']);
				$("#content-locker #mo #payment-message").text(payment[0]['message']);
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

	<script>
	$(document).ready(function() {
	  	$('#WidgetLockerWizard').bootstrapWizard();



	});
	</script>
@endsection