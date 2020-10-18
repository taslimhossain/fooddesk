@extends('layouts.front')
@section('style')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
    <style>
        .datepicker table tr td.disabled, .datepicker table tr td.disabled:hover {
            color: #d50909;
        }
    </style>
@endsection
@section('content')
<div class="breadcrumb-area ">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb-container">
                    <ul>
                        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> {{ __('f.home') }}</a></li>
                        <li class="active"><a href="{{route('checkout')}}">{{ __('f.checkout') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--=====  End of breadcrumb area  ======-->

<!--=============================================
	=            Checkout page content         =
	=============================================-->

<div class="page-section section mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Checkout Form s-->
                <form action="{{route('checkoutSubmit')}}" method="post" class="checkout-form">
                    @csrf
                    <div class="row row-40 mt-15">

                        <div class="col-lg-7">
                        @guest @else @if(auth()->user()->type!=0)
                            <div class="form-group">
                                <label>User</label>
                                <select onchange="userChange(this.value)" name="user_id" class="form-control select2" style="width: 100%;">
                                    <option value="0">Zoek uw klant</option>
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->firstname." ".$user->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif @endguest
                            <!-- Billing Address -->
                            <div id="billing-form" class="mb-40">
                                <h4 class="checkout-title">{{ __('f.billingAddress') }}</h4>

                                <div class="row">

                                    <div class="col-md-6 col-12">
                                        <input required value="{{auth()->check()?auth()->user()->firstname:""}}" name="firstname" type="text" placeholder="{{ __('f.firstName') }}">
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <input required value="{{auth()->check()?auth()->user()->lastname:""}}" name="lastname" type="text" placeholder="{{ __('f.lastName') }}">
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <input required value="{{auth()->check()?auth()->user()->email:" "}}" name="email" type="email" placeholder="{{ __('f.emailAddress') }}">
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <input required value="{{auth()->check()?auth()->user()->telephone:""}}" type="text" name="phone" placeholder="{{ __('f.phoneNumber') }}">
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <input type="text" name="company" placeholder="{{ __('f.companyName') }}">
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <input type="text" name="company_number" placeholder="{{ __('f.companyNumber') }}">
                                    </div>

                                    <div class="col-12">
                                        <input required value="{{auth()->check()?auth()->user()->address1:""}}" name="address1" type="text" placeholder="{{ __('f.addressLine') }} ">
                                        {{-- <input  value="{{auth()->check()?auth()->user()->address2:""}}" name="address2" type="text" placeholder="{{ __('f.addressLine') }} 2"> --}}
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <input required value="{{auth()->check()?auth()->user()->zip:""}}" name="zip" type="text" placeholder="{{ __('f.zip_code') }}">
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <input required value="{{auth()->check()?auth()->user()->town:""}}" name="town" type="text" placeholder="{{ __('f.town') }}/{{ __('f.city') }}">
                                    </div>
                                    <div class="col-12">
                                        @guest
                                        <div class="check-box">
                                            <input type="checkbox" name="create_account" id="create_account" onclick="createAccount(this.checked)">
                                            <label for="create_account">{{ __('f.createAnAccount') }}?</label>
                                            <input minlength="6" name="password" style="display:none" id="accountPassword" placeholder="{{ __('f.enterThePassword') }}" type="password" class="my-2 form-control" onkeyup="confirmCheck()">
                                            <input minlength="6"  name="c_password" style="display:none" id="cPassword" placeholder="Bevestig wachtwoord" type="password" class="my-2 form-control" onkeyup="confirmCheck()">
                                            <span style="display:none" id="pass_match" class="text text-danger">Password Doesn't Match</span>
                                        </div>
                                        <script>
                                            let confirmCheck=()=>{
                                                if(!document.getElementById("cPassword").value){
                                                    return;
                                                }
                                                if(document.getElementById("accountPassword").value!=document.getElementById("cPassword").value){

                                                    document.getElementById("placeOrder").setAttribute('disabled', true)
                                           document.getElementById("pass_match").style.display = "";
                                                }
                                                else{
                                                    document.getElementById("placeOrder").removeAttribute('disabled')
                                                    document.getElementById("pass_match").style.display = "none";
                                                }
                                            }
                                            let createAccount = (checked) => {
                                                if (checked) {
                                                    document.getElementById("accountPassword").style.display = "";
                                                    $("#accountPassword").prop('required', true);
                                                    document.getElementById("cPassword").style.display = "";
                                                    $("#cPassword").prop('required', true);
                                                    confirmCheck();
                                                } else {
                                                    document.getElementById("pass_match").style.display = "none";
                                                    document.getElementById("accountPassword").style.display = "none";
                                                    $("#accountPassword").prop('required', false);
                                                    document.getElementById("cPassword").style.display = "none";
                                                    $("#cPassword").prop('required', false);

                                                }

                                            }
                                        </script>
                                        @endguest
                                        <div class="check-box" style="display:none;">
                                            <input type="checkbox" name="shipping_different" onclick="shippingDifferent(this.checked)" id="shiping_address" data-shipping>
                                            <label for="shiping_address">{{ __('f.shipToDifferentAddress') }}</label>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!-- Shipping Address -->
                            <div id="shipping-form" class="mb-40">
                                <h4 class="checkout-title">Shipping Address</h4>

                                <div class="row">

                                    <div class="col-md-6 col-12">
                                        <input class="s_required" name="s_firstname" type="text" placeholder="{{ __('f.firstName') }}">
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <input class="s_required" name="s_lastname" type="text" placeholder="{{ __('f.lastName') }}">
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <input class="s_required" name="s_email" type="email" placeholder="{{ __('f.emailAddress') }}">
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <input class="s_required" name="s_phone" type="text" placeholder="{{ __('f.phoneNumber') }}">
                                    </div>

                                    <div class="col-12">
                                        <input  name="s_company" type="text" placeholder="{{ __('f.companyName') }}">
                                    </div>
                                    <div class="col-12">
                                        <input  name="s_company_number" type="text" placeholder="{{ __('f.companyNumber') }}">
                                    </div>

                                    <div class="col-12">
                                        <input class="s_required" name="s_address1" type="text" placeholder="{{ __('f.addressLine') }} 1">
                                        <input name="s_address2" type="text" placeholder="{{ __('f.addressLine') }} 2">
                                    </div>



                                    <div class="col-md-6 col-12">
                                        <input class="s_required" name="s_town" type="text" placeholder="{{ __('f.town') }}/{{ __('f.city') }}">
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <input class="s_required" name="s_zip" type="text" placeholder="{{ __('f.zipCode') }}">
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-5">
                            <div class="row">

                                <!-- Cart Total -->
                                <div class="col-12 mb-60">

                                    <h4 class="checkout-title">{{__('f.overzicht')}}</h4>

                                    <div class="checkout-cart-total">

                                        <h4>{{ __('f.product') }} <span>{{ __('f.total') }}</span></h4>

                                        <ul>
                                            @php($total=0) @foreach($cart as $item)
                                            <li>{{$item["product"]->product_name_dch}}
                                            (


                                            @if($item[ "product" ]->sell_product_option=="weight_wise") {{$item["quantity"]>999?($item["quantity"]/1000)." kg":$item["quantity"]." gr"}} @elseif($item["product"]->sell_product_option=="per_unit")
                                                {{$item["quantity"]}} stuk @else {{$item["quantity"]}} Person @endif
                                            x

                                            @if($item["product"]->sell_product_option=="weight_wise")

                                            €{{number_format((float)$item["product"]->price_weight*1000, 2, ',', '')}}kg

                                            @elseif($item["product"]->sell_product_option=="per_unit")

                                            €{{number_format((float)$item["product"]->price_per_unit, 2, ',', '')}}
                                            @else

                                            €{{number_format((float)$item["product"]->price_per_person, 2, ',', '')}}

                                            @endif





                                                )
                                                <span>@if($item["product"]->sell_product_option=="weight_wise")
                                                    @php($total+=$item["product"]->price_weight*$item["quantity"])
                                                    €{{number_format((float)$item["product"]->price_weight*$item["quantity"], 2, ',', '')}}
                                                    @elseif($item["product"]->sell_product_option=="per_unit")
                                                    @php($total+=$item["product"]->price_per_unit*$item["quantity"])
                                                    €{{number_format((float)$item["product"]->price_per_unit*$item["quantity"], 2, ',', '')}}
                                                    @else
                                                    @php($total+=$item["product"]->price_per_person*$item["quantity"])
                                                    €{{number_format((float)$item["product"]->price_per_person*$item["quantity"], 2, ',', '')}}

                                                    @endif</span></li>
                                            @endforeach
                                        </ul>

                                        <p>{{ __('f.subTotal') }}
                                            <span>€{{number_format((float)$total, 2, ',', '')}}</span></p>
                                        {{--
                                        <p>Tax <span>$00.00</span></p> --}}
                                        <input type="hidden" value="{{number_format((float)$total, 2, '.', '')}}" name="total">
                                        <h4>{{__('f.grand_total')}} <span>€{{number_format((float)$total, 2, ',', '')}}</span></h4>

                                    </div>

                                </div>

                                <!-- Payment Method -->
                                <div class="col-12">

                                    <h4 class="checkout-title">{{ __('f.deliveryDetails') }}</h4>

                                    <div class="checkout-payment-method">

                                        <div class="single-method">

                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <input id="pickupDate" autocomplete="false" onchange="dateChanged(this.value)" type="text" name="date" placeholder="{{ __('f.date') }}">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <input id="dayname" readonly name="dayname" type="text" placeholder="{{ __('f.dayName') }}">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <select onchange="hourChange(this.value)" id="hour" required name="hour" class="form-control">

                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <select id="minute" required name="minute" class="form-control">

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <textarea name="message" id="commentMessage" placeholder="{{ __('f.message') }}" style="width: 100%;padding: 10px 20px; margin-top: 15px;"></textarea>
                                                </div>
                                            </div>

                                        </div>
<!--
                                        <div class="single-method">
                                            <input type="checkbox" name="give_invoice" id="accept_terms">
                                            <label for="accept_terms">{{ __('f.giveMeInvoice') }}</label>
                                        </div> -->

                                    </div>

                                    <button id="placeOrder" class="place-order">{{ __('f.placeOrder') }}</button> @if(count($cart) == 0)
                                    <label class="text text-danger">Cart is empty</label> @endif

                                </div>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    let hourChange = (val) => {
        for (i = 0; i < times.length; i++) {

            if (parseInt(val) >= parseInt(times[i].from.split(":")[0]) && parseInt(val) <= parseInt(times[i].to.split(":")[0])) {
                time = times[i];
                break;
            }

        }

        document.getElementById("minute").innerHTML = "<option value='' disabled >{{__('f.select_minute')}}</option>";
        startHour = time.from.split(":")[0];
        endHour = time.to.split(":")[0];
        if (startHour === val) {
            for (i = parseInt(time.from.split(":")[1]); i < 60; i += 5) {
                document.getElementById("minute").innerHTML += `
                        <option value="${i<10?('0'+i):i}">${i<10?('0'+i):i}</option>`
            }
        } else if (endHour === val) {

            for (i = 0; i <= time.to.split(":")[1]; i += 5) {
                document.getElementById("minute").innerHTML += `
                        <option value="${i<10?('0'+i):i}">${i<10?('0'+i):i}</option>`
            }
        } else {
            for (i = 0; i < 60; i += 5) {
                document.getElementById("minute").innerHTML += `
                        <option value="${i<10?('0'+i):i}">${i<10?('0'+i):i}</option>`
            }
        }
    }
    let dateChanged = (val) => {
        var days = ['Zondag', 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag'];
        $.ajax({
            url: `{{URL::to('check-date')}}?date=${val}`,
            success: function(result) {
                if (result.err) {
                    document.getElementById("pickupDate").value = "";
                    toastr.error(result.err)
                    $("#dayname").val("")
                } else {
                    let hours = [];
                    window.times = result.success;
                    times.forEach(time => {
                        startHour = parseInt(time.from.split(":")[0]);
                        endHour = parseInt(time.to.split(":")[0]);
                        for (i = startHour; i <= endHour; i++) {
                            hours = [...hours, i];
                        }
                    })
                    hours = hours.sort((a, b) => a > b ? 1 : -1)
                    document.getElementById("hour").innerHTML = "<option value=''>{{__('f.select_hour')}}</option>";
                    document.getElementById("minute").innerHTML = "<option value=''>{{__('f.Select_minute')}}</option>";
                    hours.forEach(i => {
                        document.getElementById("hour").innerHTML += `
                        <option value="${i}">${i}</option>`
                    })
                    $("#dayname").val(days[new Date(val).getDay()])
                }
                //$("#billing-form").html(result)
            }
        });

    }
</script>
@endsection @section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/locales/bootstrap-datepicker.nl.js"></script>
<script src="{{asset('/')}}/admin/plugins/select2/js/select2.full.min.js"></script>

<script>
    $("#pickupDate").datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight:true,
        startDate: '+1d',
        language:'nl',
        autoclose:false,
        updateViewDate: false,
        viewMode: "months",
        datesDisabled:["{!! implode('","',$exceptions_dates) !!}"]
    }).on('changeMonth', function(e){
        var timestamp = Date.parse(e.date)/ 1000;
        $.ajax({
            url: `{{route('disableDates')}}/${timestamp}`,
            success: function(result) {
                if (result.weekends){
                    console.log(result.weekends);
                    $('#pickupDate').datepicker('setDatesDisabled', result.weekends);
                }
                //alert(result);
               // $('#pickupDate').datepicker('setDatesDisabled', disabled);
            }
        });
        /*var disabled = ['2020-11-03'];
        $('#pickupDate').datepicker('setDatesDisabled', disabled);*/
    });
</script>
<script>
    shippingDifferent = (val) => {
        if (val) {
            $(".s_required").prop('required', true);
        } else {
            $(".s_required").prop('required', false);
        }
    }
    @if(count($cart) == 0)
    document.getElementById("placeOrder").setAttribute('disabled', true)

    //toastr.error("Cart is empty");

    @endif
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
    userChange = (id) => {
        $.ajax({
            url: `{{URL::to('update-billing')}}?id=${id}`,
            success: function(result) {
                $("#billing-form").html(result)
                $('[data-shipping]').on('click', function() {
                    if ($('[data-shipping]:checked').length > 0) {
                        $('#shipping-form').slideDown();
                    } else {
                        $('#shipping-form').slideUp();
                    }
                });
            }
        });
    }
</script>
@endsection
