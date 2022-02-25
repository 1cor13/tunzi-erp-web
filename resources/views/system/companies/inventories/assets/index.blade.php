@extends('layouts.site')

@php( $page_name = 'Assets' )

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
	@include('layouts.includes.side-inventory')
@endsection
@section('content')
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
			<a href="{{ route('assets.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_asset"><i class="fa fa-plus"></i> Add Asset</a>
		</div>
	</div>
</div>
@include('layouts.includes.notifications')

<!-- Search Filter -->
<div class="row filter-row">
	<div class="col-sm-6 col-md-3">  
		<div class="form-group form-focus">
			<input type="text" class="form-control floating">
			<label class="focus-label">Employee Name</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3"> 
		<div class="form-group form-focus select-focus">
			<select class="select floating"> 
				<option value=""> -- Select -- </option>
				<option value="0"> Pending </option>
				<option value="1"> Approved </option>
				<option value="2"> Returned </option>
			</select>
			<label class="focus-label">Status</label>
		</div>
	</div>
	<div class="col-sm-12 col-md-4">  
	   <div class="row">  
		   <div class="col-md-6 col-sm-6">  
				<div class="form-group form-focus">
					<div class="cal-icon">
						<input class="form-control floating datetimepicker" type="text">
					</div>
					<label class="focus-label">From</label>
				</div>
			</div>
		   <div class="col-md-6 col-sm-6">  
				<div class="form-group form-focus">
					<div class="cal-icon">
						<input class="form-control floating datetimepicker" type="text">
					</div>
					<label class="focus-label">To</label>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-md-2">  
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
						<th>#</th>
						<th>Asset User</th>
						<th>Asset Name</th>
						<th>Purchase Date</th>
						<th>Purchase From</th>
						<th>Warranty</th>
						<th>Amount</th>
						<th class="text-center">Status</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->assets as $asset)
					<tr>
						<td>{{ $asset->id }}</td>
						<td>{{ $asset->user->name }}</td>
						<td>
							<strong>{{ $asset->asset_name }}</strong>
						</td>
						<td>{{ $asset->purchase_date }}</td>
						<td>{{ $asset->purchase_from }}</td>
						<td>{{ $asset->warranty }}</td>
						<td>{{ $asset->value }}</td>
						<td>{{ $asset->status }}</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('assets.edit',$asset->id)}}" data-toggle="modal" data-target="#edit_asset_{{ $asset->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_asset_{{ $asset->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Asset Modal -->
							<div id="edit_asset_{{ $asset->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-md" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Asset</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('assets.update', $asset->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Asset Name</label>
															<input class="form-control" type="text" name="asset_name" value="{{ $asset->asset_name ?? old('asset_name') }}">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Purchase Date</label>
															<input class="form-control" type="date" name="purchase_date" value="{{ $asset->purchase_date ?? old('purchase_date') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Purchase From</label>
															<input class="form-control" type="text" name="purchase_from" value="{{ $asset->purchase_from ?? old('purchase_from') }}">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Manufacturer</label>
															<input class="form-control" type="text" name="manufacturer" value="{{ $asset->manufacturer ?? old('manufacturer') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Model</label>
															<input class="form-control" type="text" name="model" value="{{ $asset->model ?? old('model') }}">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Serial Number</label>
															<input class="form-control" type="text" name="serial_number" value="{{ $asset->serial_number ?? old('serial_number') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Supplier</label>
															<input class="form-control" type="text" name="supplier" value="{{ $asset->supplier ?? old('supplier') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Condition</label>
															<input class="form-control" type="text" name="condition" value="{{ $asset->condition ?? old('condition') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Warranty</label>
															<input class="form-control" type="text" placeholder="In Months" name="warranty" value="{{ $asset->warranty ?? old('warranty') }}">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Value</label>
															<input placeholder="$1800" class="form-control" type="text" name="value" value="{{ $asset->value ?? old('value') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Asset User</label>
															<select class="select" name="user_id">
																<option>Select</option>
																@foreach($data->users as $user)
									                            <option value="{{ $user->id }}">
									                            	{{ $user->name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Description</label>
															<textarea class="form-control" name="description">
																{{ $asset->description ?? old('description') }}
															</textarea>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Status <span class="text-danger">*</span></label>
															<input class="form-control" type="text" name="status" value="{{ $asset->status ?? old('status') }}">
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
							<!-- Edit Asset Modal -->

							<!-- Delete Asset Modal -->
							<div class="modal custom-modal fade" id="delete_asset_{{ $asset->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Asset</h3>
												<p>Are you sure want to delete {{ $asset->asset_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('assets.destroy', $asset->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $asset->asset_name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Asset Modal -->

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Asset Modal -->
<div id="add_asset" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Asset</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('assets.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Asset Name</label>
							<input class="form-control" type="text" name="asset_name">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Purchase Date</label>
							<input class="form-control" type="date" name="purchase_date">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Purchase From</label>
							<input class="form-control" type="text" name="purchase_from">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Manufacturer</label>
							<input class="form-control" type="text" name="manufacturer">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Model</label>
							<input class="form-control" type="text" name="model">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Serial Number</label>
							<input class="form-control" type="text" name="serial_number">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Supplier</label>
							<input class="form-control" type="text" name="supplier">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Condition</label>
							<input class="form-control" type="text" name="condition">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Warranty</label>
							<input class="form-control" type="text" placeholder="In Months" name="warranty">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Value</label>
							<input placeholder="$1800" class="form-control" type="text" name="value">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Asset User</label>
							<select class="select" name="user_id">
								@foreach($data->users as $user)
	                            <option value="{{ $user->id }}">
	                            	{{ $user->name }}
	                            </option>
	                            @endforeach
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="description">
							</textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Status <span class="text-danger">*</span></label>
							<input class="form-control" type="text" name="status">
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
<!-- /Add Asset Modal -->

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