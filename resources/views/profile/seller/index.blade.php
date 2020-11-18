@extends('layouts.main')

@section('content')
<div class="container">
    <h1>ข้อมูลผู้ขาย</h1>
    <h1>{{$user->name}}</h1>
    <h1>{{$user->bank_name}}</h1>
    <h1>{{$user->bank_number}}</h1>
    <form action="{{route('profile.edit', ['profile'=>$user->user_id])}}">
        <button type="submit" class="btn btn-info">แก้ไขข้อมูลผู้ขาย</button>
    </form>
</div>
@endsection
