@extends("_layout")

@section("title")
اضافة مستخدم جديد
@endsection()

@section("content")



<div class="panel panel-success" >
    <div class="panel-heading">
        مستخدم جديد
    </div>
<div class="panel-body">
    <div class="row">
    <div class="col-md-14">        
        <form method="post" action="/admin" class="ajaxForm">
               
            {{csrf_field()}}
            <div class="panel-body">
                 <div class="form-group">
                 <label for="fullname" class="col-sm-2 control-label">السم المستخدم </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="اسم المستخدم" value="{{old("fullname")}}">
                    <div class="text-danger">{{$errors->first('fullname')}}</div>
                    </div>
                 </div>
          <br>
          <br>
                <div class="form-group">
                <label for="email" class="col-sm-2 control-label">االبريد الالكتروني </label>
                   <div class="col-sm-10">
                   <input autofocus type="text" class="form-control" id="email" name="email" placeholder=" البريد الالكتروني" value="{{old("email")}}">
                   <div class="text-danger">{{$errors->first('email')}}</div>
                   </div>
                </div>
         <br>
         <br>
             <div class="form-group">
            <label for="password" class="col-sm-2 control-label">كلمة المرور </label>
            <div class="col-sm-10">
                <input autofocus type="password" class="form-control" id="password" name="password" placeholder=" كلمة المرور " value="{{old("password")}}">
                <div class="text-danger">{{$errors->first('password')}}</div>
            </div>
          </div>
            <br>
            <br>
                <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">رقم الجوال  </label>
                    <div class="col-sm-10">
                        <input autofocus type="text" class="form-control" id="mobile" name="mobile" placeholder="رقم الجوال" value="{{old("mobile")}}">
                        <div class="text-danger">{{$errors->first('mobile')}}</div>
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
                  <button type="submit" data-refresh="true" class="btn btn-primary">إضافة</button>
                    <a href="/admin/create" class="btn btn-default">الغاء الأمر</a>
                </div>
              </div>
         </div>
        </form>
    </div>
</div>
        
@endsection()

@section("js")

<script>
    PageLoadMethods();
</script>

@endsection()
