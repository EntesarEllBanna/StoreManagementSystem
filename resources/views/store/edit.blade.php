
<div class="row">
    <div class="col-md-12">        
        <form method="post" action="/store/{{$item->id}}" class="form-horizontal ajaxForm">
            <!-- 
            طالما عندك بوست على الالرافيل يجب وجود      
            {{csrf_field()}}
            -->
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">المخزن</label>
            <div class="col-sm-10">
                <input autofocus type="text" class="form-control" id="name" name="name" placeholder="ااسم المخزن" value="{{$item->name}}">
                <div class="text-danger">{{$errors->first('name')}}</div>
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
                <a href="/store"  data-dismiss="modal" class="btn btn-default">الغاء الامر</a>
            </div>
          </div>
        </form>
    </div>
</div>

<script>
    PageLoadMethods();
</script>