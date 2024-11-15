<form class="form-horizontal" name="edit-mtf-list" id="form-calman-mplist" fg_id="calman-mplist">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Employee List Form</h4> 
        <span class="text-muted padding-3 small"><?php echo date("F d, Y - D", strtotime($date) ); ?> to <?php echo date("F d, Y - D", strtotime($date) ); ?></span>
    </div>
    <div class="modal-body padding-bottom-0">
        <div class="row">
            <div class="col-md-3">
                <?php if ($hr_admin) { ?>
                <div class="portlet">
                    <div class="portlet-body" >
                        <h4><span style="color:red">* </span>Company</h4>
                            <?php                                                                     
                                $company_options = array('' => '');
                                foreach($company->result() as $option){
                                    $company_options[$option->company_id] = $option->company;
                                } 
                            ?>
                            <?php echo form_dropdown('company',$company_options, '', 'class="form-control select2me" data-placeholder="Select company" id="company_id"') ?>
                    </div>
                </div>
                <?php } ?>
                <div class="portlet">
                    <div class="portlet-body" >
                        <input type="hidden" name="current_date" id="current_date" value="<?php echo date("Y-m-d", strtotime($date) ); ?>">
                        <input type="hidden" name="current_date_shift" id="current_date_shift" value="<?php echo $current_date_shift ?>">
                        <input type="hidden" name="update_shift" value="1">
                        <h4>Shift Schedule</h4>
                        <div id="available_schedules" class="list-group">

                            <?php 
                                for($i=0; $i < count( $currentday_schedules ); $i++){ 
                                    if ($currentday_schedules[$i]['type'] != 'BIRTHDAY') {
                            ?>
                                        <a href="javascript:;" class="list-group-item small available_scheds" data-shift-id="<?php echo $currentday_schedules[$i]['form_id']; ?>">
                                            <?php echo $currentday_schedules[$i]['title']; ?><!-- <span class="small pull-right text-muted">(5)</span> -->
                                        </a>
                            <?php 
                                    } 
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="portlet">
                    <div class="portlet-body" >
                        <div class="clearfix margin-bottom-10">

                            <div class="col-md-4 padding-none">
                                <div class="input-icon right">
                                    <i class="fa fa-search"></i>
                                    <input id="search-partner" type="text" placeholder="Find partner ... " class="form-control tooltips" data-placement="bottom" data-original-title="Search employees based on selected schedule.">
                                </div>
                            </div>

                            <div class=" col-md-offset-2 col-md-6 padding-none">

                                <div 
                                    id="batch_button" 
                                    class="batch_button" 
                                    onclick="toggleBatchUpdate()">

                                    <a class="btn btn-success pull-right tooltips" 
                                        id="goto_batch_edit" 
                                        data-placement="left" 
                                        data-original-title="Use to edit multiple selected employees.">Batch Update</a>
                                </div>

                                <div 
                                    id="batch_select" 
                                    class="col-md-offset-4 col-md-8 padding-none batch_select" 
                                    style="display:none"
                                    onclick="toggleBatchUpdate()">
 
                                    <select id="batch_update" class="form-control selectM3 input-sm" data-placeholder="Select...">
                                        <option value="" selected="selected">--</option>
                                        
                                        <?php for($j=0; $j < count( $shifts ); $j++){ ?>
                                        <option value="<?php echo $shifts[$j]['shift_id']; ?>">
                                            <?php echo $shifts[$j][ 'shift']; ?>
                                        </option>
                                        <?php } ?>
                                       
                                    </select>
                                    <a class="small text-muted pull-right" id="goback_batch_action" style="cursor: pointer">close</a>
                                </div>
                            </div> 
                        </div>

                        <!-- Table -->
                        <table id="partners-list-table" class="table table-condensed table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th width="1%">
                                        <input 
                                            type="checkbox" 
                                            class="group-checkable" 
                                            data-set="#sample_2 .checkboxes" 
                                            onclick="toggle_check_all(this)" />
                                    </th>
                                    <th width="30%">Employee</th>
                                    <th width="30%" class="hidden-xs">Current Schedule</th>
                                    <th width="35%" class="hidden-xs">
                                        Assign New Shift
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                    if (!$hr_admin || ($hr_admin &&  $company_id)) {
                                        for($i=0; $i < count( $partners ); $i++) { 
                                ?>
                                            <tr rel="0">
                                                <td>
                                                    <input 
                                                        type="checkbox"                                            
                                                        name="user_id[<?php echo $i; ?>]"
                                                        id="chk_<?php echo $partners[$i]['user_id']; ?>" 
                                                        class="checkboxes" 
                                                        value="<?php echo $partners[$i]['user_id']; ?>" />
                                                </td>
                                                <td>
                                                    <span class="text-success"><?php echo $partners[$i]['display_name']; ?></span>
                                                    <br>
                                                   <a id="date_name" href="#" class="text-muted small">
                                                        <?php echo $partners[$i]['id_number']; ?>
                                                   </a>
                                                </td> 
                                                <td>
                                                    <?php echo $partners[$i]['shift']; ?>
                                                </td>
                                                <td>
                                                    <select  
                                                        name="shift_id[<?php echo $i; ?>]" 
                                                        id="select_<?php echo $partners[$i]['shift_id']; ?>"
                                                        data-select-id="<?php echo $partners[$i]['user_id']; ?>"
                                                        class="form-control shiftSelect" 
                                                        data-placeholder="Select...">

                                                        <option value="" selected="selected">--</option>

                                                        <?php for($j=0; $j < count( $shifts ); $j++){ ?>
                                                            <option value="<?php echo $shifts[$j]['shift_id']; ?>">
                                                                <?php echo $shifts[$j]['shift']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                <?php 
                                        } 
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer margin-top-0">
        <button type="button" data-dismiss="modal" class="btn btn-default btn-sm close-modal">Close</button>
        <button type="button" class="btn green btn-sm" onclick="save_calendar( $(this).parents('form') )">Save</button>
    </div>
</form>



<!-- <script type="text/javascript" src="<?php echo theme_path(); ?>plugins/select2/select2.min.js"></script> -->
<script type="text/javascript">

    var customHandleUniform = function () {
        if (!jQuery().uniform) {
            return;
        }

        var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
        if (test.size() > 0) {
            test.each(function () {
                if ($(this).parents(".checker").size() == 0) {
                    $(this).show();
                    $(this).uniform();
                }
            });
        }
    }

    var gsd_is_processing = false;

    var getSearchData = function(keyword){

        if(gsd_is_processing) return;

        var data = {
                        keyword: keyword,
                        current_date: $("#current_date").val(),
                        current_date_shift: $('#current_date_shift').val()
                    };

        $.ajax({
            url: base_url + module.get('route') + '/get_search_data',
            type: "POST",
            async: false,
            data: data,
            dataType: "json",
            beforeSend: function () {

                gsd_is_processing = true;
            },
            success: function (response) {

                gsd_is_processing = false;

                if(response.partners_list.length){

                    $("table.table tbody tr").remove();
                    $("table.table tbody").append(response.partners_list);
                    

                    customHandleUniform();
                }
                else{
                    $("table.table tbody tr").remove();
                    // will do something here...
                }
            },
            always: function(){

                gsd_is_processing = false;
            },
            error: function(request, status, error){

                console.log("Ooops! Something went wrong.");
            }
        }); 
    }

    jQuery(document).ready(function() { 

        $('.select2me').select2({
            placeholder: "Select an option",
            allowClear: true
        });

        customHandleUniform();

        $('.shiftSelect').on('change', function(){

            var item_id = $(this).data('select-id');

            if( $(this).val() ){
                $('#chk_' + item_id).parents(".checker").children('span').addClass('checked');
                $('#chk_' + item_id).attr('checked', true);
            }
            else{
                $('#chk_' + item_id).parents(".checker").children('span').removeClass('checked');
                $('#chk_' + item_id).attr('checked', false);
            }            
        });

        $("#batch_update").on('change', function(){

            console.log($(this).val());
            //console.log($(".shiftSelect").select2("val", $(this).val()));
            //$(".shiftSelect").select2("destroy");
            //$(".shiftSelect").select2();
            
            $(".shiftSelect").val($(this).val());

            if($(this).val()){
                
                $(".checkboxes").parents(".checker").children('span').addClass('checked');
                $(".checkboxes").attr('checked', true);
            }
            else {
                $(".checkboxes").parents(".checker").children('span').removeClass('checked');
                $(".checkboxes").attr('checked', false);
            }
        });

        $(".available_scheds").on('click', function(){

            $('#current_date_shift').val($(this).data('shift-id'));

            var request_data = {
                shift_id: $(this).data('shift-id'), 
                date: $("#current_date").val(),
                company_id: $('#company_id').val()
            }

            if (request_data.company_id == '') {
                notify('error', 'Please select company...');
                return false;
            }

            $.ajax({
                url: base_url + module.get('route') + '/get_available_schedules',
                type: "POST",
                async: false,
                data: request_data,
                dataType: "json",
                beforeSend: function () {
                    blockMe();
                },
                success: function (response) {
                    console.log('done');

                    unBlockMe();

                    if (typeof (response.rows) != 'undefined') {

                        $("#partners-list-table tbody").empty();
                        $('#partners-list-table > tbody:last').append(response.rows);

                        customHandleUniform();

                        /*$('.selectM3').select2('destroy');   
                        $('.selectM3').select2();*/                     
                    }

                    for (var i in response.message) {
                        if (response.message[i].message != "") {
                            notify(response.message[i].type, response.message[i].message);
                        }
                    }
                }
            });         
        });

        $("#company_id").on('change', function(){
            var request_data = {
                shift_id: $('#current_date_shift').val(), 
                date: $("#current_date").val(),
                company_id: $(this).val()
            }

            $.ajax({
                url: base_url + module.get('route') + '/get_available_schedules',
                type: "POST",
                async: false,
                data: request_data,
                dataType: "json",
                beforeSend: function () {
                    blockMe();
                },
                success: function (response) {
                    console.log('done');

                    unBlockMe();

                    if (typeof (response.rows) != 'undefined') {

                        $("#partners-list-table tbody").empty();
                        $('#partners-list-table > tbody:last').append(response.rows);

                        customHandleUniform();

                        /*$('.selectM3').select2('destroy');   
                        $('.selectM3').select2();*/                     
                    }

                    for (var i in response.message) {
                        if (response.message[i].message != "") {
                            notify(response.message[i].type, response.message[i].message);
                        }
                    }
                }
            });         
        });


        $("#search-partner").on('keyup', function(e){ console.log(e.keyCode);

            var keyword = $(this).val();

            if(e.keyCode == 13){
                getSearchData(keyword);
            }
        });
    });
</script>  