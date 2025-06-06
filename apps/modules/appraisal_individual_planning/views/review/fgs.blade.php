<div class="portlet">
	<div class="portlet-title">
		<div class="caption bold">{{ lang('appraisal_individual_planning.performance_planning_form') }}</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body">
		@if (isset($template_id) && $template_id == 0)
			<p class="margin-bottom-25 text-info">Performance Template has not been set.</label> 
		@else
			<p class="margin-bottom-25"><label class="bold">{{ $templatefile->template }}</label> 
			<span class="text-muted small">{{ lang('appraisal_individual_planning.strictly_confi') }}</span>
			</p>
			<!-- EMPLOYEES INFO-->
	        <div class="portlet">
				<div class="portlet-body">
					<table class="table table-bordered table-striped">
						<input type="hidden" name="user_id" value="{{ $appraisee->user_id }}" />
						<input type="hidden" name="template_id" value="{{ $appraisee->template_id }}" />
						<input type="hidden" name="planning_id" value="{{ $appraisee->planning_id }}" />
						<input type="hidden" name="status_id" value="{{ $appraisee->status_id }}" />
						<input type="hidden" name="from_pages" value="{{ $pages_from }}" />
						<tbody>
							<tr class="success">
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.appraisee') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="{{ $appraisee->fullname }}" readonly>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.planning_period') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="{{ date('M d, Y', strtotime( $record['date_from'] ) ) }} to {{ date('M d, Y', strtotime( $record['date_to'] ) ) }}" readonly>
										</div>
									</div>
								</td>							
							</tr>
							<tr>
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.rank') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" readonly value="{{ $appraisee->v_job_grade }}">
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.planning_date') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="<?php if( !empty($appraisee->planning_created_on) ) echo date('M d, Y', strtotime( $appraisee->planning_created_on ) )?>"  readonly>
										</div>
									</div>
								</td>							
							</tr>						
							<tr class="success">
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.job_title') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" readonly value="{{ $appraisee->position }}">
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.appraisal_date') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="" readonly>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.reports_to') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="{{ $appraisee->v_reports_to }}" readonly>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.tenure') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="{{ $tenure }}" readonly>
										</div>
									</div>
								</td>
							</tr>
							<tr class="success">
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.department') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="{{ $appraisee->v_department }}" readonly>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.dept_head') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="{{ $appraisee->dept_head }}" readonly>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.division') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="{{ $appraisee->v_division }}" readonly>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.div_head') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="{{ $appraisee->div_head }}" readonly>
										</div>
									</div>
								</td>
							</tr>
							<tr class="success">
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.company') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="{{ $appraisee->company }}" readonly>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.level') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="{{ $appraisee->employment_type }}" readonly>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.total_weighted_scode') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="" readonly>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.over_all_rating') }}</label>
										<div class="col-md-8">
											<input type="text" class="form-control" value="" readonly>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="panel panel-success">
				<div class="panel-heading">
					<h4 class="panel-title">Rating Scale</h4>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="20%">Qualitative Rating</th>
								<th width="20%">Quantitative Rating</th>
								<th width="20%">Total Weighted Score</th>
								<th width="40%">Criteria / Standard</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Poor Performance</td>
								<td><center>1.00</center></td>
								<td><center>0-64</center></td>
								<td>Poor Performance - Performance falls below the minimum standards for most of the objectives; He/She is given six months to demonstrate marked improvements in his/her</td>
							</tr>
							<tr>
								<td>Requires Improvement</td>
								<td><center>2.00</center></td>
								<td><center>65-79</center></td>
								<td>Some critical performance objectives are not met or falls below the minimum standards; Needs to show improvement over the next cycle to demonstrate that he/she can be an effective contributor to the firm.</td>
							</tr>
							<tr>
								<td>Effective Contributor</td>
								<td><center>3.00</center></td>
								<td><center>80-94</center></td>
								<td>Performance is consistent and satisfactory, meeting the most important objectives; Solid Contributor.</td>
							</tr>
							<tr>
								<td>Strong Contributor</td>
								<td><center>4.00</center></td>
								<td><center>95-109</center></td>
								<td>Performance meets all and exceeds some of the objectives; Strong potential to broaden current capabilities and scope.</td>
							</tr>
							<tr>
								<td>Exceptional Contributor</td>
								<td><center>5.00</center></td>
								<td><center>110-150</center></td>
								<td>Performance consistently exceeds all of the objectives; Shows strong potential for career advancement and greater contribution.</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<!-- BEGIN OF FORM-->
			<div class="portlet"><?php
				//get the template
				$sections = $template->build_sections( $appraisee->applicable_template_id );
				foreach( $sections as $section ):?>
						<div class="portlet-title">
							<div class="caption">{{ $section->template_section }} {{ ($section->weight > 0 ? '(' + $section->weight + ')' : '') }}</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
							</div>
						</div> 
						<div class="portlet-body">
							<div class="clearfix"> <?php
								foreach( $section->children as $child ):
									if  (in_array($child->section_type_id,array(2,9))) { // remove this if want to show all section even core competencies
										switch( $child->section_type_id )
										{
											case 2: //balance Scorecard ?>
												<div class="panel panel-success">
													<div class="panel-heading">
														<h3 class="panel-title">
															{{ $child->template_section }} ({{ $child->weight }}%)
														</h3>
													</div>
													@include('review/sections/balance_scorecard', array('financial_metric_planning_finance' => $financial_metric_planning_finance, 'financial_metric_planning' => $financial_metric_planning, 'section_id' => $child->template_section_id, 'header' => $child->header, 'footer' => $child->footer))
												</div> <?php 
												break;
											case 3: //core competencies?>
												<div class="panel panel-success">
													<div class="panel-heading">
														<h3 class="panel-title">
															{{ $child->template_section }} ({{ $child->weight }}%)
														</h3>
													</div>
													@include('review/sections/competencies', array('section_id' => $child->template_section_id, 'header' => $child->header, 'footer' => $child->footer))
												</div> <?php
												break;
											case 9: //IDP?>
												<div class="panel panel-success">
													<div class="panel-heading">
														<h3 class="panel-title">
															{{ $child->template_section }} ({{ $child->weight }}%)
														</h3>
													</div>
													@include('review/sections/idp', array('section_id' => $child->template_section_id, 'header' => $child->header, 'footer' => $child->footer))
												</div> <?php
												break;												
											default:
										}
									}
								endforeach;	?>

								<!-- overall rating -->
								<div class="panel panel-success">
									<div class="panel-heading">
										<h3 class="panel-title">
											OVERALL RATING
										</h3>
									</div>
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th class="text-center">GENERAL CRITERIA</th>
													<th class="text-center">KEY IN WEIGHT (%)</th>
													<th class="text-center">SELF RATING</th>
													<th class="text-center">COACH'S RATING</th>
													<th class="text-center">SECTION RATING</th>
													<th class="text-center">WEIGH IN (%)</th>
													<th class="text-center">TOTAL WEIGHTED SCORE</th>
												</tr>
											</thead>
											<tbody>
												@if(isset($template_section) && $template_section->num_rows() > 0)
													@foreach($template_section->result_array() as $key1 => $val1)
														@if($val1['parent_id'] > 0 && $val1['is_core'] == 0 && $val1['section_type_id'] != 9) <!-- just remove && $val1['is_core'] == 0 to display all section even core competencies -->
															@if($val1['is_core'] == 0)
																<tr>
																	<td colspan="5" class="bold">
																		{{ $val1['template_section'] }}
																	</td>
																	<td>
																		{{ $val1['weight'] }}
																	</td>
																	<td>
																		&nbsp;
																	</td>
																</tr>													
																@if(isset($balance_score_card) && $balance_score_card->num_rows() > 0)
																	@foreach($balance_score_card->result_array() as $key => $val)
																		<tr>
																			<td>
																				{{ $val['scorecard'] }}
																			</td>
																			<td class="key_weight_total_{{ $val['scorecard_id']}}"></td>
																			<td></td>
																			<td></td>
																			<td></td>
																			<td></td>
																			<td></td>
																		</tr>
																	@endforeach
																@endif
															@else
																<tr>
																	<td colspan="5" class="bold">
																		{{ $val1['template_section'] }}
																	</td>
																	<td>
																		{{ $val1['weight'] }}
																	</td>
																	<td>
																		&nbsp;
																	</td>
																</tr>
																@if(isset($library_competencies[$val1['library_id']]) && !empty($library_competencies))
																	@foreach($library_competencies[$val1['library_id']] as $key2 => $val2)
																		<tr>
																			<td>
																				{{ ucwords(strtolower($val2->library_value)) }}
																			</td>
																			<td></td>
																			<td></td>
																			<td></td>
																			<td></td>
																			<td></td>
																			<td></td>
																		</tr>
																	@endforeach
																@endif
															@endif
														@endif
													@endforeach
												@endif
											</tbody>								
										</table>
									</table>
								</div>							
							</div>
						</div><?php
				endforeach; ?>
			</div>
			<!-- START APPROVER'S LOG-->
			<div class="portlet">
				<div class="portlet-title">
					<div class="caption">LOGS</div>
					<div class="tools">
						<a class="collapse" href="javascript:;"></a>
					</div>
				</div>
				<div class="portlet-body">
					<div class="clearfix">
						<div class="panel panel-success">
							<!-- Default panel contents -->
							<div class="panel-heading">
								<h4 class="panel-title">Approver/s</h4>
							</div>

							<table class="table">
								<thead>
									<tr>
										<th>APPROVER</th>
										<th>DATE/TIME</th>
										<th>STATUS</th>
									</tr>
								</thead>
								<tbody>
								@if( !empty($approversLog) )
									@foreach($approversLog as $applog)
									<tr>
										<td>{{ $applog['display_name'] }} <br><small class="text-muted">{{ $applog['position'] }}</small></td>
										<td>
										@if( strtotime($applog['approved_date']) && $applog['approved_date'] != '1970-01-01' )
											<span class="text-success">{{ date('M d, Y', strtotime($applog['approved_date'])) }}</span>
											<br />
											<span id="date_set" class="small text-muted">{{ date('h:i a', strtotime($applog['approved_date'])) }}</span>
										@endif
										</td>
										<td>
											<span class="{{ $applog['class'] }}"> {{ $applog['performance_status'] }}</span><br>
											<span class="small text-muted">@if($applog['edited'] == 1) Edited @endif</span><br />										
										@if( $applog['approver_id'] == $applog['to_user_id'] )
											<span class="small text-danger">Attention to {{ $applog['display_name'] }}</span>
										@endif
										</td>
									</tr>
									@endforeach
								@else
									<tr>
										<td colspan="3" align="center">
											No Approver/s Setup
										</td>
									</tr>
								@endif
								</tbody>
							</table>
						</div>
					</div>
					<div class="clearfix">
						<div class="panel panel-success">
							<!-- Default panel contents -->
							<div class="panel-heading">
								<h4 class="panel-title">Historical</h4>
							</div>

							
							<table class="table">
								<tbody>
									<tr>
										<td>
											Planning Logs
											<br>
											<span class="text-muted small">Composed of historical logs, date/time and status of planning.</span>
										</td>
										<td>
											<a class="btn btn-primary btn-sm pull-right" data-toggle="modal" href="javascript: view_transaction_logs( {{ $appraisee->planning_id }}, {{ $appraisee->user_id }} )"> <i class="fa fa-list"></i> View Planning Logs</a>
										</td>
									</tr>
									<tr>
										<td>
											Discussion Logs
											<br>
											<span class="text-muted small">Composed of historical chat logs, date and time of discussion.</span>
										</td>
										<td>
											<button type="button" class="btn blue btn-sm pull-right" onclick="view_discussion( $(this).closest('form'), {{ $appraisee->performance_status_id }} )"><i class="fa fa-list"></i> View Discussion</button>
											<!-- <a class="btn btn-primary btn-sm pull-right" data-toggle="modal" href="#for_discussion"> <i class="fa fa-list"></i> View Discussion</a> -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="form-actions fluid">
	            <div class="row" align="center">
	                <div class="col-md-12">
	                    <div>
	                    	@if( $appraisee->user_id == $user['user_id'] AND $appraisee->status_id == 1)
		                    	<?php switch( $appraisee->performance_status_id ):
										case 0;
										case 1;
										case 6; ?>
											@include('buttons/partner/no_status') <?php
											break;
									endswitch;
								?>
							@else
								@if(!isset($planning_admin) || $planning_admin == 0 && !empty($approver))
			                    	<?php 
			                    		switch( $approver->performance_status_id ):
											case 2; ?>
												@include('buttons/immediate/for_approval') <?php
												break;									
										endswitch;
									?>						
								@endif
							@endif
	                    	<a class="btn default btn-sm back_button_gray" href="{{ $mod->url }}">{{ lang('common.back') }}</a>
	                    </div>
	                </div>
	            </div>
	        </div>
	    @endif
    </div>
</div>
