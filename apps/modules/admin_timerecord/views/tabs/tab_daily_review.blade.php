<div class="portlet" id="list">
   <div class="dtr-filter">
        <div class="" style="width: 600px; margin-bottom: 10px;">
            <div class="row">
                <div class="col-md-7">                  
                    <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
                        <input type="text" class="form-control" name="selected_date" id="selected_date_daily" value="{{ $currentDate }}" placeholder="">
                        <span class="input-group-btn">
                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- <br>
        <span class="small text-muted margin-bottom-10">
            Show inclusive date per calendar month
        </span> -->
    </div>
    <div class="portlet-title hidden">
        <div class="caption" id="date-title_by_date">&nbsp;</div>
        <div class="actions margin-bottom-10">
            <a id="previous_month_by_date" data-month="{{$prev_month}}" class="text-muted btn btn-default month-nav">
                <i class="fa fa-chevron-left"></i>
            </a>
            <a id="next_month_by_date" data-month="{{$next_month}}" class="text-muted btn btn-default month-nav">
                <i class="fa fa-chevron-right"></i>
            </a>
        </div>
    </div>

    <div class="portlet-body">
        <!-- Table -->

        <div id="loader_bydate_daily" class="text-center" style="display: none;">
            <img src="{{ theme_path() }}img/ajax-loading.gif" alt="loading..." /> Fetching record(s)
        </div>

        <div id="no_record_by_date_daily" class="well" style="display:none;">
            <p class="bold"><i class="fa fa-exclamation-triangle"></i> No record/s found!</p>
            <span><p class="small margin-bottom-0">No available Time Record/s.</p></span>
        </div>

        <div id="something_wrong_by_date" class="well" style="display:none;">
            <p class="bold"><i class="fa fa-exclamation-triangle"></i> Oooppss! Something went wrong.</p>
            <span><p class="small margin-bottom-0">Something has gone wrong. Please reload this page or contact your System Administrator.</p></span>
        </div>

        <table id="list-table-daily" class="table table-condensed table-hover" style="display: none;">
            <thead>
                <tr>
                    <th width="1%" class="hidden-xs">
                        <span data-original-title="Schedules" data-content="List to remind you of your restdays and holidays" data-placement="right" data-trigger="hover" class="popovers">
                            <i class="fa fa-align-justify"></i>
                        </span></th>


                    <th width="1%" class="">
                        <span data-original-title="Reminders" data-content="List of items to remind you of needed application to file for disputes." data-placement="right" data-trigger="hover" class="popovers">
                            <i class="fa fa-bell-o"></i>
                        </span></th>

                    <th width="1%" class="">&nbsp;</th>
                    <th width="20%">Name</th>
                    <th width="10%">IN</th>
                    <th width="10%">OUT</th>
                    <th width="1%" class="hidden-xs">&nbsp;</th>
                    <th width="5%">Hours<br />Worked</th>
                    <th width="5%" class="hidden-xs">Late<br /><span class="small text-muted">hr</span></th>
                    <th width="5%" class="hidden-xs">UT<br /><span class="small text-muted">hr</span></th>
                    <th width="5%" class="hidden-xs">OT<br /><span class="small text-muted">hr</span></th>
                    <th width="8%" class="hidden-xs">Actions</th>
                </tr>
            </thead>

            <tbody>
                
            </tbody>
        </table>

        <!-- End Table -->
    </div>

</div>