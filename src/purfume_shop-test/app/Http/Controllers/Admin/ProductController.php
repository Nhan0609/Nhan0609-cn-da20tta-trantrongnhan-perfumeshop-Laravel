<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function add()
    {
        $category = Category::all();
        return view('admin.product.add', compact('category'));
    }
    
    public function insert(Request $request)
    {
        $products = new Product();
        if($request-> hasFile('image'))
            {
                $file = $request -> file('image');
                $ext = $file -> getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('assets/uploads/products/',$filename);
                $products->image = $filename;
            }
            $products-> cate_id = $request ->input('cate_id');
            $products-> name = $request ->input('name');
            $products-> slug = $request ->input('slug');
            $products-> small_description = $request ->input('small_description');
            $products-> description = $request ->input('description');
            $products-> original_price = $request ->input('original_price');
            $products-> selling_price = $request ->input('selling_price');
            $products-> tax = $request ->input('tax');
            $products-> qty = $request ->input('qty');
            $products-> status = $request ->input('status')== TRUE ? '1':'0';
            $products-> trending = $request ->input('trending')== TRUE ? '1':'0';
            $products-> meta_title = $request ->input('meta_title');
            $products-> meta_keywords = $request ->input('meta_keywords');
            $products-> meta_description = $request ->input('meta_description');
            
            $products->save();

            if($request-> hasFile('image2'))
            {
                foreach($request -> file('image2') as $imgDetail) {
                    $imgName = $products->id .'_'. time() . rand(1, 1000) .'.'. $imgDetail->getClientOriginalExtension();
                    $imgDetail->move('assets/multiple_image/products/',$imgName);
                    
                    $image = new Image();
                    $image->prod_id = $products->id;
                    $image->image_path = $imgName;
                    $image->save();
                }
            }
            return redirect('products')->with('status',"Thêm Sản Phẩm Thành Công");
   
    }

    public function edit($id)
    {
        $products = Product::find($id);
        return view('admin.product.edit', compact('products'));
    }

    public function upload(Request $request, $id)
    {
        $products = Product::find($id);
        if($request-> hasFile('image'))
            {
                $path = 'assets/uploads/products/'.$products->image;
                    if(File::exists($path))
                    {
                        File::delete($path);
                    }

                $file = $request -> file('image');
                $ext = $file -> getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('assets/uploads/products/',$filename);
                $products->image = $filename;
            }
            $products-> name = $request ->input('name');
            $products-> slug = $request ->input('slug');
            $products-> small_description = $request ->input('small_description');
            $products-> description = $request ->input('description');
            $products-> original_price = $request ->input('original_price');
            $products-> selling_price = $request ->input('selling_price');
            $products-> tax = $request ->input('tax');
            $products-> qty = $request ->input('qty');
            $products-> status = $request ->input('status')== TRUE ? '1':'0';
            $products-> trending = $request ->input('trending')== TRUE ? '1':'0';
            $products-> meta_title = $request ->input('meta_title');
            $products-> meta_keywords = $request ->input('meta_keywords');
            $products-> meta_description = $request ->input('meta_description');

            $products->update();
//upload nhiều ảnh
            if($request-> hasFile('image2'))
            {
                $mul_images = Image::where('prod_id', $id)->get();
                $path_mul = 'assets/multiple_image/products/';
                foreach ($mul_images as $img) {
                    if(File::exists($path_mul . $img->image_path))
                    {
                        File::delete($path_mul . $img->image_path);
                    }
                    $img -> delete();
                }

                foreach($request -> file('image2') as $imgDetail) {
                    $imgName = $products->id .'_'. time() . rand(1, 1000) .'.'. $imgDetail->getClientOriginalExtension();
                    $imgDetail->move($path_mul, $imgName);
                    
                    $image = new Image();
                    $image->prod_id = $products->id;
                    $image->image_path = $imgName;
                    $image->save();
                }
            }

            return redirect('products')->with('status', 'Sửa Sản Phẩm Thành Công');
    }

    public function destroy($id)
    {
        $products = Product::find($id);
        $path = 'assets/uploads/products/'.$products->image;
                    if(File::exists($path))
                    {
                        File::delete($path);
                    }
        $products->delete();

        $mul_images = Image::where('prod_id', $id)->get();
        $path_mul = 'assets/multiple_image/products/';
        foreach ($mul_images as $img) {
            if(File::exists($path_mul . $img->image_path))
            {
                File::delete($path_mul . $img->image_path);
            }
            $img -> delete();
        }

        return redirect('products')->with('status', 'Xóa Sản Phẩm Thành Công');
    }
    
}
