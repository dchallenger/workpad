<?php $editable = true?>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption" id="education-category">{{ lang('my201.licensure') }}</div>
        @if(in_array('licensure-number', $partners_keys))
            @if($is_editable['licensure-number'])
            <?php $editable = true?>
            		<div class="actions">
                        <a class="btn btn-default" onclick="add_form('licensure_examination', 'licensure')">
                            <i class="fa fa-plus"></i>
                        </a>
            		</div>
            	
            @endif
        @endif
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
    @if($editable)
    	<div class="portlet-title">
    		
        		<div class="tools">
                    <a class="text-muted" id="delete_licensure-<?php echo $count_licensure;?>" onclick="remove_form(this.id, 'licensure', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a>
        		</div>
           
    	</div>
    @endif
	<div class="portlet-body form">
        <div class="form-horizontal">
            <div class="form-body">
		<!-- START FORM -->	    
                @if(in_array('licensure-title', $partners_keys))            
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('my201.title') }}<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" {{ ($is_editable['licensure-title'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal_history[licensure-title][]" id="partners_personal_history-licensure-title" 
                        value="<?php echo (isset($licensure['licensure-title']) ? $licensure['licensure-title'] : ""); ?>" placeholder="Enter Title"/>
                    </div>
                </div>
                @endif
                @if(in_array('licensure-number', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.license_no') }}</label>
                    <div class="col-md-6">
                        <input type="text" {{ ($is_editable['licensure-number'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal_history[licensure-number][]" id="partners_personal_history-licensure-number" 
                        value="<?php echo (isset($licensure['licensure-number']) ? $licensure['licensure-number'] : ""); ?>" placeholder="Enter License Number"/>
                    </div>
                </div>
                @endif
                @if(in_array('licensure-year-taken', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.date_taken') }}</label>
                        <div class="col-md-9">
                            <div class="input-group input-medium pull-left">
                                <?php $licensure_month_taken = (isset($licensure['licensure-month-taken']) ? $licensure['licensure-month-taken'] : ""); 
                                     $disabled = ($is_editable['licensure-remarks'] == 1) ? '' : 'disabled';
                                ?>
                        {{ form_dropdown('partners_personal_history[licensure-month-taken][]',$months_options, $licensure_month_taken, 'class="form-control select2me" '.$disabled.' data-placeholder="Select..."') }}
                            </div>
                            <span class="pull-left padding-left-right-10">-</span>
                            <span class="pull-left">
                                <input type="text" {{ ($is_editable['licensure-year-taken'] == 1) ? '' : 'readonly="readonly"' }} class="form-control input-small" maxlength="4" name="partners_personal_history[licensure-year-taken][]" id="partners_personal_history-licensure-year-taken" 
                            value="<?php echo (isset($licensure['licensure-year-taken']) ? $licensure['licensure-year-taken'] : ""); ?>"placeholder="Year">
                            </span>                            
                        </div>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.validity_until') }}</label>
                        <div class="col-md-9">
                            <div class="input-group input-medium pull-left">
                                <?php $disabled = ($is_editable['licensure-year-taken'] == 1) ? '' : 'disabled'; ?>
                                <?php $licensure_month_validity_until = (isset($licensure['licensure-month-validity-until']) ? $licensure['licensure-month-validity-until'] : ""); ?>
                        {{ form_dropdown('partners_personal_history[licensure-month-validity-until][]',$months_options, $licensure_month_validity_until, 'class="form-control select2me" '.$disabled.' data-placeholder="Select..."') }}
                            </div>
                            <span class="pull-left padding-left-right-10">-</span>
                            <span class="pull-left">
                                <input type="text" {{ ($is_editable['licensure-year-taken'] == 1) ? '' : 'readonly="readonly"' }} class="form-control input-small" maxlength="4" name="partners_personal_history[licensure-year-validity-until][]" id="partners_personal_history-licensure-year-validity-until" 
                            value="<?php echo (isset($licensure['licensure-year-validity-until']) ? $licensure['licensure-year-validity-until'] : ""); ?>"placeholder="Year" data-inputmask="'mask': '9999'">
                            </span>                            
                        </div>
                </div>                  
                @if(in_array('licensure-remarks', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('common.remarks') }}</label>
                    <div class="col-md-6">
                        <textarea rows="3" {{ ($is_editable['licensure-remarks'] == 1) ? '' : 'readonly="readonly"' }} class="form-control"name="partners_personal_history[licensure-remarks][]" id="partners_personal_history-licensure-remarks" ><?php echo (isset($licensure['licensure-remarks']) ? $licensure['licensure-remarks'] : ""); ?></textarea>
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <label class="control-label col-md-3">Attachment</label>
                    <div class="col-md-9">
                        <div class="fileupload fileupload-new" data-provides="fileupload" id="partners_personal_history-licensure-attachments-container">
                        <!-- <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"> -->
                            <?php 
                                $docs = (isset($licensure['licensure-attach']) ? $licensure['licensure-attach'] : "");
                                if(empty($docs)){
                                    $filename = '';
                                }else{
                                    $filename = urldecode(basename($docs));
                                }
                            ?>

                            <input type="hidden" name="partners_personal_history[licensure-attach][]" id="partners_personal_history-licensure-attachments" value="{{$docs}}">
                        <!-- </div> -->
                            <!-- <div class="fileupload-preview thumbnail " style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>                             -->
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="uneditable-input">
                                        <i class="fa fa-file fileupload-exists"></i> 
                                        <span class="fileupload-preview">{{$filename}}</span>
                                    </span>
                                </span>
                                @if($editable)
                                <div id="licensure-attachments-container">
                                    <span class="btn default btn-file add_file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" name="files[]" class="default file licensure_attach" id="partners_personal_history-licensure-attachments-fileupload" />
                                    </span>
                                    <a data-dismiss="fileupload" class="btn red fileupload-exists fileupload-delete"><i class="fa fa-trash-o"></i> Remove</a>
                                </div>
                                @endif
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
        <div class="col-md-12">
            <div class="col-md-offset-3 col-md-8">
                @if($editable)
                    <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )" ><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
                    <button class="btn blue btn-sm form-undo" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>                               
                @endif
            </div>
        </div>
    </div>
</div>