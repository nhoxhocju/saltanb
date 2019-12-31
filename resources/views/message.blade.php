@if(Session::has('message'))
    {{-- Message --}}
    <div class="col-md-12">
        <div class="alert alert-{{ session('type') }} alert-dismissible" role="alert">
            <h4><i class="icon fa fa-check"></i> {{ __('Alert!') }}</h4>
            <p><strong>{{ session('message') }}</strong></p>
        </div>
    </div>
@endif