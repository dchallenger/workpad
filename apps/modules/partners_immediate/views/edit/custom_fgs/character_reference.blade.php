<div class="portlet">
	<div class="portlet-title">
		<div class="caption" id="education-category">{{ lang('partners_immediate.character_ref') }}</div>
		<div class="actions">
            <a class="btn btn-default" onclick="add_form('character_references', 'reference')">
                <i class="fa fa-plus"></i>
            </a>
		</div>
	</div>
</div>

<!-- Previous Character reference : start doing the loop-->
<div id="personal_reference">
    <?php $reference_count = count($reference_tab); ?>
    <input type="hidden" name="reference_count" id="reference_count" value="{{ $reference_count }}" />
    <?php 
    $count_reference = 0;
    foreach($reference_tab as $index => $reference){ 
        $count_reference++;
?>
<div class="portlet">
	<div class="portlet-title">
		<!-- <div class="caption" id="education-category">Company Name</div> -->
		<div class="tools">
			<a class="text-muted" id="delete_reference-<?php echo $count_reference;?>" onclick="remove_form(this.id, 'reference', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> {{ lang('common.delete') }}</a>
			<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
		</div>
	</div>
	<div class="portlet-body form">
        <div class="form-horizontal">
            <div class="form-body">
		<!-- START FORM -->	
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners_immediate.name') }}<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[reference-name][]" id="partners_personal_history-reference-name" 
                        value="<?php echo (isset($reference['reference-name']) ? $reference['reference-name'] : ""); ?>" placeholder="Enter Name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners_immediate.occupation') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[reference-occupation][]" id="partners_personal_history-reference-occupation" 
                        value="<?php echo (isset($reference['reference-occupation']) ? $reference['reference-occupation'] : ""); ?>" placeholder="Enter Occupation"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners_immediate.years_known') }}<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[reference-years-known][]" id="partners_personal_history-reference-years-known" 
                        value="<?php echo (isset($reference['reference-years-known']) ? $reference['reference-years-known'] : ""); ?>" placeholder="Enter Years Known"/>
                    </div>
                </div>
                <div class="form-group hidden-sm hidden-xs">
                    <label class="control-label col-md-3">{{ lang('partners_immediate.phone') }}</label>
                    <div class="col-md-6">
                         <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="text" class="form-control" name="partners_personal_history[reference-phone][]" id="partners_personal_history-reference-phone" 
                        value="<?php echo (isset($reference['reference-phone']) ? $reference['reference-phone'] : ""); ?>" placeholder="Enter Telephone Number"/>
                         </div>
                    </div>
                </div>
                <div class="form-group hidden-sm hidden-xs">
                    <label class="control-label col-md-3">{{ lang('partners_immediate.mobile') }}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                        <input type="text" class="form-control" name="partners_personal_history[reference-mobile][]" id="partners_personal_history-reference-mobile" 
                        value="<?php echo (isset($reference['reference-mobile']) ? $reference['reference-mobile'] : ""); ?>" placeholder="Enter Mobile Number"/>
                         </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners_immediate.address') }}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-map-marker"></i>
                             </span>
                        <input type="text" class="form-control" name="partners_personal_history[reference-address][]" id="partners_personal_history-reference-address" 
                        value="<?php echo (isset($reference['reference-address']) ? $reference['reference-address'] : ""); ?>" placeholder="Enter Address"/>
                         </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners_immediate.city') }}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-map-marker"></i>
                             </span>
                        <input type="text" class="form-control" name="partners_personal_history[reference-city][]" id="partners_personal_history-reference-city" 
                        value="<?php echo (isset($reference['reference-city']) ? $reference['reference-city'] : ""); ?>" placeholder="Enter City"/>
                         </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners_immediate.country') }}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-map-marker"></i>
                             </span>
                        <input type="text" class="form-control" name="partners_personal_history[reference-country][]" id="partners_personal_history-reference-country" 
                        value="<?php echo (isset($reference['reference-country']) ? $reference['reference-country'] : ""); ?>" placeholder="Enter Country"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners_immediate.zip') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[reference-zipcode][]" id="partners_personal_history-reference-zipcode" 
                        value="<?php echo (isset($reference['reference-zipcode']) ? $reference['reference-zipcode'] : ""); ?>" placeholder="Enter Zipcode"/>
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
                <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )" ><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
                <button class="btn blue btn-sm" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>                               
            </div>
        </div>
    </div>
</div>
