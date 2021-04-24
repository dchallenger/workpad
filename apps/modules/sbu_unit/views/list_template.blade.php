<tr class="record">
    <?php if($can_delete != 0 ){ ?>
        <td> 
            <div>
                <input type="checkbox" class="record-checker checkboxes" value="<?php echo $record_id; ?>" />
            </div>
        </td>
    <?php }else{ ?>
        <td> 
            <div>
            </div>
        </td>
    <?php } ?>    
    <td>
        <a id="users_sbu_unit_sbu_unit" href="<?php echo $edit_url; ?>" class="text-success"><?php echo $users_sbu_unit_sbu_unit; ?></a>
    </td>
    <td>
        <a id="users_sbu_unit_percentage" href="<?php echo $edit_url; ?>" class="text-success"><?php echo $users_sbu_unit_percentage; ?></a>
    </td>    
    <td class="hidden-xs">
        <span id="users_sbu_unit_status_id" <?php echo $users_sbu_unit_status_id == 'Active' ? 'class="badge badge-success"' : 'class="badge badge-error"' ; ?> ><?php echo $users_sbu_unit_status_id; ?></span>
    </td>    
    <td>
        <div class="btn-group">
            <a class="btn btn-xs text-muted" href="{{ $edit_url }}"><i class="fa fa-pencil"></i> {{ lang('common.edit') }}</a>
        </div>
        <div class="btn-group">
            <a class="btn btn-xs text-muted" href="#" data-close-others="true" data-toggle="dropdown"><i class="fa fa-gear"></i> {{ lang('common.options') }}</a>
            <ul class="dropdown-menu pull-right">
                {{ $options }}
            </ul>
        </div>
    </td>
</tr>