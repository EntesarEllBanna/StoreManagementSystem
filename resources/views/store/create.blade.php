
<div class="row">
    <div class="col-md-12">        
        <form method="post" action="/store" class="form-horizontal ajaxForm">           
            {{csrf_field()}}
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">المخزن</label>
            <div class="col-sm-10">
                <input autofocus type="text" class="form-control" id="name" name="name" placeholder="اسم المخزن" value="{{old("name")}}">
                <div class="text-danger">{{$errors->first('name')}}</div>
            </div>
          </div>
            
            
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                    <input type="hidden" value="0" name="active">                    
                    <input {{old("active")?"checked":""}} value="1"  name="active" type="checkbox"> فعال
                </label>
              </div>
            </div>
          </div>
            
            
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" data-refresh="true" class="btn btn-primary">اضافة</button>
                <a href="/store"  data-dismiss="modal" class="btn btn-default">الغاء الأمر</a>
            </div>
          </div>
            
            
        </form>
    </div>
</div>
<script>
    PageLoadMethods();
</script>