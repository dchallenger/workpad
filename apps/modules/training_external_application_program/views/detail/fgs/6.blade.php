<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Available Training Budget (HRA Use Only)</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
		<div class="portlet-body form">			<div class="form-group">
				<label class="control-label col-md-3">With Service Bond</label>
				<div class="col-md-7">							<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
						    	<input type="checkbox" value="1" @if( $record['training_application.service_bond'] ) checked="checked" @endif name="training_application[service_bond][temp]" id="training_application-service_bond-temp" class="dontserializeme toggle"/>
						    	<input type="hidden" name="training_application[service_bond]" id="training_application-service_bond" value="<?php echo $record['training_application.service_bond'] ? 1 : 0 ?>"/>
							</div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Supplemental Budget</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[stb]" id="training_application-stb" value="{{ $record['training_application.stb'] }}" placeholder="Enter Supplemental Budget" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Investment</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[investment]" id="training_application-investment" value="{{ $record['training_application.investment'] }}" placeholder="Enter Investment" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Remaining Budget (Supplemental)</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[remaining_stb]" id="training_application-remaining_stb" value="{{ $record['training_application.remaining_stb'] }}" placeholder="Enter Remaining Budget (Supplemental)" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Individual Training Budget</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[itb]" id="training_application-itb" value="{{ $record['training_application.itb'] }}" placeholder="Enter Individual Training Budget" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Amount in Excess of Supplemental</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[excess_stb]" id="training_application-excess_stb" value="{{ $record['training_application.excess_stb'] }}" placeholder="Enter Amount in Excess of Supplemental" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Not Budgeted / Re-allocation</label>
				<div class="col-md-7">							<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
						    	<input type="checkbox" value="1" @if( $record['training_application.budgeted'] ) checked="checked" @endif name="training_application[budgeted][temp]" id="training_application-budgeted-temp" class="dontserializeme toggle"/>
						    	<input type="hidden" name="training_application[budgeted]" id="training_application-budgeted" value="<?php echo $record['training_application.budgeted'] ? 1 : 0 ?>"/>
							</div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Common Training Budget</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[ctb]" id="training_application-ctb" value="{{ $record['training_application.ctb'] }}" placeholder="Enter Common Training Budget" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Remaining Budget (Common)</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[remaining_ctb]" id="training_application-remaining_ctb" value="{{ $record['training_application.remaining_ctb'] }}" placeholder="Enter Remaining Budget (Common)" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">% of IDP</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[idp_completion]" id="training_application-idp_completion" value="{{ $record['training_application.idp_completion'] }}" placeholder="Enter % of IDP" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Amount in Excess of CTB</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[excess_ctb]" id="training_application-excess_ctb" value="{{ $record['training_application.excess_ctb'] }}" placeholder="Enter Amount in Excess of CTB" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Remarks (Approver)</label>
				<div class="col-md-7">							<textarea class="form-control" name="training_application[approver_remarks]" id="training_application-approver_remarks" placeholder="Enter Remarks (Approver)" rows="4">{{ $record['training_application.approver_remarks'] }}</textarea> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Remarks (HR)</label>
				<div class="col-md-7">							<textarea class="form-control" name="training_application[remarks]" id="training_application-remarks" placeholder="Enter Remarks (HR)" rows="4">{{ $record['training_application.remarks'] }}</textarea> 				</div>	
			</div>	</div>
</div>