@extends('layouts.site')

@php( $page_name = 'Transactions' )

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
            <a href="{{ route('revenues.index') }}" target="_blank" class="btn add-btn">Add Income</a>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="{{ route('payments.index') }}" target="_blank" class="btn add-btn">Add Expense</a>
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
                        <th>Type</th>
                        <th>Category</th>
                        <th>Account</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td><a href="{{ route('revenues.update', $revenue->id) }}">{{ $transaction->date }}</a></td>
                        <td>{{ $transaction->amount }}</td>
                        <td> {{ $transaction->type }}</td>
                        <td> {{ $transaction->category->name }}</td>
                        <td> {{ $transaction->account->name }}</td>
                        <td> {{ $transaction->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

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