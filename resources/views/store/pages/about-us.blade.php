@extends('store.layouts.master')
@section('title','HOA HONG MOBILE || VỀ CHÚNG TÔI')
@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Về chúng tôi</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- About Us -->
    <section class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="about-content">
                        @php
                            $settings=DB::table('settings')->get();
                        @endphp
                        <h3>Chào mừng đến với <span>Hoà Hồng Mobile</span></h3>
                        <p>@foreach($settings as $data) {!! $data->description !!} @endforeach</p>
                        <div class="button">
                            <a href="{{route('blog')}}" class="btn">Bài Viết Của Chúng Tôi</a>
                            <a href="{{route('contact')}}" class="btn primary">Liên Hệ</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="about-img overlay">
                        <img src="@foreach($settings as $data) {{asset('storage/'.$data->photo)}} @endforeach" alt="@foreach($settings as $data) {{$data->photo}} @endforeach">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Us -->

    <!-- Map Section -->
    <div class="map-section">
        <div id="myMap">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d357.4939114471333!2d105.8450977657596!3d21.628902528738323!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31352713d362b9ab%3A0xe2c264bdd80c4241!2zTcOheSBUw61uaCDEkGnhu4duIFRob-G6oWkgSMOyYSBI4buTbmc!5e0!3m2!1svi!2s!4v1633058105915!5m2!1svi!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" tabindex="0"></iframe>
        </div>
    </div>
    <!--/ End Map Section -->

@endsection
