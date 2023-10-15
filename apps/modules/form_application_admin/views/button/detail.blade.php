<div class="form-actions fluid" align="center">
    <div class="row">
        <div class="col-md-12">
            <div>
            	<?php if( $form_approver_details['approver_status_id'] < 6){ ?>
            		<a href="#" class="approve_view btn btn-default btn-sm btn-success" data-forms-id="{{ $form_approver_details['forms_id'] }}" data-form-owner="{{ $form_approver_details['user_id'] }}" data-user-name="" data-user-id="{{ $form_approver_details['approver_id'] }}" data-decission="6" >{{ lang('form_application_admin.approved') }}</a>
            		<?php if($form_approver_details['within_cutoff']){ ?>
            			<a href="#" class="disapprove_view btn btn-sm btn-danger" data-forms-id="{{ $form_approver_details['forms_id'] }}" data-form-owner="{{ $form_approver_details['user_id'] }}" data-user-name="" data-user-id="{{ $form_approver_details['approver_id'] }}" data-decission="7" >{{ lang('form_application_admin.disapproved') }}</a>
            	<?php } }
            		else if ($form_approver_details['approver_status_id'] == 6 ){
            			if($form_approver_details['within_cutoff']){
            		 ?>

            		<a href="#" class="disapprove_view btn btn-sm btn-danger" data-forms-id="{{ $form_approver_details['forms_id'] }}" data-form-owner="{{ $form_approver_details['user_id'] }}" data-user-name="" data-user-id="{{ $form_approver_details['approver_id'] }}" data-decission="8" >{{ lang('form_application_admin.cancel') }}</a>

            	<?php
            			}
            		}
            	?>
            	<a href="{{ $mod->url }}" class="btn btn-default btn-sm">{{ lang('common.back_to_list') }}</a>
            </div>
        </div>
    </div>
</div>