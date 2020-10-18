<a href="{{route('cart')}}">
    <div class="cart-icon d-inline-block">
        <span class="icon_bag_alt"></span>
    </div>
    <div class="cart-info d-inline-block">
        <p>{{ __('f.shoppingCart') }}
            <span>
                {{count($cart)}} items - €{{number_format((float)$cartTotal, 2, ',', '')}}
            </span>
        </p>
    </div>
</a>
<!-- end of shopping cart -->

<!-- cart floating box -->
<div class="cart-floating-box" id="cart-floating-box">
    <div class="cart-items">
        @foreach($cart as $item)
        <div class="cart-float-single-item d-flex">
            <span class="remove-item"><a href="javascript:void(0)" onclick="removeCartGlobal({{$item["id"]}})"><i class="fa fa-times"></i></a></span>
            <div class="cart-float-single-item-image">
                <a href="{{URL::to('/product')}}/{{$item["product"]->product_name_dch}}"><img
                        src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$item["product"]->image}}&h=350&w=350"
                        class="img-fluid" alt=""></a>
            </div>
            <div class="cart-float-single-item-desc">
                <p class="product-title"> <a href="{{URL::to('/product')}}/{{$item["product"]->product_name_dch}}">{{$item["product"]->product_name_dch}} </a></p>
                <p class="price"><span class="count">
                @if($item[ "product" ]->sell_product_option=="weight_wise")
                                                {{$item["quantity"]>999?($item["quantity"]/1000)." kg":$item["quantity"]." gr"}}
                                                @elseif($item["product"]->sell_product_option=="per_unit")
                                                {{$item["quantity"]}} stuk
                                                @else
                                                {{$item["quantity"]}} p.p.
                                                @endif
                                                x</span> @if($item["product"]->sell_product_option=="weight_wise")

                                            €{{number_format((float)$item["product"]->price_weight*1000, 2, ',', '')}}kg
                                            @elseif($item["product"]->sell_product_option=="per_unit")

                                            €{{number_format((float)$item["product"]->price_per_unit, 2, ',', '')}}
                                            @else

                                            €{{number_format((float)$item["product"]->price_per_person, 2, ',', '')}}

                                            @endif
                                            
                                            </p>
            </div>
        </div>
        @endforeach

    </div>
    <div class="cart-calculation">
        <div class="calculation-details">
            <p class="total">{{ __('f.subTotal') }} <span>€{{number_format((float)$cartTotal, 2, ',', '')}}</span></p>
        </div>
        <div class="floating-cart-btn text-center">
            <a href="{{route('checkout')}}">{{ __('f.checkout') }} </a>
            <a href="{{route('cart')}}">{{ __('f.viewCart') }} </a>
        </div>
    </div>
</div>
<!-- end of cart floating box -->
