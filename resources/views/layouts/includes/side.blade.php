@php
	$gen = Auth::user()->user_gender;
	$gender = '';

	if ( $gen ) {
		$gender = $gen->gender_name;
	}
@endphp
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li class="submenu nav-item nav-profile">
	              	<a href="{{ route('profile') }}" class="nav-link">
	                	<div class="nav-profile-image">
	                  		<img src="{{ asset(Auth::user()->image_path ? ('files/uploads/images/profiles/' . Auth::user()->image_path) : 'files/defaults/profiles/' . ( $gender == 'Female' ? 'female' : 'male' ) . '.jpg') }}" alt="profile" onclick="window.open('{{ route('profile') }}', '_self')">
	                  	</div>
	                	<div class="nav-profile-text d-flex flex-column" onclick="window.open('{{ route('profile') }}', '_self')">
	                  		<p class="font-weight-bold pl-2 pr-2">{{ Auth::user()->name }}</p>
	                  		<p class="text-white text-small pt-2 pl-2" style="min-width: 80px; font-size: 11px;">{{ Auth::user()->userRole() }}</p>
	                	</div>
	                	<i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
	              	</a>
	            </li>
	            <li class="submenu">
	            	<a href="javascript:void(0);">
	            		<div class="nav-profile-text d-flex flex-column" style="width: 100%;">
	            			<span class="text-white text-small">
	                  			<small><span>{{ date('d / m / Y') }}</span> <span id="MyClockDisplay"></span> </small>
	                  		</span>
	            		</div>
	            	</a>
	            </li>
				<li class="menu-title"> 
					<span>Main</span>
				</li>
				@role(['super-admin','admin'])
					<li class="submenu">
						<a href="javascript:void(0);"><i class="la la-dashboard"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							<li><a href="{{ route('admin') }}" @if(in_array(Request::fullUrl(), [route('admin')])) class="active open" @endif>Admin Dashboard</a></li>
							<li><a href="{{ route('userhome') }}" @if(in_array(Request::fullUrl(), [route('userhome')])) class="active open" @endif>User Home</a></li>
						</ul>
					</li>
				@else
					<li @if(in_array(Request::fullUrl(), [route('home'), route('admin'), route('userhome')])) class="active open" @endif>
			            <a href="{{ route('home') }}" @if(in_array(Request::fullUrl(), [route('home'), route('admin'), route('userhome')])) class="active open" @endif>
			                <i class="la la-home"></i>
			                <span>Home</span>
			            </a>
			        </li>  
				@endrole
				{{-- <li>
					<a href="{{ route('messages.index', 'inbox') }}"><i class="la la-cube"></i> <span>My Inbox</span></a>
				</li> --}}
				@permission('view_company_list')
				<li>
					<a href="{{ route('companies.index') }}"><i class="la la-campground"></i> <span>Companies</span></a>
				</li>
				@endpermission
				@if( !empty(Auth::user()->userCompanies()) )
				<li>
					<a href="{{ route('companies.show', Auth::user()->userCompanies()[0]->id) }}"><i class="la la-campground"></i> <span>My Company</span></a>
				</li>
				@endif
				<li>
					<a href="{{ route('products.index') }}"><i class="la la-product-hunt"></i>  <span>Inventory</span></a>
				</li>
				{{-- <li>
					<a href="{{ route('stores.index') }}"><i class="la la-store"></i> <span>Stores</span></a>
				</li> --}}
				{{-- <li>
					<a href="{{ route('employees.index') }}"><i class="la la-users"></i> <span>Employees</span></a>
				</li> --}}
				<li>
					<a href="{{ route('customers.index') }}"><i class="la la-money-bill"></i> <span>Sales</span></a>
				</li>
				{{-- <li>
					<a href="{{ route('payments.index') }}"><i class="la la-shopping-cart"></i>  <span>Purchases</span></a>
				</li> --}}
				{{-- <li>
					<a href="{{ route('projects.index') }}"><i class="la la-rocket"></i>  <span>Projects</span></a>
				</li> --}}
				<li> 
					<a href="{{ route('accounts.index') }}"><i class="la la-briefcase"></i> <span>Accounts</span></a>
				</li>
				{{-- <li> 
					<a href="{{ route('policies.index') }}"><i class="la la-file-pdf-o"></i> <span>Policies</span></a>
				</li> --}}
				<li> 
					<a href="{{ route('reports.index') }}"><i class="la la-chart-pie"></i> <span>Reports</span></a>
				</li>
				{{-- <li> 
					<a href="{{ route('goals.index') }}"><i class="la la-graduation-cap"></i> <span>Performance</span></a>
				</li> --}}
				<li> 
					<a href="{{ route('users.index') }}"><i class="la la-user-plus"></i> 
						<span>Administration</span></a>
				</li>
				<li> 
					<a href="{{ route('settings.index') }}"><i class="la la-gear la-spin"></i>  <span>Settings</span></a>
				</li>
			</ul>
		</div>
    </div>
</div>