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
        		<input type="hidden" name="record_id" id="record_id" value="<?php echo $forms_id; ?>" >
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
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.delivery') }} :</label>
												<div class="col-md-7 col-sm-7">
													<span>
														<?php
															$db->select('delivery_id,delivery');
						                            		$db->where('deleted', '0');
						                            		$options = $db->get('time_delivery');

						                            		foreach($options->result() as $option){
						                            			if( $record['time_forms_maternity_delivery_id'] == $option->delivery_id ){
						                            				echo $option->delivery;
						                            			}
						                            		}
														?>
													</span>
												</div>
											</div>
										</div>
									</div>
	                                <div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.from') }} :</label>
												<div class="col-md-7 col-sm-7">
													<span>{{ general_date_w_day($record['time_forms_date_from']) }}</span>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.to') }} :</label>
												<div class="col-md-7 col-sm-7">
													<span>{{ general_date_w_day($record['time_forms_date_to']) }}</span>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
			                                <div class="form-group">
			                                    <label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.note') }} :</label>
			                                    <div class="col-md-6">
													<div class="btn-grp">
														<button id="goto_vl_co" class="btn blue" type="button"><small>{{ lang('form_application.view_options') }}</small></button>
													</div>
			                                        <div class="help-block small">
														{{ lang('form_application.click_viewopt') }}
													</div>
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
															        </a></li>';
																}
															}
														}
													?>


                                                </ul>
												</div>
											</div>
										</div>
									</div>

									<hr />
									
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.num_preg') }} :</label>
												<div class="col-md-7 col-sm-7">
													<span>{{ $record['time_forms_maternity_pregnancy_no'] }}</span>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.expected_delivery') }} :</label>
												<div class="col-md-7 col-sm-7">
													<span>
														@if ($record['time_forms_maternity_expected_date'] != '')
															{{ general_date_w_day($record['time_forms_maternity_expected_date']) }}
														@endif
													</span>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.actual_delivery') }} :</label>
												<div class="col-md-7 col-sm-7">
													<span>
														@if ($record['time_forms_maternity_actual_date'] != '')
															{{ general_date_w_day($record['time_forms_maternity_actual_date']) }}
														@endif
													</span>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.return_work') }} :</label>
												<div class="col-md-7 col-sm-7">
													<span>
														@if ($record['time_forms_maternity_return_date'] != '')
															{{ general_date_w_day($record['time_forms_maternity_return_date']) }}
														@endif
													</span>													
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
			                                    <label class="control-label col-md-4 col-sm-4 text-right text-muted">{{ lang('form_application.approver_remarks') }} :</label>
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

	            	<div name="change_options" id="change_options">
								</div>



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
											<small class="text-muted">exp. <?=date('M d, Y', strtotime($value['period_extension']))?></small>
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
								<h4 class="panel-title"><?php echo $approver_title; ?></h4>
							</div>

							<ul class="list-group">
								<?php foreach($approver_list as $index => $value){ ?>
									<li class="list-group-item"><?=$value['lastname'].', '.$value['firstname']?>
										<br><small class="text-muted"><?=$value['position']?></small>
									<?php if($form_status_id['val'] >= 2){ 
								            $form_style = 'info';
								            switch($value['form_status_id']){
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
								                case 8:
								                default:
								                    $form_style = 'default';
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


