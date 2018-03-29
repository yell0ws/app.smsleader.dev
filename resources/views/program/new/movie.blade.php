@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - Nowa kampania @endsection

@section('content')
<div class="page-title">
	<h3><i class="fa fa-plus-square-o"></i> Nowa kampania - <span class="semi-bold">{{ $program->title }}</span></h3>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="grid simple vertical green">
		<div class="grid-body">
		<form action="" method="POST">
		{{ csrf_field() }}
				<div class="form-group">
				<label class="form-label bold">Nazwa kampani <span class="help semi-bold">(Ułatwi Ci identyfikację źródła wejść oraz leadów, widoczna wyłącznie dla Ciebie)</span></label>
					<div class="input-group transparent">
					<div class="input-group-addon"><i class="fa fa-edit"></i></div>
					<input type="text" class="form-control" id="name" name="name" placeholder="Nazwa kampani - np. Film Szybcy i wsciekli 7">
					</div>
				</div>
								<div class="form-group">
				<label class="form-label bold">Tytuł filmu <span class="help semi-bold">(Zostanie wyświetlony na wygenerowanej stronie jako nazwa oraz będzie składową linku do kampani)</span></label>
					<div class="input-group transparent">
					<div class="input-group-addon"><i class="fa fa-edit"></i></div>
					<input type="text" class="form-control" id="title" name="title" placeholder="Tytuł - np. Szybcy i wsciekli 7">
					</div>
				</div>
				<div class="alert alert-info" id="show-url" style="display: none;">Link do twojej kampani będzie wyglądał następująco: {{ $program->domain }}/{identyfikator}/<span id="url" class="bold"></span></div>
																<div class="form-group">
				<label class="form-label bold">Adres URL okładki</label>
					<div class="input-group transparent">
					<div class="input-group-addon"><i class="fa fa-edit"></i></div>
					<input type="text" class="form-control" id="coverurl" name="coverurl" placeholder="Adres URL okładki - np. http://i.imgur.com/AtsZMnt.jpg">
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
					<select class="form-control select2" id="defaultVideo">
							<option value="0">Wybierz gotowa zajawke</option>
							<option value="http://{{ $program->domain }}/video/multikino.mp4">Multikino</option>
							<option value="http://{{ $program->domain }}/video/warnerbros.mp4">Warner Bros</option>
							<option value="http://{{ $program->domain }}/video/metro.mp4">Metro</option>
							<option value="http://{{ $program->domain }}/video/columbia.mp4">Columbia</option>
							<option value="http://{{ $program->domain }}/video/thx.mp4">THX</option>
							<option value="http://{{ $program->domain }}/video/paramount.mp4">Paramount</option>
							<option value="http://{{ $program->domain }}/video/universal.mp4">Universal</option>
							<option value="http://{{ $program->domain }}/video/waltdisney.mp4">Walt Disney</option>
							<option value="http://{{ $program->domain }}/video/20thcenturyfox.mp4">20th Century Fox</option>
						</select>
				</div>	
				</div>
				</div>
								<div class="form-group">
				<label class="form-label bold">Model płatności</label>
						<select class="form-control select2" id="rate" name="rate[]" multiple>
						@foreach ($payments as $payment)
							<option value="{{ $payment->id }}" data-name="{{ str_slug($payment->name, '_')}}" data-rate="{{ Auth::user()->tier->rate($payment->rate,$payment->name) }}">{{ $payment->name }} - Stawka: {{ Auth::user()->tier->rate($payment->rate,$payment->name) }} zł</option>
						@endforeach
						</select>
				</div>
				<div class="alert alert-info" id="rate-notification" style="display: none;"></div>
                								<div class="form-group">
				<label class="form-label bold">Przekierowanie do innej kampani <span class="help semi-bold">(Po poprawnym dokonaniu płatności, system przekieruje do następnej kampani)</span></label>
						<select class="form-control select2" id="secondlead" name="secondlead">
						<option value="0">Wyłącz</option>
						@foreach ($configurations as $configuration)
							<option value="{{ $configuration->id }}" data-url="{{ $configuration->program->domain }}/{{ $configuration->id }}/{{ $configuration->slug }}">Nazwa kampani: {{ $configuration->name }}</option>
						@endforeach
						</select>
				</div>
				<div class="alert alert-info" id="secondlead-notification" style="display: none;"></div>
							<div class="form-group" id="redirect">
				<label class="form-label bold">Przekierowanie na własną stronę <span class="help semi-bold">(Po poprawnym dokonaniu płatności, system przekieruje na twoją własną stronę. <span class="bold">Pozostaw puste jeżeli chcesz wyłączyć przekierowanie!</span>)</span></label>
					<div class="input-group transparent">
					<div class="input-group-addon"><i class="fa fa-edit"></i></div>
					<input type="text" class="form-control" id="name" name="name" placeholder="Przekierowanie na własną stronę - np. http://mojefilmy.pl/">
					</div>
				</div>
				<div class="alert alert-info" id="secondlead-notification" style="display: none;"></div>
												<div class="form-group">
				<label class="form-label bold">Czas <span class="help semi-bold">(Ile sekund ma upłynąć do pojawienia się okna z płatnością. Ustaw <span class="bold">0</span> aby okno z płatnościa pojawiło się natychmiast)</span></label>
					<div class="input-group transparent">
					<div class="input-group-addon"><i class="fa fa-edit"></i></div>
					<input type="text" class="form-control" id="time" name="time" placeholder="Czas w sekundach - np. 60">
					</div>
				</div>
																<div class="form-group">
				<label class="form-label bold">Ilość widzów</label>
					<div class="input-group transparent">
					<div class="input-group-addon"><i class="fa fa-edit"></i></div>
					<input type="text" class="form-control" id="viewers" name="viewers" placeholder="Ilość widzów - np. 149">
					</div>
				</div>
				<div class="alert alert-info">
				<h4><i class="fa fa-info-circle"></i> Zwróć uwagę na sposób zapisu!</h4>
				<p>Jeżeli nie wypełnisz pola komentarze to pojawią się domyślne. Wpisz off, a komentarze zostaną całkowicie wyłączone.<br>
				Format wprowadzania komentarzy: <span class="bold">komentarz1;komentarz2</span></p>
				</div>
			<div class="form-group">
								<label class="form-label bold">Komentarze</label>
					<div class="input-group transparent">
					<div class="input-group-addon"><i class="fa fa-edit"></i></div>
					<textarea class="form-control" id="comments" name="comments" placeholder="Komentarze np. Super jakość! Polecam;Ekstra jakość"></textarea>
					</div>
				</div>
				                <div class="form-group checkbox {{ $errors->has('rule_accept') ? ' has-error' : '' }}">
                        <div class="checkbox check-success">
                        <input id="accept" name="accept" type="checkbox">
                        <label for="accept">Oświadczam, że zapoznałem się i akceptuję postanowienia <a href="">Regulaminu</a></label>
                    </div>
                </div>
				<button type="submit" class="btn btn-success btn-block">Stwórz</button>
        </form>
		</div>
		</div>
	</div>
</div>
@endsection

@section('css')
<link href="/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="/plugins/jquery-numberAnimate/jquery.animateNumber.min.js" type="text/javascript"></script>
<script src="/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function () {
	$("#rate").change(function() {

		if ($("#rate option:selected").length > 3) {
        	$("#rate option:selected:last").removeAttr("selected");
    	}

		var name = $('#rate option:selected').data("name");
		var rate = $('#rate option:selected').data("rate");
		var sum_rate = 0;
		$("#rate :selected").map(function(i, el) {
	 		sum_rate += Number($(el).data('rate'));
		});

		if ($("#rate option:selected").length > 0 && $("#rate option:selected").length <= 3) {
			if(name == "mt4") {
			$("#rate-notification").html("Usługa subskrypcji - Otrzymujesz <span class='bold'>"+ rate +"</span> zł za każdy pozyskany lead/aktywację. Dodatkowo zarabiasz na odnowieniach subskrypcji każdorazowo <span class='bold'>"+ rate +"</span> zł w każdy poniedziałek, środę, piątek do czasu wypisania się użytkownika z subskrypcji.").show();
			}else if(name == "mt0") {
			$("#rate-notification").html("Koszt sms to <span class='bold'>1,23</span> zł brutto. Nie otrzymasz za niego wynagrodzenia, ale wyświetli się w statystykach.").show();
			}else if(name.indexOf("mo") != -1){
				if (rate != sum_rate) {
	    			$("#rate-notification").html("Jeżeli pozyskasz <span class='bold'>"+ $("#rate option:selected").length +"</span> leady otrzymasz łącznie <span class='bold'>"+ sum_rate +"</span> zł").show();
				}else{
					$("#rate-notification").html("Otrzymujesz <span class='bold'>"+ rate +"</span> zł wynagrodzenia za każdy pozyskany lead/aktywację.").show();
				}
			}else{
			$("#rate-notification").hide();
			}
		}else{
			$("#rate-notification").hide();
		}
	});

		$("#defaultVideo").change(function() {

		var defaultVideo = $('#defaultVideo option:selected').val();
		var videourl = $('#videourl');
		if (defaultVideo !=0) {
			videourl.val(defaultVideo);
		}else{
			videourl.val('');
		}
	});

	$("#secondlead").change(function() {
		var id = $('#secondlead option:selected').val()
		if (id != 0) {
			var url = $('#secondlead option:selected').data("url");
			$('#redirect').hide();
	        $("#secondlead-notification").html("Po dokonaniu płatności nastąpi przekierowanie na adres kampani: <span class='bold'>"+ url +"</span>").show();
		}else{
	    	$('#secondlead-notification').hide();
	    	$('#redirect').show();
		}
	});

	var slug = function(str) {
	    var $slug = '';
	    var trimmed = $.trim(str);
	    $slug = trimmed.replace(/[^a-z0-9]/gi, '-').
	    replace(/-+/g, '-').
	    replace(/^-|-$/g, '');
	    return $slug.toLowerCase();
	}

	$('#title').on('keyup', function(e) {
		var title = $(this).val();
		if (!title) {
			$('#show-url').hide();
		}else{
			$('#show-url').show();
			$('#show-url #url').html(slug($(this).val()));
		}
	});
});

</script>
@endsection