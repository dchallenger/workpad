<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('annual_manpower_planning.amp') }}</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<input type="hidden" name="view_type" id="view_type" value="<?php echo $record['view_type'] ?>">
		<div class="form-group">
			<label class="control-label col-md-4"><span class="required">* </span>{{ lang('annual_manpower_planning.year') }}</label>
			<div class="col-md-5">
				<input type="text" class="form-control" name="recruitment_manpower_plan[year]" id="recruitment_manpower_plan-year" value="{{ $record['recruitment_manpower_plan.year'] }}" placeholder="Enter Year" {{ $record['readonly'] }}/>
			</div>	
		</div>
		<div class="form-group" hidden>
			<label class="control-label col-md-4"><span class="required">* </span>{{ lang('annual_manpower_planning.company') }}</label>
			<div class="col-md-5"><?php
				$db->select('company_id,company');
                $db->order_by('company', '0');
        		$db->where('deleted', '0');
        		$options = $db->get('users_company');
        		$recruitment_manpower_plan_company_id_options = array('' => 'Select...');
        		foreach($options->result() as $option)
        		{
        			$recruitment_manpower_plan_company_id_options[$option->company_id] = $option->company;
        		} ?>        		
				<input type="text" disabled class="form-control dontserializeme" name="" id="" value="{{ $record['recruitment_manpower_plan.company'] }}" placeholder="Enter Company" />	
        		<div class="input-group hidden">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('recruitment_manpower_plan[company_id]',$recruitment_manpower_plan_company_id_options, $record['recruitment_manpower_plan.company_id'], 'class="form-control select2me" data-placeholder="Select..." id="recruitment_manpower_plan-company_id" ') }}
                </div>
            </div>	
		</div>

		<div class="form-group">
			<label class="control-label col-md-4"><span class="required">* </span>{{ lang('annual_manpower_planning.division') }} </label>
			<div class="col-md-5"><?php
				$db->select('division_id,division,company_initial');
				$db->order_by('division', '0');
				$db->where('users_division.deleted', '0');
				$db->join('users_company','users_division.company_id=users_company.company_id');
				$options = $db->get('users_division');
				$recruitment_manpower_plan_division_id_options = array('' => '');
				foreach($options->result() as $option)
				{
					$recruitment_manpower_plan_division_id_options[$option->division_id] = $option->division. ' ('.$option->company_initial.')';
				} ?>							
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
					{{ form_dropdown('recruitment_manpower_plan[division_id]',$recruitment_manpower_plan_division_id_options, $record['recruitment_manpower_plan.division_id'], 'class="form-control select2me" data-placeholder="Select..." id="recruitment_manpower_plan-division_id" '.$record['disabled'].'') }}
				</div> 				
			</div>	
		</div>	

		<div class="form-group">
			<label class="control-label col-md-4">{{ lang('annual_manpower_planning.division_head') }}</label>
			<div class="col-md-5">
				<input type="text" class="form-control dontserializeme" name="recruitment_manpower_plan[divisionhead]" id="recruitment_manpower_plan-divisionhead" readonly value="{{ $record['recruitment_manpower_plan.divisionhead'] }}" placeholder="Enter Division Head" />
			</div>	
		</div>

		<div class="form-group">
			<label class="control-label col-md-4"><span class="required">* </span>{{ lang('annual_manpower_planning.dept') }} </label>
			<div class="col-md-5"><?php
				$db->select('department_id,department');
				$db->order_by('department', '0');
				$db->where('deleted', '0');
				$options = $db->get('users_department');
				$recruitment_manpower_plan_department_id_options = array('' => '');
				foreach($options->result() as $option)
				{
					$recruitment_manpower_plan_department_id_options[$option->department_id] = $option->department;
				} ?>							
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
					{{ form_dropdown('recruitment_manpower_plan[department_id]',$recruitment_manpower_plan_department_id_options, $record['recruitment_manpower_plan.department_id'], 'class="form-control select2me" data-placeholder="Select..." id="recruitment_manpower_plan-department_id" '.$record['disabled'].'') }}
				</div> 				
			</div>	
		</div>			


		<div class="form-group">
			<label class="control-label col-md-4">{{ lang('annual_manpower_planning.dept_head') }}</label>
			<div class="col-md-5">
				<input type="text" class="form-control dontserializeme" name="recruitment_manpower_plan[departmenthead]" id="recruitment_manpower_plan-departmenthead" readonly value="{{ $record['recruitment_manpower_plan.departmenthead'] }}" placeholder="Enter Department Head" />
			</div>	
		</div>

		<div class="form-group">
			<label class="control-label col-md-4">{{ lang('annual_manpower_planning.created_by') }}</label>
			<div class="col-md-5">
				<?php 
					if($record['created_by'] == ''){
						$created_by = $user['lastname'] . ', '. $user['firstname'];	
					}
					else{
						$created_by = $record['created_by'];
					}
				?>
				<input type="text" class="form-control" readonly name="recruitment_manpower_plan[created_by]" id="recruitment_manpower_plan-created_by" value="{{ $created_by }}" placeholder="Enter Created By" />
			</div>	
		</div>

		<div class="form-group">
			<label class="control-label col-md-4">{{ lang('annual_manpower_planning.attachments') }}</label>
			<div class="col-md-5">
				@if ($record['view_type'] == 'edit')
				<div data-provides="fileupload" class="fileupload fileupload-new" id="recruitment_manpower_plan-attachment-container">
					<input type="hidden" name="recruitment_manpower_plan[attachment]" id="recruitment_manpower_plan-attachment" value="{{ $record['recruitment_manpower_plan.attachment'] }}"/>
                    <span class="btn default btn-sm btn-file">
                    	<span class="fileupload-new"><i class="fa fa-paper-clip"></i> {{ lang('annual_manpower_planning.browse') }}</span>
                       	<input type="file" id="recruitment_manpower_plan-attachment-fileupload" type="file" name="files[]" multiple="">
                    </span>
                    <ul class="padding-none margin-top-10">
                        @if( !empty($record['recruitment_manpower_plan.attachment']) ) <?php 
							$upload_ids = explode( ',', $record['recruitment_manpower_plan.attachment'] );
							foreach( $upload_ids as $upload_id )
							{
								$upload = $db->get_where('system_uploads', array('upload_id' => $upload_id))->row();
								$file = FCPATH . urldecode( $upload->upload_path );
								if( file_exists( $file ) )
								{
									$f_info = get_file_info( $file );
									$f_type = filetype( $file );

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
									echo '<li class="padding-3 fileupload-delete-'.$upload_id.'" style="list-style:none;">
							            <span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
							            <span>'. basename($f_info['name']) .'</span>
							            <span class="padding-left-10"><a style="float: none;" data-dismiss="fileupload" class="close fileupload-delete" upload_id="'.$upload_id.'" href="javascript:void(0)"></a></span>
							        </li>';
								}
							} ?>
						@endif
                	</ul>
                </div>
                @else
				<?php
					if ($record['recruitment_manpower_plan.attachment'] != ''){
						$upload_ids = explode( ',', $record['recruitment_manpower_plan.attachment'] );
						foreach( $upload_ids as $upload_id )
						{				
							$upload = $db->get_where('system_uploads', array('upload_id' => $upload_id))->row();
							$file = FCPATH . urldecode( $upload->upload_path );
							if( file_exists( $file ) )
							{	
								$f_info = get_file_info( $file );

		                        $notification_link = base_url().$upload->upload_path;						
		                        echo '<div class="input-group">';
		                        echo '<a href="'.$notification_link.'" class="pop-uri" target="_blank">'.basename($f_info['name']).'</a>';
		                        echo '</div>';						
							}
						}						
					}
				?>	                
                @endif
            </div>
        </div>
    </div>
</div>
<div class="portlet plan-details" style="display:none">
	<div class="portlet-title">
		<div class="caption">{{ lang('annual_manpower_planning.planning_details') }}</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<p>{{ lang('annual_manpower_planning.note_planning_details') }}</p>
	<div class="portlet-body form">
		<div class="row profile">
			<div class="col-md-12 margin-top-25">
				<div class="tabbable tabbable-custom tabbable-full-width">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#tab1" data-toggle="tab">{{ lang('annual_manpower_planning.w_incumbent') }}</a>
						</li>
						<li class="">
							<a href="#tab2" data-toggle="tab">{{ lang('annual_manpower_planning.to_hire') }}</a>
						</li>
						<li class="">
							<a href="#tab3" data-toggle="tab">{{ lang('annual_manpower_planning.new_job') }}</a>
						</li>
					</ul>
					<div class="tab-content">
						<div id="tab1" class="tab-pane active">
							<div class="clearfix margin-top-25">
								<div class="panel panel-success">
									<div class="panel-heading">
										<h3 class="panel-title">
											{{ lang('annual_manpower_planning.pos_w_incumbent') }}
										</h3>
									</div>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="13%">{{ lang('annual_manpower_planning.employees') }}
								                </th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_jan') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_feb') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_mar') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_apr') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_may') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_jun') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_jul') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_aug') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_sep') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_oct') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_nov') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_dec') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('annual_manpower_planning.budget') }}</p></th>
											</tr>
										</thead>
										<tbody id="incumbents"></tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="tab2" class="tab-pane">
							<div class="clearfix margin-top-25">
								<div class="panel panel-success">
									<div class="panel-heading">
										<h3 class="panel-title">
											{{ lang('annual_manpower_planning.to_hire') }}
										</h3>
									</div>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="13%">{{ lang('annual_manpower_planning.position') }}
								                </th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_jan') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_feb') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_mar') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_apr') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_may') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_jun') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_jul') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_aug') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_sep') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_oct') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_nov') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('cal_dec') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('annual_manpower_planning.approved') }}</p></th>
												<th width="7%"><p class="small text-success text-center">{{ lang('annual_manpower_planning.budget') }}</p></th>
											</tr>
										</thead>
										<tbody id="positions"></tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="tab3" class="tab-pane">
							<div class="clearfix margin-top-25">
								<div class="portlet">
									<div class="portlet-body form">
										<div class="form-body">
											@if ($record['view_type'] == 'edit')
											<div class="form-group">
						                    	<label class="control-label col-md-4">{{ lang('annual_manpower_planning.position') }}</label>
						                        <div class="col-md-4">
						                            <div class="input-group">
						                                <input type="text" name="new_position-add" class="form-control dontserializeme">
						                                <span class="input-group-btn">
						                                	<button class="btn btn-success" onclick="add_new_job()" type="button"><i class="fa fa-plus"></i></button>
						                                </span>
						                            </div>
						                            <div class="help-block small">
						                            	{{ lang('annual_manpower_planning.enter_job') }}
						                        	</div>
						                        </div>
						                    </div>
						                    @endif
						                    <br>
											<div class="portlet margin-top-25">
												<h5 class="form-section margin-bottom-10"><b>{{ lang('annual_manpower_planning.job_title_list') }}</b></h5>
												<div class="portlet-body">
													<?php
														$months = array(
			                                                '1' => lang('cal_january'),
			                                                '2' => lang('cal_february'),
			                                                '3' => lang('cal_march'),
			                                                '4' => lang('cal_april'),
			                                                '5' => lang('cal_may'),
			                                                '6' => lang('cal_june'),
			                                                '7' => lang('cal_july'),
			                                                '8' => lang('cal_august'),
			                                                '9' => lang('cal_september'),
			                                                '10' => lang('cal_october'),
			                                                '11' => lang('cal_november'),
			                                                '12' => lang('cal_december')
			                                            );

														$jobrank = $db->get_where('users_job_rank', array('deleted' => 0));
			                                            $job_ranks = array();

			                                            if($jobrank->num_rows() > 0){
				                                            foreach($jobrank->result() as $jr)
				                                            {
				                                                $job_ranks[$jr->job_rank_id] = $jr->job_rank;
				                                            }
			                                            }
        
			                                            $job_class = $db->get_where('users_job_class', array('deleted' => 0));
			                                            $job_classes = array('' => 'Select...');
			                                            foreach($job_class->result() as $jclass)
			                                            {
			                                                $job_classes[$jclass->job_class_id] = $jclass->job_class;
			                                            }
			                                            
			                                            $employment_status = $db->get_where('partners_employment_status', array('deleted' => 0));
			                                            $employment_statuss = array('' => 'Select...');
			                                            foreach($employment_status->result() as $etype)
			                                            {
			                                                $employment_statuss[$etype->employment_status_id] = $etype->employment_status;
			                                            }
			                                            
			                                            $users_company = $db->get_where('users_company', array('deleted' => 0));
			                                            $users_companys = array('' => 'Select...');
			                                            foreach($users_company->result() as $company)
			                                            {
			                                                $users_companys[$company->company_id] = $company->company_code;
			                                            }
													?>
													<table class="table table-condensed table-striped table-hover">
							                            <thead>
							                                <tr>
							                                	<th width="19%" class="padding-top-bottom-10">{{ lang('annual_manpower_planning.job_title') }}</th>
							                                	<th width="18%" class="padding-top-bottom-10">Employment Status</th>
							                                	<th width="15%" class="padding-top-bottom-10 hidden">{{ lang('annual_manpower_planning.job_class') }}</th>
							                                	<th width="18%" class="padding-top-bottom-10">{{ lang('annual_manpower_planning.month') }}</th>
							                                	<th width="18%" class="padding-top-bottom-10">{{ lang('annual_manpower_planning.qty') }}</th>
							                                	<th width="15%" class="padding-top-bottom-10 hidden">{{ lang('annual_manpower_planning.budget') }}</th>
							                                	<th width="20%" class="padding-top-bottom-10 hidden">Payroll Under</th>
							                                	@if ($record['view_type'] == 'edit')
							                                	<th width="15%" class="padding-top-bottom-10">{{ lang('common.actions') }}</th>
							                                	@endif
							                                </tr>
							                            </thead>
							                            <tbody class="new-jobs">
							                            <?php
							                            	if( !empty( $record_id ) )
							                            	{
							                            		$new_plans = $mod->get_new_position_plans( $record_id );

			                                            		if(is_array($new_plans)){
								                            		foreach ($new_plans as $plan): ?>
								                            			<tr class="count_newjobs">
								                            				<input type="hidden" name="new_position[id][]" value="{{ $plan->id }}">
																            <td>
																                <input type="text" name="new_position[position][]" maxlength="64" value="{{ $plan->position }}" class="form-control" {{$record['disabled']}}>
																            </td>
																            <td>
																                <?php echo form_dropdown('new_position[employment_status_id][]', $employment_statuss, $plan->employment_status_id, 'class="form-control select2me" data-placeholder="Select..."' . $record["disabled"]) ?>   
																            </td>
																            <td class="hidden">
																                <?php echo form_dropdown('new_position[job_class_id][]', $job_classes, $plan->job_class_id, 'class="form-control select2me" data-placeholder="Select..."' . $record["disabled"]) ?>   
																            </td>
																            <td>
																                <?php echo form_dropdown('new_position[month][]', $months, $plan->month, 'class="form-control select2me" data-placeholder="Select..."' . $record["disabled"]) ?>   
																            </td>
																            <td>
																                <input type="text" maxlength="64" name="new_position[needed][]" value="{{ $plan->needed }}" class="form-control" {{$record['disabled']}}>
																            </td>																            
																            <td class="hidden">
																                <input type="text" maxlength="64" name="new_position[budget][]" value="{{ $plan->budget }}" class="form-control" {{$record['disabled']}}>
																            </td>
																            <td class="hidden">
																                <?php echo form_dropdown('new_position[company_id][]', $users_companys, $plan->company_id, 'class="form-control select2me" data-placeholder="Select..."' . $record["disabled"]) ?>   
																            </td>
																            @if ($record['view_type'] == 'edit')
																            <td>
																                <button class="btn btn-xs text-muted" type="button" onclick="delete_new_position_plan($(this).closest('tr'))"><i class="fa fa-trash-o"></i> {{ lang('common.delete') }}</button>
																            </td>
																            @endif
																        </tr>
								                            		<?php
								                            		endforeach;
								                            	}
							                            	}
							                            	
							                            ?>	
							                            </tbody>
							                        </table>

					                                 <div id="no_recordjobs" class="well" style="display:none;">
					                                    <p class="bold"><i class="fa fa-exclamation-triangle"></i> <?php echo lang('common.no_record_found') ?></p>
					                                    <span><p class="small margin-bottom-0">{{ lang('annual_manpower_planning.no_record_job') }}</p></span>
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
	</div>
</div>

<table style="display:none">
    <tbody class="new-job-row-template">
        <tr class="count_newjobs">
        	<input type="hidden" name="new_position[id][]" value="0">
            <td>
                <input type="text" name="new_position[position][]" maxlength="64" value="" class="form-control dontserializeme">
            </td>
            <td>
                <?php echo form_dropdown('new_position[employment_status_id][]', $employment_statuss, '', 'class="form-control select2menow dontserializeme" data-placeholder="Select..."') ?>   
            </td>
            <td class="hidden">
                <?php echo form_dropdown('new_position[job_class_id][]', $job_classes, '', 'class="form-control select2menow dontserializeme" data-placeholder="Select..."') ?>   
            </td>
            <td>
                <?php echo form_dropdown('new_position[month][]', $months, '', 'class="form-control select2menow dontserializeme" data-placeholder="Select..."') ?>   
            </td>
            <td>
                <input name="new_position[needed][]" type="text" class="form-control" maxlength="64" value="">
            </td>            
            <td class="hidden">
                <input type="text" maxlength="64" name="new_position[budget][]" class="form-control dontserializeme">
            </td>
            <td class="hidden">
                <?php echo form_dropdown('new_position[company_id][]', $users_companys, '', 'class="form-control select2menow dontserializeme" data-placeholder="Select..."') ?>   
            </td>
            <td>
                <button class="btn btn-xs text-muted" type="button" onclick="delete_new_position_plan($(this).closest('tr'))"><i class="fa fa-trash-o"></i> {{ lang('common.delete') }}</button>
            </td>
        </tr>
    </tbody>
</table>