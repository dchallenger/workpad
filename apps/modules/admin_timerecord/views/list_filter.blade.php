<style>
	.event-block {cursor:pointer;margin-bottom:5px;display:inline-block;position:relative;}
</style>

<div id="calendar_date_container">
    <div class="portlet-title" style="margin-bottom:3px;">
        <div class="caption">{{ lang('admin_timerecord.calendar_month') }}</div>
    </div>
    <span class="small text-muted margin-bottom-10">
    	{{ lang('admin_timerecord.show_inclusive_date_month') }}
    </span>
    <div class="portlet-body">
    	<div id="sf-container" class="margin-top-10">
            
        </div>
    </div>
</div>

<div id="status_container">
    <div class="portlet-title margin-top-20" style="margin-bottom:3px;">
        <div class="caption">{{ lang('admin_timerecord.status') }}</div>
    </div>
    <div class="portlet-body">
        <span class="small text-muted">{{ lang('admin_timerecord.filter_by_status') }}</span>
        <div id="status-container" class="margin-top-10">
            <span status_id="" class="event-block label label-success status-filter">{{ lang('common.all') }}</span>
            <?php
                $db->order_by('employment_status');
                // $db->where('employment_status_id < 8'); // included all status
                $db->where('deleted', 0);
                $statuses = $db->get_where('partners_employment_status', array('deleted' => 0));
                foreach( $statuses->result() as $row )
                { 
                    $success_class = $row->employment_status_id == 1 ? 'label-default' : 'label-default'; //default :regular
                ?>
                    <span status_id="<?php echo $row->employment_status_id?>" class="event-block label <?php echo $success_class; ?> status-filter"><?php echo $row->employment_status?></span>
                <?php
                }
            ?>
        </div>
    </div>
</div>

<div id="company_container" style="display:none">
    <div class="portlet-title margin-top-20" style="margin-bottom:3px;">
        <div class="caption">{{ lang('admin_timerecord.company') }}</div>
    </div>
    <div class="portlet-body">
        <span class="small text-muted">{{ lang('admin_timerecord.filter_by_company') }}</span>
        <div id="company-container" class="margin-top-10">
            <span company_id="" class="event-block label label-success company-filter">{{ lang('common.all') }}</span>
            <?php
                $db->order_by('company');
                // $db->where('employment_status_id < 8'); // included all status
                $db->where('deleted', 0);
                $companies = $db->get_where('users_company', array('deleted' => 0));
                foreach( $companies->result() as $row )
                { 
                    $success_class = $row->company_id == 1 ? 'label-default' : 'label-default'; //default :regular
                ?>
                    <span company_id="<?php echo $row->company_id?>" class="event-block label <?php echo $success_class; ?> company-filter"><?php echo $row->company?></span>
                <?php
                }
            ?>
        </div>
    </div>
</div>

<div id="payroll_date_container">
    <div class="portlet-title margin-top-20" style="margin-bottom:3px;">
        <div class="caption">{{ lang('admin_timerecord.pay_dates') }}</div>
    </div>
    <div class="portlet-body">
        <span class="small text-muted">{{ lang('admin_timerecord.show_inclusive_date_last5') }}</span>
        <div id="period-filter-container" class="margin-top-10">
        </div>
    </div>
</div>

<div class="portlet-title margin-top-20 hidden" style="margin-bottom:3px;">
    <div class="caption">{{ lang('admin_timerecord.link') }}</div>
</div>
<div class="portlet-body hidden">
    
    <div class="margin-top-10">
        <a href="{{ get_mod_route('my_calendar') }}" class="label label-success">{{ lang('admin_timerecord.my_calendar') }}</a>
    </div>
</div>