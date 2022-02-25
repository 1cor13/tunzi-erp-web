@extends('layouts.site')

@php( $page_name = 'Accounts' )

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
            <a href="{{ route('accounts.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_account"><i class="fa fa-plus"></i> Add Accounts</a>
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
                        <th>Name</th>
                        <th>Number</th>
                        <th>Current Balance</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->accounts as $account)
                    <tr>
                        <td>{{ $account->id }}</td>
                        <td><a href="#">{{ $account->name }}</a></td>
                        <td>{{ $account->number }}</td>
                        <td> {{ $account->opening_balance }}</td>
                        <th>
                            @if($account->status=='active')
                            <span class="badge badge-success">{{$account->status}}</span>
                            @else
                                <span class="badge badge-warning">{{$account->status}}</span>
                            @endif
                        </th>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('accounts.edit',$account->id)}}" data-toggle="modal" data-target="#edit_account_{{ $account->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ $account->id }}" data-toggle="modal" data-target="#delete_account_{{ $account->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>

                            <!-- Edit Account Modal -->
                            <div id="edit_account_{{ $account->id }}" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Account</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('accounts.update', $account->id) }}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Account Name</label>
                                                            <input class="form-control" type="text" name="name" value="{{ $account->name ?? old('name') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Number</label>
                                                            <input class="form-control" type="text" name="number" value="{{ $account->number ?? old('number') }}">
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
                                                            <label>Opening Balance</label>
                                                            <input class="form-control" type="number" name="opening_balance" value="{{ $account->opening_balance ?? old('opening_balance') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Bank Name</label>
                                                            <input class="form-control" type="text" name="bank_name" value="{{ $account->bank_name ?? old('bank_name') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Bank Phone</label>
                                                            <input class="form-control" type="text" name="bank_phone" value="{{ $account->bank_phone ?? old('bank_phone') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Bank Address <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" rows="4" name="bank_address">
                                                                {{ $account->bank_address ?? old('bank_address') }}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label for="status" class="col-form-label">Default Account <span class="text-danger">*</span></label>
                                                          <select name="default_account" class="form-control">
                                                              <option value="yes" {{(($account->default_account=='yes')? 'selected' : '')}}>Yes</option>
                                                              <option value="no" {{(($account->default_account=='no')? 'selected' : '')}}>No</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                                                          <select name="status" class="form-control">
                                                              <option value="active" {{(($account->status=='active')? 'selected' : '')}}>Active</option>
                                                              <option value="inactive" {{(($account->status=='inactive')? 'selected' : '')}}>Inactive</option>
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
                            <!-- /Edit Account Modal -->

                            <!-- Delete Account Modal -->
                            <div class="modal custom-modal fade" id="delete_account_{{ $account->id }}" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Delete Accounts </h3>
                                                <p>Are you sure want to delete {{ $account->name }}?</p>
                                            </div>
                                            <div class="modal-btn delete-action">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <form method="POST" action="{{ route('accounts.destroy', $account->id) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $account->name }}\'s profile!')">Delete</button>
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
                            <!-- /Delete Account Modal -->

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Account Modal -->
<div id="add_account" class="modal right custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('accounts.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Name</label>
                                <input class="form-control" type="text" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Number</label>
                                <input class="form-control" type="text" name="number">
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
                                <label>Opening Balance</label>
                                <input class="form-control" type="number" name="opening_balance">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Name</label>
                                <input class="form-control" type="text" name="bank_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Phone</label>
                                <input class="form-control" type="text" name="bank_phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="4" name="bank_address">
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="status" class="col-form-label">Default Account <span class="text-danger">*</span></label>
                              <select name="default_account" class="form-control">
                                  <option value="yes">Yes</option>
                                  <option value="no">No</option>
                              </select>
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
<!-- /Add Account Modal -->

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