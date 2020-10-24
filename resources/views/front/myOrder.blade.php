@extends('layouts.front') @section('content')
<style>
.qty-btn{
display:none
}
</style>

<div class="breadcrumb-area ">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb-container">
                    <ul>
                        <li><a href="/"><i class="fa fa-home"></i> {{ __('f.home') }}</a></li>
                        <li class="active">Order</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-section section mb-50">
    <div class="container">
        <div class="row" id="cart-container">
            <div class="col-12">
                <div class="cart-table table-responsive mb-40" >
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Total</th>

                                </tr>
                            </thead>
                            <tbody>
                            @php($total=0)
                                @foreach($order->orderLines as $item)
                                <tr>
                                    <td class="pro-thumbnail"><a href="{{URL::to('/product')}}/{{$item["product"]->product_name_dch}}"><img
                                                src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$item["product"]->image}}&h=350&w=350"
                                                class="img-fluid" alt="Product"></a>
                                    <a href="{{URL::to('/product')}}/{{$item["product"]->product_name_dch}}">{{$item["product"]->product_name_dch}}</a></td>
                                    <td class="pro-price"><span>
                                            @if($item["product"]->sell_product_option=="weight_wise")
                                            €{{number_format((float)$item["product"]->price_weight*1000, 2, ',', '')}}/kg
                                            @elseif($item["product"]->sell_product_option=="per_unit")
                                            €{{number_format((float)$item["product"]->price_per_unit, 2, ',', '')}}/ stuk
                                            @else
                                            €{{number_format((float)$item["product"]->price_per_person, 2, ',', '')}}/ Person

                                            @endif
                                        </span></td>
                                    <td class="pro-quantity">
                                        <div class="pro-qty"><input disabled type="text" @if($item[ "product" ]->sell_product_option=="weight_wise") value="{{$item["quantity"]>999?$item["quantity"]/1000:$item["quantity"]}}" @else value="{{$item["quantity"]}}" @endif >
                                        </div>
                                        @if($item["product"]->sell_product_option=="weight_wise")
                                        <select disabled name="sort-by" class="nice-select">
                                            <option {{$item["quantity"]<1000?"selected":""}} value="GR">gr</option>
                                            <option {{$item["quantity"]>999?"selected":""}} value="KG">kg</option>
                                        </select> @elseif($item["product"]->sell_product_option=="per_unit")
                                        <select name="sort-by" class="nice-select">
                                            <option value="Unit">stuk</option>

                                        </select> @else
                                        <select name="sort-by" class="nice-select">
                                            <option value="Person">PER</option>
                                        </select> @endif
                                    </td>
                                    <td class="pro-subtotal"><span>
                                            @if($item["product"]->sell_product_option=="weight_wise")
                                            @php($total+=$item["product"]->price_weight*$item["quantity"])
                                            €{{number_format((float)$item["product"]->price_weight*$item["quantity"], 2, ',', '')}}
                                            @elseif($item["product"]->sell_product_option=="per_unit")
                                            @php($total+=$item["product"]->price_per_unit*$item["quantity"])
                                            €{{number_format((float)$item["product"]->price_per_unit*$item["quantity"], 2, ',', '')}}
                                            @else
                                            @php($total+=$item["product"]->price_per_person*$item["quantity"])
                                            €{{number_format((float)$item["product"]->price_per_person*$item["quantity"], 2, ',', '')}}

                                            @endif
                                        </span></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                <!--=======  End of cart table  =======-->
            </div>

        </div>
    </div>
</div>


@endsection
