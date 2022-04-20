<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customers = Customer::all();
        $products = Product::where('stock', '>', 0)->get();

        return view('so.index', compact('customers', 'products'));
    }

    public function get_product($id)
    {
        $pd = Product::where('id', $id)->where('stock', '>', 0)->first();

        return response()->json([
            'data' => $pd
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $customers = $request->customer_id;
        $products = $request->product_id;
        $qty = $request->qty;
        $today = Carbon::now();

        DB::transaction(function () use ($products, $qty, $customers, $today) {

            $so = SalesOrder::insertGetId([
                'customer_id' => $customers,
                'created_at' => $today,
                'updated_at' => $today,
            ]);

            foreach ($products as $i => $pd) {
                SalesTransaction::insert([
                    's_order_id' => $so,
                    'product_id' => $pd,
                    'qty' => $qty[$i],
                    'created_at' => $today,
                    'updated_at' => $today,
                ]);
            }
            $product1 = Product::find($pd);
            $qtyNow = $product1->stock;
            $qtyUpdated = $qtyNow - $qty[$i];

            Product::where('id', $pd)->update([
                'stock' => $qtyUpdated,
            ]);
        });

        return redirect('so')->with('status', 'transaksi berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesOrder $salesOrder)
    {
        //
    }
}
