@extends('layouts.main')

@section('content')
<div class="container">
    <h1>ประวัติส่วนตัว</h1>
    @if(Auth::user()->role=='customer')
    <h1>{{$user->name}}</h1>
    <h1>{{$user->telephone}}</h1>
    <h1>{{$user->address}}</h1>
    @else
    <h1>{{$user->name}}</h1>
    <h1>{{$user->bank_name}}</h1>
    <h1>{{$user->bank_number}}</h1>
    @endif
    <form action="{{route('profile.edit', ['profile'=>$user->user_id])}}">
        <button type="submit" class="btn btn-info">แก้ไขข้อมูลส่วนตัว</button>
    </form>
</div>
@endsection
