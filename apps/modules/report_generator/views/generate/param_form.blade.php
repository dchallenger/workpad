<div class="portlet">
	<div class="portlet-body form">
    	<div class="form-body">
    		<table class="table">
				<thead>
					<tr class="hidden">
						<td>Column</td>
						<td>Operator</td>
						<td>Filter</td>
					</tr>
					<tr>
						<td colspan="3">Required <label class="control-label"><span class="required">*</span></label></td>
					</tr>
				</thead>
				<tbody>
					@if( $fixed_filters->num_rows() > 0 )
						@foreach( $fixed_filters->result() as $filter )
							<?php switch( $filter->uitype_id ):
			                	case 1:
			                	case 9:
			                		$label = explode( '_', $filter->label_column );
			                		$label = ucwords( implode( ' ', $label ) );
			                		$db->limit(1);
			                		$value = $db->get_where( $filter->table, array($filter->value_column => $filter->filter) )->row();
									$temp = $filter->label_column;
			                		$value = $value->$temp;
			                		break;
			                	default:
			                		$label = explode( '.', $filter->column );
			                		$label = explode( '_', $label[1] );
			                		$label = ucwords( implode( ' ', $label ) );
			                		$value = $filter->filter;
			            	endswitch; ?>
							<tr class="hidden">
								<td>{{ $label }} <?php echo ($filter->required == 1 ? '<label class="control-label"><span class="required">*</span></label>' : '')?></td>
								<td>{{ $filter->label }}</td>
								<td>{{ $value }}</td>
							</tr>
		                @endforeach
	                @endif
	                @if( $editable_filters->num_rows() > 0 )
		                @foreach( $editable_filters->result() as $filter )
							<?php 
								switch( $filter->uitype_id ):
				                	case 1:
				                	case 9:
				                		$label = explode( '_', $filter->label_column );
				                		$label = ucwords( implode( ' ', $label ) );
				                		break;
				                	default:
				                		$label = explode( '.', $filter->column );
				                		$label = explode( '_', $label[1] );
				                		$label = ucwords( implode( ' ', $label ) );
				                		$value = $filter->filter;
				            	endswitch; 

				            	switch ($label) {
				            		case 'Employment Type':
				            			$label = 'Level';
				            			break;
				            		case 'Full Name':
				            			$label = 'Employee';
				            			break;				            			
				            	}
			            	?>

							<tr>
								<input type="hidden" class="<?php echo ($filter->required == 1 ? 'required' : '' ) ?>" label="<?php echo $label ?>" form-name="filter[<?php echo $filter->filter_id ?>]">
								<input type="hidden" class="form-control" name="filter_var[{{$filter->value_column}}]" value="{{$filter->filter_id}}" readonly>
								<td>{{ $label }} <?php echo ($filter->required == 1 ? '<label class="control-label"><span class="required">*</span></label>' : '')?></td>
								<td>{{ $filter->label }}</td>
								<td>
									<?php switch( $filter->uitype_id ):
					                	case 1:
					                		$d_label = $filter->label_column;
					                		$d_value = $filter->value_column;
					                		
					                		$options = array();
											
											// TO FILTER THE ACCESS
					                		if($filter->table == 'users_company'){
					                		 	//$db->where_in('company_id', explode(',', $region_companies) );
					                		}
					                		else if($filter->table == 'payroll_year'){
					                		}
					                		else if($filter->table == 'month'){
					                		}
					                		else if($filter->table == 'users'){
					                		 	//$db->where_in('company_id', explode(',', $region_companies) );
					                		 	$options['all'] = "All";	
					                		}else{
					                			$options['all'] = "All";
					                		}
					                		$db->where('deleted', 0);
				                			if($filter->table == 'month'){
				                				$db->order_by($d_value, 'ASC');		
				                			} else{
					                			$db->order_by($d_label, 'ASC');	
					                		}
											
											if ($filter->table == 'users_division' || $filter->table == 'ww_users_division')
												$db->select($d_label.','.$d_value.',division_code');
											else
												$db->select($d_label.','.$d_value);

											$rows = $db->get( $filter->table )->result();
											
											foreach( $rows as $row )
											{
												if ($filter->table == 'users_division' || $filter->table == 'ww_users_division')
													$options[$row->$d_value] = $row->$d_label. ' ('.get_division_code($row->division_code,'-').')';
												else
													$options[$row->$d_value] = $row->$d_label;												
											}
											echo form_dropdown('filter['.$filter->filter_id.']', $options, '', 'class="form-control select2me '.$d_label.'" data-placeholder="Select..."');
					                		break;
					                	case 2:
					                		$booleans = array(
												"1" => "YES",
												"0" => "NO"
											);
											echo form_dropdown('filter['.$filter->filter_id.']', $booleans, '', 'class="form-control select2me" data-placeholder="Select..."');
					                		break;
					                	case 3: ?>
											<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
												<input type="text" class="form-control" name="filter[{{$filter->filter_id}}]" value="" readonly>
												<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div> <?php
					                		break;
					                	case 4; //date and time ?>
											<div class="input-group date form_datetime">                                       
												<input type="text" size="16" readonly class="form-control dtp" name="filter[{{$filter->filter_id}}]" value="" />
												<span class="input-group-btn">
													<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
												</span>
												<span class="input-group-btn">
													<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div> <?php
											break;
										case 5; //time ?>
											<div class="input-group bootstrap-timepicker">                                       
												<input type="text" class="form-control timepicker-default" name="filter[{{$filter->filter_id}}]"/>
												<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
												</span>
											</div> <?php
											break;
					                	case 9:
					                		$d_label = $filter->label_column;
					                		$d_value = $filter->value_column;
					                		
					                		$db->where('deleted', 0);
											
				                			if($filter->table == 'month'){
				                				$db->order_by($d_value, 'ASC');		
				                			} else{
					                			$db->order_by($d_label, 'ASC');	
					                		}
											
											if ($filter->table == 'users_division' || $filter->table == 'ww_users_division')
												$db->select($d_label.','.$d_value.',division_code');
											else
												$db->select($d_label.','.$d_value);

											$rows = $db->get( $filter->table )->result();
											
											$options = array();
											// $options['all'] = "All";
											foreach( $rows as $row )
											{
												if ($filter->table == 'users_division' || $filter->table == 'ww_users_division')
													$options[$row->$d_value] = $row->$d_label. ' ('.get_division_code($row->division_code,'-').')';
												else
													$options[$row->$d_value] = $row->$d_label;
											}
											echo form_dropdown('filter['.$filter->filter_id.'][]', $options, '', 'class="form-control select2me multiple_dropdown_tags '.$d_label.'" multiple="multiple" data-placeholder="Select..." id="'.$d_label.'"');
					                		break;
					                	default: ?>
					                		<input type="text" class="form-control" name="filter[{{$filter->column}}][{{ $filter->operator }}]" value=""> <?php
					            	endswitch; ?>
								</td>
							</tr>
		                @endforeach
		            @endif
				</tbody>
			</table>
        </div>
    </div>
</div>