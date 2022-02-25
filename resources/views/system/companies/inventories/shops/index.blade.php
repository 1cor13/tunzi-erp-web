@extends('layouts.site')

@php( $page_name = 'Shops' )

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
            <a href="{{ route('shops.create') }}" class="btn add-btn @if ($errors->any()) text-danger @endif" data-toggle="modal" data-target="#create_shop_profile"><i class="fa fa-plus"></i> Add Shop</a>
            {{-- <div class="view-icons">
                <a href="{{ route('stores.index', ['view_type' => 'cards']) }}" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
                <a href="{{ route('stores.index', ['view_type' => 'list']) }}" class="grid-view btn btn-link"><i class="fa fa-bars"></i></a>
                <a href="{{ route('stores.index', ['view_type' => 'trashed']) }}" class="list-view btn btn-link active" title="View trashed user profiles"><i class="fa fa-trash text-danger"></i></a>
            </div> --}}
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="#" class="btn add-btn" data-toggle="modal"> Import</a>
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
                    @foreach($data->shops as $shop)
                    <tr>
                        <td>
                            <h2 class="table-avatar" onclick="window.open('{{ route('shops.show', $shop->id) }}', '_self');">
                                <a class="avatar"><img src="" alt=""></a>
                                <a> {{ $shop->shop_name }} <span> Company Name </span></a>
                            </h2>
                        </td>
                        <td> {{ $shop->shop_phone }} </td>
                        <td> {{ $shop->shop_email }} </td>
                        <td> {{ $shop->time_open }} </td>
                        <td> {{ $shop->time_closed }} </td>
                        <td> {{ $shop->created_at->toDayDateTimeString() }}</td>
                        <td>
                            @if($shop->status=='active')
                            <span class="badge badge-success">{{$shop->status}}</span>
                            @else
                                <span class="badge badge-warning">{{$shop->status}}</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('shops.edit', $shop->id) }}" data-toggle="modal" data-target="#edit_{{ $shop->id }}_shop"><i class="fa fa-pencil m-r-5 text-primary"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ $shop->id }}" data-toggle="modal" data-target="#delete_shop_{{ $shop->id }}"><i class="fa fa-trash-o m-r-5 text-primary"></i> Delete</a>
                                </div>
                            </div>

                            <!-- Edit shop Modal -->
                            <div id="edit_{{ $shop->id }}_shop" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit shop</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form action="{{ route('shops.update', $shop->id) }}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="PUT">

                                                
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Shop Name <span class="text-danger">*</span></label>
                                                            <input class="form-control" name="shop_name" value="{{ $shop->shop_name ?? old('shop_name') }}" type="text" autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Phone  <span class="text-danger">*</span></label>
                                                            <input class="form-control" name="shop_phone" value="{{ $shop->shop_phone ?? old('shop_phone') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Shop Email <span class="text-danger">*</span></label>
                                                            <input class="form-control" name="shop_email" value="{{ $shop->shop_email ?? old('shop_email') }}" type="email">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Status <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="status" value="{{ $shop->status ?? old('status') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Time Open</label>
                                                            <input class="form-control" name="time_open" value="{{ $shop->time_open ?? old('time_open') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Time Closed</label>
                                                            <input class="form-control" name="time_closed" value="{{ $shop->time_closed ?? old('time_closed') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>WhatsApp Contact</label>
                                                            <input class="form-control" name="shop_whatsapp" value="{{ $shop->shop_whatsapp ?? old('shop_whatsapp') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Facebook Profile Link</label>
                                                            <input class="form-control" name="shop_facebook" value="{{ $shop->shop_facebook ?? old('shop_facebook') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Twitter Profile Link</label>
                                                            <input class="form-control" name="shop_twitter" value="{{ $shop->shop_twitter ?? old('shop_twitter') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Instagram Profile Link</label>
                                                            <input class="form-control" name="shop_instagram" value="{{ $shop->shop_instagram ?? old('shop_instagram') }}" type="text">
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
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>GPS Latitude</label>
                                                            <input class="form-control" name="shop_lat" value="{{ $shop->shop_lat ?? old('shop_lat') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>GPS Longitude</label>
                                                            <input class="form-control" name="shop_long" value="{{ $shop->shop_long ?? old('shop_long') }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Shop Description</label>
                                                            <textarea class="form-control floating" name="shop_description">{{ old('shop_description') }}</textarea>
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
                            <!-- /Edit shop Modal -->
                            
                            <!-- Delete shop Modal -->
                            <div id="delete_shop_{{ $shop->id }}" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Delete shop</h3>
                                                <p>
                                                    Are you sure want to delete {{ $shop->shop_name }}'s profile? 
                                                    <br><br>
                                                    This account will appear in the trash until you delete trash completely.
                                                </p>
                                            </div>
                                            <div class="modal-btn delete-action">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <form method="POST" action="{{ route('shops.destroy', $shop->id) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-primary continue-btn btn-block" onclick="return confirm('You are about to delete {{ $shop->shop_name }}\'s profile!')">Delete</button>
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
                            <!-- /Delete shop Modal -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add new shop -->
<div id="create_shop_profile" class="modal right custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new shop profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('shops.store') }}" method="POST" autocomplete="off">
                    @csrf
                    @include('layouts/partials/form-error')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Shop Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="shop_name" value="{{ old('shop_name') }}" type="text" autofocus>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Company</label>
                                <select class="select" name="company_id">
                                    @foreach($data->companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone  <span class="text-danger">*</span></label>
                                <input class="form-control" name="shop_phone" value="{{ old('shop_phone') }}" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Shop Email <span class="text-danger">*</span></label>
                                <input class="form-control" name="shop_email" value="{{ old('shop_email') }}" type="email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="status" value="{{ old('status') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time Open</label>
                                <input class="form-control" name="time_open" type="text" value="{{ old('time_open') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time Closed</label>
                                <input class="form-control" name="time_closed" type="text" value="{{ old('time_closed') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><i class="text primaty li li-whatsapp"></i> WhatsApp Contact</label>
                                <input class="form-control" name="shop_whatsapp" type="text" value="{{ old('shop_whatsapp') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><i class="text primaty li li-facebook"></i> Facebook Profile Link</label>
                                <input class="form-control" name="shop_facebook" type="text" value="{{ old('shop_facebook') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><i class="text primaty li li-twitter"></i> Twitter Profile Link</label>
                                <input class="form-control" name="shop_twitter" type="text" value="{{ old('shop_twitter') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><i class="text primaty li li-instagram"></i> Instagram Profile Link</label>
                                <input class="form-control" name="shop_instagram" type="text" value="{{ old('shop_instagram') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="select" name="category_id">
                                    @foreach($data->categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
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
                                <input class="form-control" name="shop_lat" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>GPS Longitude</label>
                                <input class="form-control" name="shop_long" type="text">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Store Description</label>
                                <textarea class="form-control floating" name="shop_description"></textarea>
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