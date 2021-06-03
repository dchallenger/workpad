<div class="form-group">
    <label class="control-label col-md-3">Attachment</label>
    <div class="col-md-7">
        <div class="fileupload fileupload-new" data-provides="fileupload" id="partners_personal_history-licensure-attachments-container">
            <input type="hidden" name="key[<?php echo $key->key_class_id?>][<?php echo $key->key_id?>]" id="attachments" value="">
        <!-- </div> -->
            <!-- <div class="fileupload-preview thumbnail " style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>                             -->
            <div class="input-group">
                <span class="input-group-btn">
                    <span class="uneditable-input">
                        <i class="fa fa-file fileupload-exists"></i> 
                        <span class="fileupload-preview"></span>
                    </span>
                </span>                
                <div id="licensure-attachments-container">
                    <span class="btn default btn-file add_file">
                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" name="files[]" class="default file family_attach"/>
                    </span>
                    <a data-dismiss="fileupload" class="btn red fileupload-exists fileupload-delete"><i class="fa fa-trash-o"></i> Remove</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function () {
    $('.family_attach').fileupload({ 
        url: base_url + module.get('route') + '/single_upload',
        autoUpload: true,
        contentType: false,
    }).bind('fileuploadadd', function (e, data) {
        $.blockUI({ message: '<div>Attaching file, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />' });
    }).bind('fileuploaddone', function (e, data) { 

        $.unblockUI();
        var file = data.result.file;
        if(file.error != undefined && file.error != "")
        {
            notify('error', file.error);
        }
        else{
            $(this).parent().parent().parent().children('span').children('span').children('span.fileupload-preview').html(file.name);
            $(this).parent().children('span.fileupload-new').css('display', 'none');
            $(this).parent().children('.fileupload-exists').css('display', 'inline-block');
            $(this).parent().parent().children('.fileupload-delete').css('display', 'inline-block');
            $(this).parent().parent().parent().parent().children('input:hidden:first').val(file.url);
        }
    }).bind('fileuploadfail', function (e, data) { 
        $.unblockUI();
        notify('error', data.errorThrown);
    });

    $('.fileupload-delete').click(function(){
        $(this).parent().parent().parent().children('input:hidden:first').val('');
        $(this).parent().parent().children('span').children('span').children('span.fileupload-preview').html('');
        $(this).parent().children('span.add_file').children('span.fileupload-new').css('display', 'inline-block');
        $(this).parent().children('span.add_file').children('span.fileupload-exists').css('display', 'none');
        $(this).css('display', 'none');

        // $('#users_profile-photo').val('');
        // $('#users_profile-photo-container .fileupload-preview').html('');
        // $("#img-preview").attr('src', base_url + 'assets/img/avatar.png');
        // $('#photo-container .fileupload-new').each(function(){ $(this).css('display', 'inline-block') });
        // $('#photo-container .fileupload-exists').each(function(){ $(this).css('display', 'none') });
    });
});
</script>