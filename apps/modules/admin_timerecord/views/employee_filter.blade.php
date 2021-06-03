<div class="">
	<!-- <div class="margin-bottom-15">
		<span class="small text-muted">{{ lang('admin_timerecord.select_company') }}</span>
	</div> -->
	<div class="row">
		<div class="col-md-4">
        	<div class="form-group">
                <?php
                    $qry_category = $mod->get_role_category();
                    $db->where('users_company.deleted',0);
                    if ($qry_category != ''){
                        $db->where($qry_category, '', false);
                    }                               
                    $db->join('users_profile', 'users_profile.company_id = users_company.company_id');
                    $db->join('users', 'users_profile.user_id = users.user_id');
                    $db->group_by('users_company.company_id');
                    $companies = $db->get('users_company');
                ?>
                <select name="company_id" class="form-control select2me" data-placeholder="Select...">
                    <option value="">Select company...</option>
                    <?php
                        foreach( $companies->result() as $company )
                        {
                            echo '<option value="'.$company->company_id.'">'. $company->company . '</option>';
                        }
                    ?>
                </select>
            </div>
		</div>
		<div class="col-md-4">
				<div class="form-group">
                    <div id="department_div">
                        <?php
                            $qry_category = $mod->get_role_category();
                            $db->where('users_department.deleted',0);
                            $db->where('users_department.status_id',1);
                            if ($qry_category != ''){
                                $db->where($qry_category, '', false);
                            }                               
                            $db->order_by('department');
                            $users_department = $db->get('users_department');
                        ?>                         
                        <select id="department_id" name="department_id" class="form-control select2me" data-placeholder="Select..."> 
                            <option value="">Select department...</option>
                            <?php
                                foreach( $users_department->result() as $department )
                                {
                                    echo '<option value="'.$department->department_id.'">'. $department->department . '</option>';
                                }
                            ?>                               
                        </select>
                    </div>
                    <div id="dept_loader" style="display: none;">
                        <img src="{{ theme_path() }}img/ajax-loading.gif" alt="loading..." /> {{ lang('admin_timerecord.fetch_dep') }}
                    </div>
                </div>
		</div>
		<div class="col-md-4">
				<div class="form-group">
                    <div id="partners_div">
                        <?php
                            $qry_category = $mod->get_role_category();
                            $db->where('users.deleted',0);
                            $db->where('users.active',1);
                            if ($qry_category != ''){
                                $db->where($qry_category, '', false);
                            }                               
                            $db->join('users_profile', 'users_profile.user_id = users.user_id');
                            $db->order_by('full_name');
                            $users = $db->get('users');
                        ?>                        
                        <select id="user_id" name="user_id" class="form-control select2me" data-placeholder="Select...">
                            <option value="">Select employee...</option>
                            <?php
                                foreach( $users->result() as $user )
                                {
                                    echo '<option value="'.$user->user_id.'">'. $user->full_name . '</option>';
                                }
                            ?>                            
                        </select>
                    </div>
                    </select>
                    <div id="partners_loader" style="display: none;">
                        <img src="{{ theme_path() }}img/ajax-loading.gif" alt="loading..." /> {{ lang('admin_timerecord.fetch_partner') }}
                    </div>
                </div>
		</div>
	</div>
</div>