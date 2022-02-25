@extends('layouts.site')

@php( $page_name = 'Companies' )

@section('title', $page_name)
@section('styles')
<!-- Select2 CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
        <link rel='stylesheet' href="{{ asset('assets/plugins/DataTables/Buttons-1.6.5/css/buttons.bootstrap4.min.js') }}">
        <link rel="stylesheet" href="{{ asset('assets/datatables/css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/datatables/css/buttons.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom-cards.css') }}">
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
                <li class="breadcrumb-item active"><i class="la la-cubes mt-1 mr-1"></i> {{ $page_name }}</li>
            </ul>
        </div>

        <div class="col-auto float-right ml-auto">
			<a href="{{ route('companies.create') }}" class="btn add-btn btn-sm mt-1"><i class="fa fa-plus"></i> Add Company</a>
			<div class="view-icons">
				@if( request()->view == 'list' )
				<a href="{{ route('companies.index', ['view' => 'cards']) }}" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
				@else
				<a href="{{ route('companies.index', ['view' => 'list']) }}" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
				@endif
			</div>
		</div>
    </div>
</div>
@include('layouts.includes.notifications')
<!-- Search Filter -->
<div class="row filter-row d-none">
	<div class="col-sm-6 col-md-2">  
		<div class="form-group form-focus">
			<input type="text" class="form-control floating" name="name" value="{{ old('name') }}">
			<label class="focus-label">Company Name</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-2">  
		<div class="form-group form-focus">
			<input type="email" class="form-control floating" name="email" value="{{ old('email') }}">
			<label class="focus-label">Company Email</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-2">  
		<div class="form-group form-focus">
			<input type="text" class="form-control floating" name="phone" value="{{ old('phone') }}">
			<label class="focus-label">Company Phone</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-2">  
		<a href="" class="btn btn-success btn-block"> Search </a>  
	</div>     
</div>
<!-- /Search Filter -->
@if($data->view_type == 'list')
@include('system.companies.part-list')
@else
@include('system.companies.part-cards')
@endif

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