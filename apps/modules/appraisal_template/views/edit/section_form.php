<div class="modal-body padding-bottom-0">
    <div class="row">
        <div class="portlet">
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form class="form-horizontal" id="section-form">
                    <input type="hidden" name="template_section_id" value="{{ $template_section_id }}" />
                    <input type="hidden" name="template_id" value="{{ $template_id }}" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Section Title <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="template_section" value="{{ $template_section }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Parent</label>
                            <div class="col-md-7">
                                <?php
                                    $parent_options = array('' => 'Select');
                                    $qry = " select * 
                                    FROM {$db->dbprefix}performance_template_section
                                    WHERE (parent_id is null or parent_id = 0)
                                    AND deleted = 0 AND template_id = {$template_id}";
                                    $parent_sections = $db->query( $qry );
                                    foreach( $parent_sections->result() as $row )
                                    {
                                        $parent_options[$row->template_section_id] =  $row->template_section;
                                    }
                                ?>
                                {{ form_dropdown('parent_id',$parent_options, $parent_id, 'class="form-control"') }}
                                <div class="help-block small">
                                    Select parent section if applicable.
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Sequence <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="sequence" value="{{ $sequence }}" data-inputmask="'alias': 'integer', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Weight</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="weight" value="{{ $weight }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Section Type <span class="required">*</span></label>
                            <div class="col-md-7">
                                <?php
                                    $section_type_options = array('' => 'Select');
                                    $section_types = $db->get_where( 'performance_template_section_type', array('deleted' => 0) );
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

                        <div class="form-group">
                            <label class="control-label col-md-3">Library of Competencies <span class="required">*</span></label>
                            <div class="col-md-7">
                                <?php
                                    $library_type_options = array('' => 'Select');

                                    $qry = "select *
                                    FROM {$db->dbprefix}performance_setup_library l
                                    WHERE l.deleted = 0
                                    ORDER BY l.library";

                                    $library = $db->query( $qry ); 

                                    foreach( $library->result() as $row )
                                    {
                                        $library_type_options[$row->library_id] =  $row->library;
                                    }
                                ?>
                                {{ form_dropdown('library_id',$library_type_options, $library_id, 'class="form-control"') }}
                                <div class="help-block small">
                                    Select library of competencies. (required if section type is library)
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Core</label>
                            <div class="col-md-7">                          
                                <div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
                                    <input type="checkbox" value="1" @if( $is_core ) checked="checked" @endif name="is_core-tmp" id="is_core-temp" class="dontserializeme toggle"/>
                                    <input type="hidden" name="is_core" id="is_core" value="@if( $is_core ) 1 @else 0 @endif"/>
                                </div>              
                            </div>  
                        </div>  
                        <div class="form-group min-crowdsource hidden">
                            <label class="control-label col-md-3">Min. Crowdsource</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="min_crowdsource" value="{{ $min_crowdsource }}" data-inputmask="'alias': 'integer', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Header</label>
                            <div class="col-md-7">
                                <textarea class="form-control ckeditor m-wrap" name="header" id="section-header">{{ $header }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Footer</label>
                            <div class="col-md-7">
                                <textarea class="form-control" name="footer"  id="section-footer">{{ $footer }}</textarea>
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