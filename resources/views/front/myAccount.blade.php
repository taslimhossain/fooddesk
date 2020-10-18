@extends('layouts.front') @section('content')


<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb-container">
                    <ul>
                        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> {{ __('f.home') }}</a></li>
                        <li class="active" ><a href="{{route('myAccount')}}">{{ __('f.myAccount') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--=====  End of breadcrumb area  ======-->

<!--=============================================
	=            My account page section         =
	=============================================-->

<div class="my-account-section section position-relative mb-50 fix">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="row">

                    <!-- My Account Tab Menu Start -->
                    <div class="col-lg-3 col-12">
                        <div class="myaccount-tab-menu nav" role="tablist">
                            <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                {{ __('f.dashboard') }}</a>

                            <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> {{ __('f.orders') }}</a>

                            <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> {{ __('f.address') }}</a>

                            <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{ __('m.logout') }}</a>
                        </div>
                    </div>
                    <!-- My Account Tab Menu End -->

                    <!-- My Account Tab Content Start -->
                    <div class="col-lg-9 col-12">
                        <div class="tab-content" id="myaccountContent">
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>{{ __('f.dashboard') }}</h3>

                                    <div class="welcome">
                                        <p>Hello, <strong>{{$user->firstname." ".$user->lastname}}</strong> (If Not
                                            <strong>{{$user->firstname." ".$user->lastname}} !</strong><a class="logout" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> {{ __('m.logout') }}</a>)</p>
                                    </div>

                                    <p class="mb-0">From your account dashboard. you can easily check &amp; view your
                                        recent orders, manage your shipping and billing addresses and edit your password
                                        and account details.</p>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="orders" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>{{ __('f.orders') }}</h3>

                                    <div class="myaccount-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>{{ __('f.orderId') }}</th>
                                                    <th>{{ __('f.date') }}</th>
                                                    <th>{{ __('f.status') }}</th>
                                                    <th>{{ __('f.total') }}</th>
                                                    <th>{{ __('f.action') }}</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            @foreach($user->orders as $order)
                                                <tr>
                                                    <td>#{{$order->id}}</td>
                                                    <td>{{$order->created_at->format('M d/y')}}</td>
                                                    <td>Pending</td>
                                                    <td>€{{number_format((float)$order->total, 2, ',', '')}}</td>
                                                    <td><a href="{{route('myOrder',$order->id)}}" class="btn">{{ __('f.view') }}</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>{{ __('f.billingAddress') }}</h3>
                    <form autocomplete="on" action="{{route('updateAddress')}}" method="POST">
                                            @csrf
                                    <address>
                                        <p><strong>{{$user->firstname." ".$user->lastname}}</strong></p>
                                        <p><input placeholder="Address 1" name="address1" required value="{{$user->address1}}" class="form-control"> <br>
                                        <input placeholder="Address 2" name="address2" required value="{{$user->address2}}" class="form-control">
                                            </p>
                                        <p>
                                        <input placeholder="Town" name="town" required value="{{$user->town}}" class="form-control">
                                        </p>
                                        <p>
                                        <input placeholder="Zip" name="zip" required value="{{$user->zip}}" class="form-control">

                                        </p>
                                    </address>
                                    <button  class="btn btn-primary"><i class="fa fa-edit"></i>{{ __('f.updateAddress') }}</button>
                                    </form>

                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="account-info" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>{{ __('f.accountDetails') }}</h3>

                                    <div class="account-details-form">
                                        <form autocomplete="on" action="{{route('updateProfile')}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <input name="firstname" id="first-name" placeholder="First Name"
                                                        value="{{$user->firstname}}" type="text">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <input name="lastname" value="{{$user->lastname}}" id="last-name"
                                                        placeholder="Last Name" type="text">
                                                </div>
                                                {{--
                                                <div class="col-12 mb-30">
                                                    <input id="display-name" placeholder="Display Name" type="text">
                                                </div> --}}

                                                <div class="col-12 mb-30">
                                                    <input name="email" value="{{$user->email}}" id="email" placeholder="Email Address" type="email">
                                                </div>
                                                <div class="col-12 mb-30">
                                                    <input name="confirm_mail" id="c_email" placeholder="Confirm Email Address" type="email">
                                                </div>

                                                <div class="col-12 mb-30">

                                                    <h4> {{ __('f.passwordChange') }}
                                                    </h4>
                                                </div>

                                                <div class="col-12 mb-30">
                                                    <input name="old_password" value="" autocomplete="off" placeholder="Current Password" type="password">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <input name="password" id="new-pwd" placeholder="New Password" type="password">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <input name="password_confirmation" id="confirm-pwd" placeholder="Confirm Password" type="password">
                                                </div>

                                                <div class="col-12">
                                                    <button class="save-change-btn">{{ __('f.saveChanges') }}</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->
                        </div>
                    </div>
                    <!-- My Account Tab Content End -->
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@section("script")
<script>
@foreach($errors->all() as $error)
                                toastr.error("{{$error}}")
                    @endforeach

</script>
@endsection
