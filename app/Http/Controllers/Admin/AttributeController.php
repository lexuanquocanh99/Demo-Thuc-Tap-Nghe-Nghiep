<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\AttributeValue;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attribute = ProductAttribute::orderBy('id','DESC')->paginate(10);
        return view('admin.product_attribute.index')->with('attribute',$attribute);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product_attribute.create');
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
        $status=ProductAttribute::create($data);
        if($status){
            request()->session()->flash('success','Thuộc tính sản phẩm đã được tạo');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại!');
        }
        return redirect()->route('product-attribute.index');
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
        $attribute=ProductAttribute::findOrFail($id);
        $attribute_values = AttributeValue::all()->where('attribute_id','=',$id);
        return view('admin.product_attribute.edit')->with(['attribute'=>$attribute,'attribute_values'=>$attribute_values]);
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
        $attribute=ProductAttribute::findOrFail($id);
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();
        $status=$attribute->fill($data)->save();
        if($status){
            request()->session()->flash('success','Thuộc tính sản phẩm đã được cập nhập');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại!!');
        }
        return redirect()->route('product-attribute.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = ProductAttribute::findOrFail($id);

        $status = $attribute->delete();

        if($status){
            request()->session()->flash('success','Thuộc tính sản phẩm đã được xoá');
        }
        else{
            request()->session()->flash('error','Xảy ra lỗi khi xóa thuộc tính sản phẩm');
        }
        return redirect()->route('product-attribute.index');
    }
}
