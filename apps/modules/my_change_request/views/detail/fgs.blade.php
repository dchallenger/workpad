<div id="personal_request" class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('my_change_request.change_request') }} <small class="text-muted">{{ lang('common.view') }}</small></div>
	</div>
    <div class="portlet-body form" id="main_form">
    	<form name="change-request-form">
	    	<input type="hidden" id="user_id" name="user_id" value="{{ $record['user_id'] }}">
			<input type="hidden" id="created_on" name="created_on" value="{{ $record['created_on'] }}">
	    	<!-- BEGIN FORM-->
	        <div class="form-body">
			    @if( !empty( $record ) )
		    		<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 text-right text-muted margin-none">{{ lang('my_change_request.employee') }} :</label>
								<div class="col-md-7 col-sm-7">
									<span>{{ $record['employee_name'] }}</span>
								</div>
							</div>
						</div>
					</div>
		            <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 text-right text-muted margin-none">{{ lang('my_change_request.company') }} :</label>
								<div class="col-md-7 col-sm-7">
									<span>{{ $record['company'] }}</span>
								</div>
							</div>
						</div>
					</div>	
		            <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 text-right text-muted margin-none">{{ lang('my_change_request.dept') }} :</label>
								<div class="col-md-7 col-sm-7">
									<span>{{ $record['department'] }}</span>
								</div>
							</div>
						</div>
					</div>
		            <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 text-right text-muted margin-none">{{ lang('my_change_request.remarks') }} :</label>
								<div class="col-md-7 col-sm-7">
									<span>{{ $record['remarks'] }}</span>
								</div>
							</div>
						</div>
					</div>						
		            <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 text-right text-muted margin-none">{{ lang('my_change_request.submitted_on') }} :</label>
								<div class="col-md-7 col-sm-7">
									<span>{{ date("F d, Y - h:i a", strtotime($record['created_on'])) }}</span>
								</div>
							</div>
						</div>
					</div>	
					<div class="portlet">
						<div class="portlet-title margin-top-25">
							<div class="caption">{{ lang('my_change_request.requested_item') }}</div>
							<div class="tools">
								<a class="collapse" href="javascript:;"></a>
							</div>
						</div>
						<p class="margin-bottom-25">{{ lang('my_change_request.req_note') }}</p>	
						<div class="portlet-body form">
			    			<table class="table table-condensed table-striped table-hover" >
								<thead>
									<tr>
										<th width="30%" class="padding-top-bottom-10" >{{ lang('my_change_request.item') }}</th>
										<th width="30%" class="padding-top-bottom-10">{{ lang('my_change_request.request') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($request_details as $key => $request)
										<?php
											switch ($request['key_code']) {
												case 'phone':
													$request['key_label'] = 'Office Phone';
													break;
												case 'mobile':
													$request['key_label'] = 'Office Mobile';
													break;
												case 'email':
													$request['key_label'] = 'Office Email';
													break;
												case 'personal_phone':
													$request['key_label'] = 'Personal Phone';
													break;
												case 'personal_mobile':
													$request['key_label'] = 'Personal Mobile';
													break;
												case 'personal_email':
													$request['key_label'] = 'Personal Email';
													break;					
											}
										?>									
										<tr>
											<td>{{ $request['key_label'] }}</td> 
											<!-- <td></td> -->
											<td>
												@if (in_array($request['key_id'],array(218,219)))
													@if ($request['key_value'] == 1)
														Yes
													@else
														No
													@endif
												@else
													{{ $request['key_value'] }}												
												@endif
											</td>
										</tr>
									@endforeach
								</tbody>
			    			</table>
			    		</div>
		    		</div>
			    @endif	
	        </div>
	        <!-- END FORM--> 
	    </form>
    </div>
</div>
