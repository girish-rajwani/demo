@extends('header')
@section('content')
<link href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></link>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/jquery.fileupload.css">
<script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script> 
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>
<script src="js/jquery.fileupload-process.js"></script>
<script src="js/jquery.fileupload-image.js"></script>
<script src="js/jquery.fileupload-audio.js"></script>
<script src="js/jquery.fileupload-video.js"></script>
<script src="js/jquery.fileupload-validate.js"></script>
<link rel='stylesheet' href='https://www.jquery-az.com/boots/style.css'></link>
<link rel='stylesheet' href='https://www.jquery-az.com/boots/css/bootstrap-imageupload/bootstrap-imageupload.css'></link>
<style>
            body {
                padding-top: 70px;
            }

            .imageupload {
                margin: 20px 0;
            }
        </style>
<div class="container">
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="save-demo" method="post" id="upload_form" enctype="multipart/form-data"> 
        <div class="container">
            <!-- bootstrap-imageupload. -->
            <div class="imageupload panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left">Select Image file</h3>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default active">File</button>
                        <button type="button" class="btn btn-default">URL</button>
                    </div>
                </div>
                <div class="file-tab panel-body">
                    <label class="btn btn-primary btn-file">
                        <span>Browse</span>
                        <!-- The file is stored here. -->
                        <input type="file" name="filename[]">
                    </label>
                    <button type="button" class="btn btn-danger">Delete image</button>
                </div>
                <div class="url-tab panel-body">
                    <div class="input-group">
                        <input type="text" class="form-control hasclear" placeholder="Image URL">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-default">Remove</button>
                    <!-- The URL is stored here. -->
                    <input type="hidden" name="image-url">
                </div>
            </div>
        </div>
        <script src="https://www.jquery-az.com/boots/js/bootstrap-imageupload/bootstrap-imageupload.js"></script>
        <script>
            var $imageupload = $('.imageupload');
            $imageupload.imageupload({
                maxWidth: 500,
                maxHeight: 500,
                maxFileSizeKb: 3048
            });

        </script>
        <!--div class="row">        
        <input type='file' id="imgInp" />
        <img id="blah" height="40" width="40" src="#" alt="your image" />   
        </div-->
        <!-- The fileinput-button span is used to style the file input field as button -->
        <!--span class="btn btn-success fileinput-button">
            <i class="glyphicon glyphicon-plus"></i>
            <span>Add files...</span>

            <input id="fileupload" type="file" name="filename[]" multiple>
        </span>
        <br>
        <br>

        <div id="progress" class="progress">
            <div class="progress-bar progress-bar-success"></div>
        </div>
        
        <div id="files" class="files"></div-->
        <br>    

        <input type="submit"/>
    </form>

<table class="table table-bordered" id="model_table">
    <thead>
        <tr>
            <th>
                ID
            </th>
            <th>
                Manufacturer
            </th>
            <th>
                Model
            </th>
            <th>
                Count
            </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Model Data</h4>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="model_data">
                <thead>
                    <tr>
                        <th>
                            Model Name
                        </th>
                        <th>
                            Model Color
                        </th>
                        <th>
                            Manufacturing Year
                        </th>
                        <th>
                            Registeration Number
                        </th>
                        <th>
                            Note
                        </th>                        
                    </tr>
                </thead>
                <tbody>
                </tbody>                
            </table>
            <form action="sold-model" method="POST">
                <input type="hidden" name="id">
                </input>
                <div class="text-center">
                    <input type="submit" value="Sold" class="btn btn-info"></input>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
  </div>
</div>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            console.log(input);
        var reader = new FileReader();
        reader.onload = function(e) {
            console.log(e);
            $('#blah').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function() {
        readURL(this);
    });

    var table = $('#model_table').DataTable({
		processing: true,
		serverSide: true,
		lengthChange: true,
		"ajax": {
			"url": 'get-model-data',
			"dataSrc": "data.data"
		},
		"columns": [
			{"data": "id", "name": "id"},
			{"data": "manufacturer_name", "name": "manufacturer_name"},
            {"data": "model_name", "name": "model_name"},			
			{"data": "count", "name": "count"}
		],
        // "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        //     $(nRow).attr('id', aData[0]);
        // },
        "createdRow": function ( row, data, index ) {            
            $(row).attr('id', data.id);  
            $(row).attr('data-toggle', 'modal'); 
            $(row).attr('data-target', '#myModal');          
        },
		dom: '<Blf<t>ip>',
		order: [[0, 'desc']],
		buttons: [			
		],
		pageLength: 10,
		lengthMenu: [10, 25, 50, 75, 100],
		initComplete: function (settings, json) {			       
		}
	});
    $('#model_table').on('click', 'tbody tr', function() {
        var id = $(this).attr("id");     
        var modal_data;   
        $.ajax({
            "url":"get-single-model-data",
            "type":"POST",
            "async":false,
            "data":{id:id},
            "success":function(data){
                model_data = $.parseJSON(data);                
                $('#model_data tbody').html("");
                $('#myModal #model_id').val(id);                 
                for(i=0; i < model_data.length; i++)
                {
                    $('#model_data tbody').append("<tr><td>"+model_data[i].model_name+"</td><td>"+model_data[i].model_color+"</td><td>"+model_data[i].manufacturing_year+"</td><td>"+model_data[i].reg_number+"</td><td>"+model_data[i].note+"</td></tr>");    
                }                
            }
        });
    });
    $(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {            
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>');
                    //.append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
@endsection
