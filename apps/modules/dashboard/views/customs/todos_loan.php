<style type="text/css">
	.popover {max-width: 400px !important;}
</style>

<?php 
	if( $todos ){
		for($i=0; $i<count($todos); $i++) :
		 	if( $i < 5 ) {
		 ?>
	        <li id="todo-lst-loan-<?php echo $todos[$i]['loan_application_id'] ?>" class="clearfix" >
	            <div class="task-title">
	            	<span class="task-title-sp">
	            		<a href="<?php echo get_mod_route('loan_application_manage', 'detail'. '/' . $todos[$i]['loan_application_id']);?>"><?php echo $todos[$i]['display_name'] ?></a>
            		</span>
					<span class="small text-muted"><br><?php
		            	if( $localize_time ){
	                    	echo localize_timeline( $todos[$i]['created_on'], $user['timezone'] );
	                    }
	                    else{
	                       echo $todos[$i]['createdon'];
	                    } ?>
                    </span>
	            	<span onclick="get_loan_application_details('<?php echo $todos[$i]['loan_type_code'] ?>', <?php echo $todos[$i]['loan_application_id'] ?>)"
	            		class="btn btn-xs btn-success btn-border-radius pull-right custom_popover" 
	            		style="cursor: pointer; margin-top: -18px;"
	            		data-placement="left" 
	                	data-original-title="<?php echo $todos[$i]['loan_type'] ?>"
	                	id="manage_dialog-<?php echo $todos[$i]['loan_application_id'] ?>">
	                	<?php echo $todos[$i]['loan_type'] ?></span>
	            </div>
	            <?php if(isset($business_group) && sizeof($business_group) > 1){ ?>
                <div class="task-title">
					<span class="text-success small"><span><?php echo $todos[$i]['group']?></span><span>&nbsp;/&nbsp;</span><span><?php echo $todos[$i]['company']?></span></span>
				</div>
                <?php }?>
	    	</li>
	    <?php
	    	}
	    	else{
	    ?>
	    	<li class="todo_more_loan hidden" id="todo-lst-loan-<?php echo $todos[$i]['loan_application_id'] ?>" >
	            <div class="task-title">
	            	<span class="task-title-sp">
	            	<a href="<?php echo get_mod_route('loan_application_manage', 'detail'. '/' . $todos[$i]['loan_application_id']);?>"><?php echo $todos[$i]['display_name'] ?></a>
	            	</span>
					<span class="small text-muted"><br><?php
		            	if( $localize_time ){
	                    	echo localize_timeline( $todos[$i]['created_on'], $user['timezone'] );
	                    }
	                    else{
	                       echo $todos[$i]['createdon'];
	                    } ?>
                    </span>
	            	<span onclick="get_loan_application_details('<?php echo $todos[$i]['loan_type_code'] ?>', <?php echo $todos[$i]['loan_application_id'] ?>)"
	            		class="btn btn-xs btn-success btn-border-radius pull-right custom_popover" 
	            		style="cursor: pointer; margin-top: -18px;"
	            		data-placement="left" 
	                	data-original-title="<?php echo $todos[$i]['loan_type'] ?>"
	                	id="manage_dialog-<?php echo $todos[$i]['loan_application_id'] ?>">
	                	<?php echo $todos[$i]['loan_type'] ?></span>
	            </div>
	            <?php if(isset($business_group) && sizeof($business_group) > 1){ ?>
                <div class="task-title">
					<span class="text-success small"><span><?php echo $todos[$i]['group']?></span><span>&nbsp;/&nbsp;</span><span><?php echo $todos[$i]['company']?></span></span>
				</div>
                <?php }?>
	    	</li>
	    <?php		
	    	}
    	endfor; ?>
    	
    	<?php
	}
	else{ ?>
		<li class="in" style="margin: 0px 0px 1px 20px;padding: 1px 0px;">
	        <?php echo lang('dashboard.todo_none') ?>
	    </li><?php 
	} 
?>