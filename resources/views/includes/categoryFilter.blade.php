                      @foreach($categories as $category)
						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
								<!--=======  Grid view product  =======-->

								<div class="gf-product shop-grid-view-product mb-30">
									<div class="image">
										<a href="{{route('category',$category->name)}}">
											<img src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$category->image}}&h=350&w=350" class="img-fluid" alt="" onerror="this.onerror=null;this.src='{{URL::to('/')}}/images/{{$setting->default_product}}';">
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
<script>
document.getElementById("result").innerHTML="Showing  result{{__('f.showing_results')}} {{$categories->count()}}";
</script>
