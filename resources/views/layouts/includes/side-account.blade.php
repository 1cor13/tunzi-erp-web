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
						@if(in_array(URL::previous(), [route('accounts.index'), route('transfers.index'), route('transactions.index'),route('bills.index'), route('payments.index'),route('vendors.index'), route('taxes.index'), route('invoices.index'), route('revenues.index')]))
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
					<span>Accounting Mgt</span>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('accounts.index')])) class="active open" @endif>
					<a href="{{ route('accounts.index') }}">
						<i class="la la-file"></i>
						<span> Accounts </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('transfers.index')])) class="active open" @endif>
					<a href="{{ route('transfers.index') }}">
						<i class="la la-file"></i>
						<span> Transfers </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('transactions.index')])) class="active open" @endif>
					<a href="{{ route('transactions.index') }}">
						<i class="la la-file"></i>
						<span> Transactions </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('bills.index')])) class="active open" @endif>
					<a href="{{ route('bills.index') }}">
						<i class="la la-money-bill-wave"></i>
						<span> Bills</span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('payments.index')])) class="active open" @endif>
					<a href="{{ route('payments.index') }}">
						<i class="la la-wallet"></i>
						<span> Payments</span>
					</a>
				</li>
				<li @if(in_array(Request::fullUrl(), [route('vendors.index')])) class="active open" @endif>
					<a href="{{ route('vendors.index') }}">
						<i class="la la-users"></i>
						<span>Vendors </span>
					</a>
				</li>
				<li @if(in_array(Request::fullUrl(), [route('taxes.index')])) class="active open" @endif>
					<a href="{{ route('taxes.index') }}">
						<i class="la la-percentage"></i>
						<span>Taxes </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('invoices.index')])) class="active open" @endif>
					<a href="{{ route('invoices.index') }}">
						<i class="la la-file-invoice"></i>
						<span> Invoice</span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('revenues.index')])) class="active open" @endif>
					<a href="{{ route('revenues.index') }}">
						<i class="la la-money"></i>
						<span> Revenue</span>
					</a>
				</li>
			</ul>
		</div>
    </div>
</div>