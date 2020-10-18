                      @foreach($subCategories as $subCategory)
						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
								<!--=======  Grid view product  =======-->

								<div class="gf-product shop-grid-view-product mb-30">
									<div class="image">
										<a href="{{route('subcategory',$subCategory->name)}}">
											<img src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$subCategory->image}}&h=350&w=350" class="img-fluid" alt="" onerror="this.onerror=null;this.src='{{URL::to('/')}}/images/{{$setting->default_product}}';">
										</a>
									</div>
									<div class="product-content">
										<h3 class="product-title"><a href="{{route('subcategory',$subCategory->name)}}">{{$subCategory->name}}</a></h3>
									</div>

								</div>

								<div class="gf-product shop-list-view-product">
			                        <div class="cart-table table-responsive">
			                            <table class="table">
			                                <tbody>
			                                    <tr>
			                                        <td class="pro-thumbnail"><a href="{{route('subcategory',$subCategory->name)}}"><img src="https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src={{$subCategory->image}}&h=350&w=350" class="img-fluid" alt="Product" onerror="this.onerror=null;this.src='{{URL::to('/')}}/images/{{$setting->default_product}}';"></a></td>
			                                        <td class="pro-title"><a href="{{route('subcategory',$subCategory->name)}}">{{$subCategory->name}}</a></td>
			                                        <td class="pro-remove">

														<div class="list-product-icons">
														<a href="{{route('subcategory',$subCategory->name)}}" data-tooltip="View"> <i class="fa fa-eye"></i></a>
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
document.getElementById("result").innerHTML="Showing  results {{$subCategories->count()}}";
</script>
