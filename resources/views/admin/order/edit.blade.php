@extends('admin.layouts.master')
@section('title','HOA HONG MOBILE || CHỈNH SỬA ĐƠN HÀNG')
@section('main-content')
    <div class="card">
        <h5 class="card-header">Chỉnh Sửa Đơn Hàng</h5>
        <div class="card-body">
            <form action="{{route('order.update',$order->id)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="status">Trạng Thái :</label>
                    <select name="status" id="" class="form-control">
                        <option value="">--Chọn Trạng Thái--</option>
                        <option value="new" {{(($order->status=='new')? 'selected' : '')}}>Mới</option>
                        <option value="process" {{(($order->status=='process')? 'selected' : '')}}>Đang Xử Lý</option>
                        <option value="delivered" {{(($order->status=='delivered')? 'selected' : '')}}>Đã Vận Chuyển</option>
                        <option value="cancel" {{(($order->status=='cancel')? 'selected' : '')}}>Huỷ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="payment_status">Trạng Thái :</label>
                    <select name="payment_status" id="" class="form-control">
                        <option value="">--Chọn Trạng Thái--</option>
                        <option value="paid" {{(($order->payment_status=='paid')? 'selected' : '')}}>Đã thanh toán</option>
                        <option value="unpaid" {{(($order->payment_status=='unpaid')? 'selected' : '')}}>Chưa thanh toán</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Cập Nhập</button>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .order-info,.shipping-info{
            background:#ECECEC;
            padding:20px;
        }
        .order-info h4,.shipping-info h4{
            text-decoration: underline;
        }

    </style>
@endpush
