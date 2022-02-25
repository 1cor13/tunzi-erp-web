@extends('layouts.site')

@php( $page_name = 'Currencies' )

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
			<a href="{{ route('currencies.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_currency"><i class="fa fa-plus"></i> Add Currency</a>
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
						<th>Code</th>
						<th>Rate (%) </th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->currencies as $currency)
					<tr>
						<td>{{ $currency->id }}</td>
						<td>{{ $currency->name }}</td>
						<td>{{ $currency->code }}</td>
						<td>{{ $currency->rate }}</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('currencies.edit',$currency->id)}}" data-toggle="modal" data-target="#edit_currency_{{ $currency->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $currency->id }}" data-toggle="modal" data-target="#delete_currency_{{ $currency->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>


							<!-- Edit Currency Modal -->
							<div id="edit_currency_{{ $currency->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Currency</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('currencies.update', $currency->id) }}" method="POST">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="_method" value="PUT">

												<div class="form-group">
													<label>Name <span class="text-danger">*</span></label>
													<input class="form-control" name="name" type="text" value="{{ $currency->name ?? old('name') }}">
												</div>
												<div class="form-group">
													<label>Code <span class="text-danger">*</span></label>
													<input class="form-control" name="code" type="text" value="{{ $currency->code ?? old('code') }}">
												</div>
												<div class="form-group">
													<label>Rate (%)  <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="rate" value="{{ $currency->rate ?? old('rate') }}">
												</div>
												<div class="form-group">
                          <label for="status" class="col-form-label">Precision <span class="text-danger">*</span></label>
                          <select name="precision" class="form-control">
                              <option value="0"  {{(($currency->precision=='0')? 'selected' : '')}}>0</option>
                              <option value="1" {{(($currency->precision=='1')? 'selected' : '')}}>1</option>
                              <option value="2" {{(($currency->precision=='2')? 'selected' : '')}}>2</option>
                              <option value="3" {{(($currency->precision=='3')? 'selected' : '')}}>3</option>
                              <option value="4" {{(($currency->precision=='4')? 'selected' : '')}}>4</option>
                          </select>
                        </div>
                        <div class="form-group">
													<label>Symbol  <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="symbol" value="{{ $currency->symbol ?? old('symbol') }}">
												</div>
												<div class="form-group">
                          <label for="status" class="col-form-label">Symbol Position <span class="text-danger">*</span></label>
                          <select name="symbol_position" class="form-control">
                              <option value="after_amount"  {{(($currency->symbol_position=='after_amount')? 'selected' : '')}}>After Amount</option>
                              <option value="before_amount" {{(($currency->symbol_position=='before_amount')? 'selected' : '')}}>Before Amount</option>
                          </select>
                        </div>
                        <div class="form-group">
													<label>Decimal Mark  <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="decimal_mark" value="{{ $currency->decimal_mark ?? old('decimal_mark') }}">
												</div>
												<div class="form-group">
													<label>Thousands Separator  <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="separate" value="{{ $currency->separate ?? old('separate') }}">
												</div>
												<div class="form-group">
                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                          <select name="status" class="form-control">
                              <option value="active"  {{(($currency->status=='active')? 'selected' : '')}}>Active</option>
                              <option value="inactive" {{(($currency->status=='inactive')? 'selected' : '')}}>Inactive</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="status" class="col-form-label">Default Currency <span class="text-danger">*</span></label>
                          <select name="default_currency" class="form-control">
                              <option value="yes"  {{(($currency->default_currency=='yes')? 'selected' : '')}}>Yes</option>
                              <option value="no" {{(($currency->default_currency=='no')? 'selected' : '')}}>No</option>
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
							<!-- /Edit Currency Modal -->

							<!-- Delete Currency Modal -->
							<div class="modal custom-modal fade" id="delete_currency_{{ $currency->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Currency</h3>
												<p>Are you sure want to delete {{ $currency->name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('currencies.destroy', $currency->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $currency->name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Currency Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Currency Modal -->
<div id="add_currency" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Currency</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('currencies.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="form-group">
						<label>Name <span class="text-danger">*</span></label>
						<input class="form-control" name="name" type="text">
					</div>
					<div class="form-group">
						<label>Code <span class="text-danger">*</span></label>
						<input class="form-control" name="code" type="text">
					</div>
					<div class="form-group">
						<label>Rate (%)  <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="rate">
					</div>
					<div class="form-group">
            <label for="status" class="col-form-label">Precision <span class="text-danger">*</span></label>
            <select name="precision" class="form-control">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
          </div>
          <div class="form-group">
						<label>Symbol  <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="symbol">
					</div>
					<div class="form-group">
            <label for="status" class="col-form-label">Symbol Position <span class="text-danger">*</span></label>
            <select name="symbol_position" class="form-control">
                <option value="after_amount">After Amount</option>
                <option value="before_amount">Before Amount</option>
            </select>
          </div>
          <div class="form-group">
						<label>Decimal Mark  <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="decimal_mark">
					</div>
					<div class="form-group">
						<label>Thousands Separator  <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="separate">
					</div>
					<div class="form-group">
            <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
          </div>
          <div class="form-group">
            <label for="status" class="col-form-label">Default Currency <span class="text-danger">*</span></label>
            <select name="default_currency" class="form-control">
                <option value="yes">Yes</option>
                <option value="no">No</option>
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
<!-- /Add Currency Modal -->

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