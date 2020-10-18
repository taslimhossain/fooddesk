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
                        <li  class="active"><a href="{{route('category',$subcategory->name)}}">{{$subcategory->name}}</a></li>
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
                    <a href="shop-left-sidebar.html">
                        <img src="{{URL::to('/')}}/images/{{$setting->banner}}" class="img-fluid" alt="">
                    </a>
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
                                <input id="val" type="text" placeholder="" onkeyup="filterProduct(this.value)">
								</div>



								<!--=======  End of Sort by dropdown  =======-->

								<p class="result-show-message" id="result"></p>
							</div>
						</div>
					</div>

					<!--=======  End of Shop header  =======-->

					<!--=======  Grid list view  =======-->



                    <div id="productContainer">

                    </div>




					<!--=======  End of Grid list view  =======-->



				</div>
			</div>
		</div>
	</div>

	<!--=====  End of Shop page container  ======-->
@endsection


@section('script')
    <script>
        function filterProduct(val){
            let mode="grid";
        if(viewMode){
            mode=viewMode;
        }
         $("#productContainer").html(` <div class="spinner-grow text-muted"></div>
  <div class="spinner-grow text-primary"></div>
  <div class="spinner-grow text-success"></div>
  <div class="spinner-grow text-info"></div>
  <div class="spinner-grow text-warning"></div>
  <div class="spinner-grow text-danger"></div>
  <div class="spinner-grow text-secondary"></div>
  <div class="spinner-grow text-dark"></div>
  <div class="spinner-grow text-light"></div>`)
              $.ajax({url: `{{URL::to('filter-product')}}?mode=${mode}&subcat={{$subcategory->fid}}&val=${val}&key=${$("#sort-by").val()}`, success: function(result){
                $("#productContainer").html(result);
              }});
        }
    function paginate(val) {
let mode="grid";
        if(viewMode){
            mode=viewMode;
        }
          $("#productContainer").html(` <div class="spinner-grow text-muted"></div>
  <div class="spinner-grow text-primary"></div>
  <div class="spinner-grow text-success"></div>
  <div class="spinner-grow text-info"></div>
  <div class="spinner-grow text-warning"></div>
  <div class="spinner-grow text-danger"></div>
  <div class="spinner-grow text-secondary"></div>
  <div class="spinner-grow text-dark"></div>
  <div class="spinner-grow text-light"></div>`)
        $.ajax({
            url: `{{URL::to('filter-product')}}?mode=${mode}&subcat={{$subcategory->fid}}&page=${val}&val=${$("#val").val()}&key=${$("#sort-by").val()}`,
            success: function(result) {
                $("#productContainer").html(result);
            }
        });
    }
        $( document ).ready(function(){
            filterProduct("");
        })
    </script>
@endsection
