@extends('layouts/master')

@section('page_styles')
	@parent
	@include('edit/page_styles')
	<link type="text/css" rel="stylesheet" href="{{ theme_path() }}plugins/bootstrap-timepicker/compiled/timepicker.css">
	<link href="{{ theme_path() }}plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css" type="text/css" rel="stylesheet">
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
				<a href="{{ $back_url }}"><button class="btn blue" type="button">
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
			<form class="form-horizontal" action="<?php echo $url?>/save_form" id="edit-loan-application">
				<input type="hidden" id="record_id" name="record_id" value="{{ $record_id }}">
				<input type="hidden" id="loan_type_id" name="loan_type_id" value="{{ $loan_type_id }}">
				<input type="hidden" name="loan_type" id="loan_type" value="{{ $loan_type }}">
				<input type="hidden" name="loan_type_code" id="loan_type_code" value="{{ $loan_type_code }}">
				<input type="hidden" name="view" id="view" value="edit" >

				
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">{{ $loan_type }}</div>
						<div class="tools"><a class="collapse" href="javascript:;"></a></div>
					</div>
					<div class="portlet-body form">						
						<div class="form-group">
							<label class="control-label col-md-4">{{ lang('loan_application.type_enrollment') }}<span class="required">* </span></label>
							<div class="col-md-6">
								<?php	                        

								$enrollment_type_options = array();

								foreach($enrollment_type as $index => $value){
									$enrollment_type_options[$value['loan_application_mobile_enrollment_type_id']] = $value['loan_application_mobile_enrollment_type'];
								}

								?>							
								<div class="input-group">
									<!-- <input type="hidden" size="16" class="form-control" readonly id="loan_application_mobile_enrollment_type_id" name="loan_application_mobile_enrollment_type_id" value="">  -->
									<span class="input-group-addon">
										<i class="fa fa-list-ul"></i>
									</span>
									{{ form_dropdown('loan_application[loan_application_mobile_enrollment_type_id]',$enrollment_type_options, $loan_application_mobile_enrollment_type_id['val'],'id="loan_application_mobile_enrollment_type_id" class="form-control select2me" data-placeholder="Select..."') }}
								</div> 				
							</div>	
						</div>
						<div class="form-group">
							<label class="control-label col-md-4">{{ lang('loan_application.plan_limit') }}<span class="required">* </span></label>
							<div class="col-md-6">
								<?php	                        

								$plan_limit_options = array();

								foreach($plan_limit as $index => $value){
									$plan_limit_options[$value['loan_application_mobile_plan_limit_id']] = $value['loan_application_mobile_plan_limit'];
								}

								?>							
								<div class="input-group">
									<!-- <input type="hidden" size="16" class="form-control" readonly id="loan_application_mobile_plan_limit_id" name="loan_application_mobile_plan_limit_id" value="">  -->
									<span class="input-group-addon">
										<i class="fa fa-list-ul"></i>
									</span>
									{{ form_dropdown('loan_application[loan_application_mobile_plan_limit_id]',$plan_limit_options, $loan_application_mobile_plan_limit_id['val'],'id="loan_application_mobile_plan_limit_id" class="form-control select2me" data-placeholder="Select..."') }}
								</div> 				
							</div>	
						</div>
						<div class="form-group">
							<label class="control-label col-md-4">{{ lang('loan_application.special_features') }}<span class="required">* </span></label>
							<div class="col-md-6">
								<?php	                        

								$special_features_options = array();

								foreach($special_features as $index => $value){
									$special_features_options[$value['loan_application_mobile_special_feature_id']] = $value['loan_application_mobile_special_feature'];
								}

								?>							
								<div class="input-group">
									<!-- <input type="hidden" size="16" class="form-control" readonly id="loan_application_mobile_special_feature_id" name="loan_application_mobile_special_feature_id" value="">  -->
									<span class="input-group-addon">
										<i class="fa fa-list-ul"></i>
									</span>
									{{ form_dropdown('loan_application[loan_application_mobile_special_feature_id]',$special_features_options, $loan_application_mobile_special_feature_id['val'],'id="loan_application_mobile_special_feature_id" class="form-control select2me" data-placeholder="Select..."') }}
								</div> 				
							</div>	
						</div>
						<div class="form-group">
							<label class="control-label col-md-4">{{ lang('loan_application.reason') }}</label>
							<div class="col-md-6">							
								<textarea class="form-control" name="loan_application[remarks]" id="loan_application_remarks" placeholder="" rows="4">{{ $record['partners_loan_application_mobile.remarks'] }}</textarea>
							</div>	
						</div>
					</div>
				</div>

				<div class="form-actions fluid" align="center">
				  <div class="row">
				    <div class="col-md-12">
				      <div>
						<?php 
							if( $loan_application_status_id['val'] < 7 || empty($loan_application_status_id['val']) ){ 
								if($loan_application_status_id['val'] == 1 || empty($loan_application_status_id['val'])){ ?>
									<button type="button" class="btn blue btn-sm" onclick="save_form( $(this).parents('form'), 1 )">{{ lang('loan_application.save_draft') }}</button>
									<button type="button" class="btn green btn-sm" onclick="save_form( $(this).parents('form'), 4 )">{{ lang('loan_application.submit') }}</button>
						<?php 	
								}elseif($loan_application_status_id['val'] < 3 ){ 
						?>
									<!-- <button type="button" class="btn green btn-sm" onclick="save_form( $(this).parents('form'), 2 )">{{ lang('loan_application.submit') }}</button> -->
									<!-- <button type="button" class="btn red btn-sm" onclick="save_form( $(this).parents('form'), 8 )">{{ lang('loan_application.cancel_app') }}</button> -->	
							<?php 
								}elseif(in_array($loan_application_status_id['val'], array(2,3,6)) && $within_cutoff){
						?>
									<!-- <button type="button" class="btn red btn-sm" onclick="save_form( $(this).parents('form'), 8 )">{{ lang('loan_application.cancel_app') }}</button>	 -->
						<?php 
								} 
							}
						?>
				        <a href="<?php echo $back_url;?>" class="btn default btn-sm">{{ lang('loan_application.back') }}</a>
				      </div>
				    </div>
				  </div>
				</div>
			</form>
       	</div>  
    	<div class="col-md-3 visible-lg visible-md">
			<div class="portlet">
				<div class="portlet-body">
					<div class="clearfix">
						<div class="panel panel-success">
							<div class="panel-heading">
								<h4 class="panel-title">{{ lang('loan_application.approvers') }}</h4>
							</div>

							<ul class="list-group">
								<?php foreach($approver_list as $index => $value){ ?>
									<li class="list-group-item"><?=$value['lastname'].', '.$value['firstname']?><br><small class="text-muted"><?=$value['position']?></small> </li>
								<?php } ?>
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
	@include('edit/page_plugins')
@stop

@section('page_scripts')
	@parent
	<script src="{{ theme_path() }}scripts/form-components.js"></script> 
	<script type="text/javascript" src="{{ theme_path() }}modules/common/edit.js"></script> 
	<script type="text/javascript" src="{{ theme_path() }}plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
@stop

@section('view_js')
	@parent
	<script>
	$(document).ready(function(){
	

	});

	</script>
	{{ get_edit_js( $mod ) }}
@stop
