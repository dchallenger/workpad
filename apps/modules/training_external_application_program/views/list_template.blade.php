<tr class="record">
    <td>
        <div>
            <input type="checkbox" class="record-checker checkboxes" value="<?php echo $record_id; ?>" />
        </div>
    </td>
    <td>{{ $training_application_user }}</td>
    <td class="hidden-xs">{{ $training_application_created_on }}</td>
    <td>{{ $training_application_training_course }} </td> 
    <td class="hidden-xs">{{ $training_application_training_type }} </td> 
    <td>{{ $training_application_training_application_status }} </td> 
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