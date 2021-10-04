@extends('store.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
    <meta name="description" content="{{$product_detail->summary}}">
    <meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{$product_detail->title}}">
    <meta property="og:image" content="{{$product_detail->photo}}">
    <meta property="og:description" content="{{$product_detail->description}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title','HOA HONG MOBILE || THÔNG TIN SẢN PHẨM')
@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="{{route('product-grids')}}">Sản phẩm<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">{{$product_detail->title}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shop Single -->
    <section class="shop single section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <!-- Images slider -->
                                <div class="flexslider-thumbnails">
                                    <ul class="slides">
                                        @php
                                            $photo=explode(',',$product_detail->photo);
                                        // dd($photo);
                                        @endphp
                                        @foreach($photo as $data)
                                            <li data-thumb="{{asset('storage/'.$data)}}" rel="adjustX:10, adjustY:">
                                                <img src="{{asset('storage/'.$data)}}" alt="{{$data}}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End Images slider -->
                            </div>
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="product-des">
                                <!-- Description -->
                                <div class="short">
                                    <h4>{{$product_detail->title}}</h4>
                                    <div class="rating-main">
                                        <ul class="rating">
                                            @php
                                                $rate=ceil($product_detail->getReview->avg('rate'))
                                            @endphp
                                            @for($i=1; $i<=5; $i++)
                                                @if($rate>=$i)
                                                    <li><i class="fa fa-star"></i></li>
                                                @else
                                                    <li><i class="fa fa-star-o"></i></li>
                                                @endif
                                            @endfor
                                        </ul>
                                        <a href="#" class="total-review">({{$product_detail['getReview']->count()}}) Đánh giá</a>
                                    </div>
                                    @php
                                        if (!isset($product_detail->discount)){
                                            $discount=0;
                                        } else {
                                            $discount=$product_detail->discount;
                                        }
                                    @endphp
                                    @if($is_product_option)
                                        @if($product_detail->discount == null || $product_detail->discount == 0)
                                            @php
                                                $variant_value = DB::table('product_variants')->where('product_id',$product_detail->id)->first();
                                            @endphp
                                            <p class="price"><span id="price">{{number_format($variant_value->price)}}₫</span> </p>
                                        @else
                                            @php
                                                $variant_value = DB::table('product_variants')->where('product_id',$product_detail->id)->first();
                                                $after_discount=($variant_value->price-(($variant_value->price*$product_detail->discount)/100));
                                            @endphp
                                            <p class="price"><span class="discount" id="discount">{{number_format($after_discount)}}₫</span><s id="price">{{number_format($variant_value->price)}}₫</s> </p>
                                        @endif
                                    @else
                                        @if($product_detail->discount == null || $product_detail->discount == 0)
                                            <p class="price"><span id="price">{{number_format($product_detail->price)}}₫</span> </p>
                                        @else
                                            @php
                                                $after_discount=($product_detail->price-(($product_detail->price*$product_detail->discount)/100));
                                            @endphp
                                            <p class="price"><span class="discount" id="discount">{{number_format($after_discount)}}₫</span><s id="price">{{number_format($product_detail->price)}}₫</s> </p>
                                        @endif
                                    @endif
                                    <p class="description">{!!($product_detail->summary)!!}</p>
                                </div>
                                <!--/ End Description -->
                                <!-- Product Buy -->
                                <div class="product-buy">
                                    @if(isset(auth()->user()->id))
                                    <form action="{{route('single-add-to-cart')}}" method="POST">
                                        @csrf
                                        @if($is_product_option)
                                        @php
                                            $attrArrs = array();
                                            $attribute_ids = DB::table('products_attributes_values')->distinct()->select('attribute_id')->where('product_id',$product_detail->id)->get()->toArray();
                                            foreach ($attribute_ids as $attribute_id) {
                                                $attrArrs[] = $attribute_id->attribute_id;
                                            }
                                        @endphp
                                        @php
                                            $attrVlArrs = array();
                                            $attribute_value_ids = DB::table('products_attributes_values')->distinct()->select('attribute_value_id')->where('product_id',$product_detail->id)->get()->toArray();
                                            foreach ($attribute_value_ids as $attribute_value_id) {
                                                $attrVlArrs[] = $attribute_value_id->attribute_value_id;
                                            }
                                        @endphp
                                        <div class="row justify-content-md-center">
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
                                                                                $avaiable_value = DB::table('product_variants')->where('product_id',$product_detail->id)->where('key', 'LIKE', '%'.$attribute_value->value.'%')->first();
                                                                                @endphp
                                                                                @if(isset($avaiable_value))
                                                                                <option value="{{$attribute_value->value}}">{{$attribute_value->value}}</option>
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
                                            <h6>Số lượng:</h6>
                                            <!-- Input Order -->
                                            <div class="input-group">
                                                <div class="button minus">
                                                    <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="slug" value="{{$product_detail->slug}}">
                                                <input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1" id="quantity">
                                                <div class="button plus">
                                                    <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                                        <i class="ti-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!--/ End Input Order -->
                                        </div>
                                        <div class="add-to-cart mt-4">
                                            <button type="submit" class="btn">Thêm giỏ hàng</button>
                                            <button href="{{route('add-to-wishlist',$product_detail->slug)}}" class="btn min"><i class="ti-heart"></i></button>
                                        </div>
                                    </form>
                                    @else
                                        <p class="text-center p-5">
                                            Bạn cần <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Đăng nhập</a> hoặc <a style="color:blue" href="{{route('register.form')}}">Đăng Ký</a> để mua hàng
                                        </p>
                                    @endif

                                    <p class="cat">Danh mục :<a href="{{route('product-cat',$product_detail->cat_info['slug'])}}">{{$product_detail->cat_info['title']}}</a></p>
                                    @if($product_detail->sub_cat_info)
                                        <p class="cat mt-1">Danh mục con :<a href="{{route('product-sub-cat',[$product_detail->cat_info['slug'],$product_detail->sub_cat_info['slug']])}}">{{$product_detail->sub_cat_info['title']}}</a></p>
                                    @endif
                                        @if($is_product_option)
                                            <p class="availability" id="stock">Kho : @if($variant_value->stock>0)<span class="badge badge-success">{{$variant_value->stock}}</span>@else <span class="badge badge-danger">{{$variant_value->stock}}</span>  @endif</p>
                                        @else
                                            <p class="availability">Kho : @if($product_detail->stock>0)<span id="stock-success" class="badge badge-success">{{$product_detail->stock}}</span>@else <span id="stock-danger" class="badge badge-danger">{{$product_detail->stock}}</span>  @endif</p>
                                        @endif
                                </div>
                                <!--/ End Product Buy -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product-info">
                                <div class="nav-main">
                                    <!-- Tab Nav -->
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description" role="tab">Mô tả</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Đánh giá</a></li>
                                    </ul>
                                    <!--/ End Tab Nav -->
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <!-- Description Tab -->
                                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                                        <div class="tab-single">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="single-des">
                                                        <p>{!! ($product_detail->description) !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Description Tab -->
                                    <!-- Reviews Tab -->
                                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                                        <div class="tab-single review-panel">
                                            <div class="row">
                                                <div class="col-12">

                                                    <!-- Review -->
                                                    <div class="comment-review">
                                                        <div class="add-review">
                                                            <h5>Đánh giá</h5>
                                                        </div>
                                                        <h4>Sao <span class="text-danger">*</span></h4>
                                                        <div class="review-inner">
                                                            <!-- Form -->
                                                            @auth
                                                                <form class="form" method="post" action="{{route('review.store',$product_detail->slug)}}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-12">
                                                                            <div class="rating_box">
                                                                                <div class="star-rating">
                                                                                    <div class="star-rating__wrap">
                                                                                        <input class="star-rating__input" id="star-rating-5" type="radio" name="rate" value="5">
                                                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-5" title="5 out of 5 stars"></label>
                                                                                        <input class="star-rating__input" id="star-rating-4" type="radio" name="rate" value="4">
                                                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-4" title="4 out of 5 stars"></label>
                                                                                        <input class="star-rating__input" id="star-rating-3" type="radio" name="rate" value="3">
                                                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-3" title="3 out of 5 stars"></label>
                                                                                        <input class="star-rating__input" id="star-rating-2" type="radio" name="rate" value="2">
                                                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-2" title="2 out of 5 stars"></label>
                                                                                        <input class="star-rating__input" id="star-rating-1" type="radio" name="rate" value="1">
                                                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-1" title="1 out of 5 stars"></label>
                                                                                        @error('rate')
                                                                                        <span class="text-danger">{{$message}}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-12">
                                                                            <div class="form-group">
                                                                                <label>Viết đánh giá</label>
                                                                                <textarea name="review" rows="6" placeholder="" ></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-12">
                                                                            <div class="form-group button5">
                                                                                <button type="submit" class="btn">Gửi</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <p class="text-center p-5">
                                                                    Bạn cần <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Đăng nhập</a> hoặc <a style="color:blue" href="{{route('register.form')}}">Đăng ký</a> để đánh giá
                                                                </p>
                                                                <!--/ End Form -->
                                                            @endauth
                                                        </div>
                                                    </div>

                                                    <div class="ratting-main">
                                                        <div class="avg-ratting">
                                                            <h4>{{ceil($product_detail->getReview->avg('rate'))}} <span>(Tổng)</span></h4>
                                                            <span>Dựa trên {{$product_detail->getReview->count()}} đánh giá</span>
                                                        </div>
                                                    @foreach($product_detail['getReview'] as $data)
                                                        <!-- Single Rating -->
                                                            <div class="single-rating">
                                                                <div class="rating-author">
                                                                    @if($data->user_info['photo'])
                                                                        <img src="{{$data->user_info['photo']}}" alt="{{$data->user_info['photo']}}">
                                                                    @else
                                                                        <img src="{{asset('backend/img/avatar.png')}}" alt="Profile.jpg">
                                                                    @endif
                                                                </div>
                                                                <div class="rating-des">
                                                                    <h6>{{$data->user_info['name']}}</h6>
                                                                    <div class="ratings">

                                                                        <ul class="rating">
                                                                            @for($i=1; $i<=5; $i++)
                                                                                @if($data->rate>=$i)
                                                                                    <li><i class="fa fa-star"></i></li>
                                                                                @else
                                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                                @endif
                                                                            @endfor
                                                                        </ul>
                                                                        <div class="rate-count">(<span>{{$data->rate}}</span>)</div>
                                                                    </div>
                                                                    <p>{{$data->review}}</p>
                                                                </div>
                                                            </div>
                                                            <!--/ End Single Rating -->
                                                        @endforeach
                                                    </div>

                                                    <!--/ End Review -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Reviews Tab -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Shop Single -->

    <!-- Start Most Popular -->
    <div class="product-area most-popular related-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Sản phẩm tương tự</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                    @foreach($product_detail->rel_prods as $data)
                        @if($data->id !==$product_detail->id)
                            <!-- Start Single Product -->
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{route('product-detail',$data->slug)}}">
                                            @php
                                                $photo=explode(',',$data->photo);
                                            @endphp
                                            <img class="default-img" src="{{asset('storage/'.$photo[0])}}" alt="{{$photo[0]}}">
                                            <img class="hover-img" src="{{asset('storage/'.$photo[0])}}" alt="{{$photo[0]}}">
                                            <span class="price-dec">Giảm {{$data->discount}}%</span>
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{route('product-detail',$data->slug)}}">{{$data->title}}</a></h3>
                                        <div class="product-price">
                                            @php
                                                $after_discount=($data->price-(($data->discount*$data->price)/100));
                                            @endphp
                                            <span class="old">{{number_format($data->price)}}₫</span>
                                            <span>{{number_format($after_discount)}}₫</span>
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

@endsection
@push('styles')
    <style>
        /* Rating */
        .rating_box {
            display: inline-flex;
        }

        .star-rating {
            font-size: 0;
            padding-left: 10px;
            padding-right: 10px;
        }

        .star-rating__wrap {
            display: inline-block;
            font-size: 1rem;
        }

        .star-rating__wrap:after {
            content: "";
            display: table;
            clear: both;
        }

        .star-rating__ico {
            float: right;
            padding-left: 2px;
            cursor: pointer;
            color: #F7941D;
            font-size: 16px;
            margin-top: 5px;
        }

        .star-rating__ico:last-child {
            padding-left: 0;
        }

        .star-rating__input {
            display: none;
        }

        .star-rating__ico:hover:before,
        .star-rating__ico:hover ~ .star-rating__ico:before,
        .star-rating__input:checked ~ .star-rating__ico:before {
            content: "\F005";
        }

    </style>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

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
        var product_id = {{$product_detail->id}}
        $('.attribute-select').on('change', function() {
            var var_key = [];
            $.each($(".attribute-select option:selected"), function(){
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
                            $('#stock').html('Stock : <span class="badge badge-success">'+response.data.stock+'</span>');
                        } else {
                            $('#stock').html('Stock : <span class="badge badge-danger">'+response.data.stock+'</span>');
                        }
                        if ({{$discount == 0}}) {
                            $('#price').text((number_format(response.data.price))+'₫');
                        } else {
                            let after_price = (response.data.price-((response.data.price*{{$discount}})/100))
                            $('#discount').text((number_format(after_price))+'₫');
                            $('#price').text((number_format(response.data.price))+'₫');
                        }
                    }
                }
            });
        })
    </script>


@endpush
