<?php
$this->db->where('recruitment_process_schedule.user_id',$this->user->user_id);
$this->db->where('request_id',$request_id);
$this->db->where('type',2);
$this->db->join('recruitment_process','recruitment_process_schedule.process_id = recruitment_process.process_id');
$result = $this->db->get('recruitment_process_schedule');
if ($result)
	$count = $result->num_rows();
else
	$count = 0;
?>
<li class="media">
	<div class="media-body">
		<h4 class="media-heading"><?php echo $step->status?></h4>
		<p class="small"><?php echo $step->description?></p>
	</div>
	<div class="well margin-top-10"><?php
		if( ($is_assigned && isset($recruit )) || ($is_interviewer && $count > 0) ):
			foreach( $recruit as $rec ): ?>
				<span class="margin-right-5">
					<span class="btn default btn-xs movable-label">:</span>
					<a type="button" class="btn btn-primary btn-xs onclick-name" href="javascript:get_interview_list(<?php echo $rec->process_id?>)"> <?php
						switch( $rec->gender )
						{
							case 'Female':
								echo '<i class="fa fa-female"></i>';
								break;
							default:
								echo '<i class="fa fa-male"></i>';
								break;
						} ?>
						<?php echo $rec->fullname?>
					</a>
				</span> <?php
			endforeach;
		endif;?>
	</div>
</li>