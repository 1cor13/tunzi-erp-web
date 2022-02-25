@extends('layouts.site')

@php( $page_name = 'Edit Company' )
@section('title', $page_name)
@section('styles')
<!-- page css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}">
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">{{ $page_name }}</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('userhome') }}"><i class="la la-home mt-1 mr-1"></i> {{ __('Home') }}</a></li>
                @permission('view_company_list')
                <li class="breadcrumb-item"><a href="{{ route('companies.index') }}"><i class="la la-cubes mt-1 mr-1"></i> {{ __('Companies') }}</a></li>
                @endpermission
                <li class="breadcrumb-item active"><i class="la la-edit mt-1 mr-1"></i> {{ $page_name }}</li>
            </ul>
        </div>
    </div>
</div>
@include('layouts.includes.notifications')
<div class="row clearfix">
    <div class="col-md-12">
        <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('layouts.partials.form-error')
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" value="{{ old('name', $company->name) }}" type="text">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input class="form-control" name="email" value="{{ old('email', $company->email) }}" type="email">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control" name="phone" value="{{ old('phone', $company->phone) }}" type="text">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Tax Identification Number (TIN)</label>
                        <input class="form-control" name="tax_number" value="{{ old('tax_number', $company->tax_number) }}" type="text">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Company logo</label>
                        <input class="form-control" type="file" name="logo" accept=".png,.jpeg,.jpg,.gif">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Country </label>
                        <select name="country_id" class="form-control select2" style="width: 100%">
                            @foreach($data->countryList as $ctry)
                            <option value="{{ $ctry->id }}" @if(old('country_id', $company->country_id) == $ctry->id) selected @endif> {{ $ctry->country_name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Village </label>
                        <select name="currency_id" class="form-control select2">
                            @foreach($data->villageList as $village)
                            <option value="{{ $village->id }}" @if( old('currency_id', $company->currency_id) ) selected @endif>{{ $village->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="language">Language</label>
                        <select name="language" class="form-control select2">
                            @foreach($data->languageList as $lang)
                            <option value="{{ $lang->id }}" @if( old('language', $company->language) ) $lang->id @endif> {{ $lang->language_name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Currency </label>
                        <select name="currency_id" class="form-control select2">
                            @foreach($data->currencies as $currency)
                            <option value="{{ $currency->id }}" @if( old('currency_id', $company->currency_id) == $currency->id ) selected @endif>{{ $currency->code .' - '. $currency->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="language">Other Language</label>
                        <select name="other_languages" multiple class="form-control select2">
                            @foreach($data->languageList as $lang)
                            <option value="{{ $lang->id }}" @if( in_array($lang->id, (array) old('old_languages', $company->old_languages)) ) selected @endif> {{ $lang->language_name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Address <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="4" name="address">{{ old('address', $company->address) }}</textarea>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control select2" name="status" style="width: 100%;">
                            <option value="active" @if( old('status', $company->status) == 'active' ) selected @endif>Active</option>
                            <option value="pending" @if( old('status', $company->status) == 'pending' ) selected @endif>Pending</option>
                            <option value="inactive" @if( old('status', $company->status) == 'inactive' ) selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="submit-section">
                <button type="submit" class="btn btn-primary submit-btn">Update Company</button>
            </div>
            <div class="divider"></div>
        </form>
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
        <script src="{{ asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.js') }}"></script>
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
            height: 200,
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
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    width: 'resolve' // need to override the changed default
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    buttons: [
                        'csv', 'copy', 'excel', 'pdf'
                    ]
                } );
            } );
        </script>
@endsection