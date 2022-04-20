@extends('layouts.app2')

@section('header', 'Customer')

@section('content')

<div class="card card-info">
   <div class="card-header">
      <h3 class="card-title">Add new Customer</h3>
   </div>
   <!-- /.card-header -->
   <!-- form start -->
   <form class="form-horizontal" action="{{url('customer')}}" method="post">
      @csrf
      <div class="card-body">
         <div class="form-group row">
         <label for="name_customer" class="col-sm-2 col-form-label">customer Name</label>
         <div class="col-sm-10">
            <input type="text" name="name_customer" class="form-control" placeholder="customer">
         </div>
         </div>
         <div class="form-group row">
         <label for="phone_customer" class="col-sm-2 col-form-label">Customer Phone</label>
         <div class="col-sm-10">
            <input type="text" name="phone_customer" class="form-control" placeholder="Customer Phone">
         </div>
         </div>
         <div class="form-group row">
            <label for="address_customer" class="col-sm-2 col-form-label">customer Address</label>
            <div class="col-sm-10">
               <input type="text" name="address_customer" class="form-control" placeholder="customer Address">
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