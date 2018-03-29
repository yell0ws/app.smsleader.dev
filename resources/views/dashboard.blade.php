@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - Pulpit @endsection

@section('content')
<div class="subheader">
	<div class="background-pattern"></div>
	<div class="background-color"></div>
	<div class="content">
		<span class="title"><i class="ion-home"></i> Pulpit</span>
	</div>
</div>
<div class="content">
<div class="row">
	<div class="col-md-3 col-sm-6 m-b-30">
		<div class="tiles green">
			<div class="tiles-body">
				<i class="fa fa-eye icon-bg"></i>
				<div class="tiles-title">Unikalne wizyty <span class="bold">(Dzisiaj)</span></div>
				<div class="heading">
					<span class="animate-number" data-value="{{ $sumTodayViews}}" data-animation-duration="1000">0</span> 
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6 m-b-30">
		<div class="tiles blue">
			<div class="tiles-body">
				<i class="fa fa-check-circle icon-bg"></i>
				<div class="tiles-title">Leady <span class="bold">(Dzisiaj)</span></div>
				<div class="heading">
					<span class="animate-number" data-value="{{ $countTodayLeads }}" data-animation-duration="1000">0</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6 m-b-30">
		<div class="tiles yellow">
			<div class="tiles-body">
				<i class="fa fa-percent icon-bg"></i>
				<div class="tiles-title">Konwersja <span class="bold">(Dzisiaj)</span></div>
				<div class="heading">
					<span class="animate-number" data-value="{{ $conversionToday }}" data-animation-duration="1000">0.00</span> % 
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6 m-b-30">
		<div class="tiles red">
			<div class="tiles-body">
				<i class="fa fa-usd icon-bg"></i>
				<div class="tiles-title">Zarobek <span class="bold">(Dzisiaj)</span></div>
				<div class="heading">
					<span class="animate-number" data-value="@if($sumTodayEarn) {{ $sumTodayEarn->amount }} @endif" data-animation-duration="1000">0.00</span> PLN
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-lg-7">
	<div class="row">
		<div class="col-md-12">
		<div class="grid simple">
			<div class="grid-title">
				<h4>Statystyki - <span class="bold">Ostatnie 7 dni</span></h4>
			</div>
			<div class="grid-body p-t-20">
			<div class="row-fluid">
					<canvas id="myChart" style="width: 100%;height: 350px;"></canvas>
					</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
	@include ('layouts.partials.dashboard.chat')
	</div>
	</div>
	</div>
	<div class="col-md-12 col-lg-5">
	<div class="row">
	<div class="col-md-12">
		<div class="grid simple">
			<div class="grid-title">
				<h4>Ostatnie <span class="bold">leady</span></h4>
			</div>
			<div class="grid-body no-padding">
				<table class="table no-margin">
					<thead>
						<tr class="title">
							<th class="text-center" style="width:15%">Program</th>
							<th class="text-center" style="width:15%">Data</th>
							<th class="text-center" style="width:15%">Prowizja</th>
						</tr>
					</thead>
					<tbody>
						@if (count($lastLeads) === 0)
						<tr>
          					<td class="text-center" colspan="3">Nie zdobyłeś jeszcze żadnych leadów!</td>
          				</tr>
          				@else
          				@foreach ($lastLeads as $lead)
          				<tr>
            				<td class="text-center">{{ $lead->configuration_name }}</td>
            				<td class="text-center">{{ $lead->created_at }}</td>
            				<td class="text-center">{{ $lead->amount }} zł</td>
            			</tr>
      					@endforeach
      					@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-12">
	<div class="grid simple transparent">
            <div class="grid-title">
              <h4>Aktualności / Komunikaty</h4>
            </div>
            <div class="grid-body no-padding">
            <div class="row">
            @if (count($posts) === 0)
            <div class="col-md-12">
          		<div class="alert alert-block alert-error fade in m-t-20">
        			<p>Brak nowych postów!</p>
    			</div>
    			</div>
          	@else
          	@foreach ($posts as $post)
          		<div class="col-md-6">
                <div class="widget-item m-t-20">
					<div class="overlayer bottom-left fullwidth">
						<div class="overlayer-wrapper">
							<div class="tiles gradient-black p-l-20 p-r-20 p-b-20 p-t-20">
								<h4 class="text-white semi-bold ">{{ $post->title }}</h4>
							</div>
						</div>
					</div>
                  	<img src="https://s-media-cache-ak0.pinimg.com/736x/52/12/41/5212416df64568f80f9788bd7f4c3498.jpg" class="image-responsive-width">
                </div>
                <div class="tiles white ">
                  <div class="tiles-body">
                    <div class="row">
                      <div class="user-comment-wrapper pull-left">
                        <div class="profile-wrapper"> <img src="http://pp.moneyking.pl/uploads/avatars/582ccfa1c9772-mikolaj_kasa_prezenty_med.jpg" alt="" data-src="assets/img/profiles/d.jpg" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35"> </div>
                        <div class="comment">
                          <div class="user-name"><span class="small-text">Opublikował:</span> <span class="bold">{{ $post->user->username }}</span></div>
                          <div class="preview-wrapper"><i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }} </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      <div class="pull-right m-r-10 m-t-5"><a href="" class="btn btn-small btn-primary"><i class="fa fa-hand-pointer-o"></i> Czytaj więcej</a></div>
                    </div>
                  </div>
                </div>
              </div>
      		@endforeach
      		@endif
            </div>
		</div>
	</div>
</div>
</div>
</div>
<script>
$( document ).ready(function() {
var ctx = document.getElementById("myChart");

Chart.plugins.register({
  beforeDraw: function(chartInstance) {
    var ctx = chartInstance.chart.ctx;
    ctx.fillStyle = "white";
    ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
  }
});

var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["11.01.2017", "12.01.2017", "13.01.2017", "14.01.2017", "15.01.2017", "16.01.2017", "17.01.2017", "18.01.2017"],
        datasets: [{
	        label: "Zarobek",
	        type: "line",
	        yAxisID: "earn",
	        backgroundColor: "rgba(244, 67, 54, 1)",
	        fill: false,
            borderColor: "rgba(244, 67, 54, 1)",
	        data: [100, 200, 200, 200, 200, 300, 0, 0],
    	}, {
	        label: "Unikalne wyświetlenia",
	        type: "line",
	        yAxisID: "uniqueviews",
	        backgroundColor: "rgba(0, 144, 217, 1)",
	        fill: false,
            borderColor: "rgba(0, 144, 217, 1)",
	        data: [32, 25, 1620, 88, 12, 92, 0, 2],
    	}, {
	        label: "Konwersja",
	        type: "line",
	        yAxisID: "conversion",
	        backgroundColor: "rgba(239, 190, 46, 1)", 
	        fill: false,
            borderColor: "rgba(239, 190, 46, 1)",
	        data: [12, 3, 0.5, 5, 6.5, 6.33, 0, 0],
    	},
    	{
    		type: "line",
            label: 'Leady',
            yAxisID: "lead",
            data: [12, 19, 3, 5, 2, 3, 0, 0],
            backgroundColor: "rgba(76, 175, 80, 1)",
            borderColor: "rgba(76, 175, 80, 1)",
            fill: false,
        }]
    },
            options: {
	            legend: {
	            	display: false
	         	},
	            responsive: true,
	            animation: {
	                animateScale: true
	            },
	            scales: {
	           		xAxes : [ {
			            gridLines : {
			                display : false
			            }
	        		}],
		    		yAxes: [{
						type:"linear", "id":"earn", display:true, position: "left",
						ticks: {
							beginAtZero: true,
	                  		fontColor: "rgba(244, 67, 54, 1)",
	                  		fontFamily: "Roboto, Arial",
							callback: function(value, index, values) {
								return values[index] + ' zł';
							}
	                	},
	                	scaleLabel: {
					        display: true,
					        labelString: 'Zarobek - zł',
					       	fontColor: "rgba(244, 67, 54, 1)",
	                  		fontFamily: "Roboto, Arial",
	                  		fontStyle: "bold",
	                  		fontSize: 14,
					    },
	                	gridLines : {
		               		display : false
		            	},
	                },
					{
						type:"linear", "id":"uniqueviews", display:true, position: "right",
						ticks: {
							beginAtZero: true,
							fontColor: "rgba(0, 144, 217, 1)",
							fontFamily: "Roboto, Arial",
						},
						scaleLabel: {
					        display: true,
					        labelString: 'Unikalne wyświetlenia',
					        fontColor: "rgba(0, 144, 217, 1)",
							fontFamily: "Roboto, Arial",
							fontStyle: "bold",
							fontSize: 14,
					    },
						gridLines : {
		               		display : false
		            	},
					},
					{
						type:"linear", "id":"conversion", display:true, position: "right",
						ticks: {
							beginAtZero: true,
							fontColor: "rgba(239, 190, 46, 1)",
							fontFamily: "Roboto, Arial",
							callback: function(value, index, values) {
								return values[index] + ' %';
							}
						},
						scaleLabel: {
					        display: true,
					        labelString: 'Konwersja',
					        fontColor: "rgba(239, 190, 46, 1)",
							fontFamily: "Roboto, Arial",
							fontStyle: "bold",
							fontSize: 14,
					    },
						gridLines : {
		               		display : false
		            	},
					},
					{
						type:"linear", "id":"lead", display:true, position: "left",
						ticks: {
							beginAtZero: true,
							fontColor: "rgba(76, 175, 80, 1)",
							fontFamily: "Roboto, Arial",
						},
						scaleLabel: {
					        display: true,
					        labelString: 'Leady',
					        fontColor: "rgba(76, 175, 80, 1)",
							fontFamily: "Roboto, Arial",
							fontSize: 14,
							fontStyle: "bold",
					    },
						gridLines : {
		               		display : true
		            	},
					},
		    		]
	  			},
	            tooltips: {
	                mode: 'label',
	                intersect: false,
	                titleFontSize: 16,
	                bodyFontSize: 14,
	                bodySpacing: 5,
	                bodyFontFamily: "Roboto, Arial",
	                titleFontFamily: "Roboto, Arial",
	                callbacks: {
	                	label: function(item, data) {
		                    var datasets = data.datasets[item.datasetIndex], 
		                    sufix = "", 
		                    label = datasets.label;

		                    if (label.search('Konwersja') == 0) {
		                        sufix = '%';
		                    }

		                    if (label.search('Zarobek') == 0) {
		                        sufix = ' zł';
		                    }

		                    var value = datasets.data[item.index];

		                    return  label + ': '+ value + sufix;
	                    }
	                }
	            }
        }
});
});
         
</script>
@endsection

@section('js')
<script src="{{ asset('assets/plugins/numberAnimate/animateNumber.min.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
@endsection