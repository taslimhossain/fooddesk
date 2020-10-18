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
    <div class="wrapper" style="padding:5px">
        <!-- Main content -->
        <section class="invoice" style="padding:5px">

           

            @foreach($order->orderLines as $item)
            <div class="my-3">
                <div style="display:inline-block">
                    <b>{{$item->product->product_name_dch}}</b><br/>
                
                <b>
                    @if($item["product"]->sell_product_option=="weight_wise")
                €{{number_format((float)$item["product"]->price_weight*1000, 2, ',', '')}}
                @elseif($item["product"]->sell_product_option=="per_unit")
                €{{number_format((float)$item["product"]->price_per_unit, 2, ',', '')}}
                @else
                €{{number_format((float)$item["product"]->price_per_person, 2, ',', '')}}
                @endif
                </b><br/>
              
                <b>
                    @if($item["product"]->sell_product_option=="weight_wise")
                    {{$item["quantity"]}} gr
                    @else
                    {{$item["quantity"]}}
                    @endif
                </b>
                </div>
                <div style="display:inline-block">
                    {{$order->date->formatLocalized('%A %d/%b/%y ')  . $order->hour . ":" . $order->minute}}
                </div>
            </div>
           
            @endforeach
           
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
