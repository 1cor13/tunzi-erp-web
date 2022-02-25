@extends('layouts.site')

@php( $page_name = 'Tickets' )

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
			<a href="{{ route('tickets.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_ticket"><i class="fa fa-plus"></i> Add Ticket</a>
		</div>
	</div>
</div>
<!-- /Page Header -->
@include('layouts.includes.notifications')

<!-- Search Filter -->
<div class="row filter-row">
	<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
		<div class="form-group form-focus">
			<input type="text" class="form-control floating">
			<label class="focus-label">Employee Name</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
		<div class="form-group form-focus select-focus">
			<select class="select floating"> 
				<option> -- Select -- </option>
				<option> Pending </option>
				<option> Approved </option>
				<option> Returned </option>
			</select>
			<label class="focus-label">Status</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
		<div class="form-group form-focus select-focus">
			<select class="select floating"> 
				<option> -- Select -- </option>
				<option> High </option>
				<option> Low </option>
				<option> Medium </option>
			</select>
			<label class="focus-label">Priority</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
		<div class="form-group form-focus">
			<div class="cal-icon">
				<input class="form-control floating datetimepicker" type="text">
			</div>
			<label class="focus-label">From</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
		<div class="form-group form-focus">
			<div class="cal-icon">
				<input class="form-control floating datetimepicker" type="text">
			</div>
			<label class="focus-label">To</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
		<a href="#" class="btn btn-success btn-block"> Search </a>  
	</div>     
</div>
<!-- /Search Filter -->

<div class="row">
	<div class="col-md-12">
		<div class="card-group m-b-30">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between mb-3">
						<div>
							<span class="d-block">New Tickets</span>
						</div>
						<div>
							<span class="text-success">+10%</span>
						</div>
					</div>
					<h3 class="mb-3">112</h3>
					<div class="progress mb-2" style="height: 5px;">
						<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
			</div>
		
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between mb-3">
						<div>
							<span class="d-block">Solved Tickets</span>
						</div>
						<div>
							<span class="text-success">+12.5%</span>
						</div>
					</div>
					<h3 class="mb-3">70</h3>
					<div class="progress mb-2" style="height: 5px;">
						<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
			</div>
		
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between mb-3">
						<div>
							<span class="d-block">Open Tickets</span>
						</div>
						<div>
							<span class="text-danger">-2.8%</span>
						</div>
					</div>
					<h3 class="mb-3">100</h3>
					<div class="progress mb-2" style="height: 5px;">
						<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
			</div>
		
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between mb-3">
						<div>
							<span class="d-block">Pending Tickets</span>
						</div>
						<div>
							<span class="text-danger">-75%</span>
						</div>
					</div>
					<h3 class="mb-3">125</h3>
					<div class="progress mb-2" style="height: 5px;">
						<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0 datatable">
				<thead>
					<tr>
						<th>#</th>
						<th>Ticket ID</th>
						<th>Ticket Subject</th>
						<th>Employees</th>
						<th>Created Date</th>
						<th>Priority</th>
						<th class="text-center">Status</th>
						<th class="text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->tickets as $ticket)
					<tr>
						<td>{{ $ticket->id }}</td>
						<td><a href="#">{{ $ticket->ticket_id }}</a></td>
						<td>{{ $ticket->ticket_subject }}</td>
						<td>
							<h2 class="table-avatar">
								<a class="avatar avatar-xs" href="profile.html"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
								<a href="#">{{ $ticket->employee->first_name }} - {{ $ticket->employee->last_name }}</a>
							</h2>
						</td>
						<td> {{ $ticket->created_at->toDayDateTimeString() }}</td>
						<td>{{ $ticket->priority }}</td>
						<td>
							<td>{{ $ticket->status }}</td>
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('tickets.edit',$ticket->id)}}" data-toggle="modal" data-target="#edit_ticket_{{ $ticket->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $ticket->id }}" data-toggle="modal" data-target="#delete_ticket_{{ $ticket->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Ticket Modal -->
							<div id="edit_ticket_{{ $ticket->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Ticket</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('tickets.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
									            <input type="hidden" name="_token" value="{{ csrf_token() }}">
									            <input type="hidden" name="_method" value="PUT">

												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>Ticket ID</label>
															<input class="form-control" type="text" value="{{ $ticket->ticket_id ?? old('ticket_id') }}" name="ticket_id">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Ticket Subject</label>
															<input class="form-control" type="text" value="{{ $ticket->ticket_subject ?? old('ticket_subject') }}" name="ticket_subject">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Priority</label>
															<input class="form-control" type="text" name="priority" value="{{ $ticket->priority ?? old('priority') }}">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Employees</label>
															<select class="select" name="employee_id">
																<option>Select</option>
																@foreach($data->employees as $emp)
									                            <option value="{{ $emp->id }}">
									                            	{{ $emp->first_name }} - {{ $emp->last_name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>Client</label>
															<select class="select" name="client_id">
																<option>Select</option>
																@foreach($data->clients as $client)
									                            <option value="{{ $client->id }}">
									                            	{{ $client->first_name }} - {{ $client->last_name }}
									                            </option>
									                            @endforeach
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12">
														<div class="form-group">
															<label>Status</label>
															<input class="form-control" type="text" value="{{ $ticket->status ?? old('status') }}" name="status">
														</div>
														<div class="form-group">
															<label>Description</label>
															<textarea class="form-control" name="ticket_description">
																{{ $ticket->ticket_description ?? old('ticket_description') }}
															</textarea>
														</div>
														<div class="form-group">
															<label>Upload Files</label>
															<input class="form-control" type="file" name="image" value="{{ $ticket->image ?? old('image') }}">
														</div>
														<div class="form-group">
															<img src="{{ Storage::url($ticket->image) }}" height="75" width="75" alt="" />
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
							<!-- /Edit Ticket Modal -->

							<!-- Delete Ticket Modal -->
							<div class="modal custom-modal fade" id="delete_ticket_{{ $ticket->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Ticket</h3>
												<p>Are you sure want to delete {{ $ticket->ticket }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('tickets.destroy', $ticket->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $ticket->ticket_id }}\'s profile!')">Delete</button>
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
							<!-- /Delete Ticket Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Ticket Modal -->
<div id="add_ticket" class="modal right custom-modal fade" role="dialog">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Add Ticket</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form action="{{ route('tickets.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Ticket ID</label>
							<input class="form-control" type="text" name="ticket_id">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Ticket Subject</label>
							<input class="form-control" type="text" name="ticket_subject">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Priority</label>
							<input class="form-control" type="text" name="priority">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Employees</label>
							<select class="select" name="employee_id">
								@foreach($data->employees as $emp)
	                            <option value="{{ $emp->id }}">
	                            	{{ $emp->first_name }} - {{ $emp->last_name }}
	                            </option>
	                            @endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Client</label>
							<select class="select" name="client_id">
								@foreach($data->clients as $client)
	                            <option value="{{ $client->id }}">
	                            	{{ $client->first_name }} - {{ $client->last_name }}
	                            </option>
	                            @endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label>Status</label>
							<input class="form-control" type="text" name="status">
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="ticket_description">
							</textarea>
						</div>
						<div class="form-group">
							<label>Upload Files</label>
							<input class="form-control" type="file" name="image">
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
<!-- /Add Ticket Modal -->

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