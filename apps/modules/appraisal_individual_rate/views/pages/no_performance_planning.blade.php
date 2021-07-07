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
										<input type="text" class="form-control" value="{{ $appraisee->immediate }}" readonly>
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
									<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.coach_rating') }}</label>
									<div class="col-md-8">
										<input type="text" name="coach_rating" class="form-control" value="" readonly>
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label class="control-label col-md-4 bold">{{ lang('appraisal_individual_planning.committee_rating') }}</label>
									<div class="col-md-8">
										<input type="text" name="committee_rating" class="form-control" value="" readonly>
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
							if (empty($planning_applicable_fields)): ?>
								<div id="no_record" class="well" style="">
									<p class="bold"><i class="fa fa-exclamation-triangle"></i>No record/s found!</p>
									<span><p class="small margin-bottom-0">Performance Planning not yet accomplished.</p></span>
								</div>								
							<?php else:
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
												@include('edit/sections/balance_scorecard', array('login_user_id' => $login_user_id, 'section_info' => $child,'section_id' => $child->template_section_id, 'header' => $child->header, 'footer' => $child->footer))
											</div> <?php 
											break;
										case 3: //core competencies?>
											<div class="panel panel-success">
												<div class="panel-heading">
													<h3 class="panel-title">
														{{ $child->template_section }} ({{ $child->weight }}%)
													</h3>
												</div>
												@include('edit/sections/competencies', array('login_user_id' => $login_user_id, 'section_info' => $child, 'section_id' => $child->template_section_id, 'library_id' => $child->library_id, 'header' => $child->header, 'footer' => $child->footer))
											</div> <?php
											break;
											case 9: //IDP?>
												<div class="panel panel-success">
													<div class="panel-heading">
														<h3 class="panel-title">
															{{ $child->template_section }} ({{ $child->weight }}%)
														</h3>
													</div>
													@include('edit/sections/idp', array('login_user_id' => $login_user_id, 'section_info' => $child, 'section_id' => $child->template_section_id, 'library_id' => $child->library_id, 'header' => $child->header, 'footer' => $child->footer))
												</div> <?php
												break;											
										default:
									}
								endforeach;	
							endif; ?>						
						</div>
					</div><?php
			endforeach; ?>
		</div>
    </div>
</div>
