<div class="portlet">

	<style>
		.event-block {cursor:pointer;margin-bottom:5px;display:inline-block;position:relative;}
	</style>

	<div class="portlet-title" style="margin-bottom:3px;">
		<div class="caption">{{ lang('partners.company') }}</div>
	</div>
	<div class="portlet-body">
		<span class="small text-muted margin-bottom-10">{{ lang('partners.filter_by_company') }}</span>
		<div class="margin-top-10">
			<span class="filter-company event-block label label-success" filter_value="">{{ lang('common.all') }}</span>
			@foreach( $companys as $company )
	        	<span href="javascript:void(0)" class="filter-company event-block label label-default" filter_value="{{ $company->company_id }}">{{ $company->company }}</span>
	        @endforeach
		</div>
	</div>
</div>