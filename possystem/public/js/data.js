
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
   }
});
