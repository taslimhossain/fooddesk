<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  
        <span class="brand-text font-weight-light text-center" style="display: block;margin: 10px 0px;"><img src="{{URL::to('/')}}/shopdesk.png" alt="shopdesk"></span>
        <!-- <span class="brand-text font-weight-light">{{$setting->site_name}}</span> -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->firstname." ".auth()->user()->lastname}}</a>
            </div> 
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <!-- menu-open -->

                
                 <li class="nav-item has-treeview @if(Route::current()->getName() == 'products.index'||Route::current()->getName() == 'categories.index'||Route::current()->getName() == 'sub-categories.index')
                    menu-open
                    @endif">
                    <a href=" #" class="nav-link">
                        <i class=" nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('m.product') }} 
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview 
                    
                    "> 
                    {{--  <li class=" nav-item ">
                            <a href="{{ url('/sync-product') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('Sync Now')}}</p>
                            </a>
                        </li>  --}}
                        <li class=" nav-item ">
                            <a href="{{ url('/products') }}" class="nav-link 
                            @if(Route::current()->getName() == 'products.index')
                                active
                            @endif
                            " >
                                <i class="fas fa-chevron-right nav-icon"></i>
                                <p>{{ __('m.productList') }}</p>
                            </a>
                        </li>
                        <li class=" nav-item ">
                            <a href="{{ url('/categories') }}" class="nav-link
                            @if(Route::current()->getName() == 'categories.index')
                                active
                            @endif
                            " >
                                <i class="fas fa-chevron-right nav-icon"></i>
                                <p>{{ __('m.categoryList') }}</p>
                            </a>
                        </li>
                        <li class=" nav-item ">
                            <a href="{{ url('/sub-categories') }}" class="nav-link 
                            @if(Route::current()->getName() == 'sub-categories.index')
                                active
                            @endif
                            " id="">
                                <i class="fas fa-chevron-right nav-icon"></i>
                                <p>{{ __('m.subCategoryList') }}</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class=" nav-item ">
                            <a href="{{ url('/orders') }}" class="nav-link
                            @if(Route::current()->getName() == 'orderList')
                                active
                            @endif
                            ">
                                <i class="fas fa-shopping-cart nav-icon"></i>
                                <p>{{ __('m.orders') }}</p>
                            </a>
                        </li>

                <li class=" nav-item ">
                            <a href="{{ url('/users') }}" class="nav-link 
                            @if(Route::current()->getName() == 'userList')
                                active
                            @endif
                            ">
                                <i class="fas fa-users nav-icon"></i>
                                <p>{{ __('m.userList') }}</p>
                            </a>
                </li>
                
                @if(auth()->user()->type==1)

                <li class=" nav-item ">
                            <a href="{{ url('/admins') }}" class="nav-link
                            @if(Route::current()->getName() == 'adminList')
                                active
                            @endif
                            ">
                                <i class="fas fa-user nav-icon"></i>
                                <p>{{ __('m.adminList') }}</p>
                            </a>
                </li>
              
                @endif
                 <li class=" nav-item ">
                            <a href="{{ url('/settings') }}" class="nav-link 
                            @if(Route::current()->getName() == 'settings.index')
                                active
                            @endif
                            ">
                                <i class="fas fa-cogs nav-icon"></i>
                                <p>{{ __('m.websiteSetting') }}</p>
                            </a>
                </li>
                <li class=" nav-item ">
                    <a href="{{ url('/email-setting') }}" class="nav-link 
                    @if(Route::current()->getName() == 'email-setting')
                        active
                    @endif
                    ">
                        <i class="fas fa-cogs nav-icon"></i>
                        <p>{{ __('m.emailSetting') }}</p>
                    </a>
        </li>
               
                <li class=" nav-item " style="display:none;">
                    <a href="{{ url('/page') }}" class="nav-link 
                    @if(Route::current()->getName() == 'page.index')
                                active
                            @endif
                    ">
                    <i class="fas fa-file-alt nav-icon"></i>
                        <p>{{ __('m.pages') }}</p>
                    </a>
                </li>
                 <li class=" nav-item ">
                            <a href="{{ url('/order-setting') }}" class="nav-link 
                            @if(Route::current()->getName() == 'orderSetting')
                                active
                            @endif
                            ">
                                <i class="fas fa-cog nav-icon"></i>
                                <p>{{ __('m.orderSetting') }}</p>
                            </a>
                </li>
                  <li class=" nav-item ">
                            <a href="{{ url('/change-password') }}" class="nav-link
                            
                            @if(Route::current()->getName() == 'changePassword')
                                active
                            @endif
                            ">
                                <i class="fas fa-users-cog nva-icon"></i>
                                <p>{{ __('m.changePassword') }}</p>
                            </a>
                </li>
                <li class=" nav-item ">
                            <a href="{{ url('/change-email') }}" class="nav-link 
                            @if(Route::current()->getName() == 'changeEmail')
                                active
                            @endif
                            ">
                                <i class="fas fa-users-cog nva-icon"></i>
                                <p>{{ __('m.changeEmail') }}</p>
                            </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
