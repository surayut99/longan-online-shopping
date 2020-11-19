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

          <form method="POST" action="{{route("orders.store")}}">
            @csrf
            <div hidden>
              <input value="{{ $product->id }}" type="text" name="product_id" id="">
              <input value="{{ $product->price }}" type="text" name="price_per_unit" id="">
              <input value="{{ $lot->current_qty }}" type="text" name="qty" id="">
            </div>
            <div class="">
              <h4 style="color:blue">ชื่อสินค้า: {{$product->product_name}}</h4>
            </div>
            <div class="">
              <h4>ราคาต่อกิโลกรัม: {{$product->price}} บาท</h4>
            </div>
            <div class="">
              <h4 style="color:red">จำนวนคงเหลือ: {{$lot->current_qty}} กิโลกรัม</h4>
            </div>
            <div class="">
              <h4>จำนวนที่ต้องการ:</h4>
              <div class="row mb-3">
                <input name="amount" class="mx-3 form-control @error('amount') is-invalid @enderror" style="width:200px" type="" placeholder="จำนวน">
                <h4>
                  กิโลกรัม
                </h4>
              </div>

              @error('amount')
              <strong class="text-danger">{{$message}}</strong>
              @enderror
            </div>
            <div class="mt-2">
              <button type="submit" class="btn btn-success">ยืนยันคำสั่งซื้อ</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
