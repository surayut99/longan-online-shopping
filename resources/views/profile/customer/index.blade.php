@extends('layouts.main')

@section('content')
<div class="container ">

  <div class="mt-2 col-md-6">
    <h1>ข้อมูลผู้ใช้</h1>
    <h5>ชื่อ: {{$user->name}}</h5>
    <h5>เบอร์โทรศัพท์: {{$user->telephone}}</h5>
    <h5>ที่อยู่: {{$user->address}}</h5>
    <a class="btn btn-warning" href="{{route('profile.edit', ['profile'=>$user->user_id])}}">แก้ไขข้อมูลผู้ใช้</a>
  </div>
  <div class="col-md-12 mt-4">
    <div class="card">
      <div class="card-header" style="font-size:20px;font-weight: bold;">{{ __('รายการสั่งซื้อทั้งหมด') }}</div>
      <table class="table table-bordered table-striped">
        <thead>
          <tr class="text-center table-info">
            <th>ชื่อสินค้า</th>
            <th>จำนวนที่สั่ง (กิโลกรัม)</th>
            <th>ราคาต่อหน่วย (บาท)</th>
            <th>ราคาทั้งหมด (บาท)</th>
            <th>รายละเอียดการจัดส่ง</th>
            <th>สถานะการสั่งซื้อ</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr class="text-center">
            <td>{{$order->product_name}}</td>
            <td>{{$order->amount}}</td>
            <td>{{$order->price_per_unit}}</td>
            <td>{{$order->amount*$order->price_per_unit}}</td>
            <td>
              @if($order->shipment_detail)
              {{$order->shipment_detail}}
              @else -
              @endif
            </td>
            <td>
              @if($order->status != "purchasing") {{$status[$order->status]}}
              @else <a class="btn btn-primary" href="{{route("orders.show",["order" => $order->id])}}">แจ้งชำระเงิน</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
