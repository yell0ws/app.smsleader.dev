@extends('layouts.base')

@section('title'){{ config('app.name') }} - Moje konfiguracje @endsection

@section('content')
<div class="subheader tabs">
  <div class="background-pattern"></div>
  <div class="background-color"></div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
  <div class="content">
    <span class="title"><i class="ion-cube"></i> Moje <span class="subtitle">konfiguracje</span></span>
  </div>
  <div class="tabs">
      <a href="{{ route('program.list') }}">Lista programów</a>
    <a href="{{ route('widget.locker') }}" class="{{ Request::is('programs/configuration') ? 'active' : '' }}">Moje konfiguracje</a>
  </div>
</div>
</div>
</div>
<div class="row">
 @if (count($configurations) === 0)
	        Jeszcze nikt nie zasłużył na miejsce w rankingu!
	        @else
	        @foreach ($configurations as $configuration)
          <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="grid simple">
          <div class="grid-body p-t-15 configuration">
              <div class="img">
              <img src="{{URL::asset('assets/img/thumbs/programs/program_'. $configuration->program->id .'.png')}}">
              </div>
              <div class="details">
                <h4>{{ $configuration->name }} <a href="" class="btn btn-small btn-danger pull-right" style="margin-right: 15px;"><i class="fa fa-remove"></i> Usuń</a>
                </h4>
                <div class="bottom">
<a href="" class="btn btn-success btn-block"><i class="fa fa-th-list"></i> Edytuj</a>
<a href="" class="btn btn-primary btn-block"><i class="fa fa-area-chart"></i> Statystyki</a>
                </div>
                </div>
              </div>
          </div>
          </div>
			@endforeach
			@endif
      <div class="col-md-12">
      {{ $configurations->render() }}
</div>
</div>
@endsection

@section('css')
@endsection

@section('js')
<script src="/plugins/jquery-numberAnimate/jquery.animateNumber.min.js" type="text/javascript"></script>
@endsection