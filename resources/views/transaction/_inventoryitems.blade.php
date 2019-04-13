
<div class="panel panel-success">
    <div class="panel-heading">
      الاصناف الموجودة في المخزن
    </div> 
    
    <table id="tblItems" class="table table-hover table-stripped">
    <thead>
        <tr>
            <th width="40%">الصنف</th>
            <th width="20%">الكمية الحالية</th>
            <th width="20%">الكمية بعد الجرد</th>
        </tr>
    </thead>
    <tbody>
        @foreach($store_items as $i)
        <tr>
            <td>{{$i->Item->name}}</td>
            <td>{{$i->balance}} {{$i->Unit->name}}</td>
            <td><input type="number" min="0" max="9999999999" step="0.1" value="{{$i->balance}}" class="form-control input-sm" name="quantity_ids[]" placeholder="الكمية بعد الجرد">
                <input type="hidden" name="item_ids[]" value="{{$i->item_id}}">
                <input type="hidden" name="unit_ids[]" value="{{$i->unit_id}}">
            </td>
        </tr>
        @endforeach()
    </tbody>
</table>
</div>


<div class="panel panel-success">
    <div class="panel-heading">
      الاصناف غير الموجودة في المخزن
    </div> 
    
    <table id="tblItems" class="table table-hover table-stripped">
    <thead>
        <tr>
            <th width="40%">الصنف</th>
            <th width="20%">الكمية الحالية</th>
            <th width="20%">الكمية بعد الجرد</th>
        </tr>
    </thead>
    <tbody>
        @foreach($new_items as $i)
        <tr>
            <td>{{$i->name}}</td>
            <td>0 {{$i->Category->Unit->name}}</td>
            <td><input type="number" min="0" max="9999999999" step="0.1" value="0" class="form-control input-sm" name="quantity_ids[]" placeholder="الكمية بعد الجرد">
                <input type="hidden" name="item_ids[]" value="{{$i->id}}">
                <input type="hidden" name="unit_ids[]" value="{{$i->Category->unit_id}}">
            </td>
        </tr>
        @endforeach()
    </tbody>
</table>
</div>