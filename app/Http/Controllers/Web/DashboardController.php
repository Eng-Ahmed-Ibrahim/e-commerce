<?php

namespace App\Http\Controllers\Web;

use DateTime;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $statusCounts = [
            'pending' => ["count"=>Orders::where('status', 'pending')->count(),"status"=>"pending"],
            'Confirmed' => ["count"=>Orders::where('status', 'confirmed')->count(),"status"=>"confirmed"],
            'Out For Delivery' => ["count"=>Orders::where('status', 'out_for_Delivery')->count(),"status"=>"out_for_Delivery"],
            'Delivered' => ["count"=>Orders::where('status', 'delivered')->count(),"status"=>"delivered"],
            'Returned' => ["count"=>Orders::where('status', 'returned')->count(),"status"=>"returned"],
            'Failed To Delivery' =>["count"=> Orders::where('status', 'failed_to_delivery')->count(),"status"=>"failed_to_delivery"],
        ];

        $monthlyRegistrations = DB::table('users')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
            ->where('role', 'customer')
            ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
            ->orderBy(DB::raw('MONTH(created_at)'), 'asc')
            ->get();

        // Create an array with all months of the current year
        $start = now()->startOfYear();
        $end = now()->endOfYear();
        $registred_customers = [];
        $monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        for ($date = $start; $date <= $end; $date->addMonth()) {
            $monthNumber = $date->month;
            $monthName = $monthNames[$monthNumber - 1];
            $yearMonth = $date->format('Y') . '-' . str_pad($monthNumber, 2, '0', STR_PAD_LEFT);
            $registred_customers[$yearMonth] = ['name' => $monthName, 'count' => 0]; // Initialize with 0
        }

        // Populate the counts for months with data
        foreach ($monthlyRegistrations as $registration) {
            $monthKey = $registration->year . '-' . str_pad($registration->month, 2, '0', STR_PAD_LEFT);
            $registred_customers[$monthKey]['count'] = $registration->count;
        }





        $monthlyTotals = DB::table('orders')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('SUM(total) as total'))
            ->where('status', 'delivered')
            ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
            ->orderBy(DB::raw('MONTH(created_at)'), 'asc')
            ->get();

        // Create an array with all months of the current year
        $start = now()->startOfYear();
        $end = now()->endOfYear();
        $allMonths = [];
        $monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        for ($date = $start; $date <= $end; $date->addMonth()) {
            $monthNumber = $date->month;
            $monthName = $monthNames[$monthNumber - 1];
            $yearMonth = $date->format('Y') . '-' . str_pad($monthNumber, 2, '0', STR_PAD_LEFT);
            $allMonths[$yearMonth] = ['name' => $monthName, 'total' => 0]; // Initialize with 0
        }

        // Populate the totals for months with data
        foreach ($monthlyTotals as $total) {
            $monthKey = $total->year . '-' . str_pad($total->month, 2, '0', STR_PAD_LEFT);
            $allMonths[$monthKey]['total'] = $total->total;
        }


        return view('index')
            ->with("status_count", $statusCounts)
            ->with("order_chart", $allMonths)
            ->with("registred_customers", $registred_customers)
        ;
    }
}
