<tr class="record">
	<td>
		{{ $performance_appraisal_year }}
	</td>
	<td>
		<?php
			$href = $mod->url . '/review/'.$record_id.'/'.$user_id;		
		?>
		<a class="text-success" href="{{ $href }}">
			<?php 
                $image_dir_thumb = FCPATH.'uploads/users/thumbnail/';
                $image_dir_full  = FCPATH.'uploads/users/';

                $avatar = basename(base_url( $photo ));

                $file_name_thumbnail = $image_dir_thumb . $avatar;
                $file_name_full = $image_dir_full . $avatar;

                if(file_exists(urldecode($file_name_thumbnail))){
                    $avatar = base_url() . "uploads/users/thumbnail/" . $avatar;
                }
                else if(file_exists($file_name_full)){
                    $avatar = base_url() . "uploads/users/" . $avatar;
                }
                else{
                    $avatar = base_url() . "uploads/users/avatar.png";
                }			
			?>
			<span class="pull-left margin-right-10"><img src="{{ $avatar }}" alt="photo" width="48px" /></span>
			<span class="pull-left">
				{{ $fullname }}
				@if ($employment_status_id == 8)
					<span class="small text-danger">({{ $employment_status }})</span>
				@endif
				<br>
				<span class="small text-muted" id="date_set">
					{{ $performance_type }} / {{ date('M d, Y', strtotime( $performance_appraisal_date_from ) ) }} to {{ date('M d, Y', strtotime( $performance_appraisal_date_to ) ) }}
				</span>				
			</span>
		</a>
	</td>
	<!-- <td class="hidden-xs">
		<a class="text-success" href="{{ $edit_url }}/{{ $user_id }}">{{ $performance_type }}</a>
		<br>
		<span class="small" id="date_set">{{ date('M d, Y', strtotime( $performance_appraisal_date_from ) ) }} to {{ date('M d, Y', strtotime( $performance_appraisal_date_to ) ) }}</span>
	</td> -->
	<!-- <td>
		<span class="badge badge-info">{{ $crowdsource }}</span>
	</td> -->
	<td class="hidden-xs">
		<?php	
			$href = $mod->url . '/review/'.$record_id.'/'.$user_id;
			switch($performance_appraisal_performance_status_id){
				case 1: //Draft
				case 3: //Draft
					$color_class = 'yellow';
				break;
				case 6: //For Employees Review
					$color_class = 'yellow';
				break;
				case 11: //For Immediate Superior Review
					$color_class = 'yellow';
				break;
				case 2: //For Approval
				case 14:
					$color_class = 'yellow';
				break;
				case 4: //Approved
				case 13: //Approved
					$color_class = 'green';
				break;				
				default:
					$color_class = 'default';
				break;
			}
		?>
		<!-- <a href="{{ $edit_url }}/{{ $user_id }}"> -->
			<span class="btn btn-xs text-muted {{$color_class}}">
				{{$performance_appraisal_performance_status}}
			</span>
		<!-- </a> -->
	</td>
	<td>
    	<?php
			$href = get_mod_route('appraisal_individual_rate') . '/review_admin/'.$record_id.'/'.$user_id;
		?>		
        <div class="btn-group">
        	<a class="small text-muted" href="{{ $href }}"><i class="fa fa-search"></i> {{ lang('common.view') }}</a>
        </div>
        @if(in_array($performance_appraisal_performance_status_id,array(2,14)) && $hr_appraisal_admin && $status_id == 1)
	        <div class="btn-group">
	        	<?php
					$href = get_mod_route('appraisal_individual_rate') . '/edit_admin/'.$record_id.'/'.$user_id;
				?>
	            <a class="small text-muted" href="{{ $href }}"><i class="fa fa-pencil"></i> Edit</a>
	        </div>
	    @endif        
    </td>
</tr>