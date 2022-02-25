@extends('layouts.site')

@php( $page_name = 'Resignations' )

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
			<a href="{{ route('resignations.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_resignation"><i class="fa fa-plus"></i> Add Resignation</a>
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

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0 datatable">
				<thead>
					<tr>
						<th>#</th>
						<th>Resigning Employee </th>
						<th>Notice Date </th>
						<th>Resignation Date </th>
						<th>Reason </th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->resigns as $resign)
					<tr>
						<td>{{ $resign->id }}</td>
						<td>
							<h2 class="table-avatar blue-link">
								<a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
								<a href="#">{{ $resign->employee->first_name }} - {{ $resign->employee->last_name }}</a>
							</h2>
						</td>
						<td>{{ $resign->notice_date }}</td>
						<td>{{ $resign->resignation_date }}</td>
						<td>{{ $resign->resignation_reason }}</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('resignations.edit',$resign->id)}}" data-toggle="modal" data-target="#edit_{{ $resign->id }}_resignation"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $resign->id }}" data-toggle="modal" data-target="#delete_resignation_{{ $resign->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Resignation Modal -->
							<div id="edit_{{ $resign->id }}resignation" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Resignation</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('resignations.update', $resign->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="form-group">
													<label>Resigning Employee <span class="text-danger">*</span></label>
							                        <select class="select" name="employee_id">
							                            @foreach($data->employees as $emp)
							                            <option value="{{ $emp->id }}">
							                            	{{ $emp->first_name }} - {{ $emp->last_name }}
							                            </option>
							                            @endforeach
							                        </select>
												</div>
												<div class="form-group">
													<label>Notice Date <span class="text-danger">*</span></label>
													<div class="cal-icon">
														<input type="date" class="form-control" name="notice_date" value="{{ $resign->notice_date ?? old('notice_date') }}">
													</div>
												</div>
												<div class="form-group">
													<label>Resignation Date <span class="text-danger">*</span></label>
													<div class="cal-icon">
														<input type="date" class="form-control" name="resignation_date" value="{{ $resign->resignation_date ?? old('resignation_date') }}">
													</div>
												</div>
												<div class="form-group">
													<label>Reason <span class="text-danger">*</span></label>
													<textarea class="form-control" rows="4" name="resignation_reason">
													 {{ old('resignation_reason') }}
													</textarea>
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- /Edit Resignation Modal -->

							<!-- Delete Resignation Modal -->
							<div class="modal custom-modal fade" id="delete_resignation_{{ $resign->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Resignation</h3>
												<p>Are you sure want to delete {{ $resign->employee_id }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('resignations.destroy', $resign->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $resign->resigning_employee }}\'s profile!')">Delete</button>
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
							<!-- /Delete Resignation Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Resignation Modal -->
<div id="add_resignation" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Resignation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('resignations.store') }}" method="POST" autocomplete="off">
	            @csrf
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="form-group">
						<label>Resigning Employee <span class="text-danger">*</span></label>
                        <select class="select" name="employee_id">
                            @foreach($data->employees as $emp)
                            <option value="{{ $emp->id }}">
                            	{{ $emp->first_name }} - {{ $emp->last_name }}
                            </option>
                            @endforeach
                        </select>
					</div>
					<div class="form-group">
						<label>Notice Date <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input type="date" class="form-control" name="notice_date">
						</div>
					</div>
					<div class="form-group">
						<label>Resignation Date <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input type="date" class="form-control" name="resignation_date">
						</div>
					</div>
					<div class="form-group">
						<label>Reason <span class="text-danger">*</span></label>
						<textarea class="form-control" rows="4" name="resignation_reason"></textarea>
					</div>
					<div class="submit-section">
						<button type="submit" class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Resignation Modal -->



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