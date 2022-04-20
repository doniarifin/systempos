@extends('layouts.app2')
@section('header', 'Sales Order')

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ url('adminlte') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ url('adminlte') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="{{ url('adminlte/dist/css/adminlte.min.css?v=3.2.0')}}">
@endsection

@section('content')
<div id="controller">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group" role="group" aria-label="First group">
                            <button type="button" data-toggle="modal" data-target="#modal-item" class="btn btn-primary pull-right">Cari Barang</button>
                        </div>
                        <div class="btn-group">
                          <button type="button" class="btn btn-secondary refresh">refresh</i></button>
                        </div>
                      </div>
                </div>
                    <!-- /.card-header -->
                    <form action="{{ url('cetak-so') }}" method="post">

                    <div class="card-body">
                        @csrf       
                        
                        <div class="row">
                           <form role="form">
                               <div class="box-body">
                                   <div class="form-group">
                                       <label for="product_id">Product ID</label>
                                       <div class="input-group">
                                           <div class="input-group-prepend">
                                               <input type="text" autocomplete="off" id="product_id" name="id" class="form-control">
                                           </div>
                                         </div>
                                   </div>
                               </div>
                           </form>
                   </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body table-responsive p-0" style="height: 250px;">
         
                                <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Name Product</th>
                                            <th>Price/pcs</th>
                                            <th>Qty</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="product-ajax">
                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Customer Name</label>
                                    <select name="customer_id" class="form-control">
                                        <option value="0">Select Customer</option>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name_customer }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="pembayaran">Jumlah Uang</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="number" autocomplete="off" id="pembayaran" name="pembayaran" class="form-control">
                                        </div>
                                      </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Submit & Print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-item">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Select Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body table-responsive">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Product</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $i => $data)
                                <tr>
                                    <td>{{ $data->name_product }}</td>
                                    <td>{{ $data->harga_jual }}</td>
                                    <td>{{ $data->stock }}</td>
                                    <td>
                                        <button class="btn btn-xs btn-info select" 
                                        data-id="{{ $data->id }}"
                                        data-name="{{ $data->name_product }}">
                                            <i class="fa fa-check">select</i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
  
@endsection

@section('js')
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Code product/get_product with press enter -->
<script type="text/javascript">
$(document).ready(function(){

   $("input[name='id']").focus();    

$("input[name='id']").keypress(function(e){
    if(e.which == 13){
        e.preventDefault();
        var code = $(this).val();
        var url = "{{ url('so/ajax') }}"+'/'+code;
        var _this = $(this);

        $.ajax({
            type:'get',
            dataType:'json',
            url:url,
            success:function(data){
                console.log(data);
                _this.val('');

                var isi = ''

                isi += '<tr>';

                isi += '<td>';
                    isi += '<input type="text" class="name" name="name_product[]" value="'+data.data.name_product+'" disabled style="border:none; background-color:transparent"><input type="hidden" class="product_code" name="product_code[]" value="'+data.data.product_code+'">';
                isi += '</td>'
                isi += '<td>';
                    isi += '<input type="number" class="price" name="harga_jual" value="'+data.data.harga_jual+'" disabled style="border:none; background-color:transparent"><input type="hidden" class="product_id" name="id" value="'+data.data.id+'">';
                isi += '</td>';
                isi += '<td>';
                    isi += '<input type="number" class="qty" name="qty[]" value="1">';
                isi += '</td>';
                isi += '<td class="text-center">';
                    isi += '<button id="delete" class="btn btn-xs btn-danger delete" data-name1="'+data.data.name_product+'" data-price="'+data.data.harga_jual+'" data-qty1="1" ><i class="fas fa-trash">delete</i></button>';
                isi += '</td>';

                isi += '</tr>';


                $('.product-ajax').append(isi);                
            }
        })
    }
});

    // Select Product dan masuk masuk ke table
    $('body').on('click', '.select', function() {
            var p_code = $(this).data('id');
            $('#product_id').val(p_code);

            $("#modal-item").modal('hide');
        });


        $('body').on('click', '.select', function() {
        var p_code = $(this).data('id');
        var url = "{{ url('so/ajax') }}"+'/'+p_code;
        var _this = $('#product_id');

        $.ajax({
            type:'get',
            dataType:'json',
            url:url,
            success:function(data){
                console.log(data);
                _this.val(p_code);

                var isi = ''

                isi += '<tr>';

                isi += '<td>';
                    isi += '<input type="text" class="name" name="name_product[]" value="'+data.data.name_product+'" disabled style="border:none; background-color:transparent">';
                isi += '</td>'
                isi += '<td>';
                    isi += '<input type="number" class="price" name="harga_jual" value="'+data.data.harga_jual+'" disabled style="border:none; background-color:transparent"><input type="hidden" class="product_id" name="product_id[]" value="'+data.data.id+'">';
                isi += '</td>';
                isi += '<td>';
                    isi += '<input type="number" class="qty" name="qty[]" value="1">';
                isi += '</td>';
                isi += '<td class="text-center">';
                    isi += '<button id="delete" class="btn btn-xs btn-danger delete" data-name1="'+data.data.name_product+'" data-price="'+data.data.harga_jual+'" data-qty1="1" ><i class="fas fa-trash">delete</i></button>';
                isi += '</td>';

                isi += '</tr>';

                $('.product-ajax').append(isi);

                }
            });

            $("#modal-item").modal('hide');
        });
    // btn refresh
    $('.refresh').click(function() {
    location.reload();
    });

    // btn delete
    $('body').on('click', '.delete', function(e){
        e.preventDefault();
        var dataPrice = $(this).data('price');
        row = $(this).parents('tr');

        alert('Are you sure?');
        row.remove();
    });

})
</script>
<!-- Datatable di modal -->
<script type="text/javascript">
$(function () {
$("#datatable").DataTable();
});

</script>

@endsection