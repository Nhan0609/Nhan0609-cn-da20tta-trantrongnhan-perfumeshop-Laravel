<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('frontend.orders.index', compact('orders'));
    }

    public function view($id)
    {
        $orders = Order::where('id', $id)->where('user_id', Auth::id())->first();
        return view('frontend.orders.view', compact('orders'));
    }
    //Thông tin người dùng
    public function infor()
    {
        $user = User::where('role_as', '0')->first();

        $users = User::all(); // Lấy tất cả thông tin từ bảng users
        return view('interact.infor', ['users' => $users]);
    }
    //Thay đổi mật khẩu
    public function change_password()
    {
        return view('auth.passwords.change');
    }
}

    