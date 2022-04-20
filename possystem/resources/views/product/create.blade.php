@extends('layouts.app2')

@section('header', 'Product')

@section('content')

<div class="card card-info">
   <div class="card-header">
      <h3 class="card-title">Add new Product</h3>
   </div>
   <!-- /.card-header -->
   <!-- form start -->
   <form class="form-horizontal" action="{{url('product')}}" method="post">
      @csrf
      <div class="card-body">
         <div class="form-group row">
         <label for="name_product" class="col-sm-2 col-form-label">Product Name</label>
         <div class="col-sm-10">
            <input type="text" name="name_product" class="form-control" placeholder="Product">
         </div>
         </div>
         <div class="form-group row">
         <label for="harga_beli" class="col-sm-2 col-form-label">Harga Beli</label>
         <div class="col-sm-10">
            <input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli">
         </div>
         </div>
         <div class="form-group row">
            <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual</label>
            <div class="col-sm-10">
               <input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual">
            </div>
         </div>
         <div class="form-group row">
            <label for="stock" class="col-sm-2 col-form-label">Stock</label>
            <div class="col-sm-10">
               <input type="number" name="stock" class="form-control" placeholder="Stock">
            </div>
         </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
         <button type="submit" class="btn btn-info">Submit</button>
      </div>
      <!-- /.card-footer -->
   </form>
</div>
@endsection