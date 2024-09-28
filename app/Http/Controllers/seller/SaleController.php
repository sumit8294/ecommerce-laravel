<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function getSales()
    {


        $loggedSeller = Session::get('seller');

        $seller_info['total_orders'] = Order::where('seller_id', $loggedSeller->id)->count();
        $seller_info['total_reach'] = Product::where('seller_id', $loggedSeller->id)->sum('reach');
        $seller_info['total_product_sold'] = Product::where('seller_id', $loggedSeller->id)->sum('item_sold');
        $seller_info['total_earnings'] = Product::where('seller_id', $loggedSeller->id)->sum(DB::raw('selling_price * item_sold'));



        $seller_info['yearly_orders'] = $this->generateYearlySale($loggedSeller->id);
        $seller_info['monthly_orders'] = $this->generateMonthlySale($loggedSeller->id);

        // return $seller_info;

        return view('seller/sales', compact('seller_info'));
    }

    public function getSaleByMonth(Request $request,$date){
        $loggedSeller = Session::get('seller');
        
        $sale = $this->generateMonthlySale($loggedSeller->id,$date);

        return response()->json($sale);
    }

    public function getSaleByYear(Request $request,$date){
        $loggedSeller = Session::get('seller');
        
        $sale = $this->generateYearlySale($loggedSeller->id,$date);

        return response()->json($sale);
    }

    public function generateYearlySale($seller, $inputYear = null)
{
    // If no input year is provided, default to the current year
    $inputYear = $inputYear ? Carbon::createFromFormat('Y', $inputYear) : Carbon::now();
    
    // Start at January 1st of the input year
    $startDate = $inputYear->copy()->startOfYear();
    
    // End at December 31st of the input year
    $endDate = $inputYear->copy()->endOfYear();
    
    $monthlyOrders = [];
    $count = 0;

    // Loop through each month of the input year
    for ($date = $startDate; $date <= $endDate; $date->addMonth()) {
        $month = $date->format('Y-m'); // Format for month and year

        $monthlyOrders[$count]['month'] = $month; 
        $monthlyOrders[$count]['count'] = Order::where('seller_id', $seller)
            ->whereYear('created_at', $date->year)  // Filter by year
            ->whereMonth('created_at', $date->month) // Filter by month
            ->count();
        $count++;
    }

    return $monthlyOrders;
}


    // public function generateYearlySale($seller)
    // {
    //     $endDate = Carbon::now();
    //     $startDate = $endDate->copy()->subMonths(12);
    //     $monthlyOrders = [];
    //     $count = 0;
    //     for ($date = $startDate; $date < $endDate; $date->addMonth()) {
    //         $monthYear = $date->format('Y-m-d'); // Format for grouping
    //         $monthlyOrders[$count]['month'] = $monthYear;
    //         $monthlyOrders[$count]['count'] = Order::where('seller_id', $seller)
    //             ->whereYear('created_at', $date->year)
    //             ->whereMonth('created_at', $date->month)
    //             ->count();
    //         $count++;
    //     }

    //     return $monthlyOrders;
    // }

    public function generateMonthlySale($seller, $inputDate = null)
    {
        // If no date is provided, default to the current date, otherwise use the passed date
        $inputDate = $inputDate ? Carbon::parse($inputDate) : Carbon::now();
        
        // Get the start and end of the month based on the input date
        $startDate = $inputDate->copy()->startOfMonth();
        $endDate = $inputDate->copy()->endOfMonth();
    
        $dailyOrders = [];
        $count = 0;
    
        // Loop through each day in the selected month
        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $formattedDate = $date->format('Y-m-d'); // Format for grouping
    
            // Store the date and the count of orders for each day
            $dailyOrders[$count]['date'] = $formattedDate; 
            $dailyOrders[$count]['count'] = Order::where('seller_id', $seller)
                ->whereDate('created_at', $formattedDate)
                ->count();
            $count++;
        }
    
        return $dailyOrders;
    }
    
}
