@extends('layouts.site')

@php( $page_name = 'Invoices' )

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
			<a href="{{ route('invoices.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_invoice"><i class="fa fa-plus"></i> Add Invoice</a>
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

<!-- Search Filter -->
<div class="row filter-row">
	<div class="col-sm-6 col-md-3">  
		<div class="form-group form-focus">
			<div class="cal-icon">
				<input class="form-control floating datetimepicker" type="text">
			</div>
			<label class="focus-label">From</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">  
		<div class="form-group form-focus">
			<div class="cal-icon">
				<input class="form-control floating datetimepicker" type="text">
			</div>
			<label class="focus-label">To</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3"> 
		<div class="form-group form-focus select-focus">
			<select class="select floating"> 
				<option>Select Status</option>
				<option>Pending</option>
				<option>Paid</option>
				<option>Partially Paid</option>
			</select>
			<label class="focus-label">Status</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">  
		<a href="#" class="btn btn-success btn-block"> Search </a>  
	</div>     
</div>
<!-- /Search Filter -->

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0 datatable">
				<thead>
					<tr>
						<th>Number</th>
						<th>Customer</th>
                        <th>Amount</th>
                        <th>Invoice Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->invoices as $invoice)
					<tr>
						<td><a href="#">{{ $invoice->invoice_number }}</a></td>
						<td>{{ $invoice->customer->name }}</td>
						<td>{{ $invoice->amount }}</td>
						<td>{{ $invoice->invoice_date }}</td>
						<td>{{ $invoice->due_date }}</td>
						<td>
							@if($invoice->status=='draft')
                            <span class="badge badge-success">{{$invoice->status}}</span>
	                        @else
	                            <span class="badge badge-warning">{{$invoice->status}}</span>
	                        @endif
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('invoices.edit',$invoice->id)}}" data-toggle="modal" data-target="#edit_invoice_{{ $invoice->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{ $invoice->id }}" data-toggle="modal" data-target="#delete_invoice_{{ $invoice->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Invoice Modal -->
							<div id="edit_invoice_{{ $invoice->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Invoice</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
								            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								            <input type="hidden" name="_method" value="PUT">

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Company</label>
															 <select class="select" name="company_id">
															 	<option>Select</option>
                                                                @foreach($data->companies as $company)
                                                                <option value="{{ $company->id }}">
                                                                	{{ $company->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Customer</label>
															 <select class="select" name="customer_id">
															 	<option>Select</option>
                                                                @foreach($data->customers as $customer)
                                                                <option value="{{ $customer->id }}">
                                                                	{{ $customer->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Invoice Date</label>
															<input class="form-control" type="date" name="invoice_date" value="{{ $invoice->invoice_date ?? old('invoice_date') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Invoice Number</label>
															<input class="form-control" type="text" name="invoice_number" value="{{ $invoice->invoice_number ?? old('invoice_number') }}">
														</div>
													</div>
													
													<div class="col-md-6">
														<div class="form-group">
															<label>Due Date</label>
															<input class="form-control" type="date" name="due_date" value="{{ $invoice->due_date ?? old('due_date') }}">
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label>Product</label>
															 <select class="select" name="product_id">
															 	<option>Select</option>
                                                                @foreach($data->products as $product)
                                                                <option value="{{ $product->id }}">
                                                                	{{ $product->product_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Quantity</label>
															<input class="form-control" type="number" name="quantity" min="0" value="{{ $invoice->quantity ?? old('quantity') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Amount</label>
															<input class="form-control" type="text" name="amount" value="{{ $invoice->amount ?? old('amount') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Sub Total</label>
															<input class="form-control" type="number" name="subtotal" value="{{ $invoice->subtotal ?? old('subtotal') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Discount(%)</label>
															<input class="form-control" type="number" name="discount" min="0" max="100" value="{{ $invoice->discount ?? old('discount') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Total</label>
															<input class="form-control" type="number" name="total" value="{{ $invoice->total ?? old('total') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Currency</label>
															 <select class="select" name="currency_id">
															 	<option>Select</option>
                                                                @foreach($data->currencies as $currency)
                                                                <option value="{{ $currency->id }}">
                                                                	{{ $currency->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Notes <span class="text-danger">*</span></label>
															<textarea class="form-control" rows="4" cols="4" name="notes">{{ $invoice->notes ?? old('notes') }}</textarea>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Footer <span class="text-danger">*</span></label>
															<textarea class="form-control" rows="4" name="footer">{{ $invoice->footer ?? old('footer') }}</textarea>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
		                                                  <label for="recurring" class="col-form-label">Recurring <span class="text-danger">*</span></label>
		                                                  <select name="recurring" class="form-control">
		                                                  	<option value="no" {{(($invoice->recurring=='no')? 'selected' : '')}}>No</option>
		                                                  	<option value="daily" {{(($invoice->recurring=='daily')? 'selected' : '')}}>Daily</option>
		                                                  	<option value="weekly" {{(($invoice->recurring=='weekly')? 'selected' : '')}}>Weekly</option>
		                                                      <option value="monthly" {{(($invoice->recurring=='monthly')? 'selected' : '')}}>Monthly</option>
		                                                      <option value="yearly" {{(($invoice->recurring=='yearly')? 'selected' : '')}}>Yearly</option>
		                                                      <option value="custom" {{(($invoice->recurring=='custom')? 'selected' : '')}}>Custom</option>
		                                                  </select>
		                                                </div>
		                                            </div>
	                                                <div class="col-md-6">
														<div class="form-group">
															<label>Category</label>
															 <select class="select" name="category_id">
															 	<option>Select</option>
                                                                @foreach($data->categories as $category)
                                                                <option value="{{ $category->id }}">
                                                                	{{ $category->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Attachment <span class="text-danger">*</span></label>
															<input class="form-control" name="attachment" type="file" value="{{ $invoice->attachment ?? old('attachment') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
								                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
								                          <select name="status" class="form-control">
								                              <option value="draft"  {{(($invoice->status=='draft')? 'selected' : '')}}>Draft</option>
								                              <option value="paid" {{(($invoice->status=='paid')? 'selected' : '')}}>Paid</option>
								                          </select>
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
							<!-- /Edit Invoice Modal -->

							<!-- Delete Invoice Modal -->
							<div class="modal custom-modal fade" id="delete_invoice_{{ $invoice->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Invoice</h3>
												<p>Are you sure want to delete {{ $invoice->invoice_number }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('invoices.destroy', $invoice->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $invoice->invoice_number }}\'s profile!')">Delete</button>
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
							<!-- /Delete Invoice Modal -->

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Invoice Modal -->
<div id="add_invoice" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Invoice</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('invoices.store') }}" method="POST" autocomplete="off">
	            @csrf
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Company</label>
								 <select class="select" name="company_id">
                                    @foreach($data->companies as $company)
                                    <option value="{{ $company->id }}">
                                    	{{ $company->name }}
                                    </option>
                                    @endforeach
                                </select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Customer</label>
								 <select class="select" name="customer_id">
                                    @foreach($data->customers as $customer)
                                    <option value="{{ $customer->id }}">
                                    	{{ $customer->name }}
                                    </option>
                                    @endforeach
                                </select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Invoice Date</label>
								<input class="form-control" type="date" name="invoice_date">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Invoice Number</label>
								<input class="form-control" type="text" name="invoice_number">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Due Date</label>
								<input class="form-control" type="date" name="due_date">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Product</label>
								 <select class="select" name="product_id">
                                    @foreach($data->products as $product)
                                    <option value="{{ $product->id }}">
                                    	{{ $product->product_name }}
                                    </option>
                                    @endforeach
                                </select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Quantity</label>
								<input class="form-control" type="number" name="quantity" min="0">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Amount</label>
								<input class="form-control" type="text" name="amount">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Sub Total</label>
								<input class="form-control" type="number" name="subtotal">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Discount(%)</label>
								<input class="form-control" type="number" name="discount" min="0" max="100">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Total</label>
								<input class="form-control" type="number" name="total">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Currency</label>
								 <select class="select" name="currency_id">
                                    @foreach($data->currencies as $currency)
                                    <option value="{{ $currency->id }}">
                                    	{{ $currency->name }}
                                    </option>
                                    @endforeach
                                </select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Notes <span class="text-danger">*</span></label>
								<textarea class="form-control" rows="4" name="notes"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Footer <span class="text-danger">*</span></label>
								<textarea class="form-control" rows="4" name="footer"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
	                          <label for="recurring" class="col-form-label">Recurring <span class="text-danger">*</span></label>
	                          <select name="recurring" class="form-control">
	                          	<option value="no">No</option>
	                          	<option value="daily">Daily</option>
	                          	<option value="weekly">Weekly</option>
	                              <option value="monthly">Monthly</option>
	                              <option value="yearly">Yearly</option>
	                              <option value="custom">Custom</option>
	                          </select>
	                        </div>
	                    </div>
                        <div class="col-md-6">
							<div class="form-group">
								<label>Category</label>
								 <select class="select" name="category_id">
                                    @foreach($data->categories as $category)
                                    <option value="{{ $category->id }}">
                                    	{{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Attachment <span class="text-danger">*</span></label>
								<input class="form-control" name="attachment" type="file">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
	                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
	                          <select name="status" class="form-control">
	                              <option value="draft">Draft</option>
	                              <option value="paid">Paid</option>
	                          </select>
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
<!-- /Add Invoice Modal -->

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