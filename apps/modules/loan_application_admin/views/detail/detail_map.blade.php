@extends('layouts/master')

@section('page_styles')
	@parent
@stop

@section('page-header')
	
	<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			{{ $mod->long_name }} <small>{{ $mod->description }}</small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li class="btn-group">
				<a href="{{ $mod->url }}"><button class="btn blue" type="button">
				<span>{{ lang('loan_application.back') }}</span>
				</button></a>
			</li>
			<li>
				<i class="fa fa-home"></i>
				<a href="{{ base_url('') }}">{{ lang('loan_application.home') }}</a> 
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<!-- jlm i class="fa {{ $mod->icon }}"></i -->
				<a href="{{ $mod->url }}">{{ $mod->long_name }}</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>{{ ucwords( $mod->method )}}</li> 
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>

@stop


@section('page_content')
	@parent

	<div class="row">
        <div class="col-md-9">
    		<input type="hidden" name="view" id="view" value="detail" >
			<div id="vl_container" class="portlet">
				<div class="portlet-title">
					<div class="caption">{{ $loan_type }} <small class="text-muted">{{ lang('loan_application.view') }}</small></div>
				</div>
                <div class="portlet-body form" id="main_form">
                    <!-- BEGIN FORM-->
                        <div class="form-body">
							<?php if( $record['partners_loan_application_status_id'] >= 6 ){ ?>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ $label_adc }} :</label>
										<div class="col-md-7 col-sm-7">
											<span><?php echo ($date_adc && $date_adc != '0000-00-00 00:00:00' && $date_adc != 'January 01, 1970' && $date_adc != '1970-01-01' ? date('F d, Y g:ia - D',strtotime($date_adc)) : "" ) ?></span>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>		                            	
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('loan_application.date_created') }} :</label>
										<div class="col-md-7 col-sm-7">
											<span><?php echo date('F d, Y - D',strtotime($record['partners_loan_application_created_on'])) ?></span>
										</div>
									</div>
								</div>
							</div>
                            <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('loan_application.type_enrollment') }} :</label>
										<div class="col-md-7 col-sm-7">
											<span>{{ $record['partners_loan_application_mobile_loan_application_mobile_enrollment_type'] }}</span>
										</div>
									</div>
								</div>
							</div>										
                            <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('loan_application.plan_limit') }} :</label>
										<div class="col-md-7 col-sm-7">
											<span>{{ $record['partners_loan_application_mobile_loan_application_mobile_plan_limit'] }}</span>
										</div>
									</div>
								</div>
							</div>	
                            <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('loan_application.special_features') }} :</label>
										<div class="col-md-7 col-sm-7">
											<span>{{ $record['partners_loan_application_mobile_loan_application_mobile_special_feature'] }}</span>
										</div>
									</div>
								</div>
							</div>
	                        <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 text-right text-muted">HR Remarks :</label>
										<div class="col-md-7 col-sm-7">
											<span>{{ ($record['partners_loan_comment'] == '') ? '' : $record['partners_loan_comment'] }}</span>
										</div>
									</div>
								</div>
							</div>							
							<?php if( count($remarks) > 0){
								?>

							<hr />
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
	                                    <label class="control-label col-md-4 col-sm-4 text-right text-muted">Approver Remarks :</label>
	                        <?php
				                    for($j=0; $j < count($remarks); $j++){
				                        if(isset($remarks[$j]['comment'])) {
				                        	if($j > 0){
	                        ?>
			                         <label class="control-label col-md-4 col-sm-4 text-right text-muted">&nbsp</label>
			                         <?php } ?>
		                         <div class="col-md-7 col-sm-7">
                                    <span style='display:block; word-wrap:break-word;'>
                                        <?php
                                            echo "<b>".$remarks[$j]['display_name']."</b>:";
                                        ?>
                                        <span class="text-right text-danger">
                                        <?php
                                            if( ($remarks[$j]['comment_date']) && ($remarks[$j]['comment_date']) <> '0000-00-00 00:00:00' )
                                            	echo date("F d, Y - h:i a", strtotime($remarks[$j]['comment_date']));
                                        ?>
                                    	</span>
                                    </span>
                                    <div style='display:block; word-wrap:break-word;'>
                                        <?php
                                            echo ($remarks[$j]['comment']=="") ? "&nbsp;" : $remarks[$j]['comment'];
                                        ?>
                                    </div>
								 </div>

							<?php 		}
									}
									?>

	                                </div>
								</div>
							</div>
							<?php } ?>
							
							<?php if($loan_application_status_id['val'] == 7 || $loan_application_status_id['val'] == 8){
								?>
							<hr />
                            <?php 
								foreach ($disapproved_cancelled_remarks as $key => $value) :
									$dis_cancel_by = '';
									$title = '';
									if ($loan_application_status_id['val'] == 7){
										$title = lang('form_application.disaproved');
										$dis_cancel_by = $value['approver_name'];
									}
									elseif ($loan_application_status_id['val'] == 8){
										$title = lang('form_application.cancel_by');
										$dis_cancel_by = $value['employee_name'];
									}											
							?>
                            <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ $loan_type }} :</label>
										<div class="col-md-7 col-sm-7">
											<span>{{ $dis_cancel_by }}</span>
											<br />
											<?php 
											$date = date("F d, Y H:i:s", strtotime($value['date']));
										    if(date("H:i:s", strtotime($date)) == "00:00:00"){
										       $comment_date = 'on '.date("F d, Y", strtotime($date));
										    }else{
										    	if($value['date'] == '0000-00-00 00:00:00'){
										    		$comment_date = '';
										    	} else {
										    		$comment_date = 'on '.date("F d, Y g:ia", strtotime($date));
										    	}
										    } 
											?>
											<span class="help-block small">{{ $value['loan_application_status'] }} {{ $comment_date }}</span>
										</div>
									</div>
								</div>
							</div>
							<div class="row hidden">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ $value['loan_application_status'] }}date :</label>
										<div class="col-md-7 col-sm-7">
											<span>{{ date('F d, Y g:ia', strtotime($value['date'])) }}</span>
										</div>
									</div>
								</div>
							</div>
                            <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 text-right text-muted">&nbsp;</label>
										<div class="col-md-7 col-sm-7">
											<span>{{ ($value['comment'] == '') ? '' : $value['comment'] }}</span>
										</div>
									</div>
								</div>
							</div>
							<?php
								endforeach;
							}
							?>

							<hr />

	                  	 	<?php if( isset($loan_application_approver_details['approver_status_id']) && $loan_application_approver_details['approver_status_id'] < 8 && in_array($loan_application_approver_details['loan_application_status_id'], array(2,4,5,6))){ ?>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
		                                    <label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('loan_application.remarks') }}<span class="required">* </span></label>
		                                    <div class="col-md-5 col-sm-6">
		                                        <textarea id="comment-{{ $loan_application_approver_details['loan_application_id'] }}" class="form-control" rows="3"></textarea>
		                                        <label class="control-label col-md-10 text-muted small"> {{ lang('loan_application.required_disapp') }}</label>
		                                    </div>
		                                </div>
									</div>
								</div>

							<?php } ?>								
                        </div>
                        <div class="form-actions fluid" align="center">
                            <div class="row">
                                <div class="col-md-12">
	                                <div>
	                                	<?php if( isset($loan_application_approver_details['approver_status_id']) && $loan_application_approver_details['approver_status_id'] < 6 && in_array($loan_application_approver_details['loan_application_status_id'], array(2,4,5)) && $record['partners_loan_application_status_id'] != 8 && $record['partners_loan_application_status_id'] != 6){ ?>
	                                		<a href="#" class="approve_view btn btn-default btn-sm btn-success" data-loan-type="{{ $loan_application_approver_details['loan_type'] }}" data-loan-application-id="{{ $loan_application_approver_details['loan_application_id'] }}" data-loan-application-owner="{{ $loan_application_approver_details['user_id'] }}" data-user-name="" data-user-id="{{ $loan_application_approver_details['approver_id'] }}" data-decission="1" >{{ lang('loan_application.approved') }}</a>
	                                		<a href="#" class="disapprove_view btn btn-sm btn-danger" data-loan-type="{{ $loan_application_approver_details['loan_type'] }}" data-loan-application-id="{{ $loan_application_approver_details['loan_application_id'] }}" data-loan-application-owner="{{ $loan_application_approver_details['user_id'] }}" data-user-name="" data-user-id="{{ $loan_application_approver_details['approver_id'] }}" data-decission="0" >{{ lang('loan_application.decline') }}</a>
	                                	<?php }
	                                		else if (isset($loan_application_approver_details['approver_status_id']) && $loan_application_approver_details['approver_status_id'] == 6 ){
	                                	?>
	                                		<a href="#" class="disapprove_view btn btn-sm btn-danger" data-loan-type="{{ $loan_application_approver_details['loan_type'] }}" data-loan-application-id="{{ $loan_application_approver_details['loan_application_id'] }}" data-loan-application-owner="{{ $loan_application_approver_details['user_id'] }}" data-user-name="" data-user-id="{{ $loan_application_approver_details['approver_id'] }}" data-decission="0" >{{ lang('loan_application.disapproved') }}</a>

	                                	<?php
	                                		}
	                                	?>
	                                	<a href="{{ $mod->url }}" class="btn btn-default btn-sm">{{ lang('loan_application.back_tolist') }}</a>
	                                </div>                                	
                                </div>
                            </div>
                        </div>
                    <!-- END FORM--> 
                </div>
           	</div>
       	</div>  
    	<div class="col-md-3 visible-lg visible-md">
			<div class="portlet">
				<div class="portlet-body">
					<div class="clearfix">
						<div class="panel panel-success">
							<div class="panel-heading">
								<h4 class="panel-title"><?php echo $approver_title; ?></h4>
							</div>

							<ul class="list-group">
								<?php foreach($approver_list as $index => $value){ ?>
									<li class="list-group-item"><?=$value['lastname'].', '.$value['firstname']?>
										<br><small class="text-muted"><?=$value['position']?></small>
									<?php if($loan_application_status_id['val'] >= 2){ 
								            $form_style = 'info';
								            switch($value['loan_application_status_id']){
								                case 8:
								                    $form_style = 'default';
								                break;
								                case 7:
								                    $form_style = 'danger';
								                break;
								                case 6:
								                    $form_style = 'success';
								                break;
								                case 5:
								                case 4:
								                case 3:
								                case 2:
								                    $form_style = 'warning';
								                break;
								                case 1:
								                    $form_style = 'info';
								                break;
								            }
								        ?>
									<br><p><span class="badge badge-<?php echo $form_style ?>"><?=$value['loan_application_status']?></span></p> </li>
								<?php }
								} ?>
							</ul>
						</div>
					</div> 
					
				</div>
			</div>
		</div>			
	</div>
@stop

@section('page_plugins')
	@parent
@stop

@section('page_scripts')
	@parent
@stop

@section('view_js')
	@parent
@stop


