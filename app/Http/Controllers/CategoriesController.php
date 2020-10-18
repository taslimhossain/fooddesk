<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use App\Setting;
use App\SubCategory;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\URL;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('id', function ($d) {
                    return $d->fid;
                })->editColumn('status', function ($d) {
                    $checked=$d->status==1? "checked":"";
                    return "<input onclick='updateCategory(".$d->fid.",this)' type='checkbox'".$checked." >";
                })
                ->editColumn('image', function ($d) {
                    return "<img src='https://www.fooddesk.net/obs/obs-api-new/timthumb.php?src=" . $d->image . "'>";
                })
                ->rawColumns(['action'])
                ->escapeColumns([])
                ->make(true);
        }

        return view('categories.index');
    }
    #update category status
    public function update_status(Request $request){
        $category = Category::where(["fid"=>$request->input('fid')])->first();
        $category->status=!$category->status;
        $category->save();
        return response()->json(['message'=>"Category status update success"]);
    }
    public function sync()
    {

        $setting = Setting::firstOrFail();
        $api_key = $setting->api_key;
        $company_id = $setting->company_id;
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */

    public function category($name)
    {
        $setting = Setting::firstOrFail();
        if ($setting->offline == 1) {
            return view('front.offline');
        }
        $category = Category::whereName($name)->first();
        $categories = Category::orderBy('name')->with('subCategories')->get();

        $subCategories = SubCategory::where(["category_id"=>$category->fid,'status'=>true])->get();;
        return view('front.category', compact('category', 'categories', 'subCategories'));
    }

    public function filterSubCategory(Request $request)
    {
        $subCategories = SubCategory::where('category_id', '=', $request->cat)->where($request->key, 'like', '%' . $request->val . '%')->get();
        return view('includes.subCategoryFilter', compact('subCategories'));
    }
    public function store(Request $request)
    {

        $requestData = $request->all();

        Category::create($requestData);

        return redirect('categories')->with('flash_message', 'Category added!');
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
        $category = Category::findOrFail($id);

        return view('categories.show', compact('category'));
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
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
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

        $category = Category::findOrFail($id);
        $category->update($requestData);

        return redirect('categories')->with('flash_message', 'Category updated!');
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
        Category::destroy($id);

        return redirect('categories')->with('flash_message', 'Category deleted!');
    }
}
