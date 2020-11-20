<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\User;
use App\Rules\BankNumberRule;
use App\Rules\TelNumberRule;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileContoller extends Controller
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

            return view("profile.customer.index", [
                "user" => $user,
                "orders" => $orders,
                "status" => $status
            ]);
        }

        $user = DB::table('sellers')->where('user_id', '=', Auth::user()->id)->first();
        $orders = DB::table('orders')->select("product_name",'orders.*')->join('products', 'products.id', '=', 'product_id')->orderBy("orders.created_at")->get();
        return view("profile.seller.index", [
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
        //
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
        if(Auth::user()->role == 'customer'){
            $user = DB::table('customers')->where('user_id', '=', $id)->first();
            return view("profile.customer.edit", [
                "user" => $user
            ]);
        }
        else{
            $user = DB::table('sellers')->where('user_id', '=', $id)->first();
            return view("profile.seller.edit", [
                "user" => $user
            ]);
        }
        // return redirect()->route('pages.edit-profile');
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
        if(Auth::user()->role == 'customer'){
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'telephone' => ['required', new TelNumberRule],
            ]);
           Customer::where('user_id', '=', $id)->update([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'telephone' => $request->input('telephone'),
            ]);
        }
        else{
            $request->validate([
                'name' => 'required',
                'bank_name' => ['required', 'max:50'],
                'bank_number' => ['required', new BankNumberRule],
            ]);
            Seller::where('user_id', '=', $id)->update([
                'name' => $request->input('name'),
                'bank_name' => $request->input('bank_name'),
                'bank_number' => $request->input('bank_number')
            ]);
        }
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
}
