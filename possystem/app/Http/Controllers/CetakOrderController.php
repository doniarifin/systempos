<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseTransaction;
use App\Models\SalesOrder;
use App\Models\SalesTransaction;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakOrderController extends Controller
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
   public function cetakSO(Request $request)
   {
      $customers = $request->customer_id;
      $products = $request->product_id;
      $qty = $request->qty;
      $today = Carbon::now();

      $customers1 = Customer::select('name_customer')->where('id', $customers)->first();
      $name = $customers1->name_customer;

      $so = SalesOrder::insertGetId([
         'customer_id' => $customers,
         'created_at' => $today,
         'updated_at' => $today,
      ]);

      foreach ($products as $i => $pd) {
         $pro = Product::find($pd);
         $hg = $pro->harga_jual;
         $st = SalesTransaction::insert([
            's_order_id' => $so,
            'product_id' => $pd,
            'qty' => $qty[$i],
            'total_harga' => $hg * $qty[$i],
            'created_at' => $today,
            'updated_at' => $today,
         ]);
         $product1 = Product::find($pd);
         $qtyNow = $product1->stock;
         $qtyUpdated = $qtyNow - $qty[$i];
         Product::where('id', $pd)->update([
            'stock' => $qtyUpdated,
         ]);
      }

      $data = [
         'no_order' => 'OD-' . date('Ymd') . rand(1111, 9999),
      ];

      $st1 = SalesTransaction::where('s_order_id', $so)->join('products', 'products.id', '=', 'product_id')->get();
      $grand_total = SalesTransaction::selectRaw("SUM(total_harga) as grandtotal")->where('s_order_id', $so)->first();
      $grand = $grand_total->grandtotal;

      $bayar = $request->pembayaran;
      $bayar = $request->pembayaran;
      $pph = $grand * 1.5 / 100;
      $grandfix = $grand - $pph;
      $kembali = $bayar - $grandfix;

      return view('cetaktransaksi.so', compact('data', 'today', 'name', 'st1', 'grandfix', 'kembali', 'bayar'));
   }

   public function cetakPO(Request $request)
   {
      $suppliers = $request->supplier_id;
      $products = $request->product_id;
      $qty = $request->qty;
      $today = Carbon::now();

      $supplier1 = Supplier::select('name_supplier')->where('id', $suppliers)->first();
      $name = $supplier1->name_supplier;

      $po = PurchaseOrder::insertGetId([
         'supplier_id' => $suppliers,
         'created_at' => $today,
         'updated_at' => $today,
      ]);

      foreach ($products as $i => $pd) {
         $pro = Product::find($pd);
         $hg = $pro->harga_beli;
         $pc = PurchaseTransaction::insert([
            'p_order_id' => $po,
            'product_id' => $pd,
            'qty' => $qty[$i],
            'total_harga' => $hg * $qty[$i],
            'created_at' => $today,
            'updated_at' => $today,
         ]);
         $product1 = Product::find($pd);
         $qtyNow = $product1->stock;
         $qtyUpdated = $qtyNow + $qty[$i];
         Product::where('id', $pd)->update([
            'stock' => $qtyUpdated,
         ]);
      }

      $data = [
         'no_order' => 'OD-' . date('Ymd') . rand(1111, 9999),
      ];

      $pc1 = PurchaseTransaction::where('p_order_id', $po)->join('products', 'products.id', '=', 'product_id')->get();
      $grand_total = PurchaseTransaction::selectRaw("SUM(total_harga) as grandtotal")->where('p_order_id', $po)->first();
      $grand = $grand_total->grandtotal;

      $bayar = $request->pembayaran;
      $pph = $grand * 1.5 / 100;
      $grandfix = $grand - $pph;
      $kembali = $bayar - $grandfix;

      return view('cetaktransaksi.po', compact('data', 'today', 'name', 'pc1', 'grandfix', 'kembali', 'bayar'));
   }
}
