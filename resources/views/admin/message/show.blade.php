@extends('admin.layouts.master')
@section('title','HOA HONG MOBILE || THÔNG ĐIỆP')
@section('main-content')
    <div class="card">
        <h5 class="card-header">Thông Điệp</h5>
        <div class="card-body">
            @if($message)
                @if($message->photo)
                    <img src="{{$message->photo}}" class="rounded-circle " style="margin-left:44%;">
                @else
                    <img src="{{asset('backend/img/avatar.png')}}" class="rounded-circle " style="margin-left:44%;">
                @endif
                <div class="py-4">Từ: <br>
                    Tên người dùng :{{$message->name}}<br>
                    Địa chỉ Email :<a href="mailto:{{$message->email}}">{{$message->email}}</a><br>
                    Số điện thoại :<a href="tel:{{$message->phone}}">{{$message->phone}}</a>
                </div>
                <hr/>
                <h5 class="text-center" style="text-decoration:underline"><strong>Chủ đề :</strong> {{$message->subject}}</h5>
                <p class="py-5">{{$message->message}}</p>
            @endif

        </div>
    </div>
@endsection
