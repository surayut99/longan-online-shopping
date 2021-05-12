@extends('layouts.main')

@section('content')
<div class="container">
    <div class="mt-2 col-md-6">
        <h1>ข้อมูลผู้ขาย</h1>
        <h5>ชื่อ: {{$user->name}}</h5>
        <h5>ธนาคาร: {{$user->bank_name}}</h5>
        <h5>เลขบัญชี: {{$user->bank_number}} </h5>
    </div>

    <div class="col-md-12 mt-4">

        <div class="card">
            <div class="card-header" style="font-size:20px;font-weight: bold;">{{ __('รายการสั่งซื้อทั้งหมด') }}</div>
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
                            @if(\Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($order->expired_at))) && $order->status == "purchasing")
                            <br>
                            <strong class="text-danger">
                                (คำสั่งซื้อหมดอายุแล้ว)
                            </strong>
                            @endif
                        </td>
                        <td>
                            @if($order->status == "verifying")
                            <a class="btn btn-info" href="{{route('orders.show', ['order' => $order->id])}}">แสดงรายละเอียด</a>
                            @elseif(\Carbon\Carbon::parse($order->expired_at)->greaterThan(\Carbon\Carbon::now()) && $order->status == "purchasing")
                            <form action="{{route('orders.reject', ['id' => $order->id])}}" method="POST">
                                @method('put')
                                @csrf
                                <button type="submit" class="btn btn-danger">ยกเลิกคำสั่งซื้อ</button>

                            </form>
                            @elseif($order->status == "verified")
                            <a class="btn btn-warning" href="{{route('orders.edit',['order'=>$order->id])}}">เพิ่มข้อมูลการจัดส่ง</a>
                            @elseif($order->status == "deliveried")
                            <strong>-</strong>
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
