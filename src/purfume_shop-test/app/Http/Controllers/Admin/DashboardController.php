<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    //Tra cứu doanh thu theo ngày
    public function search_day(Request $request)
    {
        $startDate = $request->input('dateA');
        $endDate = $request->input('dateB');

        // Xử lý theo ngày
        $startDateYmd = $startDate ? Carbon::parse($startDate)->startOfDay() : null;
        $endDateYmd = $endDate ? Carbon::parse($endDate)->endOfDay() : null;

        // Xử lý logic tra cứu doanh thu ở đây
        $revenueResults = Order::whereBetween('created_at', [$startDateYmd, $endDate])
                            ->where('status', 2) // Chỉ lấy đơn hàng đã giao hàng
                            ->sum('total_price');

        return view('admin.revenue.search', compact('revenueResults', 'startDate', 'endDate'));
    }

    //Tra cứu doanh thu theo tháng
    public function search_month(Request $request)
    {
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');
    
        if (!$selectedMonth || !$selectedYear) {
            // Xử lý nếu không có giá trị month hoặc year từ request
            return redirect()->route('revenue-form')->with('error', 'Vui lòng chọn tháng và năm để tra cứu doanh thu.');
        }
    
        // Xử lý logic tra cứu doanh thu ở đây
        $startDate = Carbon::create($selectedYear, $selectedMonth, 1)->startOfMonth();
        $endDate = Carbon::create($selectedYear, $selectedMonth, 1)->endOfMonth();
    
        $revenueResults = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 2) // Chỉ lấy đơn hàng đã giao hàng
            ->sum('total_price');
    
        return view('admin.revenue.search', compact('revenueResults', 'startDate', 'endDate', 'selectedMonth', 'selectedYear'));
    }

    //Tra cứu doanh thu theo quý
    public function search_quarter(Request $request)
    {
        $quarter = $request->input('quarter');

        switch ($quarter) {
            case 1:
                $startDate = Carbon::now()->firstOfQuarter();
                $endDate = Carbon::now()->lastOfQuarter();
                break;

            case 2:
                $startDate = Carbon::now()->firstOfQuarter()->addMonths(3);
                $endDate = Carbon::now()->lastOfQuarter()->addMonths(3);
                break;

            case 3:
                $startDate = Carbon::now()->firstOfQuarter()->addMonths(6);
                $endDate = Carbon::now()->lastOfQuarter()->addMonths(6);
                break;

            case 4:
                $startDate = Carbon::now()->firstOfQuarter()->addMonths(9);
                $endDate = Carbon::now()->lastOfQuarter()->addMonths(9);
                break;

            default:
                $startDate = Carbon::now()->firstOfQuarter();
                $endDate = Carbon::now()->lastOfQuarter();
                break;
        }

        // Xử lý logic tra cứu doanh thu theo quý ở đây
        $revenueResults = Order::whereBetween('created_at', [$startDate, $endDate])
                            ->where('status', 2) // Chỉ lấy đơn hàng đã giao hàng
                            ->sum('total_price');

        return view('admin.revenue.search', compact('revenueResults', 'startDate', 'endDate'));
    }

    //Tra cứu doanh thu theo năm
    public function search_year(Request $request)
    {
        $selectedYear = $request->input('year', null);

        if (!$selectedYear) {
            // Xử lý nếu không có giá trị year từ request
            $selectedYear = Carbon::now()->year;
        }

        // Xử lý logic tra cứu doanh thu ở đây
        $startDate = Carbon::create($selectedYear)->startOfYear();
        $endDate = Carbon::create($selectedYear)->endOfYear();

        $revenueResults = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 2) // Chỉ lấy đơn hàng đã giao hàng
            ->sum('total_price');

        return view('admin.revenue.search', compact('revenueResults', 'startDate', 'endDate', 'selectedYear'));
    }

}
