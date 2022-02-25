<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
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
						@if(in_array(URL::previous(), [route('companies.index'), route('employees.index'),route('holidays.index'),route('leavetypes.index'),route('leaves.index'),route('departments.index'),route('designations.index'), route('promotions.index'), route('resignations.index'), route('terminationtypes.index'), route('terminations.index'),  route('timesheets.index'),route('overtimes.index'), route('salaries.index'), route('stores.index')]))
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
					<span>Company Mgt</span>
				</li>
				<!-- <li>
					<a href="javascript:void(0);">
						<i class="la la-building"></i>
						<span> Company Profile </span>
					</a>
				</li> -->
				<li>
					<a href="{{ route('companies.index') }}">
						<i class="la la-building"></i>
						<span> Manage Companies </span>
					</a>
				</li>

				<li class="menu-title"> 
					<span>Employee Mgt</span>
				</li>

				<li class="submenu">
					<a href="javascript:void(0);"><i class="la la-users"></i> <span> Listings</span> <span class="menu-arrow"></span></a>
					<ul>
						<li>
							<a href="{{ route('employees.index') }}" @if(in_array(Request::fullUrl(), [route('employees.index')])) class="active open" @endif>
								<i class="la la-users"></i> 
								<span> Employees </span>
							</a>
						</li>
						<li>
							<a href="{{ route('departments.index') }}" @if(in_array(Request::fullUrl(), [route('departments.index')])) class="active open" @endif>
								<i class="la la-building"></i> 
								<span> Departments </span>
							</a>
						</li>
						<li>
							<a href="{{ route('salaries.index') }}" @if(in_array(Request::fullUrl(), [route('salaries.index')])) class="active open" @endif>
								<i class="la la-money-bill"></i> 
								<span> Salary </span>
							</a>
						</li>
					</ul>
				</li>

				<li class="submenu">
					<a href="javascript:void(0);"><i class="la la-users"></i> <span> Metrics</span> <span class="menu-arrow"></span></a>
					<ul>
						<li>
							<a href="{{ route('holidays.index') }}" @if(in_array(Request::fullUrl(), [route('holidays.index')])) class="active open" @endif>
								<i class="la la-candy-cane"></i> 
								<span> Holidays </span>
							</a>
						</li>
						<li>
							<a href="{{ route('leaves.index') }}" @if(in_array(Request::fullUrl(), [route('leaves.index')])) class="active open" @endif>
								<i class="la la-plane"></i> 
								<span> Leaves </span>
							</a>
						</li>
						<li>
							<a href="{{ route('designations.index') }}" @if(in_array(Request::fullUrl(), [route('designations.index')])) class="active open" @endif>
								<i class="la la-plane"></i> 
								<span> Designations </span>
							</a>
						</li>
						<li>
							<a href="{{ route('promotions.index') }}" @if(in_array(Request::fullUrl(), [route('promotions.index')])) class="active open" @endif>
								<i class="la la-star"></i> 
								<span> Promotions </span>
							</a>
						</li>
						<li>
							<a href="{{ route('resignations.index') }}" @if(in_array(Request::fullUrl(), [route('resignations.index')])) class="active open" @endif>
								<i class="la la-plane"></i> 
								<span> Resignations </span>
							</a>
						</li>
						<li>
							<a href="{{ route('terminations.index') }}" @if(in_array(Request::fullUrl(), [route('terminations.index')])) class="active open" @endif>
								<i class="la la-plane-arrival"></i> 
								<span> Terminations </span>
							</a>
						</li>
						<li>
							<a href="{{ route('timesheets.index') }}" @if(in_array(Request::fullUrl(), [route('timesheets.index')])) class="active open" @endif>
								<i class="la la-user-times"></i> 
								<span> TimeSheets </span>
							</a>
						</li>
						<li>
							<a href="{{ route('overtimes.index') }}" @if(in_array(Request::fullUrl(), [route('overtimes.index')])) class="active open" @endif>
								<i class="la la-user-times"></i> 
								<span> Over Time </span>
							</a>
						</li>
						
					</ul>
				</li>

				<li class="submenu">
					<a href="javascript:void(0);"><i class="la la-users"></i> <span> Settings</span> <span class="menu-arrow"></span></a>
					<ul>
						<li>
							<a href="{{ route('leavetypes.index') }}" @if(in_array(Request::fullUrl(), [route('leavetypes.index')])) class="active open" @endif>
								<i class="la la-plane"></i> 
								<span> Leave Types </span>
							</a>
						</li>
						<li>
							<a href="{{ route('terminationtypes.index') }}" @if(in_array(Request::fullUrl(), [route('terminationtypes.index')])) class="active open" @endif>
								<i class="la la-plane-arrival"></i> 
								<span> Termination Types </span>
							</a>
						</li>
					</ul>
				</li>

				<li class="menu-title"> 
					<span>Store Mgt</span>
				</li>

				<li>
					<a href="{{ route('stores.index') }}"><i class="la la-store"></i><span> Warehouse / Stores </span></a>
				</li>
			</ul>
		</div>
    </div>
</div>