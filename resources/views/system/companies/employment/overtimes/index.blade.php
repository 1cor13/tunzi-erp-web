@extends('layouts.site')

@php( $page_name = 'Overtime' )

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
			<a href="{{ route('overtimes.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_overtime"><i class="fa fa-plus"></i> Add Overtime</a>
		</div>
	</div>
</div>
<!-- /Page Header -->
@include('layouts.includes.notifications')

<!-- Overtime Statistics -->
<div class="row">
	<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
		<div class="stats-info">
			<h6>Overtime Employee</h6>
			<h4>12 <span>this month</span></h4>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
		<div class="stats-info">
			<h6>Overtime Hours</h6>
			<h4>118 <span>this month</span></h4>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
		<div class="stats-info">
			<h6>Pending Request</h6>
			<h4>23</h4>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
		<div class="stats-info">
			<h6>Rejected</h6>
			<h4>5</h4>
		</div>
	</div>
</div>
<!-- /Overtime Statistics -->

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0 datatable">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>OT Date</th>
						<th class="text-center">OT Hours</th>
						<th>Description</th>
						<th class="text-center">Status</th>
						<th>Approved by</th>
						<th class="text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->overtimes as $overtime)
					<tr>
						<td>{{ $overtime->id }}</td>
						<td>
							<h2 class="table-avatar blue-link">
								<a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
								<a href="#">{{ $overtime->employee->first_name }} - {{ $resign->employee->last_name }}</a>
							</h2>
						</td>
						<td>{{ $overtime->overtime_date }}</td>
						<td class="text-center">{{ $overtime->overtime_hours }}</td>
						<td>{{ $overtime->description }}</td>
						<td class="text-center">
							<div class="action-label">
								<a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
									<i class="fa fa-dot-circle-o text-purple"></i> 
									{{ $overtime->status }}
								</a>
							</div>
						</td>
						<td>
							<h2 class="table-avatar">
								<a href="#" class="avatar avatar-xs"><img src="assets/img/profiles/avatar-09.jpg" alt=""></a>
								<a href="#">{{ $overtime->user->name }}</a>
							</h2>
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('overtimes.edit',$overtime->id)}}" data-toggle="modal" data-target="#edit_overtime_{{ $overtime->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $overtime->id }}" data-toggle="modal" data-target="#delete_overtime_{{ $overtime->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Overtime Modal -->
							<div id="edit_overtime_{{ $overtime->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Overtime</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('overtimes.update', $overtime->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="form-group">
													<label>Select Employee <span class="text-danger">*</span></label>
													<select class="select" name="employee_id">
														<option>Select</option>
														@foreach($data->employees as $emp)
							                            <option value="{{ $emp->id }}">
							                            	{{ $emp->first_name }} - {{ $emp->last_name }}
							                            </option>
							                            @endforeach
													</select>
												</div>
												<div class="form-group">
													<label>Overtime Date <span class="text-danger">*</span></label>
													<div class="cal-icon">
														<input class="form-control" type="date" name="overtime_date" value="{{ $overtime->overtime_date ?? old('overtime_date') }}">
													</div>
												</div>
												<div class="form-group">
													<label>Overtime Hours <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="overtime_hours" value="{{ $overtime->overtime_hours ?? old('overtime_hours') }}">
												</div>
												<div class="form-group">
													<label>Description <span class="text-danger">*</span></label>
													<textarea rows="4" class="form-control" name="description">
														{{ $overtime->description ?? old('description') }}
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
													<input class="form-control" type="text" name="status" value="{{ $overtime->status ?? old('status') }}">
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- /Edit Overtime Modal -->

							<!-- Delete Overtime Modal -->
							<div class="modal custom-modal fade" id="delete_overtime_{{ $overtime->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Overtime</h3>
												<p>Are you sure want to Cancel this {{ $overtime->employee_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('overtimes.destroy', $overtime->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $overtime->employee_name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Overtime Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<!-- /Page Content -->

<!-- Add Overtime Modal -->
<div id="add_overtime" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Overtime</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('overtimes.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="form-group">
						<label>Select Employee <span class="text-danger">*</span></label>
						<select class="select" name="employee_id">
							@foreach($data->employees as $emp)
                            <option value="{{ $emp->id }}">
                            	{{ $emp->first_name }} - {{ $emp->last_name }}
                            </option>
                            @endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Overtime Date <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control" type="date" name="overtime_date">
						</div>
					</div>
					<div class="form-group">
						<label>Overtime Hours <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="overtime_hours">
					</div>
					<div class="form-group">
						<label>Description <span class="text-danger">*</span></label>
						<textarea rows="4" class="form-control" name="description">
						</textarea>
					</div>
					<div class="form-group">
						<label>Approved by  <span class="text-danger">*</span></label>
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
<!-- /Add Overtime Modal -->

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