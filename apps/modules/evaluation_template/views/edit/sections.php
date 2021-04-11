<table class="table">
	<thead>
		<tr>
			<th>Section Title</th>
			<th>Sequence</th>
			<th>Section Type</th>
			<?php if ($type == 'edit') { ?>
				<th>Action</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php 
		if ($sections && $sections->num_rows() > 0) {
			foreach ($sections->result() as $row) {
		?>
				<tr>
					<td><?php echo $row->template_section?></td>
					<td><?php echo $row->sequence?></td>
					<td><?php echo $row->section_type?></td>
					<?php if ($type == 'edit') { ?>
						<td>
							<a class="" href="javascript:section_form(<?php echo $row->template_section_id?>)">Edit</a>
							<a class="" href="javascript:delete_section(<?php echo $row->template_section_id?>)">Delete</a>
						</td>
					<?php } ?>
				</tr>
		<?php
			}
		}
		?>
	</tbody>
</table>