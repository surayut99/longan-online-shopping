@extends('layouts.main')

@section('content')
<div class="">
    <h1>รายงานการเคลื่อนไหวสินค้าประจำสัปดาห์</h1>
    <table class="table table-bordered">
        <thead class="text-center table-warning">
            <tr>
                <th>วันที่นำเข้า</th>
                <th>ชื่อสินค้า</th>
                <th>จำนวนที่นำเข้า</th>
                <th>จำนวนที่ขายออก</th>
                <th>จำนวนที่คงเหลือ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lots as $lot)
            <tr>
                <td>{{$lot->created_at}}</td>
                <td>{{$lot->product_name}}</td>
                <td>{{$lot->added}}</td>
                <td>{{$lot->curr}}</td>
                <td>{{$lot->added - $lot->curr}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
