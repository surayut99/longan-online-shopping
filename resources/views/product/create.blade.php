@extends('layouts.main')

@section('content')
<div class="">

  <h1 class>เพิ่มสินค้า</h1>

  <div class="d-flex">
    <div class="border-white" style="width: 18rem">
      <img class="card-img-top" id="preImg" src="https://scontent-sin6-2.xx.fbcdn.net/v/t1.0-9/51328971_1479556668841765_1729438228924071936_o.jpg?_nc_cat=110&ccb=2&_nc_sid=09cbfe&_nc_eui2=AeGChmM_29uz2_0Vuyrgd0kTjrJdQcSTzLmOsl1BxJPMuVbsc6QAhf9qXmKX_NXurXMLXfjrmOw4DcgYTb0Gh1rG&_nc_ohc=b9cLmp-qZd0AX9_E4rf&_nc_ht=scontent-sin6-2.xx&oh=09762d1d67b70e7d8dbe6fd6cd1d33ab&oe=5FD3B9F6">
    </div>

    <div class="ml-3">
      <div class="ml-3">
        <form enctype="multipart/form-data" style="" id="profile-form" action="" method=POST>
          @csrf

          <div class="my-1">
            <h4>เลือกรูปสินค้า</h4>
            <div class="form-row">
              <input type="file" id="inpImg" name="inpImg" accept="image/png, image/jpeg">
            </div>
          </div>

          <div class="my-1">
            <h4>ชื่อสินค้า: </h4>
            <div class="form-row">
              <input value="" name="name" class="form-control" id="changeName">
            </div>
          </div>

          <div class="my-1">
            <h4>ราคาต่อหน่วย: </h4>
            <div class="form-row">
              <input value="" name="price" class="form-control" style="width: 5em" id="changeName">
              <label class="ml-2 pt-1">บาท/กิโลกรัม</label>
            </div>
          </div>

          <div class="my-1">
            <h4>จำนวนที่เพิ่ม: </h4>
            <div class="form-row">
              <input value="" name="qty" class="form-control" style="width: 5em" id="changeName">
              <label class="ml-2 pt-1">กิโลกรัม</label>
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
