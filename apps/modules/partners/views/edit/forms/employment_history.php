<div class="portlet">
   <div class="portlet-title">
      <!-- <div class="caption" id="education-category">Company Name</div> -->
      <div class="tools">
         <a class="text-muted" id="delete_employment-<?php echo $count;?>" onclick="remove_form(this.id, 'employment', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a>
         <!-- <a class="collapse pull-right" href="javascript:;"></a> -->
     </div>
 </div>
 <div class="portlet-body form">
    <div class="form-horizontal">
        <div class="form-body">
          <!-- START FORM -->	
          <div class="form-group">
            <label class="control-label col-md-3">Company Name<span class="required">*</span></label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="partners_personal_history[employment-company][]" id="partners_personal_history-employment-company" placeholder="Enter Company"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Position Title<span class="required">*</span></label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="partners_personal_history[employment-position-title][]" id="partners_personal_history-employment-position-title" placeholder="Enter Position"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Location</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="partners_personal_history[employment-location][]" id="partners_personal_history-employment-location" placeholder="Enter Location"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3"><?php echo lang('partners.reason_leaving') ?></label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="partners_personal_history[employment-reason-for-leaving][]" id="partners_personal_history-employment-reason-for-leaving" 
                value="" placeholder="Enter <?php echo lang('partners.reason_leaving') ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3"><?php echo lang('partners.latest_salary') ?></label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="partners_personal_history[employment-latest-salary][]" id="partners_personal_history-employment-latest-salary" 
                value="" placeholder="<?php echo lang('partners.latest_salary') ?>" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3"><?php echo lang('partners.name_immediate_superior') ?></label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="partners_personal_history[employment-supervisor][]" id="partners_personal_history-employment-supervisor" 
                value="" placeholder="<?php echo lang('partners.name_immediate_superior') ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Date Hired</label>
            <div class="col-md-9">
                <div class="input-group input-medium pull-left">
                    <select  class="form-control form-select" data-placeholder="Select Month.." name="partners_personal_history[employment-month-hired][]" id="partners_personal_history-employment-month-hired">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
                <span class="pull-left padding-left-right-10">-</span>
                <span class="pull-left"><input type="text" class="form-control input-small" maxlength="4" name="partners_personal_history[employment-year-hired][]" id="partners_personal_history-employment-year-hired" placeholder="Year"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">End Date</label>
            <div class="col-md-9">
                <div class="input-group input-medium pull-left">
                    <select  class="form-control form-select" data-placeholder="Select Month.." name="partners_personal_history[employment-month-end][]" id="partners_personal_history-employment-month-end">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
                <span class="pull-left padding-left-right-10">-</span>
                <span class="pull-left"><input type="text" class="form-control input-small" maxlength="4" name="partners_personal_history[employment-year-end][]" id="partners_personal_history-employment-year-end" placeholder="Year"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Duties and Responsibilities</label>
            <div class="col-md-6">
                <textarea rows="3" class="form-control"name="partners_personal_history[employment-duties][]" id="partners_personal_history-employment-duties" ></textarea>
            </div>
        </div>

    </div>
</div>
</div>
</div>

<script language="javascript">
    $(document).ready(function(){
        $('select.form-select').select2();

    });
</script>