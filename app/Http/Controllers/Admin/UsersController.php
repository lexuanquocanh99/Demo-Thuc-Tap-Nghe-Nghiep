<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::orderBy('id','ASC')->paginate(10);
        return view('admin.users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'string|required|max:30',
                'email'=>'string|required|unique:users',
                'password'=>'string|required',
                'status'=>'required|in:active,inactive',
                'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        $data=$request->all();
        $imageName = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('images/user', $imageName);
        $data['photo']='images/user/'.$imageName;
        $data['password']=Hash::make($request->password);
        $status=User::create($data);
        if($status){
            request()->session()->flash('success','Người dùng đã được tạo');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại!');
        }
        return redirect()->route('users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        return view('admin.users.edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $this->validate($request,
            [
                'name'=>'string|required|max:30',
                'email'=>'string|required',
                'status'=>'required|in:active,inactive',
                'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        $data=$request->all();
        if ($image = $request->file('photo')) {
            $imageName = $image->getClientOriginalName();
            $request->file('photo')->storeAs('images/user', $imageName);
            $data['photo']='images/user/'.$imageName;
        }else{
            unset($data['photo']);
        }
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Người dùng đã được cập nhập');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại');
        }
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=User::findorFail($id);
        $status=$delete->delete();
        if($status){
            request()->session()->flash('success','Người dùng đã được xóa');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại');
        }
        return redirect()->route('users.index');
    }
}
