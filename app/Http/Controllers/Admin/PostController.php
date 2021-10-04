<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::getAllPost();
        return view('admin.post.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=PostCategory::get();
        $tags=PostTag::get();
        $users=User::get();
        return view('admin.post.create')->with('users',$users)->with('categories',$categories)->with('tags',$tags);
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
            'quote'=>'string|nullable',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'tags'=>'nullable',
            'added_by'=>'nullable',
            'post_cat_id'=>'required',
            'status'=>'required|in:active,inactive'
        ]);

        $data=$request->all();

        $slug=Str::slug($request->title);
        $count=Post::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;

        $tags=$request->input('tags');
        if($tags){
            $data['tags']=implode(',',$tags);
        }
        else{
            $data['tags']='';
        }
        $imageName = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('images/post', $imageName);
        $data['photo']='images/post/'.$imageName;
        $status=Post::create($data);
        if($status){
            request()->session()->flash('success','Bài viết đã được tạo');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại!');
        }
        return redirect()->route('post.index');
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
        $post=Post::findOrFail($id);
        $categories=PostCategory::get();
        $tags=PostTag::get();
        $users=User::get();
        return view('admin.post.edit')->with('categories',$categories)->with('users',$users)->with('tags',$tags)->with('post',$post);
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
        $post=Post::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'quote'=>'string|nullable',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'tags'=>'nullable',
            'added_by'=>'nullable',
            'post_cat_id'=>'required',
            'status'=>'required|in:active,inactive'
        ]);

        $data=$request->all();
        $tags=$request->input('tags');
        if($tags){
            $data['tags']=implode(',',$tags);
        }
        else{
            $data['tags']='';
        }
        if ($image = $request->file('photo')) {
            $imageName = $image->getClientOriginalName();
            $request->file('photo')->storeAs('images/post', $imageName);
            $data['photo']='images/post/'.$imageName;
        }else{
            unset($data['photo']);
        }
        $status=$post->fill($data)->save();
        if($status){
            request()->session()->flash('success','Bài viết đã được cập nhập');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại!');
        }
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::findOrFail($id);

        $status=$post->delete();

        if($status){
            request()->session()->flash('success','Bài viết đã được xóa');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại!');
        }
        return redirect()->route('post.index');
    }
}

