@extends('layouts.base')

@section('title'){{ config('app.name') }} - Widget Player @endsection

@section('content')
<div class="subheader tabs">
  <div class="background-pattern"></div>
  <div class="background-color"></div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
  <div class="content">
    <span class="title"><i class="ion-play"></i> Widget - <span class="subtitle">Player</span></span>
  </div>
  <div class="tabs">
    <a href="{{ route('widget.player') }}" class="{{ Request::is('widgets/player/list') ? 'active' : '' }}">Moje konfiguracje</a>
    <a href="{{ route('widget.player.new') }}" class="{{ Request::is('widgets/player/new') ? 'active' : '' }}">Stwórz widget</a>
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
            <th data-column-id="amount" data-align="center" class="text-center" style="width:15%">Nazwa widgetu</th>
            <th data-column-id="start_date" data-align="center" class="text-center" style="width:15%">Zdobytych leadów</th>
            <th data-column-id="finish_date" data-align="center" class="text-center" style="width:15%">Zarobek</th>
            <th data-column-id="withdraw_time" data-align="center" class="text-center" style="width:10%">Kod widgetu</th>
            <th data-column-id="withdraw_time" data-align="center" class="text-center" style="width:10%">Zarządzaj</th>
          </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-center">3737</td>
            <td class="text-center">edwedwe</td>
            <td class="text-center">4345</td>
            <td class="text-center">34874 zł</td>
            <td class="text-center">
              <a class="btn btn-primary btn-block btn-small"><i class="fa fa-code"></i> Kod widgetu</a>
            </td>
            <td class="text-center">
              <a href="{{ route('widget.player.edit', ['id' => '1']) }}" class="btn btn-success btn-small"><i class="fa fa-pencil-square-o"></i> Edytuj</a>
              <a href="{{ route('widget.player.delete', ['id' => '1']) }}" class="btn btn-danger btn-small"><i class="fa fa-times"></i> Usuń</a>
            </td>
        </tr>
        </tbody>
      </table>
  </div>
  </div>
</div>
</div>
@endsection

@section('css')
@endsection

@section('js')
@endsection