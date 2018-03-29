@extends('layouts.base')

@section('title'){{ config('app.name') }} - Widget Content Locker @endsection

@section('content')
<div class="subheader tabs">
  <div class="background-pattern"></div>
  <div class="background-color"></div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
  <div class="content">
    <span class="title"><i class="ion-unlocked"></i> Widget - <span class="subtitle">Content Locker</span></span>
  </div>
  <div class="tabs">
    <a href="{{ route('widget.locker') }}" class="{{ Request::is('widgets/locker/list') ? 'active' : '' }}">Moje konfiguracje</a>
    <a href="{{ route('widget.locker.new') }}" class="{{ Request::is('widgets/locker/new') ? 'active' : '' }}">Stwórz widget</a>
  </div>
</div>
</div>
</div>
<div class="content">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
    <div class="grid simple">
        <div class="grid-body no-padding">
          <table class="table no-margin">
        <thead>
          <tr>
            <th data-column-id="payout_id" data-align="center" class="text-center" style="width:9%">ID</th>
            <th data-column-id="name" data-align="center" class="text-center" style="width:15%">Nazwa widgetu</th>
            <th data-column-id="start_date" data-align="center" class="text-center" style="width:15%">Zdobytych leadów</th>
            <th data-column-id="finish_date" data-align="center" class="text-center" style="width:15%">Zarobek</th>
            <th data-column-id="withdraw_time" data-align="center" class="text-center" style="width:10%">Kod widgetu</th>
            <th data-column-id="withdraw_time" data-align="center" class="text-center" style="width:10%">Zarządzaj</th>
          </tr>
        </thead>
        <tbody>
                  @if (count($lockers) == 0)
          <tr><td class="text-center" colspan="6">Twoja lista jest pusta! Stwórz nowy widget.</td></tr>
          @else
        @foreach ($lockers as $locker)
        <tr>
            <td class="text-center"><span class="label">{{ $locker->id }}</span></td>
            <td class="text-center">{{ $locker->name }}</td>
            <td class="text-center"><span class="label label-success">2</span></td>
            <td class="text-center"><span class="label label-success">15 zł</span></td>
            <td class="text-center">
              <a class="btn btn-primary btn-block btn-small" data-toggle="modal" data-target="#locker{{ $locker->id }}_code" data-id="{{ $locker->id }}"><i class="fa fa-code"></i> Kod widgetu</a>
            </td>
            <td class="text-center">
              <a href="{{ route('widget.locker.edit', ['id' => $locker->id ]) }}" class="btn btn-success btn-small"><i class="fa fa-pencil-square-o"></i> Edytuj</a>
              <a href="{{ route('widget.locker.delete', ['id' => $locker->id ]) }}" class="btn btn-danger btn-small" id="remove"><i class="fa fa-times"></i> Usuń</a>
            </td>
            </tr>
      @endforeach
    @endif
        </tbody>
      </table>
    </div>
  </div>
  {{ $lockers->links() }}
</div>
</div>
@if (count($lockers) > 0)
@foreach ($lockers as $locker)
<div class="modal fade" id="locker{{ $locker->id }}_code">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><i class="fa fa-code"></i> Kod widgetu na stronę</h4>
      </div>
      <div class="modal-body">
      <h4><i class="fa fa-code"></i> Kod Javascript</h4>
      <div class="alert alert-info m-b-10">
      <i class="fa fa-info-circle"></i> Poniższy kod należy umieścić w sekcji HEAD na swojej stronie.<br>
      Parametr <span class="bold">time</span> służy do określenia czasu po którym nastąpi inicjacja Content Locker'a. Wartość parametru <span class="bold">time</span> podajemy w sekundach!
      </div>
      <div class="form-group">
        <label class="form-label">Skrypt</label>
            <textarea class="form-control"><script src="https://widget.smsleader.dev/locker/{{ $locker->id }}/js/init.js?time=0" type="text/javascript"></script></textarea> 
        </div>
              <div class="alert alert-info m-b-10">
      <i class="fa fa-info-circle"></i> Jeśli chcesz aby inicjacja Content Locker'a następowała automatycznie nie dodawaj przycisku na swoją stronę.
      </div>
              <div class="form-group">
        <label class="form-label">Przycisk inicjujący</label>
            <textarea class="form-control"><a id="sl_locker_{{ $locker->id }}">Pokaż Content Locker</a></textarea> 
        </div>
      <h4 class="m-t-20"><i class="fa fa-html5"></i> iFrame HTML</h4>
       <textarea class="form-control"><iframe src="https://widget.smsleader.dev/locker/{{ $locker->id }}/iframe" style="border: 0; width: 100%; height: 250px;"></iframe></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Zamknij</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@endif
@include('sweet::alert')
@endsection

@section('css')
<link href="{{ asset('assets/plugins/sweetalert/css/sweetalert.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="{{ asset('assets/plugins/sweetalert/js/sweetalert.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('a#remove').on('click', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        swal({
            title             : "Czy jesteś pewien?",
            text              : "Jeżeli usuniesz widget to nie będzie możliwości jego odzyskania!",
            type              : "info",
            showCancelButton  : true,
            confirmButtonColor: "#f35958",
            confirmButtonText : "Usuń",
            cancelButtonText  : "Anuluj",
            closeOnConfirm    : false,
            closeOnCancel     : true
        },
        function(isConfirm){
            if(isConfirm){
                    window.location.href = href;
            }
        });
    });
  });
</script>
@endsection