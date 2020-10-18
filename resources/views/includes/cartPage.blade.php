<div class="col-12">
    <form action="#">
        <!--=======  cart table  =======-->

        <div class="cart-table table-responsive mb-40">
            <table class="table">
                <thead>
                <tr>
                    <th class="pro-thumbnail">{{__('f.image')}}</th>
                    <th class="pro-title">{{__('f.product')}}</th>
                    <th class="pro-price">{{__('f.price')}}</th>
                    <th class="pro-quantity">{{__('f.quantity')}}</th>
                    <th class="pro-subtotal">{{__('f.total')}}</th>
                    <th class="pro-remove">{{__('f.remove')}}</th>
                </tr>
                </thead>
                <tbody>
                @php($total=0)
                @foreach($cart as $item)
                    <tr>
                        <td class="pro-thumbnail"><a href="#"><img
                                    src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$item["product"]->image}}&h=350&w=350"
                                    class="img-fluid" alt="Product"></a></td>
                        <td class="pro-title"><a
                                href="{{URL::to('/product')}}/{{$item["product"]->product_name_dch}}">{{$item["product"]->product_name_dch}}</a>
                        </td>
                        <td class="pro-price"><span>
                                            @if($item["product"]->sell_product_option=="weight_wise")
                                    €{{number_format((float)$item["product"]->price_weight*1000, 2, ',', '')}}/kg
                                @elseif($item["product"]->sell_product_option=="per_unit")
                                    €{{number_format((float)$item["product"]->price_per_unit, 2, ',', '')}}/ stuk
                                @else
                                    €{{number_format((float)$item["product"]->price_per_person, 2, ',', '')}}/ Person

                                @endif
                                        </span></td>
                        <td class="pro-quantity" style="padding:0">
                            <div class="pro-qty"><input data-id="{{$item["id"]}}"
                                                        onchange="updateCart({{$item["id"]}},this.value,this.parentElement.parentElement.children[1].value,this)"
                                                        type="text"
                                                        @if($item[ "product" ]->sell_product_option=="weight_wise") value="{{$item["quantity"]>999?$item["quantity"]/1000:$item["quantity"]}}"
                                                        @else value="{{$item["quantity"]}}" @endif >
                            </div>
                            @if($item["product"]->sell_product_option=="weight_wise")
                                <select
                                    onchange="updateCart({{$item["id"]}},this.parentElement.children[0].children[0].value,this.value)"
                                    name="sort-by" class="nice-select">
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
                        <td class="pro-remove"><a href="javascript:void(0)" onclick="removeCart({{$item["id"]}})"
                                                  data-tooltip="Remove from cart"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!--=======  End of cart table  =======-->


    </form>

    <div class="row">
        <div class="col-lg-6 col-12"></div>
        <div class="col-lg-6 col-12 d-flex">
            <!--=======  Cart summery  =======-->

            <div class="cart-summary">
                <div class="cart-summary-wrap">
                    <h4>{{__('f.cart_summary')}}</h4>
                    <p>{{__('f.sub_total')}} <span>€{{number_format((float)$total, 2, ',', '')}}</span></p>
                    <h2>{{__('f.grand_total')}} <span>€{{number_format((float)$total, 2, ',', '')}}</span></h2>
                </div>
                <div class="cart-summary-button">
                    <div class="row">
                        <div class="col-lg-5 col-12">

                        </div>
                        <div class="col-lg-7 col-12 text-right">
                            <div class="row">
                            <div class="col-lg-7">
                                <a href="{{route('home')}}">
                                    <button class="update-btn">{{__('f.continue_shopping')}}</button>
                                </a>
                            </div>
                            <div class="col-lg-5">
                                <a href="{{route('checkout')}}">
                                    <button class="checkout-btn mb-20">{{__('f.checkout')}}</button>
                                </a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--=======  End of Cart summery  =======-->

        </div>

    </div>

</div>
