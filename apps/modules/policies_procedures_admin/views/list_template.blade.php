<tr class="record">
	<td>
		<a href="#" class="text-success">{{$createdbyname}}</a>
		<br />
		<span class="small">{{$login}}</span>
	</td>
	<td>
		<a href="#" class="text-success">{{$resources_policies_title}}</a>
	</td>
    <td class="hidden-xs"><?php echo date("M-d",strtotime($resources_policies_created_on)); ?> <span class="text-muted small"><?php echo date("D",strtotime($resources_policies_created_on)); ?></span><br>
        <span class="text-muted small"><?php echo date("Y",strtotime($resources_policies_created_on)); ?></span>
    </td>
	<td>
		<div class="btn-group">
			<a href="{{$edit_url}}"><i class="fa fa-pencil"></i> {{ lang('common.edit') }}</a>
		</div>		
		<div class="btn-group">
            <a class="btn btn-xs text-muted" href="#" data-close-others="true" data-toggle="dropdown"><i class="fa fa-gear"></i> Options</a>
            <ul class="dropdown-menu pull-right">
            	<li>
					<?php 
						$file = FCPATH . urldecode( $resources_policies_attachments);
						if( file_exists( $file ) )
						{
							$f_info = get_file_info( $file );
							$f_type = filetype( $file );

							$finfo = finfo_open(FILEINFO_MIME_TYPE);
							$f_type = finfo_file($finfo, $file);
						}
					?>     
					<a href="{{base_url($resources_policies_attachments)}}" target="_blank"><i class="fa fa-search"></i> {{ lang('common.view') }}</a>
            	</li>
                <li>{{$delete_url_javascript}}</li>                    
            </ul>
        </div>
	</td>
</tr>