<tr rel="1">
    <td>
        <div>
            <input type="checkbox" class="record-checker checkboxes" value="<?php echo $record_id; ?>" />
        </div>
    </td>
    <td>
        <span class="text-info">{{ $time_form_form }}</span><br>
        <span class="text-muted small"><?php echo date("F d, Y",strtotime($time_forms_created_on)); ?></span>
    </td>
    <td class="hidden-xs"><?php echo date("M-d",strtotime($time_forms_date_from)); ?> <span class="text-muted small"><?php echo date("D",strtotime($time_forms_date_from)); ?></span><br>
        <span class="text-muted small"><?php echo date("Y",strtotime($time_forms_date_from)); ?></span>
    </td>
    <td class="hidden-xs"><?php echo date("M-d",strtotime($time_forms_date_to)); ?> <span class="text-muted small"><?php echo date("D",strtotime($time_forms_date_to)); ?></span><br>
        <span class="text-muted small"><?php echo date("Y",strtotime($time_forms_date_to)); ?></span>
    </td>
    
    <td class="hidden-xs">
        <span class="badge badge-success">{{ $time_form_status_form_status }}</span>
    </td>
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