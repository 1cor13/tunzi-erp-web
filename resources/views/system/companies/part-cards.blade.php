<div class="row staff-grid-row">
    @php
        $imagesArr = [ 'assets/img/rover.jpeg', 'assets/img/ballons.jpeg', 'assets/img/city.jpeg' ];
    @endphp
    @if(sizeof($data->companies) < 1)
    <div class="col-md-4 offset-md-4">
        <div class="card card-body text-center p-5">
            <p class="m-0"><i>There are no companies under this category</i></p>
        </div>
    </div>
    @endif
    @foreach($data->companies as $company)
    <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
        <div class="c-card">
            <div class="c-card-header d-flex" style="background: url('{{ asset( $imagesArr[rand(0,2)] ) }}') center no-repeat; flex-direction: column-reverse;">
                <div class="dropdown profile-action" style="margin: 2vh;">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons text-white">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('companies.show', $company->id) }}"><i class="la la-building m-r-5 text-primary"></i> Details</a>
                        <a class="dropdown-item" href="{{ route('companies.edit', $company->id) }}" data-toggle="modal" data-target="#edit_{{ $company->id }}_company"><i class="fa fa-pencil m-r-5 text-primary"></i> Edit</a>
                        <a class="dropdown-item" href="{{ $company->id }}" data-toggle="modal" data-target="#delete_company_{{ $company->id }}"><i class="fa fa-trash-o m-r-5 text-primary"></i> Delete</a>
                    </div>
                </div>
                <div class="col-12 p-1" style="background: linear-gradient( rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4) );">
                    <h3 class="text-white">
                        <b class="float-left">{{ $company->name }}</b>

                    </h3>
                </div>
            </div>
            <div class="c-card-body">
                {{-- <span class="tag tag-teal">Technology</span> --}}
                <div class="col-md-12 row p-0 m-0">
                    <big class="col-6 p-0">
                        <br>
                        <span class="badge bg-inverse">{{ ucfirst( $company->status ) }}</span>
                        <br>
                        <small style="font-size: 11px;">{{ $company->phone}}</small>
                        <br>
                        <small style="font-size: 11px;">{{ $company->email }}</small>
                    </big>
                </div>
                <p>{{ $company->address }}</p>
                <div class="user">
                    <img src="{{ asset($company->logo ? ('files/uploads/images/profiles/' . $company->logo) : 'files/defaults/profiles/male.jpg') }}" alt="user 1" />
                    <div class="user-info">
                        <small>{{ $company->created_at->toDayDateTimeString() }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('modal_area')
    <div id="edit_{{ $company->id }}_company" class="modal right custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <!-- {{ $nn = sizeof($errors->all()) }} -->
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                    <span aria-hidden="true" style="font-size: 25px;">&times;</span> 
                                </button>
                                @foreach ($errors->all() as $error)
                                    <i class="fa fa-times-circle"></i> {{ $error }} @if( (int) $nn > 1 )<hr>@endif
                                    <!-- {{ (int) $nn -= 1 }} -->
                                @endforeach
                            </div>
                        @endif
                        <input type="hidden" name="user_id" value="{{ $company->user_id }}">
                        <div class="row">
                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input class="form-control" name="name" type="text" value="{{ $company->name ?? old('name') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input class="form-control" name="email" type="email" value="{{ $company->email ?? old('email') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" name="phone" type="text" value="{{ $company->phone ?? old('phone') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="status" class="col-form-label">Tax Number <span class="text-danger">*</span></label>
                                  <select name="tax_number" class="form-control">
                                      <option value="3" {{(($company->tax_number=='3')? 'selected' : '')}}>3</option>
                                      <option value="2" {{(($company->tax_number=='2')? 'selected' : '')}}>2</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Currency <span class="text-danger">*</span></label>
                                    <select class="select" name="currency_id" class="form-control select2">
                                        @foreach($data->currencies as $currency)
                                        <option value="{{ $currency->id }}">
                                            {{ $currency->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="language" class="col-form-label">Language <span class="text-danger">*</span></label>
                                  <select name="language" class="form-control select2">
                                      <option value="english" {{(($company->language=='english')? 'selected' : '')}}>English</option>
                                      <option value="french" {{(($company->language=='french')? 'selected' : '')}}>French</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="4" name="address">
                                        {{ $company->address ?? old('address') }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select2" name="status" style="width: 100%;">
                                        <option value="active" {{(($company->status=='active')? 'selected' : '')}}>Active</option>
                                        <option value="inactive" {{(($company->status=='inactive')? 'selected' : '')}}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input class="form-control" type="file" name="logo" value="{{ $company->logo ?? old('logo') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <img src="{{ Storage::url($company->logo) }}" height="75" width="75" alt="" />
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save company</button>
                        </div>
                        <div class="divider"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="delete_company_{{ $company->id }}" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete company</h3>
                        <p>
                            Are you sure want to delete {{ $company->company_name }}'s profile? 
                            <br><br>
                            This account will appear in the trash until you delete trash completely.
                        </p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form method="POST" action="{{ route('companies.destroy', $company->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-primary continue-btn btn-block" 
                                        onclick="return confirm('You are about to delete {{ $company->company_name }}\'s profile!')">
                                        {{ __('Delete') }}
                                    </button>
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
    @endpush
    @endforeach
</div>