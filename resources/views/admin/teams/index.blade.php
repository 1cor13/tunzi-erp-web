@extends('layouts.site')

@php( $page_name = 'User Subscription Teams' )

@section('title', $page_name)
@section('styles')
@endsection
@section('sidebar')
    @include('layouts.includes.side-admin')
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">{{ $page_name }}</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><i class="la la-home mt-1 mr-1"></i> {{ $page_name }}</li>
            </ul>
        </div>
    </div>
</div>
@include('layouts.includes.notifications')



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