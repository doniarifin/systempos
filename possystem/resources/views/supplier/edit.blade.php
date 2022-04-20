@extends('layouts.app2')

@section('header', 'Supplier')

@section('content')

<div class="card card-info" style="margin: 7%">
   <div class="card-header">
      <h3 class="card-title">Edit Supplier</h3>
   </div>
   <!-- /.card-header -->
   <!-- form start -->
   <form class="form-horizontal" action="{{ url('supplier/'.$supplier->id) }}" method="post">
      @csrf
      {{ method_field('PUT') }}
      <div class="card-body">
         <div class="form-group row">
         <label for="name_supplier" class="col-sm-2 col-form-label">Supplier Name</label>
         <div class="col-sm-10">
            <input type="text" name="name_supplier" class="form-control" placeholder="Supplier" value="{{ $supplier->name_supplier }}">
         </div>
         </div>
         <div class="form-group row">
         <label for="phone_supplier" class="col-sm-2 col-form-label">Supplier Phone</label>
         <div class="col-sm-10">
            <input type="text" name="phone_supplier" class="form-control" placeholder="Supplier Phone" value="{{ $supplier->phone_supplier }}">
         </div>
         </div>
         <div class="form-group row">
            <label for="address_supplier" class="col-sm-2 col-form-label">Supplier Address</label>
            <div class="col-sm-10">
               <input type="text" name="address_supplier" class="form-control" placeholder="Supplier Address" value="{{ $supplier->address_supplier }}">
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