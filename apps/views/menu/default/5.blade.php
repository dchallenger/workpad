<li>
		<a href="<?php echo site_url('dashboard');?>" menu_id="1" parent="0">
			<i class="fa fa-home"></i> 
			<span class="title">Dashboard</span>
					</a>
			</li>
	<li>
		<a href="javascript:;" menu_id="2" parent="0">
			<i class="fa fa-user"></i> 
			<span class="title">My Record</span>
							<span class="arrow"></span>
					</a>
					<ul class="sub-menu">
				 
					<li ><a rel="<?php echo site_url('account/calendar');?>" href="<?php echo site_url('account/calendar');?>" menu_id="24" parent="2">Schedule</a></li>
				 
					<li ><a rel="<?php echo site_url('account/profile');?>" href="<?php echo site_url('account/profile');?>" menu_id="23" parent="2">201</a></li>
				 
					<li ><a rel="<?php echo site_url('account/payslip');?>" href="<?php echo site_url('account/payslip');?>" menu_id="95" parent="2">Payroll</a></li>
							</ul>
			</li>
	<li>
		<a href="javascript:;" menu_id="3" parent="0">
			<i class="fa fa-folder-open-o"></i> 
			<span class="title">Employee</span>
							<span class="arrow"></span>
					</a>
					<ul class="sub-menu">
				 
					<li ><a rel="<?php echo site_url('partners/list');?>" href="<?php echo site_url('partners/list');?>" menu_id="31" parent="3">Employee List</a></li>
				 
					<li ><a rel="<?php echo site_url('birthdays');?>" href="<?php echo site_url('birthdays');?>" menu_id="35" parent="3">Birthdays</a></li>
				 
					<li ><a rel="<?php echo site_url('partner/resources');?>" href="<?php echo site_url('partner/resources');?>" menu_id="107" parent="3">Resources</a></li>
							</ul>
			</li>
	<li>
		<a href="javascript:;" menu_id="5" parent="0">
			<i class="fa fa-clock-o"></i> 
			<span class="title">Timekeeping</span>
							<span class="arrow"></span>
					</a>
					<ul class="sub-menu">
				 
					<li ><a rel="<?php echo site_url('time/application');?>" href="<?php echo site_url('time/application');?>" menu_id="46" parent="5">Application</a></li>
				 
					<li ><a rel="<?php echo site_url('time/timerecords');?>" href="<?php echo site_url('time/timerecords');?>" menu_id="45" parent="5">Daily Time Records</a></li>
							</ul>
			</li>
	<li>
		<a href="javascript:;" menu_id="6" parent="0">
			<i class="fa fa-search-plus"></i> 
			<span class="title">Recruitment</span>
							<span class="arrow"></span>
					</a>
					<ul class="sub-menu">
				 
					<li ><a rel="<?php echo site_url('recruitment/annual_manpower_planning');?>" href="<?php echo site_url('recruitment/annual_manpower_planning');?>" menu_id="54" parent="6">Manpower Planning</a></li>
				 
					<li ><a rel="<?php echo site_url('recruitment/mrf');?>" href="<?php echo site_url('recruitment/mrf');?>" menu_id="55" parent="6">Manpower Request</a></li>
				 
					<li ><a rel="<?php echo site_url('recruitment/applicant_monitoring');?>" href="<?php echo site_url('recruitment/applicant_monitoring');?>" menu_id="56" parent="6">Applicant Monitoring</a></li>
				 
					<li ><a rel="<?php echo site_url('recruitment/applicants');?>" href="<?php echo site_url('recruitment/applicants');?>" menu_id="57" parent="6">Applicant List</a></li>
							</ul>
			</li>
