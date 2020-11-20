<div>
    <div class='clearfix'>
        <label class='control-label col-md-4 text-muted text-left small'>{{ lang('loan_application.entitlement') }}:</label>
        <div class='col-md-8'>
            <span> {{ $loan_application_car_entitlement }}</span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-4 text-muted text-left small'>{{ lang('loan_application.year_model') }}:</label>
        <div class='col-md-8'>
            <span> {{ $year_model }}</span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-4 text-muted text-left small'>{{ lang('loan_application.car_type') }}:</label>
        <div class='col-md-8'>
            <span> {{ $car_type }}</span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-4 text-muted text-left small'>{{ lang('loan_application.amount_loan') }}:</label>
        <div class='col-md-8'>
            <span> {{ currency_format($loan_amount) }}</span>
        </div>
    </div>
<!--     <div class='clearfix'>
        <label class='control-label col-md-4 text-muted text-left small'>{{ lang('loan_application.amortization') }}:</label>
        <div class='col-md-8'>
            <span> {{ $amortization }}</span>
        </div>
    </div>
 -->
    <?php if(count($remarks)): 
    ?>
    <div class='clearfix'>
        <label class='control-label col-md-4 text-muted text-left small'>{{ lang('loan_application.recent_note') }}:</label>
        <?php
        for($j=0; $j < count($remarks); $j++):
            if(isset($remarks[$j]['comment'])): ?>
                <div class='col-md-8'>
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
        <?php       
            endif;
        endfor;
        ?>

    </div>
    <?php
    endif; ?>

    <br>
    <div class='clearfix margin-top-10'>
        <label class='control-label col-md-4 text-muted text-left small'>{{ lang('loan_application.remarks') }}:<span class='required'>*</span></label>
        <div class='col-md-8'>
            <textarea rows='4' id='comment-<?php echo $loan_application_id; ?>' class='form-control'></textarea>
        </div>
        <label class="col-md-4"></label>
        <div class='col-md-8'>
            <span class="text-muted small"><?php echo lang('dashboard.required_decline') ?> </span>
        </div>        
    </div>
    <hr class='margin-top-10 margin-bottom-10'>
    <div>
        <button type='button' class='btn btn-success btn-xs approve-pop-loan small text-success margin-right-10 margin-left-10' data-loan-application-id='{{ $loan_application_id }}' data-loan-application-owner='{{ $user_id }}' data-user-name='' data-user-id='{{ $approver_id }}' data-decission='1'><i class='fa fa-thumbs-o-up'></i> {{ lang('loan_application.approve') }}</button>
        <button type='button' class='btn btn-danger btn-xs decline-pop-loan small text-danger margin-right-10' data-loan-application-id='{{ $loan_application_id }}' data-loan-application-owner='{{ $user_id }}' data-user-name='' data-user-id='{{ $approver_id }}' data-decission='0'><i class='fa fa-thumbs-o-down' ></i> {{ lang('loan_application.decline') }}</button>
        <button type='button' class='btn btn-default btn-xs close-pop small text-muted pull-right'><i class='fa fa-times'></i> {{ lang('loan_application.close') }}</button>
    </div>
</div>