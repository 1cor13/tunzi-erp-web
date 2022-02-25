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
						@if(in_array(URL::previous(), [route('messages.index', 'inbox'),route('messages.index', 'starred'),route('messages.index', 'sent'),route('messages.index', 'draft'),route('messages.index', 'trash'),route('messages.index', 'normal'),route('messages.index', 'urgent'),route('messages.index', 'important'),route('messages.index', 'official'),route('messages.index', 'unofficial')]))
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
				<li  @if(in_array(Request::fullUrl(), [route('messages.index', 'inbox')])) class="active open" @endif>
					<a href="{{ route('messages.index', 'inbox') }}">
						<i class="la la-inbox"></i> 
						<span> Inbox </span>
						<span class="badge badge-pill bg-primary float-right mail-count">2</span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('messages.index', 'starred')])) class="active open" @endif>
					<a href="{{ route('messages.index', 'starred') }}">
						<i class="la la-star"></i> 
						<span> Starred </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('messages.index', 'sent')])) class="active open" @endif>
					<a href="{{ route('messages.index', 'sent') }}">
						<i class="la la-send"></i> 
						<span> Sent </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('messages.index', 'draft')])) class="active open" @endif>
					<a href="{{ route('messages.index', 'draft') }}">
						<i class="la la-folder"></i> 
						<span> Draft </span>
						<span class="badge badge-pill bg-primary float-right mail-count">8</span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('messages.index', 'trash')])) class="active open" @endif>
					<a href="{{ route('messages.index', 'trash') }}">
						<i class="la la-trash"></i> 
						<span> Trash </span>
					</a>
				</li>
				<li class="menu-title">Label <a href="javascript:void(0);"><i class="fa fa-plus"></i></a></li>
				<li  @if(in_array(Request::fullUrl(), [route('messages.index', 'normal')])) class="active open" @endif>
					<a href="{{ route('messages.index', 'normal') }}"><i class="fa fa-circle text-success mail-label"></i> Normal</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('messages.index', 'urgent')])) class="active open" @endif>
					<a href="{{ route('messages.index', 'urgent') }}"><i class="fa fa-circle text-danger mail-label"></i> Urgent</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('messages.index', 'important')])) class="active open" @endif>
					<a href="{{ route('messages.index', 'important') }}"><i class="fa fa-circle text-warning mail-label"></i> Important</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('messages.index', 'official')])) class="active open" @endif>
					<a href="{{ route('messages.index', 'official') }}"><i class="fa fa-circle text-primary mail-label"></i> Official</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('messages.index', 'unofficial')])) class="active open" @endif>
					<a href="{{ route('messages.index', 'unofficial') }}"><i class="fa fa-circle text-secondary mail-label"></i> Unofficial</a>
				</li>
			</ul>
		</div>
    </div>
</div>