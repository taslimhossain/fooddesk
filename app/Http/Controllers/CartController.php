<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function cart(Request $request)
    {
        $setting = Setting::firstOrFail();
        if ($setting->offline == 1) {
            return view('front.offline');
        }
        $cart = [];
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
        }

        return view('front.cart', compact('cart'));
    }
    public function updateCart(Request $request)
    {
        $cart = $request->session()->get('cart');

        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]["id"] == $request->id) {
                $cart[$i]["quantity"] = $request->quantity;
            }
        }

        $request->session()->put('cart', $cart);
        return view('includes.cartPage', compact('cart'));
    }
    public function getCart(Request $request)
    {
        $cart = [];
        $cartTotal = 0;
        if ($request->session()->has('cart')) {

            $cart = $request->session()->get('cart');
            foreach ($cart as $item) {

                if ($item["product"]->sell_product_option == "per_unit") {
                    $cartTotal = $cartTotal + $item["product"]->price_per_unit * $item["quantity"];
                } elseif ($item["product"]->sell_product_option == "weight_wise") {
                    $cartTotal = $cartTotal + $item["product"]->price_weight * $item["quantity"];
                }
                else {
                    $cartTotal = $cartTotal + $item["product"]->price_per_person * $item["quantity"];
                }
            }
        }

        return view('includes.shoppingCart', compact("cart", "cartTotal"));
    }
    public function removeCart(Request $request)
    {
        //$request->session()->remove('cart');
        $cart = $request->session()->get('cart');

        $cart = array_filter($cart, function ($var) use ($request) {
            return $var["id"] != $request->id;
        });

        $request->session()->put('cart', array_values($cart));
        return view('includes.cartPage', compact('cart'));
    }
    public function addToCart(Request $request)
    {
        $product = Product::where('fid', '=', $request->id)->first();
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            $exist = false;
            for ($i = 0; $i < count($cart); $i++) {
                if ($cart[$i]["id"] == $request->id) {
                    $cart[$i]["quantity"] += $request->weight == "KG" ? $request->quantity * 1000 : $request->quantity;
                    $cart[$i]["msg"] .= " " . $request->msg;
                    $exist = true;
                }
            }
            if (!$exist) {
                array_push($cart, [
                    "id" => $request->id,
                    "quantity" => $request->weight == "KG" ? $request->quantity * 1000 : $request->quantity,
                    "msg" => $request->msg,
                    "weight" => $request->weight,
                    "product" => $product
                ]);
            }
            $request->session()->put('cart', $cart);
        } else {
            $cart = [];
            array_push($cart, [
                "id" => $request->id,
                "quantity" => $request->weight == "KG" ? $request->quantity * 1000 : $request->quantity,
                "msg" => $request->msg,
                "weight" => $request->weight,
                "product" => $product
            ]);
            $request->session()->put('cart', $cart);
        }
        return "Successfully added to Cart";
    }
}
