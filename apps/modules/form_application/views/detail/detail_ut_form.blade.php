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
        		<input type="hidden" name="view" id="view" value="detail" >
				<div id="vl_container" class="portlet">
						<div class="portlet-title">
							<div class="caption">{{ $form_title }} <small class="text-muted">{{ lang('form_application.view') }}</small></div>
						</div>
	                    <div class="portlet-body form" id="main_form">
	                        <!-- BEGIN FORM-->
	                            <div class="form-body">
									<?php if( $record['time_forms_form_status_id'] >= 6 ){ ?>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ $label_adc }} :</label>
												<div class="col-md-7 col-sm-7">
													<span><?php echo general_date_time($date_adc) ?></span>
												</div>
											</div>
										</div>
									</div>
									<?php } ?>		                            	
									<?php if( $record['time_forms_form_status_id'] != 1 ){ ?>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.date_filed') }} :</label>
												<div class="col-md-7 col-sm-7">
													<span><?php echo general_date_time($record['time_forms_date_sent']) ?></span>
												</div>
											</div>
										</div>
									</div>
									<?php } ?>
	                                <div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">Type :</label>
												<div class="col-md-7 col-sm-7">
													<span>{{ $record['time_forms_date_type'] }}</span>
												</div>
											</div>
										</div>
									</div>										
	                                <div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.ut_date') }} :</label>
												<div class="col-md-7 col-sm-7">
													<span>{{ $focus_date['val'] }} - <?php echo date('D',strtotime($date_to['val'])); ?></span>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.date_time') }} :</label>
												<div class="col-md-7 col-sm-7">
													<span><?php echo $ut_time_in_out; ?></span>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.reason') }} :</label>
												<div class="col-md-7 col-sm-7">
													<span>{{ $record['time_forms_reason'] }}</span>
												</div>
											</div>
										</div>
									</div>
	                                
									<div class="row">
										<div class="col-md-12">
			                                <div class="form-group">
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.file_upload') }} :</label>
												<div class="controls col-md-6">
													<ul class="padding-none">

                                                    <?php 
													implode($uploads);
														if( count($uploads) > 0 ) {

															foreach( $uploads as $upload_id_val )
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
															            <span class="padding-left-10"></span>
															            </a>
															        </li>';
																}
															}
														}
													?>


                                                </ul>
												</div>
											</div>
										</div>
									</div>

									<?php if($cancelled_by_user == 0 &&
											  count($remarks) > 0 && 
											  in_array($form_status_id['val'],array(6,7,8)) && 
											  $record['time_forms_hr_admin_approved_user_id'] == ''){ ?>

									<hr />
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
			                                    <label class="control-label col-md-4 col-sm-4 text-right text-muted">Approver Remarks :</label>
			                        <?php
						                    for($j=0; $j < count($remarks); $j++){
						                        	if($j > 0){
			                         ?>
					                         <label class="control-label col-md-4 col-sm-4 text-right text-muted">&nbsp</label>
					                         <?php } ?>
				                         <div class="col-md-7 col-sm-7">
		                                    <span style='display:block; word-wrap:break-word;'>
		                                        <?php
		                                            echo "<b>".$remarks[$j]['display_name']."</b>:";
		                                        ?>
		                                        <span class="text-right text-danger">{{ general_date_time($remarks[$j]['comment_date']) }}</span>
		                                    </span>
		                                    <div style='display:block; word-wrap:break-word;'>
		                                        <?php
		                                            echo ($remarks[$j]['comment']=="") ? "&nbsp;" : $remarks[$j]['comment'];
		                                        ?>
		                                    </div>

		                                    <?php if ($remarks[$j]['comment']!="") echo "<br/>"; ?>
										 </div>

									<?php
											}
											?>

			                                </div>
										</div>
									</div>
									<?php } ?>
									
									<?php
									if ($cancelled_by_user == 0 && $record['time_forms_hr_admin_approved_user_id'] != '') {
										switch ($record['time_forms_form_status_id']) {
											case 6:
												$date_transaction = $record['time_forms_date_approved'];
												break;
											case 7:
												$date_transaction = $record['time_forms_date_declined'];
												break;
											case 8:
												$date_transaction = $record['time_forms_date_cancelled'];
												break;
											default:
												$date_transaction = '';
												break;																								

										}
									?>
										<hr />
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
				                                    <label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.hr_approver_remarks') }} :</label>
							                         <div class="col-md-7 col-sm-7">
					                                    <span style='display:block; word-wrap:break-word;'>
					                                        <?php
					                                            echo "<b>".$record['time_forms_hr_approve_full_name']."</b>:";
					                                        ?>
					                                        <span class="text-right text-danger">{{ general_date_time($date_transaction) }}</span>
					                                    </span>
					                                    <div style='display:block; word-wrap:break-word;'>
					                                        <?php
					                                            echo ($record['time_forms_hr_admin_approved_comment']=="") ? "&nbsp;" : $record['time_forms_hr_admin_approved_comment'];
					                                        ?>
					                                    </div> 
													</div>
												</div>
											</div>
										</div>
                                   <?php
									}
									?>
	                            </div>
	                            @if (in_array($form_status_id['val'],[2,8]))
		                            <hr />
	                        		<div class="row">
										<div class="col-md-12">
											<div class="form-group">
			                                    <label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.remarks') }}<span class="required">* </span></label>
			                                    <div class="col-md-5 col-sm-6">
			                                        <textarea id="remarks" class="form-control" rows="3" @if($form_status_id['val'] != 2) readonly="readonly" @endif>{{ $cancelled_remarks_by_user }}</textarea>
			                                        <label class="control-label col-md-7 text-muted small"> {{ lang('form_application.required_cancel') }}</label>
			                                    </div>
			                                </div>
										</div>
									</div>
								@endif

								@include('buttons/details',array('params' => 'value'))
	                        <!-- END FORM--> 
	                    </div>
	            	</div>



       	</div>  
    	<div class="col-md-3 visible-lg visible-md">
			<div class="portlet">
				<div class="portlet-body">
					<div class="clearfix">
						<div class="panel panel-success">
							<!-- Default panel contents -->
							<div class="panel-heading">
								<h4 class="panel-title">{{ lang('form_application.shift_details') }}</h4>
							</div>
							
							<!-- Table -->
								<table class="table">
									<thead>
										<tr>
											<th class="small">{{ lang('form_application.shift') }}</th>
											<th class="small">{{ lang('form_application.schedule') }}</th>
											<th class="small">{{ lang('form_application.logs') }}</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="small">{{ lang('form_application.time_in') }}</td>
											<td class="small text-info" id="shift_time_start" name="shift_time_start"><?php echo (isset($shift_details['shift_time_start']) ? date("g:ia", strtotime($shift_details['shift_time_start'])) : '-'); ?></td>
											<td class="small text-info" id="logs_time_in" name="logs_time_in"><?php echo ((isset($shift_details['logs_time_in']) && $shift_details['logs_time_in'] != '-') ? date("g:ia", strtotime($shift_details['logs_time_in'])) : '-'); ?></td>
										</tr>
										<tr>
											<td class="small">{{ lang('form_application.time_out') }}</td>
											<td class="small text-info" id="shift_time_end" name="shift_time_end"><?php echo (isset($shift_details['shift_time_end']) ? date("g:ia", strtotime(date("Y-m-d")." ".$shift_details['shift_time_end'])) : "-"); ?></td>
											<td class="small text-info" id="logs_time_out" name="logs_time_out"><?php echo ((isset($shift_details['logs_time_out']) && $shift_details['logs_time_out'] != '-') ? date("g:ia", strtotime($shift_details['logs_time_out'])) : '-'); ?></td>
										</tr>
									</tbody>
								</table>
						</div>
					</div>

					<div class="clearfix">
						<div class="panel panel-success">
							<div class="panel-heading">
								<h4 class="panel-title"><?php echo $approver_title; ?></h4>
							</div>

							<ul class="list-group">
								<?php foreach($approver_list as $index => $value){ ?>
									<li class="list-group-item"><?=$value['lastname'].', '.$value['firstname']?>
										<br><small class="text-muted"><?=$value['position']?></small>
									<?php if($form_status_id['val'] >= 2){ 
								            $form_style = 'info';
								            switch($value['form_status_id']){
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
									<br><p><span class="badge badge-<?php echo $form_style ?>"><?=$value['form_status']?></span></p> </li>
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
	<script type="text/javascript" src="{{ theme_path() }}modules/form_application/detail.js"></script> 
@stop


