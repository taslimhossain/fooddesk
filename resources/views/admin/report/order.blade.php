@extends('layouts.admin') @section('content')
@php(setlocale(LC_TIME, 'Dutch'))
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Order Report</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('orderList')}}">Home</a></li>
                        <li class="breadcrumb-item active">Order Report</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <form method="post" action="{{route('orderReportResult')}}">
                        @csrf
                        <div class="row">

                            <div class="col-md-5">
                                <div class="form-group form-inline">
                                    <label>Start Date</label>
                                    <input required name="start" id="start" class="ml-2 form-control" type="date">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group form-inline">
                                    <label>End Date</label>
                                    <input required name="end" id="end" class="ml-2 form-control" type="date">
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <button class="btn btn-success ">{{ __('m.search') }}</button>
                            </div>

                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-6">
                            <form method="post" action="{{route('orderReportResult')}}">
                                @csrf
                                <input name="start" value="{{date('Y-m-d', strtotime('+1 day'))}}" class="ml-2 form-control" type="hidden">
                                <input name="end" value="{{date('Y-m-d', strtotime('+1 day'))}}" class="ml-2 form-control" type="hidden">
                                <button class="btn btn-warning ">Tomorrow
                                    {{date('Y-m-d', strtotime('+1 day'))}}</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form method="post" action="{{route('orderReportResult')}}">
                                @csrf
                                <input name="start" value="{{date('Y-m-d', strtotime('+2 day'))}}" class="ml-2 form-control" type="hidden">
                                <input name="end" value="{{date('Y-m-d', strtotime('+2 day'))}}" class="ml-2 form-control" type="hidden">
                                <button class="btn btn-warning ">Day after tomorrow
                                    {{date('Y-m-d', strtotime('+2 day'))}}</button>
                            </form>
                        </div>
                    </div>



                </div>
                <div class="card-body">
                @php($t=0)
                    @if(isset($start))
                    <h4>Result showing for {{$start}} to {{$end}}</h4>
                     @endif
                     @foreach($orders as $order)
                    <section class="invoice p-2">

                        <div class="row invoice-info">

                            <div class="col-sm-4 invoice-col">

                                <b>{{ __('m.orderId') }}:</b> {{$order->id}}<br>
                                <b>{{ __('m.orderDate') }}:</b> {{$order->created_at->formatLocalized('%A %d/%b/%y ')}}<br>
                                <br>
                                <b>{{ __('m.customer') }}:</b> <br>{{$order->firstname." ".$order->lastname}}
                                <br>{{$order->address1." ".$order->address2}}
                                <br>{{$order->town." ".$order->zip}}
                                <br>
                                <p>
                                    {{ __('m.phone') }}: {{$order->phone}}
                                    <br> {{ __('m.email') }}: {{$order->email}}
                                    <br></p>
                                {{ __('m.pickupTime') }}: {{$order->date->formatLocalized('%A %d/%b/%y ') . " on " . $order->hour . ":" . $order->minute}}
                                <br> {{ __('m.message') }} :{{$order->message}}
                                <br> {{ __('m.shop') }}: {{$setting->site_name}}
                            </div>
                            <div class="col-sm-8 table-responsive">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>{{ __('m.quantity') }}</th>
                                            <th>{{ __('m.product') }}</th>
                                            <th>{{ __('m.price') }}</th>
                                            <th>{{ __('m.message') }}</th>
                                            <th>{{ __('m.subTotal') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderLines as $item)
                                        <tr>
                                            <td>
                                                @if($item[ "product" ]->sell_product_option=="weight_wise") {{$item["quantity"]>999?($item["quantity"]/1000)."kg":$item["quantity"]."gr"}} @elseif($item["product"]->sell_product_option=="per_unit") {{$item["quantity"]}} stuk @else {{$item["quantity"]}}
                                                p.p. @endif

                                            </td>
                                            <td>{{$item->product->product_name_dch}}</td>
                                            <td>@if($item["product"]->sell_product_option=="weight_wise") €{{number_format((float)$item["product"]->price_weight*1000, 2, ',', '')}}/kg @elseif($item["product"]->sell_product_option=="per_unit") €{{number_format((float)$item["product"]->price_per_unit,
                                                2, ',', '')}}/ stuk @else €{{number_format((float)$item["product"]->price_per_person, 2, ',', '')}}/p.p. @endif
                                            </td>
                                            <td>{{ $item["message"]}}</td>
                                            <td>
                                                @if($item["product"]->sell_product_option=="weight_wise") €{{number_format((float)$item["product"]->price_weight*$item["quantity"], 2, ',', '')}} @elseif($item["product"]->sell_product_option=="per_unit") €{{number_format((float)$item["product"]->price_per_unit*$item["quantity"],
                                                2, ',', '')}} @else €{{number_format((float)$item["product"]->price_per_person*$item["quantity"], 2, ',', '')}} @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3"></td>
                                            <th>{{ __('m.total') }}:</th>
                                            @php($t=$t+$order->total)
                                            <td>€{{number_format((float)$order->total, 2, ',', '')}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->


                        <!-- /.row -->


                        <!-- /.row -->
                    </section>
                    @endforeach
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8 table-responsive">
                            @if(isset($start))
<table class="table table-striped ">
                                <thead>
                                    <tr>
                                    
                                        
                                        <th style="width:70%"></th>
                                        <th>Total</th>
                                        <th>€{{number_format((float)$t, 2, ',', '')}}</th>
                                    </tr>
                                    <tr>
                                        
                                        <th style="width:50%"></th>
                                        <th style="width:50%">
                                        
                                            <a target="_blank" href="{{route('orderReportExport')}}?start={{$start}}&end={{$end}}">
                                                Export in PDF
                                            </a>
                                            
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
    </section>
    </div>

    @endsection @section('script')
    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script>
        var table = $('.data-table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                //'copyHtml5',
                'excelHtml5',
                //'csvHtml5',
                'pdfHtml5'
            ]
        })
    </script>

    @endsection
