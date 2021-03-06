
<div class="row">
    <div class="col-md-12">        
        <form method="post" action="/category/{{$item->id}}" class="form-horizontal ajaxForm">           
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">التصنيف</label>
            <div class="col-sm-10">
                <input autofocus type="text" class="form-control" id="name" name="name" placeholder="ااسم التصنيف" value="{{$item->name}}">
                <div class="text-danger">{{$errors->first('name')}}</div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="unit_id" class="col-sm-2 control-label">الوحدة</label>
            <div class="col-sm-10">
                <select name="unit_id" class="form-control" id="unit_id">
                    <option value="">اختر الوحدة</option>
                    @foreach($units as $c)
                        <option  {{$item->unit_id==$c->id?"selected":""}} value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach()
                </select>
                <div class="text-danger">{{$errors->first('unit_id')}}</div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button data-refresh="true" type="submit" class="btn btn-primary">حفظ</button>
                <a href="/category"  data-dismiss="modal" class="btn btn-default">الغاء الامر</a>
            </div>
          </div>
        </form>
    </div>
</div>

<script>
    PageLoadMethods();
</script>