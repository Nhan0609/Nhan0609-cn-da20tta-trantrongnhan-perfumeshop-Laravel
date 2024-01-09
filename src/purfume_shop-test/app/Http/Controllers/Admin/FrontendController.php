<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
   public function index ()
   {
      $featured_products = Product::where('trending', '1')->take(15)->get();
      $trending_category = Category::where('popular','1')->take(15)->get();

      //Sản phẩm nhiều view
      $productsRecommend = Product::Latest('view_count', 'desc')->take(15)->get();


      // $orders = Order::where('status', '!=', '-1')->get();
      $orders = Order::all();


      $totalPrice = 0;
      $totalOrder = count($orders);
      $delivered = 0;
      $handing = 0;
      $delivering=0;
      $done=0;
      $cancelorder=0;

      foreach ($orders as $order) {
         switch ($order -> status) {
            case -1: 
               $cancelorder++;
               break;
            case 0: 
               $handing++;
               break;
            case 1:
               $delivering++;
               break;
            case 2: 
               $delivered++;
               $totalPrice += $order->total_price;
               break;
            case 3;
               $done++;
               
            break;
         }
      }
        
      return view('admin.index', compact('totalPrice', 'totalOrder', 'delivered', 'delivering', 'handing', 'cancelorder','done'));
   }
}
