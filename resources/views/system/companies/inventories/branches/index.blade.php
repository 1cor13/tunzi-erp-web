@extends('layouts.site')

@php( $page_name = 'Company Branches' )

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
     @include('layouts.includes.side-inventory')
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
            <a href="{{ route('branches.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_branch"><i class="fa fa-plus"></i> Add Branch</a>
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
            <input type="text" class="form-control floating">
            <label class="focus-label">Branch ID</label>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">  
        <div class="form-group form-focus">
            <input type="text" class="form-control floating">
            <label class="focus-label">Branch Name</label>
        </div>
    </div>
    <div class="col-sm-6 col-md-3"> 
        <div class="form-group form-focus select-focus">
            <select class="select floating"> 
                <option>Select Company</option>
                <option>Global Technologies</option>
                <option>Delta Infotech</option>
            </select>
            <label class="focus-label">Company</label>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">  
        <a href="#" class="btn btn-success btn-block"> Search </a>  
    </div>     
</div>
<!-- Search Filter -->

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name </th>
                        <th>Code </th>
                        <th>Email </th>
                        <th>Phone</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->branches as $branch)
                    <tr>
                        <td>{{ $branch->id }}</td>
                        <td>
                            <h2 class="table-avatar blue-link">
                                <a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
                                <a href="#">{{ $branch->branch_name }}</a>
                            </h2>
                        </td>
                        <td>{{ $branch->branch_code }}</td>
                        <td>{{ $branch->branch_email }}</td>
                        <td>{{ $branch->branch_phone2 }}</td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('branches.edit',$branch->id)}}" data-toggle="modal" data-target="#edit_branch_{{ $branch->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ $branch->id }}" data-toggle="modal" data-target="#delete_branch_{{ $branch->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>

                            <!-- Edit Branch Modal -->
                            <div id="edit_branch_{{ $branch->id }}" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Branch</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('branches.update', $branch->id) }}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Branch Name <span class="text-danger">*</span></label>
                                                            <input class="form-control" name="branch_name" type="text" value="{{ $branch->branch_name ?? old('branch_name') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Branch Code</label>
                                                            <input class="form-control" name="branch_code" type="text" value="{{ $branch->branch_code ?? old('branch_code') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Branch Email<span class="text-danger">*</span></label>
                                                            <input class="form-control floating" name="branch_email" type="email" value="{{ $branch->branch_email ?? old('branch_email') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Branch Phone <span class="text-danger">*</span></label>
                                                            <input class="form-control" name="branch_phone2" type="text" value="{{ $branch->branch_phone2 ?? old('branch_phone2') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Description</label>
                                                            <textarea  rows="2" cols="3" name="branch_description">
                                                                {{ $branch->branch_description ?? old('branch_description') }}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Street </label>
                                                            <input class="form-control" name="branch_street" type="text" value="{{ $branch->branch_street ?? old('branch_street') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Open Hours </label>
                                                            <input class="form-control" name="open_hours" type="text" value="{{ $branch->open_hours ?? old('open_hours') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">GPS Latitude </label>
                                                            <input class="form-control" name="gps_lat" type="text" value="{{ $branch->gps_lat ?? old('gps_lat') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">GPS Longitude </label>
                                                            <input class="form-control" name="gps_long" type="text" value="{{ $branch->gps_long ?? old('gps_long') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Status </label>
                                                            <input class="form-control" name="branch_status" type="text" value="{{ $branch->branch_status ?? old('branch_status') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Customer<span class="text-danger">*</span></label>
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
                                                            <label>District<span class="text-danger">*</span></label>
                                                            <select class="select" name="district_id">
                                                                <option>Select</option>
                                                                @foreach($data->districts as $district)
                                                                <option value="{{ $district->id }}">
                                                                    {{ $district->district_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Village<span class="text-danger">*</span></label>
                                                            <select class="select" name="village_id">
                                                                <option>Select</option>
                                                                @foreach($data->villages as $village)
                                                                <option value="{{ $village->id }}">
                                                                    {{ $village->village_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Gallery<span class="text-danger">*</span></label>
                                                            <select class="select" name="gallery_id">
                                                                <option>Select</option>
                                                                @foreach($data->galleries as $gallery)
                                                                <option value="{{ $gallery->id }}">
                                                                    {{ $gallery->gallery_name }}
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
                            <!-- /Edit Branch Modal -->

                            <!-- Delete Branch Modal -->
                            <div class="modal custom-modal fade" id="delete_branch_{{ $branch->id }}" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Delete Branch</h3>
                                                <p>Are you sure want to delete {{ $branch->branch_name }}?</p>
                                            </div>
                                            <div class="modal-btn delete-action">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <form method="POST" action="{{ route('branches.destroy', $branch->id) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $branch->branch_name }}\'s profile!')">Delete</button>
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
                            <!-- /Delete Branch Modal -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Branch Modal -->
<div id="add_branch" class="modal right custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('branches.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Branch Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="branch_name" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Branch Code</label>
                                <input class="form-control" name="branch_code" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Branch Email<span class="text-danger">*</span></label>
                                <input class="form-control floating" name="branch_email" type="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Branch Phone <span class="text-danger">*</span></label>
                                <input class="form-control" name="branch_phone2" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Description</label>
                                <textarea class="form-control" rows="4" name="branch_description">
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Street </label>
                                <input class="form-control" name="branch_street" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Open Hours </label>
                                <input class="form-control" name="open_hours" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">GPS Latitude </label>
                                <input class="form-control" name="gps_lat" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">GPS Longitude </label>
                                <input class="form-control" name="gps_long" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Status </label>
                                <input class="form-control" name="branch_status" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer<span class="text-danger">*</span></label>
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
                                <label>District<span class="text-danger">*</span></label>
                                <select class="select" name="district_id">
                                    @foreach($data->districts as $district)
                                    <option value="{{ $district->id }}">
                                        {{ $district->district_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Village<span class="text-danger">*</span></label>
                                <select class="select" name="village_id">
                                    @foreach($data->villages as $village)
                                    <option value="{{ $village->id }}">
                                        {{ $village->village_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gallery<span class="text-danger">*</span></label>
                                <select class="select" name="gallery_id">
                                    @foreach($data->galleries as $gallery)
                                    <option value="{{ $gallery->id }}">
                                        {{ $gallery->gallery_name }}
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
<!-- /Add Branch Modal -->

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