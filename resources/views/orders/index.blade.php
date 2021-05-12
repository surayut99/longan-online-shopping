@extends('layouts.main')

@section('content')

<table class="table table-bordered table-striped">
    <thead>
        <tr class="text-center table-info">
            <th>หมายเลขสั่งซื้อ</th>
            <th>ชื่อสินค้า</th>
            <th>ราคาทั้งหมด (บาท)</th>
            <th>สถานะการสั่งซื้อ</th>
            <th>การดำเนินการ</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr class="text-center">
            <td>{{$order->id}}</td>
            <td>{{$order->product_name}}</td>
            <td>{{$order->amount*$order->price_per_unit}}</td>
            <td>
                <p class={{$status[$order->status] == "ยกเลิก" ? 'text-danger':''}}>{{$status[$order->status]}}</p>
                @if(\Carbon\Carbon::parse($order->expired_at)->lt(\Carbon\Carbon::now()) && $order->status == "purchasing")
                <br>
                <strong class="text-danger">
                    (คำสั่งซื้อหมดอายุแล้ว)
                </strong>
                @endif
            </td>
            <td>
                @if(Auth::user()->role=='seller')
                @if($order->status == "verifying")
                <a style="width: 200px" class="btn btn-info" href="{{route('orders.show', ['order' => $order->id])}}">แสดงรายละเอียด</a>
                @elseif(\Carbon\Carbon::parse($order->expired_at)->lt(\Carbon\Carbon::now()) && $order->status == "purchasing")
                <form action="{{route('orders.reject', ['id' => $order->id])}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn btn-danger" style="width: 200px">ยกเลิกคำสั่งซื้อ</button>
                </form>
                @elseif($order->status == "verified")
                <a style="width: 200px" class="btn btn-warning" href="{{route('orders.edit',['order'=>$order->id])}}">เพิ่มข้อมูลการจัดส่ง</a>
                @elseif($order->status == "deliveried")
                <strong>-</strong>
                @else
                -
                @endif
                @else
                @if($order->status == "purchasing" && \Carbon\Carbon::parse($order->expired_at)->greaterThan(\Carbon\Carbon::now())) <a style="width:200px" class="btn btn-primary" href="{{route("orders.show",["order" => $order->id])}}">แจ้งชำระเงิน</a>

                @else
                <a style="width:200px" class="btn btn-info" href="{{route("orders.show_detail",["id" => $order->id])}}">แสดงรายละเอียด</a>

                @endif
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
