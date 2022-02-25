@extends('layouts.site')

@php( $page_name = 'Trainers' )

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
			<a href="{{ route('trainers.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_trainer"><i class="fa fa-plus"></i> Add New</a>
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
						<th>Name </th>
						<th>Contact Number </th>
						<th>Email </th>
						<th>Description </th>
						<th>Status </th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->trainers as $trainer)
					<tr>
						<td>{{ $trainer->id }}</td>
						<td>
							<h2 class="table-avatar">
								<a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
								<a href="#">{{ $trainer->first_name }} -{{ $trainer->last_name }} </a>
							</h2>
						</td>
						<td>{{ $trainer->phone }}</td>
						<td>{{ $trainer->email }}</td>
						<td>{{ $trainer->description }}</td>
						<td>
							@if($trainer->status=='active')
                            <span class="badge badge-success">{{$trainer->status}}</span>
                            @else
                                <span class="badge badge-warning">{{$trainer->status}}</span>
                            @endif
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('trainers.edit',$trainer->id)}}" data-toggle="modal" data-target="#edit_type_{{ $trainer->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $trainer->id }}" data-toggle="modal" data-target="#delete_type_{{ $trainer->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Trainers List Modal -->
							<div id="edit_type_{{ $trainer->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Trainer</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('trainers.update', $trainer->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">First Name <span class="text-danger">*</span></label>
															<input class="form-control" name="first_name" type="text" value="{{ $trainer->first_name
													 ?? old('first_name') }}">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Last Name</label>
															<input class="form-control" name="last_name" type="text" value="{{ $trainer->last_name
													 ?? old('last_name') }}">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Role</label>
															<input class="form-control" name="role" type="text" value="{{ $trainer->role
													 ?? old('role') }}">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Email <span class="text-danger">*</span></label>
															<input class="form-control" name="email" type="email" value="{{ $trainer->email
													 ?? old('email') }}">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-form-label">Phone </label>
															<input class="form-control" name="phone" type="text" value="{{ $trainer->phone
													 ?? old('phone') }}">
														</div>
													</div>
													<div class="col-sm-12">
														<div class="form-group">
								                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
								                          <select name="status" class="form-control">
								                              <option value="active"  {{(($trainer->status=='active')? 'selected' : '')}}>Active</option>
								                              <option value="inactive" {{(($trainer->status=='inactive')? 'selected' : '')}}>Inactive</option>
								                          </select>
								                        </div>
								                    </div>
													<div class="col-sm-12">
														<div class="form-group">
															<label>Description <span class="text-danger">*</span></label>
															<textarea class="form-control" rows="4" name="description">{{ $trainer->description ?? old('description') }}</textarea>
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
							<!-- /Edit Trainers List Modal -->

							<!-- Delete Trainers List Modal -->
							<div class="modal custom-modal fade" id="delete_type_{{ $trainer->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Trainers List</h3>
												<p>Are you sure want to delete {{ $trainer->first_name }} - {{ $trainer->last_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('trainers.destroy', $trainer->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $trainer->first_name }} - {{ $trainer->last_name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Trainers List Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Trainers List Modal -->
<div id="add_trainer" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add New Trainer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('trainers.store') }}" method="POST" autocomplete="off">
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
								<input class="form-control" name="last_name" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Role</label>
								<input class="form-control" name="role" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Email <span class="text-danger">*</span></label>
								<input class="form-control" name="email" type="email">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Phone </label>
								<input class="form-control" name="phone" type="text">
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
						<div class="col-sm-12">
							<div class="form-group">
								<label>Description <span class="text-danger">*</span></label>
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
<!-- /Add Trainers List Modal -->

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