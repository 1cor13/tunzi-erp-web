@extends('layouts.site')

@php( $page_name = 'Countries' )

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
	@include('layouts.includes.side-settings')
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
			<a href="{{ route('countries.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_country"><i class="fa fa-plus"></i> Add Countries</a>
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
						<th>Name </th>
						<th>Short Code </th>
						<th>Country Code</th>
						<th>Country Region</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->countries as $country)
					<tr>
						<td>{{ $country->id }}</td>
						<td>{{ $country->country_name }}</td>
						<td>{{ $country->short_code }}</td>
						<td>{{ $country->country_code }}</td>
						<td>{{ $country->country_region }}</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('countries.edit',$country->id)}}" data-toggle="modal" data-target="#edit_country_{{ $country->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $country->id }}" data-toggle="modal" data-target="#delete_country_{{ $country->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>


							<!-- Edit Country Modal -->
							<div id="edit_country_{{ $country->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Country</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('countries.update', $country->id) }}" method="POST">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="_method" value="PUT">

												<div class="form-group">
													<label>Name <span class="text-danger">*</span></label>
													<input class="form-control" name="country_name" type="text" value="{{ $country->country_name ?? old('country_name') }}">
												</div>
												<div class="form-group">
													<label>Short Code<span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="short_code" value="{{ $country->short_code ?? old('short_code') }}">
												</div>
												<div class="form-group">
													<label>Country Code<span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="country_code" value="{{ $country->country_code ?? old('country_code') }}">
												</div>
												<div class="form-group">
													<label>Country Region<span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="country_region" value="{{ $country->country_region ?? old('country_region') }}">
												</div>
												<div class="form-group">
													<label>Country Timezone<span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="country_timezone" value="{{ $country->country_timezone ?? old('country_timezone') }}">
												</div>
												<div class="form-group">
                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                          <select name="type" class="form-control">
                              <option value="active"  {{(($country->status=='active')? 'selected' : '')}}>Active</option>
                               <option value="inactive"  {{(($country->status=='inactive')? 'selected' : '')}}>InActive</option>
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
							<!-- /Edit Country Modal -->

							<!-- Delete Country Modal -->
							<div class="modal custom-modal fade" id="delete_country_{{ $country->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Country</h3>
												<p>Are you sure want to delete {{ $country->country_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('countries.destroy', $country->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $country->name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Country Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Country Modal -->
<div id="add_country" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Country</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('countries.store') }}" method="POST" autocomplete="off">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="form-group">
						<label>Name <span class="text-danger">*</span></label>
						<input class="form-control" name="country_name" type="text" >
					</div>
					<div class="form-group">
						<label>Short Code<span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="short_code">
					</div>
					<div class="form-group">
						<label>Country Code<span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="country_code">
					</div>
					<div class="form-group">
						<label>Country Region<span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="country_region">
					</div>
					<div class="form-group">
						<label>Country Timezone<span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="country_timezone">
					</div>
					<div class="form-group">
            <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
            <select name="type" class="form-control">
                <option value="active">Active</option>
                 <option value="inactive">InActive</option>
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
<!-- /Add Country Modal -->

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