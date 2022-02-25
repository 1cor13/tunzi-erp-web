@extends('layouts.site')

@php( $page_name = 'Categories' )

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
<div class="page-header">
	<div class="row align-items-center">
		<div class="col">
			<h3 class="page-title">{{ $page_name }}</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="la la-home"></i> Home</a></li>
				<li class="breadcrumb-item active"><i class="la la-bars"></i> {{ $page_name }}</li>
			</ul>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="{{ route('categories.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_category"><i class="fa fa-plus"></i> Add Category</a>
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
						<th>Name</th>
						<th>Type</th>
						<th>Status</th>
						<th class="text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->categories as $category)
					<tr>
						<td>{{ $category->id }}</td>
						<td>{{ $category->name }}</td>
						<td>{{ $category->type }}</td>
						<td>
							@if($category->status=='active')
                            <span class="badge badge-success">{{$category->status}}</span>
	                        @else
	                            <span class="badge badge-warning">{{$category->status}}</span>
	                        @endif
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('categories.edit',$category->id)}}" data-toggle="modal" data-target="#edit_category_{{ $category->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_category_{{ $category->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>

							<!-- Edit Category Modal -->
							<div id="edit_category_{{ $category->id }}" class="modal right custom-modal fade" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Category</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											@include('layouts.partials.form-error')
											<form action="{{ route('categories.update', $category->id) }}" method="POST">
								            	@csrf
								            	@method('PATCH')
								            	<div class="row">
									            	<div class="form-group col-md-6">
														<label>Name <span class="text-danger">*</span></label>
														<input class="form-control" name="name" type="text" value="{{ $category->name ?? old('name') }}">
													</div>
													<div class="form-group">
							                          <label for="status" class="col-form-label">Type <span class="text-danger">*</span></label>
							                          <select name="type" class="form-control">
							                              <option value="expense"  {{(($category->type=='expense')? 'selected' : '')}}>Expense</option>
							                              <option value="income" {{(($category->type=='income')? 'selected' : '')}}>Income</option>
							                              <option value="item" {{(($category->type=='item')? 'selected' : '')}}>Item</option>
							                              <option value="other" {{(($category->type=='other')? 'selected' : '')}}>Other</option>
							                          </select>
							                        </div>
													<div class="form-group">
							                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
							                          <select name="status" class="form-control">
							                              <option value="active"  {{(($category->status=='active')? 'selected' : '')}}>Active</option>
							                              <option value="inactive" {{(($category->status=='inactive')? 'selected' : '')}}>Inactive</option>
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
							<!-- /Edit Category Modal -->

							<!-- Delete Category Modal -->
							<div class="modal custom-modal fade" id="delete_category_{{ $category->id }}" role="dialog">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-body">
											<div class="form-header">
												<h3>Delete Product Category</h3>
												<p>Are you sure want to delete this leave {{ $category->category_name }}?</p>
											</div>
											<div class="modal-btn delete-action">
												<div class="row">
													<div class="col-6">
														<form method="POST" action="{{ route('categories.destroy', $category->id) }}">
							                                {{ csrf_field() }}
							                                {{ method_field('DELETE') }}
							                                <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $category->category_name }}\'s profile!')">Delete</button>
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
							<!-- /Delete Category Modal -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Category Modal -->
<div id="add_category" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				@include('layouts.partials.form-error')
				<form action="{{ route('categories.store') }}" method="POST" autocomplete="off">
	                @csrf
        	        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        	        <div class="row">
						<div class="form-group col-md-6">
							<label>Name <span class="text-danger">*</span></label>
							<input class="form-control" name="name" type="text" >
						</div>
						<div class="form-group">
                          <label for="status" class="col-form-label">Type <span class="text-danger">*</span></label>
                          <select name="type" class="form-control">
                              <option value="expense">Expense</option>
                              <option value="income">Income</option>
                              <option value="item">Item</option>
                              <option value="other">Other</option>
                          </select>
                        </div>
						<div class="form-group">
                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                          <select name="status" class="form-control">
                              <option value="active">Active</option>
                              <option value="inactive">Inactive</option>
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
<!-- /Add Category Modal -->

@endsection
@section('scripts')

<!-- Select2 JS -->
	<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
        <!-- Datetimepicker JS -->
        <script src="{{ asset('assets/js/moment.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
        <!-- Datatable JS -->
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                // $('.select').select2({
                //     width: 'resolve' // need to override the changed default
                // });

                $('.select2').select2({
                    width: 'resolve' // need to override the changed default
                });

                $('select.select2').select2({
                    dropdownParent: $('.custom-modal')
                });
            });
        </script>
        <script>
          let tagArr = document.getElementsByTagName("input");
          for (let i = 0; i < tagArr.length; i++) {
            tagArr[i].autocomplete = 'off';
          }
        </script>

@endsection