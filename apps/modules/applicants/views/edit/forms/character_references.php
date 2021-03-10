<?php
    $db->select('city_id,city');
    $db->where('deleted', '0');
    $db->order_by('city');
    $options_cities = $db->get('cities');

    $db->select('country_id,short_name');
    $db->where('deleted', '0');
    $db->order_by('short_name');
    $options_countries = $db->get('countries'); 
?>
<div class="portlet">
	<div class="portlet-title">
		<!-- <div class="caption" id="education-category">Company Name</div> -->
		<div class="tools">
			<a class="text-muted" id="delete_reference-<?php echo $count;?>" onclick="remove_form(this.id, 'reference', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a>
			<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
		</div>
	</div>
	<div class="portlet-body form">
        <div class="form-horizontal">
            <div class="form-body">
		<!-- START FORM -->	
                <div class="form-group">
                    <label class="control-label col-md-3">Name<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-name][]" id="recruitment_personal_history-reference-name" placeholder="Enter Name"/>
                    </div>
                </div>
<!--                 <div class="form-group">
                    <label class="control-label col-md-3">Relationship</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-relationship][]" id="recruitment_personal_history-reference-relationship" 
                        value="" placeholder="Enter Relationship"/>
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="control-label col-md-3">Occupation</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-occupation][]" id="recruitment_personal_history-reference-occupation" placeholder="Enter Occupation"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Organization</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-organization][]" id="recruitment_personal_history-reference-organization" 
                        value="" placeholder="Enter Organization"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Years Known<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-years-known][]" id="recruitment_personal_history-reference-years-known" placeholder="Enter Years Known" data-inputmask="'mask': '9', 'repeat': 2, 'greedy' : false"/>
                    </div>
                </div>
                <div class="form-group hidden-sm hidden-xs">
                    <label class="control-label col-md-3">Phone</label>
                    <div class="col-md-6">
                         <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-phone][]" id="recruitment_personal_history-reference-phone" placeholder="Enter Telephone Number" data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false"/>
                         </div>
                    </div>
                </div>
                <div class="form-group hidden-sm hidden-xs">
                    <label class="control-label col-md-3">Mobile</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-mobile][]" id="recruitment_personal_history-reference-mobile" placeholder="Enter Mobile Number" data-inputmask="'mask': '9', 'repeat': 12, 'greedy' : false"/>
                         </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Address</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-map-marker"></i>
                             </span>
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-address][]" id="recruitment_personal_history-reference-address" placeholder="Enter Address"/>
                         </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">City/Town</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            <select  class="form-control form-select" data-placeholder="Select..." name="recruitment_personal_history[reference-city][]" id="partners_personal_history-reference-city">
                                <option value=""></option>
                            <?php
                                foreach($options_cities->result() as $option) {
                            ?>
                                    <option value="<?php echo $option->city_id ?>"><?php echo $option->city ?></option>
                            <?php
                                }
                            ?>                                
                            </select>
                         </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Country</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            <select  class="form-control form-select" data-placeholder="Select..." name="recruitment_personal_history[reference-country][]" id="partners_personal_history-reference-country">
                                <option value=""></option>
                            <?php
                                foreach($options_countries->result() as $option) {
                            ?>
                                    <option value="<?php echo $option->country_id ?>"><?php echo $option->short_name ?></option>
                            <?php
                                }
                            ?>                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Zipcode</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-zipcode][]" id="recruitment_personal_history-reference-zipcode" placeholder="Enter Zipcode"/>
                    </div>
                </div>

			</div>
		</div>
	</div>
</div>

<script language="javascript">
    $(document).ready(function(){
        $(":input").inputmask();
        
        $('.form-select').select2({
            placeholder: "Select an option",
            allowClear: true        
        });     
    });
</script>