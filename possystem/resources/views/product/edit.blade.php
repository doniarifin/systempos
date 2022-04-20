@extends('layouts.app2')

@section('header', 'product')

@section('content')

<div class="card card-info" style="margin: 7%">
   <div class="card-header">
      <h3 class="card-title">Edit product</h3>
   </div>
   <!-- /.card-header -->
   <!-- form start -->
   <form class="form-horizontal" action="{{ url('product/'.$product->id) }}" method="post">
      @csrf
      {{ method_field('PUT') }}
      <div class="card-body">
         <div class="form-group row">
         <label for="name_product" class="col-sm-2 col-form-label">product Name</label>
         <div class="col-sm-10">
            <input type="text" name="name_product" class="form-control" placeholder="nama product" value="{{ $product->name_product }}">
         </div>
         </div>
         <div class="form-group row">
         <label for="harga_beli" class="col-sm-2 col-form-label">Harga Beli</label>
         <div class="col-sm-10">
            <input type="text" name="harga_beli" class="form-control" placeholder="harga beli" value="{{ $product->harga_beli }}">
         </div>
         </div>
         <div class="form-group row">
            <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual</label>
            <div class="col-sm-10">
               <input type="text" name="harga_jual" class="form-control" placeholder="harga jual" value="{{ $product->harga_jual }}">
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