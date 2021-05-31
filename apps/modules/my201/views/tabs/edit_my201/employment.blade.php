<!-- Company Information -->
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('my201.company_info') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- START FORM -->
		<div class="form-horizontal" >
			<div class="form-body">
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 text-right">{{ lang('my201.company') }} </label>
						<div class="col-md-5">
	                    	<div class="input-group">
								<span class="input-group-addon">
	                            	<i class="fa fa-list-ul"></i>
		                        </span>
		                        <input type="text" disabled class="form-control" value="{{ $profile_company }}" >
		                    </div>
		                </div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">{{ lang('my201.location') }} </label>
						<div class="col-md-5">
	                    	<div class="input-group">
	                    		<span class="input-group-addon">
		                            <i class="fa fa-list-ul"></i>
		                        </span>
		                     <input type="text" disabled class="form-control" value="{{ $location }}" >
		                    </div>
		                </div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">{{ lang('my201.position') }} </label>
						<div class="col-md-5">
	                    	<div class="input-group">
	                    		<span class="input-group-addon">
		                            <i class="fa fa-list-ul"></i>
		                        </span>
		                     <input type="text" disabled class="form-control" value="{{ $position }}" >
		                    </div>
		                </div>
					</div>
				</div>

                <div class="form-group ">
                    <label class="control-label col-md-3">{{ lang('partners.role') }}<span class="required">*</span></label>
                    <div class="col-md-5">
                    	<?php 	$db->select('role_id,role');
                                $db->where('role_id >', 1);
                    			$db->where('deleted', '0');
                                $db->order_by('role');
                    			$options = $db->get('roles');

								$users_role_id_options = array('' => '');
	                            foreach($options->result() as $option)
	                            {
	                            	$users_role_id_options[$option->role_id] = $option->role;
	                            } ?>
	                    <div class="input-group">
							<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                        </span>
	                    {{ form_dropdown('users[role_id]',$users_role_id_options, $role_id, 'class="form-control select2me" data-placeholder="Select..." disabled') }}
	                    </div>
	                </div>	
                </div>

				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">{{ lang('my201.id_no') }} </label>
						<div class="col-md-5">
		                     <input type="text" disabled class="form-control" id="id-number" value="{{ $id_number }}" >
		                </div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">{{ lang('my201.biometric') }} </label>
						<div class="col-md-5">
		                     <input type="text" disabled class="form-control" id="ibiometric" value="{{ $biometric }}" >
		                </div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">{{ lang('my201.work_sched') }} </label>
						<div class="col-md-5">
	                    	<div class="input-group">
	                    		<span class="input-group-addon">
		                            <i class="fa fa-list-ul"></i>
		                        </span>
		                     <input type="text" disabled class="form-control" id="shift" value="{{ $shift }}" >
		                    </div>
		                </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
									
<!-- Employment Information -->
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('my201.employment_info') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- START FORM -->
		<div class="form-horizontal" >
			<div class="form-body">
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">{{ lang('my201.status') }} </label>
						<div class="col-md-5">
	                    	<div class="input-group">
	                    		<span class="input-group-addon">
		                            <i class="fa fa-list-ul"></i>
		                        </span>
		                     <input type="text" disabled class="form-control" id="employment-status" value="{{ $status }}" >
		                    </div>
		                </div>
					</div>
				</div>
				@if( in_array('job_class', $partners_keys ))
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3">{{ lang('my201.jobClass') }} </label>
							<div class="col-md-5">
		                    	<div class="input-group">
		                    		<span class="input-group-addon">
			                            <i class="fa fa-list-ul"></i>
			                        </span>
			                     <input type="text" disabled class="form-control" id="shift" value="{{ $job_class }}" >
			                    </div>
			                </div>
			
						</div>
					</div>
				@endif

		        @if( in_array( 'job_level', $partners_keys ))
		            <div class="col-md-12">
		                <div class="form-group">
		                    <label class="control-label col-md-3 col-sm-3">{{ lang('partners.rank') }} </label>
		                    <div class="col-md-5">
		                    	<div class="input-group">
		                    		<span class="input-group-addon">
			                            <i class="fa fa-list-ul"></i>
			                        </span>
			                     <input type="text" disabled class="form-control" id="shift" value="{{ $job_grade }}" >
			                    </div>
			                </div>
		                </div>
		            </div>
		        @endif

				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">{{ lang('partners.level') }} </label>
						<div class="col-md-5">
	                    	<div class="input-group">
	                    		<span class="input-group-addon">
		                            <i class="fa fa-list-ul"></i>
		                        </span>
		                     <input type="text" disabled class="form-control" id="employment-type" value="{{ $type }}" >
		                    </div>
		                </div>
					</div>
				</div>
		        @if( in_array( 'job_rank_level', $partners_keys ))
		            <div class="col-md-12">
		                <div class="form-group">
		                    <label class="control-label col-md-3 col-sm-3">{{ lang('my201.job_rank_level') }} </label>
		                    <div class="col-md-5">
			                    	<div class="input-group">
			                    		<span class="input-group-addon">
				                            <i class="fa fa-list-ul"></i>
				                        </span>
				                     <input type="text" disabled class="form-control" id="shift" value="{{ $record['job_rank_level'] }}" >
				                    </div>
				                </div>
		                </div>
		            </div>
		        @endif

		        @if( in_array( 'pay_level', $partners_keys ))
		            <div class="col-md-12">
		                <div class="form-group">
		                    <label class="control-label col-md-3 col-sm-3">{{ lang('my201.pay_level') }} </label>
		                    <div class="col-md-5">
		                    	<div class="input-group">
		                    		<span class="input-group-addon">
			                            <i class="fa fa-list-ul"></i>
			                        </span>
			                     <input type="text" disabled class="form-control" id="pay_level" value="{{ $record['pay_level'] }}" >
			                    </div>
			                </div>
		                </div>
		            </div>
		        @endif
		        @if( in_array( 'pay_set_rates', $partners_keys ))
		            <div class="col-md-12">
		                <div class="form-group">
		                    <label class="control-label col-md-3 col-sm-3">{{ lang('my201.pay_set_rates') }} </label>
		                    <div class="col-md-5">
		                    	<div class="input-group">
		                    		<span class="input-group-addon">
			                            <i class="fa fa-list-ul"></i>
			                        </span>
			                     <input type="text" disabled class="form-control" id="pay_set_rates" value="{{ $record['pay_set_rates'] }}" >
			                    </div>
			                </div>
		                </div>
		            </div>
		        @endif

		        @if( in_array( 'competency_level', $partners_keys ))
		            <div class="col-md-12">
		                <div class="form-group">
		                    <label class="control-label col-md-3 col-sm-3">{{ lang('my201.competency_level') }} </label>
		                    <div class="col-md-5">
		                    	<div class="input-group">
		                    		<span class="input-group-addon">
			                            <i class="fa fa-list-ul"></i>
			                        </span>
			                     <input type="text" disabled class="form-control" id="competency_level" value="{{ $record['competency_level'] }}" >
			                    </div>
			                </div>
		                </div>
		            </div>
		        @endif

				@if( in_array( 'employee_grade', $partners_keys ))
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3">{{ lang('my201.employee_grade') }} </label>
							<div class="col-md-5">
		                    	<div class="input-group">
		                    		<span class="input-group-addon">
			                            <i class="fa fa-list-ul"></i>
			                        </span>
			                     <input type="text" disabled class="form-control" id="employee_grade" value="{{ $record['employee_grade'] }}" >
			                    </div>
			                </div>
						</div>
					</div>
				@endif

		        @if(in_array('original_date_hired', $partners_keys))
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3">{{ lang('my201.ohire_date') }} </label>
							<div class="col-md-5">
		                   		<div class="input-group input-medium ">
										<input type="text" class="form-control" id="partners-original_date_hired" value="{{ $original_date_hired }}" disabled >
		                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                        </div>
							</div>
						</div>
					</div>
		    	@endif

				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">{{ lang('my201.hire_date') }} </label>
						<div class="col-md-5">
	                   		<div class="input-group input-medium ">
									<input type="text" class="form-control" id="partners-effectivity_date" value="{{ $date_hired }}" disabled >
	                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                        </div>
	                        <span class="text-muted small calculatedservice"></span>
	                    </div>
					</div>
				</div>

                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.regularization_date') }}</label>
                    <div class="col-md-5">
                        <div class="input-group input-medium">
                            <?php if($regularization_date == 'January 01, 1970') { ?>
                                <input type="text" class="form-control" name="partners[regularization_date]" id="partners-regularization_date" value="" placeholder="{{ lang('common.enter') }} {{ lang('partners.regularization_date') }}" >
                            <?php } else { ?>
                                <input type="text" class="form-control" name="partners[regularization_date]" id="partners-regularization_date" value="{{ $regularization_date }}" disabled>
                            <?php } ?>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

				@if(in_array('probationary_date', $partners_keys))
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3">{{ $partners_labels['probationary_date'] }} </label>
							<div class="col-md-5">
		                   		<div class="input-group input-medium ">
										<input type="text" class="form-control" id="partners-probationary_date" value="{{ $probationary_date }}" disabled >
		                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                        </div>
							</div>
						</div>
					</div>
		    	@endif

		        @if(in_array('last_probationary', $partners_keys))
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3">{{ lang('my201.last_probi') }} </label>
							<div class="col-md-5">
		                   		<div class="input-group input-medium ">
										<input type="text" class="form-control" id="partners-last_probationary" value="{{ $last_probationary }}" disabled >
		                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                        </div>
							</div>
						</div>
					</div>
		        @endif

		        @if(in_array('last_salary_adjustment', $partners_keys))
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3">{{ lang('my201.last_sa') }} </label>
							<div class="col-md-5">
		                   		<div class="input-group input-medium ">
										<input type="text" class="form-control" id="partners-last_salary_adjustment" value="{{ $last_salary_adjustment }}" disabled >
		                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                        </div>
							</div>
						</div>
					</div>
		        @endif
                <div class="form-group">
                    <label class="col-md-3 control-label">{{ lang('partners.benefit_package') }}</label>
                    <div class="col-md-5">
                        <div class="radio-list">
                            <label class="radio-inline"><input class="form-filter option" type="radio" name="partners[old_new]" id="optionsRadios2" value="0" @if ($old_new == 0) checked="" @endif disabled>Old</label>
                            <label class="radio-inline"><input class="form-filter option" type="radio" name="partners[old_new]" id="optionsRadios2" value="1" @if ($old_new == 1) checked="" @endif disabled>New</label>
                        </div>                        
                    </div>
                </div>  		        
			</div>
		</div>
	</div>
</div>

<!-- Work Assignment Information -->
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('my201.work_assignment') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- START FORM -->
		<div class="form-horizontal" >
			<div class="form-body">
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">{{ lang('my201.reports_to') }} </label>
						<div class="col-md-5">
	                    	<div class="input-group">
	                    		<span class="input-group-addon">
		                            <i class="fa fa-list-ul"></i>
		                        </span>
		                     <input type="text" disabled class="form-control" id="reports_to" value="{{ $reports_to }}" >
		                    </div>
		                </div>
					</div>
				</div>
		        @if(in_array('organization', $partners_keys))
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3">{{ lang('my201.org') }} </label>
							<div class="col-md-5">
		                    	<div class="input-group">
		                    		<span class="input-group-addon">
			                            <i class="fa fa-list-ul"></i>
			                        </span>
			                     <input type="text" {{ $is_editable['organization'] == 1 ? '' : 'disabled' }} class="form-control" id="organization" value="{{ $organization }}" >
			                    </div>
			                </div>
						</div>
					</div>
		        @endif
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">{{ lang('my201.div') }} </label>
						<div class="col-md-5">
	                    	<div class="input-group">
	                    		<span class="input-group-addon">
		                            <i class="fa fa-list-ul"></i>
		                        </span>
		                     	<input type="text" disabled class="form-control" id="division" value="{{ $division }}" >
		                    </div>
		                </div>
					</div>
				</div>
                @if(in_array('department', $partners_keys))
                <div class="col-md-12">
	                <div class="form-group">
	                    <label class="control-label col-md-3">{{ lang('partners.dept') }}<span class="required">*</span></label>
	                    <div class="col-md-5">
	                    	<div class="input-group">
	                    		<span class="input-group-addon">
		                            <i class="fa fa-list-ul"></i>
		                        </span>
		                     	<input type="text" disabled class="form-control" id="agency_assignment" value="{{ $department }}" >
		                    </div>
		                </div>
	                </div>
            	</div>
                @endif

		        @if(in_array('agency_assignment', $partners_keys))
		            <div class="col-md-12">
		                <div class="form-group">
		                    <label class="control-label col-md-3 col-sm-3">{{ lang('my201.agency_assignment') }} </label>
		                    <div class="col-md-5">
		                    	<div class="input-group">
		                    		<span class="input-group-addon">
			                            <i class="fa fa-list-ul"></i>
			                        </span>
			                     <input type="text" disabled class="form-control" id="agency_assignment" value="{{ $agency_assignment }}" >
			                    </div>
			                </div>
		                </div>
		            </div>
		        @endif
				@if(in_array('section', $partners_keys))
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3">{{ $partners_labels['section']}} </label>
							<div class="col-md-5">
		                    	<div class="input-group">
		                    		<span class="input-group-addon">
			                            <i class="fa fa-list-ul"></i>
			                        </span>
			                     <input type="text" {{ $is_editable['section'] == 1 ? '' : 'disabled' }} class="form-control" id="section" value="{{ $record['section'] or '' }}" >
			                    </div>
			                </div>
						</div>
					</div>
				@endif
                <div class="form-group ">
                    <label class="control-label col-md-3">{{ lang('partners.project_name') }}</label>
                    <div class="col-md-5">
                        <?php   
                            $db->select('project_id,project');
                            $db->where('deleted', '0');
                            $options = $db->get('users_project');

                            $users_project = array('' => '');
                            foreach($options->result() as $option)
                            {
                                $users_project[$option->project_id] = $option->project;
                            } 
                        ?>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                        	{{ form_dropdown('users_profile[project_id]',$users_project, $project_id, 'class="form-control select2me" data-placeholder="Select..." disabled') }}
                        </div>
                    </div>  
                </div>
                @if(in_array('start_date', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.start_date') }}</label>
                    <div class="col-md-5">
                        <div class="input-group input-medium">
                            <?php if($start_date == 'January 01, 1970') { ?>
                                <input type="text" disabled class="form-control" name="users_profile[start_date]" id="users_profile-start_date" value="" placeholder="{{ lang('common.enter') }} {{ lang('partners.start_date') }}" >
                            <?php } else { ?>
                                <input type="text" disabled class="form-control" name="users_profile[start_date]" id="users_profile-start_date" value="{{ $start_date }}" placeholder="{{ lang('common.enter') }} {{ lang('partners.start_date') }}" >
                            <?php } ?>                            
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                @endif  
                @if(in_array('end_date', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.end_date') }}</label>
                    <div class="col-md-5">
                        <div class="input-group input-medium">
                            <?php if($end_date == 'January 01, 1970') { ?>
                                <input type="text" disabled class="form-control" name="users_profile[end_date]" id="users_profile-end_date" value="" placeholder="{{ lang('common.enter') }} {{ lang('partners.end_date') }}" >
                            <?php } else { ?>
                                <input type="text" disabled class="form-control" name="users_profile[end_date]" id="users_profile-end_date" value="{{ $end_date }}" placeholder="{{ lang('common.enter') }} {{ lang('partners.end_date') }}" >
                            <?php } ?> 
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                @endif   
                @if(in_array('work_schedule_coordinator', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.coordinator') }}</label>
                    <div class="col-md-5">
                        <?php   
                            $db->select('user_id,display_name');
                            $db->where('deleted', '0');
                            $db->where('active', '1');
                            $db->where('user_id <>', '1');
                            $db->order_by('display_name');
                            $options = $db->get('users');

                            $users_coordinator_id_options = array('' => '');
                            foreach($options->result() as $option)
                            {
                                $users_coordinator_id_options[$option->user_id] = $option->display_name;
                            } 
                        ?>                            
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            <?php
                                $coordinator_val = 1;
                                if ($coordinator_id != '')
                                    $coordinator_val = explode(',', $coordinator_id);
                            ?>
                            {{ form_multiselect('users_profile[coordinator_id][]',$users_coordinator_id_options, $coordinator_val, 'class="form-control select2me" id="users_profile-coordinator_id" data-placeholder="Select..." disabled') }}
                        </div>              
                    </div>  
                </div>
                @endif                 				
			</div>
		</div>
	</div>
</div>

<!-- Work Assignment Information -->
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('partners.sbu_unit') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- START FORM -->
		<div class="form-horizontal" >
			<div class="form-body">
                @if(in_array('sbu_unit', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.sbu_unit') }}<span class="required">*</span></label>
                    <div class="col-md-5">
                        <?php   $db->select('sbu_unit_id,sbu_unit');
                                $db->where('deleted', '0');
                                $options = $db->get('users_sbu_unit');

                                $users_sbu_unit_id_options = array('' => '');
                                foreach($options->result() as $option)
                                {
                                    $users_sbu_unit_id_options[$option->sbu_unit_id] = $option->sbu_unit;
                                } ?>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            <?php
                                $sbu_unit_val = 1;
                                if (!empty($sbu_unit_id))
                                    $sbu_unit_val = explode(',', $sbu_unit_id);
                            ?>                            
                        	{{ form_dropdown('users_profile[sbu_unit_id]',$users_sbu_unit_id_options, $sbu_unit_val, 'class="form-control select2me" data-placeholder="Select..." disabled') }}
                        </div>
                    </div>  
                </div>
                <div id="sbu_container">
                    <?php
                        $sbu_unit_details = explode(',', $sbu_unit_details);
                    ?>
                    @if(!empty($sbu_unit))
                        @foreach(explode(',',$sbu_unit) as $key => $val)
                            <div class="form-group" data-sbu="{{$val}}">
                                <label class="control-label col-md-3">{{ $val }} (%)</label>
                                <div class="col-md-5">
                                    <input disabled type="text" class="form-control" name="users_profile[sbu_unit_details][]" id="users_profile-sbu_unit_details" value="{{ $sbu_unit_details[$key] }}" data-inputmask="'mask': '9', 'repeat': 3, 'greedy' : false" placeholder="Enter Percentage"/>
                                </div>
                            </div>                        
                        @endforeach
                    @endif
                </div>                
                @endif
	            <div class="form-group total_percentage_container" style="display:@if(!empty($sbu_unit)) block @else none @endif">
	                <label class="control-label col-md-3">Total (%)</label>
	                <div class="col-md-5">
	                    <input readonly type="text" class="form-control" name="" id="total_percentage" value="{{ array_sum($sbu_unit_details) }}"/>
	                </div>
	            </div>                  
			</div>
		</div>
	</div>
</div>                