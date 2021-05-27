<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('partners.sbu_unit') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- START FORM -->
        <div class="form-horizontal" >
			<div class="form-body">	                        	
                @if(in_array('sbu_unit', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.sbu_unit') }}<span class="required">*</span></label>
                    <div class="col-md-5">
                        <?php   $db->select('sbu_unit_id,sbu_unit');
                                $db->where('deleted', '0');
                                $options = $db->get('users_sbu_unit');

                                $users_sbu_unit_id_options = array('' => '');
                                foreach($options->result() as $option)
                                {
                                    $users_sbu_unit_id_options[$option->sbu_unit_id] = $option->sbu_unit;
                                } ?>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            <?php
                                $sbu_unit_val = 1;
                                if (!empty($record['users_profile.sbu_unit_id']))
                                    $sbu_unit_val = explode(',', $record['users_profile.sbu_unit_id']);
                            ?>
                            {{ form_multiselect('users_profile[sbu_unit_id][]',$users_sbu_unit_id_options, $sbu_unit_val, 'class="form-control select2me" id="users_profile-sbu_unit" data-placeholder="Select..."') }}
                        </div>
                    </div>  
                </div>
                <div id="sbu_container">
                    <?php
                        $sbu_unit_details = explode(',', $record['users_profile.sbu_unit_details']);
                    ?>
                    @if(!empty($record['users_profile.sbu_unit']))
                        @foreach(explode(',',$record['users_profile.sbu_unit']) as $key => $val)
                            <div class="form-group" data-sbu="{{$val}}">
                                <label class="control-label col-md-3">{{ $val }} (%)</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="users_profile[sbu_unit_details][]" id="users_profile-sbu_unit_details" value="{{ $sbu_unit_details[$key] }}" data-inputmask="'mask': '9', 'repeat': 3, 'greedy' : false" placeholder="Enter Percentage"/>
                                </div>
                            </div>                        
                        @endforeach
                    @endif
                </div>
                @endif                                                           
            </div>
            <div class="form-actions fluid">
                <div class="row" align="center">
                    <div class="col-md-12">
                        <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )"><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
                        <button class="btn blue btn-sm form-undo" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>                               
                        <a href="<?php echo $back_url;?>" class="btn default btn-sm">{{ lang('common.back_to_list') }}</a>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>