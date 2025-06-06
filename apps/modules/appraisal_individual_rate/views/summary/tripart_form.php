<tr>
	<td>
		<?php
			$library = $this->db->get_where('performance_setup_library', array('deleted' => 0));
		?>
		<select name="pdp_library[<?php echo $item_id?>][<?php echo $column_id?>][]" class="form-control select2me" data-placeholder="Select...">
       	<?php foreach($library->result() as $row):?>
       		<option value="<?php echo $row->library_id?>"><?php echo $row->library?></option>
      	<?php endforeach;?>
        </select>
        <br>
		<span class="small text-muted">
			<a class="small text-muted" href="javascript:remove_pdp( $(this) )">Delete</a>
		</span>
	</td>
	<td>
		<textarea name="pdp_comment[<?php echo $item_id?>][<?php echo $column_id?>][]" rows="3" class="form-control"></textarea>
	</td>
	<td>
		<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
			<input type="text" size="16" class="form-control" name="pdp_date[<?php echo $item_id?>][<?php echo $column_id?>][]">
			<span class="input-group-btn">
				<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
			</span>
		</div>
	</td>
</tr>