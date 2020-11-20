@extends('layouts.main')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header" style="font-size:20px;font-weight: bold;">{{ __('สั่งซื้อสำเร็จ') }}</div>
        <div class="card-body">

          <div class="d-flex justify-content-around">
            <div class="mt-1">
              <img src="{{asset($product->product_img_path)}}" height="150px">
            </div>

            <div>
              <h5>ชื่อสินค้า: {{ $product->product_name}}</h5>
              <h5>จำนวน: {{ $order->amount }} กิโลกรัม</h5>
              <h5>ราคาต่อหน่วย: {{$order->price_per_unit}} บาท</h5>
              <h5>ราคาทั้งหมด: {{$order->price_per_unit * $order->amount}} บาท</h5>
            </div>
          </div>

          <hr>

          <h4>ช่องทางการชำระเงินผ่านธนาคาร</h4>
          <div class="card p-3 m-2">
            <h5>ชื่อบัญชี: {{$seller->name}}</h5>
            <h5>ธนาคาร: {{$seller->bank_name}}</h5>
            <h5>เลขบัญชี: {{$seller->bank_number}}</h5>
          </div>

          <hr>

          <div>
            <h6>สั่งซื้อเมื่อ: {{\Carbon\Carbon::parse($order->created_at)->timezone('Asia/Bangkok')->toDateTimeString()}}</h6>
            <h6>สิ้นสุดการชำระเงินเมื่อ: {{\Carbon\Carbon::parse($order->expired_at)->timezone('Asia/Bangkok')->toDateTimeString()}}</h6>
            <div class="card p-3 m-2">
              <h5>ที่อยู่สำหรับจัดส่ง</h5>
              <h6 style="color: #737373">ชื่อ: <span style="color: black">{{$order->recv_name}}</span> </h6>
              <h6 style="color: #737373">เบอร์โทร: <span style="color: black"> {{$order->recv_tel}}</span> </h6>
              <h6 style="color: #737373">ที่อยู่: <span style="color: #000000">{{$order->recv_address}}</span>
              </h6>
            </div>
          </div>

          <a class="btn btn-success text-center" href="{{route('profile.index')}}">ดูรายการสั่งซื้อ</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{asset('storage/js/previewInpImg.js')}}"></script>
@endsection
