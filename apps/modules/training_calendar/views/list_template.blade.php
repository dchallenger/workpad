<tr class="record">
    <td>
        <div>
            <input type="checkbox" class="record-checker checkboxes" value="<?php echo $record_id; ?>" />
        </div>
    </td>
    <td>{{ $training_calendar_training_title }} </td>
    <td>{{ $training_calendar_course_id }}</td>
    <td class="hidden-xs">{{ $training_calendar_last_registration_date }} </td> 
    <td class="hidden-xs">{{  ($training_calendar_status == 0) ? 'open' : 'closed' }} </td> 
    <td>
        @if ($training_calendar_status == 0)
            <div class="btn-group">
                <a class="btn btn-xs text-muted" href="{{ $edit_url }}"><i class="fa fa-pencil"></i> Edit</a>
            </div>
        @endif
        <div class="btn-group">
            <a class="btn btn-xs text-muted" href="#" data-close-others="true" data-toggle="dropdown"><i class="fa fa-gear"></i> Options</a>
            <ul class="dropdown-menu pull-right">
                {{ $options }}
            </ul>
        </div>
    </td>
</tr>