
<tr class="record">
    <td>
        <div>
            <input type="checkbox" class="record-checker checkboxes" value="<?php echo $record_id; ?>" />
        </div>
    </td>
    <td>
        <span id="payroll_partners_previous_employer_user_id" class="small"><?php echo $payroll_partners_previous_employer_user_id; ?></span>
    </td>
    <td class="hidden-xs">
        <span class="small" id="payroll_partners_previous_employer_company_name"><?php echo $payroll_partners_previous_employer_company_name; ?></span>
    </td>
    <td class="hidden-xs">
        <span class="small" id="payroll_partners_previous_employer_address"><?php echo $payroll_partners_previous_employer_address; ?></span>
    </td>    
    <td>
        <div class="btn-group">
            <a class="btn btn-xs text-muted" href="{{ $edit_url }}"><i class="fa fa-pencil"></i> {{ lang('position.edit') }}</a>
        </div>
        <div class="btn-group">
            <a class="btn btn-xs text-muted" href="#" data-close-others="true" data-toggle="dropdown"><i class="fa fa-gear"></i> {{ lang('position.options') }}</a>
            <ul class="dropdown-menu pull-right">
                {{ $options }}
            </ul>
        </div>
    </td>
</tr>