@extends('layouts.site')

@php( $page_name = 'Job Applicants' )

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
			<a href="{{ route('jobapplicants.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_job_applicant"><i class="fa fa-plus"></i> Add Job Applicant</a>
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
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Apply Date</th>
						<th class="text-center">Status</th>
						<th>Resume</th>
						<th class="text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->jobapps as $jobapp)
					<tr>
						<td>{{ $jobapp->id }}</td>
						<td>{{ $jobapp->first_name }} - {{ $jobapp->last_name }}</td>
						<td>{{ $jobapp->email }}</td>
						<td>{{ $jobapp->phone }}</td>
						<td>{{ $jobapp->apply_date }}</td>
						<td>
							@if($jobapp->status=='active')
                            <span class="badge badge-success">{{$jobapp->status}}</span>
                            @else
                                <span class="badge badge-warning">{{$jobapp->status}}</span>
                            @endif 
                        </td>
						<td><a href="{{ $jobapp->path }}" class="btn btn-sm btn-primary"><i class="fa fa-download"></i> Download</a></td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#"><i class="fa fa-clock-o m-r-5"></i> Schedule Interview</a>
									<a class="dropdown-item" href="{{ route('jobapplicants.edit',$jobapp->id)}}" data-toggle="modal" data-target="#edit_job_{{ $jobapp->id }}_applicant"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $jobapp->id }}" data-toggle="modal" data-target="#delete_job_{{ $jobapp->id }}_applicant"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Job Modal -->
							<div id="edit_job_{{ $jobapp->id }}_applicant" class="modal custom-modal fade" role="dialog">
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
											<form action="{{ route('jobapplicants.update', $jobapp->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="form-group">
													<label>First Name <span class="text-danger">*</span></label>
													<input class="form-control" name="first_name" type="text" value="{{ $jobapp->first_name ?? old('first_name') }}">
												</div>
												<div class="form-group">
													<label>Last Name <span class="text-danger">*</span></label>
													<input class="form-control" name="last_name" type="text" value="{{ $jobapp->last_name ?? old('last_name') }}">
												</div>
												<div class="form-group">
													<label>Email <span class="text-danger">*</span></label>
													<input class="form-control" name="email" type="email" value="{{ $jobapp->email ?? old('email') }}">
												</div>
												<div class="form-group">
													<label>Phone <span class="text-danger">*</span></label>
													<input class="form-control" name="phone" type="text" value="{{ $jobapp->phone ?? old('phone') }}">
												</div>
												<div class="form-group">
													<label>Apply Date <span class="text-danger">*</span></label>
													<input class="form-control" name="apply_date" type="date" value="{{ $jobapp->apply_date ?? old('apply_date') }}">
												</div>
												<div class="form-group">
													<label>Status <span class="text-danger">*</span></label>
													<input class="form-control" name="status" type="text" value="{{ $jobapp->status ?? old('status') }}">
												</div>
												<div class="form-group">
													<label>Upload Files (Resume)</label>
													<input class="form-control" type="file" name="path" value="{{ $jobapp->path ?? old('path') }}">
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Save</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- /Edit Job Applicant Modal -->

							<!-- Delete Job Applicant Modal -->
							<div class="modal custom-modal fade" id="delete_job_{{ $jobapp->id }}_applicant" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Job Applicant</h3>
												<p>Are you sure want to delete {{ $jobapp->first_name }} - {{ $jobapp->last_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('jobapplicants.destroy', $jobapp->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $jobapp->type }}\'s profile!')">Delete</button>
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
							<!-- /Delete Job Applicant Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Job Applicant Modal -->
<div id="add_job_applicant" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Job Applicant</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('jobapplicants.store') }}" method="POST" autocomplete="off">
	            @csrf
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="form-group">
						<label>First Name <span class="text-danger">*</span></label>
						<input class="form-control" name="first_name" type="text">
					</div>
					<div class="form-group">
						<label>Last Name <span class="text-danger">*</span></label>
						<input class="form-control" name="last_name" type="text">
					</div>
					<div class="form-group">
						<label>Email <span class="text-danger">*</span></label>
						<input class="form-control" name="email" type="email">
					</div>
					<div class="form-group">
						<label>Phone <span class="text-danger">*</span></label>
						<input class="form-control" name="phone" type="text">
					</div>
					<div class="form-group">
						<label>Apply Date <span class="text-danger">*</span></label>
						<input class="form-control" name="apply_date" type="date">
					</div>
					<div class="form-group">
						<label>Status <span class="text-danger">*</span></label>
						<input class="form-control" name="status" type="text">
					</div>
					<div class="form-group">
						<label>Upload Files (Resume)</label>
						<input class="form-control" type="file" name="path">
					</div>
					<div class="submit-section">
						<button type="submit" class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Job Applicant Modal -->

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