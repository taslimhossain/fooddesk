@extends('layouts.admin') @section('content')
 @php(setlocale(LC_TIME, 'Dutch'))
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Customer Report</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('orderList')}}">Home</a></li>
                        <li class="breadcrumb-item active">Customer Report</li>
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
                    <form method="post" action="{{route('customerReportResult')}}">
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
                            <form method="post" action="{{route('customerReportResult')}}">
                                @csrf
                                <input name="start" value="{{date('Y-m-d', strtotime('+1 day'))}}" class="ml-2 form-control" type="hidden">
                                <input name="end" value="{{date('Y-m-d', strtotime('+1 day'))}}" class="ml-2 form-control" type="hidden">
                                <button class="btn btn-warning ">Tomorrow
                                    {{date('Y-m-d', strtotime('+1 day'))}}</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form method="post" action="{{route('customerReportResult')}}">
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
                    @php($t=0) @if(isset($start))
                    <h4>Result showing for {{$start}} to {{$end}}</h4>
                    @endif @foreach($customers as $customer)
                    <section class="invoice p-2">

                        <div class="row invoice-info">

                            <div class="col-sm-4 invoice-col">


                                {{$customer["order"][0]->firstname." ".$customer["order"][0]->lastname}}
                                <br>{{$customer["order"][0]->address1." ".$customer["order"][0]->address2}}
                                <br>{{$customer["order"][0]->town." ".$customer["order"][0]->zip}}
                                <br>
                                <p>
                                    {{ __('m.phone') }}: {{$customer["order"][0]->phone}}
                                    <br> {{ __('m.email') }}: {{$customer["order"][0]->email}}
                                    <br></p>

                            </div>
                            <div class="col-sm-8 table-responsive">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>Order No</th>
                                            <th>Items</th>
                                            <th>Date</th>
                                            <th>Sub total</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($tot=0) @foreach($customer["order"] as $order) @php($tot+=$order->total)

                                        <tr>
                                            <td>

                                                {{$order->id}}
                                            </td>
                                            <td>
                                                <ul class="list-group">
                                                    @foreach($order->orderLines as $line)
                                                    <li class="list-group-item">
                                                        {{$line->product->product_name_dch}} @if($line->product->sell_product_option=="weight_wise") €{{number_format((float)$line->product->price_weight*1000, 2, ',', '')}} @elseif($line->product->sell_product_option=="per_unit") €{{number_format((float)$line->product->price_per_unit,
                                                        2, ',', '')}} @else €{{number_format((float)$line->product->price_per_person, 2, ',', '')}} @endif x {{$line->quantity}} @if($line->product->sell_product_option=="weight_wise") gr @endif = @if($line->product->sell_product_option=="weight_wise")
                                                        €{{number_format((float)$line->product->price_weight*$line->quantity, 2, ',', '')}} @elseif($line->product->sell_product_option=="per_unit") €{{number_format((float)$line->product->price_per_unit*$line->quantity,
                                                        2, ',', '')}} @else €{{number_format((float)$line->product->price_per_person*$line->quantity, 2, ',', '')}} @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>

                                                {{$order->date->formatLocalized('%A %d/%b/%y ')}}
                                            </td>
                                            <td>

                                                €{{number_format((float)$order->total, 2, ',', '')}}
                                            </td>

                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td>


                                            </td>
                                            <td>


                                            </td>
                                            <td>
                                                Total

                                            </td>
                                            <td>

                                                €{{number_format((float)$tot, 2, ',', '')}}
                                            </td>

                                        </tr>
                                        {{--
                                        <tr>
                                            <td colspan="3"></td>
                                            <th>{{ __('m.total') }}:</th>
                                            @php($t=$t+$order->total)
                                            <td>€{{number_format((float)$order->total, 2, ',', '')}}</td>
                                        </tr> --}}
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
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>

                                            <a target="_blank" href="{{route('customerReportExport')}}?start={{$start}}&end={{$end}}">
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