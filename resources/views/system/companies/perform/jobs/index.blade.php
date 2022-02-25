@extends('layouts.site')

@php( $page_name = 'Jobs' )

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
    @include('layouts.includes.side-performance')
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
			<a href="{{ route('jobs.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_job"><i class="fa fa-plus"></i> Add Job</a>
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
						<th>Job Title</th>
						<th>Department</th>
						<th>Start Date</th>
						<th>Expire Date</th>
						<th class="text-center">Job Type</th>
						<th class="text-center">Status</th>
						<th>Applicants</th>
						<th class="text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->jobs as $job)
					<tr>
						<td>{{ $job->id }}</td>
						<td><a href="#">{{ $job->job_title }}</a></td>
						<td>{{ $job->department->department_name }}</td>
						<td>{{ $job->start_date }}</td>
						<td>{{ $job->expired_date }}</td>
						<td class="text-center">
							{{ $job->jtype->type }}
						</td>
						<td class="text-center">
							@if($job->status=='active')
	                        <span class="badge badge-success">{{$job->status}}</span>
	                        @else
	                            <span class="badge badge-warning">{{$job->status}}</span>
	                        @endif
						</td>
						<td><a href="#" class="btn btn-sm btn-primary">{{ $job->jbapp->first_name }}</a></td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a href="{{ route('jobs.edit',$job->id)}}" class="dropdown-item" data-toggle="modal" data-target="#edit_job_{{ $job->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a href="{{ $job->id }}" class="dropdown-item" data-toggle="modal" data-target="#delete_job_{{ $job->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Job Modal -->
							<div id="edit_job_{{ $job->id }}" class="modal right custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Job</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('jobs.update', $job->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Job Title</label>
															<input class="form-control" type="text" value="{{ $job->job_title
													 ?? old('job_title') }}" name="job_title">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Department</label>
															<select class="select" name="department_id">
																<option>Select</option>
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
															<label>Job Applicant</label>
															<select class="select" name="job_applicant_id">
																<option>Select</option>
																@foreach($data->jobapps as $jobapp)
									                            <option value="{{ $jobapp->id }}">
									                            	{{ $jobapp->first_name }} - {{ $jobapp->last_name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Job Location</label>
															<input class="form-control" type="text" value="{{ $job->job_location ?? old('job_location') }}" name="job_location">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>No of Vacancies</label>
															<input class="form-control" type="text" value="{{ $job->num_of_vacancies ?? old('num_of_vacancies') }}" name="num_of_vacancies">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Experience</label>
															<input class="form-control" type="text" value="{{ $job->experience ?? old('experience') }}" name="experience">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Age</label>
															<input class="form-control" type="text" value="{{ $job->age ?? old('age') }}" name="age">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Salary From</label>
															<input type="text" class="form-control" value="{{ $job->salary_from ?? old('salary_from') }}" name="salary_from">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Salary To</label>
															<input type="text" class="form-control" value="{{ $job->salary_to ?? old('salary_to') }}" name="salary_to">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Job Type</label>
															<select class="select" name="job_type_id">
																<option>Select</option>
																@foreach($data->jobtypes as $jobtype)
									                            <option value="{{ $jobtype->id }}">
									                            	{{ $jobtype->type }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
													<div class="form-group">
							                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
							                          <select name="status" class="form-control">
							                              <option value="active"  {{(($job->status=='active')? 'selected' : '')}}>Active</option>
							                              <option value="inactive" {{(($job->status=='inactive')? 'selected' : '')}}>Inactive</option>
							                          </select>
							                        </div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Start Date</label>
															<input type="date" class="form-control" value="{{ $job->start_date ?? old('start_date') }}" name="start_date">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Expired Date</label>
															<input type="date" class="form-control" value="{{ $job->expired_date ?? old('expired_date') }}" name="expired_date">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label>Description</label>
															<textarea class="form-control" rows="4" name="description">{{ $goaltype->description ?? old('description') }}</textarea>
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
							<!-- /Edit Job Modal -->

							<!-- Delete Job Modal -->
							<div class="modal custom-modal fade" id="delete_job" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Job</h3>
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
							<!-- /Delete Job Modal -->

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Job Modal -->
<div id="add_job" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Job</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('jobs.store') }}" method="POST" autocomplete="off">
	            @csrf
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Job Title</label>
								<input class="form-control" type="text" name="job_title">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Department</label>
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
								<label>Job Applicant</label>
								<select class="select" name="job_applicant_id">
									@foreach($data->jobapps as $jobapp)
		                            <option value="{{ $jobapp->id }}">
		                            	{{ $jobapp->first_name }} - {{ $jobapp->last_name }}
		                            </option>
		                            @endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Job Location</label>
								<input class="form-control" type="text" name="job_location">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>No of Vacancies</label>
								<input class="form-control" type="text" name="num_of_vacancies">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Experience</label>
								<input class="form-control" type="text" name="experience">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Age</label>
								<input class="form-control" type="text" name="age">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Salary From</label>
								<input type="text" class="form-control" name="salary_from">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Salary To</label>
								<input type="text" class="form-control" name="salary_to">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Job Type</label>
								<select class="select" name="job_type_id">
									@foreach($data->jobtypes as $jobtype)
		                            <option value="{{ $jobtype->id }}">
		                            	{{ $jobtype->type }}
		                            </option>
		                            @endforeach
								</select>
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
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Start Date</label>
								<input type="date" class="form-control" name="start_date">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Expired Date</label>
								<input type="date" class="form-control" name="expired_date">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control" rows="4" name="description"></textarea>
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
<!-- /Add Job Modal -->

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