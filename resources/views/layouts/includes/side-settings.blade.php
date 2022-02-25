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
						@if(in_array(URL::previous(), [route('categories.index'), route('settings.index'), route('currencies.index'), route('settings.index')]))
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
					<span>Settings</span>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('categories.index')])) class="active open" @endif>
					<a href="{{ route('categories.index') }}">
						<i class="la la-folder"></i> 
						<span> Categories </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('currencies.index')])) class="active open" @endif>
					<a href="{{ route('currencies.index') }}">
						<i class="la la-dollar"></i> 
						<span> Currencies </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('countries.index')])) class="active open" @endif>
					<a href="{{ route('countries.index') }}">
						<i class="la la-map-marker"></i> 
						<span> Countries </span>
					</a>
				</li>
			</ul>
		</div>
    </div>
</div>