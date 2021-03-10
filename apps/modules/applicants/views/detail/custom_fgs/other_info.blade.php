<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('applicants.other_info') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- START FORM -->
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">              
                	<div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.height') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['height'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group hidden-sm hidden-xs">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.weight') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['weight'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group hidden-sm hidden-xs">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.hobby') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['interests_hobbies'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.languages') }} :</label>
                        <div class="col-md-5"> 
                            <span>{{ $record['language'] }}</span>                                  
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.dialects') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['dialect'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group hidden">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.no_dependents') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['dependents_count'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.number_children') }} :</label>
                        <div class="col-md-5">
                            <span id="no-of-dependents">{{$number_children}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions fluid">
            <div class="row">
                <div class="col-md-12">
                    <div align="center">
                        <a class="btn default btn-sm" href="{{ $mod->url }}" type="button" >{{ lang('common.back_to_list') }}</a>                               
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>