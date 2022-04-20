@extends('layouts.app2')

@section('header', 'Customer')

@section('content')
<div id="controller">
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-header">
                   <a href="{{ url('customer/create') }}" class="btn btn-sm btn-primary pull-right">Create New Customer</a>
               </div>
                   <!-- /.card-header -->
                   <div class="card-body">
                       <table id="datatable" class="table table-striped table-bordered">
                           <thead>
                               <tr>
                                   <th style="width: 10px">#</th>
                                   <th>Name</th>
                                   <th>Phone</th>
                                   <th>Address</th>
                                   <th class='text-center'>Action</th>
                               </tr>
                           </thead>
                       </table>
                   </div>
           </div>
       </div>
   </div>
@endsection

@section('js')
<script>
   var actionUrl = '{{ url('customer') }}';
   var apiUrl = '{{ url('api/customer') }}';

   var columns = [
       {data: 'DT_RowIndex', class: 'text-center', orderable: true},
       {data: 'name_customer', class: 'text-center', orderable: true},
       {data: 'phone_customer', class: 'text-center', orderable: true},
       {data: 'address_customer', class: 'text-center', orderable: true},
       {render: function (index, row, data, meta) {
           return `
                <a href="{{ url('customer/'.'${data.id}'.'/edit') }}" type="button" class="btn btn-warning btn-sm">
                    Edit
                </a>
               <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">
                   Delete 
               </a>` ;
       }, orderable: false, width: '200px', class: 'text-center'},
   ];
</script>
<script src="{{ asset('js/data.js') }}"></script>

@endsection