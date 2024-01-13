<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class SendMailController extends Controller
{
    public function sendmail_bill($order_id)
    {
        $order_item = OrderItem::where('order_id', $order_id)->get();
        $order = Order::where('id', $order_id)->first();
        $order_mail = $order->email; 
        
        $name = 'Thông Tin Đơn Hàng';
        Mail::send('mail.notification', compact('name', 'order','order_item'), function($mail) use($name, $order_mail){
            $mail ->subject('Đơn Hàng Của Bạn');
            $mail ->to($order_mail, $name);
        });
    }
}
