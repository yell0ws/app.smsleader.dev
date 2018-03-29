@extends('layouts.base')

@section('title') {{ Setting::get('site_title') }} - FAQ @endsection

@section('content')
<div class="subheader tabs">
	<div class="background-pattern"></div>
	<div class="background-color"></div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
	<div class="content">
		<span class="title"><i class="ion-help-buoy lime"></i> Centrum <span class="subtitle">pomocy</span></span>
	</div>
	<div class="tabs">
		<a href="{{ route('support.contact') }}" class="{{ Request::is('support/contact') ? 'active' : '' }}">Formularz kontaktowy</a>
		<a href="{{ route('support.faq') }}" class="{{ Request::is('support/faq') ? 'active' : '' }}">Centrum pomocy</a>
	</div>
</div>
</div>
</div>
<div class="content">
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
	<div data-toggle="collapse" class="panel-group no-margin">
		  <div class="panel panel-default">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class="collapsed">
				  1. Czym różnią się modele płatności MO i MT?
				</a>
			  </h4>
			</div>
			<div class="panel-collapse collapse" id="collapseOne">
			  <div class="panel-body">
				 Click headers to expand/collapse content that is broken into logical sections, much like tabs. Optionally, toggle sections open/closed on mouseover. 
			  </div>
			</div>
		  </div>
		  <div class="panel panel-default">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="collapsed">
				  2. Czym różnią się modele płatności MO i MT?
				</a>
			  </h4>
			</div>
			<div class="panel-collapse collapse" id="collapseTwo">
			  <div class="panel-body">				
                  <h1 class="light">go explore the <span class="semi-bold">world</span></h1>
                  <h4>small things in life matters the most</h4>
                  <h2>Big Heading <span class="semi-bold">Body</span>, <i>Variations</i> </h2>
                  <h4><span class="semi-bold">Open Me</span>, Light , <span class="semi-bold">Bold</span> , <i>Everything</i></h4>
                  <p> is the art and technique of arranging type in order to make language visible. The arrangement of type involves the selection of typefaces, point size, line length, leading (line spacing), adjusting the spaces between groups of letters (tracking) </p>
                  <p>and adjusting the Case space between pairs of letters (kerning). Type design is a closely related craft, which some consider distinct and others a part of typography</p>
                
			  </div>
			</div>
		  </div>
		  <div class="panel panel-default">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a href="#collapseThree" data-parent="#accordion" data-toggle="collapse" class="collapsed">
				 3. Czym różnią się modele płatności MO i MT?
				</a>
			  </h4>
			</div>
			<div class="panel-collapse collapse" id="collapseThree">
			  <div class="panel-body">
				 Click headers to expand/collapse content that is broken into logical sections, much like tabs. Optionally, toggle sections open/closed on mouseover. 
			  </div>
			</div>
		  </div>
		</div>
	</div>
</div>
@endsection

@section('css')
@endsection

@section('js')
@endsection