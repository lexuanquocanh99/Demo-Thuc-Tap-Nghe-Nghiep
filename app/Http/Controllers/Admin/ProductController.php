<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductsAttributesValues;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::getAllProduct();
        return view('admin.product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::get();
        $category = Category::where('is_parent',1)->get();
        $attributes = ProductAttribute::get();
        return view('admin.product.create')->with('categories',$category)->with('brands',$brand)->with('attributes',$attributes);
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
            'sku'=>'string|required|alpha_dash',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'brand_id'=>'nullable|exists:brands,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'status'=>'required|in:active,inactive',
            'condition'=>'required|in:default,new,hot',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric'
        ]);
        $data = $request->all();
        $slug=Str::slug($request->title);
        $count=Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        if ($request->hasFile('photo')) {
            $photos = $request->file('photo');
            $photoArr=array();
            foreach ($photos as $photo) {
                $imageName = $photo->getClientOriginalName();
                $photo->storeAs('images/product', $imageName);
                $path = 'images/product/'.$imageName;
                $photoArr[] = $path;
            }
            $data['photo']=implode(",",$photoArr);
        }
        $data['is_featured']=$request->input('is_featured',0);
        $status = Product::create($data);
        if($status){
            request()->session()->flash('success','Sản phẩm đã được tạo');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại!');
        }
        return redirect()->route('product.index');
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
        $brand=Brand::get();
        $product=Product::findOrFail($id);
        $category=Category::where('is_parent',1)->get();
        $items=Product::where('id',$id)->get();
        $attributes = ProductAttribute::get();
        return view('admin.product.edit')->with('product',$product)->with('brands',$brand)->with('categories',$category)->with('items',$items)->with('attributes',$attributes);
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
        $product=Product::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'sku'=>'string|required|alpha_dash',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'brand_id'=>'nullable|exists:brands,id',
            'status'=>'required|in:active,inactive',
            'condition'=>'required|in:default,new,hot',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric'
        ]);

        $data=$request->all();
        $data['is_featured']=$request->input('is_featured',0);
        if ($request->hasFile('photo')) {
            $photos = $request->file('photo');
            $photoArr=array();
            foreach ($photos as $photo) {
                $imageName = $photo->getClientOriginalName();
                $photo->storeAs('images/product', $imageName);
                $path = 'images/product/'.$imageName;
                $photoArr[] = $path;
            }
            $data['photo']=implode(",",$photoArr);
        } else {
            unset($data['photo']);
        }
        $status=$product->fill($data)->save();
        if($status){
            request()->session()->flash('success','Sản phẩm đã được cập nhập');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $status=$product->delete();

        if($status){
            request()->session()->flash('success','Sản phẩm đã được xóa');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại');
        }
        return redirect()->route('product.index');
    }
}
