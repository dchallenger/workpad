<form action="#" class="form-horizontal">
    <div class="modal-body padding-bottom-0">
		<div class="row">
			<div class="portlet-body form">
                <!-- BEGIN FORM-->
                    <div class="form-body">
                        <div class="form-group margin-bottom-25">
                            <label class="control-label col-md-3">Question Item<span class="required">*</span></label>
                            <div class="col-md-8">
                            <input type="text" class="form-control" name="partners_clearance_exit_interview_layout_item[item]" id="partners_clearance_exit_interview_layout_item-item" value="{{ $item }}" placeholder="Enter Panel Name" />
                            <input type="hidden" class="form-control" name="partners_clearance_exit_interview_layout_item[exit_interview_layout_item_id]" id="partners_clearance_exit_interview_layout_item-exit_interview_layout_item_id" value="{{ $exit_interview_layout_item_id }}"  /> 
                            <input type="hidden" class="form-control" name="partners_clearance_exit_interview_layout_item[exit_interview_layout_id]" id="partners_clearance_exit_interview_layout_item-exit_interview_layout_id" value="{{ $exit_interview_layout_id }}"  /> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">With Yes / No</label>
                            <div class="col-md-4">                          
                                <div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
                                    <input type="checkbox" value="1" @if( $wiht_yes_no == 1 ) checked="checked" @endif name="partners_clearance_exit_interview_layout_item[wiht_yes_no][temp]" id="partners_clearance_exit_interview_layout_item-wiht_yes_no-temp" class="dontserializeme toggle"/>
                                    <input type="hidden" name="partners_clearance_exit_interview_layout_item[wiht_yes_no]" id="partners_clearance_exit_interview_layout_item-wiht_yes_no" value="@if( $wiht_yes_no ) 1 @else 0 @endif"/>
                                </div>           
                            </div>  
                        </div>
                    </div>
                <!-- END FORM--> 
            </div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn default btn-sm">Close</button>
		<button type="button" class="btn green btn-sm" onclick="save_sign($(this).closest('form'))">Save Item</button>
	</div>
</form>

<script language="javascript">
    $(document).ready(function(){
        $('select.select2me').select2();
        $('.make-switch').not(".has-switch")['bootstrapSwitch']();

        $('#partners_clearance_exit_interview_layout_item-is_immediate-temp').change(function(){
            if( $(this).is(':checked') ){
                $('#partners_clearance_exit_interview_layout_item-is_immediate').val('1');
            }else{
                $('#partners_clearance_exit_interview_layout_item-is_immediate').val('0');
            }
        });
    });
</script>