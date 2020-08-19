<tr rel="1">
    <td>
        <span class="text-info">{{ $partners_loan_type }}</span><br>
    </td>
    <td class="hidden-xs">
        <span class="text-muted small"><?php echo date("F d, Y",strtotime($partners_loan_application_created_on)); ?></span>
    </td>
    <td class="hidden-xs">
        <?php 
            switch($loan_application_status_id){ 
                case 1:
                    ?><span class="badge badge-info">{{ $loan_application_status }}</span><?php
                break;
                case 2:
                    ?><span class="badge badge-warning">{{ $loan_application_status }}</span><?php
                break;
                case 3:
                    ?><span class="badge badge-warning">{{ $loan_application_status }}</span><?php
                break;
                case 4:
                    ?><span class="badge badge-info">{{ $loan_application_status }}</span><?php
                break;
                case 5:
                    ?><span class="badge badge-info">{{ $loan_application_status }}</span><?php
                break;
                case 6:
                    ?><span class="badge badge-success">{{ $loan_application_status }}</span><?php
                break;
                case 7:
                    ?><span class="badge badge-important">{{ $loan_application_status }}</span><?php
                break;
                case 8:
                    ?><span class="badge badge-default">{{ $loan_application_status }}</span><?php
                break;
                default:
                    ?><span class="badge badge-default">{{ $loan_application_status }}</span><?php
                break;
         } ?>        
    </td>
    <td>
        <?php 
        if( $loan_application_status_id < 2 ){ ?>        
            <div class="btn-group">
                <a class="btn btn-xs text-muted" href="{{ $edit_url }}"><i class="fa fa-pencil"></i> Edit</a>
            </div>
        <?php } ?>
        <div class="btn-group">
            <a class="btn btn-xs text-muted" href="#" data-close-others="true" data-toggle="dropdown"><i class="fa fa-gear"></i> Options</a>
            <ul class="dropdown-menu pull-right">
                {{ $options }}
            </ul>
        </div>
    </td>
</tr>