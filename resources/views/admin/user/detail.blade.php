@extends('admin.layouts.base')

@section('title'){{ Setting::get('site_title') }} - Panel Administratora - Szczegóły użytkownika @endsection

@section('content')
<div class="page-title">
  <h3>
    Szczegóły użytkownika: <span class="bold">{{ $user->username }}</span>
  </h3>
</div>
<div class="row">
<div class="col-xs-3 m-b-15">
  <div class="tiles @if($user->ban) red @elseif(!$user->active) yellow @else green @endif">
    <div class="tiles-body">
      <i class="fa @if($user->ban) fa-ban @elseif(!$user->active) fa-exclamation @else fa-check-square @endif icon-bg"></i>
      <div class="tiles-title">Status konta</div>
      <div class="heading">
      @if($user->ban) Zablokowane @elseif(!$user->active) Nieaktywne @else Aktywne @endif
      </div>
    </div>
  </div>
</div>
<div class="col-xs-3 m-b-15">
  <div class="tiles @if($user->balance > 50) green @else blue @endif">
    <div class="tiles-body">
      <i class="fa fa-usd icon-bg"></i>
      <div class="tiles-title">Dostępne środki</div>
      <div class="heading">
      <span class="animate-number" data-value="{{ $user->balance }}" data-animation-duration="1000">0.00</span> zł 
      </div>
    </div>
  </div>
</div>
<div class="col-xs-3 m-b-15">
  <div class="tiles yellow">
    <div class="tiles-body">
    <i class="fa fa-clock-o icon-bg"></i>
    <div class="tiles-title">Środki oczekujące na realizacje</div>
    <div class="heading">
    <span class="animate-number" data-value="{{ $user->payout()->wait()->sum('amount') }}" data-animation-duration="1000">0.00</span> zł 
    </div>
    </div>
  </div>
</div>
<div class="col-xs-3 m-b-15">
  <div class="tiles green">
    <div class="tiles-body">
    <i class="fa fa-usd icon-bg"></i>
    <div class="tiles-title">Wypłacone środki</div>
    <div class="heading">
    <span class="animate-number" data-value="{{ $user->payout()->pay()->sum('amount') }}" data-animation-duration="1000">0.00</span> zł 
    </div>
    </div>
  </div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="row">
<div class="col-md-12">
  <div class="grid simple">
      <div class="grid-title">
      <h4><i class="fa fa-id-card"></i> Dane konta</h4>
    </div>
  <div class="grid-body">
      <div class="form-group">
      <label class="form-label bold">Nazwa użytkownika</label>
      <div class="input-group transparent">
        <div class="input-group-addon disabled" disabled><i class="fa fa-user"></i></div>
        <input type="text" class="form-control" value="{{$user->username}}" disabled>
      </div>
      </div>
            <div class="form-group">
      <label class="form-label bold">Adres email</label>
      <div class="input-group transparent">
        <div class="input-group-addon disabled" disabled><i class="fa fa-at"></i></div>
        <input type="text" class="form-control" value="{{$user->email}}" disabled>
      </div>
      </div>
      <div class="form-group">
      <label class="form-label bold">Data rejestracji</label>
      <div class="input-group transparent">
        <div class="input-group-addon disabled"><i class="fa fa-clock-o"></i></div>
        <input type="text" class="form-control" value="{{$user->created_at}}" disabled>
      </div>
      </div>
      <hr>
            <div class="alert alert-info">
           <i class="fa fa-info-circle"></i> Po wygenerowaniu, nowe hasło zostanie przesłane użytkownikowi na adres email!</span>
      </div>
        <form action="{{route('payout.withdraw')}}" method="POST">
      {{ csrf_field() }}
       <button type="submit" class="btn btn-success btn-block">Wygeneruj nowe hasło</button>
    </form>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="grid simple">
      <div class="grid-title">
      <h4><i class="fa fa-exchange"></i> Dane do wypłaty środków</h4>
      <div class="label label-danger pull-right"><i class="fa fa-exclamation-triangle m-r-5"></i> Dane do wypłaty może modyfikować wyłącznie sam użytkownik!</div>
    </div>
  <div class="grid-body">
      @if(($user->profile->bank_name and $user->profile->bank_account) or $user->profile->paypal)
      <div class="alert alert-success">
           <i class="fa fa-check-square"></i> Partner zdefiniował przynajmniej jedną formę wypłaty środków! <span class="bold">Zanim dokonasz przelewu sprawdź historię konta oraz dane osobowe!</span>
      </div>
      @else
      <div class="alert alert-danger">
           <i class="fa fa-exclamation-triangle"></i> Partner nie zdefiniował przynajmniej jednej formy wypłaty środków! <span class="bold">Anuluj wszystkie aktualnie zlecone wypłaty!</span>
      </div>
      @endif
      <div class="form-group">
      <label class="form-label bold">Nazwa banku</label>
      @if($user->profile->bank_name)
      <div class="input-group transparent">
        <div class="input-group-addon disabled"><i class="fa fa-university"></i></div>
        <input type="text" class="form-control" value="{{$user->profile->bank_name}}" disabled>
      </div>
      @else
      <div class="alert alert-info">
           <i class="fa fa-info-circle"></i> Partner nie zdefiniował nazwy banku!
      </div>
      @endif
      </div>
            <div class="form-group m-b-0">
      <label class="form-label bold">Numer konta bankowego</label>
      @if($user->profile->bank_account)
      <div class="input-group transparent">
        <div class="input-group-addon disabled"><i class="fa fa-university"></i></div>
        <input type="text" class="form-control" value="{{$user->profile->bank_account }}" disabled>
      </div>
      @else
      <div class="alert alert-info">
           <i class="fa fa-info-circle"></i> Partner nie zdefiniował numeru konta bankowego!
      </div>
      @endif
      </div>
            <div class="form-group no-margin">
      <label class="form-label bold">Identyfikator Paypal</label>
      @if($user->profile->paypal)
      <div class="input-group transparent">
        <div class="input-group-addon disabled"><i class="fa fa-paypal"></i></div>
        <input type="text" class="form-control" value="{{$user->profile->paypal}}" disabled>
      </div>
      @else
      <div class="alert alert-info">
           <i class="fa fa-info-circle"></i> Partner nie zdefiniował identyfikatora paypal!
      </div>
      @endif
      </div>
    </div>
  </div>
</div>
</div>
</div>

<div class="col-md-6">
<div class="row">
<div class="col-md-12">
  <div class="grid simple">
      <div class="grid-title">
      <h4><i class="fa fa-id-card"></i> Dane osobowe</h4>
    </div>
  <div class="grid-body">
                <div class="form-group">
          <label class="form-label">Rodzaj konta</label>
            <div class="input-group transparent">
              <div class="input-group-addon disabled"><i class="fa fa-pencil-square-o"></i></div>
              <input type="text" class="form-control" @if($user->profile->account_type == 1) value="Konto prywatne" @elseif($user->profile->account_type == 2) value="Konto firmowe" @endif disabled>
            </div>
        </div>
        <div id="company">
        <div class="form-group">
          <label class="form-label">Nazwa firmy</label>
            <div class="input-group transparent">
              <div class="input-group-addon disabled"><i class="fa fa-pencil-square-o"></i></div>
              <input type="text" class="form-control" value="{{ $user->profile->company_name }}" disabled>
            </div>
        </div>
        <div class="form-group">
          <label class="form-label">NIP</label>
            <div class="input-group transparent">
              <div class="input-group-addon disabled"><i class="fa fa-pencil-square-o"></i></div>
              <input type="text" class="form-control" value="{{ $user->profile->nip }}" disabled>
            </div>
        </div>
        </div>
        <div class="form-group">
          <label class="form-label">Pesel</label>
            <div class="input-group transparent">
              <div class="input-group-addon disabled"><i class="fa fa-pencil-square-o"></i></div>
              <input type="text" class="form-control" value="{{ $user->profile->pesel }}" disabled>
            </div>
        </div>
        <div class="form-group">
          <label class="form-label">Imię</label>
            <div class="input-group transparent">
              <div class="input-group-addon disabled"><i class="fa fa-user-circle-o"></i></div>
              <input type="text" class="form-control" value="{{ $user->profile->first_name }}" disabled>
            </div>
        </div>
        <div class="form-group">
          <label class="form-label">Nazwisko</label>
            <div class="input-group transparent">
              <div class="input-group-addon disabled"><i class="fa fa-user-circle-o"></i></div>
              <input type="text" class="form-control" value="{{ $user->profile->last_name }}" disabled>
            </div>
        </div>
        <div class="form-group">
          <label class="form-label">Adres</label>
            <div class="input-group transparent">
              <div class="input-group-addon disabled"><i class="fa fa-home"></i></div>
              <input type="text" class="form-control" value="{{ $user->profile->address }}" disabled>
            </div>
        </div>
        <div class="form-group">
          <label class="form-label">Miasto</label>
            <div class="input-group transparent">
              <div class="input-group-addon disabled"><i class="fa fa-home"></i></div>
              <input type="text" class="form-control" value="{{ $user->profile->city }}" disabled>
            </div>
        </div>
        <div class="form-group">
          <label class="form-label">Kod pocztowy</label>
            <div class="input-group transparent">
              <div class="input-group-addon disabled"><i class="fa fa-home"></i></div>
              <input type="text" class="form-control" value="{{ $user->profile->zip_code }}" disabled>
            </div>
        </div>
    </div>
  </div>
</div>
</div>
</div>

</div>
@include('sweet::alert')
@endsection

@section('css')
<link href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/numberAnimate/animateNumber.min.js') }}" type="text/javascript"></script>
@endsection