<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('lots')
                ->select('products.*', DB::raw('max(lots.updated_at) as lastest_at'), DB::raw('sum(current_qty) as total'))
                ->groupBy('product_id')->join('products', 'id', '=', 'product_id')
                ->orderByDesc('lastest_at')
                ->get();

        return view("product.index", [
            "products" => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("product.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        print_r($request->input());
        print_r($request->file());
        $request->validate([
            "inpImg" => 'required',
            "name" => 'required',
            "price" => "required",
            "qty" => "required"
        ]);

        $img = $request->file('inpImg');
        $id = DB::table('products')->max('id');
        $filename = $id . ".jpg";
        $path = 'storage/pictures/products/';
        $img->move($path, $filename);

        $product = new Product();
        $product->product_name = $request->input('name');
        $product->price = $request->input('price');
        $product->product_img_path = $path . $filename;
        $product->save();

        $lot = new Lot();
        $lot->product_id = $id;
        $lot->added_qty = $request->qty;
        $lot->current_qty = $request->qty;
        $lot->save();

        return redirect()->route("products.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = DB::table('lots')
                ->select('products.*', DB::raw('max(lots.updated_at) as lastest_at'), DB::raw('sum(current_qty) as total'))
                ->groupBy('product_id')
                ->join('products', 'id', '=', 'product_id')
                ->where('id', '=', $id)
                ->first();
        $product->lastest_at = Carbon::parse($product->lastest_at)->timezone('Asia/Bangkok')->toDateTimeString();
        $updated = Carbon::parse($product->lastest_at)->toDateString() == Carbon::now()->toDateString();

        return view("product.edit", [
            "product" => $product,
            "updated" => $updated
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
