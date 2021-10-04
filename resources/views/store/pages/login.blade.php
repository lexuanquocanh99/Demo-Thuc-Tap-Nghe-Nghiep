@extends('store.layouts.master')
@section('title','HOA HONG MOBILE || ĐĂNG NHẬP')
@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Đăng nhập</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shop Login -->
    <section class="shop login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="login-form">
                        <h2>Đăng nhập</h2>
                        <p>Hãy đăng ký để nhận được ưu đãi và thông tin về sản phẩm của chúng tôi</p>
                        <!-- Form -->
                        <form class="form" method="post" action="{{--route('login.submit')--}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Email<span>*</span></label>
                                        <input type="email" name="email" placeholder="" required="required" value="{{old('email')}}">
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Mật Khẩu<span>*</span></label>
                                        <input type="password" name="password" placeholder="" required="required" value="{{old('password')}}">
                                        @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group login-btn">
                                        <button class="btn" type="submit">Đăng Nhập</button>
                                        <a href="{{route('register.form')}}" class="btn">Đăng Ký</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Login -->
@endsection
@push('styles')
    <style>
        .shop.login .form .btn{
            margin-right:0;
        }
        .btn-facebook{
            background:#39579A;
        }
        .btn-facebook:hover{
            background:#073088 !important;
        }
        .btn-github{
            background:#444444;
            color:white;
        }
        .btn-github:hover{
            background:black !important;
        }
        .btn-google{
            background:#ea4335;
            color:white;
        }
        .btn-google:hover{
            background:rgb(243, 26, 26) !important;
        }
    </style>
@endpush
