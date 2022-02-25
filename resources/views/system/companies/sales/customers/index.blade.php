@extends('layouts.site')

@php( $page_name = 'Customers' )

@section('title', $page_name)
@section('styles')
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">

@endsection
@section('sidebar')
	 @include('layouts.includes.side-sales')
@endsection
@section('content')
<!-- Page Header -->
<div class="page-header">
	<div class="row align-items-center">
		<div class="col">
			<h3 class="page-title">{{ $page_name }}</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
				<li class="breadcrumb-item active">{{ $page_name }}</li>
			</ul>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="{{ route('customers.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_customer"><i class="fa fa-plus"></i> Add Customer</a>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="#" class="btn add-btn" data-toggle="modal"> Import</a>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="#" class="btn add-btn" data-toggle="modal"> Export</a>
		</div>
	</div>
</div>
<!-- /Page Header -->

@include('layouts.includes.notifications')

<!-- Search Filter -->
<div class="row filter-row">
	<div class="col-sm-6 col-md-3">  
		<div class="form-group form-focus">
			<input type="text" class="form-control floating">
			<label class="focus-label">Customer ID</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">  
		<div class="form-group form-focus">
			<input type="text" class="form-control floating">
			<label class="focus-label">Customer Name</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3"> 
		<div class="form-group form-focus select-focus">
			<select class="select floating"> 
				<option>Select Currency</option>
				<option>USD</option>
				<option>UGX</option>
			</select>
			<label class="focus-label">Currency</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">  
		<a href="#" class="btn btn-success btn-block"> Search </a>  
	</div>     
</div>
<!-- Search Filter -->

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0 datatable">
				<thead>
					<tr>
						<th>#</th>
						<th>Names </th>
						<th>Email </th>
						<th>Phone</th>
						<th>Status</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->customers as $customer)
					<tr>
						<td>{{ $customer->id }}</td>
						<td>
							<h2 class="table-avatar blue-link">
								<a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
								<a href="#">{{ $customer->name }}</a>
							</h2>
						</td>
						<td>{{ $customer->email }}</td>
						<td>{{ $customer->phone }}</td>
						<td>
							@if($customer->status=='active')
                            <span class="badge badge-success">{{$customer->status}}</span>
	                        @else
	                            <span class="badge badge-warning">{{$customer->status}}</span>
	                        @endif
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('customers.edit',$customer->id)}}" data-toggle="modal" data-target="#edit_customer_{{ $customer->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $customer->id }}" data-toggle="modal" data-target="#delete_customer_{{ $customer->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Customer Modal -->
							<div id="edit_customer_{{ $customer->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Customer</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('customers.update', $customer->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-form-label">Name <span class="text-danger">*</span></label>
															<input class="form-control" name="name" type="text" value="{{ $customer->name ?? old('name') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-form-label">Email <span class="text-danger">*</span></label>
															<input class="form-control floating" name="email" type="email" value="{{ $customer->email ?? old('email') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-form-label">Tax Number <span class="text-danger">*</span></label>
															<input class="form-control floating" name="tax_number" type="text" value="{{ $customer->tax_number ?? old('tax_number') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-form-label">Phone </label>
															<input class="form-control" name="phone" type="text" value="{{ $customer->phone ?? old('phone') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-form-label">Website </label>
															<input class="form-control" name="website" type="text" value="{{ $customer->website ?? old('website') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-form-label">Address </label>
															<input class="form-control" name="address" type="text" value="{{ $customer->address ?? old('address') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-form-label">Reference </label>
															<input class="form-control" name="reference" type="text" value="{{ $customer->reference ?? old('reference') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-form-label">Password</label>
															<input class="form-control" name="password" type="password" value="{{ $customer->password ?? old('password') }}">
														</div>
													</div>
													<div class="form-group">
							                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
							                          <select name="status" class="form-control">
							                              <option value="active"  {{(($customer->status=='active')? 'selected' : '')}}>Active</option>
							                              <option value="inactive" {{(($customer->status=='inactive')? 'selected' : '')}}>Inactive</option>
							                          </select>
							                        </div>
													
													<div class="col-md-6">
														<div class="form-group">
															<label>Currency <span class="text-danger">*</span></label>
															<select class="select" name="currency_id">
																@foreach($data->currencies as $currency)
									                            <option value="{{ $currency->id }}">
									                            	{{ $currency->name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Save</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- /Edit Customer Modal -->

							<!-- Delete Customer Modal -->
							<div class="modal custom-modal fade" id="delete_customer_{{ $customer->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Customer</h3>
												<p>Are you sure want to delete {{ $customer->name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('customers.destroy', $customer->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $customer->name }}\'s profile!')">Delete</button>
							                            </form>
													</div>
													<div class="col-6">
														<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Delete Customer Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Customer Modal -->
<div id="add_customer" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Customer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('customers.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Name <span class="text-danger">*</span></label>
								<input class="form-control" name="name" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Email <span class="text-danger">*</span></label>
								<input class="form-control floating" name="email" type="email">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Tax Number <span class="text-danger">*</span></label>
								<input class="form-control floating" name="tax_number" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Phone </label>
								<input class="form-control" name="phone" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Website </label>
								<input class="form-control" name="website" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Address </label>
								<input class="form-control" name="address" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Reference </label>
								<input class="form-control" name="reference" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Password</label>
								<input class="form-control" name="password" type="password">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
					            <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
					            <select name="status" class="form-control">
					                <option value="active">Active</option>
					                <option value="inactive">Inactive</option>
					            </select>
					        </div>
					    </div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Currency <span class="text-danger">*</span></label>
								<select class="select" name="currency_id">
									@foreach($data->currencies as $currency)
		                            <option value="{{ $currency->id }}">
		                            	{{ $currency->name }}
		                            </option>
		                            @endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="submit-section">
						<button type="submit" class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Customer Modal -->

@endsection
@section('scripts')
<!-- Select2 JS -->
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<!-- Datetimepicker JS -->
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- Datatable JS -->
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

@endsection