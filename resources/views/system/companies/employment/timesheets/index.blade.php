@extends('layouts.site')

@php( $page_name = 'Timesheet' )

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
			<a href="{{ route('timesheets.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_todaywork"><i class="fa fa-plus"></i> Add Today Work</a>
		</div>
	</div>
</div>
<!-- /Page Header -->
@include('layouts.includes.notifications')

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0 datatable">
				<thead>
					<tr>
						<th>#</th>
						<th>Employee</th>
						<th>Date</th>
						<th>Projects</th>
						<th class="text-center">Assigned Hours</th>
						<th class="text-center">Hours</th>
						<th class="d-none d-sm-table-cell">Description</th>
						<th class="text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->timesheets as $timesheet)
					<tr>
						<td>
							<h2 class="table-avatar">
								<a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
								<a href="#">{{ $timesheet->employee->first_name }} - {{ $timesheet->employee->last_name }}</a>
							</h2>
						</td>
						<td>{{ $timesheet->timesheet_date }}</td>
						<td>
							<h2>{{ $timesheet->project->project_name }}</h2>
						</td>
						<td class="text-center">{{ $timesheet->timesheet_hours }}</td>
						<td class="text-center">{{ $timesheet->total_hours }}</td>
						<td class="d-none d-sm-table-cell col-md-4">{{ $timesheet->description }}</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('timesheets.edit',$timesheet->id)}}" data-toggle="modal" data-target="#edit_todaywork_{{ $timesheet->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_workdetail_{{ $timesheet->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Today Work Modal -->
							<div id="edit_todaywork_{{ $timesheet->id }}" class="modal custom-modal fade" role="dialog">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Work Details</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="{{ route('timesheets.update', $timesheet->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

											<div class="row">
												<div class="form-group col-sm-6">
													<label>Project <span class="text-danger">*</span></label>
													<select class="select" name="project_id">
														<option>Select</option>
														@foreach($data->projects as $pro)
							                            <option value="{{ $pro->id }}">
							                            	{{ $pro->project_name }}
							                            </option>
							                            @endforeach
													</select>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-sm-4">
													<label>Deadline <span class="text-danger">*</span></label>
													<div class="cal-icon">
														<input class="form-control" type="text" name="deadline" value="{{ $timesheets->deadline ?? old('deadline') }}">
													</div>
												</div>
												<div class="form-group col-sm-4">
													<label>Total Hours <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="total_hours" value="{{ $timesheet->total_hours ?? old('total_hours') }}">
												</div>
												<div class="form-group col-sm-4">
													<label>Remaining Hours <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="remaining_hours" value="{{ $timesheet->remaining_hours ?? old('remaining_hours') }}">
												</div>
											</div>
											<div class="row">
												<div class="form-group col-sm-6">
													<label>Date <span class="text-danger">*</span></label>
													<div class="cal-icon">
														<input class="form-control" type="date" name="timesheet_date" value="{{ $timesheet->timesheet_date ?? old('timesheet_date') }}">
													</div>
												</div>
												<div class="form-group col-sm-6">
													<label>Hours <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="timesheet_hours" value="{{ $timesheet->timesheet_hours ?? old('timesheet_hours') }}">
												</div>
											</div>
											<div class="form-group">
												<label>Description <span class="text-danger">*</span></label>
												<textarea rows="4" class="form-control" name="description">{{ $timesheet->description ?? old('description') }}</textarea>
											</div>
											<div class="submit-section">
												<button type="submit" class="btn btn-primary submit-btn">Save</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							</div>
							<!-- /Edit Today Work Modal -->

							<!-- Delete Today Work Modal -->
							<div class="modal custom-modal fade" id="delete_workdetail_{{ $timesheet->id }}" role="dialog">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-body">
										<div class="form-header">
											<h3>Delete Work Details</h3>
											<p>Are you sure want to delete?</p>
										</div>
										<div class="modal-btn delete-action">
											<div class="row">
												<div class="col-6">
													<form method="POST" action="{{ route('timesheets.destroy', $timesheet->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $timesheet->employee_id }}\'s profile!')">Delete</button>
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
							<!-- Delete Today Work Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Today Work Modal -->
<div id="add_todaywork" class="modal right custom-modal fade" role="dialog">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Add Today Work details</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form action="{{ route('timesheets.store') }}" method="POST" autocomplete="off">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

				<div class="row">
					<div class="form-group col-sm-6">
						<label>Project <span class="text-danger">*</span></label>
						<select class="select" name="project_id">
							@foreach($data->projects as $pro)
                            <option value="{{ $pro->id }}">
                            	{{ $pro->project_name }}
                            </option>
                            @endforeach
						</select>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-4">
						<label>Deadline <span class="text-danger">*</span></label>
						<input class="form-control" type="date" name="deadline">
					</div>
					<div class="form-group col-sm-4">
						<label>Total Hours <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="total_hours">
					</div>
					<div class="form-group col-sm-4">
						<label>Remaining Hours <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="remaining_hours">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label>Date <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control" type="date" name="timesheet_date">
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label>Hours <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="timesheet_hours">
					</div>
				</div>
				<div class="form-group">
					<label>Description <span class="text-danger">*</span></label>
					<textarea rows="4" class="form-control" name="description"></textarea>
				</div>
				<div class="submit-section">
					<button type="submit" class="btn btn-primary submit-btn">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<!-- /Add Today Work Modal -->

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