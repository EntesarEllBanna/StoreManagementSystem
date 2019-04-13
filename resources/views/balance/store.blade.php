@extends("_layout")

@section("title")
ارصدة المخازن والاصناف
@endsection()

@section("content")
<div class="row">
    <div class="col-sm-12">
        <form method="get" class="row DTForm" action="/balance">
            <div class="col-sm-5">
                <select name="store_id" class="form-control select2">
                    <option value="">جميع المخازن</option>
                    @foreach($stores as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach()
                </select>
            </div>
            
               <div class="col-sm-3">
                <select name="item_id" class="form-control select2">
                    <option value="">جميع الاصناف</option>
                    @foreach($items as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach()
                </select>
            </div>
            <div class="col-sm-1 text-right">
                <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i> بحث!</button>
            </div>
        </form>
    </div>
    
</div>
<hr>

<table id="tblAjax" class="table table-hover table-stripped">
    <thead>
        <tr>
            <th>المخزن</th>
            <th width="30%">الصنف</th>
            <th width="20%">الرصيد</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection()
@section("css")
    
        <link href="/metronic-rtl/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css" rel="stylesheet" type="text/css" />
        <style>
        table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting{
			padding-right:15px;
		}
        </style>
@endsection()
@section("js")
    <script src="/metronic-rtl/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="/metronic-rtl/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="/metronic-rtl/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script>
    
        var oTable;
        $(function(){
            BindDataTable(); 
        });
        
          

   
        //هذه تختلف حسب الصفحة
        function BindDataTable() {
           oTable = $('#tblAjax').dataTable(
           {
			   language: {
               aria: {
						sortAscending: ": فعال لترتيب العمود تصاعديا", sortDescending: ": فعال لترتيب العمود تنازليا"
					}
					, emptyTable:"لا يوجد بيانات لعرضها", info:"عرض _START_ الى _END_ من _TOTAL_ صف", infoEmpty:"لا يوجد نتائج لعرضها", infoFiltered:"(filtered1 من _MAX_ اجمالي صفوف)", lengthMenu:"_MENU_ صف", search:"بحث", zeroRecords:"لا يوجد نتائج لعرضها",
					paginate:{sFirst:"الاول",sLast:"الاخير",sNext:"التالي",sPrevious:"السابق"}
				},
               "iDisplayLength": 10,
               "sPaginationType": "full_numbers",
               "bFilter": false,
               "bDestroy": true,
               "bSort": true,
			   "bStateSave": true,               
 		       "order": [[2, "asc" ]],
               serverSide: true,
               columns: [                       
                       { data: 'store', name: 'store' },
                       { data: 'item', name: 'item' },
                       {
                           name: 'balance', "render": function (data, type, row) {
                               return row["balance"] + " "+ row["unit"];
                           }
                       }
               ],
               ajax: {
                   type: "POST",
                   contentType: "application/json",
                   url: '/balance/AjaxDT',
                   data: function (d) {
					   d._token="{{csrf_token()}}";
                       d.item_id = $("[name=item_id]").val();
                       d.store_id = $("[name=store_id]").val();
                       return JSON.stringify(d);
                   }
               },
               fnDrawCallback: function () {
               }
           });
        }
    </script>
@endsection()
