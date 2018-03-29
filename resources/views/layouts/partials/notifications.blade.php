@if (session()->has('error'))
    <div class="alert alert-error alert-block">
        <p><i class="fa fa-exclamation-circle"></i> {!! session()->get('error') !!}</p>
    </div>
@endif

@if (session()->has('info'))
    <div class="alert alert-info alert-block">
        <p>{!! session()->get('info') !!}</p>
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success alert-block">
        <p><i class="fa fa-check-circle"></i> {!! session()->get('success') !!}</p>
    </div>
@endif