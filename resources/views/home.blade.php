@extends('layouts.user')

@section('breadcumb')
<li class="current">
    <i class="icon-home"></i><a href="{{ route('dashboard') }}"> Dashboard </a>
</li>
@stop

@section('content')
    <div class="col-sm-8 col-md-12" style="background: #D8E0F3; padding:13px">
        <div class="statbox widget box box-shadow">
            <div class="widget-content">
                <div class="title"><h3>Recent Stock In Bills</h3></div>
                <div class="value"></div>
                @if(count($stock_in_bills))

                <table width="100%" class="table datatable table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <th>Sl No</th>
                        <th>Company </th>
                        <th>Bill Date</th>
                        <th>Receipt Number</th>
                        <th>Party Name</th>
                        <th>Party Address</th>
                        <th>Party DL</th>
                        <th>View Details/Print</th>
                    </thead>

                    <tbody>
                        @foreach($stock_in_bills as $k => $v)
                        <tr>
                            <td> {{ $k+1 }} </td>
                            <td> {{ $v->company['name'] }} </td>
                            <td> {{ date('d-m-Y', strtotime($v->receive_date)) }} </td>
                            <td> {{ $v->receipt_number }} </td>
                            <td> {{ $v->party_name }} </td>
                            <td> {{ $v->party_address }} </td>
                            <td> {{ $v->party_dl }} </td>
                            <td> 
                                <a href="{{ route('stock.receipt', $v->id) }}">View/Print</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('stock.report') }}" class="btn btn-success">View All Stock-in Bills</a>
                @else
                <div class="alert alert-warning">
                  <strong>No Bills Found !</strong> 
                </div>
                @endif
            </div>
        </div> <!-- /.smallstat -->
    </div> <!-- /.col-md-3 -->

    <div style="margin-top:20px;">&nbsp;</div>
    <div class="col-sm-8 col-md-12" style="background: #F0EBAE; padding:13px">
        <div class="statbox widget box box-shadow">
            <div class="widget-content">
                <div class="title"><h3>Recent Stock dispatch Bills</h3></div>
                <div class="value"></div>
                @if(count($stock_out_bills))

                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <th>Sl No</th>
                        <th>Company </th>
                        <th>Bill Date</th>
                        <th>Receipt Number</th>
                        <th>Party Name</th>
                        <th>Party Address</th>
                        <th>Party DL</th>
                        <th>View Details/Print</th>
                    </thead>

                    <tbody>
                        @foreach($stock_out_bills as $k => $v)
                        <tr>
                            <td> {{ $k+1 }} </td>
                            <td> {{ $v->company['name'] }} </td>
                            <td> {{ date('d-m-Y', strtotime($v->dispatch_date)) }} </td>
                            <td> {{ $v->receipt_number }} </td>
                            <td> {{ $v->party_name }} </td>
                            <td> {{ $v->party_address }} </td>
                            <td> {{ $v->party_dl }} </td>
                            <td> 
                                <a href="{{ route('stock.receipt', $v->id) }}">View/Print</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('stock_dispatch.report') }}" class="btn btn-success">View All Stock-dispatch Bills</a>
                @else
                <div class="alert alert-warning">
                  <strong>No Bills Found !</strong> 
                </div>
                @endif
            </div>
        </div> <!-- /.smallstat -->
    </div> <!-- /.col-md-3 -->
    <div style="margin-top:20px;">&nbsp;</div>
    <div class="col-sm-8 col-md-12" style="background: #F8D5A8; padding:13px">
        <div class="statbox widget box box-shadow">
            <div class="widget-content">
                <div class="title"><h3>Available Products</h3></div>
                <div class="value"></div>
                @if(count($products))

                <table width="100%" class="table datatable table-bordered" id="dataTables-example">
                    <thead>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>MRP</th>
                        <th>Trade</th>
                        <th>Stock</th>
                    </thead>

                    <tbody>
                        @foreach($products as $k => $v)
                        <tr>
                            <td> {{ $k+1 }} </td>
                            <td> {{ $v->name }} </td>
                            <td> {{ $v->unit }} </td>
                            <td> {{ $v->mrp }} </td>
                            <td> {{ $v->trade }} </td>
                            <td> {{ $v->stock_in_hand }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h4>No Products Found ! </h4>
                @endif
            </div>
        </div> <!-- /.smallstat -->
    </div> <!-- /.col-md-3 -->
<!-- /Statboxes -->
@endsection
