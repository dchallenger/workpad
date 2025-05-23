<div class="portlet">

	<style>
		.event-block {cursor:pointer;margin-bottom:5px;display:inline-block;position:relative;}
	</style>

	<div class="portlet-title" style="margin-bottom:3px;">
		<div class="caption">Transaction Class</div>
	</div>
	<div class="portlet-body">
		<span class="small text-muted margin-bottom-10">Filter partner list by company.</span>
		<div class="margin-top-10">
			<span class="list-filter event-block label label-success" filter_value="">All</span>
			@foreach( $transaction_class as $row )
			<span class="list-filter event-block label label-default" filter_by="ww_payroll_transaction.transaction_class_id" filter_value="{{ $row->transaction_class_id }}">{{ $row->transaction_class }}</span>
	        @endforeach
		</div>
	</div>

</div>