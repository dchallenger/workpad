<tr class="record">
    <td>
        <div>
            <input type="checkbox" class="record-checker checkboxes" value="{{ $record_id }}">
        </div>
    </td>	
	<td>
		<span class="">{{$certificate_of_employment_coe_type}}</span>
	</td>
	<td>
		{{$certificate_of_employment_display_name}}
	</td>
    <td><span class=""><?php echo date("M d, Y",strtotime($certificate_of_employment_created_on)); ?></span></td>
	<td>
		<div class="btn-group">
			<a class="btn btn-xs text-muted" href="{{$detail_url}}"><i class="fa fa-download"></i> Download</a>
		</div>
	</td>
</tr>