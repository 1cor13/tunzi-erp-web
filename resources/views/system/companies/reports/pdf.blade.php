<!DOCTYPE html>
<html>
<head>
  <title>Report @if($report)- {{$report->name}} @endif</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

@if($report)
<style type="text/css">
  .invoice-header {
    background: #f7f7f7;
    padding: 10px 20px 10px 20px;
    border-bottom: 1px solid gray;
  }
  .site-logo {
    margin-top: 20px;
  }
  .invoice-right-top h3 {
    padding-right: 20px;
    margin-top: 20px;
    color: green;
    font-size: 30px!important;
    font-family: serif;
  }
  .invoice-left-top {
    border-left: 4px solid green;
    padding-left: 20px;
    padding-top: 20px;
  }
  .invoice-left-top p {
    margin: 0;
    line-height: 20px;
    font-size: 16px;
    margin-bottom: 3px;
  }
  thead {
    background: green;
    color: #FFF;
  }
  .authority h5 {
    margin-top: -10px;
    color: green;
  }
  .thanks h4 {
    color: green;
    font-size: 25px;
    font-weight: normal;
    font-family: serif;
    margin-top: 20px;
  }
  .site-address p {
    line-height: 6px;
    font-weight: 300;
  }
  .table tfoot .empty {
    border: none;
  }
  .table-bordered {
    border: none;
  }
  .table-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0,0,0,.03);
    border-bottom: 1px solid rgba(0,0,0,.125);
  }
  .table td, .table th {
    padding: .30rem;
  }
</style>
  <div class="invoice-header">
    <div class="float-left site-logo">
      <img src="{{asset('backend/img/logo.png')}}" alt="">
    </div>
    <div class="float-right site-address">
      <h4>{{env('APP_NAME')}}</h4>
      <p>{{env('APP_ADDRESS')}}</p>
      <p>Phone: <a href="tel:{{env('APP_PHONE')}}">{{env('APP_PHONE')}}</a></p>
      <p>Email: <a href="mailto:{{env('APP_EMAIL')}}">{{env('APP_EMAIL')}}</a></p>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="invoice-description">
    <div class="invoice-left-top float-left">
      <h6>Reports</h6>
       <h3>{{$report->name}}</h3>
       <div class="address">
        <p>
          <strong>Type: </strong>
          {{$report->type}}
        </p>
        <p>
          <strong>Description: </strong>
          {{ $report->description }} 
        </p>
         <p><strong>Group By:</strong> {{ $report->group_by }}</p>
         <p><strong>Period:</strong> {{ $report->period }}</p>
       </div>
    </div>
    <div class="invoice-right-top float-right" class="text-right">
      <h3>Basis #{{$report->basis}}</h3>
      <p>{{ $report->created_at->format('D d m Y') }}</p>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="thanks mt-3">
    <h4>Thank you for your business !!</h4>
  </div>
  <div class="authority float-right mt-5">
    <p>-----------------------------------</p>
    <h5>Authority Signature:</h5>
  </div>
  <div class="clearfix"></div>
@else
  <h5 class="text-danger">Invalid</h5>
@endif
</body>
</html>