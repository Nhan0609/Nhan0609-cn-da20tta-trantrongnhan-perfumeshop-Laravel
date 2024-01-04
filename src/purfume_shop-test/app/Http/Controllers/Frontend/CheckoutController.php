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

        //Tổng tiền sau khi đặt hàng
        $total = 0;
        foreach($cartitems as $prod)
        {
            $total += $prod->products->selling_price * $prod->prod_qty;
        }

        // hinh thuc thanh toan onl
        // vnpay();


        // sau khi thanh toan thanh cong
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
        $order->total_price = $total; 
        $order->tracking_no = 'user'.rand(1111,9999);   //Kết thúc tính tổng tiền sau khi đặt hàng
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


    //Thanh toán VNPAY
    public function vnpay()
    {
        $vnp_TxnRef = time() . '_' . rand(1000, 9999);

        // Thông tin đơn hàng
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';

        // Lấy tổng tiền từ giỏ hàng
        $totalAmount = 100000;
        // TODO: Thêm định nghĩa hoặc import cho đối tượng Cart
        // $total_price = Order::total_price();
        // foreach ($total_price as $v_content) {
        //     $totalAmount += $v_content->price * $v_content->qty;
        // }

        // Chuyển đổi tổng tiền thành đơn vị tiền tệ của VNPAY (VND)
        $vnp_Amount = $totalAmount * 100;

        // Thông tin thanh toán
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        // TODO: Định nghĩa $vnp_TmnCode và $vnp_HashSecret
        $vnp_TmnCode = "NINXYELP";
        $vnp_HashSecret = "AIETPJHOVHILFFJPZHPGRDQSRWULXSRH";

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // TODO: Đặt giá trị chính xác từ VNPAY
        $vnp_Returnurl = "http://127.0.0.1:8000/"; // TODO: Đặt giá trị chính xác từ VNPAY

        // Các tham số thanh toán
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;

        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );

        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
