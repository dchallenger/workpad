<div class="portlet">

	<style>
		.event-block {cursor:pointer;margin-bottom:5px;display:inline-block;position:relative;}
	</style>

	<div class="portlet-title" style="margin-bottom:3px;">
		<div class="caption">Planning Status</div>
	</div>
	<div class="portlet-body">
		<span class="small text-muted margin-bottom-10">Filter planning by status.</span>
		<div class="margin-top-10">
			<span class="filter-type event-block label label-success" filter_value="">All</span>
			@foreach( $performance_status as $performance_stat )
	        	<span href="javascript:void(0)" class="filter-type event-block label label-default" filter_value="{{ $performance_stat->performance_status_id }}">{{ $performance_stat->performance_status }}</span>
	        @endforeach
		</div>
	</div>

</div>