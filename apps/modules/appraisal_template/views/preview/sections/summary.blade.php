{{ $header }}
<table class="table">
	<tbody>
		@foreach( $sections as $section )
			<?php $rowspan = 2;?>
			@foreach( $section->children as $child )
				@if( !empty( $child->weight ) )
					<?php $rowspan++; ?>
				@endif
			@endforeach

			@if( !empty( $section->weight ) )
				<tr section_id="{{ $section->template_section_id }}">
					<td rowspan="{{ $rowspan }}">
						<h4>{{ $section->template_section }}</h4>
						{{ $section->weight }}%
					</td>
					<?php $fstchild = $section->children[0]?>
					<td>
						{{ $fstchild->template_section }}
						@if( !empty( $fstchild->weight ) )
							({{ $fstchild->weight }}%)
						@endif
					</td>
					<td>
						<input type="text" class="form-control summary-section" section_id="{{ $fstchild->template_section_id }}" readonly>
					</td>
				</tr>
				<?php unset( $section->children[0] )?>
				@foreach( $section->children as $child )
					@if( !empty( $child->weight ) )
						<tr section_id="{{ $section->template_section_id }}">
							<td>
								{{ $child->template_section }}
								({{ $child->weight }}%)
							</td>
							<td>
								<input type="text" class="form-control summary-section" section_id="{{ $child->template_section_id }}" readonly>
							</td>
						</tr>
					@endif
				@endforeach
				<tr>
					<td>
						<span class="pull-right">{{ $section->template_section }} RATING:<span>
					</span></span></td>
					<td><input type="text" class="form-control" readonly></td>
				</tr>
				<tr class="warning">
					<td>
						<span class="pull-right bold">WEIGHTED {{ $section->template_section }} RATING:<span>
					</span></span></td>
					<td><input type="text" class="form-control grand-section-total" weight="{{ $section->weight }}" section_id="{{ $section->template_section_id }}" readonly></td>
				</tr>
			@endif
		@endforeach
		<tr class="success">
			<td colspan="2">
				<h4 class="pull-right bold">FINAL RATING:</h4><h4>
			</h4></td>
			<td><input type="text" class="form-control final_total" readonly value="0"></td>
		</tr>
	</tbody>
</table>
{{ $footer }}	