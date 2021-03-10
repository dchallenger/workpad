     
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('applicants.personal') }}</div>
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
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.gender') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['gender'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">            
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.bday') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['birth_date'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.birthplace') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['birth_place'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.religion') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['religion'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.nationality') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['nationality'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.civil_status') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $profile_civil_status }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.solo_parent') }} :</label>
                        <div class="col-md-5">
                            <span>@if( $record['personal_solo_parent'] ) Yes @else No @endif </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>                            
    </div>
</div>