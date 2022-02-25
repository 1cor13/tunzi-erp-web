@extends('layouts.site')

@php( $page_name = 'Policies' )

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
			<a href="{{ route('policies.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_policy"><i class="fa fa-plus"></i> Add Policy</a>
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
						<th style="width: 30px;">#</th>
						<th>Policy Name </th>
						<th>Department </th>
						<th>Description </th>
						<th>Created </th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->policies as $policy)
					<tr>
						<td>{{ $policy->id }}</td>
						<td>{{ $policy->policy_name }}</td>
						<td>{{ $policy->department->department_name }}</td>
						<td>{{ $policy->policy_description }}</td>
						<td> {{ $policy->created_at->toDayDateTimeString() }}</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#"><i class="fa fa-download m-r-5"></i> Download</a>
									<a class="dropdown-item" href="{{ route('policies.edit',$policy->id)}}" data-toggle="modal" data-target="#edit_policy_{{ $policy->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $policy->id }}" data-toggle="modal" data-target="#delete_policy_{{ $policy->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Policy Modal -->
							<div id="edit_policy_{{ $policy->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Policy</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('policies.update', $policy->id) }}" method="POST" enctype="multipart/form-data">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="form-group">
													<label>Policy Name <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="policy_name" value="{{ $policy->policy_name ?? old('policy_name') }}">
												</div>
												<div class="form-group">
													<label>Description <span class="text-danger">*</span></label>
													<textarea class="form-control" rows="4" name="policy_description">
														{{ $policy->policy_description ?? old('policy_description') }}
													</textarea>
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
													<label>Upload Files</label>
													<input class="form-control" type="file" name="image" value="{{ $policy->image ?? old('image') }}">
												</div>
												<div class="form-group">
													<img src="{{ Storage::url($policy->image) }}" height="75" width="75" alt="" />
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Save</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- /Edit Policy Modal -->

							<!-- Delete Policy Modal -->
							<div class="modal custom-modal fade" id="delete_policy_{{ $policy->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Policy</h3>
												<p>Are you sure want to delete {{ $policy->policy_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('policies.destroy', $policy->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $policy->policy_name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Policy Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Policy Modal -->
<div id="add_policy" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Policy</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('policies.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	            @csrf
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="form-group">
						<label>Policy Name <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="policy_name">
					</div>
					<div class="form-group">
						<label>Description <span class="text-danger">*</span></label>
						<textarea class="form-control" rows="4" name="policy_description"></textarea>
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
<!-- /Add Policy Modal -->

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