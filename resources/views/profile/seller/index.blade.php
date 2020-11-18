@extends('layouts.main')

@section('content')
<div class="container">
    <h1>ข้อมูลผู้ขาย</h1>
    <h4>ชื่อ: {{$user->name}}</h4>
    <h4>ธนาคาร: {{$user->bank_name}}</h4>
    <h4>เลขบัญชี: {{$user->bank_number}}</h4>
    <a class="btn btn-warning" href="{{route('profile.edit', ['profile'=>$user->user_id])}}">แก้ไขข้อมูลผู้ขาย</a>
</div>
@endsection
