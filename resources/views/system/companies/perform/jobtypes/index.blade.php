@extends('layouts.site')

@php( $page_name = 'Job Types' )

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
			<a href="{{ route('jobtypes.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_job"><i class="fa fa-plus"></i> Add Job</a>
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
						<th style="width: 30px;">#</th>
						<th>Type </th>
						<th>Description </th>
						<th>Status </th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->jobtypes as $jobtype)
					<tr>
						<td>{{ $jobtype->id }}</td>
						<td>{{ $jobtype->type }}</td>
						<td>{{ $jobtype->description }}</td>
						<td>
							@if($jobtype->status=='active')
	                        <span class="badge badge-success">{{$jobtype->status}}</span>
	                        @else
	                            <span class="badge badge-warning">{{$jobtype->status}}</span>
	                        @endif
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a href="{{ route('jobtypes.edit',$jobtype->id)}}" class="dropdown-item" data-toggle="modal" data-target="#edit_job_{{ $jobtype->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a href="#" class="dropdown-item" data-toggle="modal" data-target="#delete_job"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Job Modal -->
							<div id="edit_job_{{ $jobtype->id }}" class="modal custom-modal fade" role="dialog">
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
											<form action="{{ route('jobtypes.update', $jobtype->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="form-group">
													<label>Type <span class="text-danger">*</span></label>
													<input class="form-control" name="type" type="text" value="{{ $jobtype->type
													 ?? old('type') }}">
												</div>
												<div class="form-group">
													<label>Description <span class="text-danger">*</span></label>
													<textarea class="form-control" name="description" rows="4">{{ $jobtype->description ?? old('description') }}</textarea>
												</div>
												<div class="form-group">
						                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
						                          <select name="status" class="form-control">
						                              <option value="active"  {{(($jobtype->status=='active')? 'selected' : '')}}>Active</option>
						                              <option value="inactive" {{(($jobtype->status=='inactive')? 'selected' : '')}}>Inactive</option>
						                          </select>
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
							<div class="modal custom-modal fade" id="delete_job_{{ $jobtype->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Job</h3>
												<p>Are you sure want to delete {{ $jobtype->type }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('jobtypes.destroy', $jobtype->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $jobtype->type }}\'s profile!')">Delete</button>
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
				<form action="{{ route('jobtypes.store') }}" method="POST" autocomplete="off">
	            @csrf
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="form-group">
						<label>Type <span class="text-danger">*</span></label>
						<input class="form-control" name="type" type="text">
					</div>
					<div class="form-group">
						<label>Description <span class="text-danger">*</span></label>
						<textarea class="form-control" name="description" rows="4"></textarea>
					</div>
					<div class="form-group">
                      <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                      <select name="status" class="form-control">
                          <option value="active">Active</option>
                          <option value="inactive">Inactive</option>
                      </select>
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