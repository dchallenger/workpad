<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('career_level.career_level_information') }}</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
		<div class="portlet-body form">			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>{{ lang('career_level.job_rank_level') }}</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="users_job_rank_level[job_rank_level]" id="users_job_rank_level-job_rank_level" value="{{ $record['users_job_rank_level.job_rank_level'] }}" placeholder="{{ lang('career_level.p_job_rank_level') }}" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>{{ lang('career_level.career_level_code') }}</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="users_job_rank_level[job_rank_level_code]" id="users_job_rank_level-job_rank_level_code" value="{{ $record['users_job_rank_level.job_rank_level_code'] }}" placeholder="{{ lang('career_level.p_career_level_code') }}" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">{{ lang('career_level.active') }}</label>
				<div class="col-md-7">							<div class="make-switch" data-on-label="&nbsp;{{ lang('career_level.option_yes') }}&nbsp;" data-off-label="&nbsp;{{ lang('career_level.option_no') }}&nbsp;">
						    	<input type="checkbox" value="1" @if( $record['users_job_rank_level.status_id'] ) checked="checked" @endif name="users_job_rank_level[status_id][temp]" id="users_job_rank_level-status_id-temp" class="dontserializeme toggle"/>
						    	<input type="hidden" name="users_job_rank_level[status_id]" id="users_job_rank_level-status_id" value="<?php echo $record['users_job_rank_level.status_id'] ? 1 : 0 ?>"/>
							</div> 				</div>	
			</div>	</div>
</div>