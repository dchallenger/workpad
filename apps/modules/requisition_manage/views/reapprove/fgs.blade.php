<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Purchase Request</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		@include('common/form_head')
	</div>
</div>

<div class="portlet">
	<div class="portlet-title">
		<div class="caption">List of Items</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">
			<div class="portlet margin-top-25">
				<div class="portlet-body" >
					<!-- Table -->
					<table class="table table-condensed table-striped table-hover" >
						<thead>
							<tr>
								<th width="20%" class="padding-top-bottom-10" >Item</th>
								<th width="20%" class="padding-top-bottom-10" >Reason</th>
								<th width="20%" class="padding-top-bottom-10" >Date</th>
								<th width="10%" class="padding-top-bottom-10" >Quantity</th>
								<th width="10%" class="padding-top-bottom-10" >Unit</th>
								<th width="15%" class="padding-top-bottom-10" >Amount</th>
								<th width="10%" class="padding-top-bottom-10" >Status</th>
							</tr>
						</thead>
						<tbody class="item-list">
							@foreach( $items as $item )
								<tr>
									<td>
										<input type="hidden" name="requisition_items[unit_price][]" value="{{ $item->unit_price }}" />
										<textarea rows="2" name="requisition_items[item][]" class="form-control" readonly>{{ $item->item }}</textarea>
									</td>
									<td>
										<textarea rows="2" name="requisition_items[reason][]" class="form-control" readonly>{{ $item->reason }}</textarea>
									</td>
									<td>
										<div class="input-group date date-picker" data-date-format="MM dd, yyyy">
											<input type="text"  class="form-control" name="requisition_items[date][]" value="{{ date('M d, Y', strtotime($item->date)) }}" readonly>
											<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</td>
									<td><input type="text" name="requisition_items[quantity][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false" class="form-control" value="{{ $item->quantity }}" readonly></td>
									<td><input type="text" name="requisition_items[actual_price][]" value="{{ $item->actual_price }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false" class="form-control" readonly></td>
									<td><input type="text" name="requisition_items[amount][]" value="{{ number_format($item->quantity*$item->actual_price, 2, '.', ',') }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false" class="form-control" readonly></td>
									<td>
										<div class="make-switch switch-small switch-success" data-on-label="<i class='fa fa-check icon-white'></i>" data-off-label="<i class='fa fa-times'></i>">
									    	<input type="checkbox" value="1" @if( $item->proceed ) checked="checked" @endif name="temprequisition_items[proceed][]" class="dontserializeme toggle"/>
									    	<input type="hidden" name="requisition_items[proceed][]" value="{{ $item->proceed }}"/>
										</div>
									</td>
								</tr>
							@endforeach
							<tr  class="success">
								<td colspan="5" class="text-right"><b>TOTAL AMOUNT</b></td>
								<td>
									<input type="hidden" class="form-control" name="requisition[no_of_items]" value="{{ number_format($record['requisition.no_of_items'], 2, '.', ',') }}" >
									<input type="text" class="form-control" name="requisition[total_price]" value="{{ number_format($record['requisition.total_price'], 2, '.', ',') }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false" readonly></td>
								<td>&nbsp;</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Approver Remarks</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">
			<div class="portlet margin-top-25">
				<div class="portlet-body" >
					@include('common/approver_remarks')
				</div>
			</div>
		</div>
	</div>
</div>