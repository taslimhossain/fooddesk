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
            Customer Report for {{$start}} to {{$end}}
            </h3>
        </center>
        </div>
        <!-- Main content -->
        @php($t=0) 
        @foreach($customers as $customer)
                    <section class="invoice" style="padding:20px">

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
                                        @php($tot=0)
                                        @foreach($customer["order"] as $order)
                                        @php($tot+=$order->total)

                                        <tr>
                                            <td>
                                               
                                                {{$order->id}}
                                            </td>
                                            <td>
                                               <ul class="list-group">
                                                @foreach($order->orderLines as $line)
                                                    <li class="list-group-item">
                                                        {{$line->product->product_name_dch}} 
                                                        
                                                        @if($line->product->sell_product_option=="weight_wise")
                                €{{number_format((float)$line->product->price_weight*1000, 2, ',', '')}}
                                @elseif($line->product->sell_product_option=="per_unit")
                                €{{number_format((float)$line->product->price_per_unit, 2, ',', '')}}
                                @else
                                €{{number_format((float)$line->product->price_per_person, 2, ',', '')}}
                                @endif
                                x 
                                 {{$line->quantity}}
                                                        @if($line->product->sell_product_option=="weight_wise")
                                                            gr
                                                        @endif
                                                        =
                                                        @if($line->product->sell_product_option=="weight_wise")
                                €{{number_format((float)$line->product->price_weight*$line->quantity, 2, ',', '')}}
                                @elseif($line->product->sell_product_option=="per_unit")
                                €{{number_format((float)$line->product->price_per_unit*$line->quantity, 2, ',', '')}}
                                @else
                                €{{number_format((float)$line->product->price_per_person*$line->quantity, 2, ',', '')}}
                                @endif
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
                                        {{--  <tr>
                                            <td colspan="3"></td>
                                            <th>{{ __('m.total') }}:</th>
                                            @php($t=$t+$order->total)
                                            <td>€{{number_format((float)$order->total, 2, ',', '')}}</td>
                                        </tr>  --}}
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
        {{--  <div class="row">
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
        </div>  --}}
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>