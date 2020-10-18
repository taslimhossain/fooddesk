@extends('layouts.front')
@section('style')
    <style>
        .cart-table .table thead {
            background-color: #a2a20c;
        }
        .cart-table .table thead tr th {
            color: #fff;
        }
        .cart-summary .cart-summary-wrap {
            background-color: #ffffff;
            -webkit-box-shadow: 0px 5px 4px 0px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 5px 4px 0px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
@section('content')


<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb-container">
                    <ul>
                        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> {{ __('f.home') }}</a></li>
                        <li class="active" ><a href="{{route('cart')}}">{{__('f.shoppingCart')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--=====  End of breadcrumb area  ======-->


<!--=============================================
    =            Cart page content         =
    =============================================-->


<div class="page-section section mb-50">
    <div class="container">
        <div class="row" id="cart-container">
            @include('includes.cartPage')
        </div>
    </div>
</div>
<script>
removeCart = (id) => {
            $.ajax({
                url: `{{URL::to('remove-cart')}}?id=${id}`,
                success: function(result) {
                    $("#cart-container").html(result)
                    toastr.warning('Item removed from cart')
                    $('.pro-qty').append('<a href="#" class="inc qty-btn">+</a>');
    $('.pro-qty').append('<a href="#" class= "dec qty-btn">-</a>');
    $('.qty-btn').on('click', function(e) {
        e.preventDefault();
        var $button = $(this);

        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
        updateCart($button.parent().find('input').attr("data-id"), $button.parent().find('input').val(), $button.parent().parent().find('select').val(),$button.parent().find('input'));
    });

                }
            });
        }
updateCart=(id,quantity,weight,el)=>{

    if(weight=="GR"&&quantity<10){
        quantity=10;
        }
    if(parseInt(quantity)<1){
         if(el){
             el.value=1;
         }
         quantity=1;
    }
    if(weight=="KG"){
        quantity*=1000;
    }
    $.ajax({
            url: `{{URL::to('update-cart')}}?id=${id}&quantity=${quantity}`,
            success: function(result) {
                $.ajax({
            url: `{{URL::to('get-cart')}}`,
            success: function(res) {
                $("#shopping-cart").html(res);
            }
        })
                $("#cart-container").html(result)
                    $('.pro-qty').append('<a href="#" class="inc qty-btn">+</a>');
    $('.pro-qty').append('<a href="#" class= "dec qty-btn">-</a>');
    $('.qty-btn').on('click', function(e) {
        e.preventDefault();
        var $button = $(this);

        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
        updateCart($button.parent().find('input').attr("data-id"), $button.parent().find('input').val(), $button.parent().parent().find('select').val(),$button.parent().find('input'));
    });
            }
        });
}
</script>

@endsection
