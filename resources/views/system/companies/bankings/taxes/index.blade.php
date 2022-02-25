@extends('layouts.site')

@php( $page_name = 'Taxes' )

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
    @include('layouts.includes.side-account')
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
			<a href="{{ route('taxes.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_tax"><i class="fa fa-plus"></i> Add Tax</a>
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
						<th>Tax Name </th>
						<th>Rate (%) </th>
						<th>Type</th>
						<th>Status</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->taxes as $tax)
					<tr>
						<td>{{ $tax->id }}</td>
						<td>{{ $tax->name }}</td>
						<td>{{ $tax->rate }}</td>
						<td>{{ $tax->type }}</td>
						<td>
							@if($tax->status=='active')
                <span class="badge badge-success">{{$tax->status}}</span>
              @else
                  <span class="badge badge-warning">{{$tax->status}}</span>
              @endif
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('taxes.edit',$tax->id)}}" data-toggle="modal" data-target="#edit_tax_{{ $tax->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $tax->id }}" data-toggle="modal" data-target="#delete_tax_{{ $tax->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>


							<!-- Edit Tax Modal -->
							<div id="edit_tax_{{ $tax->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Tax</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('taxes.update', $tax->id) }}" method="POST">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="_method" value="PUT">

												<div class="form-group">
													<label>Tax Name <span class="text-danger">*</span></label>
													<input class="form-control" name="tax_name" type="text" value="{{ $tax->name ?? old('name') }}">
												</div>
												<div class="form-group">
													<label>Rate (%)  <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="rate" value="{{ $tax->rate ?? old('rate') }}">
												</div>
												<div class="form-group">
                          <label for="status" class="col-form-label">Type <span class="text-danger">*</span></label>
                          <select name="type" class="form-control">
                              <option value="compound"  {{(($tax->type=='compound')? 'selected' : '')}}>Compound</option>
                              <option value="fixed" {{(($tax->type=='fixed')? 'selected' : '')}}>Fixed</option>
                              <option value="inclusive" {{(($tax->type=='inclusive')? 'selected' : '')}}>Inclusive</option>
                              <option value="normal" {{(($tax->type=='normal')? 'selected' : '')}}>Normal</option>
                              <option value="withholding" {{(($tax->type=='withholding')? 'selected' : '')}}>Withholding</option>
                          </select>
                        </div>
												<div class="form-group">
                          <label for="status" class="col-form-label">Type <span class="text-danger">*</span></label>
                          <select name="status" class="form-control">
                              <option value="active"  {{(($tax->type=='active')? 'selected' : '')}}>Active</option>
                              <option value="inactive" {{(($tax->type=='inactive')? 'selected' : '')}}>Inactive</option>
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
							<!-- /Edit Tax Modal -->

							<!-- Delete Tax Modal -->
							<div class="modal custom-modal fade" id="delete_tax_{{ $tax->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Tax</h3>
												<p>Are you sure want to delete {{ $tax->name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('taxes.destroy', $tax->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $tax->name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Tax Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Tax Modal -->
<div id="add_tax" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Tax</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('taxes.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="form-group">
						<label>Tax Name <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="name">
					</div>
					<div class="form-group">
						<label>Rate (%) <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="rate">
					</div>
					<div class="form-group">
                      <label for="status" class="col-form-label">Type <span class="text-danger">*</span></label>
                      <select name="type" class="form-control">
                          <option value="compound">Compound</option>
                          <option value="fixed">Fixed</option>
                          <option value="inclusive">Inclusive</option>
                          <option value="normal">Normal</option>
                          <option value="withholding">Withholding</option>
                      </select>
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
<!-- /Add Tax Modal -->

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