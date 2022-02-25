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
						@if(in_array(URL::previous(), [route('shops.index'),route('branches.index'),route('products.index', 'all'), route('products.index', 'in-shop'), route('products.index', 'in-store'), route('products.index', 'in-transit'), route('assets.index')]))
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
					<span>Inventory Mgt</span>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('products.index', 'all')])) class="active open" @endif>
					<a href="{{ route('products.index', 'all') }}">
						<i class="la la-product-hunt"></i> 
						<span> Products </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('shops.index')])) class="active open" @endif>
					<a href="{{ route('shops.index') }}">
						<i class="la la-book-reader"></i> 
						<span> Shops </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('branches.index')])) class="active open" @endif>
					<a href="{{ route('branches.index') }}">
						<i class="la la-code-branch"></i> 
						<span> Store Fronts / Branches </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('products.index', 'in-shop')])) class="active open" @endif>
					<a href="{{ route('products.index', 'in-shop') }}">
						<i class="la la-product-hunt"></i> 
						<span> Shop Products </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('products.index', 'in-store')])) class="active open" @endif>
					<a href="{{ route('products.index', 'in-store') }}">
						<i class="la la-product-hunt"></i> 
						<span> Store Products </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('products.index', 'in-transit')])) class="active open" @endif>
					<a href="{{ route('products.index', 'in-transit') }}">
						<i class="la la-product-hunt"></i> 
						<span> Transit Products </span>
					</a>
				</li>
				<li  @if(in_array(Request::fullUrl(), [route('assets.index')])) class="active open" @endif>
					<a href="{{ route('assets.index') }}">
						<i class="la la-list"></i> 
						<span> Assets </span>
					</a>
				</li>
			</ul>
		</div>
    </div>
</div>