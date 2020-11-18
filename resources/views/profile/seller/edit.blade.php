@extends('layouts.main')

@section('content')
<div class="container">
    <h1>แก้ไขข้อมูลส่วนตัว</h1>
    <form action="{{route('profile.update', ['profile'=>$user->user_id])}}" method="post">
        @method('put')
        @csrf
        <div class="form-col">
            <div class="form-group col-md-4">
                <label for="name">ชื่อ</label>
                <input value="{{old('name', ($user->name))}}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="ชื่อ">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>กรุณากรอกข้อมูล</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="bank_name">ชื่อธนาคาร</label>
                <input value="{{old('bank_name', ($user->bank_name))}}" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" placeholder="ชื่อธนาคาร" type="text">
                @error('bank_name')
                <span class="invalid-feedback" role="alert">
                    <strong>กรุณากรอกข้อมูล</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="bank_number">หมายเลขบัญชีธนาคาร</label>
                <input value="{{old('bank_number', ($user->bank_number))}}" class="form-control @error('bank_number') is-invalid @enderror" id="bank_number" name="bank_number" placeholder="หมายเลขบัญชีธนาคาร">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>กรุณากรอกข้อมูล</strong>
                </span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success">ยืนยันการแก้ไข</button>
    </form>
</div>

@endsection
@section('script')
<script></script>
@endsection
