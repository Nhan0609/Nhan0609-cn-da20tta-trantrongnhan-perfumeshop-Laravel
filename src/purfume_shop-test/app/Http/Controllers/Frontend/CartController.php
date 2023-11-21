<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //Thêm sản phẩm vào giỏ hàng
    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check())
        {
            $prod_check = Product::where('id', $product_id)->first();
            
            if($prod_check)
            {
                if(Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists())
                    {
                        // Cập lại số lượng của sản phẩm đã được thêm vào giỏ hàng
                        $cart = Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->first();
                        $cart -> prod_qty = intval($cart -> prod_qty) + $product_qty;
                        $cart-> update();

                        return response()->json(['status' => $prod_check->name. " Đã Được Thêm Vào Giỏ Hàng"]);
                    }
                else
                {
                    $cartItem= new Cart();
                    $cartItem-> prod_id = $product_id;
                    $cartItem-> user_id = Auth::id();
                    $cartItem-> prod_qty = $product_qty;
                    $cartItem->save();
                    return response()->json(['status' => $prod_check->name. " Được Thêm Vào Giỏ Hàng"]);
                }
            }
        }
        else
        {
            return response()->json(['status'=> "Vui Lòng Đăng nhập Để Tiếp Tục"]);
        }
    }

    //Xem giỏ hàng
    public function viewcart()
    {
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.cart', compact('cartitems'));
    }

    //Cập nhật sản phẩm trong giỏ hàng
    public function updatecart(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');

        if(Auth::check())
        {
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {
                $cart = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cart -> prod_qty = $product_qty;
                $cart-> update();
                return response()->json(['status'=> "Số Lượng Đã Được Cập Nhật"]);
            }
        }
    }

    //Xóa sản phẩm trong giỏ hàng
    public function deleteproduct(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {
                $cartItem = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status'=> "Xóa Khỏi Giỏ Hàng Thành Công"]);
            }
        } 
        else
        {
            return response()->json(['status'=> "Vui Lòng Đăng nhập Để Tiếp Tục"]);
        }
    }
}
