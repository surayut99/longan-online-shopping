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
                    <form action="{{ route('upload_payment',['order_id'=>$order->id])}}" METHOD="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="my-2 mb-4">
                            <input type="file" id="inpImg" name="inpImg" accept="image/png, image/jpeg" onchange="previewAvatar()">
                            {{-- @error('inpImg')
                        <div class="mt-2">
                            <p class="text-danger">กรุณาใส่รูปสินค้า</p>
                        </div>
                        @enderror --}}
                        </div>
                        <hr>
                        <div>
                            <h4>ชื่อสินค้า: {{$order->product_name}}</h4>
                            <h4>จำนวน: {{$order->amount}} กิโลกรัม</h4>
                            <h4>ราคาทั้งหมด: {{$order->amount*$order->price_per_unit}} บาท</h4>
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
