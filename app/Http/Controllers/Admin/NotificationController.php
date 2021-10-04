<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index(){
        return view('admin.notification.index');
    }
    public function show(Request $request){
        $notification=Auth()->user()->notifications()->where('id',$request->id)->first();
        if($notification){
            $notification->markAsRead();
            return redirect($notification->data['actionURL']);
        }
    }
    public function delete($id){
        $notification=Notification::find($id);
        if($notification){
            $status=$notification->delete();
            if($status){
                request()->session()->flash('success','Thông báo đã được xóa');
                return back();
            }
            else{
                request()->session()->flash('error','Vui lòng thử lại');
                return back();
            }
        }
        else{
            request()->session()->flash('error','Không tìm thấy');
            return back();
        }
    }
}
