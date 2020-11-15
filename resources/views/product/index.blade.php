@extends('layouts.main')

@section('content')

<div>

  <h1 class>รายการสินค้าทั้งหมด</h1>

  <button class="btn btn-primary">เพิ่มสินค้า</button>

  <div class="my-3 d-flex">
    {{-- loop for showing products --}}
    <div class="card" style="width: 15rem;">
      <img class="card-img-top" src="https://scontent-sin6-2.xx.fbcdn.net/v/t1.0-9/51328971_1479556668841765_1729438228924071936_o.jpg?_nc_cat=110&ccb=2&_nc_sid=09cbfe&_nc_eui2=AeGChmM_29uz2_0Vuyrgd0kTjrJdQcSTzLmOsl1BxJPMuVbsc6QAhf9qXmKX_NXurXMLXfjrmOw4DcgYTb0Gh1rG&_nc_ohc=b9cLmp-qZd0AX9_E4rf&_nc_ht=scontent-sin6-2.xx&oh=09762d1d67b70e7d8dbe6fd6cd1d33ab&oe=5FD3B9F6">
      <div class="card-body lg-space-p">
        <h3 class="card-title">ชื่อสินค้า</h3>
        <p class="">ราคา: บาท/กิโลกรัม</p>
        <p class="">คงเหลือ: กิโลกรัม</p>
        <p class="">แก้ไขเมื่อ: </p>
        <a href="#" class="btn btn-warning">แก้ไข</a>
      </div>
    </div>
  </div>
</div>

@endsection
