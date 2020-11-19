@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size:20px;font-weight: bold;">{{ __('รายละเอียดคำสั่งซื้อ') }}</div>
                <div class="card-body">
                    <div class="col-md-6">
                        <img class="mb-2" style="width:200px" src="{{asset("$product->product_img_path")}}" alt="">
                    </div>
                    <div class="col-md-6">
                        <h4 style="color:blue">ชื่อสินค้า: {{$product->product_name}}</h4>
                    </div>
                    <div class="col-md-6">
                        <h4>ราคาต่อกิโลกรัม: {{$product->price}} บาท</h4>
                    </div>
                    <div class="col-md-6">
                        <h4 style="color:red">จำนวนคงเหลือ: {{$lot->current_qty}} กิโลกรัม</h4>
                    </div>
                    <form method="POST" action="{{route("create_order",["product_id"=>$product->id])}}">
                        @csrf
                        <div class="col-md-12">
                            <h4>จำนวนที่ต้องการ: <input name="amount" style="width:200px" type="number" placeholder="จำนวน"> กิโลกรัม</h4>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">ยืนยันคำสั่งซื้อ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
