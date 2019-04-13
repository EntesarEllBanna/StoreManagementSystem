@extends('_layout')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">اهلا وسهلا بك</div>

    <div class="panel-body">
        الرجاء الاختيار من القائمة اليمنى 
    </div>
</div>


<div class="container">
 
 
 <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>
 
</div>
@endsection

@section("title")
الصفحة الرئيسية
@endsection()



@section('js')
<script src="/jquery-multi-upload/js/jquery.fileupload-ui.js"></script>
<script src="/jquery-multi-upload/js/jquery.iframe-transport.js"></script>
<script src="/jquery-multi-upload/js/jquery.fileupload.js"></script>

<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
@endsection()
 
@section('css')
<link href="/jquery-multi-upload/css/jquery.fileupload.css" rel="stylesheet">
<link href="/jquery-multi-upload/css/jquery.fileupload-ui.css" rel="stylesheet">
@endsection()