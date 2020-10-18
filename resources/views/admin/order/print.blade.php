<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$order->id}}-{{$order->firstname." ".$order->lastname}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/')}}admin/dist/css/adminlte.min.css">
</head>

<body style="padding: 5px">
    @php(setlocale(LC_TIME, 'Dutch'))
    <div class="wrapper" style="padding:5px">
        <!-- Main content -->
        <section class="invoice" style="padding:5px">

            <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                    <h4>BESTELBON</h4>
                </div>
                <div class="col-sm-8" >
                </div>
                <div class="col-sm-4 invoice-col" >
                    <b>{{ __('m.orderDate') }}:</b> {{$order->created_at->formatLocalized('%A %d/%m/%Y ')}}<br>
                    <b>{{ __('m.orderId') }}:</b> {{$order->id}}<br>
                </div>
                <div class="col-sm-12 invoice-col">



                    <b>{{ __('m.customer') }}:</b><br>{{$order->firstname." ".$order->lastname}}
                    <br>{{$order->address1." ".$order->address2}}
                    <br>{{$order->town." ".$order->zip}}
                    <br>
                    <p>
                    {{ __('m.phone') }}: {{$order->phone}}
                    <br>
                    {{ __('m.email') }}: {{$order->email}}
                    <br></p>
                    <b>{{ __('m.pickupTime') }}</b>: {{$order->date->formatLocalized('%A %d/%m/%Y ') . " om " . $order->hour . ":" . $order->minute}}
                    <br>
           {{ __('m.message') }} : {{$order->message}}
            <br>
            {{--{{ __('m.shop') }}: {{$setting->site_name}}--}}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
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
                                <td>@if($item["product"]->sell_product_option=="weight_wise")
                                €{{number_format((float)$item["product"]->price_weight*1000, 2, ',', '')}}/kg
                                @elseif($item["product"]->sell_product_option=="per_unit")
                                €{{number_format((float)$item["product"]->price_per_unit, 2, ',', '')}}/ stuk
                                @else
                                €{{number_format((float)$item["product"]->price_per_person, 2, ',', '')}}/p.p.
                                @endif
                                </td>
                                <td>{{ $item["message"]}}</td>
                                <td>
                                    @if($item["product"]->sell_product_option=="weight_wise")
                                    €{{number_format((float)$item["product"]->price_weight*$item["quantity"], 2, ',', '')}}
                                    @elseif($item["product"]->sell_product_option=="per_unit")
                                    €{{number_format((float)$item["product"]->price_per_unit*$item["quantity"], 2, ',', '')}}
                                     @else
                                      €{{number_format((float)$item["product"]->price_per_person*$item["quantity"], 2, ',', '')}}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                            <td colspan="3"></td>
                            <th>{{ __('m.total') }}:</th>
                                <td>€{{number_format((float)$order->total, 2, ',', '')}}</td>
                            </tr>
                        </tbody>
                    </table>
                     <table class="table">
                            <tr>
                                <th style="border:none">Webwinkel:</th>
                                <th style="border:none">Adres:</th>
                                <th style="border:none">Contact:</th>
                            </tr>
                             <tr>
                                <td style="border:none;padding-top:0">{{$setting->site_name}}</td>
                                <td style="border:none;padding-top:0">{{$setting->contact_address}}</td>
                                <td style="border:none;padding-top:0">Tel.:{{$setting->contact_phone}}<br>
                                E-mail.:{{$setting->contact_email}}
                                </td>
                            </tr>
                        </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            {{--  <div class="row">

                <div class="col-12">


                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">{{ __('m.subTotal') }}:</th>
                                <td>€{{number_format((float)$order->total, 2, ',', '')}}</td>
                            </tr>
                            <tr>
                                <th>Tax (0%)</th>
                                <td>€0</td>
                            </tr>

                            <tr>
                            <th ></th>
                            <th ></th>
                            <th ></th>
                                <th>{{ __('m.total') }}:</th>
                                <td>€{{number_format((float)$order->total, 2, ',', '')}}</td>
                            </tr>
                        </table>
                        <table >
                            <tr>
                                <th>Webwinkel:</th>
                                <th>Adres:</th>
                                <th>Contact:</th>
                            </tr>
                             <tr>
                                <td>Webwinkel:</td>
                                <td>Adres:</td>
                                <td>Contact:</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>  --}}
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
