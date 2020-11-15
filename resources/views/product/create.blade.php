@extends('layouts.main')

@section('content')
<div class="">

  <h1 class>เพิ่มสินค้า</h1>

  <div class="d-flex mt-5">
    <div class="border-white" style="width: 18rem">
      <img class="card-img-top" id="preImg" src="{{asset("storage/pictures/icons/default_product.jpg")}}">
    </div>

    <div class="ml-5">
      <div class="ml-3">
        <form enctype="multipart/form-data" style="" id="profile-form" action="{{route('products.store')}}" method=POST>
          @csrf

          <div class="my-1">
            <h4>เลือกรูปสินค้า</h4>
            <div class="form-row">
              <input type="file" id="inpImg" name="inpImg" accept="image/png, image/jpeg">
            </div>
            @error('inpImg')
            <p class="text-danger">กรุณาอัพโหลดรูปสินค้า</p>
            @enderror
          </div>


          <div class="my-1">
            <h4>ชื่อสินค้า: </h4>
            <div class="form-row">
              <input value="" name="name" class="form-control" id="name">
            </div>
            @error('name')
            <p class="text-danger">กรุณากรอกชื่อสินค้า</p>
            @enderror
          </div>

          <div class="my-1">
            <h4>ราคาต่อหน่วย: </h4>
            <div class="form-row">
              <input value="" name="price" class="form-control" style="width: 5em" id="price">
              <label class="ml-2 pt-1">บาท/กิโลกรัม</label>
            </div>
            @error('qty')
            <p class="text-danger">กรุณากรอกราคาสินค้า</p>
            @enderror
          </div>

          <div class="my-1">
            <h4>จำนวนที่เพิ่ม: </h4>
            <div class="form-row">
              <input value="" name="qty" class="form-control" style="width: 5em" id="qty">
              <label class="ml-2 pt-1">กิโลกรัม</label>
            </div>
            @error('qty')
            <p class="text-danger">กรุณากรอกจำนวนสินค้า</p>
            @enderror
          </div>

          <button type="submit" class="btn btn-success my-3" href="">บันทึก</button>
        </form>

      </div>
    </div>

  </div>
</div>
@endsection

@section('script')
<script src="{{asset('storage/js/previewInpImg.js')}}"></script>
@endsection
