<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Performance</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">			
		<div class="form-group">
			<label class="control-label col-md-3">
				<span class="required">* </span>
				Performance
			</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_setup_performance[performance]" id="performance_setup_performance-performance" value="{{ $record['performance_setup_performance_performance'] }}" placeholder="Enter Performance" readonly/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">
				Performance Group
			</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_setup_performance[performance_group]" id="performance_setup_performance-performance_group" value="{{ $record['performance_setup_performance_performance_group'] }}" placeholder="Enter Performance Group" readonly/>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">
				Description
			</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_setup_performance[description]" id="performance_setup_performance-description" value="{{ $record['performance_setup_performance_description'] }}" placeholder="Enter Description" readonly/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">
				Is Active
			</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_setup_performance[description]" id="performance_setup_performance-description" value="{{ $record['performance_setup_performance_status_id'] }}" placeholder="Enter Description" readonly/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">
				Send Feeds Notification
			</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_setup_performance[description]" id="performance_setup_performance-description" value="{{ $record['performance_setup_performance_send_feeds'] }}" placeholder="Enter Description" readonly/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">
				Send Email
			</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_setup_performance[description]" id="performance_setup_performance-description" value="{{ $record['performance_setup_performance_send_email'] }}" placeholder="Enter Description" readonly/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">
				Send SMS
			</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_setup_performance[description]" id="performance_setup_performance-description" value="{{ $record['performance_setup_performance_send_sms'] }}" placeholder="Enter Description" readonly/>
			</div>
		</div>
	</div>
</div>
