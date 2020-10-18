<div class="shop-product-wrap {{$mode}} row mb-35" id="categoryContainer">
    @php($n=0) @foreach($products as $product) @php($n++)
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
        <!--=======  Grid view product  =======-->

        <div class="gf-product shop-grid-view-product mb-30">
            <div class="image">
                <a href="{{URL::to('/product')}}/{{$product->product_name_dch}}">
                    <img src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$product->image}}&h=350&w=350"
                        class="img-fluid" onerror="this.onerror=null;this.src='{{URL::to('/')}}/images/{{$setting->default_product}}';" alt="">
                </a>
                <div class="product-hover-icons">
                    <a href="javascript:void(0)"
                        onclick="addToCartQuick({{$product->fid}},{{$product->sell_product_option=="weight_wise"?100:1}},'{{$product->sell_product_option=="weight_wise "?"GR ":"UN "}}')"
                        data-tooltip="{{ __('f.addToCart') }}"> <span class="icon_cart_alt"></span></a>
                    <a href="javascript:void(0)" onclick="addToWishList({{$product->fid}})"
                        data-tooltip="{{ __('f.addToWishlist') }}"> <span class="icon_heart_alt"></span> </a>
                    <a href="#" data-tooltip="{{ __('f.quickView') }}" data-toggle="modal"
                        data-target="#quick-view-modal-container{{$product->fid}}"> <span class="icon_search"></span>
                    </a>
                </div>
            </div>
            <div class="product-content">
                <h3 class="product-title"><a
                        href="{{URL::to('/product')}}/{{$product->product_name_dch}}">{{$product->product_name_dch}}</a>
                </h3>
                <div class="price-box">
                @guest
                        @if($setting->hide_rate==1&&$setting->hide_rate_guest==1)
                        <span class="discounted-price">
                        @if($product->sell_product_option=="weight_wise")
                        €{{number_format((float)$product->price_weight*1000, 2, ',', '')}}/kg
                        @elseif($product->sell_product_option=="per_unit")
                        €{{number_format((float)$product->price_per_unit, 2, ',', '')}}/ stuk
                        @else
                        €{{number_format((float)$product->price_per_person, 2, ',', '')}}/ p.p.

                        @endif
                    </span>
                        @endif
                    @else
                        @if($setting->hide_rate==1)
                        <span class="discounted-price">
                        @if($product->sell_product_option=="weight_wise")
                        €{{number_format((float)$product->price_weight*1000, 2, ',', '')}}/kg
                        @elseif($product->sell_product_option=="per_unit")
                        €{{number_format((float)$product->price_per_unit, 2, ',', '')}}/ stuk
                        @else
                        €{{number_format((float)$product->price_per_person, 2, ',', '')}}/ p.p.

                        @endif
                    </span>
                        @endif
                    @endguest
                </div>
            </div>
        </div>

        <!--=======  End of Grid view product  =======-->

        <!--=======  Shop list view product  =======-->

        <!--=======  Shop list view product  =======-->
        <div class="gf-product shop-list-view-product">
            <div class="cart-table table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="pro-thumbnail"><a
                                    href="{{URL::to('/product')}}/{{$product->product_name_dch}}"><img
                                        src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$product->image}}&h=350&w=350"
                                        class="img-fluid" alt="" onerror="this.onerror=null;this.src='{{URL::to('/')}}/images/{{$setting->default_product}}';"></a></td>
                            <td class="pro-title"><a
                                    href="{{URL::to('/product')}}/{{$product->product_name_dch}}">{{$product->product_name_dch}}</a>
                            </td>
                            <td class="pro-subtotal"> @guest
                        @if($setting->hide_rate==1&&$setting->hide_rate_guest==1)
                        <span >
                        @if($product->sell_product_option=="weight_wise")
                        €{{number_format((float)$product->price_weight*1000, 2, ',', '')}}/kg
                        @elseif($product->sell_product_option=="per_unit")
                        €{{number_format((float)$product->price_per_unit, 2, ',', '')}}/ stuk
                        @else
                        €{{number_format((float)$product->price_per_person, 2, ',', '')}}/ p.p.

                        @endif
                    </span>
                        @endif
                    @else
                        @if($setting->hide_rate==1)
                        <span >
                        @if($product->sell_product_option=="weight_wise")
                        €{{number_format((float)$product->price_weight*1000, 2, ',', '')}}/kg
                        @elseif($product->sell_product_option=="per_unit")
                        €{{number_format((float)$product->price_per_unit, 2, ',', '')}}/ stuk
                        @else
                        €{{number_format((float)$product->price_per_person, 2, ',', '')}}/ p.p.

                        @endif
                    </span>
                        @endif
                    @endguest
                    </td>
                            <td class="pro-quantity">
                                <div class="pro-qty"><input type="text" value="{{$product->sell_product_option=="weight_wise"?100:1}}"></div>
                                @if($product->sell_product_option=="weight_wise")
                                <select name="sort-by" class="nice-select">
                                    <option value="GR">gr</option>
                                    <option value="KG">kg</option>
                                </select> @elseif($product->sell_product_option=="per_unit")
                                <select name="sort-by" class="nice-select">
                                    <option value="Unit">stuk</option>

                                </select> @else
                                <select name="sort-by" class="nice-select">
                                    <option value="Person">p.p.</option>
                                </select> @endif
                            </td>
                            <td class="pro-remove">

                                <div class="list-product-icons">
                                    <a href="javascript:void(0)" onclick="addToCart(this,{{$product->fid}})"
                                        data-tooltip="{{ __('f.addToCart') }}"> <span class="icon_cart_alt"></span></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--=============================================
	=            Quick view modal         =
	=============================================-->

    <div class="modal fade quick-view-modal-container" id="quick-view-modal-container{{$product->fid}}" tabindex="-1"
        role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-5 col-md-6 col-xs-12">
                            <!-- product quickview image gallery -->
                            <div class="product-image-slider">
                                <!--Modal Tab Content Start-->
                                <div class="tab-content product-large-image-list" id="myTabContent">
                                    <div class="tab-pane fade show active" id="single-slide1" role="tabpanel"
                                        aria-labelledby="single-slide-tab-1">
                                        <!--Single Product Image Start-->
                                        <div class="single-product-img img-full">
                                            <img src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$product->image}}&h=350&w=350"
                                                class="img-fluid" alt="" onerror="this.onerror=null;this.src='{{URL::to('/')}}/images/{{$setting->default_product}}';">
                                        </div>
                                        <!--Single Product Image End-->
                                    </div>
                                </div>
                                <!--Modal Content End-->
                            </div>
                            <!-- end of product quickview image gallery -->
                        </div>
                        <div class="col-lg-7 col-md-6 col-xs-12">
                            <!-- product quick view description -->
                            <div class="product-feature-details">
                                <h2 class="product-title mb-15">{{$product->product_name_dch}}</h2>

                                <h2 class="product-price mb-15">

                                    @guest
                        @if($setting->hide_rate==1&&$setting->hide_rate_guest==1)
                        <span class="discounted-price">
                        @if($product->sell_product_option=="weight_wise")
                        €{{number_format((float)$product->price_weight*1000, 2, ',', '')}}/kg
                        @elseif($product->sell_product_option=="per_unit")
                        €{{number_format((float)$product->price_per_unit, 2, ',', '')}}/ stuk
                        @else
                        €{{number_format((float)$product->price_per_person, 2, ',', '')}}/ p.p.

                        @endif
                    </span>
                        @endif
                    @else
                        @if($setting->hide_rate==1)
                        <span class="discounted-price">
                        @if($product->sell_product_option=="weight_wise")
                        €{{number_format((float)$product->price_weight*1000, 2, ',', '')}}/kg
                        @elseif($product->sell_product_option=="per_unit")
                        €{{number_format((float)$product->price_per_unit, 2, ',', '')}}/ stuk
                        @else
                        €{{number_format((float)$product->price_per_person, 2, ',', '')}}/ p.p.

                        @endif
                    </span>
                        @endif
                    @endguest

                                </h2>

                                <p class="product-description mb-20">{{$product->product_description_dch}}</p>


                                <div class="cart-buttons mb-20">
                                    <div class="pro-qty mr-10">
                                        <input type="text" value="{{$product->sell_product_option=="weight_wise"?100:1}}"> @if($product->sell_product_option=="weight_wise")
                                        <select name="sort-by" class="nice-select">
                                            <option value="GR">gr</option>
                                            <option value="KG">kg</option>
                                        </select> @elseif($product->sell_product_option=="per_unit")
                                        <select style="display:none" name="sort-by" class="nice-select">
                                            <option value="Unit">stuk</option>

                                        </select> @else
                                        <select style="display:none" name="sort-by" class="nice-select">
                                            <option value="Person">p.p.</option>
                                        </select> @endif
                                    </div>
                                    <div class="add-to-cart-btn">
                                        <a href="javascript:void(0)" onclick="addToCartModal(this,{{$product->fid}})"><i
                                                class="fa fa-shopping-cart"></i> {{ __('f.addToCart') }}</a>
                                    </div>
                                </div>


                                {{-- <div class="social-share-buttons">
                                    <h3>share this product</h3>
                                    <ul>
                                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
                                    </ul>
                                </div> --}}
                            </div>
                            <!-- end of product quick view description -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--=====  End of Quick view modal  ======-->
    @endforeach
</div>
@if ($products->lastPage() > 1)
<div class="pagination-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--=======  pagination-content  =======-->

                <div class="pagination-content text-center">
                    <?php
// config
$link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)

?>

                    
                    <ul>
                        <li class="{{ ($products->currentPage() == 1) ? ' disabled' : '' }}">
                            <a onclick="paginate(1)" href="#val"><i class="fa fa-angle-left"></i></a>
                        </li>
                        @for ($i = 1; $i
                        <=$products->lastPage(); $i++)
                            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $products->currentPage() - $half_total_links;
            $to = $products->currentPage() + $half_total_links;
            if ($products->currentPage() < $half_total_links) {
               $to += $half_total_links - $products->currentPage();
            }
            if ($products->lastPage() - $products->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($products->lastPage() - $products->currentPage()) - 1;
            }
            ?>
                            @if ($from
                            < $i && $i < $to) <li>
                                <a class="{{ $products->currentPage() == $i ? ' active' : '' }}" href="#val"
                                    onclick="paginate({{$i}})">{{ $i }}</a>
                                </li>
                                @endif @endfor
                                <li
                                    class="{{ ($products->currentPage() == $products->lastPage()) ? ' disabled' : '' }}">
                                    <a onclick="paginate({{$products->lastPage()}})" href="#val"><i
                                            class="fa fa-angle-right"></i></a>
                                </li>
                    </ul>
                    
                </div>

                <!--=======  End of pagination-content  =======-->
            </div>
        </div>
    </div>
</div>
@endif
<script>
    document.getElementById("result").innerHTML = "{{ __('f.showing_results') }} {{$n}} {{__('f.of')}} {{$products->total()}}";
    addToWishList = (id) => {
        $.ajax({
            url: "{{URL::to('add-wishlist')}}/" + id,
            success: function (result) {
toastr.success('Successfully added to Wishlist')
            }
        });
    }
    addToCart = (el, id) => {
        let quantity = el.parentNode.parentNode.parentNode.children[3].children[0].children[0].value;
        let weight = el.parentNode.parentNode.parentNode.children[3].children[1].value;
        let msg = " ";
        $.ajax({
            url: `{{URL::to('add-to-cart')}}?quantity=${quantity}&id=${id}&weight=${weight}&msg=${msg}`,
            success: function (result) {
                updateCartHeader();
                toastr.success('Successfully added to cart')
            }
        });
    }
    addToCartModal = (el, id) => {
        let quantity = el.parentNode.parentNode.parentNode.children[3].children[0].children[0].value;
        let weight = el.parentNode.parentNode.parentNode.children[3].children[1].value;
        let msg = " ";
        $.ajax({
            url: `{{URL::to('add-to-cart')}}?quantity=${quantity}&id=${id}&weight=${weight}&msg=${msg}`,
            success: function (result) {
                updateCartHeader();
                toastr.success('Successfully added to cart')

            }
        });
    }
    addToCartQuick = (id, quantity, weight) => {

        let msg = " ";
        $.ajax({
            url: `{{URL::to('add-to-cart')}}?quantity=${quantity}&id=${id}&weight=${weight}&msg=${msg}`,
            success: function (result) {
                updateCartHeader();
                toastr.success('Successfully added to cart')

            }
        });
    }
</script>
