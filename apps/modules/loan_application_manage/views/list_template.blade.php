<tr rel="1">
    <td>
        <span class="text-info">{{ $full_name }}</span><br>
    </td>    
    <td>
        <span class="text-info">{{ $partners_loan_type }}</span><br>
    </td>
    <td class="hidden-xs">
        <span class="text-muted small"><?php echo date("F d, Y",strtotime($partners_loan_application_created_on)); ?></span>
    </td>
    <td class="hidden-xs">
        <?php 
        if($loan_application_status_id != 8){ //not cancelled
            switch($approver_status_id){ 
                case 1: ?><span class="badge badge-info">{{ $approver_status }}</span><?php break;
                case 2: ?><span class="badge badge-warning">{{ $approver_status }}</span><?php break;
                case 3: ?><span class="badge badge-warning">{{ $approver_status }}</span><?php break;
                case 4: ?><span class="badge badge-info">{{ $approver_status }}</span><?php break;
                case 5: ?><span class="badge badge-info">{{ $approver_status }}</span><?php break;
                case 6: ?><span class="badge badge-success">{{ $approver_status }}</span><?php break;
                case 7: ?><span class="badge badge-danger">{{ $approver_status }}</span><?php break;
                case 8:
                default: ?><span class="badge badge-default">{{ $approver_status }}</span><?php break;
            }
        } else { //cancelled
            ?>
            @if($loan_application_status_id == 6)
                <span class="badge badge-success">{{ $loan_application_status }}</span>
            @else
                <span class="badge badge-default">{{ $loan_application_status }}</span>
            @endif
        <?php
        } ?>

    </td>
    <td>
        <div class="btn-group">
            <a href="{{ $detail_url }}" class="btn btn-xs text-muted"><i class="fa fa-search"></i> {{ lang('loan_application.view') }}</a>
        </div>

        @if($loan_application_status_id != 8 )
            @if( $approver_status_id == 2 )
                <div class="btn-group">
                    <span onclick="get_loan_application_details('{{ $partners_loan_type_code }}',{{ $loan_application_id }})";data-loan-application-id="{{ $loan_application_id }}" data-loan-type-id="{{ $partners_loan_type_id }}" id="manage_dialog-{{ $loan_application_id }}" 
                    class="btn btn-sm custom_popover text-muted"  data-close-others="true" data-content="" data-placement="left" data-original-title="{{ $partners_loan_type }}">
                    <i class="fa fa-gear"></i> {{ lang('loan_application.options') }}
                    </span>
                </div>
            @endif
        @endif
    </td>
</tr>