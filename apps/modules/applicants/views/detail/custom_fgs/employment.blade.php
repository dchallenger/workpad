<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('applicants.app_info') }}</div>
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
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.encoded_on') }} :</label>
                        <div class="col-md-5">
                            <span>Applicants</span>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">                                   
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('common.status') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['recruit_status'] }}</span>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">              
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.dt_application') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['recruitment_date'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">               
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.pos_sought') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['position_sought'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.oth_pos') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['oth_position'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.desired_salary') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['desired_salary'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @if ($record['desired_salary'] != '')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"></label>
                            <div class="col-md-5">
                                <span>{{$record['salary_pay_mode']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.currently_employed') }} :</label>
                        <div class="col-md-5">
                            <span>@if( $record['currently_employed'] ) Yes @else No @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">            
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.learn_job') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['how_hiring_heard'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                     
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.referral') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['referred_by'] }}</span>
                        </div>
                    </div>
                </div>
            </div>                    
            <div class="row">
                <div class="col-md-12">            
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.resume') }}</label>
                        <div class="col-md-9">
                            <?php 
                                $filename = urldecode(basename($record['resume'])); 
                                // if(strtolower($filename) == 'avatar.png'){
                                //     $record['resume'] = '';
                                //     $filename = '';
                                // }
                            ?>
                            <span>{{$filename}}</span>
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