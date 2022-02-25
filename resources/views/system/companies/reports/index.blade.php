@extends('layouts.site')

@php( $page_name = 'Reports' )

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
    @include('layouts.includes.side-reports')
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
            <a href="{{ route('reports.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_report"><i class="fa fa-plus"></i> Add Report</a>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="#" class="btn add-btn" data-toggle="modal">
                 Print
            </a>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="{{ route('report.pdf') }}" class="btn add-btn" data-toggle="modal">
                 Export
            </a>
        </div>
    </div>
</div>
@include('layouts.includes.notifications')

<div class="row">
    <div class="col-md-12">
        <div>
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <th style="width: 30px;">#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->reports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->name }}</td>
                        <td>{{ $report->type }}</td>
                        <td>{{ $report->description }}</td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('reports.edit',$report->id)}}" data-toggle="modal" data-target="#edit_report_{{ $report->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ $report->id }}" data-toggle="modal" data-target="#delete_report_{{ $report->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>

                            <!-- Edit Report Modal -->
                            <div id="edit_report_{{ $report->id }}" class="modal right custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Report</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('reports.update', $report->id) }}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="PUT">

                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="name" value="{{ $report->name ?? old('name') }}">
                                                </div>
                                                <div class="form-group">
                                                  <label for="status" class="col-form-label">Type <span class="text-danger">*</span></label>
                                                  <select name="type" class="form-control">
                                                      <option value="expense_summary"  {{(($report->type=='expense_summary')? 'selected' : '')}}>Expense Summary</option>
                                                      <option value="income_summary" {{(($report->type=='income_summary')? 'selected' : '')}}>Income Summary</option>
                                                      <option value="income_expense" {{(($report->type=='income_expense')? 'selected' : '')}}>Income vs Expense</option>
                                                      <option value="profit_loss" {{(($report->type=='profit_loss')? 'selected' : '')}}>Profit & Loss</option>
                                                      <option value="tax_summary" {{(($report->type=='tax_summary')? 'selected' : '')}}>Tax Summary</option>
                                                  </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" rows="4" name="description">
                                                        {{ $report->description ?? old('description') }}
                                                    </textarea>
                                                </div>
                                                <div class="form-group">
                                                  <label for="status" class="col-form-label">Group By <span class="text-danger">*</span></label>
                                                  <select name="group_by" class="form-control">
                                                      <option value="account" {{(($report->group_by=='account')? 'selected' : '')}}>Account</option>
                                                      <option value="category" {{(($report->group_by=='category')? 'selected' : '')}}>Category</option>
                                                      <option value="vendor" {{(($report->group_by=='vendor')? 'selected' : '')}}>Vendor</option>
                                                  </select>
                                                </div>
                                                <div class="form-group">
                                                  <label for="status" class="col-form-label">Period <span class="text-danger">*</span></label>
                                                  <select name="period" class="form-control">
                                                      <option value="monthly" {{(($report->period=='monthly')? 'selected' : '')}}>Monthly</option>
                                                      <option value="quarterly" {{(($report->period=='quarterly')? 'selected' : '')}}>Quarterly</option>
                                                      <option value="yearly" {{(($report->period=='yearly')? 'selected' : '')}}>Yearly</option>
                                                  </select>
                                                </div>
                                                <div class="form-group">
                                                  <label for="status" class="col-form-label">Basis <span class="text-danger">*</span></label>
                                                  <select name="basis" class="form-control">
                                                      <option value="accrual" {{(($report->basis=='accrual')? 'selected' : '')}}>Accrual</option>
                                                      <option value="cash" {{(($report->basis=='cash')? 'selected' : '')}}>Cash</option>
                                                  </select>
                                                </div>
                                                <div class="form-group">
                                                  <label for="status" class="col-form-label">Chart <span class="text-danger">*</span></label>
                                                  <select name="chart" class="form-control">
                                                      <option value="disabled" {{(($report->chart=='disabled')? 'selected' : '')}}>Disabled</option>
                                                      <option value="line" {{(($report->chart=='line')? 'selected' : '')}}>Line</option>
                                                  </select>
                                                </div>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Edit Report Modal -->

                            <!-- Delete Report Modal -->
                            <div class="modal custom-modal fade" id="delete_report_{{ $report->id }}" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Delete Report</h3>
                                                <p>Are you sure want to delete {{ $report->name }}?</p>
                                            </div>
                                            <div class="modal-btn delete-action">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <form method="POST" action="{{ route('reports.destroy', $report->id) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $report->name }}\'s profile!')">Delete</button>
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
                            <!-- /Delete Report Modal -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>              
<!-- Add Report Modal -->
<div id="add_report" class="modal right custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('reports.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                      <label for="status" class="col-form-label">Type <span class="text-danger">*</span></label>
                      <select name="type" class="form-control">
                          <option value="expense_summary">Expense Summary</option>
                          <option value="income_summary">Income Summary</option>
                          <option value="income_expense">Income vs Expense</option>
                          <option value="profit_loss">Profit & Loss</option>
                          <option value="tax_summary">Tax Summary</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="4" name="description"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="status" class="col-form-label">Group By <span class="text-danger">*</span></label>
                      <select name="group_by" class="form-control">
                          <option value="account">Account</option>
                          <option value="category">Category</option>
                          <option value="vendor">Vendor</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="status" class="col-form-label">Period <span class="text-danger">*</span></label>
                      <select name="period" class="form-control">
                          <option value="monthly">Monthly</option>
                          <option value="quarterly">Quarterly</option>
                          <option value="yearly">Yearly</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="status" class="col-form-label">Basis <span class="text-danger">*</span></label>
                      <select name="basis" class="form-control">
                          <option value="accrual">Accrual</option>
                          <option value="cash">Cash</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="status" class="col-form-label">Chart <span class="text-danger">*</span></label>
                      <select name="chart" class="form-control">
                          <option value="disabled">Disabled</option>
                          <option value="line">Line</option>
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
<!-- /Add Report Modal -->

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