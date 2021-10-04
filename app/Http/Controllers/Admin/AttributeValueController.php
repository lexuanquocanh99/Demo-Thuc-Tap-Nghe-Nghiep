<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
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
            'attribute_id'=>'required',
            'value'=>'string|required',
            'status'=>'required|in:active,inactive'
        ]);
        $status = AttributeValue::updateOrCreate(['id'=>$request->id],['attribute_id'=>$request->attribute_id,'value'=>$request->value,'status'=>$request->status]);
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
        $attribute_value = AttributeValue::find($id);
        return response()->json($attribute_value);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute_value = AttributeValue::findOrFail($id);
        $excute = $attribute_value->delete();
        return response()->json(['success'=>'Post Deleted successfully','data'=>$excute]);
    }
}
