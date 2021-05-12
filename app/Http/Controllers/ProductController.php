<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Lot;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role != "seller") {
            return redirect()->route("pages.home");
        }

        $products = DB::table('lots')
                ->select('products.*', DB::raw('max(lots.created_at) as lastest_at'), DB::raw('sum(current_qty) as total'))
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role != "seller") {
            return redirect()->route("pages.home");
        }

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
        $request->validate(
             [
            "inpImg" => 'required',
            "name" => ['required', 'unique:products,product_name'],
            "price" => ["required", "numeric" ],
            "qty" => ["required", "numeric"]
        ],[
            "inpImg.required" => "กรุณาอัพโหลดรูปสินค้า",
            "name.required" => "กรุณาใส่ชื่อสินค้า",
            "name.unique" => "มีชื่อสินค้านี้แล้ว",
            "price.required" => "กรุณากรอกราคาสินค้า",
            "price.numeric" => "กรุณากรอกข้อมูลเป็นตัวเลข",
            "qty.required" => "กรุณากรอกจำนวนสินค้า",
            "qty.numeric" => "กรุณากรอกข้อมูลเป็นตัวเลข",
        ]);

        $img = $request->file('inpImg');
        $id = DB::table('products')->max('id') + 1;
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
        $product = DB::table('lots')
                ->select('products.*', DB::raw('max(lots.created_at) as lastest_at'), DB::raw('sum(current_qty) as total'))
                ->groupBy('product_id')->join('products', 'id', '=', 'product_id')
                ->where('products.id', '=', $id)
                ->first();
        return view("product.show",[
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }else if (Auth::user()->role != "seller") {
            return redirect()->route("pages.home");
        }

        $product = DB::table('lots')
                ->select('products.*', DB::raw('max(lots.created_at) as lastest_at'), DB::raw('sum(current_qty) as total'))
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
        $request->validate(
            [
           "name" => ['required'],
           "price" => ["required", "numeric"],
       ],[
           "name.required" => "กรุณาใส่ชื่อสินค้า",
           "price.required" => "กรุณากรอกราคาสินค้า",
           "price.numeric" => "กรุณากรอกข้อมูลเป็นตัวเลข",
       ]);

       if ($request->toggleValue == "true") {
        $request->validate(
            ["qty" => ["required", "numeric","integer"]],
            [
           "qty.required" => "กรุณากรอกจำนวนสินค้า",
           "qty.numeric" => "กรุณากรอกข้อมูลเป็นตัวเลข",
           "qty.integer" => "กรุณากรอกข้อมูลเป็นจำนวนเต็ม"
       ]);

       $lot = new Lot();
       $lot->product_id = $id;
       $lot->added_qty = $request->qty;
       $lot->current_qty = $request->qty;
       $lot->save();
       }

       $product = Product::findOrFail($id);
       $product->product_name = $request->name;
       $product->price = $request->price;

       $img = $request->file('inpImg');
       if ($img) {
        $filename = $id . ".jpg";
        $path = 'storage/pictures/products/';
        $img->move($path, $filename);

        $product->product_img_path = $path . $filename;
       }

       $product->save();

       return redirect()->route("products.index");
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

    public function cart(Request $request)
    {
        $carts = Cart::addCart($request->product_id,$request->amount);
        return view('product.cart',['cart'=>$carts]);
    }

    public function report() {
    // {
    //     $lots = DB::table('lots')->join('products','products.id','=','lots.product_id')
    //     ->groupBy('lots.product_id')->select('product_id',DB::raw('sum(product_id) as sum_product'))
    //     ->groupBy('product_id')->limit(7)->get();
    $lots = DB::table('lots')->select('products.*', DB::raw('sum(current_qty) as curr'), DB::raw('sum(added_qty) as added'))->groupBy('product_id')->join('products', 'id', '=', 'product_id')->get();
        return view('product.report',['lots'=>$lots]);
    }

}
