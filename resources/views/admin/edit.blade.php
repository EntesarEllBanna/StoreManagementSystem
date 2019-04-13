
<div class="row">
    <div class="col-md-12">        
        <form method="post" action="/admin/{{$item->id}}" class="ajaxForm">           
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
            <div class="form-group">
            <label for="fullname" class="col-sm-4 control-label">اسم المستخدم </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="fullname" id="fullname" placeholder="اسم المستخدم" value="{{$item->fullname}}">
                <div class="text-danger">{{$errors->first('fullname')}}</div>
            </div>
          </div>
            <br>
            <br>
            <br>
         <div class="form-group">
            <label for="email" class="col-sm-4 control-label">االبريد الالكتروني </label>
            <div class="col-sm-8">
                <input autofocus readonly type="text" class="form-control" id="email" name="email" placeholder=" البريد الالكتروني" value="{{$item->email}}">
                <div class="text-danger">{{$errors->first('email')}}</div>
            </div>
          </div>
            <br>
            <br>
             <div class="form-group">
            <label for="resetpassword" class="col-sm-4 control-label">كلمة المرور </label>
            <div class="col-sm-8">
                <input autofocus type="password" class="form-control" id="resetpassword" name="resetpassword" placeholder=" لتغيير كلمة المرور ">
                <div class="text-danger">{{$errors->first('resetpassword')}}</div>
            </div>
          </div>
            <br>
            <br>
            <div class="form-group">
            <label for="mobile" class="col-sm-4 control-label">رقم الجوال  </label>
            <div class="col-sm-8">
                <input autofocus type="text" class="form-control" id="mobile" name="mobile" placeholder="رقم الجوال" value="{{$item->mobile}}">
                <div class="text-danger">{{$errors->first('mobile')}}</div>
            </div>
          </div>
          
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
              <div class="checkbox">
                <label>
                    <input type="hidden" value="0" name="active">                    
                    <input value="1" {{$item->active?"checked":""}} name="active" type="checkbox"> فعال
                </label>
              </div>
            </div>
          </div>
            
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
              <button data-refresh="true" type="submit" class="btn btn-primary">حفظ</button>
                <a href="/admin"  data-dismiss="modal" class="btn btn-default">الغاء الامر</a>
            </div>
          </div>
        </form>
    </div>
</div>

<script>
    PageLoadMethods();
</script>