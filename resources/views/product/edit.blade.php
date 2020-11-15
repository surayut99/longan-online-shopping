@extends('layouts.main')

@section('content')
<div class="">

  <h1 class>แก้ไขสินค้า</h1>

  <div class="d-flex">
    <div class="border-white" style="width: 18rem">
      <img class="card-img-top" id="preImg" src="{{asset($product->product_img_path)}}">
    </div>

    <div class="ml-5">
      <form enctype="multipart/form-data" style="" id="profile-form" action="" method=POST>
        @csrf

        <div class="my-1">
          <h4>เลือกรูปสินค้า</h4>
          <div class="form-row">
            <input value="{{old('inpImg')}}" type="file" id="inpImg" name="inpImg" accept="image/png, image/jpeg">
          </div>
        </div>

        <div class="my-1">
          <h4>ชื่อสินค้า: </h4>
          <div class="form-row">
            <input value="{{$product->product_name}}" name="name" class="form-control" id="name">
          </div>
        </div>

        <div class="my-1">
          <h4>ราคาต่อหน่วย: </h4>
          <div class="form-row">
            <input value="{{$product->price}}" name="price" class="form-control" style="width: 5em" id="price">
            <label class="ml-2 pt-1">บาท/กิโลกรัม</label>
          </div>
        </div>

        @if($updated)
        <div class="mt-3">
          <h6>คุณได้เพิ่มล็อตสินค้านี้ไปแล้ว</h6>
        </div>
        @else
        <div class="my-1">
          <h4>จำนวนที่เพิ่ม: </h4>
          <div class="form-row">
            <input value="{{old('qty')}}" name="qty" class="form-control" style="width: 5em" id="qty">
            <label class="ml-2 pt-1">กิโลกรัม</label>
          </div>
        </div>
        @endif

        <div class="lg-space-p mt-2">
          <p>จำนวนปัจจุบัน: {{$product->total}} กิโลกรัม</p>
          <p>อัพเดทล่าสุดเมื่อ: {{$product->lastest_at}}</p>
        </div>


        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-success my-3 " href="">บันทึก</button>
          <button id="deleteOpt" class="btn btn-danger my-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">ลบสินค้า</button>
        </div>
      </form>

      <form id="collapseExample" class="mt-3 collapse" action="" method="POST">
        @method('delete')
        @csrf
        <label>คุณต้องการลบสินค้านี้ใช่หรือไม่</label>
        <div>
          <button type="submit" class="btn btn-danger">ใช่</button>
          <button id="cancelOpt" class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">ไม่</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{asset('storage/js/previewInpImg.js')}}"></script>
<script src="{{asset('storage/js/editProduct.js')}}"></script>
@endsection
