@extends('store.layouts.master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title','HOA HONG MOBILE || TRANG CHỦ')
@section('main-content')

    @if(count($banners)>0)
        <section id="Gslider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($banners as $key=>$banner)
                    <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
                @endforeach

            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach($banners as $key=>$banner)
                    <div class="carousel-item {{(($key==0)? 'active' : '')}}">
                        <img class="first-slide" src="{{asset('storage/'.$banner->photo)}}" alt="First slide">
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Sau</span>
            </a>
            <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Trước</span>
            </a>
        </section>
    @endif

    <!--/ End Slider Area -->

    <!-- Start Product Area -->
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Mua nhiều</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <div class="nav-main">
                            <!-- Tab Nav -->
                            <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
                                @php
                                    $categories=DB::table('categories')->where('status','active')->where('is_parent',1)->get();
                                    // dd($categories);
                                @endphp
                                @if($categories)
                                    <button class="btn" style="background:black"data-filter="*">
                                        Tất cả sản phẩm
                                    </button>
                                    @foreach($categories as $key=>$cat)
                                        <button class="btn" style="background:none;color:black;"data-filter=".{{$cat->id}}">
                                            {{$cat->title}}
                                        </button>
                                    @endforeach
                                @endif
                            </ul>
                            <!--/ End Tab Nav -->
                        </div>
                        <div class="tab-content isotope-grid" id="myTabContent">
                           <!-- Start Single Tab -->
                            @if($product_lists)
                                @foreach($product_lists as $key=>$product)
                                    @php
                                        if (!isset($product->discount)){
                                            $discount=0;
                                        } else {
                                            $discount=$product->discount;
                                        }
                                    @endphp
                                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->cat_id}}">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{route('product-detail',$product->slug)}}">
                                                    @php
                                                        $photo=explode(',',$product->photo);
                                                    // dd($photo);
                                                    @endphp
                                                    <img class="default-img" src="{{asset('storage/'.$photo[0])}}" alt="{{$photo[0]}}">
                                                    <img class="hover-img" src="{{asset('storage/'.$photo[0])}}" alt="{{$photo[0]}}">
                                                    @if($product->stock<=0)
                                                        <span class="out-of-stock">Bán hết</span>
                                                    @elseif($product->condition=='new')
                                                        <span class="new">Mới</span
                                                    @elseif($product->condition=='hot')
                                                        <span class="hot">Nổi bật</span>
                                                    @else
                                                        <span class="price-dec">Giảm {{$product->discount}}%</span>
                                                    @endif


                                                </a>
                                                <div class="button-head">
                                                    <div class="product-action mr-1">
                                                        <a data-toggle="modal" data-target="#{{$product->id}}" title="Xem ngay" href="#"><i class=" ti-eye"></i><span>Xem ngay</span></a>
                                                        <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}" ><i class=" ti-heart "></i><span>Yêu thích</span></a>
                                                    </div>
                                                    <div class="product-action-2 ml-1">
                                                        <a title="Add to cart" data-toggle="modal" data-target="#{{$product->id}}">Thêm giỏ hàng</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                                <div class="product-price">
                                                    @if($product->discount == null || $product->discount == 0)
                                                        <span>{{number_format($product->price)}}₫</span>
                                                    @else
                                                        @php
                                                            $after_discount=($product->price-($product->price*$product->discount)/100);
                                                        @endphp
                                                        <span>{{number_format($after_discount)}}₫</span>
                                                        <del style="padding-left:4%;">{{number_format($product->price)}}₫</del>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach

                            <!--/ End Single Tab -->
                        @endif

                        <!--/ End Single Tab -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Area -->

    <!-- Start Most Popular -->
    <div class="product-area most-popular section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Nổi bật</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                    @foreach($product_lists as $product)
                        @if($product->condition=='hot')
                            <!-- Start Single Product -->
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{route('product-detail',$product->slug)}}">
                                            @php
                                                $photo=explode(',',$product->photo);
                                            // dd($photo);
                                            @endphp
                                            <img class="default-img" src="{{asset('storage/'.$photo[0])}}" alt="{{$photo[0]}}">
                                            <img class="hover-img" src="{{asset('storage/'.$photo[0])}}" alt="{{$photo[0]}}">
                                        </a>
                                        <div class="button-head">
                                            <div class="product-action">
                                                <a data-toggle="modal" data-target="#{{$product->id}}" title="Xem ngay" href="#"><i class=" ti-eye"></i><span>Xem ngay</span></a>
                                                <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}" ><i class=" ti-heart "></i><span>Yêu thích</span></a>
                                            </div>
                                            <div class="product-action-2 ml-1">
                                                <a title="Add to cart" data-toggle="modal" data-target="#{{$product->id}}">Thêm giỏ hàng</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                        <div class="product-price">
                                            @if($product->discount == null || $product->discount == 0)
                                                <span>{{number_format($product->price)}}₫</span>
                                            @else
                                                @php
                                                    $after_discount=($product->price-($product->price*$product->discount)/100);
                                                @endphp
                                                <span>{{number_format($after_discount)}}₫</span>
                                                <del style="padding-left:4%;">{{number_format($product->price)}}₫</del>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Product -->
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Most Popular Area -->

    <!-- Start Shop Home List  -->
    <section class="shop-home-list section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop-section-title">
                                <h1>Mới nhất</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $product_lists=DB::table('products')->where('status','active')->orderBy('id','DESC')->limit(6)->get();
                        @endphp
                        @foreach($product_lists as $product)
                            <div class="col-md-4">
                                <!-- Start Single List  -->
                                <div class="single-list">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="list-image overlay">
                                                @php
                                                    $photo=explode(',',$product->photo);
                                                    // dd($photo);
                                                @endphp
                                                <img src="{{asset('storage/'.$photo[0])}}" alt="{{$photo[0]}}">
                                                <a data-toggle="modal" data-target="#{{$product->id}}" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                                            <div class="content">
                                                <h4 class="title"><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h4>
                                                <p class="price with-discount">{{number_format($product->price-($product->price*$product->discount)/100)}}₫</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single List  -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Home List  -->

    <!-- Start Shop Blog  -->
    <section class="shop-blog section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Bài Viết</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($posts)
                    @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Start Single Blog  -->
                            <div class="shop-single-blog">
                                <img src="{{asset('storage/'.$post->photo)}}" alt="{{$post->photo}}">
                                <div class="content">
                                    <p class="date">{{$post->created_at->format('d M , Y. D')}}</p>
                                    <a href="{{route('blog.detail',$post->slug)}}" class="title">{{$post->title}}</a>
                                    <a href="{{route('blog.detail',$post->slug)}}" class="more-btn">Đọc tiếp</a>
                                </div>
                            </div>
                            <!-- End Single Blog  -->
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- End Shop Blog  -->

    <!-- Start Shop Services Area -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Vận chuyển</h4>
                        <p>Nhanh chóng, tiết kiệm</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Trả hàng</h4>
                        <p>Trong 30 ngày</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Thanh toán</h4>
                        <p>100% bảo mật</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Giá cả</h4>
                        <p>Cạnh tranh nhất</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services Area -->

    <!-- Modal -->
    @if($product_lists)
        @foreach($product_lists as $key=>$product)
            @php
                $product_options = DB::table('products_attributes_values')->where('product_id',$product->id)->get();
                $is_product_option = true;
                if ($product_options->first() == null) {
                    $is_product_option = false;
                }
            @endphp
            <div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <!-- Product Slider -->
                                    <div class="product-gallery">
                                        <div class="quickview-slider-active">
                                            @php
                                                $photo=explode(',',$product->photo);
                                            // dd($photo);
                                            @endphp
                                            @foreach($photo as $data)
                                                <div class="single-slider">
                                                    <img src="{{asset('storage/'.$data)}}" alt="{{$data}}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- End Product slider -->
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="quickview-content">
                                        <h2>{{$product->title}}</h2>
                                        <div class="quickview-ratting-review">
                                            <div class="quickview-ratting-wrap">
                                                <div class="quickview-ratting">
                                                    @php
                                                        $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                                        $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                                                    @endphp
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($rate>=$i)
                                                            <i class="yellow fa fa-star"></i>
                                                        @else
                                                            <i class="fa fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <a href="#"> ({{$rate_count}} người đánh giá)</a>
                                            </div>
                                            <div class="quickview-stock" id="stock-{{$product->id}}">
                                                @php
                                                    $variant_value = DB::table('product_variants')->where('product_id',$product->id)->first();
                                                @endphp
                                                @if($is_product_option)
                                                    @if(isset($variant_value))
                                                        @if($variant_value->stock >0)
                                                            <span><i class="fa fa-check-circle-o"></i> {{$variant_value->stock}} trong kho</span>
                                                        @else
                                                            <span><i class="fa fa-times-circle-o text-danger"></i> {{$variant_value->stock}} trong kho</span>
                                                        @endif
                                                    @endif
                                                @else
                                                    @if($product->stock >0)
                                                        <span><i class="fa fa-check-circle-o"></i> {{$product->stock}} trong kho</span>
                                                    @else
                                                        <span><i class="fa fa-times-circle-o text-danger"></i> {{$product->stock}} trong kho</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        @if($is_product_option)
                                            @if(isset($variant_value))
                                                @if($product->discount == null || $product->discount == 0)
                                                    <h3 id="price-{{$product->id}}">{{number_format($variant_value->price)}}₫</h3>
                                                @else
                                                    @php
                                                        $after_discount=($product->price-($product->price*$product->discount)/100);
                                                    @endphp
                                                    <h3 id="price-{{$product->id}}"><small><del class="text-muted">{{number_format($variant_value->price)}}₫</del></small>    {{number_format($after_discount)}}₫</h3>
                                                @endif
                                            @endif
                                        @else
                                            @if($product->discount == null || $product->discount == 0)
                                                <h3 id="price-{{$product->id}}">{{number_format($product->price)}}₫</h3>
                                            @else
                                                @php
                                                    $after_discount=($product->price-($product->price*$product->discount)/100);
                                                @endphp
                                                <h3 id="price-{{$product->id}}"><small><del class="text-muted">{{number_format($product->price)}}₫</del></small>    {{number_format($after_discount)}}₫</h3>
                                            @endif
                                        @endif
                                        <div class="quickview-peragraph">
                                            <p>{!! html_entity_decode($product->summary) !!}</p>
                                        </div>
                                        @if(isset(auth()->user()->id))
                                        <form action="{{route('single-add-to-cart')}}" method="POST" class="mt-4">
                                            @csrf
                                            @if($is_product_option)
                                                @php
                                                    $attrArrs = array();
                                                    $attribute_ids = DB::table('products_attributes_values')->distinct()->select('attribute_id')->where('product_id',$product->id)->get()->toArray();
                                                    foreach ($attribute_ids as $attribute_id) {
                                                        $attrArrs[] = $attribute_id->attribute_id;
                                                    }
                                                @endphp
                                                @php
                                                    $attrVlArrs = array();
                                                    $attribute_value_ids = DB::table('products_attributes_values')->distinct()->select('attribute_value_id')->where('product_id',$product->id)->get()->toArray();
                                                    foreach ($attribute_value_ids as $attribute_value_id) {
                                                        $attrVlArrs[] = $attribute_value_id->attribute_value_id;
                                                    }
                                                @endphp
                                                <div class="row">
                                                    @foreach($attributes as $attribute)
                                                        @foreach($attrArrs as $attrArr)
                                                            @if($attribute->id == $attrArr)
                                                                @php
                                                                    $attribute_values = DB::table("attribute_values")->where("attribute_id",$attribute->id)->get();
                                                                @endphp
                                                                <div class="col-sm-3">
                                                                    <label for="{{$attribute->id}}_{{$attribute->title}}" class="row" style="text-align: left;">{{$attribute->title}}</label>
                                                                    <div class="row">
                                                                        <select name="product_options[]" id="{{$attribute->id}}_{{$attribute->title}}" class="form-control attribute-select" required>
                                                                            @foreach($attribute_values as $attribute_value)
                                                                                @foreach($attrVlArrs as $key => $attrVlArr)
                                                                                    @if($attribute_value->id == $attrVlArr)
                                                                                        @php
                                                                                            $avaiable_value = DB::table('product_variants')->where('product_id',$product->id)->where('key', 'LIKE', '%'.$attribute_value->value.'%')->first();
                                                                                        @endphp
                                                                                        @if(isset($avaiable_value))
                                                                                            <option value="{{$attribute_value->value}}" data-product-id="{{$product->id}}">{{$attribute_value->value}}</option>
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </div>
                                                <br>
                                            @endif
                                            <div class="quantity">
                                                <!-- Input Order -->
                                                <div class="input-group">
                                                    <div class="button minus">
                                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                            <i class="ti-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="slug" value="{{$product->slug}}">
                                                    <input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
                                                    <div class="button plus">
                                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                                            <i class="ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!--/ End Input Order -->
                                            </div>
                                            <div class="add-to-cart">
                                                <button type="submit" class="btn">Thêm giỏ hàng</button>
                                                <a href="{{route('add-to-wishlist',$product->slug)}}" class="btn min"><i class="ti-heart"></i></a>
                                            </div>
                                        </form>
                                        @else
                                            <p class="text-center p-5">
                                                Bạn cần <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Đăng nhập</a> hoặc <a style="color:blue" href="{{route('register.form')}}">Đăng Ký</a> để mua hàng
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <!-- Modal end -->
@endsection

@push('styles')
    <style>
        /* Banner Sliding */
        #Gslider .carousel-inner {
            background: #000000;
            color:black;
        }

        #Gslider .carousel-inner{
            height: 550px;
        }
        #Gslider .carousel-inner img{
            width: 100% !important;
            opacity: 1;
        }

        #Gslider .carousel-inner .carousel-caption {
            bottom: 60%;
        }

        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 50px;
            font-weight: bold;
            line-height: 100%;
            color: #F7941D;
        }

        #Gslider .carousel-inner .carousel-caption p {
            font-size: 18px;
            color: black;
            margin: 28px 0 28px 0;
        }

        #Gslider .carousel-indicators {
            bottom: 70px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>

        /*==================================================================
        [ Isotope ]*/
        var $topeContainer = $('.isotope-grid');
        var $filter = $('.filter-tope-group');

        // filter items on button click
        $filter.each(function () {
            $filter.on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $topeContainer.isotope({filter: filterValue});
            });

        });

        // init Isotope
        $(window).on('load', function () {
            var $grid = $topeContainer.each(function () {
                $(this).isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows',
                    percentPosition: true,
                    animationEngine : 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                });
            });
        });

        var isotopeButton = $('.filter-tope-group button');

        $(isotopeButton).each(function(){
            $(this).on('click', function(){
                for(var i=0; i<isotopeButton.length; i++) {
                    $(isotopeButton[i]).removeClass('how-active1');
                }

                $(this).addClass('how-active1');
            });
        });
    </script>
    <script>
        function cancelFullScreen(el) {
            var requestMethod = el.cancelFullScreen||el.webkitCancelFullScreen||el.mozCancelFullScreen||el.exitFullscreen;
            if (requestMethod) { // cancel full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }

        function requestFullScreen(el) {
            // Supports most browsers and their versions.
            var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

            if (requestMethod) { // Native full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
            return false
        }
    </script>

    <script>
        function number_format (number, decimals, dec_point, thousands_sep) {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
    </script>

    <script>
        var var_key = [];
        var variantKey = "";
        var product_id = null;
        $('select.attribute-select').on('change', function(e) {
            let _currentSelect = e.currentTarget;
            let _form = $(_currentSelect).closest('form');
            var var_key = [];
            _form.find('.attribute-select option:selected').each(function(){
                product_id = $(this).data("product-id");
                var_key.push($(this).val());
                variantKey = var_key.join(",");
            });
            console.log(variantKey);
            let _url     = `{{route("product-variant.check")}}`;
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    product_id: product_id,
                    variant_key: variantKey,
                    _token: _token
                },
                success: function(response) {
                    if(response.code == 200) {
                        if(response.data.stock > 0) {
                            $('#stock-'+response.data.product_id+'').html('<span><i class="fa fa-check-circle-o"></i> '+response.data.stock+' trong kho</span>');
                        } else {
                            $('#stock-'+response.data.product_id+'').html('<span><i class="fa fa-times-circle-o text-danger"></i> '+response.data.stock+' trong kho</span>');
                        }
                        if ({{$discount == 0}}) {
                            $('#price-'+response.data.product_id+'').html(number_format(response.data.price)+'₫');
                        } else {
                            let after_price = (response.data.price-((response.data.price*{{$discount}})/100));
                            $('#price-'+response.data.product_id+'').html('<small><del class="text-muted">'+(number_format(response.data.price))+'₫</del></small>    '+(number_format(after_price))+'₫');
                        }
                    }
                }
            });
        })
    </script>

@endpush
