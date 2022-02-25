@extends('layouts.site')

@php( $page_name = 'Stores' )

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
    @include('layouts.includes.side-companies')
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">{{ $page_name }}</h3>
            <ul class="breadcrumb">
            	<li class="breadcrumb-item"><a href="{{ route('userhome') }}"><i class="la la-home mt-1 mr-1"></i> {{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('companies.index') }}"><i class="la la-cubes mt-1 mr-1"></i> {{ __('Companies') }}</a></li>
                <li class="breadcrumb-item active"><i class="la la-campground mt-1 mr-1"></i> {{ $page_name }}</li>
            </ul>
        </div>

        <div class="col-auto float-right ml-auto">
            <a href="{{ route('stores.create') }}" class="btn add-btn @if ($errors->any()) text-danger @endif" data-toggle="modal" data-target="#create_store_profile">
                <i class="fa fa-plus"></i>
                <span>Add Store</span>
            </a>
            {{-- <div class="view-icons">
                <a href="{{ route('stores.index', ['view_type' => 'cards']) }}" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
                <a href="{{ route('stores.index', ['view_type' => 'list']) }}" class="grid-view btn btn-link"><i class="fa fa-bars"></i></a>
                <a href="{{ route('stores.index', ['view_type' => 'trashed']) }}" class="list-view btn btn-link active" title="View trashed user profiles"><i class="fa fa-trash text-danger"></i></a>
            </div> --}}
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="#" class="btn add-btn" data-toggle="modal" data-target=".bd-example-modal-xl"> Import</a>
        </div>
        <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document" style="letter-spacing: 1px;">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      <big>Upload Stores List</big>
                      <br>
                      <small class="text-muted">
                        <span>Please upload a CSV file with the first row with column title names as in the order below:</span>
                          <small>
                            <br><br>
                            <big><b>Store Name</b></big>: The store names of the company
                            <br>
                            <big><b>Telephone</b></big>: The telephone number of the store
                            <br>
                            <big><b>Email</b></big>: The specified email
                            <br>
                            <big><b>Time open</b></big>: The time open for the store
                            <br>
                            <big><b>Time closed</b></big>: The time closed for the store
                            <br>
                            <big><b>Whatsapp</b></big>: Whatsapp of the store
                            <br>
                            <big><b>Facebook</b></big>: Facebook of the store
                            <br>
                            <big><b>Twitter</b></big>: Twitter of the store
                            <br>
                            <big><b>Category</b></big>: Category of the store
                            <br>
                            <big><b>Village</b></big>: Village of the store
                            <br>
                            <big><b>Status</b></big>: Status of the store
                            <br>
                            <big><b>Description</b></big>: The stores description
                          </small>
                          <h5 class="label label-danger text-white p-2 mt-2" style="border-radius: 5px;"><b>NB: </b>For proper upload, please limit the number of records, not more than 400 for single CSV file</h5>
                        </small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form enctype="multipart/form-data" method="post" action="{{ route('stores.upload') }}" class="row">
                      <div class="form-group col-8 m-0 row">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                        <label for="recipient-name" class="col-12 col-form-label">Select File:</label>
                        <input type="file" class="col-12 btn btn-sm btn-primary" id="recipient-name" name="stores_file" accept=".csv" required>
                      </div>
                      <div class="form-group col-4 m-0 offset-1 row">
                        <label for="recipient-submit" class="col-12 col-form-label">Submit:</label>
                        <button class="col-12 btn btn-block block btn-success" id="recipient-submit" type="submit">Upload File</button>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="#" class="btn add-btn" data-toggle="modal"> Export</a>
        </div>
    </div>
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
            <select class="select floating"> 
                <option>Select Company</option>
                <option>Global Technologies</option>
                <option>Delta Infotech</option>
            </select>
            <label class="focus-label">Company</label>
        </div>
    </div>
    <div class="col-sm-6 col-md-3"> 
        <div class="form-group form-focus select-focus">
            <select class="select select2 floating">
                <option>- Select Village (City) -</option>
                @foreach($data->villages as $village)
                <option value="{{ $village->id }}">{{ $village->village_name }}</option>
                @endforeach
            </select>
            <label class="focus-label">Village (City)</label>
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
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Time Open</th>
                        <th>Time Closed</th>
                        <th>Created Date</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->stores as $store)
                    <tr>
                        <td>
                            <h2 class="table-avatar">
                                <a href="{{ route('stores.show', $store->id) }}" class="avatar"><img src="" alt=""></a>
                                <a href="profile.html"> {{ $store->store_name }} <span> Company Name </span></a>
                            </h2>
                        </td>
                        <td> {{ $store->store_phone }} </td>
                        <td> {{ $store->store_email }} </td>
                        <td> {{ $store->time_open }} </td>
                        <td> {{ $store->time_closed }} </td>
                        <td> {{ $store->created_at->toDayDateTimeString() }}</td>
                        <td>
                            @if($store->status=='active')
                            <span class="badge badge-success">{{$store->status}}</span>
                            @else
                                <span class="badge badge-warning">{{$store->status}}</span>
                            @endif 
                        </td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('stores.edit', $store->id) }}" data-toggle="modal" data-target="#edit_{{ $store->id }}_store"><i class="fa fa-pencil m-r-5 text-primary"></i> Edit</a>
                                    {{-- <a class="dropdown-item" href="{{ route('stores.edit', $store->id) }}" data-toggle="modal" data-target="#view_store_{{ $store->id }}"><i class="fa fa-file-text-o m-r-5 text-primary"></i> Details</a> --}}
                                    <a class="dropdown-item" href="{{ $store->id }}" data-toggle="modal" data-target="#delete_store_{{ $store->id }}"><i class="fa fa-trash-o m-r-5 text-primary"></i> Delete</a>
                                </div>
                            </div>

                            <!-- Edit store Modal -->
                            <div id="edit_{{ $store->id }}_store" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit store</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form action="{{ route('stores.update', $store->id) }}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="PUT">

                                                
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Store Name <span class="text-danger">*</span></label>
                                                            <input class="form-control" name="store_name" value="{{ $store->store_name ?? old('store_name') }}" type="text" autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Phone  <span class="text-danger">*</span></label>
                                                            <input class="form-control" name="store_phone" value="{{ $store->store_phone ?? old('store_phone') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Store Email <span class="text-danger">*</span></label>
                                                            <input class="form-control" name="store_email" value="{{ $store->store_email ?? old('store_email') }}" type="email">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Status <span class="text-danger">*</span></label>
                                                            <select class="form-control select" name="status">
                                                                <option value="pending" @if($store->status == 'pending' || old('status') == 'pending') selected @endif>Pending Approval</option>
                                                                <option value="achived" @if($store->status == 'achived' || old('status') == 'achived') selected @endif>Achived</option>
                                                                <option value="active" @if($store->status == 'active' || old('status') == 'active') selected @endif>Active</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Time Open</label>
                                                            <input class="form-control" name="time_open" value="{{ $store->time_open ?? old('time_open') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Time Closed</label>
                                                            <input class="form-control" name="time_closed" value="{{ $store->time_closed ?? old('time_closed') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>WhatsApp Contact</label>
                                                            <input class="form-control" name="store_whatsapp" value="{{ $store->store_whatsapp ?? old('store_whatsapp') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Facebook Profile Link</label>
                                                            <input class="form-control" name="store_facebook" value="{{ $store->store_facebook ?? old('store_facebook') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Twitter Profile Link</label>
                                                            <input class="form-control" name="store_twitter" value="{{ $store->store_twitter ?? old('store_twitter') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Instagram Profile Link</label>
                                                            <input class="form-control" name="store_instagram" value="{{ $store->store_instagram ?? old('store_instagram') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Category</label>
                                                            <select class="select" name="category_id">
                                                                @foreach($data->categories as $cat)
                                                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Village</label>
                                                            <select class="select" name="village_id">
                                                                @foreach($data->villages as $vil)
                                                                <option value="{{ $vil->id }}">{{ $vil->village_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>GPS Latitude</label>
                                                            <input class="form-control" name="store_lat" value="{{ $store->store_lat ?? old('store_lat') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>GPS Longitude</label>
                                                            <input class="form-control" name="store_long" value="{{ $store->store_long ?? old('store_long') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Store Description</label>
                                                            <textarea class="form-control mytextarea floating" name="store_description">{{ old('store_description') }}</textarea>
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
                            <!-- /Edit store Modal -->
                            
                            <!-- Delete store Modal -->
                            <div id="delete_store_{{ $store->id }}" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Delete store</h3>
                                                <p>
                                                    Are you sure want to delete {{ $store->shop_name }}'s profile? 
                                                    <br><br>
                                                    This account will appear in the trash until you delete trash completely.
                                                </p>
                                            </div>
                                            <div class="modal-btn delete-action">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <form method="POST" action="{{ route('stores.destroy', $store->id) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $store->store_name }}\'s profile!')">Delete</button>
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
                            <!-- /Delete store Modal -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add new store -->
<div id="create_store_profile" class="modal right custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new store profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('stores.store') }}" method="POST" autocomplete="off">
                    @csrf
                    @include('layouts.partials.form-error')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Store Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="store_name" value="{{ old('store_name') }}" type="text" autofocus>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone  <span class="text-danger">*</span></label>
                                <input class="form-control" name="store_phone" value="{{ old('store_phone') }}" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Store Email <span class="text-danger">*</span></label>
                                <input class="form-control" name="store_email" value="{{ old('store_email') }}" type="email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select class="form-control select" name="status">
                                    <option value="pending" @if(old('status') == 'pending') selected @endif>Pending Approval</option>
                                    <option value="achived" @if(old('status') == 'achived') selected @endif>Achived</option>
                                    <option value="active" @if(old('status') == 'active') selected @endif>Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time Open</label>
                                <input class="form-control" name="time_open" value="{{ old('time_open') }}" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time Closed</label>
                                <input class="form-control" name="time_closed" value="{{ old('time_closed') }}" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><i class="la la-whatsapp text-primary"></i> WhatsApp Contact</label>
                                <input class="form-control" name="store_whatsapp" value="{{ old('store_whatsapp') }}" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><i class="la la-facebook text-primary"></i> Facebook Profile Link</label>
                                <input class="form-control" name="store_facebook" value="{{ old('store_facebook') }}" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><i class="la la-twitter text-primary"></i> Twitter Profile Link</label>
                                <input class="form-control" name="store_twitter" value="{{ old('store_twitter') }}" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><i class="la la-instagram text-primary"></i> Instagram Profile Link</label>
                                <input class="form-control" name="store_instagram" value="{{ old('store_instagram') }}" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="select" name="category_id">
                                    @foreach($data->categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Village</label>
                                <select class="select" name="village_id">
                                    @foreach($data->villages as $vil)
                                    <option value="{{ $vil->id }}">{{ $vil->village_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>GPS Latitude</label>
                                <input class="form-control" name="store_lat" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>GPS Longitude</label>
                                <input class="form-control" name="store_long" type="text">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Store Description</label>
                                <textarea class="form-control mytextarea floating" name="store_description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- @if(in_array($data->view_type, ['list', 'trashed'])) == )
@include('system.companies.stores.part-list')
@else
@include('system.companies.stores.part-cards')
@endif --}}

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
<script src="https://cdn.tiny.cloud/1/tdm65fhtxt25vu13rx46jqwxj73v6jyfu1vcc1c9vf25qkhg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
    selector: '.mytextarea',
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    image_advtab: true,
    content_css: '//www.tiny.cloud/css/codepen.min.css',
    importcss_append: true,
    height: 100,
    file_picker_callback: function (callback, value, meta) {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
            callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
        }

        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
            callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
        }

        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
            callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
        }
    },
    templates: [
        { 
            title: 'New Table', 
            description: 'creates a new table', 
            content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' 
        },
        { 
            title: 'Starting my story', 
            description: 'A cure for writers block', 
            content: 'Once upon a time...' 
        },
        { 
            title: 'New list with dates', 
            description: 'New List with dates', 
            content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' 
        }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_mode: 'sliding',
    contextmenu: "link image imagetools table",
});
</script>
@endsection