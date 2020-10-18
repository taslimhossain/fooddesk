<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$setting->site_name}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield("meta")
    <!-- Favicon -->
    <link rel="icon" href="{{URL::to('/')}}/images/{{$setting->fav_icon}}">
    <!-- CSS
	============================================ -->
    <!-- Bootstrap CSS -->
    <link href="{{URL::to('/')}}/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome CSS -->
    <link href="{{URL::to('/')}}/assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- Elegent CSS -->
    <link href="{{URL::to('/')}}/assets/css/elegent.min.css" rel="stylesheet">

    <!-- Plugins CSS -->
    <link href="{{URL::to('/')}}/assets/css/plugins.css" rel="stylesheet">

    <!-- Helper CSS -->
    <link href="{{URL::to('/')}}/assets/css/helper.css" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{URL::to('/')}}/assets/css/main.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('/')}}admin/plugins/select2/css/select2.min.css">
    <!-- Modernizer JS -->
    <script src="{{URL::to('/')}}/assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/toastr/toastr.min.css">
    <style>
        input[type="date"]::-webkit-datetime-edit, input[type="date"]::-webkit-inner-spin-button, input[type="date"]::-webkit-clear-button {
      color: #fff;
      position: relative;
    }

    input[type="date"]::-webkit-datetime-edit-year-field{
      position: absolute !important;
      border-left:1px solid #8c8c8c;
      padding: 2px;
      color:#000;
      left: 56px;
    }

    input[type="date"]::-webkit-datetime-edit-month-field{
      position: absolute !important;
      border-left:1px solid #8c8c8c;
      padding: 2px;
      color:#000;
      left: 26px;
    }


    input[type="date"]::-webkit-datetime-edit-day-field{
      position: absolute !important;
      color:#000;
      padding: 2px;
      left: 4px;

    }
    </style>
    <style>
.sidebar-area .sidebar ul.product-categories li a {
    display: inline;
}
.sidebar-area .sidebar ul.product-categories li a i {
    margin-left: 10px;
}

div#productContainer {
    text-align: center;
    margin-top: 50px;
}

    {!!$setting->css!!}
    </style>
    @yield("style")
</head>

<body>
    <!--=============================================
	=            Header         =
	=============================================-->

    <header>
        <!--=======  header bottom  =======-->

        <div class="header-bottom header-bottom-one header-sticky">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12 text-lg-left text-md-center text-sm-center">
                        <!-- logo -->
                        <div class="logo mt-15 mb-15">
                            <a href="{{URL::to('/')}}">
                                <img src="{{URL::to('/')}}/images/{{$setting->logo}}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <!-- end of logo -->
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="menubar-top d-flex justify-content-between align-items-center flex-sm-wrap flex-md-wrap flex-lg-nowrap mt-sm-15">
                            <!-- header phone number -->
                            <div class="header-contact d-flex">
                            </div>
                            <!-- end of header phone number -->

                            <!-- shopping cart -->
                            <div class="shopping-cart" id="shopping-cart">

                            </div>
                        </div>

                        <!-- navigation section -->
                        <div class="main-menu">
                            <form id="mylogout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <nav>
                                <ul>
                                    <li><a href="{{URL::to('/')}}">{{__('f.home')}}</a></li>
                                    <li><a href="{{route('myAccount')}}">{{ __('f.my_account') }}</a></li>
                                    @if($setting->wishList)
                                    <li><a href="{{route('wishlist')}}">{{ __('f.wishlist') }}</a></li>
                                    @endif
                                    <li><a href="{{route('checkout')}}">{{ __('f.checkout') }}</a></li>
                                    <li><a href="#">{{ __('f.contact') }}</a></li>
                                    @if(auth()->check())
                                        <li><a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('mylogout-form').submit();">{{ __('f.logout') }}</a></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        <!-- end of navigation section -->
                    </div>
                    <div class="col-12">
                        <!-- Mobile Menu -->
                        <div class="mobile-menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--=======  End of header bottom  =======-->
    </header>

    <!--=====  End of Header  ======-->
    @if($setting->show_notice==1)
        <p style="text-align:center">
        {!!$setting->homepage_notice!!}
        </p>
    @endif
    @yield('content')



    <!--=============================================
	=            Footer         =
	=============================================-->

    <footer>
        <!--=======  newsletter section  =======-->
@if($setting->hide_news==1)
        <div class="newsletter-section pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 mb-sm-20 mb-xs-20">
                        <!--=======  newsletter title =======-->

                        <div class="newsletter-title">
                            <h1>
                                <img src="{{URL::to('/')}}/assets/images/icon-newsletter.png" alt=""> Send Newsletter
                            </h1>
                        </div>

                        <!--=======  End of newsletter title  =======-->
                    </div>

                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <!--=======  subscription-form wrapper  =======-->

                        <div class="subscription-form-wrapper d-flex flex-wrap flex-sm-nowrap">
                            <p class="mb-xs-20">Sign up for our newsletter to get up-to-date from us</p>
                            <div class="subscription-form">
                                <form id="mc-form" class="mc-form subscribe-form">
                                    <input type="email" id="mc-email" autocomplete="off" placeholder="Your email address">
                                    <button id="mc-submit" type="submit"> subscribe!</button>
                                </form>

                                <!-- mailchimp-alerts Start -->
                                <div class="mailchimp-alerts">
                                    <div class="mailchimp-submitting"></div>
                                    <!-- mailchimp-submitting end -->
                                    <div class="mailchimp-success"></div>
                                    <!-- mailchimp-success end -->
                                    <div class="mailchimp-error"></div>
                                    <!-- mailchimp-error end -->
                                </div>
                                <!-- mailchimp-alerts end -->
                            </div>
                        </div>

                        <!--=======  End of subscription-form wrapper  =======-->
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!--=======  End of newsletter section  =======-->

        <!--=======  social contact section  =======-->

        <div class="social-contact-section pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 order-1 mb-sm-50 mb-xs-50">
                        <!--=======  contact summery  =======-->

                        <div class="contact-summery">
                            <h2>{{__('f.contact_us')}}</h2>

                            <!--=======  contact segments  =======-->

                            <div class="contact-segments d-flex justify-content-between flex-wrap flex-lg-nowrap">
                                <!--=======  single contact  =======-->

                                <div class="single-contact d-flex mb-xs-20">
                                    <div class="icon">
                                        <span class="icon_pin_alt"></span>
                                    </div>
                                    <div class="contact-info">
                                    <p>{{__('f.address')}}: <span>{{$setting->contact_address}}</span></p>
                                    </div>
                                </div>

                                <!--=======  End of single contact  =======-->
                                <!--=======  single contact  =======-->

                                <div class="single-contact d-flex mb-xs-20">
                                    <div class="icon">
                                        <span class="icon_mobile"></span>
                                    </div>
                                    <div class="contact-info">
                                        <p>{{__('f.phone')}}: <span>{{$setting->contact_phone}}</span></p>
                                    </div>
                                </div>

                                <!--=======  End of single contact  =======-->
                                <!--=======  single contact  =======-->

                                <div class="single-contact d-flex">
                                    <div class="icon">
                                        <span class="icon_mail_alt"></span>
                                    </div>
                                    <div class="contact-info">
                                        <p>{{__('f.email')}}: <span>{{$setting->contact_email}}</span></p>
                                    </div>
                                </div>

                                <!--=======  End of single contact  =======-->
                            </div>

                            <!--=======  End of contact segments  =======-->



                        </div>

                        <!--=======  End of contact summery  =======-->

                    </div>

                </div>
            </div>
        </div>

        <!--=======  End of social contact section  =======-->

        <!--=======  copyright section  =======-->

        <div class="copyright-section pt-35 pb-35">
            <div class="container">
                <div class="row align-items-md-center align-items-sm-center">
                    {!!$setting->copyright!!}
                </div>
            </div>
        </div>

        <!--=======  End of copyright section  =======-->
    </footer>

    <!--=====  End of Footer  ======-->



    <!-- scroll to top  -->
    <a href="#" class="scroll-top"></a>
    <!-- end of scroll to top -->

    <!-- JS
	============================================ -->
    <!-- jQuery JS -->
    <script src="{{URL::to('/')}}/assets/js/vendor/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="{{URL::to('/')}}/assets/js/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="{{URL::to('/')}}/assets/js/bootstrap.min.js"></script>

    <!-- Plugins JS -->
    <script src="{{URL::to('/')}}/assets/js/plugins.js"></script>

    <!-- Main JS -->
    <script src="{{URL::to('/')}}/assets/js/main.js"></script>
    <script src="{{asset('/')}}/admin/plugins/toastr/toastr.min.js"></script>
    <script src="{{asset('/')}}/admin/plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
    viewMode=null;
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            @if(Session::has('error'))

            toastr.error("{{Session::get('error')}}");
            @endif
        })
         @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
        @endif
        $.ajax({
            url: `{{URL::to('get-cart')}}`,
            success: function(result) {
                $("#shopping-cart").html(result);
            }
        })
        updateCartHeader = () => {
            $.ajax({
                url: `{{URL::to('get-cart')}}`,
                success: function(result) {
                    $("#shopping-cart").html(result);
                }
            })
        }
        removeCartGlobal = (id) => {
            $.ajax({
                url: `{{URL::to('remove-cart')}}?id=${id}`,
                success: function(result) {
                    toastr.warning('Item removed from cart')
                    $.ajax({
                        url: `{{URL::to('get-cart')}}`,
                        success: function(result) {
                            $("#shopping-cart").html(result);
                        }
                    })

                }
            });
        }
    </script>
    @yield("script")
</body>

</html>
