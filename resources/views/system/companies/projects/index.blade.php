@extends('layouts.site')

@php( $page_name = 'Projects' )

@section('title', $page_name)
@section('styles')

<!-- Select2 CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
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
			<a href="{{ route('projects.create') }}" class="btn add-btn" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> Add Project</a>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="#" class="btn add-btn" data-toggle="modal"> Import</a>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="#" class="btn add-btn" data-toggle="modal"> Export</a>
		</div>
	</div>
</div>
<!-- /Page Header -->
@include('layouts.includes.notifications')

<!-- Search Filter -->
<div class="row filter-row">
	<div class="col-sm-6 col-md-3">  
		<div class="form-group form-focus">
			<input type="text" class="form-control floating">
			<label class="focus-label">Project Name</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">  
		<div class="form-group form-focus">
			<input type="text" class="form-control floating">
			<label class="focus-label">Employee Name</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3"> 
		<div class="form-group form-focus select-focus">
			<select class="select floating"> 
				<option>Select Roll</option>
				<option>Web Developer</option>
				<option>Web Designer</option>
				<option>Android Developer</option>
				<option>Ios Developer</option>
			</select>
			<label class="focus-label">Designation</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">  
		<a href="#" class="btn btn-success btn-block"> Search </a>  
	</div>     
</div>
<!-- Search Filter -->

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0 datatable">
				<thead>
					<tr>
						<th style="width: 30px;">#</th>
						<th>Project Name </th>
						<th>Customer </th>
						<th>Start Date </th>
						<th>End Date </th>
						<th>Project Leader</th>
						<th>Project Team</th>
						<th>Status</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->projects as $project)
					<tr>
						<td>{{ $project->id }}</td>
						<td>{{ $project->project_name }}</td>
						<td>{{ $project->customer->name }}</td>
						<td>{{ $project->start_date }}</td>
						<td>{{ $project->end_date }}</td>
						<td>{{ $project->project_leader }}</td>
						<td>{{ $project->project_team }}</td>
						<td>
							@if($project->status=='active')
                            <span class="badge badge-success">{{$project->status}}</span>
	                        @else
	                            <span class="badge badge-warning">{{$project->status}}</span>
	                        @endif
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('projects.edit',$project->id)}}" data-toggle="modal" data-target="#edit_project_{{ $project->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $project->id }}" data-toggle="modal" data-target="#delete_project_{{ $project->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Project Modal -->
							<div id="edit_project_{{ $project->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Project</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>Project Name</label>
															<input class="form-control" type="text" name="project_name" value="{{ $project->project_name ?? old('project_name') }}">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Customer</label>
															<select class="select" name="customer_id">
																@foreach($data->customers as $customer)
									                            <option value="{{ $customer->id }}">
									                            	{{ $customer->name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>Start Date</label>
															<div class="cal-icon">
																<input class="form-control" type="date" name="start_date" value="{{ $project->start_date ?? old('start_date') }}">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>End Date</label>
															<div class="cal-icon">
																<input class="form-control" type="date" name="end_date" value="{{ $project->end_date ?? old('end_date') }}">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group">
															<label>Rate</label>
															<input class="form-control" type="text" name="rate" placeholder="$50" value="{{ $project->rate ?? old('rate') }}">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Priority</label>
															<input class="form-control" type="text" name="priority" value="{{ $project->priority ?? old('priority') }}">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>Add Project Leader</label>
															<input class="form-control" type="text" name="project_leader" value="{{ $project->project_leader ?? old('project_leader') }}">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>Add Team</label>
															<input class="form-control" type="text" name="project_team" value="{{ $project->project_team ?? old('project_team') }}">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label>Description</label>
													<textarea rows="4" class="form-control summernote" placeholder="Enter your message here" name="description" >
														{{ $project->project_description ?? old('project_description') }}
													</textarea>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>Status</label>
															<input class="form-control" type="text" name="status" value="{{ $project->status ?? old('status') }}">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label>Upload Files</label>
													<input class="form-control" type="file" name="image" value="{{ $project->image ?? old('image') }}">
												</div>
												<div class="form-group">
													<img src="{{ Storage::url($project->image) }}" height="75" width="75" alt="" />
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- /Edit Project Modal -->

							<!-- Delete Project Modal -->
							<div class="modal custom-modal fade" id="delete_project_{{ $project->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Project</h3>
												<p>Are you sure want to delete {{ $project->project_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('projects.destroy', $project->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $project->project_name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Project Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Create Project Modal -->
<div id="create_project" class="modal right custom-modal fade" role="dialog">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Create Project</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form action="{{ route('projects.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Project Name</label>
							<input class="form-control" type="text" name="project_name">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Customer</label>
							<select class="select" name="customer_id">
								@foreach($data->customers as $customer)
	                            <option value="{{ $customer->id }}">
	                            	{{ $customer->name }}
	                            </option>
	                            @endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Start Date</label>
							<div class="cal-icon">
								<input class="form-control" type="date" name="start_date">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>End Date</label>
							<div class="cal-icon">
								<input class="form-control" type="date" name="end_date">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label>Rate</label>
							<input class="form-control" type="text" name="rate" placeholder="$50">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Priority</label>
							<input class="form-control" type="text" name="priority">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Add Project Leader</label>
							<input class="form-control" type="text" name="project_leader">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Add Team</label>
							<input class="form-control" type="text" name="project_team">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Description</label>
					<textarea rows="4" class="form-control summernote" placeholder="Enter your message here" name="description"></textarea>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Status</label>
							<input class="form-control" type="text" name="status">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Upload Files</label>
					<input class="form-control" type="file" name="image">
				</div>
				<div class="submit-section">
					<button type="submit" class="btn btn-primary submit-btn">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<!-- /Create Project Modal -->

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