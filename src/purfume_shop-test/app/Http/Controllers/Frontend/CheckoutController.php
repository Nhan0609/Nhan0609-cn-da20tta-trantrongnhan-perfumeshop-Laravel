<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $old_cartitems = Cart::where('user_id', Auth::id())->get();
            foreach($old_cartitems as $item)
            {
                if(Product::where('id', $item->prod_id)->where('qty', '<',$item->prod_qty)->exists())
                {
                    $removeItem = Cart::where('user_id', Auth::id())->where('prod_id', $item-> prod_id)->first();
                    $removeItem -> delete();
                }
            }

            $cartitems = Cart::where('user_id', Auth::id())->get();
        } else {
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

        return view('frontend.checkout' ,compact('cartitems'));
    }

    public function placeorder(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $cartitems = Cart::where('user_id', Auth::id())->get();
        } else {
            $user = User::create([
    'name' => $request->input('fname'),
    'lname' => $request->input('lname'),
    'email' => $request->input('email'),
    'password' => Hash::make('User123456789'),
    'phone' => $request->input('phone'),
    'address1' => $request->input('address1'),
    'address2' => $request->input('address2'),
    'city' => $request->input('city'),
    'state' => $request->input('state'),
    'country' => $request->input('country'),
]);

$user_id = $user->id;

// Bây giờ $user_id chứa ID của người dùng mới được tạo



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

        $order = new Order();
        $order->user_id = $user_id;
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');



        //Tổng tiền sau khi đặt hàng
        $total = 0;
        foreach($cartitems as $prod)
        {
            $total += $prod->products->selling_price * $prod->prod_qty;
        }
        $order->total_price = $total;
        
        //Kết thúc tính tổng tiền sau khi đặt hàng
        $order->tracking_no = 'user'.rand(1111,9999);
        $order->save();

        foreach($cartitems as $item)
        {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item -> prod_id,
                'qty' => $item -> prod_qty,
                'price' => $item -> products -> selling_price,
            ]);

            $prod = Product::where('id', $item->prod_id)-> first();
            $prod-> qty = $prod->qty - $item->prod_qty;
            $prod-> update();
        }

        if(Auth::check()){
            if (Auth::user()->address1 == NULL)
            {
                $user = User::where('id', Auth::id())->first();

                $user->name = $request->input('lname');
                $user->phone = $request->input('phone');
                $user->address1 = $request->input('address1');
                $user->address2 = $request->input('address2');
                $user->city = $request->input('city');
                $user->state = $request->input('state');
                $user->country = $request->input('country');
                $user->pincode = $request->input('pincode');

                $user-> update();
            }
            $cartitems = Cart::where('user_id', Auth::id())->get();
            Cart::destroy($cartitems);

            return redirect('/')-> with('status', "Đặt Hàng Thành Công");
        } else {
            unset($_SESSION['card']);

            return redirect('/')-> with('status', "Đặt Hàng Thành Công. Vui Lòng Đăng Nhập Để Theo Dõi Đơn Hàng. Tên đăng nhập: ".$request->input('email').". Mật khẩu mặc định: User123456789.");
        }

    }
}
