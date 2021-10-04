@extends('admin.layouts.master')
@section('title','HOA HONG MOBILE || CHỈNH SỬA BANNER')
@section('main-content')

    <div class="card">
        <h5 class="card-header">Chỉnh sửa Banner</h5>
        <div class="card-body">
            <form method="post" action="{{route('banner.update',$banner->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$banner->title}}" class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputDesc" class="col-form-label">Mô tả</label>
                    <textarea class="form-control" id="description" name="description">{{$banner->description}}</textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
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
                    @if(isset($banner->photo))
                        <img class="img-fluid mt-2" id="img-preview" width="300px" src="{{ asset('storage/'.$banner->photo) }}"/>
                    @else
                        <img class="img-fluid mt-2" id="img-preview" width="300px"/>
                    @endif
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active" {{(($banner->status=='active') ? 'selected' : '')}}>Hoạt động</option>
                        <option value="inactive" {{(($banner->status=='inactive') ? 'selected' : '')}}>Không hoạt động</option>
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
            $('#description').summernote({
                placeholder: "Thêm mô tả",
                tabsize: 2,
                height: 150
            });
        });
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

    <script>
        $(".btn-reset").on("click", function (){
            $(".custom-file-label").removeClass("selected").html("Choose image");
            $("#img-preview").removeAttr("src");
        });
    </script>
@endpush
