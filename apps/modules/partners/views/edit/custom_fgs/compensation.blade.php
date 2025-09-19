<div class="portlet">
    <div class="portlet-title">
        <div class="caption" id="education-category">{{ lang('partners.compensation') }}</div>
        <div class="actions">
            <a class="btn btn-default" onclick="add_form('compensation', 'compensation')">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
</div>

<!-- Previous Trainings : start doing the loop-->
<div id="personal_compensation">
    <?php $compensation_count = count($compensation_tab); ?>
    <input type="hidden" name="compensation_count" id="compensation_count" value="{{ $compensation_count }}" />
    <?php 
    $count_compensation = 0;
    foreach($compensation_tab as $index => $compensation){ 
        $count_compensation++;
?>
<div class="portlet">
    <div class="portlet-title">
        <!-- <div class="caption" id="education-category">Company Name</div> -->
        <div class="tools">
            <a class="text-muted" id="delete_compensation_tab-<?php echo $count_compensation;?>" onclick="remove_form(this.id, 'compensation_tab', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a>
            <!-- <a class="collapse pull-right" href="javascript:;"></a> -->
        </div>
    </div>
    <div class="portlet-body form">
        <div class="form-horizontal">
            <div class="form-body">
        <!-- START FORM -->
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.category') }}<span class="required">*</span></label>
                    <div class="col-md-6">
                        <?php   $db->select('compensation_id,compensation');
                                $db->where('deleted', '0');
                                $db->order_by('compensation');
                                $options = $db->get('users_compensation');

                                $partners_compensation_options = array('' => '');
                                foreach($options->result() as $option)
                                {
                                    $partners_compensation_options[$option->compensation_id] = $option->compensation;
                                } ?>                        
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-list-ul"></i>
                             </span>
                        {{ form_dropdown('partners_personal_history[compensation-category][]',$partners_compensation_options, $compensation['compensation-category'], 'class="form-control select2me" data-placeholder="Select..."') }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.compensation_amount') ?><span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[compensation-amount][]" id="partners_personal_history-compensation-amount" 
                        value="<?php echo (isset($compensation['compensation-amount']) ? $compensation['compensation-amount'] : ""); ?>" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.compensation_amount') ?>" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.start_date') ?><span class="required">*</span></label>
                    <div class="col-md-5">
                        <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
                            <input type="text" class="form-control" name="partners_personal_history[compensation-start-date][]" id="partners-compensation-start-date" value="{{(isset($compensation['compensation-start-date']) ? $compensation['compensation-start-date'] : "")}}" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.start_date') ?>">
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
                            <input type="text" class="form-control" name="partners_personal_history[compensation-end-date][]" id="partners-compensation-end_date" value="{{(isset($compensation['compensation-end-date']) ? $compensation['compensation-end-date'] : "")}}"placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.end_date') ?>">
                            <span class="input-group-btn">
                            <button class="btn default" type="button"><i clas ="fa fa-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                </div>                      
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.compensation_guaranteed_months') ?></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[compensation-guaranteed-months][]" id="partners_personal_history-compensation-guaranteed-months" 
                        value="{{(isset($compensation['compensation-guaranteed-months']) ? $compensation['compensation-guaranteed-months'] : "")}}" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.compensation_guaranteed_months') ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.compensation_guaranteed_annual') ?></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[compensation-guaranteed-annual][]" id="partners_personal_history-compensation-guaranteed-annual" 
                        value="{{(isset($compensation['compensation-guaranteed-annual']) ? $compensation['compensation-guaranteed-annual'] : "")}}" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.compensation_guaranteed_annual') ?>" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
</div>
<div class="form-actions fluid">
    <div class="row" align="center">
        <div class="col-md-12">
            <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )" ><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
            <button class="btn blue btn-sm form-undo" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>                               
            <a href="<?php echo $back_url;?>" class="btn default btn-sm">{{ lang('common.back_to_list') }}</a>
        </div>
    </div>
</div>
