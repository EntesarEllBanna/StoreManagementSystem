@extends("_layout")

@section("title")
حركة اصناف لمخزن - جرد
@endsection()

@section("content")

<form method="post" class="ajaxForm" action="/transaction/storeinventory">
    {{csrf_field()}}
    <div class="row">
    <div class="col-sm-6">                
        <select name="store_id" id="store_id" class="form-control select2">
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
<div class="divItems">
    
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
        $("#store_id").change(function(){
            if($(this).val()=="")
                $(".divItems").html("");
            else{
                $(".divItems").load("/transaction/inventory_items/"+$(this).val())   ;
            }
        });
    });   
</script>
@endsection()
