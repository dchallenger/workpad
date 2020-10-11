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
							<label class="control-label col-md-4">{{ lang('loan_application.loan_amount') }}<span class="required">* </span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="loan_application[loan_amount]" id="loan_application_loan_amount" value="{{ $record['partners_loan_application_omnibus.loan_amount'] }}" placeholder="" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>		
							</div>	
						</div>
						<div class="form-group">
							<label class="control-label col-md-4">{{ lang('loan_application.loan_purposes') }}<span class="required">* </span></label>
							<div class="col-md-6">							
								<textarea class="form-control" name="loan_application[loan_purposes]" id="loan_application_loan_purposes" placeholder="" rows="4">{{ $record['partners_loan_application_omnibus.loan_purposes'] }}</textarea> 				
							</div>	
						</div>
						<div class="form-group">
							<label class="control-label col-md-4">{{ lang('loan_application.terms') }}<span class="required">* </span></label>
							<div class="col-md-6">
								<?php
									$terms_options = array();
									for ($i=1; $i < 13; $i++) { 
										$terms_options[$i] = $i;
									}
								?>							
								<div class="input-group">
									<!-- <input type="hidden" size="16" class="form-control" readonly id="loan_application_mobile_enrollment_type_id" name="loan_application_mobile_enrollment_type_id" value="">  -->
									<span class="input-group-addon">
										<i class="fa fa-list-ul"></i>
									</span>
									{{ form_dropdown('loan_application[loan_terms]',$terms_options, $record['partners_loan_application_omnibus.loan_terms'],'id="loan_application_mobile_enrollment_type_id" class="form-control select2me" data-placeholder="Select..."') }}
								</div> 									
							</div>	
						</div>
						<div class="form-group hidden">
							<label class="control-label col-md-4">{{ lang('loan_application.amortization_amount') }}<span class="required">* </span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="loan_application[loan_start_amortization]" id="loan_application_loan_start_amortization" value="{{ $record['partners_loan_application_omnibus.loan_start_amortization'] }}" placeholder="" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>		
							</div>	
						</div>	
						<div class="form-group hidden">
							<label class="control-label col-md-4">{{ lang('loan_application.deduction_start') }}<span class="required">* </span></label>
							<div class="col-md-6">							
								<div class="input-group date date-picker" data-date-format="MM dd, yyyy">                                       
										<input type="text" size="16" class="form-control" name="loan_application[loan_deduction_start]" id="loan_application_loan_deduction_start" value="{{ $record['partners_loan_application_omnibus.loan_deduction_start'] }}" />
										<span class="input-group-btn">
											<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
										</span>
								</div> 				
							</div>	
						</div>
						<div class="form-group hidden">
							<label class="control-label col-md-4">{{ lang('loan_application.deduction_end') }}<span class="required">* </span></label>
							<div class="col-md-6">							
								<div class="input-group date date-picker" data-date-format="MM dd, yyyy">                                       
										<input type="text" size="16" class="form-control" name="loan_application[loan_deduction_end]" id="loan_application_loan_deduction_end" value="{{ $record['partners_loan_application_omnibus.loan_deduction_end'] }}" />
										<span class="input-group-btn">
											<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
										</span>
								</div> 				
							</div>	
						</div>
						<div class="form-group hidden">
							<label class="control-label col-md-4">{{ lang('loan_application.amount_to_deduct') }}<span class="required">* </span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="loan_application[loan_amount_to_deduct]" id="loan_application_loan_amount_to_deduct" value="{{ $record['partners_loan_application_omnibus.loan_amount_to_deduct'] }}" placeholder="" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>		
							</div>	
						</div>
						<div class="form-group hidden">
							<label class="control-label col-md-4">{{ lang('loan_application.amount_to_deduct_per_day') }}<span class="required">* </span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="loan_application[loan_amount_to_deduct_per_day]" id="loan_application_loan_amount_to_deduct_per_day" value="{{ $record['partners_loan_application_omnibus.loan_amount_to_deduct_per_day'] }}" placeholder="" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>		
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
								} elseif ($loan_application_status_id['val'] < 3 ){ 
						?>
									<!-- <button type="button" class="btn green btn-sm" onclick="save_form( $(this).parents('form'), 2 )">{{ lang('loan_application.submit') }}</button> -->
									<!-- <button type="button" class="btn red btn-sm" onclick="save_form( $(this).parents('form'), 8 )">{{ lang('loan_application.cancel_app') }}</button>	 -->
							<?php 
								} elseif (in_array($loan_application_status_id['val'], array(2,3,6)) && $within_cutoff){
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
