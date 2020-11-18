@extends('layouts.main')

@section('content')
<div class="container">
    <h1>ข้อมูลผู้ใช้</h1>
    <h1>{{$user->name}}</h1>
    <h1>{{$user->telephone}}</h1>
    <h1>{{$user->address}}</h1>
    <form action="{{route('profile.edit', ['profile'=>$user->user_id])}}">
        <button type="submit" class="btn btn-info">แก้ไขข้อมูลผู้ใช้</button>
    </form>
</div>
@endsection
