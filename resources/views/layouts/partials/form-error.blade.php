@if ($errors->any())
    <div class="alert alert-danger">
    	@php($nn = sizeof($errors->all()))
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
	    	<span aria-hidden="true" style="font-size: 25px;">&times;</span> 
	    </button>
        @foreach ($errors->all() as $error)
            <i class="fa fa-times-circle"></i> {{ $error }} @if( (int) $nn > 1 )<hr>@endif
            @php((int) $nn -= 1)
        @endforeach
    </div>
@endif