@extends('admin.layouts.base')

@section('title'){{ Setting::get('site_title') }} - Panel Administratora - Zarządzanie wypłatami - Szczegóły wypłaty @endsection

@section('content')
<div class="page-title">
  <h3>
    Szczegóły wypłaty: <span class="bold">{{ $withdraw->user->username }}/{{ $withdraw->payout_id }}</span>
  </h3>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-lg-offset-3">
  <div class="row">
  <div class="col-xs-6 m-b-30">
  <div class="tiles @if($withdraw->status == 'cancel') red @elseif($withdraw->status == 'notconfirm') yellow @elseif($withdraw->status == 'wait') blue @elseif($withdraw->status == 'pay') green @endif">
    <div class="tiles-body">
    <i class="fa @if($withdraw->status == 'cancel') fa-ban @elseif($withdraw->status == 'notconfirm') fa-clock-o @elseif($withdraw->status == 'wait') fa-exclamation @elseif($withdraw->status == 'pay') fa-check-square @endif icon-bg"></i>
    <div class="tiles-title">Status wypłaty</div>
    <div class="heading">
    @if($withdraw->status == 'cancel') Anulowana @elseif($withdraw->status == 'notconfirm') Oczekuje na potwierdzenie @elseif($withdraw->status == 'wait') Oczekuje na realizację @elseif($withdraw->status == 'pay') Zrealizowana @endif
    </div>
    </div>
  </div>
</div>
<div class="col-xs-6 m-b-30">
  <div class="tiles green">
    <div class="tiles-body">
    <i class="fa fa-usd icon-bg"></i>
    <div class="tiles-title">Kwota wypłaty</div>
    <div class="heading">
    <span class="animate-number" data-value="{{ $withdraw->amount }}" data-animation-duration="1000">0.00</span> PLN 
    </div>
    </div>
  </div>
</div>

  </div>
    <div class="grid simple">
      <div class="grid-body">
      @if($withdraw->status == 'cancel')
      <div class="alert alert-info">
      	<i class="fa fa-info-circle"></i> Wypłata została anulowana z powodu: <span class="bold">{{ $withdraw->cancel_reason }}</span>. Kwota <span class="bold">{{ $withdraw->amount }} PLN</span> została zwrócona do portfela użytkownika!
      	</div>
      @endif
      @include ('layouts.partials.notifications')
           <div class="form-group">
      <label class="form-label bold">ID wypłaty</label>
      <div class="input-group transparent">
        <div class="input-group-addon disabled" disabled><i class="fa fa-hashtag"></i></div>
        <input type="text" class="form-control" value="{{ $withdraw->id }}" disabled>
      </div>
      </div>
     <div class="form-group">
      <label class="form-label bold">Numer wypłaty</label>
      <div class="input-group transparent">
        <div class="input-group-addon disabled" disabled><i class="fa fa-hashtag"></i></div>
        <input type="text" class="form-control" value="{{ $withdraw->payout_id }}" disabled>
      </div>
      </div>
            <div class="form-group">
      <label class="form-label bold">Nazwa użytkownika</label>
      <div class="input-group transparent">
        <div class="input-group-addon disabled" disabled><i class="fa fa-user-circle"></i></div>
        <input type="text" class="form-control" value="{{ $withdraw->user->username }}" disabled>
      </div>
      </div>
      <div class="form-group">
      <label class="form-label bold">Kwota</label>
      <div class="input-group transparent">
        <div class="input-group-addon disabled"><i class="fa fa-usd"></i></div>
        <input type="text" class="form-control" value="{{ $withdraw->amount }} PLN" disabled>
      </div>
      </div>
            <div class="form-group">
      <label class="form-label bold">Forma wypłaty</label>
      <div class="input-group transparent">
        <div class="input-group-addon disabled">@if($withdraw->form == 'bank') <i class="fa fa-university"></i> @elseif($withdraw->form == 'paypal') <i class="fa fa-paypal"></i> @endif</div>
        <input type="text" class="form-control" @if($withdraw->form == 'bank') value="Przelew bankowy" @elseif($withdraw->form == 'paypal') value="Paypal" @endif disabled>
      </div>
      </div>
      @if($withdraw->form == 'bank')
                                 <div class="form-group">
      <label class="form-label bold">Nazwa banku</label>
      <div class="input-group transparent">
        <div class="input-group-addon disabled" disabled><i class="fa fa-university"></i></div>
        <input type="text" class="form-control" value="{{ $withdraw->user->profile->bank_name }}" disabled>
      </div>
      </div>
                         <div class="form-group">
      <label class="form-label bold">Numer konta bankowego</label>
      <div class="input-group transparent">
        <div class="input-group-addon disabled" disabled><i class="fa fa-university"></i></div>
        <input type="text" class="form-control" value="{{ $withdraw->user->profile->bank_account }}" disabled>
      </div>
      </div>

      @elseif($withdraw->form == 'paypal')
                   <div class="form-group">
      <label class="form-label bold">Identyfikator Paypal</label>
      <div class="input-group transparent">
        <div class="input-group-addon disabled" disabled><i class="fa fa-paypal"></i></div>
        <input type="text" class="form-control" value="{{ $withdraw->user->profile->paypal }}" disabled>
      </div>
      </div>
      @endif
            <div class="form-group">
      <label class="form-label bold">Priorytet wypłaty</label>
      <div class="input-group transparent">
        <div class="input-group-addon disabled"><i class="fa fa-clock-o"></i></div>
        <input type="text" class="form-control" @if($withdraw->priority == 'standard') value="Standardowa" @elseif($withdraw->priority == 'express') value="Ekspresowa" @endif disabled>
      </div>
      </div>
                 <div class="form-group">
      <label class="form-label bold">Data zlecenia</label>
      <div class="input-group transparent">
        <div class="input-group-addon disabled"><i class="fa fa-calendar"></i></div>
        <input type="text" class="form-control" value="{{ $withdraw->created_at }}" disabled>
      </div>
      </div>
      @if($withdraw->status == 'pay')
	     <div class="form-group">
	      <label class="form-label bold">Data zrealizowania</label>
	      <div class="input-group transparent">
	        <div class="input-group-addon disabled"><i class="fa fa-calendar"></i></div>
	        <input type="text" class="form-control" value="{{ $withdraw->paid_at }}" disabled>
	      </div>
	      </div>
      @endif
      @if($withdraw->status == 'wait' or $withdraw->status == 'pay')
        <form action="{{ route('admin.withdraw.confirm', ['id' => $withdraw->id ]) }}" method="POST" id="confirm-form">
      {{ csrf_field() }}
       <button type="submit" class="btn btn-success btn-block" id="confirm" @if($withdraw->status == 'pay') data-pay="false" @elseif($withdraw->status == 'wait') data-pay="true" @endif>
       	@if($withdraw->status == 'pay') Oznacz jako niezrealizowana @elseif($withdraw->status == 'wait') Oznacz jako zrealizowana @endif
       </button>
    </form>
    @elseif($withdraw->status == 'notconfirm')
        <form action="{{ route('admin.withdraw.resend', ['id' => $withdraw->id ]) }}" method="POST" id="resend-form">
      {{ csrf_field() }}
       <button type="submit" class="btn btn-success btn-block" id="resend">Wyślij ponownie wiadomość potwierdzającą</button>
    </form>
    @endif
      </div>
    </div>
    @if($withdraw->status == 'notconfirm' or $withdraw->status == 'wait')
          <div class="grid simple">
          <div class="grid-title">
      <h4><i class="fa fa-ban"></i> Anuluj wypłatę</h4>
    </div>
      <div class="grid-body">
        <form action="{{ route('admin.withdraw.cancel', ['id' => $withdraw->id ]) }}" method="POST" id="cancel-form">
      {{ csrf_field() }}
                       <div class="form-group{{ $errors->has('cancel_reason') ? ' has-error' : '' }}">
      <label class="form-label bold">Powód</label>
        <textarea class="form-control" name="cancel_reason" placeholder="Wprowadź powód anulowania wypłaty"></textarea>
		@if ($errors->has('cancel_reason'))
			<span class="help-block">
				{{ $errors->first('cancel_reason') }}
			</span>
		@endif	
      </div>
       <button type="submit" class="btn btn-danger btn-block" id="cancel">Anuluj wypłatę</button>
    </form>
      </div>
    </div>
    @endif
  </div>
</div>
@include('sweet::alert')
@endsection

@section('css')
<link href="{{ asset('assets/plugins/sweetAlert/sweetAlert.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="{{ asset('assets/plugins/sweetAlert/sweetAlert.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/numberAnimate/animateNumber.min.js') }}" type="text/javascript"></script>
@endsection

@section('script')
    $('#cancel').on('click', function(e){
        e.preventDefault();
        swal({
            title             : "Czy jesteś pewien?",
            text              : "Jesteś pewien, że chcesz anulować wypłatę!",
            type              : "info",
            showCancelButton  : true,
            confirmButtonColor: "#f35958",
            confirmButtonText : "Anuluj wypłatę",
            cancelButtonText  : "Powrót",
            closeOnConfirm    : false,
            closeOnCancel     : true
        },
        function(isConfirm){
            if(isConfirm){
                    $('#cancel-form').submit();
            }
        });
    });

$('#resend').on('click', function(e){
        e.preventDefault();
        swal({
            title             : "Czy jesteś pewien?",
            text              : "Jesteś pewien, że chcesz anulować wypłatę!",
            type              : "info",
            showCancelButton  : true,
            confirmButtonColor: "#4CAF50",
            confirmButtonText : "Wyślij",
            cancelButtonText  : "Powrót",
            closeOnConfirm    : false,
            closeOnCancel     : true
        },
        function(isConfirm){
            if(isConfirm){
                    $('#resend-form').submit();
            }
        });
    });

    $('#confirm').on('click', function(e){
        e.preventDefault();
        var pay = $(this).data('pay');
        var text, confirmButton;

        if(pay) text = "Jesteś pewien, że chcesz oznaczyć wypłatę jako zrealizowana!", confirmButton = "Oznacz jako zrealizowana";
		if(!pay) text = "Jesteś pewien, że chcesz oznaczyć wypłatę jako niezrealizowana!", confirmButton = "Oznacz jako niezrealizowana";

        swal({
            title             : "Czy jesteś pewien?",
            text              : text,
            type              : "info",
            showCancelButton  : true,
            confirmButtonColor: "#4CAF50",
            confirmButtonText : confirmButton,
            cancelButtonText  : "Powrót",
            closeOnConfirm    : false,
            closeOnCancel     : true
        },
        function(isConfirm){
            if(isConfirm){
                    $('#confirm-form').submit();
            }
        });
    });
@endsection