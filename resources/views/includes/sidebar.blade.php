            <style>
                li.active>a{
                    color:#a2a20c !important
                }
            </style>
            <div class="col-lg-3 order-2 order-lg-1">
                <!--=======  sidebar area  =======-->

                <div class="sidebar-area">
                    <!--=======  single sidebar  =======-->

                    {{--  <div class="sidebar mb-35">
                        <h3 class="sidebar-title">Exclude products</h3>
                        <ul class="product-categories">
                            <li><a class="active" href="shop-left-sidebar.html">Milk</a></li>
                            <li><a class="active" href="shop-left-sidebar.html">Soja</a></li>
                        </ul>
                    </div>  --}}

                    <div class="sidebar mb-35">
                        <h3 class="sidebar-title">{{ __('f.productCategories') }}</h3>
                        <ul class="product-categories">
                            @foreach($categories->where('status','=',true) as $ctg)
                            @if($ctg->subCategories->count() != 0&&$ctg->products->where('status','=',1)->count()!=0)
                            <li
                            @if(isset($category))
                                @if($category->id==$ctg->id)
                                    class="active" style="color:#a2a20c"
                                @endif
                            @endif

                             @if(isset($subcategory))
                                @if($subcategory->category_id==$ctg->fid)
                                    class="active" style="color:#a2a20c"
                                @endif
                            @endif
                            ><a href="{{route('category',$ctg->name)}}">{{$ctg->name}}({{$ctg->products->where('status','=',1)->count()}})</a>

                            @if($ctg->subCategories->count()>0)
                                <a href="javascript::void()" style="width:10px"   data-toggle="collapse" data-target="#collapse{{$ctg->id}}" aria-expanded="true" aria-controls="collapse{{$ctg->id}}"  >
                                <i class="fa fa-arrow-right
                                 @if(isset($subcategory))
                                @if($subcategory->category_id==$ctg->fid)
                                    fa-arrow-down
                                @endif
                            @endif
                                " onclick="collapse(this)"></i>
                                </a>
                                <div id="collapse{{$ctg->id}}" class="collapse
                                @if(isset($subcategory))
                                @if($subcategory->category_id==$ctg->fid)
                                    show
                                @endif
                            @endif
                                " aria-labelledby="headingOne" >
                                   <ul class="product-categories">
                                    @foreach($ctg->subCategories as $subcat)
                                    @if($subcat->products->where('status','=',1)->count()>0)
                                    <li
                                    @if(isset($subcategory))
                                @if($subcategory->id==$subcat->id)
                                    class="active"
                                @endif
                            @endif
                                    ><a href="{{route('subcategory',$subcat->name)}}">{{$subcat->name}}({{$subcat->products->where('status','=',1)->count()}})
                                    </a></li>
                                    @endif
                                    @endforeach
                                   </ul>
                                </div>
                            @endif
                            </li>
                            @endif
                            @endforeach

                        </ul>
                    </div>

                </div>
                <script>
                     collapse=(el)=>{
                         console.log(el)
                        if(el.classList[1]=='fa-arrow-right'){
                        el.classList="fa fa-arrow-down";
                        }
                        else{
                            el.classList="fa fa-arrow-right";
                        }
                    }
                </script>
                <!--=======  End of sidebar area  =======-->
            </div>
