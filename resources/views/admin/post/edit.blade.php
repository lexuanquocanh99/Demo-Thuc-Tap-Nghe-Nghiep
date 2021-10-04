@extends('admin.layouts.master')
@section('title','HOA HONG MOBILE || CHỈNH SỬA BÀI VIẾT')
@section('main-content')

    <div class="card">
        <h5 class="card-header">Chỉnh Sửa Bài Viết</h5>
        <div class="card-body">
            <form method="post" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="Nhập tiêu đề"  value="{{$post->title}}" class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quote" class="col-form-label">Trích dẫn</label>
                    <textarea class="form-control" id="quote" name="quote">{{$post->quote}}</textarea>
                    @error('quote')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">Tóm tắt <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" name="summary">{{$post->summary}}</textarea>
                    @error('summary')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="col-form-label">Mô tả</label>
                    <textarea class="form-control" id="description" name="description">{{$post->description}}</textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="post_cat_id">Danh mục <span class="text-danger">*</span></label>
                    <select name="post_cat_id" class="form-control">
                        <option value="">--Chọn danh mục--</option>
                        @foreach($categories as $key=>$data)
                            <option value='{{$data->id}}' {{(($data->id==$post->post_cat_id)? 'selected' : '')}}>{{$data->title}}</option>
                        @endforeach
                    </select>
                </div>
                {{-- {{$post->tags}} --}}
                @php
                    $post_tags=explode(',',$post->tags);
                    // dd($tags);
                @endphp
                <div class="form-group">
                    <label for="tags">Thẻ</label>
                    <select name="tags[]" multiple  data-live-search="true" class="form-control selectpicker">
                        <option value="">--Chọn thẻ--</option>
                        @foreach($tags as $key=>$data)
                            <option value="{{$data->title}}"  {{(( in_array( "$data->title",$post_tags ) ) ? 'selected' : '')}}>{{$data->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="added_by">Tác giả</label>
                    <select name="added_by" class="form-control">
                        <option value="">--Chọn tác giả--</option>
                        @foreach($users as $key=>$data)
                            <option value='{{$data->id}}' {{(($post->added_by==$data->id)? 'selected' : '')}}>{{$data->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="upload-image-label">Hình ảnh</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo">
                        <label class="custom-file-label" for="photo">Chọn hình ảnh</label>
                    </div>
                    @error('photo')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    @if(isset($post->photo))
                        <img class="img-fluid mt-2" id="img-preview" width="300px" src="{{ asset('storage/'.$post->photo) }}"/>
                    @else
                        <img class="img-fluid mt-2" id="img-preview" width="300px"/>
                    @endif
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active" {{(($post->status=='active')? 'selected' : '')}}>Hoạt động</option>
                        <option value="inactive" {{(($post->status=='inactive')? 'selected' : '')}}>Không hoạt động</option>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endpush
@push('scripts')
    <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>

        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 150
            });
        });

        $(document).ready(function() {
            $('#quote').summernote({
                placeholder: "Write short Quote.....",
                tabsize: 2,
                height: 100
            });
        });
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "Write detail description.....",
                tabsize: 2,
                height: 500
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
