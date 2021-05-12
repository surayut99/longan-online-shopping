@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size:20px;font-weight: bold;">{{ __('เพิ่มข้อมูลการจัดส่ง') }}</div>
                <div class="card-body">
                    <h4>หมายเลขสั่งซื้อ: {{$order->id}}</h4>
                    <h4>ชื่อสินค้า: {{$order->product_name}}</h4>
                    <h4>ราคารวม: {{$order->amount*$order->price_per_unit}}</h4>
                    <hr>
                    <h3>ที่อยู่จัดส่ง</h3>
                    <h4>{{$order->recv_name}}</h4>
                    <h4>{{$order->recv_tel}}</h4>
                    <h4>{{$order->recv_address}}</h4>
                    <hr>
                    <h3>ข้อมูลการจัดส่ง</h3>
                    <form class="lg-space-b" method="POST" action="{{route('orders.update_shipment', ['id'=>$order->id])}}">
                        @method('put')
                        @csrf
                        <textarea class=" form-control @error('shipment_detail') is-invalid @enderror" name="shipment_detail" cols="90" rows="5" placeholder="ช่องทางการจัดส่ง, เลขพัสดุ"></textarea>
                        @error('shipment_detail')
                        <strong class="text-danger">{{$message}}</strong><br>
                        @enderror
                        <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
