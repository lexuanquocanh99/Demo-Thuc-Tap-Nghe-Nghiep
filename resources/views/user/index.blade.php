@extends('user.layouts.master')
@section('title','HOA HONG MOBILE || NGƯỜI DÙNG')
@section('main-content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Bảng Quản Trị</h1>
    </div>

    <div class="row">
      @php
          $orders=DB::table('orders')->where('user_id',auth()->user()->id)->paginate(10);
      @endphp
      <!-- Order -->
      <div class="col-xl-12 col-lg-12">
        <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th>Mã đơn hàng</th>
              <th>Tên</th>
              <th>Email</th>
              <th>Số lượng</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>STT</th>
              <th>Mã đơn hàng</th>
              <th>Tên</th>
              <th>Email</th>
              <th>Số lượng</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
              <th>Hành động</th>
              </tr>
          </tfoot>
          <tbody>
            @if(count($orders)>0)
              @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{number_format($order->total_amount)}}₫</td>
                    <td>
                        @if($order->status=='new')
                          <span class="badge badge-primary">Mới</span>
                        @elseif($order->status=='process')
                          <span class="badge badge-warning">Đang Xử Lý</span>
                        @elseif($order->status=='delivered')
                          <span class="badge badge-success">Đã Vận Chuyển</span>
                        @else
                          <span class="badge badge-danger">Huỷ</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('user.order.show',$order->id)}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                        <form method="POST" action="{{route('user.order.delete',[$order->id])}}">
                          @csrf
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} data-toggle="tooltip" data-placement="bottom" title="Delete" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
              @endforeach
              @else
                <td colspan="8" class="text-center"><h4 class="my-4">Không tìm thấy bất kỳ đơn hàng nào!!!</h4></td>
              @endif
          </tbody>
        </table>

        {{$orders->links()}}
      </div>
    </div>

  </div>
@endsection
