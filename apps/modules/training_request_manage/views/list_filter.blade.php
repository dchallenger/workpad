<div class="portlet">

	<style>
		.event-block {cursor:pointer;margin-bottom:5px;display:inline-block;position:relative;}
	</style>
	<div class="portlet-title margin-top-20" style="margin-bottom:3px;">
		<div class="caption">{{ lang('common.status') }}</div>
	</div>
	<div class="portlet-body">
		<span class="small text-muted margin-bottom-10">Filter by applicant status.</span>
		<div class="margin-top-10">
			<span class="filter-status event-block label label-success" filter_value="">{{ lang('common.all') }}</span>
			@foreach( $status->result() as $stat )
	        	<span href="javascript:void(0)" class="filter-status event-block label label-default" filter_value="{{$stat->training_application_status_id}}">{{ $stat->training_application_status }}</span>
        	@endforeach
		</div>
	</div>
</div>