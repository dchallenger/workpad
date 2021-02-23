<tr class="record">
    <td>
        <div>
            <input type="checkbox" class="record-checker checkboxes" value="<?php echo $record_id; ?>" />
        </div>
    </td>
    <td>{{ $performance_appraisal_idp_employee }}</td>
    <td>{{ $performance_appraisal_idp_year }}</td>
    <td class="hidden-xs">{{ $performance_appraisal_idp_position }} </td> 
    <td class="hidden-xs">{{ $performance_appraisal_idp_department }} </td> 
    <td class="hidden-xs">{{ $performance_appraisal_idp_status }} </td> 
    <td>
        <div class="btn-group">
            <a class="btn btn-xs text-muted" href="{{ $edit_url }}"><i class="fa fa-pencil"></i> Edit</a>
        </div>
        <div class="btn-group">
            <a class="btn btn-xs text-muted" href="#" data-close-others="true" data-toggle="dropdown"><i class="fa fa-gear"></i> Options</a>
            <ul class="dropdown-menu pull-right">
                {{ $options }}
            </ul>
        </div>
    </td>
</tr>