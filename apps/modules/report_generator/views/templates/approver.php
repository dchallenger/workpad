<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
	$columns = array('form_type','Approver');

	$this->db->where('deleted',0);
	$this->db->where('active',1);
	$this->db->where('user_id >',1);
	$this->db->order_by('full_name');
	$users = $this->db->get('users');
?>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td>Employee</td>
		<td>Form Type</td>
		<td>Approver</td>
	</tr><?php
	if ($users && $users->num_rows() > 0) :
		foreach( $users->result() as $row ) : 
			$qry = 'SELECT u.full_name AS `employee`,class AS `form_type`,IFNULL(GROUP_CONCAT(u1.full_name),"") AS `Approver`
					FROM ww_approver_class ac
					LEFT JOIN ww_approver_class_user acu ON (ac.class_id = acu.class_id AND acu.user_id = '.$row->user_id.')
					LEFT JOIN ww_users u ON acu.user_id = u.user_id
					LEFT JOIN ww_users u1 ON acu.approver_id = u1.user_id
					WHERE ac.deleted = 0
					AND (acu.deleted = 0 OR acu.deleted IS NULL)
					GROUP BY ac.class_id,acu.user_id
					ORDER BY u.full_name DESC';
			$result = $this->db->query($qry);

			if ($result && $result->num_rows > 0):
				foreach ($result->result() as $row1):?>
					<tr>
						<td><?php echo $row->full_name ?></td>
						<?php
						foreach($columns as $key => $column): ?>
							<td><?php echo $row1->$column ?></td> <?php
						endforeach; ?>
					</tr> <?php
				endforeach;
			endif;
		endforeach; 
	endif; ?>
</table>