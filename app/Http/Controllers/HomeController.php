<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Page;
use App\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('front.home', compact('categories'));
    }
    public function page($slug){
        $page=Page::where('url','=',$slug)->firstOrFail();
        return view('front.page',compact('page'));
    }

    public function Home()
    {
        $setting = Setting::firstOrFail();
        if ($setting->offline == 1) {
            return view('front.offline');
        }
        $categories = Category::where(["status"=>true])->orderBy('name')->with('subCategories')->get();

        return view('front.home', compact('categories'));
    }
    public function filterCategory(Request $request)
    {
        $categories = Category::where($request->key, 'like', '%' . $request->val . '%')->get();
        return view('includes.categoryFilter', compact('categories'));
    }
}
