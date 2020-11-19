<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index() {
        return view("orders.order");
    }

    public function show($id) {
        $product = DB::table('products')->where("id","=", $id)->first();
        $lot = DB::table('lots')->where("product_id","=",$id)->first();
        return view("orders.order",[
            'product' => $product,
            'lot' => $lot
        ]);
    }





    public function inform($id){
        $order = DB::table('orders')->select("product_name",'orders.*')->where("orders.id","=",$id)->join('products', 'products.id', '=', "product_id")->first();

        return view("orders.inform",[
            'order' => $order
        ]);


    }

    public function uploadPayment(Request $request, $id){
        $order = Order::findOrFail($id);
        $img = $request->file('inpImg');
        $filename = $order->id . "." . $img->getClientOriginalExtension();
        $path = 'storage/pictures/orders';
        $img->move($path, $filename);
        DB::table('orders')->where('id','=', $order->id)->update([
            'img_path' => $path . "/" . $filename,
            'status' => 'verifying'
        ]);

        return redirect()->route('profile.index');
    }

    public function createOrder(Request $request, $id){
        $carbon = Carbon::now();
        $customer = DB::table('customers')->where("user_id","=", Auth::user()->id)->first();
        $product = DB::table('products')->where("id","=", $id)->first();
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->product_id = $id ;
        $order->recv_name = $customer->name;
        $order->recv_address = $customer->address;
        $order->recv_tel = $customer->telephone;
        $order->amount = $request->input("amount");
        $order->price_per_unit = $product->price;
        $order->expired_at = $carbon->addDays(2)->timezone("Asia/Bangkok");
        $order->save();
        return redirect()->route("profile.index");
    }

}
