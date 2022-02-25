@extends('layouts.site')

@php( $page_name = 'Products' )

@section('title', $page_name)
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('sidebar')
     @include('layouts.includes.side-inventory')
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
			<a href="{{ route('products.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_product"><i class="fa fa-plus"></i> Add Product</a>
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
						<th>#</th>
						<th>Product Image</th>
						<th>Product Name</th>
						<th>Category</th>
						<th>Sales Price</th>
						<th>Purchase Price</th>
						<th>Status</th>
						<th class="text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->products as $product)
					<tr>
						<td>{{ $product->id }}</td>
						<td><img src="{{ Storage::url($product->image) }}" height="75" width="75" alt="" /></td>
						<td>{{ $product->product_name }}</td>
						<td>{{ $product->category->name }}</td>
						<td>{{ $product->sale_price }}</td>
						<td>{{ $product->purchase_price }}</td>
						<td>
							@if($product->status=='active')
                            <span class="badge badge-success">{{$product->status}}</span>
	                        @else
	                            <span class="badge badge-warning">{{$product->status}}</span>
	                        @endif
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('products.edit',$product->id)}}" data-toggle="modal" data-target="#edit_product_{{ $product->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_product_{{ $product->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Product Modal -->
							<div id="edit_product_{{ $product->id }}" class="modal custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Product</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
												@csrf
												@method('PATCH')
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Product Name <span class="text-danger">*</span></label>
															<input class="form-control" name="product_name" type="text" value="{{ $product->product_name ?? old('product_name') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Tax <span class="text-danger">*</span></label>
															<select class="select2" name="tax_id">
																<option value="">Select</option>
																@foreach($data->taxes as $tax)
																<option value="{{ $tax->id }}"> {{ $tax->name }} </option>
									                            		@endforeach
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Description <span class="text-danger">*</span></label>
															<textarea class="form-control" rows="4" name="description">{{ $product->description ?? old('description') }}</textarea>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Sale Price <span class="text-danger">*</span></label>
															<input class="form-control" name="sale_price" type="text" value="{{ $product->sale_price ?? old('sale_price') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Purchase Price <span class="text-danger">*</span></label>
															<input class="form-control" name="purchase_price" type="text" value="{{ $product->purchase_price ?? old('purchase_price') }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Category <span class="text-danger">*</span></label>
															<select class="select" name="category_id">
																<option>Select</option>
																@foreach($data->categories as $category)
																<option value="{{ $category->id }}"> {{ $category->name }} </option>
									                            		@endforeach
															</select>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Upload Image <span class="text-danger">*</span></label>
															<input class="form-control" name="image" type="file" value="{{ $product->image ?? old('image') }}">
														</div>
														<div class="form-group">
															<img src="{{ Storage::url($product->image) }}" height="75" width="75" alt="" />
														</div>
													</div>
													<div class="form-group">
														<label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
														<select name="status" class="form-control">
									                              <option value="active"  {{ $product->status=='active' ? 'selected' : '' }}>Active</option>
									                              <option value="inactive" {{ $product->status=='inactive' ? 'selected' : '' }}>Inactive</option>
									                         </select>
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
							<!-- /Edit Product Modal -->

							<!-- Delete Product Modal -->
							<div class="modal custom-modal fade" id="delete_product_{{ $product->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Product</h3>
												<p>Are you sure want to delete this leave {{ $product->product_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('products.destroy', $product->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $product->product_name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Product Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Product Modal -->
<div id="add_product" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Product</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('products.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	@csrf
	                	<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
	                	<div class="row">
	                		<div class="col-md-6">
							<div class="form-group">
								<label>Product Name <span class="text-danger">*</span></label>
								<input class="form-control" name="product_name" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Tax <span class="text-danger">*</span></label>
								<select class="select" name="tax_id">
									@foreach($data->taxes as $tax)
									<option value="{{ $tax->id }}"> {{ $tax->name }} </option>
	                            			@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Description <span class="text-danger">*</span></label>
								<textarea class="form-control" rows="4" name="description"></textarea>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Sale Price <span class="text-danger">*</span></label>
								<input class="form-control" name="sale_price" type="text">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Purchase Price <span class="text-danger">*</span></label>
								<input class="form-control" name="purchase_price" type="text">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Currency <span class="text-danger">*</span></label>
								<select class="select" name="currency_id">
									@foreach($data->categories as $category)
									<option value="{{ $category->id }}"> {{ $category->name }} </option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Category <span class="text-danger">*</span></label>
								<select class="select" name="category_id">
									@foreach($data->categories as $category)
									<option value="{{ $category->id }}"> {{ $category->name }} </option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Upload Image <span class="text-danger">*</span></label>
								<input class="form-control" name="image" type="file">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
								<select name="status" class="form-control">
									<option value="active">Active</option>
									<option value="inactive">Inactive</option>
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
<!-- /Add Product Modal -->

@endsection
@section('scripts')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/moment.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
@endsection