@extends('admin.layouts.base')

@section('title'){{ Setting::get('site_title') }} - Panel Administratora - Zarządzanie Partnerami @endsection

@section('content')
<div class="page-title">
  <h3>
    Zarządzanie <span class="bold">użytkownikami</span>
  </h3>
</div>
<div class="row">
  <div class="col-xs-3 m-b-30">
    <div class="tiles green">
      <div class="tiles-body">
      <i class="fa fa-user-circle icon-bg"></i>
      <div class="tiles-title">Aktywni użytkownicy</div>
      <div class="heading">
      <span class="animate-number" data-value="{{ $usersActive }}" data-animation-duration="1000">0</span>
      </div>
      </div>
    </div>
  </div>
  <div class="col-xs-3 m-b-30">
    <div class="tiles blue">
      <div class="tiles-body">
      <i class="fa fa-usd icon-bg"></i>
      <div class="tiles-title">Środki gotowe do wypłaty</div>
      <div class="heading">
      <span class="animate-number" data-value="{{ $usersBalance }}" data-animation-duration="1000">0.00</span> PLN
      </div>
      </div>
    </div>
  </div>
  <div class="col-xs-3 m-b-30">
    <div class="tiles dark">
      <div class="tiles-body">
      <i class="fa fa-times-circle icon-bg"></i>
      <div class="tiles-title">Nieaktywni użytkownicy</div>
      <div class="heading">
        <span class="animate-number" data-value="{{ $usersNoActive }}" data-animation-duration="1000">0</span>
      </div>
      </div>
    </div>
  </div>
  <div class="col-xs-3 m-b-30">
    <div class="tiles red">
      <div class="tiles-body">
      <i class="fa fa-ban icon-bg"></i>
      <div class="tiles-title">Zablokowani użytkownicy</div>
      <div class="heading">
        <span class="animate-number" data-value="{{ $usersBan }}" data-animation-duration="1000">0</span>
      </div>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="grid simple">
      <div class="grid-body no-padding">
        <table class="table no-margin">
          <thead>
            <tr>
              <th class="text-center">ID użytkownika</th>
              <th class="text-center">Nazwa użytkownika</th>
              <th class="text-center">Dostępne środki</th>
              <th class="text-center">Łącznie zarobił</th>
              <th class="text-center">Data rejestracji</th>
              <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>
            @if (count($users) == 0)
              <tr>
                <td class="text-center" colspan="5">Lista użytkowników jest pusta!</td>
              </tr>
            @else
            @foreach ($users as $user)
              <tr>
                <td class="text-center">
                  <span class="label">{{ $user->id }}</span>
                </td>
                <td class="text-center">
                  @if($user->ban) 
                    <span class="label label-danger" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Konto zablokowane"><i class="fa fa-ban m-r-5"></i>{{ $user->username }}</span>
                  @elseif(!$user->active) 
                    <span class="label label-warning" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Konto nieaktywne"><i class="fa fa-exclamation m-r-5"></i>{{ $user->username }}</span>
                  @else
                    <span class="label label-success" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Konto aktywne"><i class="fa fa-check-square m-r-5"></i>{{ $user->username }}</span>
                  @endif
                </td>
                <td class="text-center">
                  @if($user->balance > 50) 
                    <span class="label label-success">{{ $user->balance }} PLN</span>
                  @else
                    <span class="label">{{ $user->balance }} PLN</span>
                  @endif
                </td>
                <td class="text-center">
                    <span class="label">{{ $user->earn }} PLN</span>
                </td>
                <td class="text-center">
                  {{ $user->created_at }}
                </td>
                <td class="text-center">
                  <div class="btn-group"><a href="#" data-toggle="dropdown" class="btn dropdown-toggle btn-small btn-primary">Zarządzaj<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('admin.user.detail', ['id' => $user->id ]) }}">Szczegóły użytkownika</a></li>
                      <li><a href="{{ route('admin.user.detail.withdraw', ['id' => $user->id ]) }}">Historia wypłat</a></li>
                      <li><a href="{{ route('admin.user.detail.withdraw', ['id' => $user->id ]) }}">Konfiguracje</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    {{ $users->links() }}
    </div>
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