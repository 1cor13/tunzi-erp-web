@extends('layouts.site')

@php( $page_name = 'Employee Holidays' )

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
			<h3 class="page-title">{{$page_name}}</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
				<li class="breadcrumb-item active">{{$page_name}}</li>
			</ul>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="{{ route('holidays.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Add Holiday</a>
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
						<th>Title </th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Status</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->holidays as $hol)
					<tr class="holiday-upcoming">
						<td>{{ $hol->id }}</td>
						<td>{{ $hol->holiday_name }}</td>
						<td>{{ $hol->start_date }}</td>
						<td>{{ $hol->end_date }}</td>
						<td>
							@if($hol->status=='active')
				                <span class="badge badge-success">{{$hol->status}}</span>
				            @else
				                <span class="badge badge-warning">{{$hol->status}}</span>
				            @endif
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('holidays.edit',$hol->id)}}" data-toggle="modal" data-target="#edit_holiday_{{ $hol->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $hol->id }}" data-toggle="modal" data-target="#delete_holiday_{{ $hol->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Holiday Modal -->
							<div class="modal custom-modal fade" id="edit_holiday_{{ $hol->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Holiday</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('holidays.update', $hol->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="form-group">
													<label>Holiday Name <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="holiday_name" value="{{ $hol->holiday_name ?? old('holiday_name') }}">
												</div>
												<div class="form-group">
													<label>Start Date <span class="text-danger">*</span></label>
													<div class="cal-icon">
														<input class="form-control" name="start_date" type="date" value="{{ $hol->start_date ?? old('start_date') }}">
													</div>
												</div>
												<div class="form-group">
													<label>End Date <span class="text-danger">*</span></label>
													<div class="cal-icon">
														<input class="form-control" name="end_date" type="date" value="{{ $hol->end_date ?? old('end_date') }}">
													</div>
												</div>
												<div class="form-group">
													<label>Description <span class="text-danger">*</span></label>
													<textarea class="form-control" rows="4" name="description">
													 {{ $hol->description ?? old('description') }}
													</textarea>
												</div>
												<div class="form-group">
						                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
						                          <select name="status" class="form-control">
						                              <option value="active"  {{(($hol->status=='active')? 'selected' : '')}}>Active</option>
						                              <option value="inactive" {{(($hol->status=='inactive')? 'selected' : '')}}>Inactive</option>
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
							<!-- /Edit Holiday Modal -->

							<!-- Delete Holiday Modal -->
							<div class="modal custom-modal fade" id="delete_holiday_{{ $hol->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Holiday</h3>
												<p>Are you sure want to delete {{ $hol->holiday_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('holidays.destroy', $hol->id) }}">
					                                {{ csrf_field() }}
					                                {{ method_field('DELETE') }}
					                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $hol->holiday_name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Holiday Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Holiday Modal -->
<div class="modal right custom-modal fade" id="add_holiday" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Holiday</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('holidays.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="form-group">
						<label>Holiday Name <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="holiday_name">
					</div>
					<div class="form-group">
						<label>Start Date <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control" type="date" name="start_date">
						</div>
					</div>
					<div class="form-group">
						<label>End Date <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control" type="date" name="end_date">
						</div>
					</div>
					<div class="form-group">
						<label>Description <span class="text-danger">*</span></label>
						<textarea class="form-control" rows="4" name="description"></textarea>
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
<!-- /Add Holiday Modal -->

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