@extends('layouts.main')

@section('content')
<div class="">
    @foreach($cart as $c)
    <h1>{{$c}}</h1>
    @endforeach

</div>
@endsection
