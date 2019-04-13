@extends("_layout")

@section("title")
حركة اصناف لمخزن - اتلاف
@endsection()

@section("content")

<form method="post" class="ajaxForm" action="/transaction/storedestroy">
    {{csrf_field()}}
    <div class="row">
    <div class="col-sm-6">                
        <select name="store_id" id="store_id" class="form-control">
            <option value="">المخزن </option>
            @foreach($stores as $i)
                <option value="{{$i->id}}">{{$i->name}} 
                </option>
            @endforeach()
        </select>
    </div>
    <div class="col-sm-6">
        <input name="transaction_date" id="transaction_date" class="form-control" placeholder="تاريخ الحركة yyyy-mm-dd">
    </div>  
</div>
<hr>
<div class="panel panel-success">
    <div class="panel-heading">
        الاصناف
    </div>
    <div class="panel-body">
        <div class="row">
    <div class="col-sm-5">                
        <select name="item_id" id="item_id" class="form-control">
            <option value="">الاصناف </option>
            @foreach($items as $i)
                <option data-unit='{{$i->Category->Unit->name}}' data-unitid='{{$i->Category->Unit->id}}' value="{{$i->id}}">{{$i->name}}
            </option>
            @endforeach()
        </select>
    </div>
    <div class="col-sm-5 relative">
        <input name="quantity" id="quantity" type="number" min="0" max="99999999" step="0.01" class="form-control" placeholder="الكمية...">
        <div class="unit"></div>
    </div>    
    <div class="col-sm-2 text-right">
        <button class="btn btn-info btnAddItem btn-block" type="button"><i class="glyphicon glyphicon-plus"></i> اضافة</button>
    </div>
</div>
    </div>
    
    <table id="tblItems" class="table table-hover table-stripped">
    <thead>
        <tr>
            <th>الصنف</th>
            <th width="20%">الكمية</th>
            <th width="12%"></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>
<hr>
<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-save"></i> حفظ</button>
</form>

@endsection()
@section("css")
    <style>
        .error{
            border: solid 1px red !important;
        }
        .relative{
            position: relative;
        }
        .unit{
            position: absolute;
            left: 50px;
            top: 5px;
            color:#999;
        }
    </style>
@endsection()
@section("js")
<script>    
    $(function(){
        $(".btnAddItem").click(function(){
            $(".error").removeClass("error");
            var ok=true;
            $q=$("#quantity").val();
            $i=$("#item_id").val();
            if($q==""){
                $("#quantity").addClass("error");                
                if(ok){
                    $("#quantity").focus();
                    ok=false;
                }
            }
            if($i==""){
                $("#item_id").addClass("error");                
                if(!ok){
                    $("#item_id").focus();
                    ok=false;
                }
            }
            if(ok){
                $("#tblItems tbody").append("<tr><td>"+$("#item_id").children(":selected").text()+"</td><td>"+$("#quantity").val()
                    +" "+$(".unit").text()+"</td><td><button type='button' class='btn btnDelete btn-danger btn-xs'><i class='glyphicon glyphicon-trash'></i></button><input type='hidden' name='item_ids[]' value='"+$("#item_id").val()+"' /><input type='hidden' name='unit_ids[]' value='"+$("#item_id").children(":selected").data("unitid")+"' /><input type='hidden' name='quantity_ids[]' value='"+$("#quantity").val()+"' /></td></tr>");
                $("#quantity,#item_id").val("");
                $(".unit").text("");
                $("#item_id").focus();
            }
        });
        $("#item_id").change(function(){
            $(".unit").text($(this).children(":selected").data("unit"));
        });
        $(document).on("change",".error",function(){
            if($(this).val()!="")
                $(this).removeClass("error");
        });
        $(document).on("click",".btnDelete",function(){
            $(this).parent().parent().remove();
        });
    });   
</script>
@endsection()
