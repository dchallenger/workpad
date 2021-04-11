<div class="modal-body padding-bottom-0">
    <div class="row">
        <div class="portlet">
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form class="form-horizontal" id="section-form">
                    <input type="hidden" name="template_section_id" value="{{ $template_section_id }}" />
                    <input type="hidden" name="evaluation_template_id" value="{{ $evaluation_template_id }}" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Section Title <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="template_section" value="{{ $template_section }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Sequence <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="sequence" value="{{ $sequence }}" data-inputmask="'alias': 'integer', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Section Type <span class="required">*</span></label>
                            <div class="col-md-7">
                                <?php
                                    $section_type_options = array('' => 'Select');
                                    $section_types = $db->get_where( 'training_evaluation_template_section_type', array('deleted' => 0) );
                                    foreach( $section_types->result() as $row )
                                    {
                                        $section_type_options[$row->section_type_id] =  $row->section_type;
                                    }
                                ?>
                                {{ form_dropdown('section_type_id',$section_type_options, $section_type_id, 'class="form-control"') }}
                                <div class="help-block small">
                                    Select section type.
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM--> 
            </div>
        </div>
    </div>
</div>    
<div class="modal-footer margin-top-0">
    <button type="button" data-dismiss="modal" class="btn btn-default btn-sm">Close</button>
    <button type="button" class="btn green btn-sm" onclick="save_section()">Save</button>
</div>