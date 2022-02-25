<div class="not-cont">
	@guest
		@if($message = Session::get('danger'))
			<div class="alert alert-danger alert-d-message" style="margin: 10px;">
				<i class="la la-times-circle"></i> : {{ $message }}
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
			    	<span aria-hidden="true" style="font-size: 25px;">&times;</span> 
			    </button>
			</div>
		@endif
		@if($message = Session::get('warning'))
			<div class="alert alert-warning alert-d-message" style="margin: 10px;">
				<i class="la la-info-circle"></i> : <b>{{ $message }}</b>
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    	<span aria-hidden="true" style="font-size: 25px;">&times;</span> 
			    </button>
			</div>
		@endif
		@if($message = Session::get('success'))
			<div class="alert alert-success alert-d-message" style="margin: 10px;">
				<i class="la la-check"></i> : <b>{{ $message }}</b>
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
			    	<span aria-hidden="true" style="font-size: 25px;">&times;</span> 
			    </button>
			</div>
		@endif
		@if($message = Session::get('info'))
			<div class="alert alert-info alert-d-message" style="margin: 10px;">  
				<i class="la la-lightbulb"></i> : <b>{{ $message }}</b>
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
			    	<span aria-hidden="true" style="font-size: 25px;">&times;</span> 
			    </button>
			</div>
		@endif
		{{-- end of unauthenticated --}}
	@else
		@php
			$gen = Auth::user()->user_gender; $gender = '';
			if ( $gen ) { $gender = $gen->gender_name; }
		@endphp
		@if($message = Session::get('danger'))
			<div class="alert alert-danger alert-d-message" style="margin: 10px;"> 
				<img src="{{ asset(Auth::user()->image_path ? ('files/uploads/images/profiles/' . Auth::user()->image_path) : 'files/defaults/profiles/' . ( $gender == 'Female' ? 'female' : 'male' ) . '.jpg') }}" width="30" class="rounded-circle" alt="img"> 
				<i class="fa fa-times-circle"></i> : {{ $message }}
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
			    	<span aria-hidden="true" style="font-size: 25px;">&times;</span> 
			    </button>
			</div>
		@endif
		@if($message = Session::get('warning'))
			<div class="alert alert-warning alert-d-message" style="margin: 10px;"> 
				<img src="{{ asset(Auth::user()->image_path ? ('files/uploads/images/profiles/' . Auth::user()->image_path) : 'files/defaults/profiles/' . ( $gender == 'Female' ? 'female' : 'male' ) . '.jpg') }}" width="30" class="rounded-circle" alt="img"> 
				<i class="fa fa-info-circle"></i> : <b>{{ $message }}</b>
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    	<span aria-hidden="true" style="font-size: 25px;">&times;</span> 
			    </button>
			</div>
		@endif
		@if($message = Session::get('success'))
			<div class="alert alert-success alert-d-message" style="margin: 10px;"> 
				<img src="{{ asset(Auth::user()->image_path ? ('files/uploads/images/profiles/' . Auth::user()->image_path) : 'files/defaults/profiles/' . ( $gender == 'Female' ? 'female' : 'male' ) . '.jpg') }}" width="30" class="rounded-circle" alt="img"> 
				<i class="fa fa-check"></i> : <b>{{ $message }}</b>
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
			    	<span aria-hidden="true" style="font-size: 25px;">&times;</span> 
			    </button>
			</div>
		@endif
		@if($message = Session::get('info'))
			<div class="alert alert-info alert-d-message" style="margin: 10px;"> 
				<img src="{{ asset(Auth::user()->image_path ? ('files/uploads/images/profiles/' . Auth::user()->image_path) : 'files/defaults/profiles/' . ( $gender == 'Female' ? 'female' : 'male' ) . '.jpg') }}" width="30" class="rounded-circle" alt="img"> 
				<i class="fa fa-lightbulb"></i> : <b>{{ $message }}</b>
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
			    	<span aria-hidden="true" style="font-size: 25px;">&times;</span> 
			    </button>
			</div>
		@endif
	@endguest
</div>