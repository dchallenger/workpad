<div class="portlet">
	<div class="portlet-title">
		<div class="caption bold">{{ lang('clearance_manage.clearance_form') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
			</div>
	</div>

    <div class="portlet-body" >

    	<p class="margin-bottom-25 small">&nbsp;</span></p>

    	<!-- EMPLOYEES INFO-->
    	<div class="portlet">
			<div class="portlet-body">

            	<table class="table table-bordered table-striped">
					<tbody>
						<tr class="success">
							<td>
								<div class="form-group">
									<label class="control-label col-md-3 bold">{{ lang('clearance_manage.employee') }}</label>
									<div class="col-md-9">
										<input type="text" class="form-control" readonly value="{{$record['firstname']}} {{$record['lastname']}}">
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label class="control-label col-md-3 bold">{{ lang('clearance_manage.department') }}</label>
									<div class="col-md-9">
										<input type="text" class="form-control" readonly value="{{$record['department']}}">
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<label class="control-label col-md-3 bold">{{ lang('clearance_manage.company') }}</label>
									<div class="col-md-9">
										<input type="text" class="form-control" readonly value="{{$record['company']}}">
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label class="control-label col-md-3 bold">{{ lang('clearance_manage.effectivity') }}</label>
									<div class="col-md-9">
										<input type="text" class="form-control" readonly value="{{$record['effectivity_date']}}">
									</div>
								</div>
							</td>
						</tr>
						<tr class="success">
							<td>
<!-- 								<div class="form-group">
									<label class="control-label col-md-3 bold">{{ lang('clearance_manage.tat') }}</label>
									<div class="col-md-9">
										<input type="text" class="form-control" readonly value="{{$record['turn_around_time']}}">
									</div>
								</div> -->
							</td>
							<td>
								<div class="form-group">
									<label class="control-label col-md-3 bold">{{ lang('clearance_manage.clearance_status') }}</label>
									<div class="col-md-9">
										<input type="text" class="form-control" readonly value="{{$record['clearance_status']}}">
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

        <!-- BEGIN OF FORM-->
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption">{{ lang('clearance_manage.signatories') }}</div>
				<div class="tools">
					<a class="collapse" href="javascript:;"></a>
					</div>
			</div>
			<div class="portlet-body">				
				<!-- <div class="clearfix"> -->
					
				<?php if ($records && $records->num_rows() > 0) { ?>
					<?php 
					foreach ( $records->result_array() as $value) { 
						$disabled = 'disabled';
					?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title"><?php echo $value['panel_title'] ?>
									<span class="pull-right hidden"><a class="small text-muted" onclick="delete_signatories($(this))" href="#">Delete</a></span>
								</h3>
							</div>
								
							<table class="table">
								<tr>
									<td width="30%" class="active">
										<span class="bold">Signatory</span>
									</td>
									<td>						
					                    <?php
						                    $db->select('user_id, full_name');
						                    $db->where('deleted', '0');
						                    $options = $db->get('users');
						                    $user_id_options = array('0' => 'Select...');
					                        foreach($options->result() as $option)
					                        {
					                            $user_id_options[$option->user_id] = $option->full_name;
					                        } 
					                    ?>
					                    <div class="input-group">
					                        <span class="input-group-addon">
					                            <i class="fa fa-list-ul"></i>
					                        </span>
			                        	    <?php echo form_dropdown('partners_clearance_signatories_oth[clearance_signatories_id]['.$value["clearance_layout_sign_id"].']',$user_id_options, $value['user_id'], 'class="form-control select2me" data-placeholder="Select..." id="partners_clearance_layout_sign-user_id" disabled') ?>
					                    </div>
									</td>
								</tr>
								<tr>
									<td class="active"><span class="bold">Accountabilities </span></td>
									<td>
							            <div class="row">
							            	<label class="col-md-12 col-sm-12 text-muted">Attachments List</label>
							            </div><br>

						                <div class="uploaded_container">
											<?php 
												$attachments = $db->get_where('partners_clearance_signatories_attachment', array( 'clearance_signatories_id' => $value['clearance_signatories_id'], 'type' => 0 ) );

												if ($attachments && $attachments->num_rows() > 0){ 
													foreach ($attachments->result_array() as $value_attachment) {
														$file = FCPATH . urldecode( $value_attachment['attachments']);
														if( file_exists( $file ) )
														{
															$f_info = get_file_info( $file );
															$f_type = filetype( $file );

					/*										$finfo = finfo_open(FILEINFO_MIME_TYPE);
															$f_type = finfo_file($finfo, $file);*/																	
											?>
															<div class="row">
																<div class="col-md-12">
																	<div class="form-group">
																		<div class="col-md-8">
																		<?php
																			switch( $f_type )
																			{
																				case 'image/jpeg':
																					$icon = 'fa-picture-o';
																					echo '<a class="fancybox-button" href="'.base_url($value_attachment['attachments']).'"><span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
																	            	<span>'. basename($f_info['name']) .'</span></a>';
																					break;
																				case 'video/mp4':
																					$icon = 'fa-film';
																					echo '<a href="'.base_url($value_attachment['attachments']).'" target="_blank"><span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
																	            <span>'. basename($f_info['name']) .'</span></a>';
																					break;
																				case 'audio/mpeg':
																					$icon = 'fa-volume-up';
																					echo '<a href="'.base_url($value_attachment['attachments']).'" target="_blank"><span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
																	            <span>'. basename($f_info['name']) .'</span></a>';
																					break;
																				default:
																					$icon = 'fa-file-text-o';
																					echo '<a href="'.base_url($value_attachment['attachments']).'" target="_blank"><span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
																	            <span>'. basename($f_info['name']) .'</span></a>';
																			}																							
																		?>
																		</div>
																	</div>
																</div>
															</div>																				
											<?php
														}
													}
												} 
											?>												                	
										</div>					
										<br>
										<div class="accountability">
											<?php 
												$accountabilities = $db->get_where('partners_clearance_signatories_accountabilities', array( 'clearance_signatories_id' => $value['clearance_signatories_id'] ) ); 

												if ($accountabilities && $accountabilities->num_rows() > 0){ 
													foreach ($accountabilities->result_array() as $value_acct) {
											?>
														<div class="padding-bot-5">
															<input type="text" class="form-control act<?php echo $value["clearance_layout_sign_id"] ?>" name="partners_clearance_signatories_accountabilities_oth[<?php echo $value['clearance_layout_sign_id'] ?>][accountability][]" value="<?php echo $value_acct['accountability'] ?>" disabled>
														</div>							
											<?php
													}
												} 
											?>																
										</div>														 							
						        	</td>
								</tr>
								<tr >
									<td class="active"><span class="bold">Remarks</span>@if($disabled == '') <span class="required">*</span> @endif</td>
									<td><textarea rows="2" class="form-control" name="partners_clearance_signatories[remarks]" {{$disabled}}><?php echo $value['remarks'] ?></textarea></td>
								</tr>
								<tr>
									<td class="active"><span class="bold">Status</span>@if($disabled == '') <span class="required">*</span> @endif</td>
									<td>
										<select class="form-control select2me" data-placeholder="Select..." name="partners_clearance_signatories[status_id]" {{$disabled}}>
											<option value="">Select...</option>
						                    <option value="4" <?php echo ($value['status_id'] == 4) ? "selected='selected'" : '' ?> >Cleared</option>
						                    <option value="3" <?php echo ($value['status_id'] == 3) ? "selected='selected'" : '' ?> >Pending</option>
						                </select>
									</td>
								</tr>
								<tr>
									<td class="active"><span class="bold">Date Approved</span></td>
									<td>
										{{ general_date($value['date_cleared']) }}
									</td>
								</tr>													
							</table>
						</div>   
				<?php 
					} 
				}
				?>

				<!-- </div> -->
			</div>
		</div>
		<!-- END OF FORM-->


    </div>
</div>