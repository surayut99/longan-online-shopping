@extends('layouts.main')

@section('content')
<div class="container">
  <h1>แก้ไขข้อมูลส่วนตัว</h1>
  <form action="{{route('profile.update', ['profile'=>$user->user_id])}}" method="post">
    @method('put')
    @csrf
    <div class="form-col">
      <div class="form-group col-md-4">
        <strong for="name">ชื่อ</strong>
        <input value="{{old('name', ($user->name))}}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="ชื่อ">
        @error('name')
        <span class="invalid-feedback" role="alert">
          <strong>กรุณากรอกข้อมูล</strong>
        </span>
        @enderror
      </div>
      <div class="form-group col-md-4">
        <strong for="telephone">เบอร์โทรศัพท์</strong>
        <input value="{{old('telephone', $user->telephone)}}" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" placeholder="เบอร์โทรศัพท์">
        @error('telephone')
        <span class="invalid-feedback" role="alert">
          <strong>กรุณากรอกข้อมูล</strong>
        </span>
        @enderror
      </div>
      <div class="form-group col-md-4">
        <strong for="address">ที่อยู่สำหรับจัดส่ง</strong>
        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="ที่อยู่สำหรับจัดส่ง">
        {{old('address', ($user->address))}}
        </textarea>
        @error('address')
        <span class="invalid-feedback" role="alert">
          <strong>กรุณากรอกข้อมูล</strong>
        </span>
        @enderror
      </div>
    </div>
    <button type="submit" class="btn btn-success">บันทึก</button>
  </form>
</div>

@endsection
@section('script')
<script></script>
@endsection
