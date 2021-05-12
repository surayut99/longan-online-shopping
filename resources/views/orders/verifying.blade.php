@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size:20px;font-weight: bold;">{{ __('การยืนยันการชำระเงิน') }}</div>
                <div class="card-body">

                    <h6>หลักฐานการชำระเงิน</h6>
                    <div class="mt-1 d-flex justify-content-around">
                        <img src="{{asset($order->img_path)}}" width="50%">

                        <div>
                            <h5>รายการสั่งซื้อที่: {{ $order->id}}</h5>
                            <h5>ชื่อสินค้า: {{ $order->product_name}}</h5>
                            <h5>จำนวน: {{ $order->amount }} กิโลกรัม</h5>
                            <h5>ราคาต่อหน่วย: {{$order->price_per_unit}} บาท</h5>
                            <h5>ราคาทั้งหมด: {{$order->price_per_unit * $order->amount}} บาท</h5>
                        </div>
                    </div>
                    <hr>
                    <div>

                        <hr>

                        <div>
                            <h6>สั่งซื้อเมื่อ: {{\Carbon\Carbon::parse($order->created_at)->timezone('Asia/Bangkok')->toDateTimeString()}}</h6>
                            <h6>ชำระเงินเมื่อ: {{\Carbon\Carbon::parse($order->updated_at)->timezone('Asia/Bangkok')->toDateTimeString()}}</h6>
                            <div class="card p-3 m-2">
                                <h5>ที่อยู่สำหรับจัดส่ง</h5>
                                <h6 style="color: #737373">ชื่อ: <span style="color: black">{{$order->recv_name}}</span> </h6>
                                <h6 style="color: #737373">เบอร์โทร: <span style="color: black"> {{$order->recv_tel}}</span> </h6>
                                <h6 style="color: #737373">ที่อยู่: <span style="color: #000000">{{$order->recv_address}}</span>
                                </h6>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex lg-space-r">
                        <form class action="{{ route("orders.accept", ["id" => $order->id])}}" METHOD="POST">
                            @method('put')
                            @csrf
                            <button type="submit" class="btn btn-success">ยืนยัน</button>
                        </form>

                        <button onclick="collapseDelOpt()" id="deleteOpt" class="btn btn-danger" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">ปฏิเสธ</button>
                    </div>
                    @error('comment')
                    <strong class="text-danger">{{$message}}</strong><br>
                    @enderror
                    <form id="collapseExample" class="mt-3 collapse" action="{{ route('orders.reject', ['id' => $order->id]) }}" method="POST">
                        @method('put')
                        @csrf
                        <label>คุณต้องการยกเลิกคำสั่งซื้อนี้หรือไม่</label>
                        <div>
                            <textarea name="comment" id="" cols="30" rows="3" palceholder="เหตุผลการปฏิเสธการสั่งซื้อ" class="@error('comment') is-invalid @enderror"></textarea><br>
                            <button type="submit" class="btn btn-danger">ใช่</button>
                            <button onclick="collapseDelOpt()" class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">ไม่</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset("storage/js/confirmCancel.js")}}"></script>
@endsection
