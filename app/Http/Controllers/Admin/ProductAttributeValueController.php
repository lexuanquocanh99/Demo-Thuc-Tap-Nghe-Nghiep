<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductsAttributesValues;
use App\Models\ProductVariant;
use App\Models\AttributeValue;

class ProductAttributeValueController extends Controller
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
            'attribute_id'=>'required',
            'attribute_value_id'=>'required',
        ]);
        $status = ProductsAttributesValues::updateOrCreate(['id'=>$request->id],['product_id'=>$request->product_id,'attribute_id'=>$request->attribute_id,'attribute_value_id'=>$request->attribute_value_id]);
        return response()->json(['code'=>200, 'message'=>'Successfully','data' => $status], 200);
    }

    public function destroy($id, Request $request)
    {
        $attribute_value = AttributeValue::select('value')->where('id',$id)->get();
        ProductVariant::where('key', 'LIKE', '%'.$attribute_value[0]['value'].'%')->delete();
        $excute = ProductsAttributesValues::where('product_id',$request->product_id)->where('attribute_id',$request->attribute_id)->where('attribute_value_id',$id)->delete();
        return response()->json(['success'=>'Deleted successfully','data'=>$excute]);
    }

    public function deleteAttribute(Request $request)
    {
        $is_delete_variant = false;
        $attributes = ProductsAttributesValues::select('attribute_id')->where('product_id',$request->product_id)->distinct()->get();
        foreach ($attributes as $attribute) {
            if ($request->attribute_id == $attribute->attribute_id) {
                $is_delete_variant = true;
            }
        }
        if ($is_delete_variant) {
            ProductVariant::where('product_id',$request->product_id)->delete();
        }
        $excute = ProductsAttributesValues::where('product_id',$request->product_id)->where('attribute_id',$request->attribute_id)->delete();
        return response()->json(['success'=>'Deleted successfully','data'=>$excute]);
    }
}
