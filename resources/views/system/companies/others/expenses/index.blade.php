@extends('layouts.site')

@php( $page_name = 'Expenses' )

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
			<a href="{{ route('expenses.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_expense"><i class="fa fa-plus"></i> Add Expense</a>
		</div>
	</div>
</div>
<!-- /Page Header -->
@include('layouts.includes.notifications')

<!-- Search Filter -->
<div class="row filter-row">
	<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
		<div class="form-group form-focus">
			<input type="text" class="form-control floating">
			<label class="focus-label">Item Name</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
		<div class="form-group form-focus select-focus">
			<select class="select floating"> 
				<option> -- Select -- </option>
				<option>Loren Gatlin</option>
				<option>Tarah Shropshire</option>
			</select>
			<label class="focus-label">Purchased By</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
		<div class="form-group form-focus select-focus">
			<select class="select floating"> 
				<option> -- Select -- </option>
				<option> Cash </option>
				<option> Cheque </option>
			</select>
			<label class="focus-label">Paid By</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
		<div class="form-group form-focus">
			<div class="cal-icon">
				<input class="form-control floating datetimepicker" type="text">
			</div>
			<label class="focus-label">From</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
		<div class="form-group form-focus">
			<div class="cal-icon">
				<input class="form-control floating datetimepicker" type="text">
			</div>
			<label class="focus-label">To</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
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
						<th>Item</th>
						<th>Purchase From</th>
						<th>Purchase Date</th>
						<th>Purchased By</th>
						<th>Amount</th>
						<th>Paid By</th>
						<th class="text-center">Status</th>
						<th class="text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->expenses as $expense)
					<tr>
						<td>
							<strong>{{ $expense->item }}</strong>
						</td>
						<td>{{ $expense->purchase_from }}</td>
						<td>{{ $expense->purchase_date }}</td>
						<td>
							<h2 class="table-avatar">
								<a href="#" class="avatar avatar-xs"><img src="assets/img/profiles/avatar-04.jpg" alt=""></a>
								<a href="#">{{ $expense->client->first_name }} - {{ $expense->client->last_name }}</a>
							</h2>
						</td>
						<td>{{ $expense->amount }}</td>
						<td>{{ $expense->paid_by }}</td>
						<td>{{ $expense->status }}</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('expenses.edit',$expense->id)}}" data-toggle="modal" data-target="#edit_expense_{{ $expense->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $expense->id }}" data-toggle="modal" data-target="#delete_expense_{{ $expense->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Expense Modal -->
							<div id="edit_expense_{{ $expense->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Expense</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('expenses.update', $expense->id) }}" method="POST" enctype="multipart/form-data">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Item Name</label>
															<input class="form-control" name="item_name" type="text" value="{{ $expense->item_name ?? old('item_name') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Purchase From</label>
															<input class="form-control" name="purchase_from" type="text" value="{{ $expense->purchase_from ?? old('purchase_from') }}">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Purchase Date</label>
															<div class="cal-icon"><input class="form-control" name="purchase_date" type="date" value="{{ $expense->purchase_date ?? old('purchase_date') }}"></div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Purchased By  (Client)</label>
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
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Amount</label>
															<input placeholder="$50" class="form-control" name="amount" type="text" value="{{ $expense->amount ?? old('amount') }}" >
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Paid By</label>
															<input class="form-control" name="paid_by" type="text" value="{{ $expense->paid_by ?? old('paid_by') }}">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Status</label>
															<input class="form-control" name="status" type="text" value="{{ $expense->status ?? old('status') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Attachments</label>
															<input class="form-control" name="image" type="file" value="{{ $estimate->image ?? old('image') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<img src="{{ Storage::url($expense->image) }}" height="75" width="75" alt="" />
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
							<!-- /Edit Expense Modal -->

							<!-- Delete Expense Modal -->
							<div class="modal custom-modal fade" id="delete_expense" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Expense</h3>
												<p>Are you sure want to delete?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
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
							<!-- Delete Expense Modal -->

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Expense Modal -->
<div id="add_expense" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Expense</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('expenses.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">


					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Item Name</label>
								<input class="form-control" name="item_name" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Purchase From</label>
								<input class="form-control" name="purchase_from" type="text">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Purchase Date</label>
								<div class="cal-icon"><input class="form-control" name="purchase_date" type="date"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Purchased By  (Client)</label>
								<select class="select" name="client_id">
									@foreach($data->clients as $client)
		                            <option value="{{ $client->id }}">
		                            	{{ $client->first_name }} - {{ $client->last_name }}
		                            </option>
		                            @endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Amount</label>
								<input placeholder="$50" class="form-control" name="amount" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Paid By</label>
								<input class="form-control" name="paid_by" type="text">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<input class="form-control" name="status" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Attachments</label>
								<input class="form-control" name="image" type="file">
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
<!-- /Add Expense Modal -->


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