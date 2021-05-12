@extends('layouts.main')
@section('content')
<div class="container">
    @if(Auth::check() && Auth::user()->role == 'seller')
    <h1 class>รายการสินค้าทั้งหมด</h1>
    <a href="{{route('products.create')}}" class="btn btn-primary">เพิ่มสินค้า</a>
    @elseif (Auth::check() && Auth::user()->role == 'customer')
    <h1 class="text-center">สินค้าสำหรับคุณ</h1>
    @endif
    <div>
        <div class="my-3 d-flex lg-flex lg-space-r">
            @foreach($products as $product)
            <div class="card my-3" style="width: 15rem">
                <div style="height: 15rem;" class="lg-fill text-center pt-3">
                    <img class="lg-img" src="{{asset($product->product_img_path)}}" style="object-fit: cover;width:200px;height:200px">
                </div>
                <div class="card-body lg-space-p">
                    <h3 class="card-title shrink-text">{{ $product->product_name }}</h3>
                    <p class="">ราคา: {{ $product->price }} บาท/กิโลกรัม</p>
                    <p class="">คงเหลือทั้งหมด: {{$product->total}} กิโลกรัม</p>
                    <p class="">แก้ไขเมื่อ: <br> {{\Carbon\Carbon::parse($product->lastest_at)->timezone('Asia/Bangkok')->toDateTimeString()}}</p>
                    @if(Auth::check() && Auth::user()->role == 'seller')
                    <a href="{{route('products.edit', ['product' => $product->id])}}" class="btn btn-warning">แก้ไข</a>
                    @elseif (Auth::check() && Auth::user()->role == 'customer')
                    <a href="{{route('products.show',['product'=>$product->id])}}" class="btn btn-primary">รายละเอียดสินค้า</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
