<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttributesValues;

class StoreController extends Controller
{
    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }

    public function home(){
        $featured=Product::where('status','active')->where('is_featured',1)->orderBy('price','DESC')->limit(2)->get();
        $posts=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        $products=Product::where('status','active')->orderBy('id','DESC')->limit(8)->get();
        $category=Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
        $attributes = ProductAttribute::get();
        return view('store.index')
            ->with('featured',$featured)
            ->with('posts',$posts)
            ->with('banners',$banners)
            ->with('product_lists',$products)
            ->with('category_lists',$category)
            ->with('attributes',$attributes);
    }

    public function productSearch(Request $request){
        $attributes = ProductAttribute::get();
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $products=Product::orwhere('title','like','%'.$request->search.'%')
            ->orwhere('slug','like','%'.$request->search.'%')
            ->orwhere('description','like','%'.$request->search.'%')
            ->orwhere('summary','like','%'.$request->search.'%')
            ->orwhere('price','like','%'.$request->search.'%')
            ->orderBy('id','DESC')
            ->paginate('9');
        return view('store.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products)->with('attributes',$attributes);
    }

    public function productGrids(){
        $attributes = ProductAttribute::get();
        $products=Product::query();

        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids);
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));

            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(9);
        }
        // Sort by name , price, category


        return view('store.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products)->with('attributes',$attributes);
    }

    public function productLists(){
        $attributes = ProductAttribute::get();
        $products=Product::query();
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids)->paginate;
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));

            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(6);
        }
        // Sort by name , price, category
        return view('store.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products)->with('attributes',$attributes);
    }

    public function productFilter(Request $request){
        $data= $request->all();
        // return $data;
        $showURL="";
        if(!empty($data['show'])){
            $showURL .='&show='.$data['show'];
        }

        $sortByURL='';
        if(!empty($data['sortBy'])){
            $sortByURL .='&sortBy='.$data['sortBy'];
        }

        $catURL="";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catURL)){
                    $catURL .='&category='.$category;
                }
                else{
                    $catURL .=','.$category;
                }
            }
        }

        $brandURL="";
        if(!empty($data['brand'])){
            foreach($data['brand'] as $brand){
                if(empty($brandURL)){
                    $brandURL .='&brand='.$brand;
                }
                else{
                    $brandURL .=','.$brand;
                }
            }
        }
        // return $brandURL;

        $priceRangeURL="";
        if(!empty($data['price_range'])){
            $priceRangeURL .='&price='.$data['price_range'];
        }
        return redirect()->route('product-lists',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
    }

    public function productCat(Request $request){
        $products=Category::getProductByCat($request->slug);
        $attributes = ProductAttribute::get();
        // return $request->slug;
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('store.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products)->with('attributes',$attributes);
    }

    public function productSubCat(Request $request){
        $attributes = ProductAttribute::get();
        $products=Category::getProductBySubCat($request->sub_slug);
        // return $products;
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
            return view('store.pages.product-lists')->with('products',$products->sub_products)->with('recent_products',$recent_products)->with('attributes',$attributes);
    }

    public function productDetail($slug){
        $product_detail= Product::getProductBySlug($slug);
        $product_options = ProductsAttributesValues::where('product_id',$product_detail->id)->get();
        $is_product_option = true;
        if ($product_options->first() == null) {
            $is_product_option = false;
        }
        $attributes = ProductAttribute::get();
        return view('store.pages.product_detail')->with('product_detail',$product_detail)->with('is_product_option',$is_product_option)->with('attributes',$attributes);
    }

    public function productBrand(Request $request){
        $attributes = ProductAttribute::get();
        $products=Brand::getProductByBrand($request->slug);
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('store.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products)->with('attributes',$attributes);
    }

    public function aboutUs(){
        return view('store.pages.about-us');
    }

    public function contact(){
        return view('store.pages.contact');
    }
}
