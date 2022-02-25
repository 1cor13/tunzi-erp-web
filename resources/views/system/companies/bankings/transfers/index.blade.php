@extends('layouts.site')

@php( $page_name = 'Transfers' )

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
            <a href="{{ route('transfers.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_transfer"><i class="fa fa-plus"></i> Add Transfers</a>
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
                        <th>From Account</th>
                        <th>To Account</th>
                        <th>Amount</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->transfers as $transfer)
                    <tr>
                        <td>{{ $transfer->id }}</td>
                        <td><a href="#">{{ $transfer->date }}</a></td>
                        <td>{{ $transfer->account->name }}</td>
                        <td> {{ $transfer->account->name }}</td>
                        <td> {{ $transfer->amount }} </td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('transfers.edit',$transfer->id)}}" data-toggle="modal" data-target="#edit_transfer_{{ $transfer->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ $transfer->id }}" data-toggle="modal" data-target="#delete_transfer_{{ $transfer->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>

                            <!-- Edit Transfer Modal -->
                            <div id="edit_transfer_{{ $transfer->id }}" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Transfer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('transfers.update', $transfer->id) }}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>From Account</label>
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
                                                            <label>To Account</label>
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
                                                            <label>Amount</label>
                                                            <input class="form-control" type="text" name="amount" value="{{ $transfer->amount ?? old('amount') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input class="form-control" type="date" name="date" value="{{ $transfer->date ?? old('date') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Description <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" rows="4" name="description">
                                                                {{ $transfer->description ?? old('description') }}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label for="status" class="col-form-label">Payment Method <span class="text-danger">*</span></label>
                                                          <select name="pay_method" class="form-control">
                                                              <option value="cash" {{(($transfer->pay_method=='cash')? 'selected' : '')}}>Cash</option>
                                                              <option value="bank_transfer" {{(($transfer->pay_method=='bank_transfer')? 'selected' : '')}}>Bank Transfer</option>
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
                            <!-- /Edit Transfer Modal -->

                            <!-- Delete Transfer Modal -->
                            <div class="modal custom-modal fade" id="delete_transfer_{{ $transfer->id }}" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Delete Transfers </h3>
                                                <p>Are you sure want to delete {{ $transfer->name }}?</p>
                                            </div>
                                            <div class="modal-btn delete-action">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <form method="POST" action="{{ route('transfers.destroy', $transfer->id) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $transfer->name }}\'s profile!')">Delete</button>
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
                            <!-- /Delete Transfer Modal -->

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Transfer Modal -->
<div id="add_transfer" class="modal right custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Transfer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('transfers.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>From Account</label>
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
                                <label>To Account</label>
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
                                <label>Amount</label>
                                <input class="form-control" type="text" name="amount">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input class="form-control" type="date" name="date" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="4" name="description">
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="status" class="col-form-label">Payment Method <span class="text-danger">*</span></label>
                              <select name="pay_method" class="form-control">
                                  <option value="cash">Cash</option>
                                  <option value="bank_transfer">Bank Transfer</option>
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
<!-- /Add Transfer Modal -->

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