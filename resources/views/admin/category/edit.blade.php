@extends('admin.layouts.master')
@section('title','HOA HONG MOBILE || CHỈNH SỬA DANH MỤC SẢN PHẨM')
@section('main-content')

    <div class="card">
        <h5 class="card-header">Chỉnh Sửa Danh Mục Sản Phẩm</h5>
        <div class="card-body">
            <form method="post" action="{{route('category.update',$category->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="Nhập tiêu đề"  value="{{$category->title}}" class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">Tóm tắt</label>
                    <textarea class="form-control" id="summary" name="summary">{{$category->summary}}</textarea>
                    @error('summary')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="is_parent">Có phải danh mục sản phẩm cha?</label><br>
                    <input type="checkbox" name='is_parent' id='is_parent' value='{{$category->is_parent}}' {{(($category->is_parent==1)? 'checked' : '')}}> Yes
                </div>
                {{-- {{$parent_cats}} --}}
                {{-- {{$category}} --}}

                <div class="form-group {{(($category->is_parent==1) ? 'd-none' : '')}}" id='parent_cat_div'>
                    <label for="parent_id">Danh mục sản phẩm cha</label>
                    <select name="parent_id" class="form-control">
                        <option value="">--Chọn danh mục sản phẩm--</option>
                        @foreach($parent_cats as $key=>$parent_cat)
                            <option value='{{$parent_cat->id}}' {{(($parent_cat->id==$category->parent_id) ? 'selected' : '')}}>{{$parent_cat->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="upload-image-label">Hình ảnh</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo">
                        <label class="custom-file-label" for="photo">Chọn ảnh</label>
                    </div>
                    @error('photo')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    @if(isset($category->photo))
                        <img class="img-fluid mt-2" id="img-preview" width="300px" src="{{ asset('storage/'.$category->photo) }}"/>
                    @else
                        <img class="img-fluid mt-2" id="img-preview" width="300px"/>
                    @endif
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active" {{(($category->status=='active')? 'selected' : '')}}>Hoạt động</option>
                        <option value="inactive" {{(($category->status=='inactive')? 'selected' : '')}}>Không hoạt động</option>
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

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
    <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "Nhập tóm tắt",
                tabsize: 2,
                height: 120
            });
        });
    </script>

    <script>
        $('#is_parent').change(function(){
            var is_checked=$('#is_parent').prop('checked');
            // alert(is_checked);
            if(is_checked){
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
            }
            else{
                $('#parent_cat_div').removeClass('d-none');
            }
        })
    </script>

    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $(document).ready( function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#img-preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#photo").change(function(){
                readURL(this);
            });
        });
    </script>
@endpush
