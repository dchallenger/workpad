<div>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('form_application_manage.date_filed') }}:</label>
        <div class='col-md-9'>
            <span><?php echo general_date_time($created_on) ?></span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('form_application_manage.date') }}:</label>
        <div class='col-md-9'>
            <span><?php echo general_date($date_from); ?></span>
        </div>
    </div>    
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('form_application_manage.time') }}:</label>
        <div class='col-md-9'>
            <span> <?php echo general_date_time($time_from); ?></span>
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

    <br>
    <div class='clearfix margin-top-10'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('form_application_manage.remarks') }} ({{ lang('form_application_manage.required_decline') }}):<span class='required'>*</span></label>
        <div class='col-md-9'>
            <textarea rows='4' id='comment-<?php echo $forms_id; ?>' class='form-control'></textarea>
        </div>
    </div>
    <hr class='margin-top-10 margin-bottom-10'>
    <div class='clearfix padding-left-right-10'>
        <a href='#' class='approve-pop small text-success margin-right-10 margin-left-10' data-forms-id='{{ $forms_id }}' data-form-owner='{{ $user_id }}' data-user-name='' data-decission='1'><i class='fa fa-check'></i> Approve</a>
        <a href='#' class='decline-pop small text-danger margin-right-10' data-forms-id='{{ $forms_id }}' data-form-owner='{{ $user_id }}' data-user-name='' data-decission='0'><i class='fa fa-pencil' ></i> Decline</a>
        <a href='#' class='close-pop small text-muted'><i class='fa fa-times'></i> Close</a>
    </div>
</div>