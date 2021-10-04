<?php

namespace App\Http\Controllers\Store;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Element;
use App\Models\ProductVariant;

class CartController extends Controller
{
    protected $product=null;
    public function __construct(Product $product){
        $this->product=$product;
    }

    public function addToCart(Request $request){
        if (empty($request->slug)) {
            request()->session()->flash('error','Sản phẩm không tồn tại');
            return back();
        }
        $product = Product::where('slug', $request->slug)->first();
        if (empty($product)) {
            request()->session()->flash('error','Sản phẩm không tồn tại');
            return back();
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();
        if($already_cart) {
            $already_cart->quantity = $already_cart->quantity + 1;
            $already_cart->amount = $product->price+ $already_cart->amount;
            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Số lượng hàng trong kho không đủ!');
            $already_cart->save();
        }else{
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = ($product->price-($product->price*$product->discount)/100);
            $cart->quantity = 1;
            $cart->amount=$cart->price*$cart->quantity;
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Số lượng hàng trong kho không đủ!');
            $cart->save();
            $wishlist=Wishlist::where('user_id',auth()->user()->id)->where('cart_id',null)->update(['cart_id'=>$cart->id]);
        }
        request()->session()->flash('success','Đã thêm sản phẩm vào giỏ hàng');
        return back();
    }

    public function singleAddToCart(Request $request){
        $request->validate([
            'slug'      =>  'required',
            'quant'      =>  'required',
        ]);
        $product = Product::where('slug', $request->slug)->first();
        if (isset($request->product_options)) {
            $key = implode(",", $request->product_options);
            $product_variant = ProductVariant::where('product_id',$product->id)->where('key',$key)->first();
            if (isset($product_variant)) {
                if ($request->quant[1] > $product_variant->stock) {
                    return back()->with('error','Hết hàng');
                } else {
                    $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->where('product_variant_id', $product_variant->id)->first();
                    // return $already_cart;
                    if($already_cart) {
                        $already_cart->quantity = $already_cart->quantity + $request->quant[1];
                        $already_cart->amount = ($product_variant->price * $request->quant[1])+ $already_cart->amount;
                        if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Số lượng hàng trong kho không đủ!');
                        $already_cart->save();
                    }else{
                        $cart = new Cart;
                        $cart->user_id = auth()->user()->id;
                        $cart->product_id = $product->id;
                        $cart->product_variant_id = $product_variant->id;
                        $cart->price = ($product_variant->price-($product_variant->price*$product->discount)/100);
                        $cart->quantity = $request->quant[1];
                        $cart->amount=($cart->price * $request->quant[1]);
                        if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Số lượng hàng trong kho không đủ!');
                        $cart->save();
                    }
                }
            } else {
                return back()->with('error','Sản phẩm không tồn tại!');
            }
        } else {
            if($product->stock <$request->quant[1]){
                return back()->with('error','Hết hàng');
            }
            if ( ($request->quant[1] < 1) || empty($product) ) {
                request()->session()->flash('error','Sản phẩm không tồn tại');
                return back();
            }
            $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();
            // return $already_cart;

            if($already_cart) {
                $already_cart->quantity = $already_cart->quantity + $request->quant[1];
                $already_cart->amount = ($product->price * $request->quant[1])+ $already_cart->amount;
                if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Số lượng hàng trong kho không đủ!');
                $already_cart->save();
            }else{
                $cart = new Cart;
                $cart->user_id = auth()->user()->id;
                $cart->product_id = $product->id;
                $cart->price = ($product->price-($product->price*$product->discount)/100);
                $cart->quantity = $request->quant[1];
                $cart->amount=($cart->price * $request->quant[1]);
                if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Số lượng hàng trong kho không đủ!');
                $cart->save();
            }
        }
        request()->session()->flash('success','Đã thêm sản phẩm vào giỏ hàng');
        return back();
    }

    public function cartDelete(Request $request){
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->delete();
            request()->session()->flash('success','Đã xóa khỏi giỏ hàng');
            return back();
        }
        request()->session()->flash('error','Vui lòng thử lại');
        return back();
    }

    public function cartUpdate(Request $request){
        $carts = $request->all();
        foreach ($carts['cart'] as $data) {
            $error = array();
            $success = '';
            if (isset($data['product_variant_key'])) {
                $id = $data['qty_id'];
                $product_variant = ProductVariant::where('product_id',$data['product_id'])->where('key',$data['product_variant_key'])->get();
                $cart = Cart::find($id);
                if($data['quant'] > 0 && $cart) {
                    if($product_variant[0]->stock < $data['quant']){
                        request()->session()->flash('error','Hết hàng');
                        return back();
                    }
                    $cart->quantity = ($product_variant[0]->stock > $data['quant']) ? $data['quant']  : $product_variant[0]->stock;
                    if ($product_variant[0]->stock <=0) continue;
                    $after_price = ($product_variant[0]->price-($product_variant[0]->price*$cart->product->discount)/100);
                    $cart->amount = $after_price * $data['quant'];
                    $cart->save();
                    $success = 'Giỏ hàng đã được cập nhập';
                }else{
                    $error[] = 'Không tìm thấy giỏ hàng';
                }
            } else {
                $id = $data['qty_id'];
                $cart = Cart::find($id);
                if($data['quant'] > 0 && $cart) {
                    if($cart->product->stock < $data['quant']){
                        request()->session()->flash('error','Hết hàng');
                        return back();
                    }
                    $cart->quantity = ($cart->product->stock > $data['quant']) ? $data['quant']  : $cart->product->stock;
                    if ($cart->product->stock <=0) continue;
                    $after_price=($cart->product->price-($cart->product->price*$cart->product->discount)/100);
                    $cart->amount = $after_price * $data['quant'];
                    $cart->save();
                    $success = 'Giỏ hàng đã được cập nhập';
                }else{
                    $error[] = 'Không tìm thấy giỏ hàng';
                }
            }
        }
        return back()->with($error)->with('success', $success);
    }

    public function checkout(Request $request){
        return view('store.pages.checkout');
    }
}

