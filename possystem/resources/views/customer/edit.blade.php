@extends('layouts.app2')

@section('header', 'customer')

@section('content')

<div class="card card-info" style="margin: 7%">
   <div class="card-header">
      <h3 class="card-title">Edit customer</h3>
   </div>
   <!-- /.card-header -->
   <!-- form start -->
   <form class="form-horizontal" action="{{ url('customer/'.$customer->id) }}" method="post">
      @csrf
      {{ method_field('PUT') }}
      <div class="card-body">
         <div class="form-group row">
         <label for="name_customer" class="col-sm-2 col-form-label">customer Name</label>
         <div class="col-sm-10">
            <input type="text" name="name_customer" class="form-control" placeholder="customer" value="{{ $customer->name_customer }}">
         </div>
         </div>
         <div class="form-group row">
         <label for="phone_customer" class="col-sm-2 col-form-label">customer Phone</label>
         <div class="col-sm-10">
            <input type="text" name="phone_customer" class="form-control" placeholder="customer Phone" value="{{ $customer->phone_customer }}">
         </div>
         </div>
         <div class="form-group row">
            <label for="address_customer" class="col-sm-2 col-form-label">customer Address</label>
            <div class="col-sm-10">
               <input type="text" name="address_customer" class="form-control" placeholder="customer Address" value="{{ $customer->address_customer }}">
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