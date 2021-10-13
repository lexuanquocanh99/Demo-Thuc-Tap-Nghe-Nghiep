<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check())
        {
            $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
                ->where('created_at', '>', Carbon::today()->subDay(6))
                ->groupBy('day_name','day')
                ->orderBy('day')
                ->get();
            $array[] = ['Name', 'Number'];
            foreach($data as $key => $value)
            {
                $array[++$key] = [__($value->day_name), $value->count];
            }
            return view('admin.dashboard')->with('users', json_encode($array));
        } else {
            return view('admin.auth.login');
        }
    }

    public function settings(){
        $data=Setting::first();
        return view('admin.setting')->with('data',$data);
    }

    public function settingsUpdate(Request $request){
        $this->validate($request,[
            'short_des'=>'required|string',
            'description'=>'required|string',
            'address'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|string',
        ]);
        $data=$request->all();
        $settings=Setting::first();
        if ($image = $request->file('logo')) {
            $imageName = $image->getClientOriginalName();
            $request->file('logo')->storeAs('images/store', $imageName);
            $data['logo']='images/store/'.$imageName;
        }else{
            unset($data['logo']);
        }
        if ($image = $request->file('photo')) {
            $imageName = $image->getClientOriginalName();
            $request->file('photo')->storeAs('images/store', $imageName);
            $data['photo']='images/store/'.$imageName;
        }else{
            unset($data['photo']);
        }
        $status=$settings->fill($data)->save();
        if($status){
            request()->session()->flash('success','Thiết lập đã được cập nhập');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại');
        }
        return redirect()->route('dashboard');
    }
}
