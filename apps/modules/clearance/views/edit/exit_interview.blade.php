<?php
	$disabled = '';
	if ($permission['process'] || $clearance_record['exit_interviewed'])
		$disabled = 'disabled';

	$disabled_item_for_hr = '';
	if ($clearance_record['exit_interviewed'])
		$disabled_item_for_hr = 'disabled';

	$disabled_item_for_employee = '';
	if (!$permission['process'])
		$disabled_item_for_employee = 'disabled';	
?>
<div class="portlet">
	<div class="portlet">
        <div class="portlet-title">
            <div class="caption">Exit interview <span class="small text-muted"> view</span></div>
        </div>
            
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <!-- <form action="#" class="form-horizontal"> -->
                <div class="form-body">
                	<div class="form-group">
                        <label class="control-label col-md-4">Employee
                        	<span class="required">*</span>
                        </label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" readonly value="{{ $partner_record['firstname'] }} {{ $partner_record['lastname'] }}" /> 	
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Department
                        	<span class="required">*</span>
                        </label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" readonly value="{{ $partner_record['dept'] }}" /> 	
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Company <span class="required">*</span>
                        </label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" readonly value="{{ $partner_record['comp'] }}" /> 
                        </div>
                    </div>
                    
                    <div class="form-group">
						<label class="control-label col-md-4">Effectivity Date<span class="required">*</span></label>
						<div class="col-md-5">							
                            <input type="text" class="form-control" readonly value="{{ date('F d, Y', strtotime($clearance_record['effectivity_date'])) }}" {{$disabled_item_for_hr}}/> 
						</div>
					</div>
					<?php
						$turn_around_time = '';
						if ($clearance_record['turn_around_time'] && $clearance_record['turn_around_time'] != '0000-00-00' && $clearance_record['turn_around_time'] != 'January 01, 1970' && $clearance_record['turn_around_time'] != '1970-01-01'){
							$turn_around_time = date("F d, Y", strtotime($clearance_record['turn_around_time']));
						}
						else{
							if ($clearance_record['effectivity_date'] && $clearance_record['effectivity_date'] != '0000-00-00' && $clearance_record['effectivity_date'] != 'January 01, 1970' && $clearance_record['effectivity_date'] != '1970-01-01'){
								$ed_thirty_days = strtotime("+30 days", strtotime($clearance_record['effectivity_date']));
					    		$turn_around_time = date("F d, Y", $ed_thirty_days);	
				    		}
						}
					?>
					<div class="form-group">
						<label class="control-label col-md-4">Turnaround Date<span class="required">*</span></label>
						<div class="col-md-5">
							<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
								<input type="text" class="form-control" name="partners_clearance[turn_around_time]" id="partners_clearance-turn_around_time" value="{{ $turn_around_time }}" placeholder="Enter Turnaround Date" readonly {{$disabled_item_for_hr}} {{$disabled_item_for_employee}}>
								<span class="input-group-btn">
									@if(!$disabled_item_for_hr && !$disabled_item_for_employee)
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									@endif
								</span>
							</div> 
						</div>
					</div>

					<div class="form-group">
                        <label class="control-label col-md-4">Exit Interview Template<span class="required">*</span>
                        </label>
                        <div class="col-md-5">                        
                        	<?php
							$db->select('exit_interview_layout_id, layout_name');
							$db->where('deleted', '0');
							$options = $db->get('partners_clearance_exit_interview_layout');
							$exit_interview_layout_id_options = array('0' => 'Select...');
							if($options && $options->num_rows() > 0){
								foreach($options->result() as $option)
								{
									$exit_interview_layout_id_options[$option->exit_interview_layout_id] = $option->layout_name;
								}
							}
								// echo "<pre>";print_r($exit_interview_layout_id_options);
							?>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-list-ul"></i>
								</span>
								@if ($disabled_item_for_hr || $disabled_item_for_employee)
									{{ form_dropdown('partners_clearance[exit_interview_layout_id]',$exit_interview_layout_id_options, (isset($layout_record['exit_interview_layout_id']) ? $layout_record['exit_interview_layout_id'] : null), 'class="form-control select2me" data-placeholder="Select..." id="partners_clearance-exit_interview_layout_id" disabled') }}
								@else
									{{ form_dropdown('partners_clearance[exit_interview_layout_id]',$exit_interview_layout_id_options, (isset($layout_record['exit_interview_layout_id']) ? $layout_record['exit_interview_layout_id'] : null), 'class="form-control select2me" data-placeholder="Select..." id="partners_clearance-exit_interview_layout_id"') }}
								@endif
							</div>
                        </div>
                    </div>

					<br>


					<!--Signatories Remarks-->
                    <div class="portlet margin-top-25">
						<div class="portlet-title">
							<div class="caption">Questionnaire</div>
							<div class="tools">
								<a class="collapse" href="javascript:;"></a>
							</div>
						</div>
						<p class="margin-bottom-25 small">To what degree has the following items affected your decision to leave?</p>

						<div class="portlet-body">
							<div class="clearfix hidden">
								<button type="button" class="btn btn-success pull-right margin-bottom-25" data-toggle="modal" onclick="add_item(0)">Add Question</button>
							</div>
                            <!-- /. Clearance: modal -->
							<?php //include "partners_clearance_signatory-add.php" ?>
							<!-- /.modal -->
							<div name="signatories" id="signatories">
							<?php 
							$count = 0;
								foreach( $sign_records as $value)
								{
							?>
									<div class="panel panel-info">
										<div class="panel-heading">
											<h3 class="panel-title"><?php echo ++$count.". ".$value['item'] ?>
												<span class="pull-right hidden"><a class="small text-muted" onclick="delete_item($(this))" href="#">Delete</a></span>
											</h3>
											<input type="hidden" name="exit_interview_layout_item_id[]" value="<?php echo $value['exit_interview_layout_item_id'] ?>">
											<input type="hidden" name="item[]" value="<?php echo $value['item'] ?>">
											<input type="hidden" name="exit_interview_answers_id[]" value="<?php echo $value['exit_interview_answers_id'] ?>">
										</div>
										<table class="table">
											@if ($value['yes_no'] == 0)
											<tr >
												<td class="active"><span class="bold">Answer</td>
												<td>											
													<div class="form-group">
														<label class="col-md-1 control-label">&nbsp;</label>
														<div class="radio-list">
															<label class="radio-inline">
															<input type="radio" name="answer[{{$value['exit_interview_layout_item_id']}}]" id="optionsRadios4" value="1" @if ($value['answer_radio'] == 1 ) checked @endif {{$disabled}}> Not at All </label>
															<label class="radio-inline">
															<input type="radio" name="answer[{{$value['exit_interview_layout_item_id']}}]" id="optionsRadios5" value="2" @if ($value['answer_radio'] == 2 ) checked @endif {{$disabled}}> Small Degree </label>
															<label class="radio-inline">
															<input type="radio" name="answer[{{$value['exit_interview_layout_item_id']}}]" id="optionsRadios6" value="3" @if ($value['answer_radio'] == 3 ) checked @endif {{$disabled}}> Moderate Degree </label>
															<label class="radio-inline">
															<input type="radio" name="answer[{{$value['exit_interview_layout_item_id']}}]" id="optionsRadios6" value="4" @if ($value['answer_radio'] == 4 ) checked @endif {{$disabled}}> High Degree </label>															
														</div>
													</div>												
												</td>
												<!-- <td><textarea rows="2" class="form-control" name="interview[]">{{ $value['remarks'] }}</textarea></td> -->
											</tr>
											@endif

											<?php if ($value['yes_no']) { ?>
												<tr >
													<td class="active"><span class="bold">&nbsp;</td>
													<td>
								                        <div class="form-group">
								                            <div class="col-md-12">    
								                            	<input type="hidden" name="yes_no[<?php echo $value['exit_interview_layout_item_id'] ?>]" class="wiht_yes_no" value="1" readonly/>                      
																<textarea rows="2" class="form-control" name="answer_text[<?php echo $value['exit_interview_layout_item_id'] ?>]" {{$disabled}}>{{$value['answer']}}</textarea>
								                            </div>  
								                        </div>
													</td>
												</tr>	
											<?php 
												} 	
												$db->where('partners_clearance_exit_interview_layout_item_sub.deleted',0);
												$db->where('partners_clearance_exit_interview_layout_item_sub.exit_interview_layout_item_id',$value['exit_interview_layout_item_id']);
												$db->join('partners_clearance_exit_interview_layout_item_sub_answer','partners_clearance_exit_interview_layout_item_sub.exit_interview_layout_item_sub_id = partners_clearance_exit_interview_layout_item_sub_answer.exit_interview_layout_item_sub_id');
												$result = $db->get('partners_clearance_exit_interview_layout_item_sub');
												if ($result && $result->num_rows() > 0){
													$ctr = 1;
													foreach ($result->result() as $row) {
											?>
														<tr >
															<td class="active"><span class="bold">Question <?php echo $ctr ?>.</td>
															<td>
																<?php echo $row->question ?>
																<span class="pull-right "><a class="small text-muted" onclick="delete_sub_question($(this))" href="javascript:void(0)">Delete</a></span>
																<br />
																<textarea rows="2" class="form-control" name="sub_answer[<?php echo $value['exit_interview_layout_item_id'] ?>][<?php echo $row->exit_interview_layout_item_sub_id ?>][]"><?php echo $row->answer ?></textarea>
															</td>
														</tr>				
											<?php
														$ctr++;
													}
												}
											?>											
										</table>
									</div>
							<?php
								}
							?>
						</div>
						
						</div>
					</div>
					<!--End-->



                </div>

                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-12" align="center">
                            	@if(!in_array($clearance_record['status_id'], array(4,5)) && !$disabled_item_for_hr && !$clearance_record['exit_interviewed'])
        							<button type="button" class="btn green btn-sm" onclick="save_exit_interview( $(this).closest('form'), {{ $clearance_record['status_id'] }}, 0)">{{lang('common.save')}}</button>
                                @endif
                                @if(!$permission['process']  && !$disabled && !$clearance_record['exit_interviewed'])
                                	<button type="button" class="btn green btn-sm" onclick="save_exit_interview( $(this).closest('form'), {{ $clearance_record['status_id'] }}, 1)">{{lang('common.submit')}}</button>
                                @endif
                                <a href="{{ $mod->url }}/edit/{{ $record_id }}" class="btn btn-default btn-sm" type="button"> Back to list</a>
                        </div>
                    </div>
                </div>
            <!-- </form> -->
            <!-- END FORM--> 
        </div>
    </div>
</div>
<!-- End Edit -->