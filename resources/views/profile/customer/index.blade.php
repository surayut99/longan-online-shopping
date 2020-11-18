@extends('layouts.main')

@section('content')
<div class="container">
    <h1>ข้อมูลผู้ใช้</h1>
    <div class="mt-5 ">
        <h4>ชื่อ: {{$user->name}}</h4>
        <h4>เบอร์โทรศัพท์: {{$user->telephone}}</h4>
        <h4>ที่อยู่: {{$user->address}}</h4>
    </div>
    <a class="btn btn-warning" href="{{route('profile.edit', ['profile'=>$user->user_id])}}">แก้ไขข้อมูลผู้ใช้</a>
</div>
@endsection
