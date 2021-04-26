<div class="portlet">
	<div class="portlet-title">
		<div class="caption">SBU Unit Information</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">	
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>{{ lang('sbu_unit.sbu_unit') }}</label>				
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="users_sbu_unit[sbu_unit]" id="users_sbu_unit-sbu_unit" value="{{ $record['users_sbu_unit_sbu_unit'] }}" placeholder="Enter SBU Unit"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>{{ lang('sbu_unit.percentage') }}</label>				
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="users_sbu_unit[percentage]" id="users_sbu_unit-percentage" value="{{ $record['users_sbu_unit_percentage'] }}" placeholder="Enter Percentage"/> 				
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('sbu_unit.active') }}</label>
			<div class="col-md-7">							
				<div class="make-switch" data-on-label="&nbsp;{{ lang('common.option_yes') }}&nbsp;" data-off-label="&nbsp;{{ lang('common.option_no') }}&nbsp;">
						    	<input type="checkbox" disabled="disabled" value="1" @if( $record['users_sbu_unit_status_id'] ) checked="checked" @endif name="users_sbu_unit[status_id][temp]" id="users_sbu_unit-status_id-temp" class="dontserializeme toggle"/>
						    	<input type="hidden" name="users_sbu_unit[status_id]" id="users_sbu_unit-status_id" value="@if( $record['users_sbu_unit_status_id'] ) 1 @else 0 @endif"/>
				</div> 				
			</div>	
		</div>					
	</div>
</div>