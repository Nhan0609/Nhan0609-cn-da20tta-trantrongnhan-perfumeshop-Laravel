<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $featured_products = Product::where('trending', '1')->take(15)->get();
        $trending_category = Category::where('popular','1')->take(15)->get();
//sản phẩm nhiều view
        $productsRecommend = Product::Latest('view_count', 'desc')->take(15)->get();
        
        return view('frontend.index', compact('featured_products','trending_category', 'productsRecommend'));
    }

    public function category()
    {
        $category = Category::where('status', '0')->get();
        return view('frontend.category', compact('category'));
    }

    public function viewcategory($slug)
    {
        if(Category::where('slug', $slug)->exists())
        {
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('cate_id', $category->id)->where('status','0')->get();
            return view('frontend.products.index', compact('category', 'products'));
        }
        else
        {
            return redirect('/')->with('status', "Slug Không Tồn Tại");
        }     
    }

    public function productview($cate_slug, $prod_slug)
    {
    if(Category::where('slug', $cate_slug)->exists())
        {
            if(Product::where('slug', $prod_slug)->exists())
            {
                $products = Product::where('slug', $prod_slug)->first();
                return view('frontend.products.view', compact('products'));
            }
        else{
                return redirect('/')->with('status', "Không Tìm Thấy Liên Kết");
            }
        }
            else
                {
                    return redirect('/')->with('status', "Không Tìm Thấy Danh Mục");
                }    
            }


    public function search(Request $request)
    {

    $keywords = $request->keywords_submit;
    $search_product = Product::where('name', 'like', '%' . $keywords . '%')->paginate(10);

    return view('frontend.products.search', compact('search_product', 'keywords'));
    }


//     public function show($id)
// {
//     // Tìm sản phẩm
//     $product = Product::find($id);

//     // Tăng giá trị view_count
//     $product->increment('view_count');

//     // Các sự kiện hoặc hành động khác nếu cần

//     // Trả về view
//     return view('frontend.products.show', compact('product'));
// }
}

