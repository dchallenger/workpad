<?php
	$CI =& get_instance();
	$CI->load->model('change_request_model');
?>
<div id="personal_request" class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('my_change_request.change_request') }} <small class="text-muted">{{ lang('common.view') }}</small></div>
	</div>
    <div class="portlet-body form" id="main_form">
    	<form name="change-request-form">
	    	<input type="hidden" id="user_id" name="user_id" value="{{ $record['user_id'] }}">
			<input type="hidden" id="created_on" name="created_on" value="{{ $record['created_on'] }}">
	    	<!-- BEGIN FORM-->
	        <div class="form-body">
			    @if( sizeof( $record ) > 0 )
		    		<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 text-right text-muted margin-none">{{ lang('my_change_request.employee') }} :</label>
								<div class="col-md-7 col-sm-7">
									<span>{{ $record['employee_name'] }}</span>
								</div>
							</div>
						</div>
					</div>
		            <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 text-right text-muted margin-none">{{ lang('my_change_request.company') }} :</label>
								<div class="col-md-7 col-sm-7">
									<span>{{ $record['company'] }}</span>
								</div>
							</div>
						</div>
					</div>	
		            <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 text-right text-muted margin-none">{{ lang('my_change_request.dept') }} :</label>
								<div class="col-md-7 col-sm-7">
									<span>{{ $record['department'] }}</span>
								</div>
							</div>
						</div>
					</div>
		            <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 text-right text-muted margin-none">{{ lang('my_change_request.remarks') }} :</label>
								<div class="col-md-7 col-sm-7">
									<span>{{ $record['remarks'] }}</span>
								</div>
							</div>
						</div>
					</div>						
		            <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 text-right text-muted margin-none">{{ lang('my_change_request.submitted_on') }} :</label>
								<div class="col-md-7 col-sm-7">
									<span>{{ date("F d, Y - h:i a", strtotime($record['created_on'])) }}</span>
								</div>
							</div>
						</div>
					</div>	
					<div class="portlet">
						<div class="portlet-title margin-top-25">
							<div class="caption">{{ lang('my_change_request.requested_item') }}</div>
							<div class="tools">
								<a class="collapse" href="javascript:;"></a>
							</div>
						</div>
						<p class="margin-bottom-25">{{ lang('my_change_request.req_note') }}</p>	
						<div class="portlet-body form">
			    			<table class="table table-condensed table-striped table-hover" >
								<thead>
									<tr>
										<th width="30%" class="padding-top-bottom-10" >{{ lang('my_change_request.item') }}</th>
										<!-- <th width="30%" class="padding-top-bottom-10 hidden-xs" >{{ lang('my_change_request.current') }}</th> -->
										<th width="30%" class="padding-top-bottom-10">{{ lang('my_change_request.request') }}</th>
										<!-- <th width="20%" class="padding-top-bottom-10" >{{ lang('common.actions') }}</th> -->
									</tr>
								</thead>
								<tbody>
									@foreach($request_details as $key => $request)
										<?php
											switch ($request['key_code']) {
												case 'phone':
													$request['key_label'] = 'Office Phone';
													break;
												case 'mobile':
													$request['key_label'] = 'Office Mobile';
													break;
												case 'email':
													$request['key_label'] = 'Office Email';
													break;
												case 'personal_phone':
													$request['key_label'] = 'Personal Phone';
													break;
												case 'personal_mobile':
													$request['key_label'] = 'Personal Mobile';
													break;
												case 'personal_email':
													$request['key_label'] = 'Personal Email';
													break;					
											}
										?>									
										<tr>
											<td>{{ $request['key_label'] }}</td> 
											<!-- <td></td> -->
											<td>
												@if (in_array($request['key_id'],array(218,219)))
													@if ($request['key_value'] == 1)
														Yes
													@else
														No
													@endif
												@elseif (in_array($request['key_id'],array(244)))
		                                            <?php 
		                                                if( isset($request['key_value'])) {
		                                                    $file = FCPATH . urldecode($request['key_value']);
		                                                    if( file_exists( $file ) )
		                                                    {
		                                                        $f_info = get_file_info( $file );
		                                                        $f_type = filetype( $file );

		/*                                                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
		                                                        $f_type = finfo_file($finfo, $file);*/
		                                                        $is_image = false;
		                                                        switch( $f_type )
		                                                        {
		                                                            case 'image/jpeg':
		                                                            case 'image/jpg':
		                                                            case 'image/bmp':
		                                                            case 'image/png':
		                                                            case 'image/gif':
		                                                                $icon = 'fa-picture-o';
		                                                                $is_image = true;
		                                                                break;
		                                                            case 'video/mp4':
		                                                                $icon = 'fa-film';
		                                                                break;
		                                                            case 'audio/mpeg':
		                                                                $icon = 'fa-volume-up';
		                                                                break;
		                                                            default:
		                                                                $icon = 'fa-file-text-o';
		                                                        }

		                                                        $filepath = base_url()."my_change_request/download_file_directly/".urlencode(base64_encode($request['key_value']));
		                                                        $file_view = base_url().$request['key_value'];
		                                                        // $path = site_url() . 'uploads/' . $this->module_link . '/' . $file;
		                                                        echo '<li class="padding-3 fileupload-delete-'.$request['key_value'].'" style="list-style:none;">';
		                                                        if($is_image){
		                                                            echo '<img src="'.$file_view.'" class="img-responsive" alt="" />';
		                                                        }
		                                                        echo '<a href="'.$filepath.'">
		                                                            <span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
		                                                            <span>'. basename($f_info['name']) .'</span>
		                                                            </a>
		                                                        </li>'
		                                                        // <span class="padding-left-10"><a style="float: none;" data-dismiss="fileupload" class="close fileupload-delete" upload_id="'.$details['attachment-file'].'" href="javascript:void(0)"></a></span>
		                                                        ;
		                                                    }
		                                                }
		                                            ?>
		                                        @elseif ($request['key_id'] == 3)
		                                        	<?php
		                                        		$cities = $CI->change_request_model->get_city($request['key_value']);
		                                        		echo $cities
		                                        	?>
		                                        @elseif ($request['key_id'] == 4)
		                                        	<?php
		                                        		$cities = $CI->change_request_model->get_country($request['key_value']);
		                                        		echo $cities
		                                        	?>
												@else						
													{{ $request['key_value'] }}
												@endif
											</td>
<!-- 											<td>
												@if ($can_approve)
													<div class="make-switch" data-off="danger" data-on="success" data-on-label="&nbsp;&nbsp;{{ lang('my_change_request.approved') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" data-off-label="&nbsp;{{ lang('my_change_request.decline') }}&nbsp;">
														<input type="hidden" name="personal_id[{{ $request['record_id'] }}]" value="{{ $request['status'] }}"/>
														<input type="checkbox" class="dontserializeme toggle" name="temp-personal_id[]" value="{{ $request['record_id'] }}" {{ ($request['status'] == 3) ?  'checked="checked"' : '' }} />
													</div>
												@endif
											</td> -->
										</tr>
									@endforeach
								</tbody>
			    			</table>
			    		</div>
		    		</div>
			    @endif	
	        </div>
	        <!-- END FORM--> 
	    </form>
    </div>
</div>
