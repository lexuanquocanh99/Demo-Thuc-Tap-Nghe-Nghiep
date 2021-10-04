<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PostTag;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class PostTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postTag=PostTag::orderBy('id','DESC')->paginate(10);
        return view('admin.posttag.index')->with('postTags',$postTag);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posttag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'string|required',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();
        $slug=Str::slug($request->title);
        $count=PostTag::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        $status=PostTag::create($data);
        if($status){
            request()->session()->flash('success','Thẻ đã được tạo');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại!');
        }
        return redirect()->route('post-tag.index');
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
        $postTag=PostTag::findOrFail($id);
        return view('admin.posttag.edit')->with('postTag',$postTag);
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
        $postTag=PostTag::findOrFail($id);
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();
        $status=$postTag->fill($data)->save();
        if($status){
            request()->session()->flash('success','Thẻ đã được cập nhập');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại!');
        }
        return redirect()->route('post-tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postTag=PostTag::findOrFail($id);

        $status=$postTag->delete();

        if($status){
            request()->session()->flash('success','Thẻ đã được xóa');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại');
        }
        return redirect()->route('post-tag.index');
    }
}
