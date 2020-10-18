@extends('layouts.admin') @section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('m.orderSetting') }}</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('m.orderSetting') }}</h4>
                    </div>
                    <div class="card-body">
                        <!-- Monday -->
                        <form method="POST" action="{{route('orderPickup')}}">
                            @csrf
                            <div class="my-3 row">
                                <div class="col-md-3">
                                    {{ __('m.ifCustomerOrdersFor') }}
                                </div>
                                <div class="col-md-2">
                                    {{ __('m.monday') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="min_time1" name="min_time1" style="margin-bottom:0px" class="form-control" type="select">
                                        @include('includes.hourMinute')
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    {{ __('m.youthenHeCanPickupTheProductsFrom') }}
                                    
                                </div>
                                <div class="col-md-2">
                                    <select id="pickup1" name="pickup1" class="form-control">
                                        @include('includes.days')
                                    </select>
                                </div>
                            </div>
                            <!-- Tuesday -->
                            <div class="my-3 row">
                                <div class="col-md-3">
                                    {{ __('m.ifCustomerOrdersFor') }}
                                </div>
                                <div class="col-md-2">
                                    {{ __('m.tuesday') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="min_time2" name="min_time2" style="margin-bottom:0px" class="form-control" type="select">
                                        @include('includes.hourMinute')
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    {{ __('m.youthenHeCanPickupTheProductsFrom') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="pickup2" name="pickup2" class="form-control">
                                        @include('includes.days')
                                    </select>
                                </div>
                            </div>
                            <!-- Wednesday -->
                            <div class="my-3 row">
                                <div class="col-md-3">
                                    {{ __('m.ifCustomerOrdersFor') }}
                                </div>
                                <div class="col-md-2">
                                    {{ __('m.wednessday') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="min_time3" name="min_time3" style="margin-bottom:0px" class="form-control" type="select">
                                        @include('includes.hourMinute')
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    {{ __('m.youthenHeCanPickupTheProductsFrom') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="pickup3" name="pickup3" class="form-control">
                                        @include('includes.days')
                                    </select>
                                </div>
                            </div>
                            <!-- Thursday -->
                            <div class="my-3 row">
                                <div class="col-md-3">
                                    {{ __('m.ifCustomerOrdersFor') }}
                                </div>
                                <div class="col-md-2">
                                    {{ __('m.thursday') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="min_time4" name="min_time4" style="margin-bottom:0px" class="form-control" type="select">
                                        @include('includes.hourMinute')
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    {{ __('m.youthenHeCanPickupTheProductsFrom') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="pickup4" name="pickup4" class="form-control">
                                        @include('includes.days')
                                    </select>
                                </div>
                            </div>
                            <!-- Friday -->
                            <div class="my-3 row">
                                <div class="col-md-3">
                                    {{ __('m.ifCustomerOrdersFor') }}
                                </div>
                                <div class="col-md-2">
                                    {{ __('m.friday') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="min_time5" name="min_time5" style="margin-bottom:0px" class="form-control" type="select">
                                        @include('includes.hourMinute')
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    {{ __('m.youthenHeCanPickupTheProductsFrom') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="pickup5" name="pickup5" class="form-control">
                                        @include('includes.days')
                                    </select>
                                </div>
                            </div>
                            <!-- Saturday -->
                            <div class="my-3 row">
                                <div class="col-md-3">
                                    {{ __('m.ifCustomerOrdersFor') }}
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" name="day" value="6"> {{ __('m.saturday') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="min_time6" name="min_time6" style="margin-bottom:0px" class="form-control" type="select">
                                        @include('includes.hourMinute')
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    {{ __('m.youthenHeCanPickupTheProductsFrom') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="pickup6" name="pickup6" class="form-control">
                                        @include('includes.days')
                                    </select>
                                </div>
                            </div>
                            <!-- Sunday -->
                            <div class="my-3 row">
                                <div class="col-md-3">
                                    {{ __('m.ifCustomerOrdersFor') }}
                                </div>
                                <div class="col-md-2">
                                    {{ __('m.sunday') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="min_time0" name="min_time0" style="margin-bottom:0px" class="form-control" type="select">
                                        @include('includes.hourMinute')
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    {{ __('m.youthenHeCanPickupTheProductsFrom') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="pickup0" name="pickup0" class="form-control">
                                        @include('includes.days')
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <button class="btn btn-success ml-auto">
                                    {{ __('m.update') }}
                                </button>
                            </div>
                        </form>
                        <div class="row">
                            {{ __('m.exception') }} <button class="ml-2 btn btn-sm btn-primary" onclick="addOrderDayException()">+</button>
                        </div>
                        <form method="post" action="{{route('orderPickupException')}}">
                            @csrf
                            <div id="dayException">
                                @foreach($orderDayExceptions as $exception)
                                <div class="my-3 row">
                                    <div class="col-md-3">
                                        {{ __('m.ifCustomerOrdersFor') }}
                                    </div>
                                    <div class="col-md-2">
                                        <input value="{{$exception->date}}" type="date" name="date[]">
                                    </div>
                                    <div class="col-md-2">
                                        <select id="emin_time{{$exception->id}}" name="min_time[]" style="margin-bottom:0px" class="form-control" type="select">
                                            @include('includes.hourMinute')
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        {{ __('m.youthenHeCanPickupTheProductsFrom') }}
                                    </div>
                                    <div class="col-md-2">
                                        <select id="epickup{{$exception->id}}" name="pickup[]" class="form-control">
                                            @include('includes.days')
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button onclick="this.parentElement.parentElement.remove()" class="btn btn-danger btn-sm">&times;</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <button class="btn btn-success ml-auto">
                                    {{ __('m.update') }}
                                </button>
                            </div>
                        </form>

                        <div class="row">
                            {{ __('m.pickupTime') }} <button class="ml-2 btn btn-sm btn-primary" onclick="addPickupTime()">+</button>
                        </div>
                        <form method="post" action="{{route('pickupTime')}}">
                            @csrf
                            <div id="pickupTime">
                                @foreach($pickupTimes as $time)

                                <div class="my-3 row">
                                    <div class="col-md-3">
                                        <select id="pday{{$time->id}}" name="day[]" class="form-control">
                                            <option value="1">{{ __('m.monday') }}</option>
                                            <option value="2">{{ __('m.tuesday') }}</option>
                                            <option value="3">{{ __('m.wednessday') }}</option>
                                            <option value="4">{{ __('m.thursday') }}</option>
                                            <option value="5">{{ __('m.friday') }}</option>
                                            <option value="6">{{ __('m.saturday') }}</option>
                                            <option value="0">{{ __('m.sunday') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        {{ __('m.from') }}
                                    </div>
                                    <div class="col-md-2">
                                        <select id="pfrom{{$time->id}}" name="from[]" style="margin-bottom:0px" class="form-control" type="select">
                                            @include('includes.hourMinute')
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        {{ __('m.to') }}
                                    </div>
                                    <div class="col-md-2">
                                        <select id="pto{{$time->id}}" name="to[]" style="margin-bottom:0px" class="form-control" type="select">
                                            @include('includes.hourMinute')
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button onclick="this.parentElement.parentElement.remove()" class="btn btn-danger btn-sm">&times;</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <button class="btn btn-success ml-auto">
                                    {{ __('m.update') }}
                                </button>
                            </div>
                        </form>
                        <div class="row">
                            {{ __('m.pickupTimeException') }}<button class="ml-2 btn btn-sm btn-primary" onclick="addPickupTimeException()">+</button>
                        </div>
                        <form method="post" action="{{route('pickupTimeException')}}">
                            @csrf
                            <div id="pickupTimeException">
                                @foreach($pickupTimeExceptions as $time)

                                <div class="my-3 row">
                                    <div class="col-md-3">
                                        <input value="{{$time->date}}" id="pedate{{$time->id}}" type="date" name="date[]">
                                    </div>
                                    <div class="col-md-2">
                                        {{ __('m.from') }}
                                    </div>
                                    <div class="col-md-2">
                                        <select id="pefrom{{$time->id}}" name="from[]" style="margin-bottom:0px" class="form-control" type="select">
                                        <option value="-1">Close</option>
                                            @include('includes.hourMinute')
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        {{ __('m.to') }}
                                    </div>
                                    <div class="col-md-2">
                                        <select id="peto{{$time->id}}" name="to[]" style="margin-bottom:0px" class="form-control" type="select">
                                            @include('includes.hourMinute')
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button onclick="this.parentElement.parentElement.remove()" class="btn btn-danger btn-sm">&times;</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <button class="btn btn-success ml-auto">
                                    {{ __('m.update') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection @section('script')
<script>
    addPickupTime = () => {
        html = `<div class="my-3 row">
                                <div class="col-md-3">
                                    <select name="day[]" class="form-control">
                                        <option value="1">{{ __('m.monday') }}</option>
                                            <option value="2">{{ __('m.tuesday') }}</option>
                                            <option value="3">{{ __('m.wednessday') }}</option>
                                            <option value="4">{{ __('m.thursday') }}</option>
                                            <option value="5">{{ __('m.friday') }}</option>
                                            <option value="6">{{ __('m.saturday') }}</option>
                                            <option value="0">{{ __('m.sunday') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                   From
                                </div>
                                <div class="col-md-2">
                                    <select  name="from[]" style="margin-bottom:0px" class="form-control" type="select">
                                        @include('includes.hourMinute')
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    To
                                </div>
                                <div class="col-md-2">
                                    <select  name="to[]" style="margin-bottom:0px" class="form-control" type="select">
                                        @include('includes.hourMinute')
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button onclick="this.parentElement.parentElement.remove()" class="btn btn-danger btn-sm">&times;</button>
                                </div>
                            </div>`;
        let div = document.createElement('div');
        div.innerHTML = html;
        document.getElementById("pickupTime").appendChild(div);
    }


    addPickupTimeException = () => {
        html = `<div class="my-3 row">
                                <div class="col-md-3">
                                    <input type="date" name="date[]">
                                </div>
                                <div class="col-md-2">
                                   From
                                </div>
                                <div class="col-md-2">
                                    <select  name="from[]" style="margin-bottom:0px" class="form-control" type="select">
                                    <option value="-1">Close</option>
                                        @include('includes.hourMinute')
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    To
                                </div>
                                <div class="col-md-2">
                                    <select  name="to[]" style="margin-bottom:0px" class="form-control" type="select">
                                        @include('includes.hourMinute')
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button onclick="this.parentElement.parentElement.remove()" class="btn btn-danger btn-sm">&times;</button>
                                </div>
                            </div>`;
        let div = document.createElement('div');
        div.innerHTML = html;
        document.getElementById("pickupTimeException").appendChild(div);
    }


    addOrderDayException = () => {
        html = `<div class="my-3 row">
                                <div class="col-md-3">
                                    {{ __('m.ifCustomerOrdersFor') }}
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="date[]">
                                </div>
                                <div class="col-md-2">
                                    <select id="min_time" name="min_time[]" style="margin-bottom:0px" class="form-control" type="select">
                                        @include('includes.hourMinute')
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    {{ __('m.youthenHeCanPickupTheProductsFrom') }}
                                </div>
                                <div class="col-md-2">
                                    <select id="pickup" name="pickup[]" class="form-control">
                                       @include('includes.days')
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button onclick="this.parentElement.parentElement.remove()" class="btn btn-danger btn-sm">&times;</button>
                                </div>
                            </div>`;
        let div = document.createElement('div');
        div.innerHTML = html;
        document.getElementById("dayException").appendChild(div);
    }
    document.getElementById("min_time0").value = "{{$day0->min_time}}";
    document.getElementById("min_time1").value = "{{$day1->min_time}}";
    document.getElementById("min_time2").value = "{{$day2->min_time}}";
    document.getElementById("min_time3").value = "{{$day3->min_time}}";
    document.getElementById("min_time4").value = "{{$day4->min_time}}";
    document.getElementById("min_time5").value = "{{$day5->min_time}}";
    document.getElementById("min_time6").value = "{{$day6->min_time}}";
    document.getElementById("pickup0").value = "{{$day0->pickup}}";
    document.getElementById("pickup1").value = "{{$day1->pickup}}";
    document.getElementById("pickup2").value = "{{$day2->pickup}}";
    document.getElementById("pickup3").value = "{{$day3->pickup}}";
    document.getElementById("pickup4").value = "{{$day4->pickup}}";
    document.getElementById("pickup5").value = "{{$day5->pickup}}";
    document.getElementById("pickup6").value = "{{$day6->pickup}}";
    @foreach($orderDayExceptions as $exception)
    document.getElementById("emin_time{{$exception->id}}").value = "{{$exception->min_time}}";
    document.getElementById("epickup{{$exception->id}}").value = "{{$exception->pickup}}";

    @endforeach
    @foreach($pickupTimes as $time)
    document.getElementById("pday{{$time->id}}").value = "{{$time->day}}";
    document.getElementById("pfrom{{$time->id}}").value = "{{$time->from}}";
    document.getElementById("pto{{$time->id}}").value = "{{$time->to}}";
    @endforeach
    @foreach($pickupTimeExceptions as $time)
    document.getElementById("pedate{{$time->id}}").value = "{{$time->date}}";
    document.getElementById("pefrom{{$time->id}}").value = "{{$time->from}}";
    document.getElementById("peto{{$time->id}}").value = "{{$time->to}}";
    @endforeach
</script>
@endsection
