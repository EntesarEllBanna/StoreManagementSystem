@extends("_layout")

@section("title")
ادارة الأصناف
@endsection()

@section("content")
<div class="row">
    <div class="col-sm-8">
        <form method="get" class="row DTForm" action="/item">
            <div class="col-sm-5">
                <input name="q" type="text" class="form-control" placeholder="بحث عن صنف...">
            </div>
            
               <div class="col-sm-3">
                <select name="category" class="form-control">
                    <option value="">جميع التصنيفات</option>
                    @foreach($category as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach()
                </select>
            </div>
            
            
             <div class="col-sm-3">
                <select name="active" class="form-control">
                    <option value="">الحالات </option>
                    <option value="1">فعال</option>
                    <option value="0">غير فعال</option>
                </select>
            </div>
    
            <div class="col-sm-1 text-right">
                <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i> بحث!</button>
            </div>
        </form>
    </div>
    
    
    
    
    
    
    
    <div class="col-sm-4 text-right">
        <a href="/item/create" title="انشاء صنف جديد" class="btn Popup btn-success"><i class="glyphicon glyphicon-plus"></i> اضافة صنف جديد</a>
    </div>
</div>
<hr>

<table id="tblAjax" class="table table-hover table-stripped">
    <thead>
        <tr>
            <th>الأصناف</th>
            <th width="30%">التصنيف</th>
                <th width="20%">تاريخ الإنشاء</th>
             <th width="10%">فعال</th>
            <th width="12%"></th>
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
            //$(".cbActive").click(function(){
            $(document).on("click",".cbActive",function(){
                var id=$(this).val();
                $.get("/item/"+id+"/activate");
            });
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
               "columnDefs": [ {
                   "targets": 4,
                   "orderable": false
               } ],
 		       "order": [[ 1, "asc" ]],
               serverSide: true,
               columns: [                       
                       { data: 'name', name: 'name' },
                       { data: 'category', name: 'category' },
                       { data: 'created_at', name: 'created_at' }, 
                   
                       { name: 'buttons', "render": function (data, type, row) {
                               return "<input type='checkbox' "+(row["active"]=="1"?"checked":"")+" class='cbActive' value='" + row["id"] + "' />";
                           }
                       },
                   
                   
                   
                       {
                           name: 'buttons', "render": function (data, type, row) {
                               return "<a title='تعديل صنف' href='/item/" + row["id"] + "/edit' class='btn btn-primary Popup btnEdit btn-xs'><i class='glyphicon glyphicon-edit'></i></a> "                              
                               + " <a href='/item/" + row["id"] + "/delete' class='btn ConfirmLink btn-danger btn-xs'><i class='glyphicon glyphicon-trash'></i></a>";
                           }
                       }
               ],
               ajax: {
                   type: "POST",
                   contentType: "application/json",
                   url: '/item/AjaxDT',
                   data: function (d) {
					   d._token="{{csrf_token()}}";
                       d.q = $("[name=q]").val();
                       d.category = $("[name=category]").val();
                       d.active = $("[name=active]").val();
                       return JSON.stringify(d);
                   }
               },
               fnDrawCallback: function () {
               }
           });
        }
    </script>
@endsection()
