@extends('layouts.site')

@php( $page_name = 'Admin Dashboard' )

@section('title', $page_name)
@section('styles')
@endsection
@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">{{ $page_name }}</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{ route('userhome') }}">
						<i class="la la-home"></i> Home
					</a>
				</li>
				<li class="breadcrumb-item active"><i class="la la-dashboard mt-1 mr-1"></i> {{ $page_name }}</li>
			</ul>
		</div>
	</div>
</div>
@include('layouts.includes.notifications')

<div class="row">
	<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
		<div class="card dash-widget">
			<div class="card-body cs-pointer" onclick="window.open('{{ route('users.index') }}' , '_self')">
				<span class="dash-widget-icon"><i class="fa fa-users"></i></span>
				<div class="dash-widget-info">
					<h3>{{ $admin_data->userscount }}</h3>
					<span>{{ __('Users') }}</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
		<div class="card dash-widget">
			<div class="card-body cs-pointer" onclick="window.open('{{ route('companies.index') }}' , '_self')">
				<span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
				<div class="dash-widget-info">
					<h3>{{ $admin_data->companycount }}</h3>
					<span>{{ __('Companies') }}</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
		<div class="card dash-widget">
			<div class="card-body cs-pointer" onclick="window.open('{{ route('partners.index') }}' , '_self')">
				<span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
				<div class="dash-widget-info">
					<h3>{{ $admin_data->partnerscount }}</h3>
					<span>{{ __('Partners') }}</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
		<div class="card dash-widget">
			<div class="card-body cs-pointer" onclick="window.open('{{ route('insurances.index') }}' , '_self')">
				<span class="dash-widget-icon"><i class="fa fa-user"></i></span>
				<div class="dash-widget-info">
					<h3>{{ $admin_data->insurancescount }}</h3>
					<span>{{ __('Insurances') }}</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row d-none">
	<div class="col-md-12">
		<div class="card-group m-b-30">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between mb-3">
						<div>
							<span class="d-block">Metric 1</span>
						</div>
						<div>
							<span class="text-success">0%</span>
						</div>
					</div>
					<h3 class="mb-3">0</h3>
					<div class="progress mb-2" style="height: 5px;">
						<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<p class="mb-0">Overall 0</p>
				</div>
			</div>
		
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between mb-3">
						<div>
							<span class="d-block">Metric 2</span>
						</div>
						<div>
							<span class="text-success">0%</span>
						</div>
					</div>
					<h3 class="mb-3">0</h3>
					<div class="progress mb-2" style="height: 5px;">
						<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<p class="mb-0">Previous Month <span class="text-muted">0</span></p>
				</div>
			</div>
		
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between mb-3">
						<div>
							<span class="d-block">Metric 3</span>
						</div>
						<div>
							<span class="text-danger">0%</span>
						</div>
					</div>
					<h3 class="mb-3">0</h3>
					<div class="progress mb-2" style="height: 5px;">
						<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<p class="mb-0">Previous Month <span class="text-muted">0</span></p>
				</div>
			</div>
		
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between mb-3">
						<div>
							<span class="d-block">ProMetric 4fit</span>
						</div>
						<div>
							<span class="text-danger">0%</span>
						</div>
					</div>
					<h3 class="mb-3">0</h3>
					<div class="progress mb-2" style="height: 5px;">
						<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<p class="mb-0">Previous Month <span class="text-muted">0</span></p>
				</div>
			</div>
		</div>
	</div>	
</div>

<!-- Tabs With Icon Title -->
<div class="row">
    <div class="col-md-9">
    	<div class="card-group m-b-30">
	        <div class="card">
	            <div class="card-body">
	                <div class="table-responsive">
	                    <ul class="nav nav-tabs" role="tablist">
	                        <li class="nav-item">
	                        	<a class="nav-link" data-toggle="tab" href="#home_with_icon_title"> 
	                            	<i class="fa fa-home"></i> <span class="bread-hide-me">CONTROL</span> PANEL 
	                            </a>
	                        </li>
	                        <li class="nav-item active">
	                        	<a class="nav-link" data-toggle="tab" href="#profile_with_icon_title">
	                            	<i class="fa fa-users"></i> USERS 
	                            </a>
	                        </li>
	                        <li class="nav-item">
	                        	<a class="nav-link" data-toggle="tab" href="#messages_with_icon_title">
	                            	<i class="fa fa-envelope"></i> ROLES 
	                            </a>
	                        </li>
	                        <li class="nav-item">
	                        	<a class="nav-link" data-toggle="tab" href="#teams_with_icon_title">
	                            	<i class="la la-users"></i> COMPANIES 
	                            </a>
	                        </li>
	                        <li class="nav-item">
	                        	<a class="nav-link" data-toggle="tab" href="#settings_with_icon_title">
	                            	<i class="fa fa-gear fa-spin"></i> SETTINGS 
	                            </a>
	                        </li>
	                    </ul>
	                </div>
	                <div class="table-responsive">                        
	                    <!-- Tab panes {{ $ii=1 }} -->
	                    <div class="tab-content">
	                        <div role="tabpanel" class="tab-pane" id="home_with_icon_title">
	                            <div class="col-12 m-0 p-0">
	                                
	                            </div>
	                        </div>
	                        <div role="tabpanel" class="tab-pane in active" id="profile_with_icon_title">
	                            <b>Recently Joined Users</b>
	                            <table class="table table-hover">
	                                <thead>
	                                    <tr>
	                                        <th>Name</th>
	                                        <th>Email</th>
	                                        <th>Role</th>
	                                        <th>Verification</th>
	                                        <th>Source</th>
	                                        <th>Status</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                    @foreach($admin_data->users as $user)
	                                    	<?php
	                                    	$u_roles = '';
					                        foreach ($user->roles as $ke => $urole) {
					                            $u_roles .= ( $ke != 0 ? ', ' : '' );
					                            $u_roles .= $urole->display_name;
					                        }
					                        ?>

	                                        <tr title="{{ $user->bio }}" onclick="window.open('{{ route('users.show', $user->id) }}', '_self')" style="cursor: pointer;">
	                                            <td>
	                                                <img src="{{ asset('files/defaults/profiles/male.jpg') }}" style="max-width: 30px; border-radius: 40%;">
	                                                {{ $user->name }} <br> <small class="text-muted">{{ $user->created_at->toDayDateTimeString() }}</small>
	                                            </td>
	                                            <td>{{ $user->email }}</td>
	                                            <td>{{ $u_roles }}</td>
	                                            <td>{{ $user->email_verified_at ? 'Verfied' : 'Pending' }}</td>
	                                            <td>{{ $user->source }}</td>
	                                            <td>{{ $user->status }}</td>
	                                        </tr>
	                                    @endforeach
	                                    <tr>
	                                        <td colspan="6">
	                                            <a class="btn btn-block text-center" href="{{ route('users.index') }}">More users</a>
	                                        </td>
	                                    </tr>
	                                </tbody>
	                            </table>
	                        </div>
	                        <div role="tabpanel" class="tab-pane" id="messages_with_icon_title">
	                            <b>Recently Added System Roles</b>
	                            <table class="table table-hover">
	                                <thead>
	                                    <tr>
	                                        <th>Name</th>
	                                        <th>Display Name</th>
	                                        <th>Permissions</th>
	                                        <th>Users</th>
	                                    </tr>
	                                </thead>
	                                <tbody><!-- {{ $p_count = 0 }} -->
	                                    @foreach($admin_data->roles as $role)
	                                        <tr title="{{ $role->description }}" onclick="window.open('{{ route('roles.edit', $role->id) }}', '_self')">
	                                            <td>{{ $role->name }}</td>
	                                            <td>{{ $role->display_name }}</td>
	                                            <td>{{ $admin_data->perm_count[$p_count] }}</td>
	                                            <td>{{ $admin_data->user_count[$p_count] }}</td>
	                                        </tr>	
	                                        <!-- {{ $p_count++ }} -->
	                                    @endforeach
	                                    <tr>
	                                        <td colspan="6">
	                                            <a class="btn btn-block text-center" href="{{ route('roles.index') }}">More user roles</a>
	                                        </td>
	                                    </tr>
	                                </tbody>
	                            </table>
	                        </div>
	                        <div role="tabpanel" class="tab-pane" id="teams_with_icon_title">
	                            <b>Recently Added Companies</b>
	                            <table class="table table-hover">
	                                <thead>
	                                    <tr>
	                                        <th>Name</th>
	                                        <th>Email</th>
	                                        <th>Phone Number</th>
	                                        <th>Author</th>
	                                        <th class="text-center">Users</th>
	                                        <th class="text-center">Status</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                	@foreach($admin_data->companies as $comp)
	                                	<tr title="{{ $role->description }}" onclick="window.open('{{ route('roles.edit', $role->id) }}', '_self')">
	                                		<td>{{ $comp->name }}</td>
	                                		<td>{{ $comp->email }}</td>
	                                		<td>{{ $comp->phone }}</td>
	                                		<td>{{ $comp->status }}</td>
	                                		<td class="text-center">{{ $comp->users->count() }}</td>
	                                	</tr>
	                                	@endforeach
	                                	<tr>
	                                        <td colspan="6">
	                                            <a class="btn btn-block text-center" href="{{ route('companies.index') }}">More Companies</a>
	                                        </td>
	                                    </tr>
	                                </tbody>
	                            </table>
	                        </div>
	                        <div role="tabpanel" class="tab-pane" id="settings_with_icon_title"> <b>Settings Content</b>
	                            <b>Settings For the System</b>
	                            <div class="col-12 m-0 p-0">
	                                <div class="row m-0 p-0">
	                                    <div class="col-md-6 hover-zoom-effect p-0 pr-1">
	                                        <div class="card">
	                                            <div class="card-header">Place Holder Item 1</div>
	                                            <div class="card-body"></div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 hover-zoom-effect p-0 pl-1">
	                                        <div class="card">
	                                            <div class="card-header">Place Holder Item 2</div>
	                                            <div class="card-body"></div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>
    <div class="col-md-3">
    	<div class="card-group m-b-30">
	        <div class="card">
	            <div class="card-header">
	                <h class="card-title"> {{ config('app.name') }} Configurations </h>
	            </div>
	            <div class="card-body">
	                @php( $i=0 )
	                <ul class="list-group list-group-flush">
	                    <li class="list-group-item list-group-item-{{ ++$i % 2 ? 'gray' : 'light' }}" style="overflow: auto;">


	                    </li>
	                    <li class="list-group-item list-group-item-{{ ++$i % 2 ? 'gray' : 'light' }}" style="overflow: auto;">


	                    </li>
	                    <li class="list-group-item list-group-item-{{ ++$i % 2 ? 'gray' : 'light' }}" style="overflow: auto;">


	                    </li>
	                    <li class="list-group-item list-group-item-{{ ++$i % 2 ? 'gray' : 'light' }}" style="overflow: auto;">


	                    </li>
	                    <li class="list-group-item list-group-item-{{ ++$i % 2 ? 'gray' : 'light' }}" style="overflow: auto;">


	                    </li>
	                    <li class="list-group-item list-group-item-{{ ++$i % 2 ? 'gray' : 'light' }}" style="overflow: auto;">


	                    </li>
	                </ul>
	            </div>
	        </div>
	    </div>
    </div>
</div>
<!-- #END# Tabs With Icon Title -->

@endsection
@section('scripts')

@endsection