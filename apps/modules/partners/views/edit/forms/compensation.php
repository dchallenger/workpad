<?php
$db->select('compensation_id,compensation');
$db->where('deleted', '0');
$db->order_by('compensation');
$options = $db->get('users_compensation');

$partners_compensation_options = array('' => '');
foreach($options->result() as $option)
{
    $partners_compensation_options[$option->compensation_id] = $option->compensation;
}

?>
<div class="portlet">
	<div class="portlet-title">
		<!-- <div class="caption" id="education-category">Company Name</div> -->
		<div class="tools">
            <a class="text-muted" id="delete_compensation_tab-<?php echo $count;?>" onclick="remove_form(this.id, 'compensation_tab', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a>
			<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
		</div>
	</div>
	<div class="portlet-body form">
        <div class="form-horizontal">
            <div class="form-body">
		<!-- START FORM -->
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.category') ?><span class="required">*</span></label>
                    <div class="col-md-6">                      
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-list-ul"></i>
                            </span>
                            <select  class="form-control form-select" data-placeholder="Select..." name="partners_personal_history[compensation-category][]" id="partners_personal_history-compensation">
                                <option value=""></option>
                            <?php
                                foreach($options->result() as $option) {
                            ?>
                                    <option value="<?php echo $option->compensation_id ?>"><?php echo $option->compensation ?></option>
                            <?php
                                }
                            ?>                                
                            </select>                               
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.compensation_amount') ?><span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[compensation-amount][]" id="partners_personal_history-compensation-amount" 
                        value="" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.compensation_amount') ?>" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.start_date') ?><span class="required">*</span></label>
                    <div class="col-md-5">
                        <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
                            <input type="text" class="form-control" name="partners_personal_history[compensation-start-date][]" id="partners-compensation-start-date" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.start_date') ?>">
                            <span class="input-group-btn">
                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.end_date') ?><span class="required">*</span></label>
                    <div class="col-md-5">
                        <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
                            <input type="text" class="form-control" name="partners_personal_history[compensation-end-date][]" id="partners-compensation-end_date" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.end_date') ?>">
                            <span class="input-group-btn">
                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                </div>                      
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.compensation_guaranteed_months') ?></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control text-right" name="partners_personal_history[compensation-guaranteed-months][]" id="partners_personal_history-compensation-guaranteed-months" 
                        value="" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.compensation_guaranteed_months') ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.compensation_guaranteed_annual') ?></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[compensation-guaranteed-annual][]" id="partners_personal_history-compensation-guaranteed-annual" 
                        value="" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.compensation_guaranteed_annual') ?>" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<script language="javascript">
jQuery(document).ready(function() { 
    $('select.form-select').select2({
        placeholder: "Select an option",
        allowClear: true        
    });  
    
    customHandleUniform();
});
</script>
