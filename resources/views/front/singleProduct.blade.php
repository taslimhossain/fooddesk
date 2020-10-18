@extends('layouts.front')
@section('meta')
<meta property="og:title" content="{{$product->product_name_dch}}" />
<meta property="og:image" content="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$product->image}}&h=350&w=350" />
{{--  <meta property="og:description" content="Description Here" />  --}}
<meta property="og:url" content="{{route('singleProduct',$product->product_name_dch)}}" />
@endsection
@section('content')
<style>
.nice-select{
    display:inline-block;
    float:inherit;
}
</style>

    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                               <li><a href="{{route('home')}}"><i class="fa fa-home"></i> {{ __('f.home') }}</a></li>
                        <li  class="active"><a href="{{route('category',$product->category->name)}}">{{$product->category->name}}</a></li>
                        @if($product->subCategory)
                        <li  class="active"><a href="{{route('subcategory',$product->subCategory->name)}}">{{$product->subCategory->name}}</a></li>
                        @endif
                        <li  class="active"><a href="{{route('singleProduct',$product->product_name_dch)}}">{{$product->product_name_dch}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====  End of breadcrumb area  ======-->

    <!--=============================================
    =            single product content         =
    =============================================-->

    <div class="single-product-content ">
        <div class="container">
            <!--=======  single product content container  =======-->
            <div class="single-product-content-container mb-35">
                <div class="row">
                    <div class="col-lg-5 col-md-12 col-xs-12 mb-sm-35 mb-xs-35">
                        <img src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$product->image}}&h=350&w=350" onerror="this.onerror=null;this.src='{{URL::to('/')}}/images/{{$setting->default_product}}';" class="img-fluid" alt="">
                        <div class="product-feature-details">
                            <div class="social-share-buttons mt-20" style="display:none;">
                                <h3>share this product</h3>
                                <ul>
                                    <li><a class="twitter" href="https://twitter.com/intent/tweet?url={{route('singleProduct',$product->product_name_dch)}}"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="facebook" href="http://www.facebook.com/sharer/sharer.php?u={{route('singleProduct',$product->product_name_dch)}}"><i class="fa fa-facebook"></i></a></li>
                                    {{--  <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>  --}}
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-7 col-md-12 col-xs-12">
                        <!-- product quick view description -->
                        <div class="product-feature-details">
                            <h2 class="product-title mb-15">{{$product->product_name_dch}}</h2>
                            <h2 class="product-price mb-15">
                                <span class="discounted-price">  @if($product->sell_product_option=="weight_wise")
                        €{{number_format((float)$product->price_weight*1000, 2, ',', '')}}/kg
                        @elseif($product->sell_product_option=="per_unit")
                        €{{number_format((float)$product->price_per_unit, 2, ',', '')}}/ stuk
                        @else
                        €{{number_format((float)$product->price_per_person, 2, ',', '')}}/ p.p.

                        @endif</span>
                            </h2>

                            <p class="product-description mb-20">{{$product->product_description_dch}}</p>

                            <div class="size mb-20">
                                <div class="pro-qty mr-20 mb-xs-20">
                                @if($product->sell_product_option=="weight_wise")
                                    <input type="text" value="100">

                                @else
                                    <input type="text" value="1">
                                @endif
                                </div>

                                @if($product->sell_product_option=="weight_wise")
                                <select name="sort-by"  class="nice-select">
                                    <option value="GR">gr</option>
                                    <option value="KG">kg</option>
                                </select>
                                 @elseif($product->sell_product_option=="per_unit")
                                   <select name="sort-by"  class="nice-select">
                                    <option value="Unit">stuk</option>
                                    </select>
                                @else
                                <select name="sort-by"  class="nice-select">
                                    <option value="Person">p.p.</option>
                                </select>
                                 @endif
                            </div>

                            <div class="tdmessage mb-20">
                                <textarea name="commentMessage" id="commentMessage"
                                          placeholder="{{__('f.messages')}}" style="width: 100%;padding: 10px 20px;"></textarea>
                            </div>

                            <div class="cart-buttons mb-20 text-right">
                                <div class="add-to-cart-btn">
                                   <a href="{{url('/')}}" data-tooltip="Continue Shopping" style="min-width: 10px;padding: 0px 15px;">
                                    {{__("m.continueShopping")}}
                                   </a>
                                    @if($setting->wishList)
                                    <a href="javascript:void(0)" onclick="addToWishList({{$product->fid}})" data-tooltip="Add to wishlist" style="min-width: 10px;padding: 0px 15px;"> <span class="icon_heart_alt"></span></a>
                                    @endif
                                    <a href="javascript:void(0)" onclick="addToCart(this,{{$product->fid}})"><i class="fa fa-shopping-cart"></i>{{ __('f.add_to_cart') }}</a>
                                    <a href="{{route('checkout')}}">{{ __('f.checkout') }}</a>
                                </div>
                            </div>

                            <div class="single-product-category mb-20">
                                @if($setting->ingredient)
                                <h3>{{__('f.ingredients_dch')}} : <span>{{$product->ingredients_dch}}</span></h3>
                                @endif
                                <h3>{{__('f.allergence_dch')}} : <span>{{$product->allergence_dch}}</span></h3>
                                <h3>{{__('f.product_id')}} : <span>{{$product->fid}}</span></h3>
                                <h3>{{__('f.category_list')}} : <span>
                                @if($product->subCategory)
                                    <a href="{{route('subcategory',$product->subCategory->name)}}">{{$product->subCategory->name}}</a>,
                                @endif
                                 <a href="{{route('category',$product->category->name)}}">{{$product->category->name}}</a></span></h3>
                            </div>
                        </div>
                        <!-- end of product quick view description -->
                    </div>
                </div>
            </div>

        <!--=======  End of single product content container  =======-->

        </div>

    </div>

    <!--=====  End of single product content  ======-->

    <!--=============================================
	=            Related Product slider         =
	=============================================-->

	<div class="slider related-product-slider mb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  multisale  slider section title  =======-->

                    <div class="section-title">
                        <h3>{{__('f.related_product')}}</h3>
                    </div>

                    <!--=======  End of multisale slider section title  =======-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  related product slider wrapper  =======-->

                    <div class="related-product-slider-wrapper">
                        <!--=======  single related slider product  =======-->
                    @foreach($relatedProducts as $prd)
                        <div class="gf-product related-slider-product">
                            <div class="image">
                                <a href="{{URL::to('/product')}}/{{$prd->product_name_dch}}">
                                    <img src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$prd->image}}&h=350&w=350" onerror="this.onerror=null;this.src='{{URL::to('/')}}/images/{{$setting->default_product}}';" class="img-fluid" alt="">
                                </a>
                            </div>
                            <div class="product-content">
                                <h3 class="product-title"><a href="{{URL::to('/product')}}/{{$prd->product_name_dch}}">{{$prd->product_name_dch}}</a></h3>
                                <div class="price-box">
                                    <span class="discounted-price">@if($prd->sell_product_option=="weight_wise")
                        €{{number_format((float)$prd->price_weight*1000, 2, ',', '')}}/kg
                        @elseif($prd->sell_product_option=="per_unit")
                        €{{number_format((float)$prd->price_per_unit, 2, ',', '')}}/ stuk
                        @else
                        €{{number_format((float)$prd->price_per_person, 2, ',', '')}}/ p.p.

                        @endif</span>
                                </div>
                            </div>

                        </div>
                    @endforeach

                        <!--=======  End of single related slider product  =======-->
                        <!--=======  single related slider product  =======-->

                    </div>

                    <!--=======  End of related product slider wrapper  =======-->
                </div>
            </div>
        </div>
    </div>
    <script>

    addToWishList = (id) => {
        $.ajax({
            url: "{{URL::to('add-wishlist')}}/" + id,
            success: function(result) {
            toastr.success('Successfully added to wishlist')
            }
        });
    }
    addToCart = (el,id) => {
        let quantity=el.parentElement.parentElement.parentElement.children[3].children[0].children[0].value
        let weight=el.parentElement.parentElement.parentElement.children[3].children[1].value;
        let msg=el.parentElement.parentElement.parentElement.children[4].children[0].value;
        if(weight=="GR"&&quantity<10){
            toastr.error('Minimum Quantity Required');
            return;
        }

        if(quantity<1){
            toastr.error('Minimum Quantity Required');
            return;
        }
        $.ajax({
            url: `{{URL::to('add-to-cart')}}?quantity=${quantity}&id=${id}&weight=${weight}&msg=${msg}`,
            success: function(result) {
                updateCartHeader();
                toastr.success("{{__('f.successfully_added_to_cart')}}")
                $("#commentMessage").val("");

            }
        });
    }

</script>

@endsection
