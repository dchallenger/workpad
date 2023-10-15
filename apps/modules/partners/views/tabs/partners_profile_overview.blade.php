	<div class="row" id="profile_overview">
		<div class="col-lg-3 col-md-4" style="margin-bottom:50px">
			<ul class="ver-inline-menu tabbable">
				<li class="active">
					<a data-toggle="tab" href="#overview_tab1"><i class="fa fa-gear"></i>{{ lang('partners.employment') }}</a>
					<span class="after"></span>
				</li>
				<li><a data-toggle="tab" href="#overview_tab16"><i class="fa fa-list"></i>{{ lang('partners.benefits') }}</a></li>
				<li><a data-toggle="tab" href="#overview_tab2"><i class="fa fa-phone"></i>{{ lang('partners.contacts') }}</a></li>
				<li class="hidden"><a data-toggle="tab" href="#overview_tab17"><i class="fa fa-money"></i>{{ lang('partners.cost_center') }}</a></li>
				<li><a data-toggle="tab" href="#overview_tab15"><i class="fa fa-list"></i>{{ lang('partners.id_nos') }}</a></li>
				<li><a data-toggle="tab" href="#overview_tab3"><i class="fa fa-user"></i>{{ lang('partners.personal') }}</a></li>
				<li><a data-toggle="tab" href="#overview_tab14"><i class="fa fa-group"></i>{{ lang('partners.family') }}</a></li>
			</ul>
		</div>
		<div class="tab-content col-lg-9 col-md-8" >
			<div class="tab-pane active" id="overview_tab1">
				<!-- Company Information -->
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">{{ lang('partners.company_info') }}</div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.company') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="companyname">{{$profile_company}}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.location') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="location">{{$location}}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.pos_title') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="position-title">{{$position}}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row ">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.role') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="role-permission">{{$permission}}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.id_no') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="id-number">{{$id_number}}</span>
									</div>
								</div>
							</div>
						</div>
                		@if(in_array('old_id_number', $partners_keys))
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ $partners_labels['old_id_number'] }} :</label>
										<div class="col-md-7 col-sm-7">
											<span id="id-number">{{$old_id_number}}</span>
										</div>
									</div>
								</div>
							</div>
						@endif
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.biometric') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="biometric">{{$biometric}}</span>
									</div>
								</div>
							</div>
						</div>
<!-- 						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.work_sched') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="shift">{{$shift}}</span>
									</div>
								</div>
							</div>
						</div> -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.work_sched') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="shift">{{$calendar}}</span>
									</div>
								</div>
							</div>
						</div>						
					</div>
				</div>
				<!-- Employment Information -->
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">{{ lang('partners.employment_info') }}</div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
							 		<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('common.status') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="employment-status">{{$status}}</span>
									</div>
								</div>
							</div>
						</div>
						@if( in_array('job_level', $partners_keys) )
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.rank') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="job-class">{{$job_level}}</span>
									</div>
								</div>
							</div>
						</div>
						@endif						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.level') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="employment-type">{{$type}}</span>
									</div>
								</div>
							</div>
						</div>
						@if( in_array('employee_grade', $partners_keys) )
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.employee_grade') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="job-class">{{$record['employee_grade']}}</span>
									</div>
								</div>
							</div>
						</div>
						@endif
						<div class="row hidden">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">Classification :</label>
									<div class="col-md-7 col-sm-7">
										<span id="employment-type">{{$classification}}</span>
									</div>
								</div>
							</div>
						</div>
		                @if(in_array('original_date_hired', $partners_keys))
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.ohire_date') }} :</label>
										<div class="col-md-7 col-sm-7">
											<span id="lastname">{{$original_date_hired}}</span>
										</div>
									</div>
								</div>
							</div>
	                	@endif
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="hidden" value="{{$date_hired}}" id="partners-effectivity_date">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.hire_date') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="date-hired">{{$date_hired}}</span>
										<br>
										<span class="text-muted small calculatedservice"></span>
									</div>
								</div>
							</div>
						</div>
		                <div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.regularization_date') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="employment-type">{{$regularization_date}}</span>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.last_promotion_date') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="lastname">{{$last_promotion_date}}</span>
									</div>
								</div>
							</div>
						</div>
	                	@if(in_array('probationary_date', $partners_keys))
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ $partners_labels['probationary_date'] }} :</label>
										<div class="col-md-7 col-sm-7">
											<span id="lastname">{{$employment_end_date}}</span>
										</div>
									</div>
								</div>
							</div>
		                @endif						
	                	@if(in_array('last_probationary', $partners_keys))
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.last_probi') }} :</label>
										<div class="col-md-7 col-sm-7">
											<span id="lastname">{{$last_probationary}}</span>
										</div>
									</div>
								</div>
							</div>
	                	@endif
	                	@if(in_array('last_salary_adjustment', $partners_keys))
							<div class="row ">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.last_sa') }} :</label>
										<div class="col-md-7 col-sm-7">
											<span id="lastname">{{$last_salary_adjustment}}</span>
										</div>
									</div>
								</div>
							</div>
	                	@endif
						<div class="row ">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.benefit_package') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="lastname">{{$old_new}}</span>
									</div>
								</div>
							</div>
						</div>	                	
					</div>
				</div>
				<!-- Work Assignment Information -->
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">{{ lang('partners.work_assignment') }}</div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.reports_to') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="reports-to">{{$reports_to}}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row hidden">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.project_hr') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="reports-to">{{$project_hr}}</span>
									</div>
								</div>
							</div>
						</div>						
                		@if(in_array('organization', $partners_keys))
						<div class="row ">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.org') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="organization">{{$organization}}</span>
									</div>
								</div>
							</div>
						</div>
                		@endif
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.div') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="position-title">{{$division}}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">Cost Center Code :</label>
									<div class="col-md-7 col-sm-7">
										<span id="position-title">{{$cost_center_code}}</span>								
									</div>
								</div>
							</div>
						</div>						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.dept') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="role-permission">{{$department}}</span>
									</div>
								</div>
							</div>
						</div>
						@if(in_array('section', $partners_keys))
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ $partners_labels['section'] }} :</label>
										<div class="col-md-7 col-sm-7">
											<span id="role-permission">{{ $record['section'] or '' }}</span>
										</div>
									</div>
								</div>
							</div>
						@endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ $partners_labels['project_id'] }} :</label>
                                    <div class="col-md-7 col-sm-7">
                                        <span id="role-permission">{{$project}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>                     
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ $partners_labels['start_date'] }} :</label>
                                    <div class="col-md-7 col-sm-7">
                                        <span id="role-permission">{{$start_date}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ $partners_labels['end_date'] }} :</label>
                                    <div class="col-md-7 col-sm-7">
                                        <span id="role-permission">{{$end_date}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
						@if(in_array('work_schedule_coordinator', $partners_keys))
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ $partners_labels['work_schedule_coordinator'] }} :</label>
										<div class="col-md-7 col-sm-7">
											<span id="role-permission">{{ $coordinator }}</span>
										</div>
									</div>
								</div>
							</div>
						@endif     
						@if(in_array('credit_setup', $partners_keys))
							<div class="row hidden">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ $partners_labels['credit_setup'] }} :</label>
										<div class="col-md-7 col-sm-7">
											<span id="role-permission">{{ $credit_setup }}</span>
										</div>
									</div>
								</div>
							</div>
						@endif     						                        
						@if(in_array('home_leave', $partners_keys))
							<div class="row" hidden>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ $partners_labels['home_leave'] }} :</label>
										<div class="col-md-7 col-sm-7">
											<span id="role-permission">{{ $personal_home_leave }}</span>
										</div>
									</div>
								</div>
							</div>
						@endif                                                                                             
					</div>
				</div>
				<!-- sbu unit -->
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">{{ lang('partners.sbu_unit') }}</div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.sbu_unit') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="reports-to">{{$sbu_unit}}</span>
									</div>
								</div>
							</div>
						</div>
	                    <?php
	                        $sbu_unit_details = explode(',', $sbu_unit_details);
	                    ?>
	                    @if(!empty($sbu_unit) && $sbu_unit != 'n/a')
	                        @foreach(explode(',',$sbu_unit) as $key => $val)
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ $val }} :</label>
											<div class="col-md-7 col-sm-7">
												<span id="reports-to">@if($sbu_unit_details[$key] != 'n/a') {{$sbu_unit_details[$key]}}% @else {{$sbu_unit_details[$key]}} @endif</span>
											</div>
										</div>
									</div>
								</div>                
	                        @endforeach

	                        @if (array_sum($sbu_unit_details) > 0)
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 text-right text-muted">Total:</label>
											<div class="col-md-7 col-sm-7">
												<span>{{array_sum($sbu_unit_details)}}%</span>
											</div>
										</div>
									</div>
								</div>                         
							@endif
	                    @endif
					</div>
				</div>
			</div>
			<div class="tab-pane" id="overview_tab2">
				<!-- Contact Information -->
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">{{ lang('partners.personal_contact') }}</div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
		                <div>&nbsp;&nbsp;Present Address:</div>
		                <br>		
		                @if(in_array('address_1', $partners_keys))
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.address') }} :</label>
											<div class="col-md-7 col-sm-7">
												<span id="lastname">{{$complete_address}}</span>
											</div>
										</div>
									</div>
								</div>
		                @endif	
		                @if(in_array('city_town', $partners_keys))
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.city') }} :</label>
											<div class="col-md-7 col-sm-7">
												<span id="lastname">{{$profile_live_in}}</span>
											</div>
										</div>
									</div>
								</div>
		                @endif
		                @if(in_array('country', $partners_keys))
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.country') }} :</label>
											<div class="col-md-7 col-sm-7">
												<span id="lastname">{{$country}}</span>
											</div>
										</div>
									</div>
								</div>
		                @endif		                
		                @if(in_array('zip_code', $partners_keys))
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.zip') }} :</label>
											<div class="col-md-7 col-sm-7">
												<span id="lastname">{{$zip_code}}</span>
											</div>
										</div>
									</div>
								</div>
		                @endif
		                <div>&nbsp;&nbsp;Permanent Address:</div>
		                <br>		
		                @if(in_array('permanent_address', $partners_keys))
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.address') }} :</label>
											<div class="col-md-7 col-sm-7">
												<span id="lastname">{{$permanent_address}}</span>
											</div>
										</div>
									</div>
								</div>
		                @endif	
		                @if(in_array('permanent_city_town', $partners_keys))
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.city') }} :</label>
											<div class="col-md-7 col-sm-7">
												<span id="lastname">{{$permanent_city_town}}</span>
											</div>
										</div>
									</div>
								</div>
		                @endif
		                @if(in_array('permanent_country', $partners_keys))
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.country') }} :</label>
											<div class="col-md-7 col-sm-7">
												<span id="lastname">{{$permanent_country}}</span>
											</div>
										</div>
									</div>
								</div>
		                @endif		                
		                @if(in_array('permanent_zipcode', $partners_keys))
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.zip') }} :</label>
											<div class="col-md-7 col-sm-7">
												<span id="lastname">{{$permanent_zipcode}}</span>
											</div>
										</div>
									</div>
								</div>
		                @endif
		                <div>&nbsp;&nbsp;Office:</div>
		                <br>	
		                @if(in_array('phone', $partners_keys))
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.phone') }} :</label>
										<div class="col-md-7 col-sm-7">
											<span id="phone"><?=$office_telephones?></span>
										</div>
									</div>
								</div>
							</div>
		                @endif
		                @if(in_array('mobile', $partners_keys))
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.mobile') }} :</label>
										<div class="col-md-7 col-sm-7">
											<span id="lastname"><?=$office_mobiles?></span>
										</div>
									</div>
								</div>
							</div>
		                @endif					
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.email') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="lastname">{{$profile_email}}</span>
									</div>
								</div>
							</div>
						</div>
		                <div>&nbsp;&nbsp;Personal:</div>
		                <br>	
		                @if(in_array('personal_phone', $partners_keys))
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.phone') }} :</label>
										<div class="col-md-7 col-sm-7">
											<span id="phone"><?=$personal_telephone?></span>
										</div>
									</div>
								</div>
							</div>
		                @endif
		                @if(in_array('personal_mobile', $partners_keys))
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.mobile') }} :</label>
										<div class="col-md-7 col-sm-7">
											<span id="lastname"><?=$personal_mobile?></span>
										</div>
									</div>
								</div>
							</div>
		                @endif					
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.email') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="lastname">{{$personal_email}}</span>
									</div>
								</div>
							</div>
						</div>						
					</div>
				</div>
				<!-- Company Information -->
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">{{ lang('partners.emergency_contact') }}</div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
                @if(in_array('emergency_name', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.name') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="emergency-name">{{$emergency_name}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
                @if(in_array('emergency_relationship', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.relationship') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="emergency-relationship">{{$emergency_relationship}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
                @if(in_array('emergency_phone', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.phone') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="emergency-phone">{{$emergency_phone}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
                @if(in_array('emergency_mobile', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.mobile') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="emergency-mobile">{{$emergency_mobile}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
                @if(in_array('emergency_address', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.address') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="emergency-address">{{$emergency_address}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
                @if(in_array('emergency_city', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.city') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="emergency-city">{{$emergency_city}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
                @if(in_array('emergency_country', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.country') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="emergency-country">{{$emergency_country}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
                @if(in_array('emergency_zip_code', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.zip') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="emergency-zipcode">{{$emergency_zip_code}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
					</div>
				</div>
			</div>
			<div class="tab-pane" id="overview_tab16">
				<!-- Benefit Information -->
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">{{ lang('partners.benefits') }}</div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.benefit_type') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="lastname">{{$benefit_type}}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.benefits') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="lastname">{{$benefit}}</span>
									</div>
								</div>
							</div>
						</div>
		            </div>
		        </div>
		    </div>
			<div class="tab-pane" id="overview_tab17">
				<!-- Cost Center Information -->
				<?php
	                $cost_center = '';				
					if (isset($cost_center_tab[1]) && isset($cost_center_tab[1]['cost_center-cost_center'])) {
	            		$db->select('project_id,project');
	            		$db->where('project_id', $cost_center_tab[1]['cost_center-cost_center']);
	                    $db->where('deleted', '0');
	                    $project = $db->get('users_project');
	                    if ($project && $project->num_rows() > 0) {
	                    	$cost_center = $project->row()->project;
	                    }
					}
				?>
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">{{ lang('partners.cost_center') }}</div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.cost_center') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="lastname">{{$cost_center}}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.code') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="lastname">{{$cost_center_tab[1]['cost_center-code']}}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.percentage') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="lastname">{{$cost_center_tab[1]['cost_center-percentage']}}</span>
									</div>
								</div>
							</div>
						</div>
		            </div>
		        </div>
		    </div>
			<div class="tab-pane" id="overview_tab15">
				<!-- ID Numbers -->
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">{{ lang('partners.id_no') }}</div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
                	@if(in_array('taxcode', $partners_keys))
                        <div class="row hidden">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-5 col-sm-5 text-right text-muted">{{ $partners_labels['taxcode'] }} :</label>
                                    <div class="col-md-6 col-sm-6">
                                        <span id="emergency-name">{{$record['taxcode']}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                	@endif
               		@if(in_array('sss_number', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-5 col-sm-5 text-right text-muted">{{ $partners_labels['sss_number'] }} :</label>
									<div class="col-md-6 col-sm-6">
										<span id="emergency-name">{{$record['sss_number']}}</span>
									</div>
								</div>
							</div>
						</div>
                	@endif
                	@if(in_array('pagibig_number', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-5 col-sm-5 text-right text-muted">{{ $partners_labels['pagibig_number'] }} :</label>
									<div class="col-md-6 col-sm-6">
										<span id="emergency-name">{{$record['pagibig_number']}}</span>
									</div>
								</div>
							</div>
						</div>
                	@endif
                	@if(in_array('philhealth_number', $partners_keys))
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-5 col-sm-5 text-right text-muted">{{ $partners_labels['philhealth_number'] }} :</label>
										<div class="col-md-6 col-sm-6">
											<span id="emergency-name">{{$record['philhealth_number']}}</span>
										</div>
									</div>
								</div>
							</div>
                	@endif
                	@if(in_array('tin_number', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-5 col-sm-5 text-right text-muted">{{ $partners_labels['tin_number'] }} :</label>
									<div class="col-md-6 col-sm-6">
										<span id="emergency-name">{{$record['tin_number']}}</span>
									</div>
								</div>
							</div>
						</div>
                	@endif
                	@if(in_array('bank_account_number_savings', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-5 col-sm-5 text-right text-muted">{{ $partners_labels['bank_account_number_savings'] }} :</label>
									<div class="col-md-6 col-sm-6">
										<span id="emergency-name">{{$record['bank_number_savings']}}</span>
									</div>
								</div>
							</div>
						</div>
                	@endif
                	@if(in_array('bank_account_number_current', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-5 col-sm-5 text-right text-muted">{{ $partners_labels['bank_account_number_current'] }} :</label>
									<div class="col-md-6 col-sm-6">
										<span id="emergency-name">{{$record['bank_number_current']}}</span>
									</div>
								</div>
							</div>
						</div>
                	@endif
                	@if(in_array('payroll_bank_account_number', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-5 col-sm-5 text-right text-muted">{{ $partners_labels['payroll_bank_account_number'] }} :</label>
									<div class="col-md-6 col-sm-6">
										<span id="emergency-name">{{$record['payroll_bank_account_number']}}</span>
									</div>
								</div>
							</div>
						</div>
                	@endif
                	@if(in_array('payroll_bank_name', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-5 col-sm-5 text-right text-muted">{{ $partners_labels['payroll_bank_name'] }} :</label>
									<div class="col-md-6 col-sm-6">
										<span id="emergency-name">{{$record['payroll_bank_name']}}</span>
									</div>
								</div>
							</div>
						</div>
                	@endif                
                	@if(in_array('bank_account_name', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-5 col-sm-5 text-right text-muted">{{ $partners_labels['bank_account_name'] }} :</label>
									<div class="col-md-6 col-sm-6">
										<span id="emergency-name">{{$record['bank_account_name']}}</span>
									</div>
								</div>
							</div>
						</div>
                	@endif
                	@if(in_array('health_care', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-5 col-sm-5 text-right text-muted">{{ $partners_labels['health_care'] }} :</label>
									<div class="col-md-6 col-sm-6">
										<span id="emergency-name">{{$record['health_care']}}</span>
									</div>
								</div>
							</div>
						</div>
                	@endif
                	@if(in_array('drivers_license_no', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-5 col-sm-5 text-right text-muted">{{ $partners_labels['drivers_license_no'] }} :</label>
									<div class="col-md-6 col-sm-6">
										<span id="emergency-name">{{$record['drivers_license_no']}}</span>
									</div>
								</div>
							</div>
						</div>
                	@endif
                	@if(in_array('passport_no', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-5 col-sm-5 text-right text-muted">{{ $partners_labels['passport_no'] }} :</label>
									<div class="col-md-6 col-sm-6">
										<span id="emergency-name">{{$record['passport_no']}}</span>
									</div>
								</div>
							</div>
						</div>
                	@endif
					</div>
				</div>
			</div>
			<div class="tab-pane" id="overview_tab3">
				<!-- Personal Information -->
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">{{ lang('partners.personal') }}</div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
                @if(in_array('gender', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.gender') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="gender">{{$gender}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.bday') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="birthday">{{$profile_birthdate}}</span>
									</div>
								</div>
							</div>
						</div>
                @if(in_array('birth_place', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.birthplace') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="place-of-birth">{{$birth_place}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
                @if(in_array('religion', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.religion') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="religion">{{$religion}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
                @if(in_array('nationality', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.nationality') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="nationality">{{$nationality}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
                @if(in_array('civil_status', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.civil_status') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="civil-status">{{$profile_civil_status}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
                @if(in_array('marriage_date', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.date_marriage') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="civil-status">{{$marriage_date}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif                
                @if(in_array('solo_parent', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.solo_parent') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="civil-status">{{$personal_solo_parent}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
                @if(in_array('with_parking', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ $partners_labels['with_parking'] }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="civil-status">{{$with_parking}}</span>
									</div>
								</div>
							</div>
						</div>
                @endif
					</div>
				</div>
				<!-- Other Personal Information -->
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">{{ lang('partners.other_info') }}</div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
                		@if(in_array('height', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.height') }} (in cm) :</label>
									<div class="col-md-7 col-sm-7">
										<span id="height">{{$height}}</span>
									</div>
								</div>
							</div>
						</div>
                		@endif
                		@if(in_array('weight', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.weight') }} (in kgs) :</label>
									<div class="col-md-7 col-sm-7">
										<span id="weight">{{$weight}}</span>
									</div>
								</div>
							</div>
						</div>
                		@endif
                		@if(in_array('blood_type', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.blood_type') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="blood_type">{{$blood_type}}</span>
									</div>
								</div>
							</div>
						</div>
                		@endif                		
                		@if(in_array('interests_hobbies', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.hobby') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="interest-hobbies">{{$interests_hobbies}}</span>
									</div>
								</div>
							</div>
						</div>
                		@endif
                		@if(in_array('language', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.languages') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="language-known">{{$language}}</span>
									</div>
								</div>
							</div>
						</div>
                		@endif
                		@if(in_array('dialect', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.dialects') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="dialect-known">{{$dialect}}</span>
									</div>
								</div>
							</div>
						</div>
                		@endif
                		@if(in_array('dependents_count', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.no_dependents') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="no-of-dependents">{{$dependents_count}}</span>
									</div>
								</div>
							</div>
						</div>
                		@endif
                		@if(in_array('number_children', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.number_children') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="no-of-dependents">{{$number_children}}</span>
									</div>
								</div>
							</div>
						</div>
                		@endif                
					</div>
				</div>
			</div>

			<div class="tab-pane " id="overview_tab14">
				@if(sizeof($family_tab) == 0)
					<div class="portlet">
						<div class="portlet-title">
							<div id="family-relationship[1]" class="caption">{{ lang('partners.family') }}</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
							</div>
						</div>
						<div class="portlet-body form">
							<!-- START FORM -->
							<div id="no_record" class="well" style="">
								<p class="bold"><i class="fa fa-exclamation-triangle"></i> {{ lang('common.no_record_found') }} </p>
								<span><p class="small margin-bottom-0">{{ lang('partners.no_info_fam') }}</p></span>
							</div>
						</div>
					</div>
				@endif
				<!-- Family Information -->
				<?php foreach($family_tab as $index => $family){ 	
					$family_age = '';				
					if (isset($family['family-birthdate'])) {
				        //date in mm/dd/yyyy format; or it can be in other formats as well
				        $birthDate = date('m/d/Y', strtotime($family['family-birthdate']));
				        //explode the date to get month, day and year
				        $birthDate = explode("/", $birthDate);
				        //get age from date or birthdate
				        $family_age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
				                ? ((date("Y") - $birthDate[2]) - 1)
				                : (date("Y") - $birthDate[2]));
			       	}
					?>
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption" id="family-relationship[1]"><?php 
						$family_relationship = (isset($family['family-relationship']) ? $family['family-relationship'] : "");
						echo $family_relationship; ?>
						</div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.name') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="family-name[1]"><?php echo (isset($family['family-name']) ? $family['family-name'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.bday') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="family-birthdate[1]"><?php echo (isset($family['family-birthdate']) ? $family['family-birthdate'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners.age') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="family-year-to[1]"><?php echo $family_age; ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row hidden">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">Dependent :</label>
									<div class="col-md-7 col-sm-7">
										<span id="civil-status"><?php echo (isset($family['family-dependent']) ? $family['family-dependent'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						@if(in_array('family-dependent-hmo', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{$partners_labels['family-dependent-hmo']}} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="civil-status"><?php echo (isset($family['family-dependent-hmo']) ? $family['family-dependent-hmo'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>						
						@endif
						@if(in_array('family-dependent-insurance', $partners_keys))
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{$partners_labels['family-dependent-insurance']}} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="civil-status"><?php echo (isset($family['family-dependent-insurance']) ? $family['family-dependent-insurance'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>							
						@endif						
					</div>
				</div>
				<?php } ?>
			</div>

		</div>
	</div>
