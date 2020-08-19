<div class="modal-body">
	<div class="row">
        <div class="col-md-4">
            <div class="portlet">
                <div class="portlet-body" >
                    <form name="add-employee-form">
                        <div class="form-group">
<!--                             <select  class="form-control select2me input-sm" data-placeholder="Select..." name="group">
                            	<option value="<?php echo $group ?>" <?php if($group == "company") echo 'selected="selected"'?>><?php echo ucwords(str_replace('_', ' ', $group)) ?></option>
                            </select> -->
                            <label><?php echo ucfirst($group) ?></label>
                            <input type="hidden" name="group" value="<?php echo $group ?>">                                                        
                        </div>
                        <input type="hidden" name="except" value="<?php echo $employee_id?>">
                        <div class="list-group">
                            <?php echo $group_lists?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="portlet">
                <p class="small text-muted">Select then modify each according to desired setup. </p>

                <div class="portlet-body" >
                    <!-- Table -->
                    <table class="table table-condensed table-striped table-hover" >
                        <thead>
                            <tr>
                                <th width="1%" class="padding-top-bottom-10"><input type="checkbox" class="group-checkable" data-set=".employee-checker" /></th>
                                <th width="34%" class="padding-top-bottom-10" >Employee</th>
                                <th width="35%" class="padding-top-bottom-10">Company</th>
                                <th width="30%" class="padding-top-bottom-10" >Department</th>
                            </tr>
                        </thead>
                        <tbody id="employee-lists"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
	<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
	<button class="btn green btn-sm" type="button" onclick="add_employees()">Add Employees</button>
</div>