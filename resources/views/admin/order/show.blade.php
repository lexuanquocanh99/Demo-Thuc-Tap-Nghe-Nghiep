@extends('admin.layouts.master')
@section('title','HOA HONG MOBILE || CHI TIẾT ĐƠN HÀNG')
@section('main-content')
    <div class="card">
        <h5 class="card-header">Đơn Hàng</h5>
        <div class="card-body">
            @if($order)
                <table class="table table-striped table-hover">
                    @php
                        $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
                    @endphp
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Tên</th>
                        <th>Địa chỉ Email</th>
                        <th>Số lượng</th>
                        <th>Giá vận chuyển</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->order_number}}</td>
                        <td>{{$order->first_name}} {{$order->last_name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>@foreach($shipping_charge as $data) {{number_format($data)}}₫ @endforeach</td>
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
                            <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} data-toggle="tooltip" data-placement="bottom" title="Delete" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>

                    </tr>
                    </tbody>
                </table>

                <section class="order_details pt-3">
                    <div class="table-header">
                        <h5>Thông Tin Sản Phẩm</h5>
                    </div>
                    <table class="table table-bordered table-stripe">
                        <thead>
                        <tr>
                            <th scope="col" class="col-6">Sản Phẩm</th>
                            <th scope="col" class="col-6">Số Lượng</th>
                            <th scope="col" class="col-6">Giá</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->cart_info as $cart)
                            @php
                                $product=DB::table('products')->select('title')->where('id',$cart->product_id)->get();
                                $product_variant = DB::table('product_variants')->select('key')->where('id',$cart->product_variant_id)->get();
                            @endphp
                            <tr>
                                <td>
                                    <span>
                                        @foreach($product as $pro){{$pro->title}}@endforeach {{str_replace(',','-',$product_variant[0]->key)}}
                                    </span>
                                </td>
                                <td>x{{$cart->quantity}}</td>
                                <td><span>{{number_format($cart->price)}}₫</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>

                <section class="confirmation_part section_padding">
                    <div class="order_boxes">
                        <div class="row">
                            <div class="col-lg-6 col-lx-4">
                                <div class="order-info">
                                    <h4 class="text-center pb-4">THÔNG TIN ĐƠN HÀNG</h4>
                                    <table class="table">
                                        <tr class="">
                                            <td>Mã đơn hàng</td>
                                            <td> : {{$order->order_number}}</td>
                                        </tr>
                                        <tr>
                                            <td>Ngày mua hàng</td>
                                            <td> : {{$order->created_at->format('d/m/Y H:m:i')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Số lượng</td>
                                            <td> : {{$order->quantity}}</td>
                                        </tr>
                                        <tr>
                                            <td>Trạng thái</td>
                                            <td>:
                                                @if($order->status=='new')
                                                    <span class="badge badge-primary"> Mới</span>
                                                @elseif($order->status=='process')
                                                    <span class="badge badge-warning"> Đang Xử Lý</span>
                                                @elseif($order->status=='delivered')
                                                    <span class="badge badge-success"> Đã Vận Chuyển</span>
                                                @else
                                                    <span class="badge badge-danger"> Huỷ</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            @php
                                                $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
                                            @endphp
                                            <td>Giá vận chuyển</td>
                                            <td> : {{number_format($shipping_charge[0])}}₫</td>
                                        </tr>
                                        <tr>
                                            <td>Mã giảm giá</td>
                                            <td> : {{number_format($order->coupon)}}₫</td>
                                        </tr>
                                        <tr>
                                            <td>Tổng tiền</td>
                                            <td> : {{number_format($order->total_amount)}}₫</td>
                                        </tr>
                                        <tr>
                                            <td>Phương thức thanh toán</td>
                                            <td> : @if($order->payment_method=='cod') Tiền mặt @else Paypal @endif</td>
                                        </tr>
                                        <tr>
                                            <td>Trạng thái thanh toán</td>
                                            <td> : @if($order->payment_status == 'active') Đã thanh toán @else Chưa thanh toán @endif</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6 col-lx-4">
                                <div class="shipping-info">
                                    <h4 class="text-center pb-4">THÔNG TIN VẬN CHUYỂN</h4>
                                    <table class="table">
                                        <tr class="">
                                            <td>Tên</td>
                                            <td> : {{$order->first_name}} {{$order->last_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Địa chỉ Email</td>
                                            <td> : {{$order->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Số điện thoại</td>
                                            <td> : {{$order->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Địa chỉ</td>
                                            <td> : {{$order->address1}}, {{$order->address2}}</td>
                                        </tr>
                                        <tr>
                                            <td>Quốc gia</td>
                                            <td> : {{$order->country}}</td>
                                        </tr>
                                        <tr>
                                            <td>Mã bưu điện</td>
                                            <td> : {{$order->post_code}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

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
