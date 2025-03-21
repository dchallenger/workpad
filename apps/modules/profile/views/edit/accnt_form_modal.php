<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Accountabilities <small class="text-muted">view</small></h4>
</div>
<div class="modal-body padding-bottom-0">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet" id="bl_container">
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                        <form action="#" class="form-horizontal">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-right text-muted">Item Name :</label>
                                    <div class="col-md-7">
                                        <?php echo (isset($details['accountabilities-name']) ? $details['accountabilities-name'] : ""); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-right text-muted">Item Code :</label>
                                    <div class="col-md-7">
                                        <?php echo (isset($details['accountabilities-code']) ? $details['accountabilities-code'] : ""); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-right text-muted">Quantity :</label>
                                    <div class="col-md-7">
                                        <?php echo (isset($details['accountabilities-quantity']) ? $details['accountabilities-quantity'] : ""); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-right text-muted">Date Issued :</label>
                                    <div class="col-md-7">
                                        <?php 
                                            $month_issued = (isset($details['accountabilities-month-issued']) ? $details['accountabilities-month-issued'] : ""); 
                                            $day_issued = (isset($details['accountabilities-day-issued']) ? $details['accountabilities-day-issued']."," : ""); 
                                            $year_issued = (isset($details['accountabilities-year-issued']) ? $details['accountabilities-year-issued'] : "");                                         
                                        ?>
                                        <?=$month_issued." ".$day_issued." ".$year_issued ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-right text-muted">Date Returned :</label>
                                    <div class="col-md-7">
                                        <?php 
                                            $month_returned = (isset($details['accountabilities-month-returned']) ? $details['accountabilities-month-returned'] : ""); 
                                            $day_returned = (isset($details['accountabilities-day-returned']) ? $details['accountabilities-day-returned']."," : ""); 
                                            $year_returned = (isset($details['accountabilities-year-returned']) ? $details['accountabilities-year-returned'] : "");  
                                        ?>
                                        <?=$month_returned." ".$day_returned." ".$year_returned ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-right text-muted">Remarks :</label>
                                    <div class="col-md-7">
                                        <?php echo (isset($details['accountabilities-remarks']) ? $details['accountabilities-remarks'] : ""); ?>
                                    </div>
                                </div>
                            </div>                                
                        </form>
                        <!-- END FORM--> 
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer margin-top-0">
    <button type="button" data-dismiss="modal" class="btn btn-default btn-sm">Close</button>
</div>