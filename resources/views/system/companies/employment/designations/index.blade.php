@extends('layouts.site')

@php( $page_name = 'Designations' )

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
			<a href="{{ route('designations.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_designation"><i class="fa fa-plus"></i> Add Designation</a>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="#" class="btn add-btn" data-toggle="modal"> Import</a>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="#" class="btn add-btn" data-toggle="modal"> Export</a>
		</div>
	</div>
</div>
@include('layouts.includes.notifications')

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0 datatable">
				<thead>
					<tr>
						<th style="width: 30px;">#</th>
						<th>Designation Name </th>
						<th>Department </th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->designations as $des)
					<tr>
						<td>{{ $des->id }}</td>
						<td>{{ $des->designation_name }}</td>
						<td>{{ $des->department->department_name }}</td>
						<td class="text-right">
	                        <div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
	                            <div class="dropdown-menu dropdown-menu-right">
	                                <a class="dropdown-item" href="{{ route('designations.edit',$des->id)}}" data-toggle="modal" data-target="#edit_designation_{{ $des->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
	                                <a class="dropdown-item" href="{{ $des->id }}" data-toggle="modal" data-target="#delete_designation_{{ $des->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
	                            </div>
							</div>

							<!-- Edit Designation Modal -->
							<div id="edit_designation_{{ $des->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Designation</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('designations.update', $des->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="form-group">
													<label>Designation Name <span class="text-danger">*</span></label>
													<input class="form-control" name="designation_name" type="text" value="{{ $des->designation_name ?? old('designation_name') }}">
												</div>
												<div class="form-group">
													<label>Department <span class="text-danger">*</span></label>
													<select class="select" name="department_id">
														<option>Select</option>
														@foreach($data->departments as $dep)
							                            <option value="{{ $dep->id }}">
							                            	{{ $dep->department_name }}
							                            </option>
							                            @endforeach
													</select>
												</div>
												<div class="form-group">
													<label>Description <span class="text-danger">*</span></label>
													<textarea class="form-control" rows="4" name="description">{{ $goaltype->description ?? old('description') }}</textarea>
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Save</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- /Edit Designation Modal -->

							<!-- Delete Designation Modal -->
							<div class="modal custom-modal fade" id="delete_designation_{{ $des->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Designation</h3>
												<p>Are you sure want to delete {{ $des->designation_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('designations.destroy', $des->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $des->designation_name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Designation Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>				
<!-- Add Designation Modal -->
<div id="add_designation" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Designation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('designations.store') }}" method="POST" autocomplete="off">
	            @csrf
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
	            
					<div class="form-group">
						<label>Designation Name <span class="text-danger">*</span></label>
						<input class="form-control" name="designation_name" type="text">
					</div>
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
					<div class="form-group">
						<label>Description <span class="text-danger">*</span></label>
						<textarea class="form-control" rows="4" name="description"></textarea>
					</div>
					<div class="submit-section">
						<button type="submit" class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Designation Modal -->

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