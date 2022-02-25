@extends('layouts.site')

@php( $page_name = 'Goal Tracking' )

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
			<a href="{{ route('goals.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_goal"><i class="fa fa-plus"></i> Add New</a>
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
						<th>Goal Type</th>
						<th>Subject</th>
						<th>Target Achievement</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Description </th>
						<th>Status </th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->goals as $goal)
					<tr>
						<td>{{ $goal->id }}</td>
						<td>{{ $goal->gtype->goal_type_name }}</td>
						<td>{{ $goal->subject }}</td>
						<td>{{ $goal->target_achievement }}</td>
						<td>{{ $goal->start_date }}</td>
						<td>{{ $goal->end_date }}</td>
						<td>{{ $goal->description }}</td>
						<td>
							@if($goal->status=='active')
                            <span class="badge badge-success">{{$goal->status}}</span>
                            @else
                                <span class="badge badge-warning">{{$goal->status}}</span>
                            @endif 
                        </td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('goals.edit',$goal->id)}}" data-toggle="modal" data-target="#edit_goal_{{ $goal->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $goal->id }}" data-toggle="modal" data-target="#delete_goal_{{ $goal->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Goal Modal -->
							<div id="edit_goal_{{ $goal->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Goal Tracking</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('goals.update', $goal->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="row">
													<div class="col-sm-12">
														<div class="form-group">
															<label class="col-form-label">Goal Type</label>
															<select class="select" name="goal_type_id">
																<option>Select</option>
																@foreach($data->goaltypes as $goaltype)
									                            <option value="{{ $goaltype->id }}">
									                            	{{ $goaltype->goal_type_name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Subject</label>
															<input class="form-control" type="text" name="subject" value="{{ $goal->subject ?? old('subject') }}">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Target Achievement</label>
															<input class="form-control" type="text" name="target_achievement" value="{{ $goal->target_achievement ?? old('target_achievement') }}">
														</div>
													</div>
													
													<div class="col-sm-6">
														<div class="form-group">
															<label>Start Date <span class="text-danger">*</span></label>
															<div class="cal-icon"><input class="form-control" name="start_date" type="date" value="{{ $goal->start_date ?? old('start_date') }}"></div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>End Date <span class="text-danger">*</span></label>
															<div class="cal-icon"><input class="form-control" type="date" name="end_date" value="{{ $goal->end_date ?? old('end_date') }}"></div>
														</div>
													</div>
													<div class="col-sm-12">
														<div class="form-group">
															<label>Description <span class="text-danger">*</span></label>
															<textarea class="form-control" rows="4" name="description">{{ $goal->description ?? old('description') }}</textarea>
														</div>
													</div>
													<div class="col-sm-12">
														<div class="form-group">
								                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
								                          <select name="status" class="form-control">
								                              <option value="active"  {{(($goal->status=='active')? 'selected' : '')}}>Active</option>
								                              <option value="inactive" {{(($goal->status=='inactive')? 'selected' : '')}}>Inactive</option>
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
							<!-- /Edit Goal Modal -->

							<!-- Delete Goal Modal -->
							<div class="modal custom-modal fade" id="delete_goal_{{ $goal->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Goal Tracking List</h3>
												<p>Are you sure want to delete {{ $goal->goal_type_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('goals.destroy', $goal->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $goal->goal_type_name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Goal Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Goal Modal -->
<div id="add_goal" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Goal Tracking</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('goals.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="col-form-label">Goal Type</label>
								<select class="select" name="goal_type_id">
									@foreach($data->goaltypes as $goaltype)
		                            <option value="{{ $goaltype->id }}">
		                            	{{ $goaltype->goal_type_name }}
		                            </option>
		                            @endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Subject</label>
								<input class="form-control" type="text" name="subject">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Target Achievement</label>
								<input class="form-control" type="text" name="target_achievement">
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group">
								<label>Start Date <span class="text-danger">*</span></label>
								<div class="cal-icon"><input class="form-control" name="start_date" type="date"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>End Date <span class="text-danger">*</span></label>
								<div class="cal-icon"><input class="form-control" type="date" name="end_date"></div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Description <span class="text-danger">*</span></label>
								<textarea class="form-control" rows="4" name="description"></textarea>
							</div>
						</div>
						<div class="col-sm-12">
						<div class="form-group">
                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                          <select name="status" class="form-control">
                              <option value="active">Active</option>
                              <option value="inactive">Inactive</option>
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
<!-- /Add Goal Modal -->

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