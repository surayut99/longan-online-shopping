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
            <div class="mt-1">
              @error('inpImg')
              <strong class="text-danger">{{$message}}</strong>
              @enderror
            </div>
          </div>


          <div class="my-1">
            <h4>ชื่อสินค้า: </h4>
            <div class="form-row">
              <input value="{{old('name')}}" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
            </div>
            <div class="mt-1">
              @error('name')
              <strong class="text-danger">{{$message}}</strong>
              @enderror
            </div>
          </div>

          <div class="my-1">
            <h4>ราคาต่อหน่วย: </h4>
            <div class="form-row">
              <input value="{{old('price')}}" name="price" class="form-control @error('price') is-invalid @enderror" style="width: 5em" id="price">
              <label class="ml-2 pt-1">บาท/กิโลกรัม</label>
            </div>
            <div class="mt-1">
              @error('price')
              <strong class="text-danger">{{$message}}</strong>
              @enderror
            </div>
          </div>

          <div class="my-1">
            <h4>จำนวนที่เพิ่ม: </h4>
            <div class="form-row">
              <input value="{{old('qty')}}" name="qty" class="form-control @error('qty') is-invalid @enderror" style="width: 5em" id="qty">
              <label class="ml-2 pt-1">กิโลกรัม</label>
            </div>
            <div class="mt-1">
              @error('qty')
              <strong class="text-danger">{{$message}}</strong>
              @enderror
            </div>
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
