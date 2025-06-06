@extends('layouts/master')

@section('page_styles')
@parent
@include('edit/page_styles')
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
					<span>{{ lang('form_application.back') }}</span>
				</button></a>
			</li>
			<li>
				<i class="fa fa-home"></i>
				<a href="{{ base_url('') }}">{{ lang('form_application.home') }}</a> 
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
		<form class="form-horizontal" action="<?php echo $url?>/save_form">
			<input type="hidden" id="record_id" name="record_id" value="{{ $record_id }}">
			<input type="hidden" id="form_id" name="form_id" value="{{ $form_id }}">
			<input type="hidden" name="forms_title" id="forms_title" value="{{ $form_title }}">
			<input type="hidden" name="form_code" id="form_code" value="{{ $form_code }}">
			<input type="hidden" name="view" id="view" value="edit" >
			<div class="portlet">
				<div class="portlet-title">
					<div class="caption">{{ $form_title }}</div>
					<div class="tools"><a class="collapse" href="javascript:;"></a></div>
				</div>
				<div class="portlet-body form"  id="main_form">			
                    <div class="form-group">
						<label class="control-label col-md-4">{{ lang('form_application.delivery') }}<span class="required">* </span></label>
						<div class="col-md-6">
							<?php	                            	                            		
								$db->select('delivery_id,delivery');
                        		$db->where('deleted', '0');
                        		$db->where('maternity_paternity', '0');
                        		$options = $db->get('time_delivery');
								$time_delivery_delivery_id_options = array();
                        		foreach($options->result() as $option)
                        		{
                        			$time_delivery_delivery_id_options[$option->delivery_id] = $option->delivery;
                        		} 
                        	?>							
				            <div class="input-group">
								<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
				                    {{ form_dropdown('time_forms_maternity[delivery_id]',$time_delivery_delivery_id_options, $record['time_forms_maternity.delivery_id'], 'id="time_forms_paternity-delivery_id" class="form-control select2me" data-placeholder="Select..."') }}
				            </div> 				
			        	</div>	
					</div>
                    <div class="form-group">
						<label class="control-label col-md-4">{{ lang('form_application.type') }}<span class="required">* </span></label>
						<div class="col-md-6">
							<?php	                            	                            		
								$db->select('delivery_id,delivery');
                        		$db->where('deleted', '0');
                        		$db->where('maternity_paternity', '2');
                        		$options = $db->get('time_delivery');
								$type_options = array();
                        		foreach($options->result() as $option)
                        		{
                        			$type_options[$option->delivery_id] = $option->delivery;
                        		} 
                        	?>								
				            <div class="input-group">
								<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
				                    {{ form_dropdown('time_forms_maternity[type]',$type_options, $record['time_forms_maternity.type'], 'id="time_forms_paternity-type" class="form-control select2me" data-placeholder="Select..."') }}
				            </div> 				
			        	</div>	
					</div>					
					<div class="form-group">
						<label class="control-label col-md-4">{{ lang('form_application.from') }}<span class="required">* </span></label>
						<div class="col-md-6">
							<div class="paternity_date_from input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
								<input type="text" class="form-control" name="time_forms[date_from]" id="time_forms-date_from" value="{{ $record['time_forms.date_from'] }}" placeholder="">
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div> 				
							<div class="help-block small">
								{{ lang('form_application.select_startd') }}
							</div>	
						</div>	
					</div>	
					<div class="form-group">
						<label class="control-label col-md-4">{{ lang('form_application.to') }}<span class="required">* </span></label>
						<div class="col-md-6">
							<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
								<input type="text" class="form-control" name="time_forms[date_to]" id="time_forms-date_to" value="{{ $record['time_forms.date_to'] }}" placeholder="">
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div> 				
							<div class="help-block small">
								{{ lang('form_application.select_endd') }}
							</div>	
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-md-4 text-danger small">{{ lang('form_application.note') }}: </label>
						<div class="col-md-6">
							<div class="btn-grp">
								<button id="goto_vl_co" class="btn blue" type="button"><small>{{ lang('form_application.change_opt') }}</small></button>
							</div>
							<div class="help-block small">
								{{ lang('form_application.use_changeopt') }}
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-4">{{ lang('form_application.reason') }}<span class="required">* </span></label>
						<div class="col-md-6">							
							<textarea class="form-control" name="time_forms[reason]" id="time_forms-reason" placeholder="" rows="4">{{ $record['time_forms.reason'] }}</textarea> 				
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-md-4">{{ lang('form_application.file_upload') }}</label>
						<div class="col-md-6">							<div data-provides="fileupload" class="fileupload fileupload-new" id="time_forms_upload-upload_id-container">
							<input type="hidden" name="time_forms_upload[upload_id]" id="time_forms_upload-upload_id" value="<?php echo implode(",", $upload_id['val']) ?>"/>
							<span class="btn default btn-sm btn-file">
								<span class="fileupload-new"><i class="fa fa-paper-clip"></i> {{ lang('form_application.select') }}</span>
								<input type="file" id="time_forms_upload-upload_id-fileupload" type="file" name="files[]" multiple="">
							</span>
							<ul class="padding-none margin-top-10">
								<?php 
								implode($upload_id['val']);
								if( count($upload_id['val']) > 0 ) {
																	// $upload_ids =  explode(',', $upload_id['val']);
																	// print_r($upload_id['val']);
									foreach( $upload_id['val'] as $upload_id_val )
									{
										$upload = $db->get_where('system_uploads', array('upload_id' => $upload_id_val))->row();
										$file = FCPATH . urldecode( $upload->upload_path );
										if( file_exists( $file ) )
										{
											$f_info = get_file_info( $file );
											$f_type = filetype( $file );

											$finfo = finfo_open(FILEINFO_MIME_TYPE);
											$f_type = finfo_file($finfo, $file);

											switch( $f_type )
											{
												case 'image/jpeg':
												$icon = 'fa-picture-o';
												break;
												case 'video/mp4':
												$icon = 'fa-film';
												break;
												case 'audio/mpeg':
												$icon = 'fa-volume-up';
												break;
												default:
												$icon = 'fa-file-text-o';
											}
												$filepath = base_url()."time/application/download_file/".$upload_id_val;
											echo '<li class="padding-3 fileupload-delete-'.$upload_id_val.'" style="list-style:none;">
											<a href="'.$filepath.'">
											<span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
											<span>'. basename($f_info['name']) .'</span>
											<span class="padding-left-10"><a style="float: none;" data-dismiss="fileupload" class="close fileupload-delete" upload_id="'.$upload_id_val.'" href="javascript:void(0)"></a></span>
											</a></li>';
										}
									}
								}
								?>
							</ul>
						</div> 				
						<div class="help-block small">
							{{ lang('form_application.supp_docs') }}
						</div>
					</div>	
				</div>	

				<hr />			

				<div class="form-group">
					<label class="control-label col-md-4">{{ lang('form_application.actual_delivery') }}</label>
					<div class="col-md-6">							<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
						<input type="text" class="form-control" name="time_forms_maternity[actual_date]" id="time_forms_maternity-actual_date" value="{{ $record['time_forms_maternity.actual_date'] }}" placeholder="">
						<span class="input-group-btn">
							<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
						</span>
					</div> 				
				</div>	
			</div>	
	</div>
	<?php
			if(in_array($form_status_id['val'], array(2,3,6)) && $within_cutoff){
		?>
		<hr />

		<div class="form-group">
			<label class="control-label col-md-4">{{ lang('form_application.remarks') }}<span class="required">* </span></label>
			<div class="col-md-6">							
				<textarea class="form-control" name="cancelled_comment" id="cancelled_comment" placeholder="" rows="4"></textarea> 				
				<label class="control-label col-md-7 text-muted small"> {{ lang('form_application.required_cancel') }}</label>
			</div>	
		</div>	

		<?php
	}
	?>
	</div>


<div name="change_options" id="change_options">
</div>



<div class="form-actions fluid" style="display: block;">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-offset-4 col-md-8">
						<?php 
							if( $form_status_id['val'] < 7 || empty($form_status_id['val']) ){ 
								if($form_status_id['val'] == 1 || empty($form_status_id['val'])){ ?>
									<button type="button" class="btn blue btn-sm" onclick="save_form( $(this).parents('form'), 1 )">{{ lang('form_application.save_draft') }}</button>
									<button type="button" class="btn green btn-sm" onclick="save_form( $(this).parents('form'), 2 )">{{ lang('form_application.submit') }}</button>
						<?php 	
								}elseif($form_status_id['val'] < 3 ){ 
						?>
									<button type="button" class="btn green btn-sm" onclick="save_form( $(this).parents('form'), 2 )">{{ lang('form_application.submit') }}</button>
									<button type="button" class="btn red btn-sm" onclick="save_form( $(this).parents('form'), 8 )">{{ lang('form_application.cancel_app') }}</button>	
							<?php 
								}elseif(in_array($form_status_id['val'], array(2,3,6)) && $within_cutoff){
						?>
									<button type="button" class="btn red btn-sm" onclick="save_form( $(this).parents('form'), 8 )">{{ lang('form_application.cancel_app') }}</button>	
						<?php 
								} 
							}
						?>
					<a href="<?php echo $back_url;?>" class="btn default btn-sm">{{ lang('form_application.back') }}</a>
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
					<!-- Default panel contents -->
					<div class="panel-heading">
						<h4 class="panel-title">{{ lang('form_application.leave_credits') }}</h4>
					</div>
					
					<!-- Table -->
					<table class="table">
						<thead>
							<tr>
								<th class="small">{{ lang('form_application.type') }}</th>
								<th class="small">{{ lang('form_application.used') }}</th>
								<th class="small">{{ lang('form_application.bal') }}</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($leave_balance as $index => $value){ ?>
							<tr>
								<td class="small"><?=$value['form']?><br/>
									<?php if(date('Y-m-d', strtotime($value['period_extension'])) != '1970-01-01'):?>
									<small class="text-muted">period coverage. <?=date('M d, Y', strtotime($value['period_from']))?> to <?=date('M d, Y', strtotime($value['period_extension']))?></small>
									<?php endif;?>	
								</td>
								<td class="small text-info"><?=floatval($value['used'])?></td>
								<td class="small text-success"><?=floatval($value['balance'])?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			
					@if( count($special_leaves) > 1 || ( count($special_leaves) == 1 && $special_leaves[0]['used'] > 0) )
					<div class="clearfix">
						<div class="panel panel-success">
							<!-- Default panel contents -->
							<div class="panel-heading">
								<h4 class="panel-title">Special Leave Credits</h4>
							</div>
							
							<!-- Table -->
							<table class="table">
								<thead>
									<tr>
										<th class="small">{{ lang('form_application.type') }}</th>
										<th class="small">{{ lang('form_application.used') }}</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($special_leaves as $index => $value){ 
										if($value['used'] > 0){ ?>
									<tr>
										<td class="small"><?=$value['form']?><br/>
											<!-- <small class="text-muted">exp. <?=date('M d, Y', strtotime($value['period_extension']))?></small> -->
										</td>
										<td class="small text-info"><?=floatval($value['used'])?></td>
									</tr>
									<?php } 
									} ?>
								</tbody>
							</table>
						</div>
					</div>
					@endif

			<div class="clearfix">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h4 class="panel-title">{{ lang('form_application.approvers') }}</h4>
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
@include('edit/page_scripts')
<script type="text/javascript" src="{{ theme_path() }}modules/common/edit.js"></script> 
@stop

@section('view_js')
@parent
	<script>
	$(document).ready(function(){
        set_paternity_date_to(1);
	});
	</script>
{{ get_edit_js( $mod ) }}
@stop





