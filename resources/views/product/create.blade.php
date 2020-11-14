@extends('layouts.main')

@section('content')
<div class="">

  <h1 class>เพิ่มสินค้า</h1>

  <div class="d-flex">
    <div class="border-white" style="width: 18rem">
      <img class="card-img-top" src="https://scontent-sin6-2.xx.fbcdn.net/v/t1.0-9/51328971_1479556668841765_1729438228924071936_o.jpg?_nc_cat=110&ccb=2&_nc_sid=09cbfe&_nc_eui2=AeGChmM_29uz2_0Vuyrgd0kTjrJdQcSTzLmOsl1BxJPMuVbsc6QAhf9qXmKX_NXurXMLXfjrmOw4DcgYTb0Gh1rG&_nc_ohc=b9cLmp-qZd0AX9_E4rf&_nc_ht=scontent-sin6-2.xx&oh=09762d1d67b70e7d8dbe6fd6cd1d33ab&oe=5FD3B9F6">
    </div>

    <div class="container">
      <form enctype="multipart/form-data" style="width: 15vw" id="profile-form" action="" method=POST>
        @csrf

        <div class="my-1">
          <label>เลือกรูปสินค้า</label>
          <br>
          <input type="file" id="inpImg" name="inpImg" accept="image/png, image/jpeg" onchange="previewAvatar()">
        </div>

        <div class="my-1">
          <h4>ชื่อสินค้า: </h4>
          <input value="" name="new_name" class="form-control" id="changeName">
        </div>

        <div class="my-1">
          <h4>จำนวนที่เพิ่ม: </h4>
          <input value="" name="new_tel" class="form-control" id="changeTel" type='string' onkeyup="validateTelNumber(this)">
        </div>

        <button type="submit" class="btn btn-success my-3" href="">บันทึก</button>
      </form>
    </div>

  </div>
</div>
@endsection
