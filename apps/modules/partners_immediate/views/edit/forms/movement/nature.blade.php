<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title"><?php echo $type; ?></h4>
</div>
<form class="form-horizontal" id="form_action" method="POST">
    <div class="modal-body padding-bottom-0">	
        <div class="row">
            <div class="col-md-12">
                <div class="portlet" id="action_container">
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <div class="form-horizontal">
                            <div class="form-body move_action_modal">
						    <input type="hidden" name="partners_movement_action[action_id]" 
						    id="partners_movement_action-action_id" value="<?php echo $record['partners_movement_action.action_id']; ?>" />
						    <input type="hidden" name="partners_movement_action[type_id]" 
						    id="partners_movement_action-type_id" value="<?php echo $type_id; ?>" />
								<div class="form-group">
									<label class="col-md-4 text-muted text-right">
										Due To:
									</label>
									<div class="col-md-7">
										<?php echo $cause ?>
									</div>	
								</div>
								<div class="form-group">
									<label class="col-md-4 text-muted text-right">
										Type:
									</label>
									<div class="col-md-7">
										<?php echo $type ?>			
									</div>	
								</div>
					 			<div class="form-group">
									<label class="col-md-4 text-muted text-right">
										Effective Date:
									</label>
									<div class="col-md-7">
										<?php echo ($record['partners_movement_action.effectivity_date'] && $record['partners_movement_action.effectivity_date'] != '0000-00-00' && $record['partners_movement_action.effectivity_date'] != 'November 30, -0001' && $record['partners_movement_action.effectivity_date'] != 'January 01, 1970') ? $record['partners_movement_action.effectivity_date'] : ''?>
									</div>	
								</div>
								<div class="form-group">
									<label class="col-md-4 text-muted text-right">Remarks:</label>
									<div class="col-md-7">		
										<?php echo $movement_info['movement_remarks'] ?>					
									</div>	
								</div>
								<?php if ($movement_info['type_id'] == 6) {?>
								<div class="form-group">
									<label class="col-md-4 text-muted text-right">
										Rreason for Leaving:
									</label>
									<div class="col-md-7">							
										<?php echo $movement_info['reason_leaving'] ?>				
									</div>	
								</div>				
								<?php } ?>
								<div class="form-group">
									<label class="col-md-4 text-muted text-right">
										Attachments:
									</label>
									<div class="col-md-7">
										<?php
											if (!empty($record['attachement'])){
												foreach ($record['attachement'] as $key => $value) {
													if ( !empty($value->photo)) {
														$file = FCPATH . urldecode( $value->photo );
														if( file_exists( $file ) )
														{
															$f_type = '';

															if (function_exists('get_file_info')) {
																$f_info = get_file_info( $file );
																$f_type = filetype( $file );
															}

															if (function_exists('finfo_open')) {
																$finfo = finfo_open(FILEINFO_MIME_TYPE);
																$f_type = finfo_file($finfo, $file);
															}

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
															
															$filepath = base_url()."partners_immediate/download_movement_file/".$value->movement_attachment_id;
															echo '<li class="padding-3 fileupload-delete-'.$value->movement_attachment_id.'" style="list-style:none;">
													            <a href="'.$filepath.'">
													            <span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
													            <span>'. basename($f_info['name']) .'</span>
													            <span class="padding-left-10"></span>
													        </a></li>';	
														}
													}
												}
											} 
										?>
									</div>	
								</div>
								<?php if (($record['partners_movement_action.user_id'] != $movement_info['partners_movement_action_created_by']) && ($movement_info['partners_movement_action_created_by'] != $user_id)) { ?>
								<div class="form-group">
									<label class="col-md-4 text-muted text-right">
										Requested By:
									</label>
									<div class="col-md-7">
										<?php echo $movement_info['partners_movement_created_by_fname'] ?>
									</div>	
								</div>
								<?php } ?>

								<?php
									if ($movement_approver_remarks && count($movement_approver_remarks) > 0){
								?>
										<div class="form-group">
											<label class="col-md-4 text-right">
												Approver Remarks:
											</label>
											<div class="col-md-7">
												&nbsp;			
											</div>	
										</div>			
								<?php
										foreach ($movement_approver_remarks as $key => $value) {
											if ($value['comment'] != ''){
								?>
												<div class="form-group">
													<label class="col-md-4 text-muted text-right">
														<?php echo $value['display_name'] ?> :
													</label>
													<div class="col-md-7">
														<span>
															<?php
																if ($value['comment_date'] && $value['comment_date'] != '0000-00-00 00:00:00' && $value['comment_date'] != 'January 01, 1970' && $value['comment_date'] != '1970-01-01'){
																	echo date('F d, Y h:i a',strtotime($value['comment_date']));
																}											
															?>											
														</span><br />
														<small class="text-muted">{{ $value['comment']}}</small>									
													</div>	
												</div>					
								<?php
											}
										}
									}
								?>
								<div class="form-group">
									<label class="col-md-4 text-muted text-right">
										HR Reviewed By:
									</label>
									<div class="col-md-7">
										<?php 
											echo $movement_info['partners_movement_reviewed_by'];
											if ($movement_info['partners_movement_reviewed_by_approved_date'] && $movement_info['partners_movement_reviewed_by_approved_date'] != '0000-00-00 00:00:00' && $movement_info['partners_movement_reviewed_by_approved_date'] != 'January 01, 1970' && $movement_info['partners_movement_reviewed_by_approved_date'] != '1970-01-01'){
												echo ' - ' . date('F d, Y h:i a',strtotime($movement_info['partners_movement_reviewed_by_approved_date']));
											}
										?>
										<br />
										<?php if ($movement_info['partners_movement_reviewed_by_comment'] != '') {?>
											<small class="text-muted">{{$movement_info['partners_movement_reviewed_by_comment']}}</small>
										<?php } ?>
									</div>	
								</div>
								<div class="form-group hidden">
									<label class="col-md-4 text-muted text-right">HRD Remarks:</label>
									<div class="col-md-7">		
										<?php echo $movement_info['partners_movement_hrd_remarks'] ?>					
									</div>	
								</div>

								<div style="border-bottom:1px solid #eee;padding-bottom:8px;">Employee Movement Details</div>
								<div style="padding-top:10px" id="movement_type_container">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="modal-footer margin-top-0">
        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
        <!-- <button type="button" class="btn green" onclick="save_movement( $(this).parents('form'), 'modal' )">Save</button> -->
    </div>
</form>

<script language="javascript">
    $(document).ready(function(){

        if (jQuery().datepicker) {
            $('#partners_movement_action-effectivity_date').parent('.date-picker').datepicker({
                rtl: App.isRTL(),
                autoclose: true
            });
            $('body').removeClass("modal-open"); 
        }

        $("#partners_movement_action-user_id").select2({
			placeholder: "Select a partner",
			allowClear: true
		});

		$('.partner_id').change(function(){
			var type = $(this).data('type');
			if(type==1 || type==3 || type==8 || type==9 || type==12){
				get_employee_details($(this).val(), $(this).data('count'));
			}else if(type==2 || type==4){
				get_current_salary($(this).val());
			}
		});

    });
</script>