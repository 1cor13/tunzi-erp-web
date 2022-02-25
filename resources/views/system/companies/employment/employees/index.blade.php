@extends('layouts.site')

@php( $page_name = 'Employees' )

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
			<a href="{{ route('employees.create') }}" class="btn add-btn btn-sm mt-1" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="#" class="btn add-btn btn-sm mt-1" data-toggle="modal"> Import</a>
		</div>
		<div class="col-auto float-right ml-auto d-none">
			<a href="#" class="btn add-btn btn-sm mt-1" data-toggle="modal"> Export</a>
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
						<th>Names </th>
						<th>Username </th>
						<th>Email </th>
						<th>Joining Date</th>
						<th>Phone</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->employees as $emp)
					<tr>
						<td>{{ $emp->id }}</td>
						<td>
							<h2 class="table-avatar blue-link">
								<a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
								<a href="#">{{ $emp->first_name }} - {{ $emp->last_name }}</a>
							</h2>
						</td>
						<td>{{ $emp->username }}</td>
						<td>{{ $emp->email }}</td>
						<td>{{ $emp->joining_date }}</td>
						<td>{{ $emp->employee_phone }}</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('employees.edit',$emp->id)}}" data-toggle="modal" data-target="#edit_{{ $emp->id }}_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $emp->id }}" data-toggle="modal" data-target="#delete_employee_{{ $emp->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Employee Modal -->
							<div id="edit_{{ $emp->id }}_employee" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Employee</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('employees.update', $emp->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">First Name <span class="text-danger">*</span></label>
															<input class="form-control" name="first_name" type="text" value="{{ $emp->first_name ?? old('first_name') }}">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Last Name</label>
															<input class="form-control" name="last_name" type="text" value="{{ $emp->last_name ?? old('last_name') }}">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Username <span class="text-danger">*</span></label>
															<input class="form-control" name="username" type="text" value="{{ $emp->username ?? old('username') }}">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Email <span class="text-danger">*</span></label>
															<input class="form-control" name="email" type="email" value="{{ $emp->email ?? old('email') }}">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Password</label>
															<input class="form-control" name="password" type="password" value="{{ $emp->password ?? old('password') }}">
														</div>
													</div>
													<div class="col-sm-6">  
														<div class="form-group">
															<label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
															<div class="cal-icon">
																<input class="form-control" type="date" name="joining_date" value="{{ $emp->joining_date ?? old('joining_date') }}">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Phone </label>
															<input class="form-control" type="text" name="employee_phone" value="{{ $emp->employee_phone ?? old('employee_phone') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Department <span class="text-danger">*</span></label>
															<select class="select" name="department_id">
																@foreach($data->departments as $dep)
									                            <option value="{{ $dep->id }}">
									                            	{{ $dep->department_name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Designation <span class="text-danger">*</span></label>
															<select class="select" name="designation_id">
																@foreach($data->designations as $des)
									                            <option value="{{ $des->id }}">
									                            	{{ $des->designation_name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Company</label>
															<select class="select" name="company_id">
																@foreach($data->companies as $comp)
									                            <option value="{{ $comp->id }}">
									                            	{{ $comp->name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Holiday</label>
															<select class="select" name="employee_holiday_id">
																@foreach($data->holidays as $hol)
									                            <option value="{{ $hol->id }}">
									                            	{{ $hol->holiday_name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Customer</label>
															<select class="select" name="customer_id">
																@foreach($data->customers as $customer)
									                            <option value="{{ $customer->id }}">
									                            	{{ $customer->name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Project</label>
															<select class="select" name="project_id">
																@foreach($data->projects as $project)
									                            <option value="{{ $project->id }}">
									                            	{{ $project->project_name }}
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
							<!-- /Edit Employee Modal -->

							<!-- Delete Employee Modal -->
							<div class="modal custom-modal fade" id="delete_employee_{{ $emp->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Employee</h3>
												<p>Are you sure want to delete {{ $emp->username }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('employees.destroy', $emp->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $emp->username }}\'s profile!')">Delete</button>
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
							<!-- /Delete Employee Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Employee Modal -->
<div id="add_employee" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Employee</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('employees.store') }}" method="POST" autocomplete="off">
	            @csrf
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">First Name <span class="text-danger">*</span></label>
								<input class="form-control" name="first_name" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Last Name</label>
								<input class="form-control" type="text" name="last_name">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Username <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="username">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Email <span class="text-danger">*</span></label>
								<input class="form-control" type="email" name="email">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Password</label>
								<input class="form-control" type="password" name="password">
							</div>
						</div>
						<div class="col-sm-6">  
							<div class="form-group">
								<label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
								<div class="cal-icon">
									<input class="form-control" type="date" name="joining_date"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Phone </label>
								<input class="form-control" type="text" name="employee_phone">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Department <span class="text-danger">*</span></label>
								<select class="select" name="department_id">
									@foreach($data->departments as $dep)
		                            <option value="{{ $dep->id }}">
		                            	{{ $dep->department_name }}
		                            </option>
		                            @endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Designation <span class="text-danger">*</span></label>
								<select class="select" name="designation_id">
									@foreach($data->designations as $des)
		                            <option value="{{ $des->id }}">
		                            	{{ $des->designation_name }}
		                            </option>
		                            @endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Company</label>
								<select class="select" name="company_id">
									@foreach($data->companies as $comp)
		                            <option value="{{ $comp->id }}">
		                            	{{ $comp->name }}
		                            </option>
		                            @endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Holiday</label>
								<select class="select" name="employee_holiday_id">
									@foreach($data->holidays as $hol)
		                            <option value="{{ $hol->id }}">
		                            	{{ $hol->holiday_name }}
		                            </option>
		                            @endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Customer</label>
								<select class="select" name="customer_id">
									@foreach($data->customers as $customer)
		                            <option value="{{ $customer->id }}">
		                            	{{ $customer->name }}
		                            </option>
		                            @endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Project</label>
								<select class="select" name="project_id">
									@foreach($data->projects as $project)
		                            <option value="{{ $project->id }}">
		                            	{{ $project->project_name }}
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
<!-- /Add Employee Modal -->



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