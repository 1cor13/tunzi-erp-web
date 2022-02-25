@extends('layouts.site')

@php( $page_name = 'Leave Type' )

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
			<a href="{{ route('leavetypes.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_leavetype"><i class="fa fa-plus"></i> Add Leave Type</a>
		</div>
	</div>
</div>
<!-- /Page Header -->
@include('layouts.includes.notifications')
		
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table datatable mb-0">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Leave Days</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->letypes as $letype)
					<tr>
						<td>{{ $letype->id }}</td>
						<td>{{ $letype->leave_type_name }}</td>
						<td>{{ $letype->number_of_days }}</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('leavetypes.edit',$letype->id)}}" data-toggle="modal" data-target="#edit_leavetype_{{ $letype->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $letype->id }}" data-toggle="modal" data-target="#delete_leavetype_{{ $letype->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Leavetype Modal -->
							<div id="edit_leavetype_{{ $letype->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Leave Type</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('leavetypes.update', $letype->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="form-group">
													<label>Leave Type Name <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="leave_type_name" value="{{ $letype->leave_type_name ?? old('leave_type_name') }}">
												</div>
												<div class="form-group">
													<label>Number of days <span class="text-danger">*</span></label>
													<input class="form-control" name="number_of_days" type="text" value="{{ $letype->number_of_days ?? old('number_of_days') }}">
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Save</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- /Edit Leavetype Modal -->

							<!-- Delete Leavetype Modal -->
							<div class="modal custom-modal fade" id="delete_leavetype_{{ $letype->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Leave Type</h3>
												<p>Are you sure want to delete {{ $letype->leave_type_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('leavetypes.destroy', $letype->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $letype->leave_type_name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Leavetype Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Leavetype Modal -->
<div id="add_leavetype" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Leave Type</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('leavetypes.store') }}" method="POST" autocomplete="off">
	            @csrf
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="form-group">
						<label>Leave Type Name <span class="text-danger">*</span></label>
						<input class="form-control" name="leave_type_name" type="text" value="{{ old('leave_type_name') }}" autofocus>
					</div>
					<div class="form-group">
						<label>Number of days <span class="text-danger">*</span></label>
						<input class="form-control" name="number_of_days" type="text" value="{{ old('number_of_days') }}">
					</div>
					<div class="submit-section">
						<button type="submit" class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Leavetype Modal -->

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