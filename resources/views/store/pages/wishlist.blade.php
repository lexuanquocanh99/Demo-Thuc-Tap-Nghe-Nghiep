@extends('store.layouts.master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title','HOA HONG MOBILE || YÊU THÍCH')
@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Yêu thích</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shopping Summery -->
                    <table class="table shopping-summery">
                        <thead>
                        <tr class="main-hading">
                            <th>SẢN PHẨM</th>
                            <th>TÊN</th>
                            <th class="text-center">GIÁ</th>
                            <th class="text-center">THÊM GIỎ HÀNG</th>
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(Helper::getAllProductFromWishlist())
                            @foreach(Helper::getAllProductFromWishlist() as $key=>$wishlist)
                                <tr>
                                    @php
                                        $photo=explode(',',$wishlist->product['photo']);
                                    @endphp
                                    <td class="image" data-title="No"><img src="{{asset('storage/'.$photo[0])}}" alt="{{$photo[0]}}"></td>
                                    <td class="product-des" data-title="Description">
                                        <p class="product-name"><a href="{{route('product-detail',$wishlist->product['slug'])}}">{{$wishlist->product['title']}}</a></p>
                                        <p class="product-des">{!!($wishlist['summary']) !!}</p>
                                    </td>
                                    <td class="total-amount" data-title="Total"><span>{{number_format($wishlist['amount'])}}₫</span></td>
                                    <td><a data-toggle="modal" data-target="#{{$wishlist->product['id']}}" class='btn text-white'>Thêm giỏ hàng</a></td>
                                    <td class="action" data-title="Remove"><a href="{{route('wishlist-delete',$wishlist->id)}}"><i class="ti-trash remove-icon"></i></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center">
                                    Không có sản phẩm yêu thích nào. <a href="{{route('product-grids')}}" style="color:blue;">Tiếp tục mua hàng</a>
                                </td>
                            </tr>
                        @endif


                        </tbody>
                    </table>
                    <!--/ End Shopping Summery -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->
    <?php
    $product_lists=DB::table('products')->where('status','active')->orderBy('id','DESC')->limit(6)->get();
    ?>
    <!-- Modal -->
    @if($product_lists)
        @foreach($product_lists as $key=>$product)
            @php
                $product_options = DB::table('products_attributes_values')->where('product_id',$product->id)->get();
                $is_product_option = true;
                if ($product_options->first() == null) {
                    $is_product_option = false;
                }

                if (!isset($product->discount)){
                    $discount=0;
                } else {
                    $discount=$product->discount;
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
