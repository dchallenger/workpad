<div>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted small'>{{ lang('form_application_manage.date_filed') }}</label>
        <div class='col-md-9'>
            <span class=""><?php echo general_date_time($created_on) ?></span>
        </div>
    </div>     
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('form_application_manage.from') }}:</label>
        <div class='col-md-9'>
            <span> <?php echo general_date_time($time_from); ?></span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('form_application_manage.to') }}:</label>
        <div class='col-md-9'>
            <span> <?php echo general_date_time($time_to); ?></span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('form_application_manage.location') }}:</label>
        <div class='col-md-9'>
            <span> <?php echo $location; ?></span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('form_application_manage.reason') }}:</label>
        <div class='col-md-9'>
            <span><?php echo $reason; ?></span>
        </div>
    </div>

    <?php if(count($remarks)): 
    ?>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('form_application_manage.recent_note') }}:</label>
        <?php
        for($j=0; $j < count($remarks); $j++):
            if(isset($remarks[$j]['comment'])): ?>
        <div class='col-md-9'>
            <span style='display:block; word-wrap:break-word;'>
                <?php
                echo "<b>".$remarks[$j]['display_name']."</b>:";
                ?>
            </span>
            <span style='display:block; word-wrap:break-word;'>
                <?php
                echo $remarks[$j]['comment'];
                ?>
            </span>
        </div>
        <?php       endif;
        endfor;
        ?>

    </div>
    <?php
    endif; ?>
    <div class='clearfix margin-top-10'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('form_application_manage.remarks') }}:<span class='required'>*</span></label>
        <div class='col-md-9'>
            <textarea rows='2' id='comment-<?php echo $forms_id; ?>' class='form-control'></textarea>
        </div>
        <label class="col-md-3"></label>
        <div class='col-md-9'>
            <span class="text-muted small"><?php echo lang('form_application_manage.required_decline') ?> </span>
        </div>          
    </div>
    <hr class='margin-top-10 margin-bottom-10'>
    <div>
        <button type='button' class='btn btn-success btn-xs approve-pop small text-success margin-right-10 margin-left-10' data-forms-id='{{ $forms_id }}' data-form-owner='{{ $user_id }}' data-user-name='' data-user-id='{{ $approver_id }}' data-decission='6'><i class='fa fa-check'></i> {{ lang('form_application_manage.approve') }}</button>
        <button type='button' class='btn btn-danger btn-xs decline-pop small text-danger margin-right-10' data-forms-id='{{ $forms_id }}' data-form-owner='{{ $user_id }}' data-user-name='' data-user-id='{{ $approver_id }}' data-decission='7'><i class='fa fa-pencil' ></i> {{ lang('form_application_manage.disapproved') }}</button>
        <button type='button' class='btn btn-default btn-xs close-pop small text-muted pull-right'><i class='fa fa-times'></i> {{ lang('form_application_manage.close') }}</button>
    </div>
</div>