@extends('layouts.main')

@section('content')
<div class="container">

    <h1 class="text-center">สินค้าสำหรับคุณ</h1>

    <div>
        <div class="my-3 d-flex lg-flex lg-space-r">
            @foreach($products as $product)
            <div class="card my-3" style="width: 15rem">
                <div style="height: 15rem;" class="lg-fill">
                    <img class="lg-img" src="{{asset($product->product_img_path)}}">
                </div>
                <div class="card-body lg-space-p">
                    <h3 class="card-title">{{ $product->product_name }}</h3>
                    <p class="">ราคา: {{ $product->price }} บาท/กิโลกรัม</p>
                    <p class="">คงเหลือทั้งหมด: {{$product->total}} กิโลกรัม</p>
                    @if(Auth::check() && Auth::user()->role == 'customer')
                    <a href="" class="btn btn-primary">สั่งซื้อเลย</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
