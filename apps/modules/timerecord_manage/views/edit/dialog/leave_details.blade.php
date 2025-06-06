<div id="loader_form" class="text-center"><img src="{{ theme_path() }}img/ajax-loading.gif" alt="loading..." />{{ lang('timerecord.loading') }}...

<?php if($form_id == 1 || $form_id == 2): ?> 
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>&nbsp;</label>
        <div class='col-md-9'>
            <span>&nbsp;</span>
        </div>
    </div>
<?php endif; ?>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>&nbsp;</label>
        <div class='col-md-9'>
            <span>&nbsp;</span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>&nbsp;</label>
        <div class='col-md-9'>
            <span>&nbsp;</span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>&nbsp;</label>
        <div class='col-md-9'>
            <span>&nbsp;</span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>&nbsp;</label>
        <div class='col-md-9'>
            <span>&nbsp;</span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>&nbsp;</label>
        <div class='col-md-9'>
            <span style='display:block; word-wrap:break-word;'>&nbsp;
            </span>
            <span style='display:block; word-wrap:break-word;'>&nbsp;
            </span>
        </div>

    </div>

    <hr class='margin-top-10 margin-bottom-10'>
    <div class='clearfix padding-left-right-10' style="align:right;">
        <a style="cursor: pointer;"
            class='close-pop small text-muted'> &nbsp;</a>
    </div>
</div>
<div id="time_forms_info" class="hidden">
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('timerecord.employee') }}:</label>
        <div class='col-md-9'>
            <span> {{ $display_name }}</span>
        </div>
    </div>
<?php if($form_id == 1 || $form_id == 2): ?> 
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('timerecord.schedule') }}:</label>
        <div class='col-md-9'>
            <span> <?php echo $scheduled; ?></span>
        </div>
    </div>
<?php endif; ?>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('timerecord.from') }}:</label>
        <div class='col-md-9'>
            <span> <?php echo date("F d, Y", strtotime($date_from)); ?></span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('timerecord.to') }}:</label>
        <div class='col-md-9'>
            <span> <?php echo date("F d, Y", strtotime($date_to)); ?></span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('timerecord.day') }}:</label>
        <div class='col-md-9'>
            <span><?php echo $day; ?></span>
        </div>
    </div>
    <div class='clearfix'>
        <label class='control-label col-md-3 text-muted text-left small'>{{ lang('timerecord.reason') }}:</label>
        <div class='col-md-9'>
            <span><?php echo $reason; ?></span>
        </div>
    </div>

    <?php if(count($remarks)): 
    ?>
    <div class='clearfix'>
        <?php
        for($j=0; $j < count($remarks); $j++):
            if(isset($remarks[$j]['comment'])): ?>
        <label class='control-label col-md-3 text-muted text-left small'>
            <?php echo $j==0 ? "Approvers:" : ""; ?></label>
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

    <hr class='margin-top-10 margin-bottom-10'>
    <div class='clearfix padding-left-right-10' style="align:right;">
        <a style="cursor: pointer;"
            class='close-pop small text-muted'><i class='fa fa-times'></i> {{ lang('timerecord.close') }}</a>
    </div>
</div>