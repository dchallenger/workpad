<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('partners.work_assignment') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- START FORM -->
        <div class="form-horizontal" >
			<div class="form-body">	                        	
            	<div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.reports_to') }}</label>
                    <div class="col-md-5">
                    	<?php 	$db->select('user_id,display_name');
                    			$db->where('deleted', '0');
                                $db->where('active', '1');
                                $db->where('user_id <>', '1');
                                $db->order_by('display_name');
                    			$options = $db->get('users');

                    			$users_department_immediate_id_options = array('' => '');
                    			foreach($options->result() as $option)
                    			{
                    				$users_department_immediate_id_options[$option->user_id] = $option->display_name;
                    			} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('users_profile[reports_to_id]',$users_department_immediate_id_options, $record['users_profile.reports_to_id'], 'class="form-control select2me" id="users_profile-reports_to_id" data-placeholder="Select..."') }}
	                        </div> 				</div>	
                </div>
                <div class="form-group hidden">
                    <label class="control-label col-md-3">{{ lang('partners.project_hr') }}</label>
                    <div class="col-md-5">
                        <?php   $db->select('user_id,display_name');
                                $db->where('deleted', '0');
                                $db->where('active', '1');
                                $db->where('user_id <>', '1');
                                $db->order_by('display_name');
                                $options = $db->get('users');

                                $users_department_immediate_id_options = array('' => '');
                                foreach($options->result() as $option)
                                {
                                    $users_department_immediate_id_options[$option->user_id] = $option->display_name;
                                } ?>                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                                </span>
                                {{ form_dropdown('users_profile[project_hr_id]',$users_department_immediate_id_options, $record['users_profile.project_hr_id'], 'class="form-control select2me" id="users_profile-project_hr_id" data-placeholder="Select..."') }}
                            </div>              </div>  
                </div>                
              <!--   <div class="form-group">
                    <label class="control-label col-md-3">Direct Subordinates</label>
                    <div class="col-md-5">
                       <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-user"></i>
                             </span>
                            <select  class="form-control select2me" data-placeholder="Select...">
                            	<option>Select</option>
                            </select>
                        </div>
                    </div>
                </div> -->
                @if(in_array('organization', $partners_keys))
                <div class="form-group ">
                    <label class="control-label col-md-3">{{ lang('partners.org') }}</label>
                    <div class="col-md-5">
                       <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-user"></i>
                             </span>
                            <input type="text" class="form-control" name="partners_personal[organization]" id="partners_personal-organization" value="{{ $record_personal[1]['partners_personal.organization'] }}" placeholder="Enter Organization"/>
                        </div>
                    </div>
                </div>
                @endif
                @if(in_array('division', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.div') }}<span class="required">*</span></label>
                    <div class="col-md-5">
                    	<?php 	$db->select('division_id,division,company_initial');
                    			$db->where('users_division.deleted', '0');
                                $db->order_by('division');
                                $db->join('users_company','users_division.company_id=users_company.company_id');
                    			$options = $db->get('users_division');

                    			$users_profile_division_id_options = array('' => '');
                    			foreach($options->result() as $option)
                    			{
                    				$users_profile_division_id_options[$option->division_id] = $option->division. ' ('.$option->company_initial.')';
                    			} ?>
                    	<div class="input-group">
							<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('users_profile[division_id]',$users_profile_division_id_options, $record['users_profile.division_id'], 'class="form-control select2me" data-placeholder="Select..."') }}
	                    </div>
	                </div>	
                </div>
                @endif
                @if(in_array('department', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.dept') }}<span class="required">*</span></label>
                    <div class="col-md-5">
                        <?php   $db->select('department_id,department');
                                $db->where('deleted', '0');
                                $db->order_by('department');
                                $options = $db->get('users_department');

                                $users_profile_department_id_options = array('' => '');
                                foreach($options->result() as $option)
                                {
                                    $users_profile_department_id_options[$option->department_id] = $option->department;
                                } ?>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                        {{ form_dropdown('users_profile[department_id]',$users_profile_department_id_options, $record['users_profile.department_id'], 'class="form-control select2me" data-placeholder="Select..."') }}
                        </div>
                    </div>  
                </div>
                @endif

                @if(in_array('sbu_unit', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.sbu_unit') }}<span class="required">*</span></label>
                    <div class="col-md-5">
                        <?php   $db->select('sbu_unit_id,sbu_unit,percentage');
                                $db->where('deleted', '0');
                                $options = $db->get('users_sbu_unit');

                                $users_sbu_unit_id_options = array('' => '');
                                foreach($options->result() as $option)
                                {
                                    $users_sbu_unit_id_options[$option->sbu_unit_id] = $option->sbu_unit .' ('.$option->percentage.'%)';
                                } ?>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            <?php
                                $sbu_unit_val = 1;
                                if (!empty($record['users_profile.sbu_unit_id']))
                                    $sbu_unit_val = explode(',', $record['users_profile.sbu_unit_id']);
                            ?>
                            {{ form_multiselect('users_profile[sbu_unit_id][]',$users_sbu_unit_id_options, $sbu_unit_val, 'class="form-control select2me" id="users_profile-sbu_unit" data-placeholder="Select..."') }}
                        </div>
                        <span class="text-muted small">Total Percentage : <span class="total_percentage"></span></span>
                    </div>  
                </div>
                @endif

                @if(in_array('branch', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.branch') }}<span class="required">*</span></label>
                    <div class="col-md-5">
                        <?php   $db->select('branch_id,branch');
                                $db->where('deleted', '0');
                                $options = $db->get('users_branch');

                                $users_profile_branch_id_options = array('' => '');
                                foreach($options->result() as $option)
                                {
                                    $users_profile_branch_id_options[$option->branch_id] = $option->branch;
                                } ?>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                        {{ form_dropdown('users_profile[branch_id]',$users_profile_branch_id_options, $record['users_profile.branch_id'], 'class="form-control select2me" data-placeholder="Select..."') }}
                        </div>
                    </div>  
                </div>
                @endif                  
                @if(in_array('section', $partners_keys))
                <div class="form-group ">
                    <label class="control-label col-md-3">{{ $partners_labels['section'] }}</label>
                    <div class="col-md-5">
                        <?php   
                            $db->select('section_id,section');
                            $db->where('deleted', '0');
                            $options = $db->get('users_section');

                            $users_section_section_id_options = array('' => '');
                            foreach($options->result() as $option)
                            {
                                $users_section_section_id_options[$option->section_id] = $option->section;
                            } 
                        ?>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                        {{ form_dropdown('users_profile[section_id]', $users_section_section_id_options, $record['users_profile.section_id'], 'class="form-control select2me" data-placeholder="Select..."') }}
                        </div>
                    </div>  
                </div>
                @endif
                @if(in_array('group', $partners_keys))              
                <div class="form-group hidden">
                    <label class="control-label col-md-3">{{ lang('partners.group') }}</label>
                    <div class="col-md-5">
                        <?php   $db->select('group_id,group');
                                $db->where('deleted', '0');
                                $options = $db->get('users_group');

                                $users_profile_group_id_options = array('' => '');
                                foreach($options->result() as $option)
                                {
                                    $users_profile_group_id_options[$option->group_id] = $option->group;
                                } ?>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                        {{ form_dropdown('users_profile[group_id]',$users_profile_group_id_options, $record['users_profile.group_id'], 'class="form-control select2me" data-placeholder="Select..."') }}
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
                        {{ form_dropdown('users_profile[project_id]',$users_project, $record['users_profile.project_id'], 'class="form-control select2me" data-placeholder="Select..."') }}
                        </div>
                    </div>  
                </div>
                @if(in_array('start_date', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.start_date') }}</label>
                    <div class="col-md-5">
                        <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
                            <?php if($record['users_profile.start_date'] == 'January 01, 1970') { ?>
                                <input type="text" class="form-control" name="users_profile[start_date]" id="users_profile-start_date" value="" placeholder="{{ lang('common.enter') }} {{ lang('partners.start_date') }}" >
                            <?php } else { ?>
                                <input type="text" class="form-control" name="users_profile[start_date]" id="users_profile-start_date" value="{{ $record['users_profile.start_date'] }}" placeholder="{{ lang('common.enter') }} {{ lang('partners.start_date') }}" >
                            <?php } ?>                            
                            <span class="input-group-btn">
                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                @endif  
                @if(in_array('end_date', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.end_date') }}</label>
                    <div class="col-md-5">
                        <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
                            <?php if($record['users_profile.end_date'] == 'January 01, 1970') { ?>
                                <input type="text" class="form-control" name="users_profile[end_date]" id="users_profile-end_date" value="" placeholder="{{ lang('common.enter') }} {{ lang('partners.end_date') }}" >
                            <?php } else { ?>
                                <input type="text" class="form-control" name="users_profile[end_date]" id="users_profile-end_date" value="{{ $record['users_profile.end_date'] }}" placeholder="{{ lang('common.enter') }} {{ lang('partners.end_date') }}" >
                            <?php } ?> 
                            <span class="input-group-btn">
                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
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
                                if (!empty($record['users_profile.coordinator_id']))
                                    $coordinator_val = explode(',', $record['users_profile.coordinator_id']);
                            ?>
                            {{ form_multiselect('users_profile[coordinator_id][]',$users_coordinator_id_options, $coordinator_val, 'class="form-control select2me" id="users_profile-coordinator_id" data-placeholder="Select..."') }}
                        </div>              
                    </div>  
                </div>
                @endif 
                @if(in_array('credit_setup', $partners_keys))
                <div class="form-group hidden">
                    <label class="control-label col-md-3">{{ lang('partners.credit_setup') }}</label>
                    <div class="col-md-5">
                        <?php   
                            $db->select('class_id,class');
                            $db->where('deleted', '0');
                            $db->where('form_code', 'LIP');
                            $options = $db->get('time_form_balance_credit_class');

                            $users_credit_class_options = array('' => '');
                            foreach($options->result() as $option)
                            {
                                $users_credit_class_options[$option->class_id] = $option->class;
                            } 
                        ?>                            
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            {{ form_dropdown('users_profile[credit_setup_id]',$users_credit_class_options, $record['users_profile.credit_setup_id'], 'class="form-control select2me" id="users_profile-credit_setup" data-placeholder="Select..."') }}
                        </div>              
                    </div>  
                </div>
                @endif                                    
                @if(in_array('home_leave', $partners_keys))
                <div class="form-group" hidden>
                    <label class="control-label col-md-3" style="margin-top: 0px;">{{ lang('partners.home_leave') }}</label>
                    <div class="col-md-5">
                        <div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
                            <input type="checkbox" value="1" @if( $personal_home_leave ) checked="checked" @endif name="partners_personal[home_leave][temp]" id="partners_personal-home_leave-temp" class="dontserializeme toggle"/>
                            <input type="hidden" name="partners_personal[home_leave]" id="partners_personal-home_leave" value="@if( $personal_home_leave ) 1 else 0 @endif"/>
                        </div> 
                    </div>
                </div>
                @endif                                                               
            </div>
            <div class="form-actions fluid">
                <div class="row" align="center">
                    <div class="col-md-12">
                        <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )"><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
                        <button class="btn blue btn-sm form-undo" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>                               
                        <a href="<?php echo $back_url;?>" class="btn default btn-sm">{{ lang('common.back_to_list') }}</a>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>