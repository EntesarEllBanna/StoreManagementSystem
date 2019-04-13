
    <div class="panel-body">
<div class="row">
    <div class="col-md-12">        
        <form method="post" action="/admin" class="ajaxForm">
            <!-- 
            طالما عندك بوست على الالرافيل يجب وجود      
            {{csrf_field()}}
            -->
            {{csrf_field()}}

            <div class="panel-body">
          <div class="form-group">
            <label for="fullname" class="col-sm-4 control-label">السم المستخدم </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="fullname" id="fullname" placeholder="اسم المستخدم" value="{{old("fullname")}}">
                <div class="text-danger">{{$errors->first('fullname')}}</div>
            </div>
          </div>
             <br>
            <br>
             <div class="form-group">
            <label for="email" class="col-sm-4 control-label">االبريد الالكتروني </label>
            <div class="col-sm-8">
                <input autofocus type="text" class="form-control" id="email" name="email" placeholder=" البريد الالكتروني" value="{{old("email")}}">
                <div class="text-danger">{{$errors->first('email')}}</div>
            </div>
          </div>
            <br>
            <br>
                
             <div class="form-group">
            <label for="password" class="col-sm-4 control-label">كلمة المرور </label>
            <div class="col-sm-8">
                <input autofocus type="password" class="form-control" id="password" name="password" placeholder=" كلمة المرور " value="{{old("password")}}">
                <div class="text-danger">{{$errors->first('password')}}</div>
            </div>
          </div>
            <br>
            <br>
              <div class="form-group">
            <label for="mobile" class="col-sm-4 control-label">رقم الجوال  </label>
            <div class="col-sm-8">
                <input autofocus type="text" class="form-control" id="mobile" name="mobile" placeholder="رقم الجوال" value="{{old("mobile")}}">
                <div class="text-danger">{{$errors->first('mobile')}}</div>
            </div>
          </div>
         <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
              <div class="checkbox">
                <label>
                    <input type="hidden" value="0" name="active">                    
                    <input {{old("active")?"checked":""}} value="1"  name="active" type="checkbox"> فعال
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
              <button type="submit" data-refresh="true" class="btn btn-primary">إضافة</button>
                <a href="/admin" class="btn btn-default">الغاء الأمر</a>
            </div>
          </div>
         </div>
        </form>
    </div>
</div>
        


<script>
    PageLoadMethods();
</script>

