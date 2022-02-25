@extends('layouts.site')

@php( $page_name = 'User Roles' )

@section('title', $page_name)
@section('styles')
<!-- Select2 CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
        <link rel='stylesheet' href="{{ asset('assets/plugins/DataTables/Buttons-1.6.5/css/buttons.bootstrap4.min.js') }}">
        <link rel="stylesheet" href="{{ asset('assets/datatables/css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/datatables/css/buttons.dataTables.min.css') }}">
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
                <li class="breadcrumb-item active"><i class="la la-list mt-1 mr-1"></i> {{ $page_name }}</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <button class="btn add-btn btn-gradient-primary font-weight-bold todo-list-add-btn btn-rounded btn-sm" id="add-task" data-toggle="modal" data-target="#add_task">
                <i class="fa fa-plus"></i> Add Role</button>


        </div>
    </div>
</div>
@include('layouts.includes.notifications')

<div class="page-header mb-0 d-none">
    <div class="row">
        <div class="col">
            <div class="dropdown">
                <a class="dropdown-toggle recently-viewed" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-expanded="false"> Change View </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);">{{ $page_name }}</a>
                    <a class="dropdown-item" href="javascript:void(0);">View Trashed</a>
                </div>
            </div>
        </div>
        <div class="col text-right">
            <ul class="list-inline-item pl-0">
                <li class="nav-item dropdown list-inline-item add-lists">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-text">
                          <i class="fa fa-th" aria-hidden="true"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#add-new-list">New  View</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-nowrap custom-table mb-0 data-table">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Permissions</th>
                                <th>Users</th>
                                @permission('edit_role')
                                <th class="text-right">Action</th>
                                @endpermission
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Role Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Permissions</th>
                                <th>Users</th>
                                @permission('edit_role')
                                <th class="text-right">Action</th>
                                @endpermission
                            </tr>
                        </tfoot>
                        <tbody>
                            @php($p_count = 0)
                            @foreach($roles as $role)
                                
                                <tr>
                                    <td style="min-width: 150px;">{{ $role->name }}</td>
                                    <td>{{ $role->display_name }}</td>
                                    <td>{{ $role->description }}</td>   
                                    <td>{{ $admin_data->perm_count[$p_count] }}</td>
                                    <td>{{ $admin_data->user_count[$p_count] }}</td>
                                    @permission('edit_role')
                                    <td class="text-center">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#edit{{ $role->id }}Modal">Edit role</a>
                                            </div>
                                        </div>
                                    </td>
                                    @endpermission
                                </tr>
                                @php($p_count++)
                                
                                @push('modal_area')
                                <div class="modal right fade" id="edit{{ $role->id }}Modal" tabindex="-1" role="dialog" aria-modal="true">
                                    <div class="modal-dialog" role="document">
                                        <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-center">Add New Role</h4>
                                                <button type="button" class="close xs-close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form action="{{ route('roles.update', $role->id) }}" method="POST">
                                                            @csrf
                                                            {{ method_field('PATCH') }}
                                                            @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                @php( $nn = sizeof($errors->all()) )
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                                                    <span aria-hidden="true" style="font-size: 25px;">&times;</span> 
                                                                </button>
                                                                @foreach ($errors->all() as $error)
                                                                    <i class="fa fa-times-circle"></i> {{ $error }} @if( (int) $nn > 1 )<hr>@endif
                                                                    @php( (int) $nn -= 1 )
                                                                @endforeach
                                                            </div>
                                                            @endif

                                                            <h4>Role Name</h4>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                     <label class="col-form-label">Database Name <span class="text-danger">*</span></label>
                                                                    <input class="form-control" type="text" name="name" value="{{ $role->name ?? old('name') }}" id="task-name" placeholder="role-name" autofocus required>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                     <label class="col-form-label">Display Name</label>
                                                                    <input class="form-control" type="text" name="display_name" value="{{ $role->display_name ?? old('display_name') }}" id="display-name" placeholder="Display Name">
                                                                </div>
                                                            </div>
                                                            <h4>Description Information</h4>
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">Role Description </label>
                                                                    <textarea class="form-control" name="description" rows="5" id="description" placeholder="Description">{{ $role->description ?? old('description') }}</textarea>
                                                                </div>
                                                            </div>
                                                            <h4>Permissions</h4>
                                                            <div class="form-group row">
                                                                @php( $admin_data->permission_role = $role->permissions()->pluck('id','id')->toArray() )
                                                                @foreach($admin_data->permissions as $permission)
                                                                <div class="col-md-4" title="{{ $permission->display_name . ': ' . $permission->description }}">
                                                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                                                        id="permckbx{{ $permission->id }}" 
                                                                        {{ in_array($permission->id, $admin_data->permission_role)?"checked":"" }}>
                                                                    <label for="permckbx{{ $permission->id }}">{{ $permission->display_name }}</label>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="text-center py-3">
                                                                <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Update Role</button>&nbsp;&nbsp;
                                                                <button type="reset" class="btn btn-secondary btn-rounded">Clear Form</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endpush

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- useless model --}}
<div class="modal fade" id="add-new-list">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New List View</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
              
            <!-- Modal body -->
            <div class="modal-body">
                <form class="forms-sample">
                    <div class="form-group row">
                        <label for="view-name" class="col-sm-4 col-form-label">New View Name</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="view-name" placeholder="New View Name">
                        </div>
                    </div>
                    <div class="form-group row pt-4">
                        <label class="col-sm-4 col-form-label">Sharing Settings</label>
                        <div class="col-sm-8">
                          <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value=""> Just For Me <i class="input-helper"></i></label>
                            </div><br />
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked=""> Share Filter with Everyone <i class="input-helper"></i></label>
                            </div>
                          </div>
                        </div>
                    </div>
                      
                    <div class="text-center">
                        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal right fade" id="add_task" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog" role="document">
        <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title text-center">Add New Role</h4>
                <button type="button" class="close xs-close" data-dismiss="modal">&times;</button>
              </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                @php($nn = sizeof($errors->all()))
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                    <span aria-hidden="true" style="font-size: 25px;">&times;</span> 
                                </button>
                                @foreach ($errors->all() as $error)
                                    <i class="fa fa-times-circle"></i> {{ $error }} @if( (int) $nn > 1 )<hr>@endif
                                    @php( (int) $nn -= 1 )
                                @endforeach
                            </div>
                            @endif

                            <h4>Role Name</h4>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                     <label class="col-form-label">Database Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" id="task-name" placeholder="role-name" autofocus required>
                                </div>
                                <div class="col-sm-6">
                                     <label class="col-form-label">Display Name</label>
                                    <input class="form-control" type="text" name="display_name" value="{{ old('display_name') }}" id="display-name" placeholder="Display Name">
                                </div>
                            </div>
                            <h4>Description Information</h4>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Role Description </label>
                                    <textarea class="form-control" name="description" rows="5" id="description" placeholder="Description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <h4>Permissions</h4>
                            <div class="form-group row">
                                @foreach($admin_data->permissions as $permission)
                                <div class="col-md-4" title="{{ $permission->display_name . ': ' . $permission->description }}">
                                    <label for="permckbx{{ $permission->id }}">
                                        <input type="checkbox" name="permission[]" value="{{ $permission->id }}" id="permckbx{{ $permission->id }}">
                                        {{ $permission->display_name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="text-center py-3">
                                <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Save Role</button>&nbsp;&nbsp;
                                <button type="reset" class="btn btn-secondary btn-rounded">Clear Form</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div>
@endsection
@section('scripts_before')
<!-- Select2 JS -->
        <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('assets/js/moment.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>               <!-- -->
        <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/datatables/js/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/datatables/js/buttons.bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/datatables/js/jquery.dataTables.min.js') }}"></script>    <!-- -->
        <script src="{{ asset('assets/datatables/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/datatables/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('assets/datatables/js/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/datatables/js/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/datatables/js/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/datatables/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/datatables/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/datatables/js/percentageBars.js') }}"></script>
@endsection
@section('scripts')
        <script>
            $(document).ready(function() {
                $('.data-table').DataTable({ dom: 'Bfrtip', buttons: [ 'colvis', 'copy', 'csv', 'excel', 'pdf', 'print' ] });
            });
        </script>
        <script> $(document).ready(function() { $('.select2').select2({ width: 'resolve' }); }); </script>
        <script>
            let tagArr = document.getElementsByTagName("input");
            for (let i = 0; i < tagArr.length; i++) { tagArr[i].autocomplete = 'off'; }
        </script>
@endsection