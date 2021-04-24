<tr class="record">
    <td>
        <div>
            <input type="checkbox" class="record-checker checkboxes" value="<?php echo $record_id; ?>" />
        </div>
    </td>
    <td>{{ $training_application_training_course }}</td>
    <td>{{ $training_application_training_type }}</td>
    <td class="hidden-xs">{{ general_date_time($training_application_created_on) }} </td> 
    <td class="hidden-xs">
        <?php 
            switch( $training_application_training_application_status )
            {
                case 'Draft':
                    $badge = "badge-default";
                    break;
                case 'For HR Validation':                    
                case 'For Approval':
                    $badge = "badge-warning";
                    break;
                case 'Approved':
                case 'HR Approved':
                    $badge = "badge-success";
                    break;
                default:
                    $badge = "badge-error";
                    break;

            }
        ?>
        <span class="badge {{ $badge }}">
            {{ $training_application_training_application_status }} 
        </span>
    </td> 
    <td>
        @if($training_application_training_application_status_id <= 1)
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