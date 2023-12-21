<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //Thêm sản phẩm vào giỏ hàng
    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $prod_check = Product::where('id', $product_id)->first();

        if($prod_check)
        {
            if(Auth::check())
            {
                if ($product_qty == null || $product_qty == 0) {
                    return response()->json(['status' => $prod_check->name. " đã hết hàng. Không thể thêm vào giỏ hàng."]);
                } 

                if(Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists())
                {
                    // Cập lại số lượng của sản phẩm đã được thêm vào giỏ hàng
                    $cart = Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->first();
                    $cart -> prod_qty = intval($cart -> prod_qty) + $product_qty;
                    $cart-> update();

                    return response()->json(['status' => $prod_check->name. " Đã Được Thêm Vào Giỏ Hàng"]);
                }

                $cartItem= new Cart();
                $cartItem-> prod_id = $product_id;
                $cartItem-> user_id = Auth::id();
                $cartItem-> prod_qty = $product_qty;
                $cartItem->save();
                return response()->json(['status' => $prod_check->name. " Được Thêm Vào Giỏ Hàng"]);
            }
            else
            {
                // return response()->json(['status'=> "Vui Lòng Đăng nhập Để Tiếp Tục"]);
                // Lưu card vào session
                session_start();

                // Kiếm tra session card đẵ tồn tại chưa
                if(isset($_SESSION['card'])) {
                    // Kiêm tra san phẩm đã thêm vào session card chưa
                    if (isset($_SESSION['card'][$product_id])) {
                        $_SESSION['card'][$product_id] += $product_qty;
                        return response()->json(['status' => $prod_check->name. " Được Thêm Vào Giỏ Hàng"]);
                    }
                } else {
                    $_SESSION['card'] = array();
                }

                $_SESSION['card'][$product_id] = $product_qty;

                return response()->json(['status' => $prod_check->name. " Được Thêm Vào Giỏ Hàng"]);
            }
        }
    }

    //Xem giỏ hàng
    // public function viewcart()
    // {
    //     $cartitems = Cart::where('user_id', Auth::id())->get();
    //     return view('frontend.cart', compact('cartitems'));
    // }
    public function viewcart()
    {
        // Nếu đăng nhập, lấy thông tin giỏ hàng từ database
        if (Auth::check()) {
            $cartitems = Cart::where('user_id', Auth::id())->get();
        } else {
            // Nếu không đăng nhập, lấy thông tin giỏ hàng từ session
            session_start();

            $cartitems = array();
            if(isset($_SESSION['card'])) {
                foreach($_SESSION['card'] as $prod_id=>$prod_qty) {
                    $cartItem= new Cart();
                    $cartItem-> prod_id = $prod_id;
                    $cartItem-> prod_qty = $prod_qty;
                    $cartitems[] = $cartItem;
                }
            } 
        }

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

    //Hiển thị số lượng sản phẩm có trong giỏ hàng
    // public function cartcount()
    // {
    //     $cartcount = 0;

    //     if (Auth::check()) {
    //         $cartcount = Cart::where('user_id', Auth::id())->count();
    //     } else {
    //         session_start();

    //         if(isset($_SESSION['card'])) {
    //             echo json_decode($_SESSION['card']);
    //             // $cartcount = count(array($_SESSION['cart']));
    //         }
    //     }

    //     return response()->json(['count'=> $cartcount]);
    // }

    public function displaySessionCard()
{
    session_start();

    if (isset($_SESSION['card'])) {
        return response()->json(['session_card' => $_SESSION['card']]);
    } else {
        return response()->json(['session_card' => []]);
    }
}

public function cartcount()
{
    $cartcount = 0;

    if (Auth::check()) {
        $cartcount = Cart::where('user_id', Auth::id())->count();
    } else {
        session_start();

        if (isset($_SESSION['card'])) {
            // Đếm số lượng sản phẩm trong session card
            $cartcount = count($_SESSION['card']);
        }
    }

    return response()->json(['count' => $cartcount]);
}

    //Hiển thị số lượng sản phẩm có trong danh sách yêu thích
    public function wishlistcount()
    {
        $wishcount = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count'=> $wishcount]);
    }
}
