@extends('layouts.site')

@php( $page_name = 'Employee Salary' )

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
			<a href="{{ route('salaries.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_salary"><i class="fa fa-plus"></i> Add Salary</a>
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
			<option value=""> -- Select -- </option>
			<option value="">Employee</option>
			<option value="1">Manager</option>
		</select>
		<label class="focus-label">Role</label>
	</div>
</div>
<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
	<div class="form-group form-focus select-focus">
		<select class="select floating"> 
			<option> -- Select -- </option>
			<option> Pending </option>
			<option> Approved </option>
			<option> Rejected </option>
		</select>
		<label class="focus-label">Leave Status</label>
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
	<div class="table-responsive">
		<table class="table table-striped custom-table datatable">
			<thead>
				<tr>
					<th>Employee</th>
					<th>Email</th>
					<th>Join Date</th>
					<th>Net Salary</th>
					<th>Payslip</th>
					<th>Status</th>
					<th class="text-right">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data->salaries as $salary)
				<tr>
					<td>
						<h2 class="table-avatar">
							<a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
							<a href="#">{{ $salary->employee->first_name }} - {{ $salary->employee->last_name }}<span>{{ $salary->employee->designation->designation_name }}</span></a>
						</h2>
					</td>
					<td>{{ $salary->employee->email }}</td>
					<td>{{ $salary->employee->joining_date }}</td>
					<td>{{ $salary->net_salary }}</td>
					<td><a class="btn btn-sm btn-primary" href="{{ route('salaries.show',$salary->id)}}">Generate Slip</a></td>
					<td>{{ $salary->status }}</td>
					<td class="text-right">
						<div class="dropdown dropdown-action">
							<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="{{ route('salaries.edit',$salary->id)}}" data-toggle="modal" data-target="#edit_salary_{{ $salary->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
								<a class="dropdown-item" href="{{ $salary->id }}" data-toggle="modal" data-target="#delete_salary_{{ $salary->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
							</div>
						</div>

						<!-- Edit Salary Modal -->
						<div id="edit_salary_{{ $salary->id }}" class="modal custom-modal fade" role="dialog">
							<div class="modal-dialog modal-dialog-centered modal-md" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Staff Salary</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="{{ route('salaries.update', $salary->id) }}" method="POST">
							            <input type="hidden" name="_token" value="{{ csrf_token() }}">
							            <input type="hidden" name="_method" value="PUT">

											<div class="row"> 
												<div class="col-sm-6"> 
													<div class="form-group">
														<label>Select Employee</label>
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
												<div class="col-sm-6"> 
													<label>Net Salary</label>
													<input class="form-control" type="text" value="{{ $salary->net_salary ?? old('net_salary') }}" name="net_salary">
												</div>
											</div>
											<div class="row"> 
												<div class="col-sm-6"> 
													<h4 class="text-primary">Earnings</h4>
													<div class="form-group">
														<label>Basic</label>
														<input class="form-control" type="text" value="{{ $salary->basic_salary ?? old('basic_salary') }}" name="basic_salary">
													</div>
													<div class="form-group">
														<label>House Rent Allowance (H.R.A.)(15%)</label>
														<input class="form-control" type="text" value="{{ $salary->house_allowance ?? old('house_allowance') }}" name="house_allowance">
													</div>
													<div class="form-group">
														<label>Conveyance</label>
														<input class="form-control" type="text" value="{{ $salary->conveyance ?? old('conveyance') }}" name="conveyance">
													</div>
													<div class="form-group">
														<label>Allowance</label>
														<input class="form-control" type="text" value="{{ $salary->allowance ?? old('allowance') }}" name="allowance">
													</div>
													<div class="form-group">
														<label>Medical  Allowance</label>
														<input class="form-control" type="text" value="{{ $salary->medical_allowance ?? old('medical_allowance') }}" name="medical_allowance">
													</div>
													<div class="form-group">
														<label>Others</label>
														<input class="form-control" type="text" value="{{ $salary->other_earning_allowance ?? old('other_earning_allowance') }}" name="other_earning_allowance">
													</div>
													<div class="form-group">
														<label>Total Earnings</label>
														<input class="form-control" type="text" value="{{ $salary->total_earnings ?? old('total_earnings') }}" name="total_earnings">
													</div>    
												</div>
												<div class="col-sm-6">  
													<h4 class="text-primary">Deductions</h4>
													<div class="form-group">
														<label>Provident Fund(PF)</label>
														<input class="form-control" type="text" value="{{ $salary->provident_fund ?? old('provident_fund') }}" name="provident_fund">
													</div>
													<div class="form-group">
														<label>Loan</label>
														<input class="form-control" type="text" value="{{ $salary->loan ?? old('loan') }}" name="loan">
													</div>
													<div class="form-group">
														<label>Leave</label>
														<input class="form-control" type="text" value="{{ $salary->leave ?? old('leave') }}" name="leave">
													</div>
													<div class="form-group">
														<label>Tax Deducted at Source (T.D.S.)</label>
														<input class="form-control" type="text" value="{{ $salary->tax_deducated ?? old('tax_deducated') }}" name="tax_deducated">
													</div>
													<div class="form-group">
														<label>Prof. Tax</label>
														<input class="form-control" type="text" value="{{ $salary->prof_tax ?? old('prof_tax') }}" name="prof_tax">
													</div>
													<div class="form-group">
														<label>Labour Welfare</label>
														<input class="form-control" type="text" value="{{ $salary->labour_welfare ?? old('labour_welfare') }}" name="labour_welfare">
													</div>
													<div class="form-group">
														<label>Others</label>
														<input class="form-control" type="text" value="{{ $salary->other_deduction_allowance ?? old('other_deduction_allowance') }}" name="other_deduction_allowance">
													</div>
													<div class="form-group">
														<label>Total Deductions</label>
														<input class="form-control" type="text" value="{{ $salary->total_deductions ?? old('total_deductions') }}" name="total_deductions">
													</div> 
												</div>
												<div class="col-sm-6"> 
													<label>Status</label>
													<input class="form-control" type="text" value="{{ $salary->status ?? old('status') }}" name="status">
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
						<!-- /Edit Salary Modal -->

						<!-- Delete Salary Modal -->
						<div class="modal custom-modal fade" id="delete_salary" role="dialog">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-body">
										<div class="form-header">
											<h3>Delete Salary</h3>
											<p>Are you sure want to delete?</p>
										</div>
										<div class="modal-btn delete-action">
											<div class="row">
												<div class="col-6">
													<a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
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
						<!-- /Delete Salary Modal -->
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
</div>

<!-- Add Salary Modal -->
<div id="add_salary" class="modal right custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Staff Salary</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('salaries.store') }}" method="POST" autocomplete="off">
	            @csrf
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<div class="row"> 
						<div class="col-sm-6"> 
							<div class="form-group">
								<label>Select Employee</label>
								<select class="select" name="employee_id">
								@foreach($data->employees as $emp)
	                            <option value="{{ $emp->id }}">
	                            	{{ $emp->first_name }} - {{ $emp->last_name }}
	                            </option>
	                            @endforeach
							</select>
							</div>
						</div>
						<div class="col-sm-6"> 
							<label>Net Salary</label>
							<input class="form-control" type="text" name="net_salary">
						</div>
					</div>
					<div class="row"> 
						<div class="col-sm-6"> 
							<h4 class="text-primary">Earnings</h4>
							<div class="form-group">
								<label>Basic</label>
								<input class="form-control" type="text" name="basic_salary">
							</div>
							<div class="form-group">
								<label>House Rent Allowance (H.R.A.)(15%)</label>
								<input class="form-control" type="text" name="house_allowance">
							</div>
							<div class="form-group">
								<label>Conveyance</label>
								<input class="form-control" type="text" name="conveyance">
							</div>
							<div class="form-group">
								<label>Allowance</label>
								<input class="form-control" type="text" name="allowance">
							</div>
							<div class="form-group">
								<label>Medical  Allowance</label>
								<input class="form-control" type="text" name="medical_allowance">
							</div>
							<div class="form-group">
								<label>Others</label>
								<input class="form-control" type="text" name="other_earning_allowance">
							</div>
							<div class="form-group">
								<label>Total Earnings</label>
								<input class="form-control" type="text" name="total_earnings">
							</div>    
						</div>
						<div class="col-sm-6">  
							<h4 class="text-primary">Deductions</h4>
							<div class="form-group">
								<label>Provident Fund(PF)</label>
								<input class="form-control" type="text" name="provident_fund">
							</div>
							<div class="form-group">
								<label>Loan</label>
								<input class="form-control" type="text" name="loan">
							</div>
							<div class="form-group">
								<label>Leave</label>
								<input class="form-control" type="text" name="leave">
							</div>
							<div class="form-group">
								<label>Tax Deducted at Source (T.D.S.)</label>
								<input class="form-control" type="text" name="tax_deducated">
							</div>
							<div class="form-group">
								<label>Prof. Tax</label>
								<input class="form-control" type="text" name="prof_tax">
							</div>
							<div class="form-group">
								<label>Labour Welfare</label>
								<input class="form-control" type="text" name="labour_welfare">
							</div>
							<div class="form-group">
								<label>Others</label>
								<input class="form-control" type="text" name="other_deduction_allowance">
							</div>
							<div class="form-group">
								<label>Total Deductions</label>
								<input class="form-control" type="text" name="total_deductions">
							</div> 
						</div>
						<div class="col-sm-6"> 
							<label>Status</label>
							<input class="form-control" type="text" name="status">
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
<!-- /Add Salary Modal -->

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