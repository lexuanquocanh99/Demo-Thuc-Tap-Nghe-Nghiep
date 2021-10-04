@extends('admin.layouts.master')
@section('title','HOA HONG MOBILE || CHỈNH SỬA THUỘC TÍNH SẢN PHẨM')
@section('main-content')

    <div class="card">
        <h5 class="card-header">Chỉnh Sửa Thuộc Tính Sản Phẩm</h5>
        <div class="card-body">
            <form method="post" action="{{route('product-attribute.update',$attribute->id)}}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Tiêu đề</label>
                    <input id="inputTitle" type="text" name="title" placeholder="Nhập tiêu đề"  value="{{$attribute->title}}" class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="active" {{(($attribute->status=='active') ? 'selected' : '')}}>Hoạt động</option>
                        <option value="inactive" {{(($attribute->status=='inactive') ? 'selected' : '')}}>Không hoạt động</option>
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
        <h5 class="card-header">Giá Trị Thuộc Tính Sản Phẩm</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-right">
                    <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-value" onclick="addValue()">Tạo Giá Trị</a>
                </div>
            </div>
            <div class="row" style="clear: both;margin-top: 18px;">
                <div class="col-12">
                    <table id="attribute_value_table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Giá trị</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($attribute_values as $data)
                            <tr id="row_{{$data->id}}">
                                <td>{{ $data->id  }}</td>
                                <td>{{ $data->value }}</td>
                                <td>@if($data->status == 'active') Hoạt động @else Không hoạt động @endif</td>
                                <td>
                                    <a href="javascript:void(0)" data-id="{{ $data->id }}" onclick="editValue(this)" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm dltBtn" href="javascript:void(0)" data-id="{{ $data->id }}" onclick="deleteValue(this)" title="Delete" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="value-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tạo Giá Trị Thuộc Tính</h4>
                </div>
                <div class="modal-body">
                    <form name="userForm" class="form-horizontal">
                        <input type="hidden" name="value_id" id="value_id">
                        <input type="hidden" name="attribute_id" id="attribute_id" value="{{$attribute->id}}">
                        <div class="form-group">
                            <label for="value" class="col-sm-2">Giá trị</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="value" name="value" placeholder="Nhập giá trị">
                                <span id="valueError" class="alert-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-sm-2">Trạng thái</label>
                            <div class="col-sm-12">
                                <select name="status" id="status" class="form-control">
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
                    <button type="button" class="btn btn-primary" onclick="createValue()">Lưu</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

    <style>
        .alert-message {
            color: red;
        }
    </style>
@endpush

@push('scripts')
    <script>

        function addValue() {
            $("#value_id").val('');
            $("#value").val('');
            $("div.col-sm-12 select").val("").change();
            $('#value-modal').modal('show');
        }

        function editValue(event) {
            var id  = $(event).data("id");
            let _url = `/admin/attribute-value/${id}`;
            $('#valueError').text('');
            $('#statusError').text('');

            $.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if(response) {
                        $("#value_id").val(response.id);
                        $("#value").val(response.value);
                        $("#status").val(response.status);
                        $('#value-modal').modal('show');
                    }
                }
            });
        }

        function createValue() {
            var value = $('#value').val();
            var status = $('#status').val();
            var id = $('#value_id').val();
            var attribute_id = $('#attribute_id').val();

            let _url     = `{{route("attribute-value.store")}}`;
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    id: id,
                    attribute_id: attribute_id,
                    value: value,
                    status: status,
                    _token: _token
                },
                success: function(response) {
                    if(response.code == 200) {
                        if(id != ""){
                            $("#row_"+id+" td:nth-child(2)").html(response.data.value);
                            if (response.data.status == 'active') {
                                let status = "Hoạt động";
                            } else {
                                let status = "Không hoạt động"
                            }
                            $("#row_"+id+" td:nth-child(3)").html(status);
                        } else {

                            $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.value+'</td><td>'+status+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editValue(this)" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a><a class="btn btn-danger btn-sm dltBtn" href="javascript:void(0)" data-id="'+response.data.id+'" onclick="deleteValue(this)" title="Delete" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-trash-alt"></i></a></td></tr>');
                        }
                        $('#value-modal').modal('hide');
                    }
                },
                error: function(response) {
                    $('#valueError').text(response.responseJSON.errors.value);
                    $('#statusError').text(response.responseJSON.errors.status);
                }
            });
        }

        function deleteValue(event) {
            var is_delete = confirm("Bạn có muốn xoá giá trị này?");

            if (is_delete == true) {
                var id  = $(event).data("id");
                let _url = `/admin/attribute-value/${id}`;
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
