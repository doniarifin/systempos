<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\PurchaseTransaction;
use App\Models\SalesTransaction;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $month = date('m');
        $totalSalesTransaction = SalesTransaction::selectRaw("COUNT(*) as total")->whereMonth('created_at', $month)->first()->total;
        $totalProduct = Product::count();
        $totalCustomer = Customer::count();
        $totalSupplier = Supplier::count();

        $label_bar = ['Penjualan', 'Pembelian'];
        $data_bar = [];

        foreach ($label_bar as $key => $value) {
            $data_bar[$key]['label'] = $label_bar[$key];
            $data_bar[$key]['backgroundColor'] = $key == 0 ? 'rgba(60,141,188,0.9)' : 'rgba(210,214,222,1)';
            $data_month = [];

            foreach (range(1, 12) as $month) {
                if ($key == 0) {
                    $data_month[] = SalesTransaction::select(DB::raw("COUNT(*) as total"))->whereMonth('created_at', $month)->first()->total;
                } else {
                    $data_month[] = PurchaseTransaction::selectRaw("COUNT(*) as total")->whereMonth('created_at', $month)->first()->total;
                }
            }
            $data_bar[$key]['data'] = $data_month;
        }


        return view('home', compact('totalSalesTransaction', 'totalProduct', 'totalCustomer', 'totalSupplier', 'data_bar'));
    }
}
