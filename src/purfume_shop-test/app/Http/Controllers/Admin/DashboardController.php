<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function viewuser($id)  
    {
        $users = User::find($id);
        return view('admin.users.view', compact('users'));
    }
    //Hiển thị form tra cứu doanh thu
    public function form()
    {
        return view('admin.revenue.index');
    }

    //Xứ lý tra cứu doanh thu
    // public function search(Request $request)
    // {
    //     Order::all();
    //     $startDate = $request->input('dateA');
    //     $endDate = $request->input('dateB');

    // // Xử lý logic tra cứu doanh thu ở đây
    // $revenueResults = Order::whereBetween('created_at', [$startDate, $endDate])->sum('total_price');

    // return view('admin.revenue.search', compact('revenueResults', 'startDate', 'endDate'));
        
    // }
    public function search(Request $request)
    {
        $startDate = $request->input('dateA');
        $endDate = $request->input('dateB');
    
        // Xử lý logic tra cứu doanh thu ở đây
        $revenueResults = Order::whereBetween('created_at', [$startDate, $endDate])
                              ->where('status', 3) // Chỉ lấy đơn hàng đã thanh toán
                              ->sum('total_price');
    
        return view('admin.revenue.search', compact('revenueResults', 'startDate', 'endDate'));
    }
    
}
