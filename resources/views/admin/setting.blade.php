@extends('admin.layouts.master')
@section('title','HOA HONG MOBILE || CÀI ĐẶT CỬA HÀNG')
@section('main-content')

    <div class="card">
        <h5 class="card-header">THÔNG TIN CỬA HÀNG</h5>
        <div class="card-body">
            <form method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
                @csrf
                {{-- @method('PATCH') --}}
                {{-- {{dd($data)}} --}}
                <div class="form-group">
                    <label for="short_des" class="col-form-label">Mô tả ngắn gọn<span class="text-danger">*</span></label>
                    <textarea class="form-control" id="quote" name="short_des">{{$data->short_des}}</textarea>
                    @error('short_des')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description" class="col-form-label">Mô tả <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" name="description">{{$data->description}}</textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="upload-image-label">Ảnh logo</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="logo" name="logo">
                        <label id="custom-logo-label" class="custom-file-label" for="logo">Chọn ảnh</label>
                    </div>
                    @error('logo')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    @if(isset($data->logo))
                        <img class="img-fluid mt-2" id="img-logo-preview" width="150px" src="{{ asset('storage/'.$data->logo) }}"/>
                    @else
                        <img class="img-fluid mt-2" id="img-logo-preview" width="150px"/>
                    @endif
                </div>

                <div class="form-group">
                    <label class="upload-image-label">Ảnh lớn</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo">
                        <label id="custom-photo-label" class="custom-file-label" for="photo">Chọn ảnh</label>
                    </div>
                    @error('photo')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    @if(isset($data->photo))
                        <img class="img-fluid mt-2" id="img-photo-preview" width="400px" src="{{ asset('storage/'.$data->photo) }}"/>
                    @else
                        <img class="img-fluid mt-2" id="img-photo-preview" width="400px"/>
                    @endif
                </div>

                <div class="form-group">
                    <label for="address" class="col-form-label">Địa chỉ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="address" required value="{{$data->address}}">
                    @error('address')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" required value="{{$data->email}}">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone" class="col-form-label">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="phone" required value="{{$data->phone}}">
                    @error('phone')
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
            $('#quote').summernote({
                placeholder: "Nhập một đoạn mô tả ngắn về cửa hàng của bạn",
                tabsize: 2,
                height: 100
            });
        });
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "Nhập mô tả về cửa hàng của bạn",
                tabsize: 2,
                height: 150
            });
        });
    </script>

    <script>
        $("#logo").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings("#custom-logo-label").addClass("selected").html(fileName);
        });

        $(document).ready( function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#img-logo-preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#logo").change(function(){
                readURL(this);
            });
        });

        $("#photo").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings("#custom-photo-label").addClass("selected").html(fileName);
        });

        $(document).ready( function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#img-photo-preview').attr('src', e.target.result);
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
