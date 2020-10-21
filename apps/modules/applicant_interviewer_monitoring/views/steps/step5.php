<li class="media">
	<div class="media-body">
		<h4 class="media-heading"><?php echo $step->status?></h4>
		<p class="small"><?php echo $step->description?></p>
	</div>
	<div class="well margin-top-10"><?php
		if( isset($recruit ) ):
			foreach( $recruit as $rec ): ?>
				<span class="margin-right-5">
					<span class="btn default btn-xs movable-label">:</span>
					<a type="button" class="btn btn-primary btn-xs onclick-name" href="javascript:get_cs_form(<?php echo $rec->process_id?>)"> <?php
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