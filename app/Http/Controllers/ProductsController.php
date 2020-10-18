<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Product;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\URL;
use App\SubCategory;
use App\Category;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function singleView($name)
    {
        $product = Product::where('product_name_dch', '=', $name)->first();

        $relatedProducts = $product->category->products->take(6);
        return view('front.singleProduct', compact('product', 'relatedProducts'));
    }
     public function singleViewWithSlash($name,$lname)
    {
        $name=$name."/".$lname;
        $product = Product::where('product_name_dch', '=', $name)->first();
        $relatedProducts = $product->category->products->take(6);
        return view('front.singleProduct', compact('product', 'relatedProducts'));
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    return $row->category->name;
                })
                ->addColumn('subCategory', function ($row) {
                    if($row->subCategory){

                    return $row->subCategory->name;
                    }
                    return "";
                })
                // ->addColumn('order', function ($row) {
                //     return $row->orderLines->count();
                // })
                ->editColumn('image', function ($d) {
                    return "<img src='https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src=" . $d->image . "'>";
                })
                ->addColumn('action', function ($row) {

                    $btn = '<div class="btn-group"><a href="' . URL::to('/') . '/products/' . $row->id . '/edit" class="btn btn-sm btn-outline-primary">Edit</a>
                               <button onclick="deleteData(' . $row->id . ')" class="btn btn-sm btn-outline-danger">Delete</button></div>';

                    return $btn;
                })

                ->rawColumns(['action'])
                ->escapeColumns([])
                ->make(true);
        }

        return view('products.index');
    }
    public function syncAll()
    {

        $setting = Setting::firstOrFail();
        $api_key = $setting->api_key;
        $company_id = $setting->company_id;
        $curl = curl_init();

        $ch = curl_init("http://www.fooddesk.net/obsapi/api/v1/product/company_id/" . $company_id);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY:$api_key"));
        $output = curl_exec($ch);

        curl_close($ch);
        $output = simplexml_load_string($output);
        $json = json_encode($output);

        $array = json_decode($json, TRUE);
        foreach ($array["products"]["product"] as $prod) {
            Product::updateOrCreate([
                "fid" => $prod["id"],
            ], [

                "product_name_dch" => $prod["product_name"],
                "product_description_dch" => gettype($prod["product_description"]) == "string" ? $prod["product_description"] : "",
                "category_id" => $prod["category_id"],
                "subcategory_id" => $prod["subcategory_id"],
                "product_number" => gettype($prod["product_number"]) == "string" ? $prod["product_number"] : "",
                "image" => gettype($prod["image"]) == "string" ? $prod["image"] : "",
                "sell_product_option" => $prod["sell_product_option"],
                "price_per_person" => $prod["price_per_person"],
                "min_person" => $prod["min_person"],
                "max_person" => $prod["max_person"],
                "price_per_unit" => $prod["price_per_unit"],
                "price_weight" => $prod["price_weight"],
                "discount" => gettype($prod["discount"])=="string" ? $prod["discount"] : "0",
                "discount_person" => gettype($prod["discount_person"]) == "string" ? $prod["discount_person"] : "0",
                "status" => $prod["status"],
                "allday_availability" => gettype($prod["allday_availability"]) == "string" ? $prod["allday_availability"] : "0",
                "availability" => gettype($prod["availability"]) == "string" ? $prod["availability"] : "0",
                "advance_payment" => $prod["advance_payment"],
                "available_after" => gettype($prod["available_after"]) == "string" ? $prod["available_after"] : "0",
                "duedate" => gettype($prod["labeler"]["duedate"]) == "string" ? $prod["labeler"]["duedate"] : "0",
                "conserve_min" => gettype($prod["labeler"]["conserve_min"]) == "string" ? $prod["labeler"]["conserve_min"] : "0",
                "conserve_max" => gettype($prod["labeler"]["conserve_max"]) == "string" ? $prod["labeler"]["conserve_max"] : "0",
                "weight" => gettype($prod["labeler"]["weight"]) == "string" ? $prod["labeler"]["weight"] : "0",
                "weight_unit" => gettype($prod["labeler"]["weight_unit"]) == "string" ? $prod["labeler"]["weight_unit"] : " ",
                "barcode_nbr" => gettype($prod["labeler"]["barcode_nbr"]) == "string" ? $prod["labeler"]["barcode_nbr"] : " ",
                "format_label" => gettype($prod["labeler"]["format_label"]) == "string" ? $prod["labeler"]["format_label"] : " ",
                "type" => gettype($prod["labeler"]["type"]) == "string" ? $prod["labeler"]["type"] : "0",
                "type_label" => gettype($prod["labeler"]["type_label"]) == "string" ? $prod["labeler"]["type_label"] : " ",
                "extra_notification_dch" => " ",
                "ingredients_dch" => gettype($prod["ingredients"]) == "string" ? $prod["ingredients"] : " ",
                "e_val_1" => $prod["nutrition"]["e_val_1"],
                "e_val_2" => $prod["nutrition"]["e_val_2"],
                "carbo" => $prod["nutrition"]["carbo"],
                "sugar" => $prod["nutrition"]["sugar"],
                "fats" => $prod["nutrition"]["fats"],
                "sat_fats" => $prod["nutrition"]["sat_fats"],
                "salt" => $prod["nutrition"]["salt"],
                "fibers" => $prod["nutrition"]["fibers"],
                "natrium" => $prod["nutrition"]["natrium"],
                "allergence_dch" => gettype($prod["allergence"]) == "string" ? $prod["allergence"] : " "
            ]);
        }
        $curl = curl_init();

        $ch = curl_init("http://www.fooddesk.net/obsapi/api/v1/category/company_id/" . $company_id);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY:$api_key"));
        $output = curl_exec($ch);

        $output = simplexml_load_string($output);
        curl_close($ch);
        $json = json_encode($output);

        $array = json_decode($json, TRUE);
        //return $array;
        foreach ($array["categories"]["category"] as $cat) {
            Category::updateOrCreate([
                "fid" => $cat["id"],
            ], [

                "name" => $cat["name"],
                "image" => $cat["image"],
                "description" => "d"
            ]);
            if (array_key_exists("subcategory", $cat["subcategories"])) {
                foreach ($cat["subcategories"]["subcategory"] as $subcat) {
                    SubCategory::updateOrCreate([
                        "fid" => $subcat["id"],
                    ], [

                        "category_id" => $cat["id"],
                        "name" => $subcat["name"],
                        "image" => gettype($subcat["image"]) == "string" ? $subcat["image"] : "",
                        "description" => "d"
                    ]);
                }
            }
        }
        return redirect()->back()->with('success', 'Sync completed');
    }
    public function sync()
    {

        $setting = Setting::firstOrFail();
        $api_key = $setting->api_key;
        $company_id = $setting->company_id;
        $curl = curl_init();

        $ch = curl_init("http://www.fooddesk.net/obsapi/api/v1/product/company_id/" . $company_id);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY:$api_key"));
        $output = curl_exec($ch);

        curl_close($ch);
        $output = simplexml_load_string($output);
        $json = json_encode($output);

        $array = json_decode($json, TRUE);
        foreach ($array["products"]["product"] as $prod) {
            Product::updateOrCreate([
                "fid" => $prod["id"],
            ], [

                "product_name_dch" => $prod["product_name"],
                "product_description_dch" => gettype($prod["product_description"]) == "string" ? $prod["product_description"] : "",
                "category_id" => $prod["category_id"],
                "subcategory_id" => $prod["subcategory_id"],
                "product_number" => gettype($prod["product_number"]) == "string" ? $prod["product_number"] : "",
                "image" => gettype($prod["image"]) == "string" ? $prod["image"] : "",
                "sell_product_option" => $prod["sell_product_option"],
                "price_per_person" => $prod["price_per_person"],
                "min_person" => $prod["min_person"],
                "max_person" => $prod["max_person"],
                "price_per_unit" => $prod["price_per_unit"],
                "price_weight" => $prod["price_weight"],
                "discount" => gettype($prod["discount"])=="string" ? $prod["discount"] : "0",
                "discount_person" => gettype($prod["discount_person"]) == "string" ? $prod["discount_person"] : "0",
                "status" => $prod["status"],
                "allday_availability" => gettype($prod["allday_availability"]) == "string" ? $prod["allday_availability"] : "0",
                "availability" => gettype($prod["availability"]) == "string" ? $prod["availability"] : "0",
                "advance_payment" => $prod["advance_payment"],
                "available_after" => gettype($prod["available_after"]) == "string" ? $prod["available_after"] : "0",
                "duedate" => gettype($prod["labeler"]["duedate"]) == "string" ? $prod["labeler"]["duedate"] : "0",
                "conserve_min" => gettype($prod["labeler"]["conserve_min"]) == "string" ? $prod["labeler"]["conserve_min"] : "0",
                "conserve_max" => gettype($prod["labeler"]["conserve_max"]) == "string" ? $prod["labeler"]["conserve_max"] : "0",
                "weight" => gettype($prod["labeler"]["weight"]) == "string" ? $prod["labeler"]["weight"] : "0",
                "weight_unit" => gettype($prod["labeler"]["weight_unit"]) == "string" ? $prod["labeler"]["weight_unit"] : " ",
                "barcode_nbr" => gettype($prod["labeler"]["barcode_nbr"]) == "string" ? $prod["labeler"]["barcode_nbr"] : " ",
                "format_label" => gettype($prod["labeler"]["format_label"]) == "string" ? $prod["labeler"]["format_label"] : " ",
                "type" => gettype($prod["labeler"]["type"]) == "string" ? $prod["labeler"]["type"] : "0",
                "type_label" => gettype($prod["labeler"]["type_label"]) == "string" ? $prod["labeler"]["type_label"] : " ",
                "extra_notification_dch" => " ",
                "ingredients_dch" => gettype($prod["ingredients"]) == "string" ? $prod["ingredients"] : " ",
                "e_val_1" => $prod["nutrition"]["e_val_1"],
                "e_val_2" => $prod["nutrition"]["e_val_2"],
                "carbo" => $prod["nutrition"]["carbo"],
                "sugar" => $prod["nutrition"]["sugar"],
                "fats" => $prod["nutrition"]["fats"],
                "sat_fats" => $prod["nutrition"]["sat_fats"],
                "salt" => $prod["nutrition"]["salt"],
                "fibers" => $prod["nutrition"]["fibers"],
                "natrium" => $prod["nutrition"]["natrium"],
                "allergence_dch" => gettype($prod["allergence"]) == "string" ? $prod["allergence"] : " "
            ]);
        }
        return redirect()->back()->with('success', 'Sync completed');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        Product::create($requestData);

        return redirect('products')->with('flash_message', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $product = Product::findOrFail($id);
        $product->update($requestData);

        return redirect('products')->with('flash_message', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('products')->with('flash_message', 'Product deleted!');
    }
}
