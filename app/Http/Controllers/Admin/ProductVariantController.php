<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Product;

class ProductVariantController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'product_id'=>'required',
            'stock'=>'required',
            'price'=>'required',
            'status'=>'required|in:active,inactive'
        ]);
        $product_sku = Product::select('sku')->where('id',$request->product_id)->get();
        $sku = $product_sku[0]->sku."-".$request->sku;
        $status = ProductVariant::updateOrCreate(['id'=>$request->id],['product_id'=>$request->product_id,'key'=>$request->variant_key,'sku'=>$sku,'price'=>$request->price,'stock'=>$request->stock ,'status'=>$request->status]);
        return response()->json(['code'=>200, 'message'=>'Successfully','data' => $status], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_variant = ProductVariant::find($id);
        return response()->json($product_variant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_variant = ProductVariant::findOrFail($id);
        $excute = $product_variant->delete();
        return response()->json(['success'=>'Post Deleted successfully','data'=>$excute]);
    }

    public function check(Request $request) {
        $product_variant = ProductVariant::where('product_id',$request->product_id)->where('key',$request->variant_key)->first();
        return response()->json(['code'=>200, 'message'=>'Successfully','data' => $product_variant], 200);
    }
}
