<div class="portlet">
	<div class="portlet-title">
		<div class="caption bold">PERFORMANCE APPRAISAL FORM</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body">
		<p class="margin-bottom-25"><label class="bold">{{ $templatefile->template }}</label> <span class="text-muted small">(STRICTLY CONFIDENTIAL)</span>
		</p>
		<!-- EMPLOYEES INFO-->
        <div class="portlet">
			<div class="portlet-body">
				<input type="hidden" name="user_id" value="{{ $appraisee->user_id }}" />
				<input type="hidden" name="template_id" value="{{ $appraisee->template_id }}" />
				<input type="hidden" name="appraisal_id" value="{{ $appraisee->appraisal_id }}" />
				<input type="hidden" name="planning_id" value="{{ $appraisee->planning_id }}" />	
				<input type="hidden" name="status_id" value="{{ $appraisee->status_id }}" />			
				<table class="table table-bordered table-striped">
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
										<input type="text" class="form-control" value="<?php if( !empty($appraisee->created_on) ) echo date('M d, Y', strtotime( $appraisee->created_on ) )?>"  readonly>
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
										<input type="text" class="form-control" value="<?php if( !empty($appraisee->appraisal_created_on) ) echo date('M d, Y', strtotime( $appraisee->appraisal_created_on ) )?>" readonly>
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
									<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.pos_classification') }}</label>
									<div class="col-md-8">
										<input type="text" class="form-control" value="{{ $appraisee->position_classification }}" readonly>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.coach_rating') }}</label>
									<div class="col-md-8">
										<input type="text" name="coach_rating" class="form-control" value="{{ $appraisee->coach_rating }}" readonly>
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.committee_rating') }}</label>
									<div class="col-md-8">
										<input type="text" name="committee_rating" class="form-control" value="{{ $appraisee->committee_rating }}" @if($committee_rater) '' @else readonly @endif>
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
			$sections = $template->build_sections( $appraisee->template_id );
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
								switch( $child->section_type_id )
								{
									case 2: //balance Scorecard ?>
										<div class="panel panel-success">
											<div class="panel-heading">
												<h3 class="panel-title">
													{{ $child->template_section }} ({{ $child->weight }}%)
												</h3>
											</div>
											@include('summary/sections/balance_scorecard', array('performance_status_id' => $appraisee->performance_status_id, 'appraisee_user_id' => $appraisee->user_id,'self_rating' => $self_rating, 'login_user_id' => $login_user_id, 'section_info' => $child,'section_id' => $child->template_section_id, 'header' => $child->header, 'footer' => $child->footer))
										</div> <?php 
										break;
									case 3: //core competencies?>
										<div class="panel panel-success">
											<div class="panel-heading">
												<h3 class="panel-title">
													{{ $child->template_section }} ({{ $child->weight }}%)
												</h3>
											</div>
											@include('summary/sections/competencies', array('performance_status_id' => $appraisee->performance_status_id, 'appraisee_user_id' => $appraisee->user_id, 'self_rating' => $self_rating, 'login_user_id' => $login_user_id, 'section_info' => $child, 'section_id' => $child->template_section_id, 'library_id' => $child->library_id, 'header' => $child->header, 'footer' => $child->footer))
										</div> <?php
										break;
									default:
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
												<th>GENERAL CRITERIA</th>
												<th>KEY IN WEIGHT (%)</th>
												<th>SELF RATING</th>
												<th>COACH'S RATING</th>
												<th>TOTAL WEIGHTED / AVERAGE</th>
												<th>COACH'S SECTION RATING</th>
												<th>WEIGH IN (%)</th>
												<th>TOTAL WEIGHTED SCORE</th>
												<th>COACH'S TOTAL WEIGHTED SCORE</th>
											</tr>
										</thead>
										<tbody>
											@if(isset($template_section) && $template_section->num_rows() > 0)
												@foreach($template_section->result_array() as $key1 => $val1)
													@if($val1['parent_id'] > 0)
														<?php
															$total_weighted_average = (isset($appraisal_applicable_section_ratings[$val1['template_section_id']]) ? $appraisal_applicable_section_ratings[$val1['template_section_id']]['total_weight_average'] : '');
															$coach_total_weighted_average = (isset($appraisal_applicable_section_ratings[$val1['template_section_id']]) ? $appraisal_applicable_section_ratings[$val1['template_section_id']]['coach_section_rating'] : '');
															$total_weighted_score = (isset($appraisal_applicable_section_ratings[$val1['template_section_id']]) ? $appraisal_applicable_section_ratings[$val1['template_section_id']]['total_weighted_score'] : '');
															$coach_total_weighted_score = (isset($appraisal_applicable_section_ratings[$val1['template_section_id']]) ? $appraisal_applicable_section_ratings[$val1['template_section_id']]['coach_total_weighted_score'] : '');
														?>
														<input type="hidden" name="section_key_weight[{{$val1['template_section_id']}}][]" class="section_key_weight_{{$val1['template_section_id']}}">
														<input type="hidden" name="section_self_rating[{{$val1['template_section_id']}}][]" class="section_self_rating_{{$val1['template_section_id']}}">
														<input type="hidden" name="section_coach_rating[{{$val1['template_section_id']}}][]" class="section_coach_rating_{{$val1['template_section_id']}}">
														<input type="hidden" name="section_total_weight_ave[{{$val1['template_section_id']}}][]" class="section_total_weight_ave_{{$val1['template_section_id']}}" value="{{ $total_weighted_average }}">
														<input type="hidden" name="section_coach_section_rating[{{$val1['template_section_id']}}][]" class="section_coach_section_rating_{{$val1['template_section_id']}}" value="{{ $coach_total_weighted_average }}">
														<input type="hidden" name="section_weight[{{$val1['template_section_id']}}][]" class="section_weight_{{$val1['template_section_id']}}" value="{{ $val1['weight'] }}">
														<input type="hidden" name="section_total_weighted_score[{{$val1['template_section_id']}}][]" class="section_total_weighted_score_{{$val1['template_section_id']}}" value="{{ $total_weighted_score }}">
														<input type="hidden" name="section_coach_total_weighted_score[{{$val1['template_section_id']}}][]" class="section_coach_total_weighted_score_{{$val1['template_section_id']}}" value="{{ $coach_total_weighted_score }}">
														@if($val1['is_core'] == 0)
															<tr>
																<td colspan="4" class="bold">
																	{{ $val1['template_section'] }}
																</td>
																<td class="self_section_rating_{{ $val1['template_section_id'] }}">
																	<?php echo ($total_weighted_average != '' ? $total_weighted_average : '&nbsp;') ?>
																</td>
																<td class="coach_section_rating_{{ $val1['template_section_id'] }}">
																	<?php echo ($coach_total_weighted_average != '' ? $coach_total_weighted_average : '&nbsp;') ?>
																</td>
																<td>
																	{{ $val1['weight'] }}
																</td>
																<td class="self_total_weighted_{{$val1['template_section_id']}}">
																	<?php echo ($total_weighted_score != '' ? $total_weighted_score : '&nbsp;') ?>
																</td>
																<td class="coach_total_weighted_{{$val1['template_section_id']}}">
																	<?php echo ($coach_total_weighted_score != '' ? $coach_total_weighted_score : '&nbsp;') ?>
																</td>
															</tr>													
															@if(isset($balance_score_card) && $balance_score_card->num_rows() > 0)
																@foreach($balance_score_card->result_array() as $key => $val)
																	<?php
																		$none_core_score_car_library_self_rating = (isset($appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val['scorecard_id']]) ? $appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val['scorecard_id']]['self_rating'] : '');
																		$none_core_score_car_library_coach_rating = (isset($appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val['scorecard_id']]) ? $appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val['scorecard_id']]['coach_rating'] : '');
																	?>																
																	<input type="hidden" name="none_core_score_car_library_key_weight[{{$val1['template_section_id']}}][{{$val['scorecard_id']}}][]" class="none_core_score_car_library_key_weight_{{$val['scorecard_id']}}">
																	<input type="hidden" name="none_core_score_car_library_self_rating[{{$val1['template_section_id']}}][{{$val['scorecard_id']}}][]" class="none_core_score_car_library_self_rating_{{$val['scorecard_id']}}" value="{{ $none_core_score_car_library_self_rating }}">
																	<input type="hidden" name="none_core_score_car_library_coach_rating[{{$val1['template_section_id']}}][{{$val['scorecard_id']}}][]" class="none_core_score_car_library_coach_rating_{{$val['scorecard_id']}}" value="{{ $none_core_score_car_library_coach_rating }}">
																	<input type="hidden" name="none_core_score_car_library_total_weight_ave[{{$val1['template_section_id']}}][{{$val['scorecard_id']}}][]" class="none_core_score_car_library_total_weight_ave_{{$val['scorecard_id']}}">
																	<input type="hidden" name="none_core_score_car_library_section_rating[{{$val1['template_section_id']}}][{{$val['scorecard_id']}}][]" class="none_core_score_car_library_coach_section_rating_{{$val['scorecard_id']}}">
																	<input type="hidden" name="none_core_score_car_library_weight[{{$val1['template_section_id']}}][{{$val['scorecard_id']}}][]" class="none_core_score_car_library_weight_{{$val['scorecard_id']}}">
																	<input type="hidden" name="none_core_score_car_library_total_weighted_score[{{$val1['template_section_id']}}][{{$val['scorecard_id']}}][]" class="none_core_score_car_library_total_weighted_score_{{$val['scorecard_id']}}">
																	<input type="hidden" name="none_core_score_car_library_coach_total_weighted_score[{{$val1['template_section_id']}}][{{$val['scorecard_id']}}][]" class="none_core_score_car_library_coach_total_weighted_score_{{$val['scorecard_id']}}">
																	<tr>
																		<td>
																			<div class="padding-left-10">{{ $val['scorecard'] }}</div>
																		</td>
																		<td class="key_weight_total_{{$val['scorecard_id']}}"></td>
																		<td class="non_core_self_rating_{{$val['scorecard_id']}}">{{ $none_core_score_car_library_self_rating }}</td>
																		<td class="non_core_coach_rating_{{$val['scorecard_id']}}">{{ $none_core_score_car_library_coach_rating }}</td>
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
																<td colspan="4" class="bold">
																	{{ $val1['template_section'] }}
																</td>
																<td class="self_section_rating_{{ $val1['template_section_id'] }}">
																	<?php echo ($total_weighted_average != '' ? $total_weighted_average : '&nbsp;') ?>
																</td>
																<td class="coach_section_rating_{{ $val1['template_section_id'] }}">
																	<?php echo ($coach_total_weighted_average != '' ? $coach_total_weighted_average : '&nbsp;') ?>
																</td>																
																<td>
																	{{ $val1['weight'] }}
																</td>
																<td class="self_total_weighted_{{$val1['template_section_id']}}">
																	<?php echo ($total_weighted_score != '' ? $total_weighted_score : '&nbsp;') ?>
																</td>
																<td class="coach_total_weighted_{{$val1['template_section_id']}}">
																	<?php echo ($coach_total_weighted_score != '' ? $coach_total_weighted_score : '&nbsp;') ?>
																</td>
															</tr>
															@if(isset($library_competencies) && !empty($library_competencies))
																@foreach($library_competencies[$val1['library_id']] as $key2 => $val2)
																	<?php
																		$core_score_car_library_self_rating = (isset($appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val2->library_value_id]) ? $appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val2->library_value_id]['self_rating'] : '');
																		$core_score_car_library_coach_rating = (isset($appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val2->library_value_id]) ? $appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val2->library_value_id]['coach_rating'] : '');
																	?>																																
																	<input type="hidden" name="core_score_car_library_key_weight[{{$val1['template_section_id']}}][{{$val2->library_value_id}}][]" class="core_score_car_library_key_weight_{{$val2->library_value_id}}">
																	<input type="hidden" name="core_score_car_library_self_rating[{{$val1['template_section_id']}}][{{$val2->library_value_id}}][]" class="core_score_car_library_self_rating_{{$val2->library_value_id}}" value="{{ $core_score_car_library_self_rating }}">
																	<input type="hidden" name="core_score_car_library_coach_rating[{{$val1['template_section_id']}}][{{$val2->library_value_id}}][]" class="core_score_car_library_coach_rating_{{$val2->library_value_id}}" value="{{ $core_score_car_library_coach_rating }}">
																	<input type="hidden" name="core_score_car_library_total_weight_ave[{{$val1['template_section_id']}}][{{$val2->library_value_id}}][]" class="core_score_car_library_total_weight_ave_{{$val2->library_value_id}}">
																	<input type="hidden" name="core_score_car_library_section_rating[{{$val1['template_section_id']}}][{{$val2->library_value_id}}][]" class="core_score_car_library_coach_section_rating_{{$val2->library_value_id}}">
																	<input type="hidden" name="core_score_car_library_weight[{{$val1['template_section_id']}}][{{$val2->library_value_id}}][]" class="core_score_car_library_weight_{{$val2->library_value_id}}">
																	<input type="hidden" name="core_score_car_library_total_weighted_score[{{$val1['template_section_id']}}][{{$val2->library_value_id}}][]" class="core_score_car_library_total_weighted_score_{{$val2->library_value_id}}" value="{{ $total_weighted_score }}">
																	<input type="hidden" name="core_score_car_library_coach_total_weighted_score[{{$val1['template_section_id']}}][{{$val2->library_value_id}}][]" class="core_score_car_library_coach_total_weighted_score_{{$val2->library_value_id}}" value="{{ $coach_total_weighted_score }}">
																	<tr>
																		<td>
																			<div class="padding-left-10">{{ ucwords(strtolower($val2->library_value)) }}</div>
																		</td>
																		<td></td>
																		<td class="core_self_rating_{{$val2->library_value_id}}">{{ $core_score_car_library_self_rating }}</td>
																		<td class="core_coach_rating_{{$val2->library_value_id}}">{{ $core_score_car_library_coach_rating }}</td>
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
												<input type="hidden" name="self_rating" class="self_rating" value="{{$appraisee->self_rating}}">
												<input type="hidden" name="coach_rating" class="coach_rating" value="{{$appraisee->coach_rating}}">
												<tr>
													<td class="bold">Total Weighted Score</td>
													<td class="total_weighted_score"></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td class="bold">Selft Rating</td>
													<td class="self_rating">{{$appraisee->self_rating}}</td>															
												</tr>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td class="bold">Coach Rating</td>
													<td class="coach_rating">{{$appraisee->coach_rating}}</td>															
												</tr>
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
										Appraisal Logs
										<br>
										<span class="text-muted small">Composed of historical logs, date/time and status of planning.</span>
									</td>
									<td>
										<a class="btn btn-primary btn-sm pull-right" data-toggle="modal" href="javascript: view_transaction_logs( {{ $appraisee->appraisal_id }}, {{ $appraisee->user_id }} )"> <i class="fa fa-list"></i> View Appraisal Logs</a>
									</td>
								</tr>
								<tr>
									<td>
										Discussion Logs
										<br>
										<span class="text-muted small">Composed of historical chat logs, date and time of discussion.</span>
									</td>
									<td>
										<button type="button" class="btn blue btn-sm pull-right" onclick="cs_discussion_form(<?php echo $appraisee->appraisal_id?>, '', <?php echo $appraisee->user_id?>, '', true, <?php echo $appraisee->status_id ?>)"> View Discussion</button>
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
						@if(!isset($appraisal_admin) || $appraisal_admin == 0)
							@if(isset($approver_info['performance_status_id']) &&  $approver_info['performance_status_id'] == 2) <!-- current status is for approval which is 2 -->
								<button type="button" class="btn blue btn-sm" onclick="change_status( $(this).closest('form'), 99)"><i class="fa fa-check"></i> Save as Draft</button>
								<button type="button" class="btn green btn-sm" onclick="change_status( $(this).closest('form'), 4)"><i class="fa fa-check"></i> Approved</button>
							@endif
						@else
							@if($appraisee->performance_status_id == 14) <!-- current status is committee rating which is 14 -->
								<button type="button" class="btn green btn-sm" onclick="change_status( $(this).closest('form'), 14)"><i class="fa fa-check"></i> Approved</button>
							@endif
		                @endif
				        <a class="btn default btn-sm" href="{{ $mod->url }}">Back</a>		                
		            </div>
                </div>
            </div>
        </div>
    </div>
</div>
