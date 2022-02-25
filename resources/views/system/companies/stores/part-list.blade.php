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
                        <th>Current Status</th>
                        <th>Created Date</th>
                        <th>Account Status</th>
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
                        <td>
                            <span class="badge bg-inverse-danger"> {{ __('closed') }} </span>
                        </td>
                        <td>{{ $store->created_at->toDayDateTimeString() }}</td>
                        <td>
                            <span class="badge bg-inverse-{{ $store->status == 'blocked' ? 'danger' : ( $store->status == 'away' ? 'primary' : ( $store->status == 'pending' ? 'warning' : ( $store->status == 'active' ? 'success' : 'info' ) ) ) }}">{{ $store->status }}</span>
                        </td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('stores.edit', $store->id) }}" data-toggle="modal" data-target="#edit_{{ $store->id }}_store"><i class="fa fa-pencil m-r-5 text-primary"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ route('stores.edit', $store->id) }}" data-toggle="modal" data-target="#view_store_{{ $store->id }}"><i class="fa fa-file-text-o m-r-5 text-primary"></i> Details</a>
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
						                                    <label>Shop Status</label>
						                                    <select class="select" name="status" selected="{{ $store->status ?? old('status') }}">
						                                        <option value="open" >Open</option>
						                                        <option value="closed">Closed</option>
						                                        <option value="pending" selected>Pending</option>
						                                        <option value="busy">Busy</option>
						                                        <option value="blocked">Blocked</option>
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
						                                    <select class="select" name="gender_id">
						                                        @foreach($data->categories as $cat)
						                                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
						                                        @endforeach
						                                    </select>
						                                </div>
						                            </div>
						                            <div class="col-sm-6">
						                                <div class="form-group">
						                                    <label>Village</label>
						                                    <select class="select" name="gender_id">
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
						                                    <textarea class="form-control floating" name="store_description">{{ old('store_description') }}</textarea>
						                                </div>
						                            </div>
						                        </div>
		                                        <div class="submit-section">
		                                            <button type="submit" class="btn btn-primary submit-btn">Update Profile</button>
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