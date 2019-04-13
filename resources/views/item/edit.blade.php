
<div class="row">
    <div class="col-md-12">        
        <form method="post" action="/item/{{$item->id}}" class="form-horizontal ajaxForm">
            <!-- 
            طالما عندك بوست على الالرافيل يجب وجود      
            {{csrf_field()}}
            -->
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">الأصناف</label>
            <div class="col-sm-10">
                <input autofocus type="text" class="form-control" id="name" name="name" placeholder="ااسم الصنف" value="{{$item->name}}">
                <div class="text-danger">{{$errors->first('name')}}</div>
            </div>
          </div>
          
            
                <div class="form-group">
            <label for="category_id" class="col-sm-2 control-label">التصنيف</label>
            <div class="col-sm-10">
                <select name="category_id" class="form-control" id="category_id">
                    <option value="">اختر التصنيف</option>
                    @foreach($category as $c)
                        <option  {{old("category_id")==$c->id?"selected":""}} value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach()
                </select>
                <div class="text-danger">{{$errors->first('category_id')}}</div>
            </div>
          </div>
            
            
            
             <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                    <input type="hidden" value="0" name="active">                    
                    <input value="1" {{$item->active?"checked":""}} name="active" type="checkbox"> فعال
                </label>
              </div>
            </div>
          </div>
            
            
            
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button data-refresh="true" type="submit" class="btn btn-primary">حفظ</button>
                <a href="/item"  data-dismiss="modal" class="btn btn-default">الغاء الامر</a>
            </div>
          </div>
        </form>
    </div>
</div>

<script>
    PageLoadMethods();
</script>