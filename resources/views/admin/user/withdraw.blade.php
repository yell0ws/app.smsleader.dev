@extends('admin.layouts.base')

@section('title'){{ Setting::get('site_title') }} - Panel Administratora - Historia wypłat @endsection

@section('content')
<div class="page-title">
  <h3>
    Historia wypłat: <span class="bold">{{ $user->username }}</span>
  </h3>
</div>
<div class="row">
  <div class="col-xs-3 m-b-30">
    <div class="tiles dark">
      <div class="tiles-body">
      <i class="fa fa-exclamation-triangle icon-bg"></i>
      <div class="tiles-title">Wypłaty niepotwierdzone</div>
      <div class="heading">
      <span class="animate-number" data-value="{{ $withdrawsNotConfirm->count() }}" data-animation-duration="1000">0</span> / 
      <span class="animate-number" data-value="{{ $withdrawsNotConfirm->sum('amount') }}" data-animation-duration="1000">0.00</span> PLN
      </div>
      </div>
    </div>
  </div>
  <div class="col-xs-3 m-b-30">
    <div class="tiles yellow">
      <div class="tiles-body">
      <i class="fa fa-clock-o icon-bg"></i>
      <div class="tiles-title">Wypłaty oczekujące na realizację</div>
      <div class="heading">
      <span class="animate-number" data-value="{{ $withdrawsWait->count() }}" data-animation-duration="1000">0</span> / 
      <span class="animate-number" data-value="{{ $withdrawsWait->sum('amount') }}" data-animation-duration="1000">0.00</span> PLN
      </div>
      </div>
    </div>
  </div>
  <div class="col-xs-3 m-b-30">
    <div class="tiles green">
      <div class="tiles-body">
      <i class="fa fa-calendar icon-bg"></i>
      <div class="tiles-title">Wypłaty zrealizowane</div>
      <div class="heading">
      <span class="animate-number" data-value="{{ $withdrawsPay->count() }}" data-animation-duration="1000">0</span> / 
      <span class="animate-number" data-value="{{ $withdrawsPay->sum('amount') }}" data-animation-duration="1000">0.00</span> PLN
      </div>
      </div>
    </div>
  </div>
  <div class="col-xs-3 m-b-30">
    <div class="tiles red">
      <div class="tiles-body">
      <i class="fa fa-usd icon-bg"></i>
      <div class="tiles-title">Wypłaty anulowane</div>
      <div class="heading">
        <span class="animate-number" data-value="{{ $withdrawsCancel->count() }}" data-animation-duration="1000">0</span> / 
      <span class="animate-number" data-value="{{ $withdrawsCancel->sum('amount') }}" data-animation-duration="1000">0.00</span> PLN
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
              <th class="text-center">Numer wypłaty</th>
              <th class="text-center">Kwota</th>
              <th class="text-center">Forma wypłaty</th>
              <th class="text-center">Priorytet wypłaty</th>
              <th class="text-center">Status wypłaty</th>
              <th class="text-center">Data zlecenia</th>
              <th class="text-center">Data zrealizowania</th>
              <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>
          @if (count($withdraws) == 0)
            <tr>
              <td class="text-center" colspan="8">Użytkownik nie zlecił jeszcze żadnej wypłaty środków!</td>
            </tr>
          @else
            @foreach ($withdraws as $withdraw)
              <tr>
                <td class="text-center">
                  <span class="label">{{ $withdraw->payout_id}}</span>
                </td>
                <td class="text-center"><span class="label label-success">{{ $withdraw->amount }} PLN</span></td>
                <td class="text-center">
                  @if($withdraw->form == 'bank') 
                    <span class="label label-primary"><i class="fa fa-university m-r-5"></i>{{ $withdraw->getWithdrawForm() }}</span>
                  @elseif($withdraw->form == 'paypal') 
                    <span class="label label-info"><i class="fa fa-paypal m-r-5"></i>{{ $withdraw->getWithdrawForm() }}</span>
                  @endif
                </td>
                <td class="text-center">
                  @if($withdraw->priority == 'standard') 
                    <span class="label">{{ $withdraw->getWithdrawPriority() }}</span>
                  @elseif($withdraw->priority == 'express') 
                    <span class="label label-danger"><i class="fa fa-clock-o m-r-5"></i>{{ $withdraw->getWithdrawPriority() }}</span>
                  @endif
                </td>
                    <td class="text-center">
                      <span class="label label-{{ $withdraw->getWithdrawStatus()[0] }}">
                        @if($withdraw->cancel_reason) <i class="fa fa-info-circle m-r-5" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<span class='bold'>Powód:</span> {{ $withdraw->cancel_reason }}"></i> @endif {{ $withdraw->getWithdrawStatus()[1] }}
                      </span>
                    </td>
                <td class="text-center">{{ $withdraw->created_at }}</td>
                <td class="text-center">@if($withdraw->status == 'pay') {{ $withdraw->paid_at }} @else - @endif</td>
                <td class="text-center">
                  <a href="{{ route('admin.withdraw.detail', ['id' => $withdraw->id ]) }}" class="btn btn-small btn-primary">Szczegóły wypłaty</a>
                </td>
              </tr>
            @endforeach
          @endif
          </tbody>
        </table>
      </div>
    {{ $withdraws->links() }}
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