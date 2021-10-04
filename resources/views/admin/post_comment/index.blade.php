@extends('admin.layouts.master')
@section('title','HOA HONG MOBILE || BÌNH LUẬN')
@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('admin.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Danh Sách Bình Luận</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if(count($comments)>0)
                    <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tác giả</th>
                            <th>Tiêu đề bài viết</th>
                            <th>Bình luận</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tác giả</th>
                            <th>Tiêu đề bài viết</th>
                            <th>Bình luận</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($comments as $comment)
                            {{-- {{$comment}}   --}}
                            @php
                                $title=DB::table('posts')->select('title')->where('id',$comment->post_id)->get();
                            @endphp
                            <tr>
                                <td>{{$comment->id}}</td>
                                <td>{{$comment->user_info['name']}}</td>
                                <td>@foreach($title as $data){{ $data->title}} @endforeach</td>
                                <td>{{$comment->comment}}</td>
                                <td>{{$comment->created_at->format('M d D, Y g: i a')}}</td>
                                <td>
                                    @if($comment->status=='active')
                                        <span class="badge badge-success">Hoạt động</span>
                                    @else
                                        <span class="badge badge-warning">Không hoạt động</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('post-comment.edit',$comment->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{route('post-comment.destroy',[$comment->id])}}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$comment->id}} data-toggle="tooltip" data-placement="bottom" title="Delete" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <span style="float:right">{{$comments->links()}}</span>
                @else
                    <h6 class="text-center">Không tìm thấy bất kì bình luận nào!!!</h6>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        div.dataTables_wrapper div.dataTables_paginate{
            display: none;
        }
    </style>
@endpush

@push('scripts')

    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
    <script>

        $('#order-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[5,6]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }
    </script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e){
                var form=$(this).closest('form');
                var dataID=$(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                    title: "Bạn chắc chứ?",
                    text: "Nếu bạn xoá bình luận này, bạn không thể khôi phục lại giá trị đã mất!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        }
                    });
            })
        })
    </script>
@endpush