<tr class="record">
    <td>
        <div>
            <input type="checkbox" class="record-checker checkboxes" value="<?php echo $record_id; ?>" />
        </div>
    </td>
    <td>
        <a id="users_specialization_specialization" href="<?php echo $edit_url; ?>" class="text-success"><?php echo $users_specialization_specialization; ?></a>
        <br>
        <span id="users_specialization_specialization_code" class="small"><?php echo $users_specialization_specialization_code; ?></span>
    </td>
    <td class="hidden-xs">
        <span id=users_specialization_status_id;"><?php echo $users_specialization_status_id; ?></span>
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