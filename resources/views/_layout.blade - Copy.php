
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/bootstrap/favicon.ico">

    <title>@yield("title") - Bootstrap with Laravel</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/bootstrap/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="/nprogress-master/nprogress.css" rel="stylesheet">
    <link href="/toastr-master/build/toastr.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    @yield("css")
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Laravel</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a target="_blank" href="/">Home</a></li>
            <li><a target="_blank" href="/basic">Basic</a></li>
            <li><a target="_blank" href="/photos">Photos</a></li>
            <li><a target="_blank" href="/accounts">Accounts</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Database <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/accountsdb">Accounts Database</a></li>
                <li><a href="/countrydb">Country Database</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/accountsdbeq">Accounts Database (Elequent)</a></li>
                <li><a href="/countrydbeq">Country Database (Elequent)</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/accountsdbeqr">Accounts Database (Elequent + Request)</a></li>
                <li><a href="/accountsdbeqr/paging">Accounts Paging</a></li>
                <li><a href="/accountsdbeqr/pagingsimple">Accounts Paging (Simple)</a></li>
                <li><a href="/accountsdbeqr/search">Accounts Search</a></li>
                <li><a href="/accountsdbeqr/searchpaging">Accounts Search Paging</a></li>
                <li><a href="/accountsdbeqr/searchpagingadvanced">Accounts Search Paging Advanced</a></li>
                  
                <li role="separator" class="divider"></li>
                <li><a href="/accountsadv">Accounts Advanced</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Begin page content -->
    <div class="container">
        <div class="page-header">
            <h1>@yield("title")</h1>
        </div>
        @include("_msg")        
        @yield("content")
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </footer>

    <div id="Confirm" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Coinfirmation</h4>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <a class="btn btn-danger">Yes, sure</a>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
     <div id="Popup" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="/js/jquery.min.js"></script>-->
    <script src="/datatable/media/js/jquery.js"></script>  
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/nprogress-master/nprogress.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    <script src="/js/jquery.form.min.js"></script>
    <script src="/toastr-master/build/toastr.min.js"></script>
    @yield("js")
      <script>
          $(function(){
                //$("#Confirm").modal("show");
                //$(".ConfirmLink").click(function(){
                $(document).on("click",".ConfirmLink",function(){
                    $("#Confirm").modal("show");
                    // اجعل رابط زر التحذير
                    //الموجود بداخل الديالوغ يودي على نفس المكان اللي المفروض نروح عليه
                    $("#Confirm .btn-danger").attr("href",$(this).attr("href"));
                    return false;//ما تكمل وتحذف استنى
                });
              		
                $(document).on("click",".Popup",function(){
                    $("#Popup .modal-body").html
                    ("<h1 class='text-center'><i style='font-size:48px;' class='fa fa-spinner fa-spin'></i></h1>");
                    $("#Popup .modal-title").text($(this).attr("title"));
                    $("#Popup .modal-body").load($(this).attr("href"));
                    $("#Popup").modal("show");
                    return false;	
                });
              
                //Global Ajax Events
                $( document ).ajaxStart(function() {
                    NProgress.start()
                });

                $( document ).ajaxStop(function() {
                    NProgress.done()
                });		

                $( document ).ajaxError(function() {
                    NProgress.done()
                });
                PageLoadMethods();
                   
                $(".DTForm").submit(function(e) {
                    BindDataTable();
                    return false;
                });
                if($('#tblAjax').size()>0){
                    $("#Confirm .btn-danger").click(function(e) {
                        $.get($("#Confirm .btn-danger").attr("href"),function(json){
                            if(json.status==1){
                                ShowMessage(json.msg,"success","Manage Accounts");
                            }
                            else{
                                ShowMessage(json.msg,"error","Manage Accounts");				
                            }						
                            BindDataTable();
                        });
                        $("#Confirm").modal("hide");
                        return false;
                    });
                }
          });
          function PageLoadMethods(){
              $(".ajaxForm").ajaxForm({
				success:function(json) { 	
					$(".ajaxForm :submit").prop("disabled",false);
					if(json.status==1){
						$('.ajaxForm').resetForm();
						ShowMessage(json.msg,"success","Manage Accounts");

						if($(".ajaxForm :submit").data("refresh")==true){
							$("#Popup").modal("hide");
							BindDataTable();
						}
					}
					else{
						ShowMessage(json.msg,"error","Manage Accounts");				
					}
					if(json.redirect!=null)
						window.location=json.redirect;
					if(json.close!=null)
						$("#Popup").modal("hide");
				}
				,beforeSubmit:function(){
					$(".ajaxForm :submit").prop("disabled",true);
				}
				,error: function(json) {          
					$(".ajaxForm :submit").prop("disabled",false);
					errorsHtml="<ul>";
					$.each( json.responseJSON, function( key, value ) {
						console.log(value);
						errorsHtml += '<li>' + value[0] + '</li>';
					});
					errorsHtml+="</ul>";
					ShowMessage(errorsHtml,"error","Manage Accounts");
				}
			}); 
          }
          toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-bottom-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
           }
           function ShowMessage(msg,color,title){			
               Command: toastr[color](msg,title);
           }
      </script>
  </body>
</html>
