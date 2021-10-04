@extends('admin.layouts.master')
@section('title','HOA HONG MOBILE || TẠO SẢN PHẨM')
@section('main-content')

    <div class="card">
        <h5 class="card-header">Tạo Sản Phẩm</h5>
        <div class="card-body">
            <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="Nhập tiêu đề"  value="{{old('title')}}" class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sku" class="col-form-label">SKU <span class="text-danger">*</span></label>
                    <input id="sku" type="text" name="sku" placeholder="Nhập SKU"  value="{{old('sku')}}" class="form-control">
                    @error('sku')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">Tóm tắt <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
                    @error('summary')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="col-form-label">Mô tả </label>
                    <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="is_featured">Là sản phẩm đặc biệt?</label><br>
                    <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Có
                </div>
                {{-- {{$categories}} --}}

                <div class="form-group">
                    <label for="cat_id">Danh mục <span class="text-danger">*</span></label>
                    <select name="cat_id" id="cat_id" class="form-control">
                        <option value="">--Chọn danh mục--</option>
                        @foreach($categories as $key=>$cat_data)
                            <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group d-none" id="child_cat_div">
                    <label for="child_cat_id">Danh mục con</label>
                    <select name="child_cat_id" id="child_cat_id" class="form-control">
                        <option value="">--Chọn danh mục con--</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price" class="col-form-label">Giá <span class="text-danger">*</span></label>
                    <input id="price" type="number" name="price" placeholder="Nhập giá"  value="{{old('price')}}" class="form-control">
                    @error('price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="discount" class="col-form-label">Giảm giá(%)</label>
                    <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Nhập giảm giá"  value="{{old('discount')}}" class="form-control">
                    @error('discount')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="brand_id">Nhãn hiệu</label>
                    {{-- {{$brands}} --}}

                    <select name="brand_id" class="form-control">
                        <option value="">--Chọn nhãn hiệu--</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="condition">Tình trạng</label>
                    <select name="condition" class="form-control">
                        <option value="">--Chọn tình trạng--</option>
                        <option value="default">Mặc định</option>
                        <option value="new">Mới</option>
                        <option value="hot">Nổi bật</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="stock">Số lượng <span class="text-danger">*</span></label>
                    <input id="quantity" type="number" name="stock" min="0" placeholder="Nhập số lượng"  value="{{old('stock')}}" class="form-control">
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
                    <div class="gallery"></div>
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active">Hoạt động</option>
                        <option value="inactive">Không hoạt động</option>
                    </select>
                    @error('status')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-success" type="submit">Gửi</button>
                </div>
            </form>
        </div>
    </div>


@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
    <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $("#product_attribute").on("changed.bs.select", function(e, clickedIndex, isSelected, oldValue) {
            if (clickedIndex != null && isSelected != null) {
                var selectedD = $(this).find('option').eq(clickedIndex).val();
                console.log('selectedD: ' + selectedD +  ' oldValue: ' + oldValue);
                $('.select_attribute_'+selectedD+'').show();
                if (oldValue.includes(selectedD)) {
                    $('.select_attribute_'+selectedD+'').hide();
                    $('.'+selectedD+'').prop('checked', false);
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "Nhập tóm tắt",
                tabsize: 2,
                height: 100
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
        $('#cat_id').change(function(){
            var cat_id=$(this).val();
            // alert(cat_id);
            if(cat_id !=null){
                // Ajax call
                $.ajax({
                    url:"/admin/category/"+cat_id+"/child",
                    data:{
                        _token:"{{csrf_token()}}",
                        id:cat_id
                    },
                    type:"POST",
                    success:function(response){
                        if(typeof(response) !='object'){
                            response=$.parseJSON(response)
                        }
                        // console.log(response);
                        var html_option="<option value=''>----Chọn danh mục con----</option>"
                        if(response.status){
                            var data=response.data;
                            // alert(data);
                            if(response.data){
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data,function(id,title){
                                    html_option +="<option value='"+id+"'>"+title+"</option>"
                                });
                            }
                            else{
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
        })
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
@endpush
