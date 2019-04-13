
<div class="row">
    <div class="col-md-12">        
        <form method="post" action="/unit/{{$item->id}}" class="form-horizontal ajaxForm">
            <!-- 
            طالما عندك بوست على الالرافيل يجب وجود      
            {{csrf_field()}}
            -->
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">الوحدة</label>
            <div class="col-sm-10">
                <input autofocus type="text" class="form-control" id="name" name="name" placeholder="ااسم الوحدة" value="{{$item->name}}">
                <div class="text-danger">{{$errors->first('name')}}</div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button data-refresh="true" type="submit" class="btn btn-primary">حفظ</button>
                <a href="/unit"  data-dismiss="modal" class="btn btn-default">الغاء الامر</a>
            </div>
          </div>
        </form>
    </div>
</div>

<script>
    PageLoadMethods();
</script>