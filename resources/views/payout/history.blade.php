@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - Historia wypłat @endsection

@section('content')
<div class="subheader tabs">
	<div class="background-pattern"></div>
	<div class="background-color"></div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
	<div class="content">
		<span class="title"><i class="ion-arrow-swap brown"></i> Historia <span class="subtitle">wypłat</span></span>
	</div>
	<div class="tabs">
		<a href="{{ route('payout.withdraw') }}" class="{{ Request::is('payouts/withdraw') ? 'active' : '' }}">Wypłata środków</a>
		<a href="{{ route('payout.history') }}" class="{{ Request::is('payouts/history') ? 'active' : '' }}">Historia wypłat</a>
	</div>
</div>
</div>
</div>
<div class="content">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
<div class="row">
	<div class="col-lg-4 col-md-6 col-sm-6 m-b-30">
		<div class="tiles dark">
			<div class="tiles-body">
				<i class="fa fa-exclamation-triangle icon-bg"></i>
				<div class="tiles-title">Wypłaty niepotwierdzone</div>
				<div class="heading">
					<span class="animate-number" data-value="{{ $withdrawsNotConfirm->count() }}" data-animation-duration="1000">0</span> / 
      				<span class="animate-number" data-value="{{ $withdrawsNotConfirm->sum('amount') }}" data-animation-duration="1000">0.00</span> zł
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-6 m-b-30">
		<div class="tiles yellow">
			<div class="tiles-body">
				<i class="fa fa-clock-o icon-bg"></i>
				<div class="tiles-title">Wypłaty oczekujące</div>
				<div class="heading">
					<span class="animate-number" data-value="{{ $withdrawsWait->count() }}" data-animation-duration="1000">0</span> / 
     				<span class="animate-number" data-value="{{ $withdrawsWait->sum('amount') }}" data-animation-duration="1000">0.00</span> zł
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-6 m-b-30">
		<div class="tiles blue">
			<div class="tiles-body">
				<i class="fa fa-exchange icon-bg"></i>
				<div class="tiles-title">Łącznie wypłacono</div>
				<div class="heading">
					<span class="animate-number" data-value="{{ $withdrawsPay }}" data-animation-duration="1000">0.00</span> zł
				</div>
			</div>
		</div>
	</div>
			</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
		<div class="grid simple">
				<div class="grid-body no-padding">
					<table class="table no-margin">
						<thead>
							<tr class="">
								<th class="text-center" style="width:9%">Numer</th>
								<th class="text-center" style="width:12%">Kwota</th>
								<th class="text-center" style="width:15%">Forma</th>
								<th class="text-center" style="width:12%">Priorytet</th>
								<th class="text-center" style="width:15%">Data zlecenia</th>
								<th class="text-center" style="width:15%">Data realizacji</th>
								<th class="text-center" style="width:20%">Status wypłaty</th>
							</tr>
						</thead>
						<tbody>
							@if (count($withdraws) === 0)
	        				<tr><td class="text-center" colspan="8">Twoja historia wypłat środków jest pusta!</td></tr>
	        				@else
								@foreach ($withdraws as $withdraw)
									<tr>
										<td class="text-center"><span class="label">{{ $withdraw->payout_id }}</span></td>
										<td class="text-center">{{ $withdraw->amount }} PLN 
										@if($withdraw->priority_provision > 0) <i class="fa fa-info-circle m-l-5" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Prowizja od wypłaty: <span class='bold'>{{ $withdraw->priority_provision }} PLN</span>"></i> @endif</td>
										<td class="text-center">
											<span class="label">{{ $withdraw->getWithdrawForm() }}</span>
										</td>
										<td class="text-center">
										<span class="label">{{ $withdraw->getWithdrawPriority() }}</span>
										</td>
										<td class="text-center">{{ $withdraw->created_at }}</td>
										<td class="text-center">@if($withdraw->status == 'pay') {{ $withdraw->paid_at }} @else - @endif</td>
										<td class="text-center">
											<span class="label label-{{ $withdraw->getWithdrawStatus()[0] }}">
												@if($withdraw->cancel_reason) <i class="fa fa-info-circle m-r-5" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<span class='bold'>Powód:</span> {{ $withdraw->cancel_reason }}"></i> @endif {{ $withdraw->getWithdrawStatus()[1] }}
											</span>
										</td>
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>
			</div>
		</div>
		{{ $withdraws->links() }}
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