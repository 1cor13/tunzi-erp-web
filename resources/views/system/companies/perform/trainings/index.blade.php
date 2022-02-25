@extends('layouts.site')

@php( $page_name = 'Trainings' )

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
			<a href="{{ route('trainings.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_training"><i class="fa fa-plus"></i> Add New </a>
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
						<th>Training Type</th>
						<th>Trainer</th>
						<th>Employee</th>
						<th>Time Duration</th>
						<th>Description </th>
						<th>Cost </th>
						<th>Status </th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->trainings as $training)
					<tr>
						<td>{{ $training->id }}</td>
						<td>{{ $training->tratype->type }}</td>
						<td>{{ $training->trainer->first_name }}</td>
						<td>
							<h2 class="table-avatar">
								<a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
								<a href="#">{{ $training->employee->first_name }} - {{ $training->employee->last_name }} </a>
							</h2>
						</td>
						<td>
							{{ $training->start_date }} - {{ $training->end_date }}
						</td>
						<td>{{ $training->description }}</td>
						<td>{{ $training->cost }}</td>
						<td>
							@if($training->status=='active')
                            <span class="badge badge-success">{{$training->status}}</span>
                            @else
                                <span class="badge badge-warning">{{$training->status}}</span>
                            @endif
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('trainings.edit',$training->id)}}" data-toggle="modal" data-target="#edit_training_{{ $training->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $training->id }}" data-toggle="modal" data-target="#delete_training_{{ $training->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Training List Modal -->
							<div id="edit_training_{{ $training->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Training List</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('trainings.update', $training->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Training Type</label>
															<select class="select" name="training_type_id">
																<option>Select</option>
																@foreach($data->tratypes as $tratype)
									                            <option value="{{ $tratype->id }}">
									                            	{{ $tratype->type }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Trainer</label>
															<select class="select" name="trainer_id">
																<option>Select</option>
																@foreach($data->trainers as $trainer)
									                            <option value="{{ $trainer->id }}">
									                            	{{ $trainer->first_name }} - {{ $trainer->last_name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Employees</label>
															<select class="select" name="employee_id">
																<option>Select</option>
																@foreach($data->employees as $employee)
									                            <option value="{{ $employee->id }}">
									                            	{{ $employee->first_name }} - {{ $employee->last_name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Training Cost <span class="text-danger">*</span></label>
															<input class="form-control" type="text" name="training_cost" value="{{ $training->training_cost ?? old('training_cost') }}">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Start Date <span class="text-danger">*</span></label>
															<div class="cal-icon">
																<input class="form-control" name="start_date" type="date" value="{{ $training->start_date ?? old('start_date') }}">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>End Date <span class="text-danger">*</span></label>
															<div class="cal-icon">
																<input class="form-control" type="date" name="end_date" value="{{ $training->end_date ?? old('end_date') }}">
															</div>
														</div>
													</div>
													
													<div class="col-sm-12">
														<div class="form-group">
															<label>Description <span class="text-danger"></span></label>
															<textarea class="form-control" rows="4" name="description">
																{{ $training->description ?? old('description') }}"
															</textarea>
														</div>
													</div>
													<div class="col-sm-12">
														<div class="form-group">
															<label>Status <span class="text-danger">*</span></label>
															<div class="cal-icon">
																<input class="form-control" type="text" name="status" value="{{ $training->status ?? old('status') }}">
															</div>
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
							<!-- /Edit Training List Modal -->

							<!-- Delete Training List Modal -->
							<div class="modal custom-modal fade" id="delete_training_{{ $training->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Training List</h3>
												<p>Are you sure want to delete {{ $training->training_type }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('trainings.destroy', $training->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $training->training_type }}\'s profile!')">Delete</button>
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
							<!-- /Delete Training List Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Training List Modal -->
<div id="add_training" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add New Training</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('trainings.store') }}" method="POST" autocomplete="off">
	            @csrf
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Training Type</label>
								<select class="select" name="training_type_id">
									@foreach($data->tratypes as $tratype)
		                            <option value="{{ $tratype->id }}">
		                            	{{ $tratype->type }}
		                            </option>
		                            @endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Trainer</label>
								<select class="select" name="trainer_id">
									@foreach($data->trainers as $trainer)
		                            <option value="{{ $trainer->id }}">
		                            	{{ $trainer->first_name }} - {{ $trainer->last_name }}
		                            </option>
		                            @endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Employees</label>
								<select class="select" name="employee_id">
									@foreach($data->employees as $employee)
		                            <option value="{{ $employee->id }}">
		                            	{{ $employee->first_name }} - {{ $employee->last_name }}
		                            </option>
		                            @endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Training Cost <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="training_cost">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Start Date <span class="text-danger">*</span></label>
								<div class="cal-icon">
									<input class="form-control" name="start_date" type="date">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>End Date <span class="text-danger">*</span></label>
								<div class="cal-icon">
									<input class="form-control" type="date" name="end_date">
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label>Description <span class="text-danger"></span></label>
								<textarea class="form-control" rows="4" name="description"></textarea>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Status <span class="text-danger">*</span></label>
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
<!-- /Add Training List Modal -->

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