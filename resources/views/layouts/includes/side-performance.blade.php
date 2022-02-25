<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
		<div class="sidebar-menu">
			<ul>
				<li class="submenu">
	            	<a href="javascript:void(0);">
	            		<div class="nav-profile-text d-flex flex-column" style="width: 100%;">
	            			<span class="text-white text-small">
	                  			<small><span>{{ date('d / m / Y') }}</span> <span id="MyClockDisplay"></span> </small>
	                  		</span>
	            		</div>
	            	</a>
	            </li>
				<li>
					@if(URL::previous() != Request::fullUrl())
						@if(in_array(URL::previous(), [route('goals.index'), route('goaltypes.index'), route('trainings.index'), route('trainers.index'),route('trainingtypes.index'),route('jobs.index'),route('jobtypes.index'), route('jobapplicants.index')]))
						<div class="col-12 row m-0 p-0">
							<div class="col-6 m-0 pr-0 pl-0 pb-2">
								<a href="{{ URL::previous() }}"><i class="la la-arrow-left" style="font-size: 15px;"></i> <small>Back</small></a>
							</div>
							<div class="col-6 m-0 pr-0 pl-0 pb-2">
								<a href="{{ route('home') }}"><i class="la la-home" style="font-size: 15px;"></i> <small>Home</small></a>
							</div>
						</div>
						@else
						<a href="{{ URL::previous() }}"><i class="la la-arrow-left"></i> <span>Go Back</span></a>
						@endif
					@else
					<a href="{{ route('home') }}"><i class="la la-home"></i> <span>Back to Home</span></a>
					@endif
				</li>
				<li class="menu-title"> 
					<span>Performance Mgt</span>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('goals.index')])) class="active open" @endif>
					<a href="{{ route('goals.index') }}">
						<i class="la la-crosshairs"></i> 
						<span> Goals </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('goaltypes.index')])) class="active open" @endif>
					<a href="{{ route('goaltypes.index') }}">
						<i class="la la-crosshairs"></i>
						<span> Goal Types </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('trainings.index')])) class="active open" @endif>
					<a href="{{ route('trainings.index') }}">
						<i class="la la-edit"></i> 
						<span> Training </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('trainers.index')])) class="active open" @endif>
					<a href="{{ route('trainers.index') }}">
						<i class="la la-edit"></i>
						<span> Trainers </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('trainingtypes.index')])) class="active open" @endif>
					<a href="{{ route('trainingtypes.index') }}">
						<i class="la la-edit"></i> 
						<span> Training Type </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('jobtypes.index')])) class="active open" @endif>
					<a href="{{ route('jobtypes.index') }}">
						<i class="la la-briefcase"></i>
						<span> Job Type </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('jobs.index')])) class="active open" @endif>
					<a href="{{ route('jobs.index') }}">
						<i class="la la-briefcase"></i>
						<span> Jobs </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('jobapplicants.index')])) class="active open" @endif>
					<a href="{{ route('jobapplicants.index') }}">
						<i class="la la-briefcase"></i> 
						<span> Applied Candidates </span>
					</a>
				</li>
			</ul>
		</div>
    </div>
</div>