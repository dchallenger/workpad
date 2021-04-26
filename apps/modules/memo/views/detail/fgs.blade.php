<link href="{{ theme_path() }}plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css" rel="stylesheet" type="text/css"/>

<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Memo Information</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
			<p>Basic memorandum information</p>
		<div class="portlet-body form">			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Memo Type</label>
				<div class="col-md-7"><?php									                            		$db->select('memo_type_id,memo_type');
	                            			                            		$db->order_by('memo_type', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('memo_type'); 	                            $memo_memo_type_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$memo_memo_type_id_options[$option->memo_type_id] = $option->memo_type;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('memo[memo_type_id]',$memo_memo_type_id_options, $record['memo_memo_type_id'], 'class="form-control select2me" data-placeholder="Select..." disabled') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Recipient</label>
				<div class="col-md-7"><?php									                            		$db->select('apply_to_id,apply_to');
	                            			                            		$db->order_by('apply_to', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('memo_apply_to'); 	                            $memo_apply_to_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$memo_apply_to_id_options[$option->apply_to_id] = $option->apply_to;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('memo[apply_to_id]',$memo_apply_to_id_options, $record['memo_apply_to_id'], 'class="form-control select2me" data-placeholder="Select..." disabled') }}
	                        </div> 				</div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3"></label>
				<div class="col-md-7">
				<div class="help-block text-muted small">
					<!-- <span class="required"> -->
					Use Company to select all employees which will be the recipient of this memo
					<!-- </span> -->
				</div>
					<?php
						$options = "";
						if( !empty( $record_id ) )
						{
							$options = $mod->_get_applied_to_options( $record_id, true );
						}
					?>
                    <div class="input-group">
						<span class="input-group-addon">
                        <i class="fa fa-list-ul"></i>
                        </span>
                        <select name="memo[applied_to][]" id="memo-applied_to" class="select2me form-control" multiple disabled>
                        	{{ $options }}
                        </select>
                    </div>
                </div>	
			</div>



			<div class="form-group">
				<label class="control-label col-md-3">Memo Title</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="memo[memo_title]" id="memo-memo_title" value="{{ $record['memo_memo_title'] }}" placeholder="Enter Memo Title" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Publish From</label>
				<div class="col-md-7">							<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
								<input type="text" class="form-control" name="memo[publish_from]" id="memo-publish_from" value="{{ $record['memo_publish_from'] }}" placeholder="Enter Publish From" readonly>
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Publish To</label>
				<div class="col-md-7">							<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
								<input type="text" class="form-control" name="memo[publish_to]" id="memo-publish_to" value="{{ $record['memo_publish_to'] }}" placeholder="Enter Publish To" readonly>
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Publish</label>
				<div class="col-md-7">							<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
						    	<input disabled="disabled" type="checkbox" value="1" @if( $record['memo_publish'] ) checked="checked" @endif name="memo[publish][temp]" id="memo-publish-temp" class="dontserializeme toggle"/>
						    	<input type="hidden" name="memo[publish]" id="memo-publish" value="@if( $record['memo_publish'] ) 1 @else 0 @endif"/>
							</div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Allow Comments</label>
				<div class="col-md-7">							<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
						    	<input disabled="disabled" type="checkbox" value="1" @if( $record['memo_comments'] ) checked="checked" @endif name="memo[comments][temp]" id="memo-comments-temp" class="dontserializeme toggle"/>
						    	<input type="hidden" name="memo[comments]" id="memo-comments" value="@if( $record['memo_comments'] ) 1 @else 0 @endif"/>
							</div> 				</div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Email Recipients</label>
				<div class="col-md-7">							<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
						    	<input disabled="disabled" type="checkbox" value="1" @if( $record['memo_email'] ) checked="checked" @endif name="memo[email][temp]" id="memo-email-temp" class="dontserializeme toggle"/>
						    	<input type="hidden" name="memo[email]" id="memo-email" value="@if( $record['memo_email'] ) 1 @else 0 @endif"/>
							</div> 				</div>	
			</div>
				</div>
</div><div class="portlet">
	<div class="portlet-title">
		<div class="caption">Memorandum Detail</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
			<p>Enter memorandum details</p>
		<div class="portlet-body form">			<div class="form-group">
				<label class="control-label col-md-3">Memo Body</label>
				<div class="col-md-9">	
					<div class="help-block text-muted small">Kindly use the text editor below in formatting the content of your memo.</div>
						<div style="background-color:white">{{ $record['memo_memo_body'] }}</div></div>
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Attachment</label>
				<div class="col-md-7">							<div data-provides="fileupload" class="fileupload fileupload-new" id="memo-attachment-container">
								@if( !empty($record['memo_attachment']) )
									<?php 
										$file = FCPATH . urldecode( $record['memo_attachment'] );
										if( file_exists( $file ) )
										{
											$f_info = get_file_info( $file );
											$f_type = filetype( $file );

		/*									$finfo = finfo_open(FILEINFO_MIME_TYPE);
											$f_type = finfo_file($finfo, $file);*/

											switch( $f_type )
											{
												case 'image/jpeg':
													$icon = 'fa-picture-o';
													echo '<a class="fancybox-button" href="'.base_url($record['memo_attachment']).'"><span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
									            	<span>'. basename($f_info['name']) .'</span></a>';
													break;
												case 'video/mp4':
													$icon = 'fa-film';
													echo '<a href="'.base_url($record['memo_attachment']).'" target="_blank"><span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
									            <span>'. basename($f_info['name']) .'</span></a>';
													break;
												case 'audio/mpeg':
													$icon = 'fa-volume-up';
													echo '<a href="'.base_url($record['memo_attachment']).'" target="_blank"><span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
									            <span>'. basename($f_info['name']) .'</span></a>';
													break;
												default:
													$icon = 'fa-file-text-o';
													echo '<a href="'.base_url($record['memo_attachment']).'" target="_blank"><span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
									            <span>'. basename($f_info['name']) .'</span></a>';
											}
										}
									?>								
								@endif
							</div> 				</div>	
			</div>	</div>
</div>

<script src="{{ theme_path() }}plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript" ></script>