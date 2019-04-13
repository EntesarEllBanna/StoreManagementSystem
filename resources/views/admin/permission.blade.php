   
        <form method="post" action="/admin/setpermission/{{$id}}" class="ajaxForm">            
            {{csrf_field()}}
            

          <div class="form-group">
            <div class="col-sm-12">
                <ul class="list-unstyled permission">
              <?php
                $links = \DB::table("link")->where("parent_id",0)->get();
                ?>
                    @foreach($links as $l)
                    <?php
                    $hasLinkPermission=\DB::table("admin_link")->where("admin_id",$id)->where("link_id",$l->id)->count()>0;
                    $sublinks = \DB::table("link")->where("parent_id",$l->id)->get();
                    ?>
                    <li>
                        <label><input {{$hasLinkPermission?"checked":""}} name="permission[]" type="checkbox" value='{{$l->id}}' /> <b>{{$l->title}}</b></label>
                        @if(count($sublinks)>0)
                        <ul class="list-unstyled">
                            @foreach($sublinks as $sl)
                            <?php
                            $hasSubLinkPermission=\DB::table("admin_link")->where("admin_id",$id)->where("link_id",$sl->id)->count()>0;
                            ?>
                                <li>
                                     <label><input {{$hasSubLinkPermission?"checked":""}} name="permission[]" type="checkbox" value='{{$sl->id}}' /> {{$sl->title}}</label>
                                </li>
                            @endforeach()
                        </ul>
                        @endif()
                    </li>
                    @endforeach()
                </ul>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <button type="submit" data-refresh="true" class="btn btn-primary">حفظ الصلاحيات</button>
                <a  data-dismiss="modal" class="btn btn-default">الغاء الأمر</a>
            </div>
          </div>
            <div class="clearfix"></div>
        </form>

<script>
    PageLoadMethods();
    $(".permission :checkbox").click(function(){
        $(this).parent().next().find(":checkbox").prop("checked",$(this).prop("checked"));
        $(this).parents("ul").each(function(){
            var checked=$(this).find(":checked").size()>0;
            $(this).prev().find(":checkbox").prop("checked",checked);
        });
    });
</script>

