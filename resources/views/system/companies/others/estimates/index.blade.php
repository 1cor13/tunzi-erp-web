@extends('layouts.site')

@php( $page_name = 'Estimates' )

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
	@include('layouts.includes.side-hr')
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
			<a href="{{ route('estimates.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_estimate"><i class="fa fa-plus"></i> Add Estimate</a>
		</div>
	</div>
</div>
<!-- /Page Header -->
@include('layouts.includes.notifications')

<!-- Search Filter -->
<div class="row filter-row">
	<div class="col-sm-6 col-md-3">  
		<div class="form-group form-focus">
			<div class="cal-icon">
				<input class="form-control floating datetimepicker" type="text">
			</div>
			<label class="focus-label">From</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">  
		<div class="form-group form-focus">
			<div class="cal-icon">
				<input class="form-control floating datetimepicker" type="text">
			</div>
			<label class="focus-label">To</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3"> 
		<div class="form-group form-focus select-focus">
			<select class="select floating"> 
				<option>Select Status</option>
				<option>Accepted</option>
				<option>Declined</option>
				<option>Expired</option>
			</select>
			<label class="focus-label">Status</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">  
		<a href="#" class="btn btn-success btn-block"> Search </a>  
	</div>     
</div>
<!-- /Search Filter -->

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0 datatable">
				<thead>
					<tr>
						<th>Estimate Number</th>
						<th>Client</th>
						<th>Estimate Date</th>
						<th>Expiry Date</th>
						<th>Amount</th>
						<th>Status</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->estimates as $estimate)
					<tr>
						<td><a href="#">{{ $estimate->id }}</a></td>
						<td>{{ $estimate->client->first_name }} - {{ $estimate->client->last_name }}</td>
						<td>{{ $estimate->estimate_date }}</td>
						<td>{{ $estimate->expiry_date }}</td>
						<td>{{ $estimate->amount }}</td>
						<td><span class="badge bg-inverse-success">{{ $estimate->status }}</span></td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('estimates.edit',$estimate->id)}}" data-toggle="modal" data-target="#edit_estimate_{{ $estimate->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $estimate->id }}" data-toggle="modal" data-target="#delete_estimate_{{ $estimate->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Invoice Modal -->
							<div id="edit_estimate_{{ $estimate->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Estimate</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('estimates.update', $estimate->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Estimate Number</label>
															<input class="form-control" type="text" name="estimate_number" value="{{ $estimate->estimate_number ?? old('estimate_number') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Client</label>
															<select class="select" name="client_id">
																<option>Select</option>
																@foreach($data->clients as $client)
									                            <option value="{{ $client->id }}">
									                            	{{ $client->first_name }} - {{ $client->last_name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Project</label>
															 <select class="select" name="project_id">
															 	<option>Select</option>
                                                                @foreach($data->projects as $project)
                                                                <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                                                @endforeach
                                                            </select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Tax</label>
															 <select class="select" name="tax_id">
															 	<option>Select</option>
                                                                @foreach($data->taxes as $tax)
                                                                <option value="{{ $tax->id }}">{{ $tax->tax_name }}</option>
                                                                @endforeach
                                                            </select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Email</label>
															<input class="form-control" type="email" name="email" value="{{ $estimate->email ?? old('email') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Client Address</label>
															<input class="form-control" type="text" name="client_address" value="{{ $estimate->client_address ?? old('client_address') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Billing Address</label>
															<input class="form-control" type="text" name="billing_address" value="{{ $estimate->billing_address ?? old('billing_address') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Expiry Date</label>
															<input class="form-control" type="date" name="expiry_date" value="{{ $estimate->expiry_date ?? old('expiry_date') }}">
														</div>
													</div>
													<div class="col-md-12">
														<div class="show-fixed-amount">
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Item</label>
																		<input class="form-control" type="text" name="item" value="{{ $estimate->item ?? old('item') }}">
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="form-group">
																		<label>Description</label>
																		<textarea class="form-control" rows="4" name="description">
																			{{ $estimate->description ?? old('description') }}
																		</textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="show-basic-salary">
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Unit Cost</label>
																		<input class="form-control" type="text" name="unit_cost" value="{{ $estimate->unit_cost ?? old('unit_cost') }}">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Quantity</label>
																		<input class="form-control" type="text" name="quantity" value="{{ $estimate->quantity ?? old('quantity') }}">
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Amount <span class="text-danger">*</span></label>
															<input class="form-control" name="amount" type="text" value="{{ $estimate->amount ?? old('amount') }}">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Discount <span class="text-danger">*</span></label>
															<input class="form-control" name="discount" type="text" value="{{ $estimate->discount ?? old('discount') }}">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Status <span class="text-danger">*</span></label>
															<input class="form-control" name="status" type="text" value="{{ $estimate->status ?? old('status') }}">
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
							<!-- /Edit Estimate Modal -->

							<!-- Delete Estimate Modal -->
							<div class="modal custom-modal fade" id="delete_estimate_{{ $estimate->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Estimate</h3>
												<p>Are you sure want to delete {{ $estimate->estimate_number }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('estimates.destroy', $estimate->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $estimate->estimate_number }}\'s profile!')">Delete</button>
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
							<!-- /Delete Estimate Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Estimate Modal -->
<div id="add_estimate" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Estimate</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('estimates.store') }}" method="POST" autocomplete="off">
	            @csrf
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Estimate Number</label>
								<input class="form-control" type="text" name="estimate_number">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Client</label>
								<select class="select" name="client_id">
									@foreach($data->clients as $client)
		                            <option value="{{ $client->id }}">
		                            	{{ $client->first_name }} - {{ $client->last_name }}
		                            </option>
		                            @endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Project</label>
								 <select class="select" name="project_id">
                                    @foreach($data->projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Tax</label>
								 <select class="select" name="tax_id">
                                    @foreach($data->taxes as $tax)
                                    <option value="{{ $tax->id }}">{{ $tax->tax_name }}</option>
                                    @endforeach
                                </select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" type="email" name="email">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Client Address</label>
								<input class="form-control" type="text" name="client_address">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Billing Address</label>
								<input class="form-control" type="text" name="billing_address">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Expiry Date</label>
								<input class="form-control" type="date" name="expiry_date">
							</div>
						</div>
						<div class="col-md-12">
							<div class="show-fixed-amount">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Item</label>
											<input class="form-control" type="text" name="item">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Description</label>
											<textarea class="form-control" rows="4" name="description">
											</textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="show-basic-salary">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Unit Cost</label>
											<input class="form-control" type="text" name="unit_cost">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Quantity</label>
											<input class="form-control" type="text" name="quantity">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Amount <span class="text-danger">*</span></label>
								<input class="form-control" name="amount" type="text">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Discount <span class="text-danger">*</span></label>
								<input class="form-control" name="discount" type="text">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Status <span class="text-danger">*</span></label>
								<input class="form-control" name="status" type="text">
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
<!-- /Add Estimate Modal -->

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