<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table data-table">
				<thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>No. of Users</th>
                        <th>Language</th>
                        <th>Status</th>
                        <th>Date Joined</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>No. of Users</th>
                        <th>Language</th>
                        <th>Status</th>
                        <th>Date Joined</th>
                        <th class="text-center">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($data->companies as $ky => $company)
                    <tr>
                        <td><span class="badge bg-inverse-primary">{{ ++$ky }}</span></td>
                        <td onclick="window.open('{{ route('companies.show', $company->id) }}', '_self')">
                            <h2 class="table-avatar point-cursor">
                                <a href="{{ route('companies.show', $company->id) }}" class="avatar"><img src="{{ '' }}" alt=""></a>
                                <a>{{ $company->name }}</a>
                            </h2>
                        </td>
                        <td> {{ $company->email }} </td>
                        <td> {{ $company->phone }} </td>
                        <td> {{ $company->address }} </td>
                        <td class="">{{ $company->users->count() + 1 }}</td>
                        <td> {{ $company->language }} </td>
                        <td>
                            <span class="badge bg-inverse-{{ $company->status == 'active' ? 'danger' : ( $company->status == 'inactive' ? 'primary' : 'info' ) }}">{{ $company->status }}</span>
                        </td>
                        <td>{{ $company->created_at->toDayDateTimeString() }}</td>
                        <td class="text-center">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('companies.show', $company->id) }}"><i class="la la-building m-r-5 text-primary"></i> Details</a>
                                    <a class="dropdown-item" href="{{ route('companies.edit', $company->id) }}" data-toggle="modal" data-target="#edit_{{ $company->id }}_company"><i class="fa fa-pencil m-r-5 text-primary"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ $company->id }}" data-toggle="modal" data-target="#delete_company_{{ $company->id }}"><i class="fa fa-trash-o m-r-5 text-primary"></i> Delete</a>

                                    <a class="dropdown-item" href="{{ route('companies.edit', $company->id) }}">
                                        <i class="fa fa-edit m-r-5 text-primary"></i>
                                        <span>Edit</span>
                                    </a>
                                    @if($company->deleted_at)
                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#change_delete_{{ $company->id }}">
                                        <i class="fa fa-check"></i>Restore
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#delete_user_{{ $company->id }}"><i class="fa fa-trash-o m-r-5 text-primary"></i> Delete </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
			</table>
            @foreach($data->companies as $user)
            @push('modal_area')
            @if($company->deleted_at)
            <div id="change_delete_{{ $user->id }}" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Restore Company</h3>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <form method="POST" action="{{ route('items.restore') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="item_id" value="{{ $user->id }}">
                                            <input type="hidden" name="item_section" value="companies">
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
            <div id="delete_user_{{ $user->id }}" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Company</h3>
                                <p>
                                    Are you sure want to delete {{ $user->name }}'s profile? 
                                    <br><br>
                                    This account will appear in the trash until you delete trash completely.
                                </p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <form method="POST" action="{{ route('companies.destroy', $user->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary continue-btn btn-block"> {{ __('Delete') }} </button>
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
            @endpush
            @endforeach
		</div>
	</div>
</div>