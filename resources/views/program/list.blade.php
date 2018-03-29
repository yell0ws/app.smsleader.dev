@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - Programy partnerskie MO/MT @endsection

@section('content')
<div class="subheader tabs">
  <div class="background-pattern"></div>
  <div class="background-color"></div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
  <div class="content">
    <span class="title"><i class="ion-cube"></i> Programy <span class="subtitle">partnerskie</span></span>
  </div>
  <div class="tabs">
    <a href="{{ route('program.list') }}" class="{{ Request::is('programs/list') ? 'active' : '' }}">Lista programów</a>
    <a href="{{ route('program.configuration') }}">Moje konfiguracje</a>
  </div>
</div>
</div>
</div>
<div class="content">
<div class="row">
  @if (count($privatePrograms) > 0)
  <div class="col-md-12">
    <h4 class="m-b-15">Prywatne <span class="bold">programy</span></h4>
  </div>
    @foreach ($privatePrograms as $privateProgram)
      <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="grid simple">
          <div class="grid-body p-t-15 configuration">
          <div class="img">
            <img src="{{URL::asset('assets/img/thumbs/programs/program_'. $privateProgram->id .'.png')}}">
          </div>
          <div class="details">
            <h4>
              {{ $privateProgram->title }} 
              @if ($privateProgram->global)<i class="fa fa-globe" data-toggle="tooltip" title="Program globalny"></i>@endif
            </h4>
            <div class="bottom">
              <a href="{{ route('program.new', ['id' => $privateProgram->id]) }}" class="btn btn-success btn-block">Nowa konfiguracja</a>
              <a href="{{ route('program.list.configuration', ['id' => $privateProgram->id]) }}" class="btn btn-primary btn-block">Moje konfiguracje</a>
            </div>
          </div>
          </div>
        </div>
      </div>
    @endforeach
  @endif
  @if (count($privatePrograms) > 0)
  <div class="col-md-12">
    <h4 class="m-b-15">Publiczne <span class="bold">programy</span></h4>
  </div>
  @endif
    @if (count($publicPrograms) === 0)
     Brak aktywnych programów partnerskich!
    @else
    @foreach ($publicPrograms as $publicProgram)
      <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="grid simple">
          <div class="grid-body p-t-15 configuration">
            <div class="img">
              <img src="{{URL::asset('assets/img/thumbs/programs/program_'. $publicProgram->id .'.png')}}">
            </div>
            <div class="details">
              <h4>
                {{ $publicProgram->title }} 
                @if ($publicProgram->global)<i class="fa fa-globe" data-toggle="tooltip" title="Program globalny"></i>@endif
              </h4>
              <div class="bottom">
                <a href="{{ route('program.new', ['id' => $publicProgram->id]) }}" class="btn btn-success btn-block">Nowa konfiguracja</a>
                <a href="{{ route('program.list.configuration', ['id' => $publicProgram->id]) }}" class="btn btn-primary btn-block">Moje konfiguracje</a>
              </div>
            </div>
          </div>
        </div>
      </div>
  	@endforeach
  	@endif
    <div class="col-md-12">
      {{ $publicPrograms->links() }}
    </div>
</div>
</div>
@endsection

@section('css')
@endsection

@section('js')
@endsection