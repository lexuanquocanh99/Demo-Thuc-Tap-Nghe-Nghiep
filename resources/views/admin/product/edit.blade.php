@extends('admin.layouts.master')
@section('title','HOA HONG MOBILE || CHỈNH SỬA SẢN PHẨM')
@section('main-content')

    <div class="card">
        <h5 class="card-header">Chỉnh Sửa Sản Phẩm</h5>
        <div class="card-body">
            <form method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="Nhập tiêu đề"  value="{{$product->title}}" class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sku" class="col-form-label">SKU <span class="text-danger">*</span></label>
                    <input id="sku" type="text" name="sku" placeholder="Nhập SKU"  value="{{$product->sku}}" class="form-control">
                    @error('sku')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">Tóm tắt <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" name="summary">{{$product->summary}}</textarea>
                    @error('summary')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="col-form-label">Mô tả</label>
                    <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="is_featured">Là sản phẩm đặc biệt?</label><br>
                    <input type="checkbox" name='is_featured' id='is_featured' value='{{$product->is_featured}}' {{(($product->is_featured) ? 'checked' : '')}}> Có
                </div>
                {{-- {{$categories}} --}}

                <div class="form-group">
                    <label for="cat_id">Danh mục <span class="text-danger">*</span></label>
                    <select name="cat_id" id="cat_id" class="form-control">
                        <option value="">--Chọn danh mục--</option>
                        @foreach($categories as $key=>$cat_data)
                            <option value='{{$cat_data->id}}' {{(($product->cat_id==$cat_data->id)? 'selected' : '')}}>{{$cat_data->title}}</option>
                        @endforeach
                    </select>
                </div>
                @php
                    $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
                  // dd($sub_cat_info);

                @endphp
                {{-- {{$product->child_cat_id}} --}}
                <div class="form-group {{(($product->child_cat_id)? '' : 'd-none')}}" id="child_cat_div">
                    <label for="child_cat_id">Danh mục con</label>
                    <select name="child_cat_id" id="child_cat_id" class="form-control">
                        <option value="">--Chọn danh mục con--</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price" class="col-form-label">Giá <span class="text-danger">*</span></label>
                    <input id="price" type="number" name="price" placeholder="Nhập giá"  value="{{$product->price}}" class="form-control">
                    @error('price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="discount" class="col-form-label">Giảm giá(%)</label>
                    <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Nhập giảm giá"  value="{{$product->discount}}" class="form-control">
                    @error('discount')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="brand_id">Nhãn hiệu</label>
                    <select name="brand_id" class="form-control">
                        <option value="">--Chọn nhãn hiệu--</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}" {{(($product->brand_id==$brand->id)? 'selected':'')}}>{{$brand->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="condition">Tình trạng</label>
                    <select name="condition" class="form-control">
                        <option value="">--Chọn tình trạng--</option>
                        <option value="default" {{(($product->condition=='default')? 'selected':'')}}>Mặc định</option>
                        <option value="new" {{(($product->condition=='new')? 'selected':'')}}>Mới</option>
                        <option value="hot" {{(($product->condition=='hot')? 'selected':'')}}>Nổi bật</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="stock">Số lượng <span class="text-danger">*</span></label>
                    <input id="quantity" type="number" name="stock" min="0" placeholder="Chọn số lượng"  value="{{$product->stock}}" class="form-control">
                    @error('stock')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="upload-image-label">Hình ảnh</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo[]" multiple>
                        <label class="custom-file-label" for="photo">Chọn hình ảnh</label>
                    </div>
                    @error('photo')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <div class="gallery">
                        @if($product->photo)
                            @php
                                $photos=explode(',',$product->photo);
                            @endphp
                            @foreach($photos as $photo)
                                <img src="{{asset('storage/'.$photo)}}" class="img-thumbnail" alt="{{$photo}}">
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active" {{(($product->status=='active')? 'selected' : '')}}>Hoạt động</option>
                        <option value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>Không hoạt động</option>
                    </select>
                    @error('status')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-success" type="submit">Cập nhập</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <h5 class="card-header">Tạo Thuộc Tính Sản Phẩm</h5>
        <div class="card-body">
            @php
                $attrArrs = array();
                $attribute_ids = DB::table('products_attributes_values')->distinct()->select('attribute_id')->where('product_id',$product->id)->get()->toArray();
                foreach ($attribute_ids as $attribute_id) {
                    $attrArrs[] = $attribute_id->attribute_id;
                }
            @endphp
            <div class="form-group">
                <label for="attribute_id">Chọn thuộc tính sản phẩm</label>
                <select name="attribute_id[]" id="product_attribute" multiple data-live-search="true" class="form-control selectpicker">
                    <option value="" disabled>--Chọn thuộc tính sản phẩm--</option>
                    @foreach($attributes as $attribute)
                        <option value="{{$attribute->id}}" @foreach($attrArrs as $attrArr){{(($attribute->id == $attrArr)?'selected':'')}}@endforeach>{{$attribute->title}}</option>
                    @endforeach
                </select>
            </div>

            @php
                $attrVlArrs = array();
                $attribute_value_ids = DB::table('products_attributes_values')->distinct()->select('attribute_value_id')->where('product_id',$product->id)->get()->toArray();
                foreach ($attribute_value_ids as $attribute_value_id) {
                    $attrVlArrs[] = $attribute_value_id->attribute_value_id;
                }
            @endphp

            <div class="form-group">
                @foreach($attributes as $attribute)
                    @php
                        $attribute_values = DB::table("attribute_values")->where("attribute_id",$attribute->id)->get();
                    @endphp
                    <div class="mt-2 select_attribute_{{$attribute->id}}">
                        <label class="mb-0 form-label">{{$attribute->title}}</label>
                        <select class="form-control select2_form {{$attribute->id}}" name="{{$attribute->id}}" data-id="{{$attribute->id}}" multiple>
                            @foreach($attribute_values as $attribute_value)
                                <option value="{{$attribute_value->id}}" @foreach($attrVlArrs as $attrVlArr){{(($attribute_value->id == $attrVlArr)?'selected':'')}}@endforeach>{{$attribute_value->value}}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @php
        $product_variants = DB::table('product_variants')->where('product_id',$product->id)->get();
    @endphp

    <div class="card mt-3">
        <h5 class="card-header">Biến Thể Sản Phẩm</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-right">
                    <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-value" onclick="addVariant()">Tạo Biến Thể</a>
                </div>
            </div>
            <div class="row" style="clear: both;margin-top: 18px;">
                <div class="col-12">
                    <table id="product_variant_table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Biến thể</th>
                            <th>SKU</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product_variants as $product_variant)
                            <tr id="row_{{$product_variant->id}}">
                                <td>{{ $product_variant->id  }}</td>
                                <td>{{ $product_variant->key }}</td>
                                <td>{{ $product_variant->sku }}</td>
                                <td>{{ $product_variant->stock }}</td>
                                <td>{{ number_format($product_variant->price) }}₫</td>
                                <td>@if($product_variant->status == 'active') Hoạt động @else Không hoạt động @endif</td>
                                <td>
                                    <a href="javascript:void(0)" data-id="{{ $product_variant->id }}" onclick="editVariant(this)" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm dltBtn" href="javascript:void(0)" data-id="{{ $product_variant->id }}" onclick="deleteVariant(this)" title="Delete" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="variant-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tạo Biến Thể Sản Phẩm</h4>
                </div>
                <div class="modal-body">
                    <form name="productVariantForm" class="form-horizontal" method="post" action="{{route('product-variant.store')}}">
                        <input type="hidden" name="variant_id" id="variant_id">
                        <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">

                        @foreach($attributes as $attribute)
                            @foreach($attrArrs as $attrArr)
                                @if($attribute->id == $attrArr)
                            @php
                                $attribute_values = DB::table("attribute_values")->where("attribute_id",$attribute->id)->get();
                            @endphp
                            <div class="form-group">
                                <label for="{{$attribute->id}}_{{$attribute->title}}" class="col-sm-2">{{$attribute->title}}</label>
                                <div class="col-sm-12">
                                    <select name="{{$attribute->id}}" id="{{$attribute->id}}_{{$attribute->title}}" class="form-control attribute-select" required>
                                        <option value="" disabled>--Select {{$attribute->title}}--</option>
                                        @foreach($attribute_values as $attribute_value)
                                            @foreach($attrVlArrs as $key => $attrVlArr)
                                                @if($attribute_value->id == $attrVlArr)
                                                <option value="{{$attribute_value->value}}" @if($key == 0){{'selected'}}@endif>{{$attribute_value->value}}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <span id="attributeError" class="alert-message"></span>
                                </div>
                            </div>
                                @endif
                            @endforeach
                        @endforeach

                        <div class="form-group">
                            <label for="variant_stock" class="col-sm-12">Số lượng</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="variant_stock" name="variant_stock" placeholder="Nhập số lượng">
                                <span id="stockError" class="alert-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="variant_price" class="col-sm-12">Giá</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="variant_price" name="variant_price" placeholder="Nhập giá">
                                <span id="priceError" class="alert-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="variant_status" class="col-sm-12">Trạng thái</label>
                            <div class="col-sm-12">
                                <select name="variant_status" id="variant_status" class="form-control">
                                    <option value="" disabled>--Chọn trạng thái--</option>
                                    <option value="active">Hoạt động</option>
                                    <option value="inactive">Không hoạt động</option>
                                </select>
                                <span id="statusError" class="alert-message"></span>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="createVariant()">Lưu</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

@endpush
@push('scripts')
    <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $('#product_attribute').selectpicker('refresh');
        $("#product_attribute").on("changed.bs.select", function(e, clickedIndex, isSelected, oldValue) {
            if (clickedIndex != null && isSelected != null) {
                var selectedD = $(this).find('option').eq(clickedIndex).val();
                console.log('selectedD: ' + selectedD +  ' oldValue: ' + oldValue);
                $('.select_attribute_'+selectedD+'').show();
                if (oldValue.includes(selectedD)) {
                    var attribute_id = selectedD;
                    var product_id = {{$product->id}};
                    var is_delete = confirm("Bạn có muốn xoá thuộc tính này không?");

                    if (is_delete == true) {
                        let _url = `/admin/delete-attribute`;
                        let _token   = $('meta[name="csrf-token"]').attr('content');

                        $.ajax({
                            url: _url,
                            type: 'POST',
                            data: {
                                product_id: product_id,
                                attribute_id: attribute_id,
                                _token: _token
                            },
                            success: function(response) {
                                alert("deleted");
                            }
                        });
                        $('.select_attribute_'+selectedD+'').hide();
                        location.reload();
                    } else {
                        location.reload();
                    }
                }
            }
        });

        $(document).ready(function() {
            $('.select2_form').each(function (index, item) {
                if ($(item).find("option:selected").length == 0) {
                    $(item).select2().next().parent().hide();
                } else {
                    $(item).select2();
                }
            });

            $('.select2_form').on('select2:select', function (e) {
                var attribute_value_id = e.params.data.id;
                var attribute_id = $(e.target).data("id");
                var product_id = {{$product->id}};

                let _url     = `{{route("product-attribute-value.store")}}`;
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: _url,
                    type: "POST",
                    data: {
                        product_id: product_id,
                        attribute_id: attribute_id,
                        attribute_value_id: attribute_value_id,
                        _token: _token
                    },
                    success: function(response) {
                        if(response.code == 200) {
                            alert("Thành công");
                        }
                    },
                    error: function(response) {
                        alert("error");
                    }
                });
                location.reload();
            });
            $('.select2_form').on('select2:unselect', function (e) {
                var attribute_value_id = e.params.data.id;
                var attribute_id = $(e.target).data("id");
                var product_id = {{$product->id}};
                var is_delete = confirm("Bạn có muốn xoá giá trị thuộc tính này không?");

                if (is_delete == true) {
                    let _url = `/admin/product-attribute-value/${attribute_value_id}`;
                    let _token   = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: _url,
                        type: 'DELETE',
                        data: {
                            product_id: product_id,
                            attribute_id: attribute_id,
                            attribute_value_id: attribute_value_id,
                            _token: _token
                        },
                        success: function(response) {
                            alert("deleted");
                        }
                    });
                    location.reload();
                }
            });
        });
    </script>

    <script>

        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "Nhập tóm tắt",
                tabsize: 2,
                height: 150
            });
        });
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "Nhập mô tả",
                tabsize: 2,
                height: 150
            });
        });
    </script>

    <script>
        var  child_cat_id='{{$product->child_cat_id}}';
        // alert(child_cat_id);
        $('#cat_id').change(function(){
            var cat_id=$(this).val();

            if(cat_id !=null){
                // ajax call
                $.ajax({
                    url:"/admin/category/"+cat_id+"/child",
                    type:"POST",
                    data:{
                        _token:"{{csrf_token()}}"
                    },
                    success:function(response){
                        if(typeof(response)!='object'){
                            response=$.parseJSON(response);
                        }
                        var html_option="<option value=''>--Chọn danh mục con--</option>";
                        if(response.status){
                            var data=response.data;
                            if(response.data){
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data,function(id,title){
                                    html_option += "<option value='"+id+"' "+(child_cat_id==id ? 'selected ' : '')+">"+title+"</option>";
                                });
                            }
                            else{
                                console.log('no response data');
                            }
                        }
                        else{
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);

                    }
                });
            }
            else{

            }

        });
        if(child_cat_id!=null){
            $('#cat_id').change();
        }
    </script>

    <script>
        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {
                $(".gallery").html("");
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview).addClass("img-thumbnail");
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#photo').on('change', function() {
                imagesPreview(this, 'div.gallery');
            });
        });
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
        var variantKey = "";
        var var_key = [];
        var sku = "";
        var var_sku = [];
        $(function() {
            $(".attribute-select").change(function () {
                var_key = [];
                var_sku = [];
                $(".attribute-select option:selected").each(function (key, item) {
                    var_key.push(item.value);
                    var_sku.push(item.value);
                });
                variantKey = var_key.join(",");
                sku = var_sku.join("-")
                sku = sku.replace(/\s/g, '');
            });
        });

        function addVariant() {
            $("#variant_id").val('');
            $("#variant_price").val('');
            $("#variant_stock").val('');
            $('#variant-modal').modal('show');
            console.log(variantKey);
        }

        function editVariant(event) {
            var id  = $(event).data("id");
            let _url = `/admin/product-variant/${id}`;
            $('#attributeError').text('');
            $('#stockError').text('');
            $('#priceError').text('');
            $('#statusError').text('');

            $.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if(response) {
                        $("#variant_id").val(response.id);
                        $("#variant_stock").val(response.stock);
                        $("#variant_price").val(response.price);
                        $("#variant_status").val(response.status);
                        $('#variant-modal').modal('show');
                    }
                }
            });
        }

        function createVariant() {
            var price = $('#variant_price').val();
            var stock = $('#variant_stock').val();
            var status = $('#variant_status').val();
            var id = $('#variant_id').val();
            var product_id = $('#product_id').val();
            var variant_key = variantKey;

            let _url     = `{{route("product-variant.store")}}`;
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    id: id,
                    product_id: product_id,
                    price: price,
                    stock: stock,
                    status: status,
                    variant_key: variant_key,
                    sku: sku,
                    _token: _token
                },
                success: function(response) {
                    if(response.code == 200) {
                        if(id != ""){
                            $("#row_"+id+" td:nth-child(2)").html(response.data.key);
                            $("#row_"+id+" td:nth-child(3)").html(response.data.sku);
                            $("#row_"+id+" td:nth-child(4)").html(response.data.stock);
                            $("#row_"+id+" td:nth-child(5)").html(response.data.price);
                            $("#row_"+id+" td:nth-child(6)").html(response.data.status);
                        } else {
                            if (response.data.status == 'active'){
                                status = 'Hoạt động';
                            } else {
                                status = 'Không hoạt động';
                            }
                            $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.key+'</td><td>'+response.data.sku+'</td><td>'+response.data.stock+'</td><td>'+number_format(response.data.price)+'₫</td><td>'+status+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editVariant(this)" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a><a class="btn btn-danger btn-sm dltBtn" href="javascript:void(0)" data-id="'+response.data.id+'" onclick="deleteVariant(this)" title="Delete" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-trash-alt"></i></a></td></tr>');
                        }
                        $('#variant-modal').modal('hide');
                    }
                },
                error: function(response) {
                    $('#valueError').text(response.responseJSON.errors.value);
                    $('#statusError').text(response.responseJSON.errors.status);
                }
            });
        }

        function deleteVariant(event) {
            var is_delete = confirm("Bạn có muốn xoá biến thể sản phẩm này không?");

            if (is_delete == true) {
                var id  = $(event).data("id");
                let _url = `/admin/product-variant/${id}`;
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: _url,
                    type: 'DELETE',
                    data: {
                        _token: _token
                    },
                    success: function(response) {
                        $("#row_"+id).remove();
                    }
                });
            }
        }
    </script>
@endpush
