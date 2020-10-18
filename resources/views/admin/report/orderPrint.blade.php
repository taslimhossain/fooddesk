<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$setting->site_name}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/')}}admin/dist/css/adminlte.min.css">
</head>

<body>
    @php(setlocale(LC_TIME, 'Dutch'))
    <div class="wrapper">
        <div style="margin-top:10px">
        <center>
            <h3>
            Order Report for {{$start}} to {{$end}}
            </h3>
        </center>
        </div>
        <!-- Main content -->
        @php($t=0) @foreach($orders as $order)
        <section class="invoice " style="padding:20px">

            <div class="row invoice-info">

                <div class="col-sm-4 invoice-col">

                    <b>{{ __('m.orderId') }}:</b> {{$order->id}}<br>
                    <b>{{ __('m.orderDate') }}:</b> {{$order->created_at->formatLocalized('%A %d/%b/%y ')}}<br>
                   
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
                                    person @endif

                                </td>
                                <td>{{$item->product->product_name_dch}}</td>
                                <td>@if($item["product"]->sell_product_option=="weight_wise") €{{number_format((float)$item["product"]->price_weight*1000, 2, ',', '')}}/kg @elseif($item["product"]->sell_product_option=="per_unit") €{{number_format((float)$item["product"]->price_per_unit,
                                    2, ',', '')}}/ stuk @else €{{number_format((float)$item["product"]->price_per_person, 2, ',', '')}}/person @endif
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
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total</th>
                            <th>€{{number_format((float)$t, 2, ',', '')}}</th>
                        </tr>

                    </thead>
                </table>

            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>