@extends("_layout")

@section("title")
ارشيف حركات المخازن
@endsection()

@section("content")
<div class="row">
    <div class="col-sm-12">
        <form method="get" class="row DTForm" action="/balance">
            <div class="col-sm-2">
                <select name="store_id" class="form-control select2">
                    <option value="">جميع المخازن</option>
                    @foreach($stores as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach()
                </select>
            </div>
            
            <div class="col-sm-2">
                <select name="type_id" class="form-control select2">
                    <option value="">جميع الحركات</option>
                    @foreach($types as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach()
                </select>
            </div>
            <div class="col-sm-3">
                <input name="from" id="from" class="form-control" placeholder="من تاريخ yyyy-mm-dd">
            </div>
            <div class="col-sm-3">
                <input name="to" id="to" class="form-control" placeholder="الى تاريخ yyyy-mm-dd">
            </div>
            <div class="col-sm-2 text-right">
                <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i> بحث!</button>
                <a class="btn btn-success" href="/transaction/export">Excel</a>
            </div>
        </form>
    </div>
    
</div>
<hr>

<table id="tblAjax" class="table table-hover table-stripped">
    <thead>
        <tr>
            <th>المخزن</th>
            <th width="15%">الحركة</th>
            <th width="13%">التاريخ</th>
            <th width="20%">بواسطة</th>
            <th width="10%">التفاصيل</th>
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
 		       "order": [[3, "asc" ]],
               "columnDefs": [ {
                   "targets": 4,
                   "orderable": false
               } ],
               serverSide: true,
               columns: [                       
                       { data: 'store', name: 'store' },
                       { data: 'transaction_type', name: 'transaction_type' },
                       { data: 'transaction_date', name: 'transaction_date' },
                       { data: 'created_by_name', name: 'created_by_name' },
                       {
                           name: 'balance', "render": function (data, type, row) {
                               return "<a title='تفاصيل الحركة' href='/transaction/transaction_details/"+row["id"]
                                    +"' class='btn Popup btn-info btn-xs'><i class='fa fa-list'></i></a>";
                           }
                       }
               ],
               ajax: {
                   type: "POST",
                   contentType: "application/json",
                   url: '/transaction/ArchiveDT',
                   data: function (d) {
					   d._token="{{csrf_token()}}";
                       d.type_id = $("[name=type_id]").val();
                       d.to = $("[name=to]").val();
                       d.from = $("[name=from]").val();
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
