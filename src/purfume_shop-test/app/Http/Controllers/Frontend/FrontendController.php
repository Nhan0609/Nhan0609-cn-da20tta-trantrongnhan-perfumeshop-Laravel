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
        //Hiển thị sản phẩm thịnh hành
        $featured_products = Product::where('trending', '1')->take(15)->get();
        //Hiển thị danh mục thịnh hành
        $trending_category = Category::where('popular','1')->take(15)->get();
        //Hiển thị Sản phẩm nhiều view
        $productsRecommend = Product::Latest('view_count', 'desc')->take(15)->get();
        //Hiển thị sản phẩm mới cập nhật
        $newProducts = Product::orderBy('id', 'desc')->take(6)->get();
        //Hiển thị sản phẩm khác
        $productbodycare = Product::where('cate_id', 5)->get();

        return view('frontend.index', compact('featured_products','trending_category', 'productsRecommend','newProducts','productbodycare'));
    }
    

    public function category()
    {
        $category = Category::all();
        return view('frontend.category', compact('category'));
    }


//Hiển thị danh mục hot
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

//Hiển thị sản phẩm thịnh hành
    public function productview($cate_slug, $prod_slug)
    {
    if(Category::where('slug', $cate_slug)->exists())
        {
            if(Product::where('slug', $prod_slug)->exists())
            {
                $products = Product::where('slug', $prod_slug)->first();
                $products->view_count += 1; //Tăng số lượt xem
                $products->save(); 

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

//Hiển thị tất cả sản phẩm
    public function allprod()
    {
        $allProducts = Product::where('status', '0')->get();
        return view('frontend.products.allprod', compact('allProducts'));
    }

//Hiển thị bảng báo giá
public function quotation()
{
    // Lấy tất cả sản phẩm với thông tin danh mục (eager loading)
    // $products = Product::with('category')->select('name', 'qty', 'original_price', 'selling_price', 'image')->get();
    $products = Product::all();

    // Lấy danh sách các danh mục
    $categories = Category::select('slug')->get();

    return view('frontend.products.quotation', compact('products', 'categories'));
}





//Tìm kiếm sản phẩm
    public function search(Request $request)
    {

    $keywords = $request->keywords_submit;
    $search_product = Product::where('name', 'like', '%' . $keywords . '%')->paginate(10);

    return view('frontend.products.search', compact('search_product', 'keywords'));
    }

//Xem giới thiệu website
    public function viewintroduce()
    {
        return view('interact.introduce');
    }
//Xem liên hệ    
    public function viewcontact()
    {
        return view('interact.contact');
    }

}

