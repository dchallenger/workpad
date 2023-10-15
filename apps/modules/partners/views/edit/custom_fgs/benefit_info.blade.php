<div class="portlet">
    <div class="portlet-title">
        <div class="caption">{{ lang('partners.benefits') }}</div>
        <div class="tools">
            <a class="collapse" href="javascript:;"></a>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- START FORM -->
        <div class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.benefit_type') }}</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="partners_personal[sss_number]" id="partners_personal-sss_number" value="{{ $benefit_type }}" readonly="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.benefits') }}</label>
                    <div class="col-md-5">
                        <div contentEditable="true">{{ $benefit }}</div>
                    </div>
                </div>
            </div>     
            <div class="form-actions fluid">
                <div class="row" align="center">
                    <div class="col-md-12">                   
                        <a href="<?php echo $back_url;?>" class="btn default btn-sm">{{ lang('common.back_to_list') }}</a>
                    </div>
                </div>
            </div>                
        </div>
    </div>
</div>