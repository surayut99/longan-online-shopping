<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = ['purchasing'=>'รอจ่าย', 'verifying'=> 'รอการยืนยัน', 'verified'=>'ยืนยันแล้ว', 'deliveried'=>'จัดส่งแล้ว','cancelled'=>'ยกเลิก'];
        if(!Auth::user()){
            return redirect()->route('login');
        }
        if(Auth::user()->role == 'customer'){
            $user = DB::table('customers')->where('user_id', '=', Auth::user()->id)->first();
            $orders = DB::table('orders')->select("product_name",'orders.*')->join('products', 'products.id', '=', 'product_id')->orderBy("orders.created_at")->get();

            return view("orders.index", [
                "user" => $user,
                "orders" => $orders,
                "status" => $status
            ]);
        }

        $user = DB::table('sellers')->where('user_id', '=', Auth::user()->id)->first();
        $orders = DB::table('orders')->select("product_name",'orders.*')->join('products', 'products.id', '=', 'product_id')->orderBy("orders.created_at")->get();
        return view("orders.index", [
            "user" => $user,
            "orders" => $orders,
            "status" => $status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "amount" => ["required", "numeric", "max:".$request->qty,"min:1","integer"]
        ],
        [
            "amount.required" => "กรุณากรอกจำนวนสินค้า",
            "amount.numeric" => "กรุณากรอกข้อมูลเป็นตัวเลข",
            "amount.max" => "มีสินค้าไม่เพียงพอ",
            "amount.min" => "กรุณาสั่งซื้อสินค้ามากกว่า 1",
            "amount.integer" => "กรุณากรอกข้อมูลเป็นจำนวนเต็ม"
        ]
    );

        $this->updateLot($request->product_id, $request->amount);

        $carbon = Carbon::now();
        $customer = DB::table('customers')->where("user_id","=", Auth::user()->id)->first();
        $product = DB::table('products')->where('id', '=', $request->product_id)->first();
        $seller = DB::table('sellers')->first();

        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->product_id = $request->product_id ;
        $order->recv_name = $customer->name;
        $order->recv_address = $customer->address;
        $order->recv_tel = $customer->telephone;
        $order->amount = $request->amount;
        $order->price_per_unit = $product->price;
        $order->expired_at = $carbon->addDays(2);


        $order->save();
        return view("orders.success", ['order' => $order, 'product' => $product, 'seller' => $seller]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::check()) {
            return redirect()->route("login");
        }

        $order = DB::table('orders')->select("product_name",'orders.*')->where("orders.id","=",$id)->join('products', 'products.id', '=', "product_id")->first();
        if (Auth::user()->role == "seller") {
            $payment = DB::table('payments')->where('order_id','=',$id)->first();
            return view("orders.verifying",[
                'order' => $order,
                'payment' => $payment,
            ]);
        }
        return view("orders.inform",[
            'order' => $order
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
        $order = DB::table('orders')->select("product_name",'orders.*')->where("orders.id","=",$id)->join('products', 'products.id', '=', "product_id")->first();
        return view('orders.shipmentDetail',['order' => $order]);
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
        $request->validate([
            "inpImg" => "required",
            "bank_name" => 'required',
            'amount' => 'required|numeric'
        ],
        [
            "inpImg.required" => "กรุณาอัพโหลดหลักฐานการชำระเงิน",
            "bank_name.required" => "กรุณากรอกข้อมูล",
            "amount.required" => "กรุณากรอกข้อมูล",
            "amount.numeric" => "กรุณากรอกข้อมูล",

        ]);

        $payment = new Payment();
        $payment->order_id = $id;
        $img = $request->file('inpImg');
        $order = Order::findOrFail($id);
        $filename = $order->id . "." . $img->getClientOriginalExtension();
        $path = 'storage/pictures/orders';
        $img->move($path, $filename);
        DB::table('orders')->where('id','=', $order->id)->update([
            'img_path' => $path . "/" . $filename,
            'status' => 'verifying',
            "updated_at" => Carbon::now()

        ]);
        $payment->img_path = $path . "/" . $filename;
        $payment->amount = $request->input('amount');
        $payment->bank_name = $request->input('bank_name');
        $payment->user_id = Auth::user()->id;
        $payment->save();

        return redirect()->route('profile.index');
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

    public function updateLot($id, $amount){
        $lots = DB::table('lots')->where('product_id', '=', $id)->where('current_qty', '!=', 0)->orderBy('created_at')->get();
        $index = 0;

        while ($lots[$index]->current_qty < $amount) {
            DB::table('lots')->where("product_id", '=', $lots[$index]->product_id)->where('created_at', '=', $lots[$index]->created_at)
                    ->update([
                        'current_qty' => 0,
                        'updated_at' => Carbon::now()
                        ]);
            $index += 1;
        }

        $updateAmount = $lots[$index]->current_qty - $amount;
        DB::table('lots')->where("product_id", '=', $lots[$index]->product_id)->where('created_at', '=', $lots[$index]->created_at)
        ->update(['current_qty' => $updateAmount,
                        'updated_at' => Carbon::now()
        ]);
    }

    public function acceptPayment($id) {
        DB::table("orders")->where("id", '=', $id)->update([
            "status" => "verified",
            "updated_at" => Carbon::now()
        ]);

        return redirect()->route("profile.index");
    }

    public function rejectPayment($id, Request $request) {

        $request->validate([
            'comment' => 'required'
        ],[
            'comment.required' => "กรุณากรอกสาเหตุการปฏิเสธรายการสั่งซื้อนี้"
        ]);

        DB::table("orders")->where("id", '=', $id)->update([
            "status" => "cancelled",
            "updated_at" => Carbon::now()
        ]);
        $order = DB::table('orders')->where('id','=',$id)->first();
        $order->comment = $request->input('comment');
        $lot = DB::table('lots')->where('product_id','=',$order->product_id)->orderBy('current_qty','desc')
        ->first();
        $newLot = $lot->current_qty+$order->amount;
        DB::table('lots')->where('product_id','=',$order->product_id)->where('created_at','=',$lot->created_at)->update([
            'current_qty' => $newLot,
            "updated_at" => Carbon::now(),
        ]);
        return redirect()->route("profile.index");
    }

    public function updateShipment(Request $request, $id){
        $request->validate([
            'shipment_detail' => 'required'
        ],[
            'shipment_detail.required' => "กรุณากรอกข้อมูลการจัดส่ง"
        ]);
        DB::table("orders")->where("id", '=', $id)->update([
            "shipment_detail" => $request->shipment_detail,
            "status" => 'deliveried',
            "updated_at" => Carbon::now()
        ]);
        return redirect()->route('profile.index');
    }

    public function showOrderDetail($id){
        $order = DB::table('orders')->select("product_name",'orders.*')->where("orders.id","=",$id)->join('products', 'products.id', '=', "product_id")->first();
        return view('pages.orderDetail',['order' => $order]);
    }


}
