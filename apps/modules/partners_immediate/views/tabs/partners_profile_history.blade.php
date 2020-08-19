	<div class="row">
		<div class="col-md-3" style="margin-bottom:50px">
			<ul class="ver-inline-menu tabbable">
				<li class="active">
					<a data-toggle="tab" href="#historical_tab1"><i class="fa fa-list"></i>{{ lang('partners_immediate.education') }}</a>
					<span class="after"></span>
				</li>
				<li><a data-toggle="tab" href="#historical_tab2"><i class="fa fa-list"></i>{{ lang('partners_immediate.employment_history') }}</a></li>
				<li><a data-toggle="tab" href="#historical_tab3"><i class="fa fa-list"></i>{{ lang('partners_immediate.character_ref') }}</a></li>
				<li><a data-toggle="tab" href="#historical_tab4"><i class="fa fa-list"></i>{{ lang('partners_immediate.licensure') }}</a></li>
				<li><a data-toggle="tab" href="#historical_tab5"><i class="fa fa-list"></i>{{ lang('partners_immediate.training') }}</a></li>
				<li><a data-toggle="tab" href="#historical_tab6"><i class="fa fa-list"></i>{{ lang('partners_immediate.skills') }}</a></li>
				<li><a data-toggle="tab" href="#historical_tab7"><i class="fa fa-list"></i>{{ lang('partners_immediate.affiliation') }}</a></li>
				<li><a data-toggle="tab" href="#historical_tab8"><i class="fa fa-list"></i>{{ lang('partners_immediate.accountabilities') }}</a></li>
				<li><a data-toggle="tab" href="#historical_tab9"><i class="fa fa-files-o"></i>{{ lang('partners_immediate.attachment') }}</a></li>

			</ul>
		</div>

		<div class="tab-content col-md-9">
			<div class="tab-pane active" id="historical_tab1">
				<!-- Education : start doing the loop-->
				<?php foreach($education_tab as $index => $education){ 
					?>
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption" id="education-type[1]"><?php 
						$education_type = (isset($education['education-type']) ? $education['education-type'] : "");
						echo $education_type; ?>
						</div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.school') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="education-school[1]"><?php echo (isset($education['education-school']) ? $education['education-school'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.from') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="education-year-from[1]"><?php echo (isset($education['education-year-from']) ? $education['education-year-from'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.to') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="education-year-to[1]"><?php echo (isset($education['education-year-to']) ? $education['education-year-to'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
			            <?php 
    $type_with_degree = array('tertiary', 'graduate studies', 'vocational');
			            if(in_array(strtolower($education_type), $type_with_degree)) { 
			                ?>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.degree') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="education-degree[1]"><?php echo (isset($education['education-degree']) ? $education['education-degree'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.status') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="education-status[1]"><?php echo (isset($education['education-status']) ? $education['education-status'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="tab-pane" id="historical_tab2">
				<!-- Previous Employment : start doing the loop-->
				<?php foreach($employment_tab as $index => $employment){ 
					?>
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption" id="employment-company[1]"><?php echo (isset($employment['employment-company']) ? $employment['employment-company'] : ""); ?></div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.position') }} {{ lang('partners_immediate.title') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="employment-position-title[1]"><?php echo (isset($employment['employment-position-title']) ? $employment['employment-position-title'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.location') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="employment-location[1]"><?php echo (isset($employment['employment-location']) ? $employment['employment-location'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.hire_date') }}:</label>
									<div class="col-md-7 col-sm-7">
										<span id="employment-date-hired[1]">
											<?php echo (isset($employment['employment-month-hired']) ? $employment['employment-month-hired'] : ""); ?>
											<?php echo (isset($employment['employment-year-hired']) ? $employment['employment-year-hired'] : ""); ?>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.end_date') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="employment-end-date[1]">
											<?php echo (isset($employment['employment-month-end']) ? $employment['employment-month-end'] : ""); ?>
											<?php echo (isset($employment['employment-year-end']) ? $employment['employment-year-end'] : ""); ?>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.duties') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="employment-duties[1]"><?php echo (isset($employment['employment-duties']) ? nl2br($employment['employment-duties']) : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="tab-pane" id="historical_tab3">
				<!-- Previous Character reference : start doing the loop-->
				<?php foreach($reference_tab as $index => $reference){ 
					?>
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption" id="reference-name[1]"><?php echo (isset($reference['reference-name']) ? $reference['reference-name'] : ""); ?></div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.occupation') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="reference-occupation[1]"><?php echo (isset($reference['reference-occupation']) ? $reference['reference-occupation'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.years_known') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="reference-years-known[1]"><?php echo (isset($reference['reference-years-known']) ? $reference['reference-years-known'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.phone') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="reference-phone[1]"><?php echo (isset($reference['reference-phone']) ? $reference['reference-phone'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.mobile') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="reference-mobile[1]"><?php echo (isset($reference['reference-mobile']) ? $reference['reference-mobile'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.address') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="reference-address[1]"><?php echo (isset($reference['reference-address']) ? $reference['reference-address'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.city') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="reference-city[1]"><?php echo (isset($reference['reference-city']) ? $reference['reference-city'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.country') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="reference-country[1]"><?php echo (isset($reference['reference-country']) ? $reference['reference-country'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.zip') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="reference-zipcode[1]"><?php echo (isset($reference['reference-zipcode']) ? $reference['reference-zipcode'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<?php } ?>
			</div>
			<div class="tab-pane" id="historical_tab4">
				<!-- Previous Licensure : start doing the loop-->
				<?php foreach($licensure_tab as $index => $licensure){ 
					?>
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption" id="licensure-title[1]"><?php echo (isset($licensure['licensure-title']) ? $licensure['licensure-title'] : ""); ?></div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.license_no') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="licensure-number[1]"><?php echo (isset($licensure['licensure-number']) ? $licensure['licensure-number'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.date_taken') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="licensure-date-taken[1]">
											<?php echo (isset($licensure['licensure-month-taken']) ? $licensure['licensure-month-taken'] : ""); ?>
											<?php echo (isset($licensure['licensure-year-taken']) ? $licensure['licensure-year-taken'] : ""); ?>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.remarks') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="licensure-remarks[1]"><?php echo (isset($licensure['licensure-remarks']) ? nl2br($licensure['licensure-remarks']) : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">Supporting Documents :</label>
									<div class="col-md-7 col-sm-7">
										<span id="licensure-attachments[1]">
											<ul class="padding-none margin-top-11">
                                            <?php 
                                            	// if(array_key_exists('licensure-attachments', $licensure)){
                                             //        $file = FCPATH . $licensure['licensure-attachments'];
                                             //        if( file_exists( $file ) )
                                             //        {
                                             //            $f_info = get_file_info( $file );
                                             //            $f_type = filetype( $file );

                                             //            $finfo = finfo_open(FILEINFO_MIME_TYPE);
                                             //            $f_type = finfo_file($finfo, $file);
                                             //            $is_image = false;
                                             //            switch( $f_type )
                                             //            {
                                             //                case 'image/jpeg':
                                             //                case 'image/jpg':
                                             //                case 'image/bmp':
                                             //                case 'image/png':
                                             //                case 'image/gif':
                                             //                    $icon = 'fa-picture-o';
                                             //            		$is_image = true;
                                             //                    break;
                                             //                case 'video/mp4':
                                             //                    $icon = 'fa-film';
                                             //                    break;
                                             //                case 'audio/mpeg':
                                             //                    $icon = 'fa-volume-up';
                                             //                    break;
                                             //                default:
                                             //                    $icon = 'fa-file-text-o';
                                             //            }

                                             //            $filepath = base_url()."profile/download_file/".$details_data_id[$index]['licensure-attachments'];
                                             //            $file_view = base_url().$licensure['licensure-attachments'];
                                             //            // $path = site_url() . 'uploads/' . $this->module_link . '/' . $file;
                                             //            echo '<li class="padding-3 fileupload-delete-'.$details_data_id[$index]['licensure-attachments'].'" style="list-style:none;">';
                                             //            if($is_image){
                                             //            	echo '<img src="'.$file_view.'" class="img-responsive" alt="" />';
                                             //            }
                                             //            echo '<a href="'.$filepath.'">
                                             //                <span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
                                             //                <span>'. basename($f_info['name']) .'</span>
                                             //                </a>
                                             //            </li>'
                                             //            // <span class="padding-left-10"><a style="float: none;" data-dismiss="fileupload" class="close fileupload-delete" upload_id="'.$details['attachment-file'].'" href="javascript:void(0)"></a></span>
                                             //            ;
                                             //        }
                                             //    }
                                            ?>
                                        </ul>
										</span>
									</div>
								</div>
							</div>
						</div> -->

					</div>
				</div>
				<?php } ?>
			</div>
			<div class="tab-pane" id="historical_tab5">
				<!-- Previous Trainings : start doing the loop-->
				<?php foreach($training_tab as $index => $training){ 
					?>
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption" id="training-title[1]"><?php echo (isset($training['training-title']) ? $training['training-title'] : ""); ?></div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.category') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="training-category[1]"><?php echo (isset($training['training-category']) ? $training['training-category'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.venue') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="training-venue[1]"><?php echo (isset($training['training-venue']) ? $training['training-venue'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.start_date') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="training-start-month[1]">
											<?php echo (isset($training['training-start-month']) ? $training['training-start-month'] : ""); ?>
											<?php echo (isset($training['training-start-year']) ? $training['training-start-year'] : ""); ?>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.end_date') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="training-end-month[1]">
											<?php echo (isset($training['training-end-month']) ? $training['training-end-month'] : ""); ?>
											<?php echo (isset($training['training-end-year']) ? $training['training-end-year'] : ""); ?>
										</span>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<?php } ?>
			</div>
			<div class="tab-pane" id="historical_tab6">
				<!-- Previous Trainings : start doing the loop-->
				<?php foreach($skill_tab as $index => $skill){ 
					?>
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption" id="skill-name[1]"><?php echo (isset($skill['skill-name']) ? $skill['skill-name'] : ""); ?></div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.type') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="skill-type[1]"><?php echo (isset($skill['skill-type']) ? $skill['skill-type'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.proficiency_level') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="skill-level[1]"><?php echo (isset($skill['skill-level']) ? $skill['skill-level'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.remarks') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="skill-remarks[1]"><?php echo (isset($skill['skill-remarks']) ? nl2br($skill['skill-remarks']) : ""); ?></span>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<?php } ?>
			</div>
			<div class="tab-pane" id="historical_tab7">
				<!-- Previous Trainings : start doing the loop-->
				<?php foreach($affiliation_tab as $index => $affiliation){ 
					?>
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption" id="affiliation-name[1]"><?php echo (isset($affiliation['affiliation-name']) ? $affiliation['affiliation-name'] : ""); ?></div>
						<div class="tools">
							<a class="collapse" href="javascript:;"></a>
						</div>
					</div>
					<div class="portlet-body form">
						<!-- START FORM -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.position') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="affiliation-position[1]"><?php echo (isset($affiliation['affiliation-position']) ? $affiliation['affiliation-position'] : ""); ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.start_date') }} :</label>
									<div class="col-md-7 col-sm-7">
										<span id="affiliation-date-start[1]">
											<?php echo (isset($affiliation['affiliation-month-start']) ? $affiliation['affiliation-month-start'] : ""); ?>											
											<?php echo (isset($affiliation['affiliation-year-start']) ? $affiliation['affiliation-year-start'] : ""); ?>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 text-right text-muted">{{ lang('partners_immediate.end_date') }} :</label>
									<div class="col-md-7 col-sm-7">
											<?php echo (isset($affiliation['affiliation-month-end']) ? $affiliation['affiliation-month-end'] : ""); ?>											
											<?php echo (isset($affiliation['affiliation-year-end']) ? $affiliation['affiliation-year-end'] : ""); ?>
										</span>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<?php } ?>
			</div>
			<div class="tab-pane" id="historical_tab8">
                <div class="portlet">
                	<div class="portlet-title">
                    	<div class="caption">{{ lang('partners_immediate.accountabilities') }}</div>
                    </div>
                    <div class="portlet-body">
						<!-- Table -->
						<table class="table table-condensed table-striped table-hover">
							<thead>
								<tr>
									
									<th width="30%">{{ lang('partners_immediate.item_name') }}</th>
									<th width="45%" class="hidden-xs">{{ lang('partners_immediate.qty') }}</th>
									<th width="20%">{{ lang('common.actions') }}</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($accountabilities_tab as $index => $accountable){ 
								?>
								<tr rel="0">
									<!-- this first column shows the year of this holiday item -->
									
									<td>
										<a id="date_name" href="#" class="text-success">
											<?php echo (isset($accountable['accountabilities-name']) ? $accountable['accountabilities-name'] : ""); ?>	
										</a>
										<br />
										<span id="date_set" class="small ">
											<?php echo (isset($accountable['accountabilities-code']) ? $accountable['accountabilities-code'] : ""); ?>	
										</span>
									</td>
									<td class="hidden-xs">
											<?php echo (isset($accountable['accountabilities-quantity']) ? $accountable['accountabilities-quantity']." pcs" : ""); ?>
									</td>
									<td>
										<div class="btn-group">
											<input type="hidden" id="accountabilities_sequence" name="accountabilities_sequence" value="<?=$index?>" />
											<a  href="javascript:view_personal_details('accnt_form_modal', 'accountabilities', <?=$index?>);" ><i class="fa fa-search"></i> View</a>
											
										</div>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
                </div>
                <!--end portlet-->
			</div>

			<div class="tab-pane" id="historical_tab9">
				<!--Attachments--> 
                <div class="portlet">
                	<div class="portlet-title">
                    	<div class="caption">{{ lang('partners_immediate.attachment') }}</div>
                    </div>
                    <div class="portlet-body">
						<!-- Table -->
						<table class="table table-condensed table-striped table-hover">
							<thead>
								<tr>
									
									<th width="30%">{{ lang('partners_immediate.name') }}</th>
									<th width="45%" class="hidden-xs">{{ lang('partners_immediate.filename') }}</th>
									<th width="20%">{{ lang('common.actions') }}</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($attachment_tab as $index => $attachment){ 
								?>
								<tr rel="0">
									
									<td>
										<a id="date_name" href="#" class="text-success">
											<?php echo (isset($attachment['attachment-name']) ? $attachment['attachment-name'] : ""); ?>	
										</a>
										<br />
										<span id="date_set" class="small text-muted">
											<?php echo (isset($attachment['attachment-category']) ? $attachment['attachment-category'] : ""); ?>	
										</span>
									</td>
									<td class="hidden-xs">
											<?php echo (isset($attachment['attachment-file']) ? substr( $attachment['attachment-file'], strrpos( $attachment['attachment-file'], '/' )+1 ) : ""); ?>	
									</td>
									<td>
										<div class="btn-group">
											<input type="hidden" id="attachment_sequence" name="attachment_sequence" value="<?=$index?>" />
											<a  href="javascript:view_personal_details('attach_form_modal', 'attachment', <?=$index?>);" ><i class="fa fa-search"></i> View</a>									
										</div>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
                </div>
                <!--end portlet-->
			</div>

		</div>
	</div>
