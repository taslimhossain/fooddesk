@extends('layouts.front') @section('content')
    <div class="breadcrumb-area ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
						<li><a href="{{route('home')}}"><i class="fa fa-home"></i> {{ __('f.home') }}</a></li>
                            <li class="active" ><a href="{{route('wishlist')}}">{{ __('f.wishlist') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<!--=====  End of breadcrumb area  ======-->

    <!--=============================================
    =            Wishlist page content         =
    =============================================-->


    <div class="page-section section mb-50">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<form action="#">
							<!--=======  cart table  =======-->

							<div class="cart-table table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th class="pro-thumbnail">
                                            {{ __('f.product') }}</th>

											<th class="pro-remove">{{ __('f.remove') }}</th>
										</tr>
									</thead>
									<tbody>
                                    @foreach($products as $product)
										<tr>
											<td class="pro-thumbnail"><a href="{{URL::to('/product')}}/{{$product->product_name_dch}}"><img src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$product->image}}&h=350&w=350" class="img-fluid" class="img-fluid" alt="Product"></a>
                                            <a href="{{URL::to('/product')}}/{{$product->product_name_dch}}">{{$product->product_name_dch}}</a>
                                            </td>

											<td class="pro-remove"><a style="display:inline-block" class="btn btn-danger "href="javascript:void(0)" onclick="removeFromWishList({{$product->fid}},this)"><i style="color:#fff" class="fa fa-trash-o"></i></a></td>
										</tr>
                                    @endforeach
									</tbody>
								</table>
							</div>

							<!--=======  End of cart table  =======-->

						</form>
					</div>
				</div>
			</div>
		</div>
@endsection
<script>
removeFromWishList=(id,el)=>{
    $.ajax({
            url: "{{URL::to('remove-wishlist')}}/"+id,
            success: function(result) {
                el.parentElement.parentElement.remove();
            }
        });
}
</script>


