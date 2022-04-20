@extends('layouts.app2')

@section('header', 'Product')

@section('content')
<div id="controller">
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-header">
                   <a href="{{ url('product/create') }}" class="btn btn-sm btn-primary pull-right">Create New Product</a>
               </div>
                   <!-- /.card-header -->
                   <div class="card-body">
                       <table id="datatable" class="table table-striped table-bordered">
                           <thead>
                               <tr>
                                   <th style="width: 10px">#</th>
                                   <th>Name</th>
                                   <th>Harga Beli</th>
                                   <th>Harga Jual</th>
                                   <th>Stock</th>
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
   var actionUrl = '{{ url('product') }}';
   var apiUrl = '{{ url('api/product') }}';

   var columns = [
       {data: 'DT_RowIndex', class: 'text-center', orderable: true},
       {data: 'name_product', class: 'text-center', orderable: true},
       {data: 'harga_beli', class: 'text-center', orderable: true},
       {data: 'harga_jual', class: 'text-center', orderable: true},
       {data: 'stock', class: 'text-center', orderable: true},
       {render: function (index, row, data, meta) {
           return `
           <a href="{{ url('product/'.'${data.id}'.'/edit') }}" type="button" class="btn btn-warning btn-sm">
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