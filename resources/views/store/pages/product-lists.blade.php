@extends('store.layouts.master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title','HOA HONG MOBILE || SẢN PHẨM')
@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Sản Phẩm</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <form action="{{route('shop.filter')}}" method="POST">
    @csrf
    <!-- Product Style 1 -->
        <section class="product-area shop-sidebar shop-list shop section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="shop-sidebar">
                            <!-- Single Widget -->
                            <div class="single-widget category">
                                <h3 class="title">Danh mục</h3>
                                <ul class="categor-list">
                                    @php
                                        // $category = new Category();
                                        $menu=App\Models\Category::getAllParentWithChild();
                                    @endphp
                                    @if($menu)
                                        <li>
                                        @foreach($menu as $cat_info)
                                            @if($cat_info->child_cat->count()>0)
                                                <li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a>
                                                    <ul>
                                                        @foreach($cat_info->child_cat as $sub_menu)
                                                            <li><a href="{{route('product-sub-cat',[$cat_info->slug,$sub_menu->slug])}}">{{$sub_menu->title}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a></li>
                                                @endif
                                                @endforeach
                                                </li>
                                            @endif
                                </ul>
                            </div>
                            <!--/ End Single Widget -->
                            <!-- Shop By Price -->
                            <div class="single-widget range">
                                <h3 class="title">Giá</h3>
                                <div class="price-filter">
                                    <div class="price-filter-inner">
                                        @php
                                            $max=DB::table('products')->max('price');
                                            // dd($max);
                                        @endphp
                                        <div id="slider-range" data-min="0" data-max="{{$max}}"></div>
                                        <div class="product_filter">
                                            <button type="submit" class="filter_button">Lọc</button>
                                            <div class="label-input">
                                                <span>Khoảng giá:</span>
                                                <input style="" type="text" id="amount" readonly/>
                                                <input type="hidden" name="price_range" id="price_range" value="@if(!empty($_GET['price'])){{$_GET['price']}}@endif"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Shop By Price -->
                            <!-- Single Widget -->
                            <div class="single-widget recent-product">
                                <h3 class="title">Sản Phẩm Gần Đây</h3>
                            {{-- {{dd($recent_products)}} --}}
                            @foreach($recent_products as $product)
                                @php
                                    if (!isset($product->discount)){
                                        $discount=0;
                                    } else {
                                        $discount=$product->discount;
                                    }
                                @endphp
                                <!-- Single Post -->
                                    @php
                                        $photo=explode(',',$product->photo);
                                    @endphp
                                    <div class="single-post first">
                                        <div class="image">
                                            <img src="{{asset('storage/'.$photo[0])}}" alt="{{$photo[0]}}">
                                        </div>
                                        <div class="content">
                                            <h5><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h5>
                                            @if($product->discount == null || $product->discount == 0)
                                                <p class="price">{{number_format($product->price)}}₫  </p>
                                            @else
                                                @php
                                                    $org=($product->price-($product->price*$product->discount)/100);
                                                @endphp
                                                <p class="price"><del class="text-muted">{{number_format($product->price)}}₫</del>   {{number_format($org)}}₫  </p>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End Single Post -->
                                @endforeach
                            </div>
                            <!--/ End Single Widget -->
                            <!-- Single Widget -->
                            <div class="single-widget category">
                                <h3 class="title">Nhãn Hiệu</h3>
                                <ul class="categor-list">
                                    @php
                                        $brands=DB::table('brands')->orderBy('title','ASC')->where('status','active')->get();
                                    @endphp
                                    @foreach($brands as $brand)
                                        <li><a href="{{route('product-brand',$brand->slug)}}">{{$brand->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!--/ End Single Widget -->
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="row">
                            <div class="col-12">
                                <!-- Shop Top -->
                                <div class="shop-top">
                                    <div class="shop-shorter">
                                        <div class="single-shorter">
                                            <label>Hiển thị :</label>
                                            <select class="show" name="show" onchange="this.form.submit();">
                                                <option value="">Mặc định</option>
                                                <option value="9" @if(!empty($_GET['show']) && $_GET['show']=='9') selected @endif>09</option>
                                                <option value="15" @if(!empty($_GET['show']) && $_GET['show']=='15') selected @endif>15</option>
                                                <option value="21" @if(!empty($_GET['show']) && $_GET['show']=='21') selected @endif>21</option>
                                                <option value="30" @if(!empty($_GET['show']) && $_GET['show']=='30') selected @endif>30</option>
                                            </select>
                                        </div>
                                        <div class="single-shorter">
                                            <label>Sắp xếp :</label>
                                            <select class='sortBy' name='sortBy' onchange="this.form.submit();">
                                                <option value="">Mặc định</option>
                                                <option value="title" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='title') selected @endif>Tên</option>
                                                <option value="price" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='price') selected @endif>Giá</option>
                                                <option value="category" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='category') selected @endif>Danh mục</option>
                                                <option value="brand" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='brand') selected @endif>Nhãn hiệu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <ul class="view-mode">
                                        <li><a href="{{route('product-grids')}}"><i class="fa fa-th-large"></i></a></li>
                                        <li class="active"><a href="javascript:void(0)"><i class="fa fa-th-list"></i></a></li>
                                    </ul>
                                </div>
                                <!--/ End Shop Top -->
                            </div>
                        </div>
                        <div class="row">
                        @if(count($products))
                            @foreach($products as $product)
                                {{-- {{$product}} --}}
                                <!-- Start Single List -->
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="single-product">
                                                    <div class="product-img">
                                                        <a href="{{route('product-detail',$product->slug)}}">
                                                            @php
                                                                $photo=explode(',',$product->photo);
                                                            @endphp
                                                            <img class="default-img" src="{{asset('storage/'.$photo[0])}}" alt="{{$photo[0]}}">
                                                            <img class="hover-img" src="{{asset('storage/'.$photo[0])}}" alt="{{$photo[0]}}">
                                                        </a>
                                                        <div class="button-head">
                                                            <div class="product-action mr-1">
                                                                <a data-toggle="modal" data-target="#{{$product->id}}" title="Xem ngay" href="#"><i class=" ti-eye"></i><span>Xem ngay</span></a>
                                                                <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}" class="wishlist" data-id="{{$product->id}}"><i class=" ti-heart "></i><span>Yêu thích</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-12">
                                                <div class="list-content">
                                                    <div class="product-content">
                                                        <div class="product-price">
                                                            @if($product->discount == null || $product->discount == 0)
                                                                <span>{{number_format($product->price)}}₫</span>
                                                            @else
                                                                @php
                                                                    $after_discount=($product->price-($product->price*$product->discount)/100);
                                                                @endphp
                                                                <span>{{number_format($after_discount)}}₫</span>
                                                                <del>{{number_format($product->price)}}₫</del>
                                                            @endif
                                                        </div>
                                                        <h3 class="title"><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                                    </div>
                                                    <p class="des pt-2">{!! html_entity_decode($product->summary) !!}</p>
                                                    <a data-toggle="modal" data-target="#{{$product->id}}" href="javascript:void(0)" class="btn cart" data-id="{{$product->id}}">Mua ngay!</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Single List -->
                                @endforeach
                            @else
                                <h4 class="text-warning" style="margin:100px auto;">Không có sản phẩm nào.</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ End Product Style 1  -->
    </form>
    <!-- Modal -->
    @if($products)
        @foreach($products as $key=>$product)
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
                                            @php
                                                $after_discount=($product->price-($product->price*$product->discount)/100);
                                            @endphp
                                            <h3><small><del class="text-muted">{{number_format($product->price)}}₫</del></small>  {{number_format($after_discount)}}₫</h3>
                                        @endif
                                        <div class="quickview-peragraph">
                                            <p>{!! html_entity_decode($product->summary) !!}</p>
                                        </div>
                                        @if(isset(auth()->user()->id))
                                        <form action="{{route('single-add-to-cart')}}" method="POST">
                                            @csrf
                                            @php
                                                $product_options = DB::table('products_attributes_values')->where('product_id',$product->id)->get();
                                                $is_product_option = true;
                                                if ($product_options->first() == null) {
                                                    $is_product_option = false;
                                                }
                                            @endphp
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
@push ('styles')
    <style>
        .pagination{
            display:inline-flex;
        }
        .filter_button{
            /* height:20px; */
            text-align: center;
            background:#0088CC;
            padding:8px 16px;
            margin-top:10px;
            color: white;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>
        $(document).ready(function(){
            /*----------------------------------------------------*/
            /*  Jquery Ui slider js
            /*----------------------------------------------------*/
            if ($("#slider-range").length > 0) {
                const max_value = parseInt( $("#slider-range").data('max') ) || 500;
                const min_value = parseInt($("#slider-range").data('min')) || 0;
                const currency = $("#slider-range").data('currency') || '';
                let price_range = min_value+'-'+max_value;
                if($("#price_range").length > 0 && $("#price_range").val()){
                    price_range = $("#price_range").val().trim();
                }

                let price = price_range.split('-');
                $("#slider-range").slider({
                    range: true,
                    min: min_value,
                    max: max_value,
                    values: price,
                    slide: function (event, ui) {
                        $("#amount").val(currency + ui.values[0] + " -  "+currency+ ui.values[1]);
                        $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                    }
                });
            }
            if ($("#amount").length > 0) {
                const m_currency = $("#slider-range").data('currency') || '';
                $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                    "  -  "+m_currency + $("#slider-range").slider("values", 1));
            }
        })
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
