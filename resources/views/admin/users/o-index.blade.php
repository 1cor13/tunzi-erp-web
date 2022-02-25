@extends('layouts.site')

@php( $page_name = 'System Users' )

@section('title', $page_name)
@section('styles')
<!-- Select2 CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
        <!-- Datetimepicker CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
        <!-- Datatable CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('sidebar')
    @include('layouts.includes.side-admin')
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">{{ $page_name }}</h3>
            <ul class="breadcrumb">
            	<li class="breadcrumb-item"><a href="{{ route('userhome') }}"> <i class="la la-home"></i> User Home</a></li>
		        <li class="breadcrumb-item"><a href="{{ route('admin') }}"> <i class="la la-user-plus"></i> Admin </a></li>
                <li class="breadcrumb-item active"><i class="la la-users mt-1 mr-1"></i> {{ $page_name }}</li>
            </ul>
        </div>

        <div class="col-auto float-right ml-auto">
            <a href="{{ route('users.create') }}" class="btn add-btn btn-sm @if ($errors->any()) bg-danger shakeButton animated shake @endif mt-1" data-toggle="modal" data-target="#create_user_profile"><i class="fa fa-plus"></i> Add User</a>
            <div class="view-icons">
                <a href="javascript:void(0);" class="grid-view btn btn-link" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-th m-1" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('users.index') }}">All Users</a>
                    <a class="dropdown-item" href="{{ route('users.index', ['view'=>'with-trashed']) }}">All with trashed</a>
                    <a class="dropdown-item" href="{{ route('users.index', ['view'=>'trashed']) }}"><i class="fa fa-trash text-danger"></i> Only trashed</a>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Add new user -->
    <div id="create_user_profile" class="modal right custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create user profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
                        @csrf
                        @include('layouts.partials.form-error')
            
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Full Name <span class="text-danger">*</span></label>
                                    <input class="form-control" name="name" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Initial Password (min: 6)<span class="text-danger">*</span></label>
                                    <input class="form-control" name="password" type="password" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" name="country_id">
                                        @foreach($data->countries as $country)
                                            <option value="{{ $country->id }}">
                                                {{ $country->country_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input class="form-control" name="email" type="email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender_id">
                                        @foreach($data->genders as $gender)
                                        <option value="{{ $gender->id }}">
                                            {{ $gender->gender_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" name="username" type="text" autocomplete="false">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone </label>
                                    <input class="form-control" name="phone" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Company</label>
                                    <select class="form-control" name="company_id">
                                        @foreach($data->companies as $company)
                                        <option value="{{ $company->id }}">
                                            {{ $company->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" name="role[]">
                                        @foreach($data->roles as $role)
                                            <option value="{{ $role->id }}">
                                                {{ $role->display_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">  
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" name="account_no" class="form-control floating">
                                </div>
                            </div>
                            <div class="col-sm-6">  
                                <div class="form-group">
                                    <label>Occupation</label>
                                    <input type="text" name="occupation" class="form-control floating">
                                </div>
                            </div>
                            <div class="col-sm-6">  
                                <div class="form-group">
                                    <label>Date Of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control floating">
                                </div>
                            </div>
                            <div class="col-sm-6">  
                                <div class="form-group">
                                    <label>Facebook Profile Link</label>
                                    <input type="text" name="facebook_link" class="form-control floating">
                                </div>
                            </div>
                            <div class="col-sm-6">  
                                <div class="form-group">
                                    <label>Employee ID</label>
                                    <input type="text" name="twitter_link" class="form-control floating">
                                </div>
                            </div>
                            <div class="col-sm-6">  
                                <div class="form-group">
                                    <label>LinkedIn Profile Link</label>
                                    <input type="text" name="linkedin_link" class="form-control floating">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Account Status</label>
                                    <select class="form-control" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">inactive</option>
                                        <option value="blocking">blocking</option>
                                        <option value="pending">Pending</option>
                                        <option value="busy">Busy</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">  
                                <div class="form-group">
                                    <label>About User</label>
                                    <textarea class="form-control floating" name="bio"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">  
                                <div class="form-group text-left">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="checkbox" name="receive_messages" value="true" class="floating"> Can receive system dashboard messages and notifications
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="checkbox" name="account_auth" value="true" class="floating"> Can log into the system and apps
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="checkbox" name="email_notifications" value="true" class="floating"> Can receive email messages and notifications from the system
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save Profile</button>
                        </div>
                    </form>
                    <div class="divider"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add new user -->
</div>
@include('layouts.includes.notifications')
<!-- Search Filter -->
<div class="row filter-row">
    <div class="col-sm-6 col-md-3">  
        <div class="form-group form-focus">
            <input type="text" class="form-control floating">
            <label class="focus-label">Name</label>
        </div>
    </div>
    <div class="col-sm-6 col-md-3"> 
        <div class="form-group form-focus select-focus">
            <select class="select floating" name="company_id">
                <option>Select Company</option>
                @foreach($data->companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach
            </select>
            <label class="focus-label">Company</label>
        </div>
    </div>
    <div class="col-sm-6 col-md-3"> 
        <div class="form-group form-focus select-focus">
            <select class="select floating"> 
                @foreach($data->roles as $role)
                <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                @endforeach
            </select>
            <label class="focus-label">Role</label>
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
            <table class="table table-striped custom-table datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Country</th>
                        <th>Role</th>
                        <th>Created Date</th>
                        <th>Verification</th>
                        <th>Account Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->users as $user)
                    <?php
                        $u_roles = '';
                        foreach ($user->roles as $ke => $urole) {
                            $u_roles .= ( $ke != 0 ? ', ' : '' );
                            $u_roles .= $urole->display_name;
                        }

                        $gen = $user->user_gender;
                        $gender = '';

                        if ( $gen ) {
                            $gender = $gen->gender_name;
                        }

                        $user_nat = $user->nationality;
                        $u_nationality = '';
                        if ($user_nat) {
                            $u_nationality = $user_nat->nationality_name;
                        }
                    ?>
                    <tr>
                        <td>
                            <h2 class="table-avatar">
                                <a href="{{ route('users.show', $user->id) }}" class="avatar">
                                    <img src="{{ asset($user->image_path ? ('files/uploads/images/profiles/' . $user->image_path) : 'files/defaults/profiles/' . ( $gender == 'Female' ? 'female' : 'male' ) . '.jpg') }}" alt="">
                                </a>
                                <a href="{{ route('users.show', $user->id) }}">{{ $user->name }} <span>{{ $user->occupation ?? $u_roles }}</span></a>
                            </h2>
                        </td>
                        <td>{{ $gender }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->country ? $user->country->country_name : '' }}</td>
                        <td>
                            <span class="badge bg-inverse-{{ $u_roles == 'Super Administrator' ? 'danger' : ( $u_roles == 'Client' ? 'primary' : ( $u_roles == 'Guest User' ? 'warning' :'info' ) ) }}">{{ $u_roles }}</span>
                        </td>
                        <td>{{ $user->created_at->toDayDateTimeString() }}</td>
                        <td>{{ $user->email_verified_at ? 'Verfied' : 'Pending' }}</td>
                        <td>
                            <span class="badge bg-inverse-{{ $user->status == 'blocked' ? 'danger' : ( $user->status == 'away' ? 'primary' : ( $user->status == 'pending' ? 'warning' : ( $user->status == 'active' ? 'success' : 'info' ) ) ) }}">{{ $user->status }}</span>
                        </td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('users.show', $user->id) }}">
                                        <i class="la la-user m-r-5 @if($user->id == Auth::user()->id) text-success @else text-primary @endif"></i>
                                        <span>@if($user->id == Auth::user()->id) My Profile @else User Page (Details) @endif</span>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}" data-toggle="modal" data-target="#edit_{{ $user->id }}_user">
                                        <i class="fa fa-pencil m-r-5 text-primary"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#change_user_{{ $user->id }}_roles">
                                        <i class="la la-user-plus m-r-5 text-primary"></i> Change Role(s)
                                    </a>
                                    @if($user->deleted_at)
                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#change_delete_{{ $user->id }}">
                                        <i class="fa fa-check"></i>Restore
                                    </a>
                                    @endif
                                    @if( $user->id != Auth::user()->id )
                                    <a class="dropdown-item" href="{{ $user->id }}" data-toggle="modal" data-target="#delete_user_{{ $user->id }}"><i class="fa fa-trash-o m-r-5 text-primary"></i> Delete</a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>

                    @if($user->deleted_at)
                    <div id="change_delete_{{ $user->id }}" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="form-header">
                                        <h3>Restore User Profile</h3>
                                    </div>
                                    <div class="modal-btn delete-action">
                                        <div class="row">
                                            <div class="col-6">
                                                <form method="POST" action="{{ route('items.restore') }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="item_id" value="{{ $user->id }}">
                                                    <input type="hidden" name="item_section" value="users">
                                                    <button type="submit" class="btn btn-success continue-btn btn-block">
                                                        {{ __('Restore') }}
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary btn-block cancel-btn">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Edit User Modal -->
                    <div id="edit_{{ $user->id }}_user" class="modal right custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Full Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" name="name" value="{{ $user->name }}" type="text">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select class="form-control" name="country_id">
                                                        @foreach($data->countries as $country)
                                                            <option value="{{ $country->id }}">
                                                                {{ $country->country_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Email <span class="text-danger">*</span></label>
                                                    <input class="form-control" name="email" value="{{ $user->email }}" type="email">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select class="form-control" name="gender_id">
                                                        @foreach($data->genders as $gender)
                                                        <option value="{{ $gender->id }}">
                                                            {{ $gender->gender_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input class="form-control" name="username" value="{{ $user->username }}" type="text">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Phone </label>
                                                    <input class="form-control" name="phone" value="{{ $user->phone }}" type="text">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Company</label>
                                                    <select class="form-control" name="company_id">
                                                        @foreach($data->companies as $company)
                                                        <option value="{{ $company->id }}">
                                                            {{ $company->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <select class="form-control" name="role[]">
                                                        @foreach($data->roles as $role)
                                                            <option value="{{ $role->id }}">
                                                                {{ $role->display_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">  
                                                <div class="form-group">
                                                    <label>Account Number</label>
                                                    <input type="text" name="account_no" value="{{ $user->account_no }}" class="form-control floating">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">  
                                                <div class="form-group">
                                                    <label>Occupation</label>
                                                    <input type="text" name="occupation" value="{{ $user->occupation }}" class="form-control floating">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">  
                                                <div class="form-group">
                                                    <label>Date Of Birth</label>
                                                    <input type="date" name="date_of_birth" value="{{ $user->date_of_birth }}" class="form-control floating">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">  
                                                <div class="form-group">
                                                    <label>Facebook Profile Link</label>
                                                    <input type="text" value="{{ $user->facebook_link }}" name="facebook_link" class="form-control floating">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">  
                                                <div class="form-group">
                                                    <label>Employee ID</label>
                                                    <input type="text" value="{{ $user->twitter_link }}" name="twitter_link" class="form-control floating">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">  
                                                <div class="form-group">
                                                    <label>LinkedIn Profile Link</label>
                                                    <input type="text" value="{{ $user->linkedin_link }}" name="linkedin_link" class="form-control floating">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Account Status</label>
                                                    <select name="status" class="form-control">
                                                      <option value="active" {{(($user->status=='active')? 'selected' : '')}}>Active</option>
                                                      <option value="busy" {{(($user->status=='busy')? 'selected' : '')}}>Busy</option>
                                                      <option value="blocked" {{(($user->status=='blocked')? 'selected' : '')}}>Blocked</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">  
                                                <div class="form-group">
                                                    <label>About User</label>
                                                    <textarea class="form-control floating" name="bio">{{ $user->bio }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">  
                                                <div class="form-group text-left">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="checkbox" name="receive_messages" @if ($user->receive_messages) checked @endif value="true" class="floating"> Can receive system dashboard messages and notifications
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="checkbox" name="account_auth" @if ($user->account_auth) checked @endif value="true" class="floating"> Can log into the system and apps
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="checkbox" name="email_notifications" @if ($user->email_notifications) checked @endif value="true" class="floating"> Can receive email messages and notifications from the system
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="submit-section">
                                            <button type="submit" class="btn btn-primary submit-btn">Update Profile</button>
                                        </div>
                                    </form>
                                    <div class="divider"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Edit User Modal -->
                    <!-- Edit change roles -->
                    <div id="change_user_{{ $user->id }}_roles" class="modal right custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="form-header">
                                        <h3>Chage user roles and permissions</h3>
                                        <p>Updating these permissions will override those set by the roles for this user, {{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="modal-body"><!-- update-action -->
                                    <form method="POST" action="{{ route('permsrole.update', $user->id) }}">
                                        {{ csrf_field() }} {{ method_field('PATCH') }}
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div class="form-group">
                                                    <label>Select roles</label>
                                                    <select class="form-control select2" style="width: 100%" name="roles[]" multiple>
                                                        @foreach($data->roles as $rol)
                                                        <option value="{{ $rol->id }}" @if(in_array($rol->name, $user->getRoles())) selected @endif>{{ $rol->display_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group row">
                                                @foreach($data->permissions as $permission)
                                                <div class="col-md-4" title="{{ $permission->display_name . ': ' . $permission->description }}">
                                                    <label for="permckbx{{ $permission->id }}">
                                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permckbx{{ $permission->id }}" 
                                                        {{ in_array($permission->id, $user->user_perms()) ? "checked" : "" }}>
                                                            {{ $permission->display_name }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <button type="submit" class="btn btn-success continue-btn btn-block" 
                                                        title="Change the user roles, add or remove special user permissions from user"
                                                        onclick="return confirm('You are about to update {{ explode(' ', $user->name)[0] }}\'s roles and permissions\n\n {{ explode(' ', $user->name)[0] }} will now have or be denied access to the system resources where you have set\n\nPress cancel if not sure!')">
                                                        {{ __('Update') }}
                                                    </button>
                                                </div>
                                                <div class="col-6">
                                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-info cancel-btn">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="divider"></div>
                            </div>
                        </div>
                    </div>
                    <!-- / end change permission -->
                    
                    <!-- Delete User Modal -->
                    <div id="delete_user_{{ $user->id }}" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="form-header">
                                        <h3>Delete User</h3>
                                        <p>
                                            Are you sure want to delete {{ $user->name }}'s profile? 
                                            <br><br>
                                            This account will appear in the trash until you delete trash completely.
                                        </p>
                                    </div>
                                    <div class="modal-btn delete-action">
                                        <div class="row">
                                            <div class="col-6">
                                                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-primary continue-btn btn-block" 
                                                        @if($user->id == Auth::user()->id) disabled title="You can not delete your profile right here!"
                                                        @elseif($user->hasRole('super-admin')) disabled title="You can not delete a super-administrator"
                                                        @endif onclick="return confirm('You are about to delete {{ $user->name }}\'s profile!')">Delete</button>
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
                    <!-- /Delete User Modal -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

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
                $('.select2').select2({
                    width: 'resolve' // need to override the changed default
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