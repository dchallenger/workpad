<tr class="record">
	<!-- this first column shows the year of this holiday item -->
	<td>
		{{$resources_request_user_id}}
	</td>
	<td>
		{{$resources_request_online_request_type}}
	</td>
    <td class="hidden-xs"><?php echo date("M-d",strtotime($resources_request_created_on)); ?> <span class="text-muted small"><?php echo date("D",strtotime($resources_request_created_on)); ?></span><br>
        <span class="text-muted small"><?php echo date("Y",strtotime($resources_request_created_on)); ?></span>
    </td>
    <td class="hidden-xs"><?php echo date("M-d",strtotime($resources_request_date_needed)); ?> <span class="text-muted small"><?php echo date("D",strtotime($resources_request_date_needed)); ?></span><br>
        <span class="text-muted small"><?php echo date("Y",strtotime($resources_request_date_needed)); ?></span>
    </td>
	<td class="hidden-xs">
		<span class="text-muted small">{{$request_status}}</span>
	</td>
	<td>
		@if ($request_status_id == 2)
		    <div class="btn-group">
				<a class="btn btn-xs text-muted" href="{{ $edit_url }}"><i class="fa fa-pencil"></i>{{ lang('common.edit') }}</a>
			</div>
		@elseif (in_array($request_status_id,[1,3,4,5,6]))
			<div class="btn-group">
				<a class="btn btn-xs text-muted" href="{{ $detail_url }}"><i class="fa fa-search"></i>{{ lang('common.view') }}</a>
			</div>			
		@endif
		<!-- @if(in_array($request_status_id, array(1,2,3,5)))
	        <div class="btn-group">
	            <a class="btn btn-xs text-muted" href="{{ $edit_url }}"><i class="fa fa-pencil"></i> Edit</a>
	        </div>
	    @else -->
		    <!-- <div class="btn-group">
				<a class="btn btn-xs text-muted" href="{{ $detail_url }}"><i class="fa fa-search"></i> View</a>
			</div> -->
	    <!-- @endif		 -->
	<!-- 	@if(in_array($request_status_id, array(1,2,3,5)))
			<div class="btn-group">
				<a class="btn btn-xs text-muted"><i class="fa fa-ban"></i> Cancel</a>
			</div>
		@endif -->
	</td>
</tr>