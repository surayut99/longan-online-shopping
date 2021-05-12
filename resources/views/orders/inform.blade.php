@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size:20px;font-weight: bold;">{{ __('แจ้งหลักฐานการชำระเงิน') }}</div>
                <div class="card-body">


                    <h6>รูปหลักฐานการชำระเงิน:</h6>
                    <div class="mt-1">
                        <img id="preImg" name="preImg" src="" height="150">
                    </div>
                    <form action="{{ route('orders.update',["order" =>$order->id])}}" METHOD="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="my-2 mb-4">
                            <input type="file" id="inpImg" name="inpImg" accept="image/png, image/jpeg" onchange="previewAvatar()">
                            <input type="text" placeholder="ชื่อธนาคาร" name="bank_name">
                            <input type="text" placeholder="จำนวนเงิน" name="amount">
                            @error('inpImg')
                            <div class="mt-2">
                                <strong class="text-danger">{{$message}}</strong>
                            </div>
                            @enderror
                            @error('bank_name')
                            <div class="mt-2">
                                <strong class="text-danger">{{$message}}</strong>
                            </div>
                            @enderror
                            @error('amount')
                            <div class="mt-2">
                                <strong class="text-danger">{{$message}}</strong>
                            </div>
                            @enderror
                        </div>
                        <hr>
                        <div>
                            <div>
                                <h5>รายการสั่งซื้อที่: {{ $order->id}}</h5>
                                <h5>ชื่อสินค้า: {{ $order->product_name}}</h5>
                                <h5>จำนวน: {{ $order->amount }} กิโลกรัม</h5>
                                <h5>ราคาต่อหน่วย: {{$order->price_per_unit}} บาท</h5>
                                <h5>ราคาทั้งหมด: {{$order->price_per_unit * $order->amount}} บาท</h5>
                                <hr>
                                <h5>วันที่สั่ง {{\Carbon\Carbon::parse($order->created_at)->timezone('Asia/Bangkok')}}</h5>
                                <h5>วันสิ้นสุดการชำระเงิน {{\Carbon\Carbon::parse($order->expired_at)->timezone('Asia/Bangkok')}}</h5>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">อัพโหลด</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('storage/js/previewInpImg.js')}}"></script>
@endsection
