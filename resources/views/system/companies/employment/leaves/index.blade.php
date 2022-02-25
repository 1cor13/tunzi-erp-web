@extends('layouts.site')

@php( $page_name = 'Leaves' )

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
    @include('layouts.includes.side-companies')
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
			<a href="{{ route('leaves.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Leave</a>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="#" class="btn add-btn" data-toggle="modal"> Import</a>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="#" class="btn add-btn" data-toggle="modal"> Export</a>
		</div>
	</div>
</div>
@include('layouts.includes.notifications')

<!-- Leave Statistics -->
<div class="row">
	<div class="col-md-3">
		<div class="stats-info">
			<h6>Annual Leave</h6>
			<h4>12</h4>
		</div>
	</div>
	<div class="col-md-3">
		<div class="stats-info">
			<h6>Medical Leave</h6>
			<h4>3</h4>
		</div>
	</div>
	<div class="col-md-3">
		<div class="stats-info">
			<h6>Other Leave</h6>
			<h4>4</h4>
		</div>
	</div>
	<div class="col-md-3">
		<div class="stats-info">
			<h6>Remaining Leave</h6>
			<h4>5</h4>
		</div>
	</div>
</div>
<!-- /Leave Statistics -->

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0 datatable">
				<thead>
					<tr>
						<th>#</th>
						<th>Leave Type</th>
						<th>From</th>
						<th>To</th>
						<th>No of Days</th>
						<th>Approved by</th>
						<th>Status</th>
						<th class="text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->leaves as $leave)
					<tr>
						<td>{{ $leave->id }}</td>
						<td>{{ $leave->empleavetype->leave_type_name }}</td>
						<td>{{ $leave->start_date }}</td>
						<td>{{ $leave->end_date }}</td>
						<td>{{ $leave->number_of_days }}</td>
						<td>{{ $leave->user->name }}</td>
						<td>{{ $leave->status }}</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('leaves.edit',$leave->id)}}" data-toggle="modal" data-target="#edit_leave_{{ $leave->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_approve_{{ $leave->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Leave Modal -->
							<div id="edit_leave_{{ $leave->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Leave</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('leaves.update', $leave->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="form-group">
													<label>Leave Type <span class="text-danger">*</span></label>
													<select class="select" name="employee_leave_type_id">
														@foreach($data->letypes as $letype)
							                            <option value="{{ $letype->id }}">
							                            	{{ $letype->leave_type_name }}
							                            </option>
							                            @endforeach
													</select>
												</div>
												<div class="form-group">
													<label>Start Date <span class="text-danger">*</span></label>
													<div class="cal-icon">
														<input class="form-control" name="start_date" type="date" value="{{ $leave->start_date ?? old('start_date') }}">
													</div>
												</div>
												<div class="form-group">
													<label>End Date <span class="text-danger">*</span></label>
													<div class="cal-icon">
														<input class="form-control" name="end_date" type="date" value="{{ $leave->end_date ?? old('end_date') }}">
													</div>
												</div>
												<div class="form-group">
													<label>Number of days <span class="text-danger">*</span></label>
													<input class="form-control" name="number_of_days" type="text" readonly="" value="{{ $leave->number_of_days ?? old('number_of_days') }}">
												</div>
												<div class="form-group">
													<label>Remaining Leaves <span class="text-danger">*</span></label>
													<input class="form-control" name="remaining_leaves" type="text" value="{{ $leave->remaining_leaves ?? old('remaining_leaves') }}">
												</div>
												<div class="form-group">
													<label>Leave Reason <span class="text-danger">*</span></label>
													<textarea rows="4" class="form-control" name="leave_reason">
														{{ $leave->leave_reason ?? old('leave_reason') }}
													</textarea>
												</div>
												<div class="form-group">
													<label>Approved by <span class="text-danger">*</span></label>
													<select class="select" name="user_id">
														@foreach($data->users as $user)
							                            <option value="{{ $user->id }}">
							                            	{{ $user->name }}
							                            </option>
							                            @endforeach
													</select>
												</div>
												<div class="form-group">
													<label>Status <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="status" value="{{ $leave->status ?? old('status') }}">
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Save</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- /Edit Leave Modal -->

							<!-- Delete Leave Modal -->
							<div class="modal custom-modal fade" id="delete_approve_{{ $leave->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Leave</h3>
												<p>Are you sure want to delete this leave {{ $leave->employee_leave_type_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('leaves.destroy', $leave->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $leave->employee_leave_type_name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Leave Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Leave Modal -->
<div id="add_leave" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Leave</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('leaves.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="form-group">
						<label>Leave Type <span class="text-danger">*</span></label>
						<select class="select" name="employee_leave_type_id">
							<option>Select</option>
							@foreach($data->letypes as $letype)
                            <option value="{{ $letype->id }}">
                            	{{ $letype->leave_type_name }}
                            </option>
                            @endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Start Date <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control" name="start_date" type="date">
						</div>
					</div>
					<div class="form-group">
						<label>End Date <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control" name="end_date" type="date">
						</div>
					</div>
					<div class="form-group">
						<label>Number of days <span class="text-danger">*</span></label>
						<input class="form-control" name="number_of_days" type="text" readonly="" value="{{ $letype->number_of_days ?? old('number_of_days') }}">
					</div>
					<div class="form-group">
						<label>Remaining Leaves <span class="text-danger">*</span></label>
						<input class="form-control" name="remaining_leaves" type="text">
					</div>
					<div class="form-group">
						<label>Leave Reason <span class="text-danger">*</span></label>
						<textarea rows="4" class="form-control" name="leave_reason">
						</textarea>
					</div>
					<div class="form-group">
						<label>Approved by <span class="text-danger">*</span></label>
						<select class="select" name="user_id">
							<option>Select</option>
							@foreach($data->users as $user)
                            <option value="{{ $user->id }}">
                            	{{ $user->name }}
                            </option>
                            @endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Status <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="status">
					</div>
					<div class="submit-section">
						<button type="submit" class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Leave Modal -->

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