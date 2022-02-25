@extends('layouts.site')

@php
	$page_name = 'My Profile';

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
@endphp

@section('title', $page_name)
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" type="text/css">
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
@endsection
@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">{{ $page_name }}</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{ route('home') }}">
						<i class="la la-home"></i> Home
					</a>
				</li>
				<li class="breadcrumb-item active"><i class="la la-user mt-1 mr-1"></i> {{ $page_name }}</li>
			</ul>
		</div>
	</div>
</div>
@include('layouts.includes.notifications')
<div class="card mb-0">
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="profile-view">
					<div class="profile-img-wrap">
						<div class="profile-img">
							<img alt="IMG" src="{{ asset(Auth::user()->image_path ? ('files/uploads/images/profiles/' . Auth::user()->image_path) : 'files/defaults/profiles/' . ( $gender == 'Female' ? 'female' : 'male' ) . '.jpg') }}" style="">
						</div>
						<small class="text-muted">{{ $user->image_type ?? 'Default Image' }}</small>
					</div>
					<div class="profile-basic">
						<div class="row">
							<div class="col-lg-3">
								<div class="profile-info-left">
									<h3 class="user-name m-t-0 mb-0">{{ $user->name }}</h3>
									<h6 class="text-muted">{{ $u_roles }}</h6>
									<small class="text-muted"><b>A/C:</b> {{ $user->account_no ?? '_' }}</small>
									<div class="staff-id">Employee ID : FT-0001</div>
									<div class="small doj text-muted">Joined : {{ $user->created_at->toDayDateTimeString() }}</div>
									<div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send Message</a></div>
								</div>
							</div>
							<div class="col-lg-5">
								<ul class="personal-info">
									<li>
										<div class="title">Phone:</div>
										<div class="text"><a href="tel:{{ $user->phone ?? '_' }}">{{ $user->phone }}</a></div>
									</li>
									<li>
										<div class="title">Email:</div>
										<div class="text"><a href="mailto:{{ $user->email ?? '_' }}" target="_blank">{{ $user->email }}</a></div>
									</li>
									<li>
										<div class="title">Gender:</div>
										<div class="text">{{ $gender }}</div>
									</li>
									<li>
										<div class="title">Nationality:</div>
										<div class="text">{{ $user->u_nationality ?? '_' }}</div>
									</li>
									<li>
										<div class="title">About Me:</div>
										<div class="text">{{ $user->bio ?? '_' }}</div>
									</li>
								</ul>
							</div>
							<div class="col-lg-4">
								<ul class="personal-info">
									<li>
										<div class="title">Date Of Birth:</div>
										<div class="text">{{ $user->date_of_birth ?? '_' }}</div>
									</li>
									<li class="d-none">
										<div class="title">_:</div>
										<div class="text"><a href="">_</a></div>
									</li>
									<li>
										<div class="title">Username:</div>
										<div class="text">{{ $user->username ?? '_' }}</div>
									</li>
									<li>
										<div class="title">Occupation:</div>
										<div class="text">{{ $user->occupation ?? '_' }}</div>
									</li>
									<li>
										<div class="title">Joined by:</div>
										<div class="text">{{ $user->source ?? '_' }}</div>
									</li>
									<li>
										<div class="title">Account Status:</div>
										<div class="text">{{ $user->status ?? '_' }}</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="pro-edit">
						<a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="javascript:void(0);">
							<i class="fa fa-pencil" title="Edit my profile"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card tab-box">
	<div class="row user-tabs">
		<div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
			<ul class="nav nav-tabs nav-tabs-bottom">
				<li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
				<li class="nav-item"><a href="#emp_projects" data-toggle="tab" class="nav-link">Projects</a></li>
				<li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Bank & Statutory <small class="text-danger">(Admin Only)</small></a></li>
				@auth
				@permission('edit_own_profile')
				@if($user->id == Auth::user()->id)
				<li class="nav-item"><a href="#emp_projects" data-toggle="tab" class="nav-link">Edit My Profile</a></li>
				@endif
				@endpermission
				@endauth
			</ul>
		</div>
	</div>
</div>

<div class="tab-content">
	@include('layouts.partials.form-error')
	<div id="emp_profile" class="pro-overview tab-pane fade show active">
		<div class="row">
			<div class="col-md-6 d-flex">
				<div class="card profile-box flex-fill">
					<div class="card-body">
						<h5 class="card-title">Personal Progress <a href="#" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a></h5>
						<ul class="personal-info d-none">
							<li>
								<div class="title">Passport No.</div>
								<div class="text">9876543210</div>
							</li>
							<li>
								<div class="title">Passport Exp Date.</div>
								<div class="text">9876543210</div>
							</li>
							<li>
								<div class="title">Tel</div>
								<div class="text"><a href="">9876543210</a></div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-6 d-flex">
				<div class="card profile-box flex-fill">
					<div class="card-body">
						<h5 class="card-title">Profile Imagery<a href="#" class="edit-icon" data-toggle="modal" data-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a></h5>
						<h6>Profile Gallery</h6>
						<ul class="personal-info text-center">
							{{-- User gallery here --}}
							@if(!$user->user_gallery)
								<i class="text text-muted">No gallery yet</i>
							@else
							<div class="row">
								@foreach($user->user_gallery->images as $img)
								<div class="col d-flex galler-image" style="background: url('{{ asset($img->image_path) }}') center no-repeat; border-radius: 2px; height: 20vh; flex-direction: column-reverse; flex-align: flex-start; border: thick solid transparent;">
									<span class="text-white">{{ $img->image_name }} <button class="btn btn-sm" style="cursor: pointer;" title="Use image as user profile"><i class="zmdi zmdi-account text-primary"></i><i class="zmdi zmdi-image"></i></button></span>
								</div>
								@endforeach
							</div>
							@endif
						</ul>
						<hr>
						<h5 class="section-title">Update Image</h5>
						<ul class="personal-info">
							<form enctype="multipart/form-data" action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col-md-12">
                                    <div class="row">
                                    	@error('profile_image')
						                	<div class="col-md-12 m-0 p-0 text-danger">
					                            <span class="invalid-feedback" role="alert">
					                                <strong>{{ $message }}</strong>
					                            </span>
					                        </div>
					                    @enderror
                                        <div class="col text-center" style=" padding: 5px;">
                                            <input type="file" name="profile_image" accept=".jpg, .png, .jpeg" class="form-control pull-left">
                                        </div>
                                        <div class="col text-right" style="padding: 5px;">
                                            <button type="submit" class="btn btn-sm btn-success btn-rounded pull-right text-white">
                                            	<i class="zmdi zmdi-check"></i>
                                            	<span>UPDATE IMAGE</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row d-none">
			<div class="col-md-6 d-flex">
				<div class="card profile-box flex-fill">
					<div class="card-body">
						<h3 class="card-title">Bank information</h3>
						<ul class="personal-info">
							<li>
								<div class="title">Bank name</div>
								<div class="text">ICICI Bank</div>
							</li>
							<li>
								<div class="title">Bank account No.</div>
								<div class="text">159843014641</div>
							</li>
							<li>
								<div class="title">IFSC Code</div>
								<div class="text">ICI24504</div>
							</li>
							<li>
								<div class="title">PAN No</div>
								<div class="text">TC000Y56</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-6 d-flex">
				<div class="card profile-box flex-fill">
					<div class="card-body">
						<h3 class="card-title">Family Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#family_info_modal"><i class="fa fa-pencil"></i></a></h3>
						<div class="table-responsive">
							<table class="table table-nowrap">
								<thead>
									<tr>
										<th>Name</th>
										<th>Relationship</th>
										<th>Date of Birth</th>
										<th>Phone</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Leo</td>
										<td>Brother</td>
										<td>Feb 16th, 2019</td>
										<td>9876543210</td>
										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
													<a href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row d-none">
			<div class="col-md-6 d-flex">
				<div class="card profile-box flex-fill">
					<div class="card-body">
						<h3 class="card-title">Education Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#education_info"><i class="fa fa-pencil"></i></a></h3>
						<div class="experience-box">
							<ul class="experience-list">
								<li>
									<div class="experience-user">
										<div class="before-circle"></div>
									</div>
									<div class="experience-content">
										<div class="timeline-content">
											<a href="#/" class="name">International College of Arts and Science (UG)</a>
											<div>Bsc Computer Science</div>
											<span class="time">2000 - 2003</span>
										</div>
									</div>
								</li>
								<li>
									<div class="experience-user">
										<div class="before-circle"></div>
									</div>
									<div class="experience-content">
										<div class="timeline-content">
											<a href="#/" class="name">International College of Arts and Science (PG)</a>
											<div>Msc Computer Science</div>
											<span class="time">2000 - 2003</span>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 d-flex">
				<div class="card profile-box flex-fill">
					<div class="card-body">
						<h3 class="card-title">Experience <a href="#" class="edit-icon" data-toggle="modal" data-target="#experience_info"><i class="fa fa-pencil"></i></a></h3>
						<div class="experience-box">
							<ul class="experience-list">
								<li>
									<div class="experience-user">
										<div class="before-circle"></div>
									</div>
									<div class="experience-content">
										<div class="timeline-content">
											<a href="#/" class="name">Web Designer at Zen Corporation</a>
											<span class="time">Jan 2013 - Present (5 years 2 months)</span>
										</div>
									</div>
								</li>
								<li>
									<div class="experience-user">
										<div class="before-circle"></div>
									</div>
									<div class="experience-content">
										<div class="timeline-content">
											<a href="#/" class="name">Web Designer at Ron-tech</a>
											<span class="time">Jan 2013 - Present (5 years 2 months)</span>
										</div>
									</div>
								</li>
								<li>
									<div class="experience-user">
										<div class="before-circle"></div>
									</div>
									<div class="experience-content">
										<div class="timeline-content">
											<a href="#/" class="name">Web Designer at Dalt Technology</a>
											<span class="time">Jan 2013 - Present (5 years 2 months)</span>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Profile Info Tab -->
	
	<!-- Projects Tab -->
	<div class="tab-pane fade" id="emp_projects">
		<div class="row">
			<div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="dropdown profile-action">
							<a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
								<a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
							</div>
						</div>
						<h4 class="project-title"><a href="project-view.html">Office Management</a></h4>
						<small class="block text-ellipsis m-b-15">
							<span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
							<span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
						</small>
						<p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
							typesetting industry. When an unknown printer took a galley of type and
							scrambled it...
						</p>
						<div class="pro-deadline m-b-15">
							<div class="sub-title">
								Deadline:
							</div>
							<div class="text-muted">
								17 Apr 2019
							</div>
						</div>
						<div class="project-members m-b-15">
							<div>Project Leader :</div>
							<ul class="team-members">
								<li>
									<a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
								</li>
							</ul>
						</div>
						<div class="project-members m-b-15">
							<div>Team :</div>
							<ul class="team-members">
								<li>
									<a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
								</li>
								<li>
									<a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
								</li>
								<li>
									<a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
								</li>
								<li>
									<a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="assets/img/profiles/avatar-05.jpg"></a>
								</li>
								<li>
									<a href="#" class="all-users">+15</a>
								</li>
							</ul>
						</div>
						<p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
						<div class="progress progress-xs mb-0">
							<div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="dropdown profile-action">
							<a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
								<a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
							</div>
						</div>
						<h4 class="project-title"><a href="project-view.html">Project Management</a></h4>
						<small class="block text-ellipsis m-b-15">
							<span class="text-xs">2</span> <span class="text-muted">open tasks, </span>
							<span class="text-xs">5</span> <span class="text-muted">tasks completed</span>
						</small>
						<p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
							typesetting industry. When an unknown printer took a galley of type and
							scrambled it...
						</p>
						<div class="pro-deadline m-b-15">
							<div class="sub-title">
								Deadline:
							</div>
							<div class="text-muted">
								17 Apr 2019
							</div>
						</div>
						<div class="project-members m-b-15">
							<div>Project Leader :</div>
							<ul class="team-members">
								<li>
									<a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
								</li>
							</ul>
						</div>
						<div class="project-members m-b-15">
							<div>Team :</div>
							<ul class="team-members">
								<li>
									<a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
								</li>
								<li>
									<a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
								</li>
								<li>
									<a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
								</li>
								<li>
									<a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="assets/img/profiles/avatar-05.jpg"></a>
								</li>
								<li>
									<a href="#" class="all-users">+15</a>
								</li>
							</ul>
						</div>
						<p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
						<div class="progress progress-xs mb-0">
							<div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="dropdown profile-action">
							<a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
								<a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
							</div>
						</div>
						<h4 class="project-title"><a href="project-view.html">Video Calling App</a></h4>
						<small class="block text-ellipsis m-b-15">
							<span class="text-xs">3</span> <span class="text-muted">open tasks, </span>
							<span class="text-xs">3</span> <span class="text-muted">tasks completed</span>
						</small>
						<p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
							typesetting industry. When an unknown printer took a galley of type and
							scrambled it...
						</p>
						<div class="pro-deadline m-b-15">
							<div class="sub-title">
								Deadline:
							</div>
							<div class="text-muted">
								17 Apr 2019
							</div>
						</div>
						<div class="project-members m-b-15">
							<div>Project Leader :</div>
							<ul class="team-members">
								<li>
									<a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
								</li>
							</ul>
						</div>
						<div class="project-members m-b-15">
							<div>Team :</div>
							<ul class="team-members">
								<li>
									<a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
								</li>
								<li>
									<a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
								</li>
								<li>
									<a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
								</li>
								<li>
									<a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="assets/img/profiles/avatar-05.jpg"></a>
								</li>
								<li>
									<a href="#" class="all-users">+15</a>
								</li>
							</ul>
						</div>
						<p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
						<div class="progress progress-xs mb-0">
							<div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="dropdown profile-action">
							<a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
								<a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
							</div>
						</div>
						<h4 class="project-title"><a href="project-view.html">Hospital Administration</a></h4>
						<small class="block text-ellipsis m-b-15">
							<span class="text-xs">12</span> <span class="text-muted">open tasks, </span>
							<span class="text-xs">4</span> <span class="text-muted">tasks completed</span>
						</small>
						<p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
							typesetting industry. When an unknown printer took a galley of type and
							scrambled it...
						</p>
						<div class="pro-deadline m-b-15">
							<div class="sub-title">
								Deadline:
							</div>
							<div class="text-muted">
								17 Apr 2019
							</div>
						</div>
						<div class="project-members m-b-15">
							<div>Project Leader :</div>
							<ul class="team-members">
								<li>
									<a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
								</li>
							</ul>
						</div>
						<div class="project-members m-b-15">
							<div>Team :</div>
							<ul class="team-members">
								<li>
									<a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
								</li>
								<li>
									<a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
								</li>
								<li>
									<a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
								</li>
								<li>
									<a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="assets/img/profiles/avatar-05.jpg"></a>
								</li>
								<li>
									<a href="#" class="all-users">+15</a>
								</li>
							</ul>
						</div>
						<p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
						<div class="progress progress-xs mb-0">
							<div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Projects Tab -->
	
	<!-- Bank Statutory Tab -->
	<div class="tab-pane fade" id="bank_statutory">
		<div class="card">
			<div class="card-body">
				<h3 class="card-title"> Basic Salary Information</h3>
				<form>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Salary basis <span class="text-danger">*</span></label>
								<select class="select">
									<option>Select salary basis type</option>
									<option>Hourly</option>
									<option>Daily</option>
									<option>Weekly</option>
									<option>Monthly</option>
								</select>
						   </div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Salary amount <small class="text-muted">per month</small></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">$</span>
									</div>
									<input type="text" class="form-control" placeholder="Type your salary amount" value="0.00">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Payment type</label>
								<select class="select">
									<option>Select payment type</option>
									<option>Bank transfer</option>
									<option>Check</option>
									<option>Cash</option>
								</select>
						   </div>
						</div>
					</div>
					<hr>
					<h3 class="card-title"> PF Information</h3>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">PF contribution</label>
								<select class="select">
									<option>Select PF contribution</option>
									<option>Yes</option>
									<option>No</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">PF No. <span class="text-danger">*</span></label>
								<select class="select">
									<option>Select PF contribution</option>
									<option>Yes</option>
									<option>No</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Employee PF rate</label>
								<select class="select">
									<option>Select PF contribution</option>
									<option>Yes</option>
									<option>No</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
								<select class="select">
									<option>Select additional rate</option>
									<option>0%</option>
									<option>1%</option>
									<option>2%</option>
									<option>3%</option>
									<option>4%</option>
									<option>5%</option>
									<option>6%</option>
									<option>7%</option>
									<option>8%</option>
									<option>9%</option>
									<option>10%</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Total rate</label>
								<input type="text" class="form-control" placeholder="N/A" value="11%">
							</div>
						</div>
				   </div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Employee PF rate</label>
								<select class="select">
									<option>Select PF contribution</option>
									<option>Yes</option>
									<option>No</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
								<select class="select">
									<option>Select additional rate</option>
									<option>0%</option>
									<option>1%</option>
									<option>2%</option>
									<option>3%</option>
									<option>4%</option>
									<option>5%</option>
									<option>6%</option>
									<option>7%</option>
									<option>8%</option>
									<option>9%</option>
									<option>10%</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Total rate</label>
								<input type="text" class="form-control" placeholder="N/A" value="11%">
							</div>
						</div>
					</div>
					
					<hr>
					<h3 class="card-title"> ESI Information</h3>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">ESI contribution</label>
								<select class="select">
									<option>Select ESI contribution</option>
									<option>Yes</option>
									<option>No</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">ESI No. <span class="text-danger">*</span></label>
								<select class="select">
									<option>Select ESI contribution</option>
									<option>Yes</option>
									<option>No</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Employee ESI rate</label>
								<select class="select">
									<option>Select ESI contribution</option>
									<option>Yes</option>
									<option>No</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
								<select class="select">
									<option>Select additional rate</option>
									<option>0%</option>
									<option>1%</option>
									<option>2%</option>
									<option>3%</option>
									<option>4%</option>
									<option>5%</option>
									<option>6%</option>
									<option>7%</option>
									<option>8%</option>
									<option>9%</option>
									<option>10%</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Total rate</label>
								<input type="text" class="form-control" placeholder="N/A" value="11%">
							</div>
						</div>
				   </div>
					
					<div class="submit-section">
						<button class="btn btn-primary submit-btn" type="submit">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /Bank Statutory Tab -->
</div>

@endsection
@section('scripts')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
		<script src="{{ asset('assets/js/moment.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
@endsection