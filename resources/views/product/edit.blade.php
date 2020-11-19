@extends('layouts.main')

@section('content')
<div class="">

  <h1 class>แก้ไขสินค้า</h1>

  <div class="d-flex">
    <div class="border-white" style="width: 18rem">
      <img class="card-img-top" id="preImg" src="{{asset($product->product_img_path)}}">
    </div>

    <div class="ml-5">
      <form enctype="multipart/form-data" id="profile-form" action="{{route('products.update', ["product" => $product->id])}}" method='post'>
        @method('put')
        @csrf

        <div class="my-1">
          <strong>เลือกรูปสินค้า</strong>
          <div class="form-row">
            <input value="{{old('inpImg')}}" type="file" id="inpImg" name="inpImg" accept="image/png, image/jpeg">
          </div>

          <div class="mt-1">
            @error('inpImg')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
          </div>
        </div>

        <div class="my-1">
          <strong>ชื่อสินค้า: </strong>
          <div class="form-row">
            <input value="{{old('name', ($product->product_name))}}" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
          </div>

          <div class="mt-1">
            @error('name')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
          </div>
        </div>

        <div class="my-1">
          <strong>ราคาต่อหน่วย: </strong>
          <div class="form-row">
            <input value="{{old('price', ($product->price))}}" name="price" class="form-control @error('price') is-invalid @enderror" style="width: 5em" id="price">
            <label class="ml-2 pt-1">บาท/กิโลกรัม</label>
          </div>

          <div class="mt-1">
            @error('price')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
          </div>
        </div>

        <hr>
        @if($updated)
        <div class="mt-3">
          <h6>คุณได้เพิ่มล็อตสินค้านี้ไปแล้ว</h6>
        </div>
        @else

        <div hidden class="my-1">
          <input value="{{old('toggleValue', 'false')}}" . name="toggleValue" class="form-control @error('toggleValue') is-invalid @enderror" style="width: 5em" id="toggleValue">
        </div>

        <div class="form-check mt-2 mb-4">
          <input class="form-check-input" type="checkbox" id="addLot">
          <strong class="form-check-label" for="addLot">
            เพิ่มล็อทสินค้า
          </strong>
        </div>

        <div class="my-1">
          <strong>จำนวนที่เพิ่ม: </strong>
          <div class="form-row">
            <input value="{{old('qty')}}" name="qty" class="form-control @error('qty') is-invalid @enderror" style="width: 5em" id="qty" disabled>
            <label class="ml-2 pt-1">กิโลกรัม</label>
          </div>

          <div class="mt-1">
            @error('qty')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
          </div>
        </div>
        @endif

        <div class="lg-space-p mt-2">
          <p>จำนวนปัจจุบัน: {{$product->total}} กิโลกรัม</p>
          <p>อัพเดทล่าสุดเมื่อ: {{$product->lastest_at}}</p>
        </div>


        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-success my-3 " href="">บันทึก</button>
          {{-- <button id="deleteOpt" class="btn btn-danger my-3" type="button" data-toggle="collapse" data-target="#collapseDelOpt" aria-expanded="false" aria-controls="collapseDelOpt">ลบสินค้า</button> --}}
        </div>
      </form>

      <form id="collapseDelOpt" class="mt-3 collapse" action="" method="POST">
        @method('delete')
        @csrf
        <label>คุณต้องการลบสินค้านี้ใช่หรือไม่</label>
        <div>
          <button type="submit" class="btn btn-danger">ใช่</button>
          <button id="cancelOpt" class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseDelOpt" aria-expanded="false" aria-controls="collapseDelOpt">ไม่</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{asset('storage/js/previewInpImg.js')}}"></script>
<script src="{{asset('storage/js/editProduct.js')}}"></script>
<script src="{{asset('storage/js/toggleAddLot.js')}}"></script>
@endsection
