@extends('layouts.site')

@php( $page_name = 'Revenues' )

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
            <a href="{{ route('revenues.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_revenue"><i class="fa fa-plus"></i> Add Revenue</a>
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
                        <th>#</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Customer</th>
                        <th>Category</th>
                        <th>Account</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->revenues as $revenue)
                    <tr>
                        <td>{{ $revenue->id }}</td>
                        <td><a href="#">{{ $revenue->date }}</a></td>
                        <td>{{ $revenue->amount }}</td>
                        <td> {{ $revenue->customer->name }}</td>
                        <td> {{ $revenue->category->name }}</td>
                        <td> {{ $revenue->account->name }}</td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('revenues.edit',$revenue->id)}}" data-toggle="modal" data-target="#edit_revenue_{{ $revenue->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ $revenue->id }}" data-toggle="modal" data-target="#delete_revenue_{{ $revenue->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>

                            <!-- Edit Revenue Modal -->
                            <div id="edit_revenue_{{ $revenue->id }}" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Revenue</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('revenues.update', $revenue->id) }}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input class="form-control" type="date" name="date" value="{{ $revenue->date ?? old('date') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Amount</label>
                                                            <input class="form-control" type="text" name="amount" value="{{ $revenue->amount ?? old('amount') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Description <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" rows="4" name="description">{{ $revenue->description ?? old('description') }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label for="status" class="col-form-label">Recurring <span class="text-danger">*</span></label>
                                                          <select name="recurring" class="form-control">
                                                            <option value="no" {{(($revenue->recurring=='no')? 'selected' : '')}}>No</option>
                                                            <option value="daily" {{(($revenue->recurring=='daily')? 'selected' : '')}}>Daily</option>
                                                            <option value="weekly" {{(($revenue->recurring=='weekly')? 'selected' : '')}}>Weekly</option>
                                                              <option value="monthly" {{(($revenue->recurring=='monthly')? 'selected' : '')}}>Monthly</option>
                                                              <option value="yearly" {{(($revenue->recurring=='yearly')? 'selected' : '')}}>Yearly</option>
                                                              <option value="custom" {{(($revenue->recurring=='custom')? 'selected' : '')}}>Custom</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label for="status" class="col-form-label">Payment Method <span class="text-danger">*</span></label>
                                                          <select name="pay_method" class="form-control">
                                                            <option value="bank_transfer" {{(($revenue->pay_method=='bank_transfer')? 'selected' : '')}}>Bank Transfer</option>
                                                            <option value="cash" {{(($revenue->pay_method=='cash')? 'selected' : '')}}>Cash</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Reference </label>
                                                            <input class="form-control" name="reference" type="text" value="{{ $revenue->reference ?? old('reference') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Attachment <span class="text-danger">*</span></label>
                                                            <input class="form-control" name="attachment" type="file" value="{{ $revenue->attachment ?? old('attachment') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Account</label>
                                                             <select class="select" name="account_id">
                                                                <option>Select</option>
                                                                @foreach($data->accounts as $account)
                                                                <option value="{{ $account->id }}">
                                                                    {{ $account->name }}
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
                                                            <label>Invoice</label>
                                                             <select class="select" name="invoice_id">
                                                                <option>Select</option>
                                                                @foreach($data->invoices as $invoice)
                                                                <option value="{{ $invoice->id }}">
                                                                    {{ $invoice->invoice_number }}
                                                                </option>
                                                                @endforeach
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
                            <!-- /Edit Revenue Modal -->

                            <!-- Delete Revenue Modal -->
                            <div class="modal custom-modal fade" id="delete_revenue_{{ $revenue->id }}" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Delete Revenue </h3>
                                                <p>Are you sure want to delete {{ $revenue->date }}?</p>
                                            </div>
                                            <div class="modal-btn delete-action">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <form method="POST" action="{{ route('revenues.destroy', $revenue->id) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $revenue->date }}\'s profile!')">Delete</button>
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
                            <!-- /Delete Revenue Modal -->

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Revenue Modal -->
<div id="add_revenue" class="modal right custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Revenue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('revenues.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input class="form-control" type="date" name="date">
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
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="4" name="description"></textarea>
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
                              <label for="pay_method" class="col-form-label">Payment Method <span class="text-danger">*</span></label>
                              <select name="pay_method" class="form-control">
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="cash">Cash</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Reference </label>
                                <input class="form-control" name="reference" type="text">
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
                                <label>Account</label>
                                 <select class="select" name="account_id">
                                    @foreach($data->accounts as $account)
                                    <option value="{{ $account->id }}">
                                        {{ $account->name }}
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
                                <label>Invoice</label>
                                 <select class="select" name="invoice_id">
                                    @foreach($data->invoices as $invoice)
                                    <option value="{{ $invoice->id }}">
                                        {{ $invoice->invoice_number }}
                                    </option>
                                    @endforeach
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
<!-- /Add Revenue Modal -->

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