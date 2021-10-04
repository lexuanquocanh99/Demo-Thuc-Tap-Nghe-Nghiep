@extends('admin.layouts.master')
@section('title','HOA HONG MOBILE || CHỈNH SỬA NHÃN HIỆU')
@section('main-content')

    <div class="card">
        <h5 class="card-header">Chỉnh Sửa Nhãn Hiệu</h5>
        <div class="card-body">
            <form method="post" action="{{route('brand.update',$brand->id)}}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="Nhập tiêu đề"  value="{{$brand->title}}" class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status" class="col-form-label">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active" {{(($brand->status=='active') ? 'selected' : '')}}>Hoạt động</option>
                        <option value="inactive" {{(($brand->status=='inactive') ? 'selected' : '')}}>Không hoạt động</option>
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
