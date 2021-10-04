@extends('admin.layouts.master')
@section('title','HOA HONG MOBILE || TẠO VẬN CHUYỂN')
@section('main-content')

    <div class="card">
        <h5 class="card-header">Tạo Vận Chuyển</h5>
        <div class="card-body">
            <form method="post" action="{{route('shipping.store')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Tên <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="type" placeholder="Nhập tên"  value="{{old('type')}}" class="form-control">
                    @error('type')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="col-form-label">Giá <span class="text-danger">*</span></label>
                    <input id="price" type="number" name="price" placeholder="Nhập giá"  value="{{old('price')}}" class="form-control">
                    @error('price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
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
@endpush
@push('scripts')
    <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
@endpush
