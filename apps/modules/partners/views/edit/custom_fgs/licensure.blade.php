<div class="portlet">
	<div class="portlet-title">
		<div class="caption" id="education-category">{{ lang('partners.licensure') }}</div>
		<div class="actions">
            <a class="btn btn-default" onclick="add_form('licensure_examination', 'licensure')">
                <i class="fa fa-plus"></i>
            </a>
		</div>
	</div>
</div>

<div id="personal_licensure">
    <?php $licensure_count = count($licensure_tab); ?>
    <input type="hidden" name="licensure_count" id="licensure_count" value="{{ $licensure_count }}" />
    <?php 
    $count_licensure = 0;
    $months_options = array(
        '' => 'Select...',
        'January' => 'January', 
        'February' => 'February', 
        'March' => 'March', 
        'April' => 'April', 
        'May' => 'May', 
        'June' => 'June', 
        'July' => 'July', 
        'August' => 'August', 
        'September' => 'September', 
        'October' => 'October', 
        'November' => 'November', 
        'December' => 'December'
        );
    foreach($licensure_tab as $index => $licensure){ 
        $count_licensure++;
?>
<div class="portlet">
	<div class="portlet-title">
		<!-- <div class="caption" id="education-category">Company Name</div> -->
		<div class="tools">
            <a class="text-muted" id="delete_licensure-<?php echo $count_licensure;?>" onclick="remove_form(this.id, 'licensure', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a>
			<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
		</div>
	</div>
	<div class="portlet-body form">
        <div class="form-horizontal">
            <div class="form-body">
		<!-- START FORM -->	                
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.title') }}<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[licensure-title][]" id="partners_personal_history-licensure-title" 
                        value="<?php echo (isset($licensure['licensure-title']) ? $licensure['licensure-title'] : ""); ?>" placeholder="Enter Title"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.license_no') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[licensure-number][]" id="partners_personal_history-licensure-number" 
                        value="<?php echo (isset($licensure['licensure-number']) ? $licensure['licensure-number'] : ""); ?>" placeholder="Enter License Number"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.date_taken') }}</label>
                        <div class="col-md-9">
                            <div class="input-group input-medium pull-left">
                                <?php $licensure_month_taken = (isset($licensure['licensure-month-taken']) ? $licensure['licensure-month-taken'] : ""); ?>
                        {{ form_dropdown('partners_personal_history[licensure-month-taken][]',$months_options, $licensure_month_taken, 'class="form-control select2me" data-placeholder="Select..."') }}
                            </div>
                            <span class="pull-left padding-left-right-10">-</span>
                            <span class="pull-left">
                                <input type="text" class="form-control input-small" maxlength="4" name="partners_personal_history[licensure-year-taken][]" id="partners_personal_history-licensure-year-taken" 
                            value="<?php echo (isset($licensure['licensure-year-taken']) ? $licensure['licensure-year-taken'] : ""); ?>"placeholder="Year" data-inputmask="'mask': '9999'">
                            </span>                            
                        </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.validity_until') }}</label>
                        <div class="col-md-9">
                            <div class="input-group input-medium pull-left">
                                <?php $licensure_month_validity_until = (isset($licensure['licensure-month-validity-until']) ? $licensure['licensure-month-validity-until'] : ""); ?>
                        {{ form_dropdown('partners_personal_history[licensure-month-validity-until][]',$months_options, $licensure_month_validity_until, 'class="form-control select2me" data-placeholder="Select..."') }}
                            </div>
                            <span class="pull-left padding-left-right-10">-</span>
                            <span class="pull-left">
                                <input type="text" class="form-control input-small" maxlength="4" name="partners_personal_history[licensure-year-validity-until][]" id="partners_personal_history-licensure-year-validity-until" 
                            value="<?php echo (isset($licensure['licensure-year-validity-until']) ? $licensure['licensure-year-validity-until'] : ""); ?>"placeholder="Year" data-inputmask="'mask': '9999'">
                            </span>                            
                        </div>
                </div>                
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('common.remarks') }}</label>
                    <div class="col-md-6">
                        <textarea rows="3" class="form-control"name="partners_personal_history[licensure-remarks][]" id="partners_personal_history-licensure-remarks" ><?php echo (isset($licensure['licensure-remarks']) ? $licensure['licensure-remarks'] : ""); ?></textarea>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="control-label col-md-3">Supporting Documents</label>
                    <div class="col-md-6">                          
                        <div data-provides="fileupload" class="fileupload fileupload-new" id="users_profile-photo-container"> -->
                                    <!-- @if( !empty($record['users_profile.photo']) ) -->
                                        <?php 
                                            // $file = FCPATH . urldecode( $record['users_profile.photo'] );
                                            // if( file_exists( $file ) )
                                            // {
                                            //     $f_info = get_file_info( $file );
                                            // }
                                        ?>
                                        <!-- @endif -->
                            <!-- <input type="hidden" name="users_profile[photo]" id="users_profile-photo" value=""/>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="uneditable-input">
                                        <i class="fa fa-file fileupload-exists"></i> 
                                        <span class="fileupload-preview"> -->
                                            <!-- @if( isset($f_info['name'] ) ) {{ basename($f_info['name']) }} @endif -->
                                        <!-- </span>
                                    </span>
                                </span>
                                <span class="btn default btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
                                    <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                    <input type="file" id="users_profile-photo-fileupload" type="file" name="files[]">
                                </span>
                                <a data-dismiss="fileupload" class="btn red fileupload-exists fileupload-delete"><i class="fa fa-trash-o"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="form-group">
                    <label class="control-label col-md-3">Attachment</label>
                    <div class="col-md-6">
                        <div data-provides="fileupload" class="fileupload fileupload-new" id="partners_personal_history-licensure-attach-container">
                        <input type="hidden" name="partners_personal_history[licensure-attach][]" id="partners_personal_history-licensure-attach" value="<?php echo (isset($licensure['licensure-attach']) ? $licensure['licensure-attach'] : ""); ?>"/>
                        <div class="input-group">
                            <span class="input-group-btn">
                            <span class="btn default btn-file">
                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                <input type="file" id="partners_personal_history-licensure-attach-fileupload" type="file" name="files[]">
                            </span>
                            <a data-dismiss="fileupload" class="btn red fileupload-exists fileupload-delete"><i class="fa fa-trash-o"></i> Remove</a>
                            
                            <ul class="padding-none margin-top-11">
                                <!-- <i class="fa fa-file fileupload-exists"></i>  -->
                                <span class="fileupload-preview">
                                    <!-- @if( isset($f_info['name'] ) ) {{ basename($f_info['name']) }} @endif -->

                                    <?php
                                    $attach_file = (isset($licensure['licensure-attach']) ? $licensure['licensure-attach'] : ""); 
                                    if (!empty($attach_file)){
                                        $file = FCPATH . urldecode( $attach_file );
                                        if( file_exists( $file ) )
                                        {
                                            $f_info = get_file_info( $file );
                                            $f_type = filetype( $file );

/*                                            $finfo = finfo_open(FILEINFO_MIME_TYPE);
                                            $f_type = finfo_file($finfo, $file);*/

                                            switch( $f_type )
                                            {
                                                case 'image/jpeg':
                                                $icon = 'fa-picture-o';
                                                break;
                                                case 'video/mp4':
                                                $icon = 'fa-film';
                                                break;
                                                case 'audio/mpeg':
                                                $icon = 'fa-volume-up';
                                                break;
                                                default:
                                                $icon = 'fa-file-text-o';
                                            }
                                            $filepath = base_url()."partners/download_file/".$details_data_id[1]['licensure-attach'];
                                            $file_view = base_url().$licensure['licensure-attach'];

                                            echo '<li class="padding-3" style="list-style:none;"><a href="'.$filepath.'">
                                            <span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
                                            <span>'. basename($f_info['name']) .'</span>
                                            </a>
                                            </li>';
                                        }
                                    }
                                    ?>
                                </span>
                            </ul>

                        </div>
                    </div>
                    </div>
                </div>

			</div>
		</div>
	</div>
</div>
<?php } ?>
</div>
<div class="form-actions fluid">
    <div class="row">
        <div class="col-md-12" align="center">
            <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )" ><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
            <button class="btn blue btn-sm form-undo" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>                               
            <a href="<?php echo $back_url;?>" class="btn default btn-sm">{{ lang('common.back_to_list') }}</a>
        </div>
    </div>
</div>