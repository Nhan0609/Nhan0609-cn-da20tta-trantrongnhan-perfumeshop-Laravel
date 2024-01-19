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

    private $password_default = 'User123456789';

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
        session_start();

        if (Auth::check()) {
            $cartitems = Cart::where('user_id', Auth::id())->get();
        } else {
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
        $_SESSION['total'] = $total;

        // Đưa thông tin Request lên Session
        $user = new User();
        $user->name = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->email = $request->input('email');
        $user->password = Hash::make($this->password_default);
        $user->phone = $request->input('phone');
        $user->address1 = $request->input('address1');
        $user->address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        
        $_SESSION['request_user'] = $user;

        switch($request->input('payment_type')) {
            case 'COD':
                $_SESSION['payment_type'] = 'COD';
                $return_url = 'http://127.0.0.1:8000/return-payment?cod_ResponseCode=00';
                header('Location: ' . $return_url);
                die();
                break;

            // Thanh toán qua vnpay
            case 'VNP':
                $_SESSION['payment_type'] = 'VNP';
                $this->vnpay($total);
                break;

            default:
                unset($_SESSION['request_user']);
                unset($_SESSION['total']);
                return redirect('/checkout')-> with('status', 'Có lỗi xảy ra. Vui lòng thử lại.');
        }
    }

    // Xử lý thông tin đơn hàng và thông tin User giao hàng (Trả về tên tài khoản đơn hàng)
    private function handleInvoice($transaction_no)
    {
        session_start();

        $user = new User();
        $user = $_SESSION['request_user'];

        if (Auth::check()) {
            $user_id = Auth::id();
            $cartitems = Cart::where('user_id', Auth::id())->get();

            // Cập nhập thông tin user
            $user_update = User::where('id', Auth::id())->first();

            $user_update->name = $user->lname;
            $user_update->phone = $user->phone;
            $user_update->address1 = $user->address1;
            $user_update->address2 = $user->address2;
            $user_update->city = $user->city;
            $user_update->state = $user->state;
            $user_update->country = $user->country;
            $user_update->pincode = $user->pincode;
            $user_update-> update();

            $user = $user_update;

            $message = "Đặt Hàng Thành Công";
        } else {

            // Bây giờ $user_id chứa ID của người dùng mới được tạo
            $user->save();
            $user_id = $user->id;

            $cartitems = array();
            if(isset($_SESSION['card'])) {
                foreach($_SESSION['card'] as $prod_id=>$prod_qty) {
                    $cartItem= new Cart();
                    $cartItem-> prod_id = $prod_id;
                    $cartItem-> prod_qty = $prod_qty;
                    $cartitems[] = $cartItem;
                }
            }

            $message = "Đặt Hàng Thành Công. Vui Lòng Đăng Nhập Để Theo Dõi Đơn Hàng. Tên đăng nhập: ".$user->email.". Mật khẩu mặc định: ". $this->password_default;
        }

        $status = 0;
        if (isset($_SESSION['payment_type'])) 
        {
            if ($_SESSION['payment_type'] != null && $_SESSION['payment_type'] != 'COD') 
            {
                $status = 3;
            }
        }

        // Save invoice
        $order = new Order();
        $order->user_id = $user_id;
        $order->fname = $user->name;
        $order->lname = $user->lname;
        $order->email = $user->email;
        $order->phone = $user->phone;
        $order->address1 = $user->address1;
        $order->address2 = $user->address2;
        $order->city = $user->city;
        $order->state = $user->state;
        $order->country = $user->country;
        $order->pincode = $user->pincode;
        $order->total_price = $_SESSION['total']; 
        $order->status = $status;
        $order->message = isset($_SESSION['payment_type']) ? $_SESSION['payment_type'] : null;
        $order->tracking_no = $transaction_no;   //Kết thúc tính tổng tiền sau khi đặt hàng
        $order->save();
        $_SESSION['order_id'] = $order->id;

        // Xử lý sản phẩm theo đơn hàng
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

        return $message;
    }

    // Function xử lý kết quả trả về của API pay    
    public function returnPayment(Request $request) 
    {
        if (str_contains($request, 'vnp_')) {
            $response_code = $request->vnp_ResponseCode;
            $transaction_no = $request->vnp_TransactionNo;  // Mã giao dịch của vnpay
        } else if (str_contains($request, 'cod_')) {
            $response_code = $request->cod_ResponseCode;
            $transaction_no = 'user'.rand(1111,9999);
        }

        // Trường hợp pay tră về thành công
        if($response_code == "00") {
            $message = $this->handleInvoice($transaction_no);

            unset($_SESSION['request_user']);
            unset($_SESSION['total']);
            unset($_SESSION['payment_type']);

            if(Auth::check()){
                $cartitems = Cart::where('user_id', Auth::id())->get();
                Cart::destroy($cartitems);
            } else {
                unset($_SESSION['card']);
            }

            // Gửi mail hóa đơn
            $sendMail = new SendMailController();
            $sendMail->sendmail_bill($_SESSION['order_id']);
            unset($_SESSION['order_id']);

            return redirect('/home')-> with('status', $message);
        }

        // Trường hợp pay Hủy xử lý hoặc xử lý thất bại
        unset($_SESSION['request_user']);
        unset($_SESSION['total']);
        unset($_SESSION['payment_type']);
        unset($_SESSION['order_id']);
        return redirect('/checkout');
    }

    //Thanh toán VNPAYtotalkto
    private function vnpay($total_price)
    {

        $vnp_TxnRef = time() . '_' . rand(1000, 9999);

        // Thông tin đơn hàng
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';

        // Lấy tổng tiền từ giỏ hàng
        $totalAmount = $total_price;
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
        $vnp_Returnurl = "http://127.0.0.1:8000/return-payment"; // TODO: Đặt giá trị chính xác từ VNPAY

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

        header('Location: ' . $vnp_Url);
        die();
    }

}
