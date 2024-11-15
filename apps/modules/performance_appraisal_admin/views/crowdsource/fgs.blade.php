<input type="hidden" name="user_id" value="{{ $appraisee->user_id }}" />
<input type="hidden" name="template_id" value="{{ $appraisee->template_id }}" />
<input type="hidden" name="appraisal_id" value="{{ $appraisee->appraisal_id }}" />
<input type="hidden" name="planning_id" value="{{ $appraisee->planning_id }}" />
<div class="portlet">
	<div class="portlet-title">
		<div class="caption bold">PERFORMANCE APPRAISAL FORM</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body">
		<p class="margin-bottom-25"><label class="bold">{{ $templatefile->template }}</label> <span class="text-muted small">(STRICTLY CONFIDENTIAL)</span>
		<!-- <a class="btn btn-primary btn-sm pull-right" data-toggle="modal" href="javascript: view_transaction_logs( {{ $appraisee->appraisal_id }}, {{ $appraisee->user_id }} )"> <i class="fa fa-list"></i> Appraisal Logs</a> -->
		</p>
		<!-- EMPLOYEES INFO-->
        <div class="portlet">
			<div class="portlet-body">
				<table class="table table-bordered table-striped">
					<tbody>
						<tr class="success">
							<td>
								<div class="form-group">
									<label class="control-label col-md-3 bold">Appraisee</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="{{ $appraisee->fullname }}" readonly>
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label class="control-label col-md-3 bold">Immediate Superior</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="{{ $appraisee->immediate }}" readonly>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<label class="control-label col-md-3 bold">Job Title</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="{{ $appraisee->position }}" readonly>
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label class="control-label col-md-3 bold">Job Title</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="{{ $appraisee->immediate_position }}"  readonly>
									</div>
								</div>
							</td>
						</tr>
						<tr class="success">
							<td>
								<div class="form-group">
									<label class="control-label col-md-3 bold">Date Joined</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="{{ date('M d, Y', strtotime( $appraisee->effectivity_date ) ) }}" readonly>
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label class="control-label col-md-3 bold">Appraisal Period</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="{{ date('M d, Y', strtotime( $appraisee->date_from ) ) }} to {{ date('M d, Y', strtotime( $appraisee->date_to ) ) }}" readonly>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<label class="control-label col-md-3 bold">Subsidiary/Dept.</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="{{ $appraisee->company }}" readonly>
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label class="control-label col-md-3 bold">Appraisal Date</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="<?php if( !empty($appraisee->date) ) echo date('M d, Y', strtotime( $appraisee->date ) )?>"  readonly>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="portlet">
			<div class="portlet-body">
				<div class="row profile">
					<div class="col-md-12">
						<div class="tabbable tabbable-custom tabbable-full-width">
							
							<div class="tab-content">
								<div class="portlet margin-top-15"> <?php
									//get the template
									$sections = $template->build_sections( $appraisee->template_id );
									foreach( $sections as $section ):
										$has_crowdsource = false;
										foreach( $section->children as $child ): 
											if( $child->section_type_id == 4 ) $has_crowdsource = true;
										endforeach;	
										if( $has_crowdsource ) : ?>
											<div class="portlet-title">
												<div class="caption">{{ $section->template_section }}
													@if( !empty( $section->weight ) )
														({{ $section->weight }}%)
													@endif
												</div>
												<div class="tools"><a href="javascript:;" class="collapse"></a></div>
											</div> 
											<div class="portlet-body">
												<div class="clearfix"> <?php
													foreach( $section->children as $child ): 
														switch( $child->section_type_id )
														{
															case 4: //library crowd ?>
																<div class="panel panel-success">
																	<div class="panel-heading">
																		<h3 class="panel-title">
																			{{ $child->template_section }}
																			@if( !empty( $child->weight ) )
																				({{ $child->weight }}%)
																			@endif
																		</h3>
																	</div>
																	@include('crowdsource/sections/library_crowd', array('section_id' => $child->template_section_id, 'header' => $child->header, 'footer' => $child->footer))
																</div> <?php 
															break;
														} 
													endforeach;	?>
												</div>
											</div><?php
										endif;
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
															@if( strtotime($applog['created_on']) && $applog['created_on'] != '1970-01-01' )
																<span class="text-success">{{ date('M d, Y', strtotime($applog['created_on'])) }}</span>
																<br />
																<span id="date_set" class="small text-muted">{{ date('h:i a', strtotime($applog['created_on'])) }}</span>
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
			        					<button type="button" class="btn blue btn-sm pull-right" onclick="cs_discussion_form({{$appraisee->appraisal_id}}, '', {{$appraisee->user_id}}, '', false, -1)"> View Discussion</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
									</div>
								</div>
								<div class="form-actions fluid">
						            <div class="row">
						                <div class="col-md-12">
											<div class="col-md-offset-4 col-md-8">
						                    	<button type="button" class="btn yellow btn-sm" onclick="get_observations( {{$appraisee->year}}, {{$appraisee->user_id}}, '{{$appraisee->fullname}}' )"><i class="fa fa-rss"></i> Observations</button>
												
												@if( $appraisee->status_id == 9 )
													<button type="button" class="btn yellow btn-sm" onclick="cs_discussion_form({{$appraisee->appraisal_id}}, '', {{$appraisee->user_id}}, '', true, 0)"><i class="fa fa-check"></i> For Discussion</button>
													<button type="button" class="btn green btn-sm" onclick="change_status( $(this).closest('form'), 10)"><i class="fa fa-check"></i> Approve</button>
													
													<!-- <button type="button" class="btn blue btn-sm" onclick="cs_discussion_form({{$appraisee->appraisal_id}}, '', {{$appraisee->user_id}}, '', false)"><i class="fa fa-check"></i> Discussion Logs</button> -->

												@elseif($appraisee->status_id == 8) <!-- Waiting for Crowdsource -->
													<button type="button" class="btn green btn-sm" onclick="change_status( $(this).closest('form'), 1)"><i class="fa fa-undo"></i> Back to Appraisee </button>
												@endif

							        			<a class="btn default btn-sm back_button_gray" href="{{ $mod->url }}/index/{{$record_id}}">Back</a>
						                    </div>
						                </div>
						            </div>
						        </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
