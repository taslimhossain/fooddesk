@extends('layouts.front') @section('content')
<!--=============================================
    =            breadcrumb area         =
    =============================================-->

<div class="breadcrumb-area ">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb-container">
                    <ul>
                        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> {{ __('f.home') }}</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--=====  End of breadcrumb area  ======-->


<!--=============================================
	=            Shop page container         =
	=============================================-->

<div class="shop-page-container mb-50">
    <div class="container">
        <div class="row">
            @include('includes.sidebar')
            <div class="col-lg-9 order-1 order-lg-2 mb-sm-35 mb-xs-35">

                <!--=======  shop page banner  =======-->

                <div class="shop-page-banner mb-35">


                <div class="slider-container">
                <div class="hero-slider-two">
                            <!--=======  hero slider item  =======-->

                            @if($setting->banner)
                            <div class="hero-slider-item">

                                <img src="{{URL::to('/')}}/images/{{$setting->banner}}" class="img-fluid" alt="">

                        </div>
                            @endif
                            @if($setting->banner2)
                            <!--=======  End of hero slider item  =======-->
                                <div class="hero-slider-item">

                                    <img src="{{URL::to('/')}}/images/{{$setting->banner2}}" class="img-fluid" alt="">

                                </div>
                                @endif
                                @if($setting->banner3)
                                <div class="hero-slider-item">

                                    <img src="{{URL::to('/')}}/images/{{$setting->banner3}}" class="img-fluid" alt="">

                            </div>
                            @endif
                            @if($setting->banner4)
                            <div class="hero-slider-item">

                                <img src="{{URL::to('/')}}/images/{{$setting->banner4}}" class="img-fluid" alt="">

                        </div>
                        @endif
                         @if($setting->banner5)
                            <div class="hero-slider-item">
                                <img src="{{URL::to('/')}}/images/{{$setting->banner5}}" class="img-fluid" alt="">
                        </div>
                        @endif
                            <!--=======  Hero slider item  =======-->



                            <!--=======  End of Hero slider item  =======-->

                        </div>

                        <!--=======  End of Slider area  =======-->
                        </div>
                </div>

                <!--=======  End of shop page banner  =======-->

                <!--=======  Shop header  =======-->

                <div class="shop-header mb-35">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 d-flex align-items-center">
                            <!--=======  view mode  =======-->

                            <div class="view-mode-icons mb-xs-10">
                                <a class="active" href="#" data-target="grid"><i class="fa fa-th"></i></a>
                                <a href="#" data-target="list"><i class="fa fa-list"></i></a>
                            </div>

                            <!--=======  End of view mode  =======-->

                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 d-flex flex-column flex-sm-row justify-content-between align-items-left align-items-sm-center">
                            <!--=======  Sort by dropdown  =======-->

                            <div class="sort-by-dropdown d-flex align-items-center mb-xs-10">
                                <p class="mr-10">{{ __('f.seach_by') }}: </p>
                                <select name="sort-by" id="sort-by" class="nice-select">
                                    <option value="product_name_dch">{{ __('f.name') }}</option>
                                    <option value="fid">ID</option>
                                </select>
                                <input id="val" type="text" placeholder="" onkeyup="filterCategory(this.value)">
                            </div>



                            <!--=======  End of Sort by dropdown  =======-->

                            <p class="result-show-message" id="result"></p>
                        </div>
                    </div>
                </div>

                <!--=======  End of Shop header  =======-->

                <!--=======  Grid list view  =======-->



                <div id="categoryContainer">
                    <div class="shop-product-wrap grid row mb-35">
                        @foreach($categories as $category)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                            <!--=======  Grid view product  =======-->

                            <div class="gf-product shop-grid-view-product mb-30">
                                <div class="image">
                                    <a href="{{route('category',$category->name)}}">
                                        <img src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$category->image}}&h=350&w=350"
                                            class="img-fluid" alt="" onerror="this.onerror=null;this.src='{{URL::to('/')}}/images/{{$setting->default_product}}';">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3 class="product-title"><a href="{{route('category',$category->name)}}">{{$category->name}}</a></h3>
                                </div>

                            </div>

                            <div class="gf-product shop-list-view-product">
                                <div class="cart-table table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="pro-thumbnail"><a href="{{route('category',$category->name)}}"><img src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$category->image}}&h=350&w=350" class="img-fluid" alt="Product" onerror="this.onerror=null;this.src='{{URL::to('/')}}/images/{{$setting->default_product}}';"></a></td>
                                                <td class="pro-title"><a href="{{route('category',$category->name)}}">{{$category->name}}</a></td>

                                                <td class="pro-remove">

                                                    <div class="list-product-icons">
                                                        <a href="{{route('category',$category->name)}}" data-tooltip="View"> <i class="fa fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>

                </div>

                <!--=======  End of Grid list view  =======-->



            </div>
        </div>
    </div>
</div>

<!--=====  End of Shop page container  ======-->
@endsection @section('script')
<script>
    function filterCategory(val) {
        let mode="grid";
        if(viewMode){
            mode=viewMode;
        }
        $("#categoryContainer").html(` <div class="spinner-grow text-muted"></div>
  <div class="spinner-grow text-primary"></div>
  <div class="spinner-grow text-success"></div>
  <div class="spinner-grow text-info"></div>
  <div class="spinner-grow text-warning"></div>
  <div class="spinner-grow text-danger"></div>
  <div class="spinner-grow text-secondary"></div>
  <div class="spinner-grow text-dark"></div>
  <div class="spinner-grow text-light"></div>`)
        $.ajax({
            url: `{{URL::to('filter-product')}}?mode=${mode}&subcat=0&val=${val}&key=${$("#sort-by").val()}`,
            success: function(result) {
                $("#categoryContainer").html(result);
            }
        });
    }

    function paginate(val) {
        let mode="grid";
        if(viewMode){
            mode=viewMode;
        }
        $("#categoryContainer").html(` <div class="spinner-grow text-muted"></div>
  <div class="spinner-grow text-primary"></div>
  <div class="spinner-grow text-success"></div>
  <div class="spinner-grow text-info"></div>
  <div class="spinner-grow text-warning"></div>
  <div class="spinner-grow text-danger"></div>
  <div class="spinner-grow text-secondary"></div>
  <div class="spinner-grow text-dark"></div>
  <div class="spinner-grow text-light"></div>`)
        $.ajax({
            url: `{{URL::to('filter-product')}}?mode=${mode}&subcat=0&page=${val}&val=${$("#val").val()}&key=${$("#sort-by").val()}`,
            success: function(result) {
                $("#categoryContainer").html(result);
            }
        });
    }
</script>
@endsection
