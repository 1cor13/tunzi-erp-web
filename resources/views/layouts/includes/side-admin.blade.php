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
						@if(in_array(URL::previous(), [route('users.index'),route('roles.index'), route('permissions.index')]))
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
					<span>Administration</span>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('users.index')])) class="active open" @endif>
					<a href="{{ route('users.index') }}">
						<i class="la la-user-plus"></i>
						<span> Users </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('teams.index')])) class="active open" @endif>
					<a href="{{ route('teams.index') }}">
						<i class="la la-group"></i>
						<span> Teams </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('roles.index')])) class="active open" @endif>
					<a href="{{ route('roles.index') }}">
						<i class="la la-object-ungroup"></i>
						<span> Roles </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('permissions.index')])) class="active open" @endif>
					<a href="{{ route('permissions.index') }}">
						<i class="la la-object-ungroup"></i>
						<span> Permissions </span>
					</a>
				</li>
			</ul>
		</div>
    </div>
</div>