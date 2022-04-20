@extends('layouts.app2')

@section('header', 'Supplier')

@section('css')

@endsection

@section('content')

<div id="controller">
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-header">
                   <a href="{{ url('supplier/create') }}" class="btn btn-sm btn-primary pull-right">Create New Supplier</a>
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
   var actionUrl = '{{ url('supplier') }}';
   var apiUrl = '{{ url('api/supplier') }}';

   var columns = [
       {data: 'DT_RowIndex', class: 'text-center', orderable: true},
       {data: 'name_supplier', class: 'text-center', orderable: true},
       {data: 'phone_supplier', class: 'text-center', orderable: true},
       {data: 'address_supplier', class: 'text-center', orderable: true},
       {render: function (index, row, data, meta) {
           return `
                <a href="{{ url('supplier/'.'${data.id}'.'/edit') }}" type="button" class="btn btn-warning btn-sm">
                    Edit
                </a>
               <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">
                   Delete 
               </a>` ;
       }, orderable: false, width: '200px', class: 'text-center'},
   ];
</script>

<script type="text/javascript">
   $(function () {
    $("#datatable").DataTable();
});

// importdatatables
var controller = new Vue({
    el: '#controller',
    data: {
        datas: [],
        data: {},
        actionUrl,
        apiUrl,
        editStatus: false,
        addStatus: false,
    },
    mounted: function () {
        this.datatable();
    },
    methods: {
        datatable() {
            const _this = this;
            _this.table = $('#datatable').DataTable({
                ajax: {
                    url: _this.apiUrl,
                    type: 'GET',
                },
                columns: columns,
            }).on('xhr', function () {
                _this.datas = _this.table.ajax.json().data;
            });
        },
        deleteData(event, id) {
            if (confirm("Are you sure?")) {
                $(event.target).parents('tr').remove();
                axios.post(this.actionUrl + '/' + id, { _method: 'DELETE' }).then(response => {
                    alert('Data has been removed!');
                });
            }
        },
    }
});
</script>

@endsection