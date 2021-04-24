<tr class="record">
    <td>{{ $training_application_user }}</td>    
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
        <div class="btn-group">
            <a href="{{ $detail_url }}" class="btn btn-xs text-muted"><i class="fa fa-search"></i> {{ lang('common.view') }}</a>
        </div>
    </td>
</tr>