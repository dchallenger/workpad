<div id="personal_test">
    <?php $test_count = count($test_tab); ?>
    <input type="hidden" name="test_count" id="test_count" value="{{ $test_count }}" />
    <?php 
    $count_test = 0;
    foreach($test_tab as $index => $test){  
        $count_test++;
        ?>
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption" id="test-category">
                    <input type="hidden" name="recruitment_personal_history[test-category][]" id="recruitment_personal_history-test-category" 
                    value="<?php echo (isset($test['test-category']) ? $test['test-category'] : ""); ?>" />
                    <?php echo (isset($test['test-category']) ? $test['test-category'] : ""); ?></div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <!-- START FORM -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">Title :</label>
                                    <div class="col-md-6">
                                        <span>@if (isset($test['test-title'])) {{ $test['test-title'] }} @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">Date Taken :</label>
                                    <div class="col-md-6">
                                        <span>@if (isset($test['test-date-taken'])) {{ $test['test-date-taken'] }} @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">Location :</label>
                                    <div class="col-md-6">
                                        <span>@if (isset($test['test-location'])) {{ $test['test-location'] }} @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">Score/Rating :</label>
                                    <div class="col-md-6">
                                        <span>@if (isset($test['test-score'])) {{ $test['test-score'] }} @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">Result :</label>
                                    <div class="col-md-6">
                                        <span>@if ($test['test-result']) Yes @else No  @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">Remarks :</label>
                                    <div class="col-md-6">
                                        <span>@if (isset($test['test-remarks'])) {{ $test['test-remarks'] }} @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">Supporting Documents :</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <ul class="padding-none margin-top-11">
                                                <!-- <i class="fa fa-file fileupload-exists"></i>  -->
                                                <span class="fileupload-preview">
                                                    <!-- @if( isset($f_info['name'] ) ) {{ basename($f_info['name']) }} @endif -->

                                                    <?php
                                                    $attach_file = (isset($test['test-attachments']) ? $test['test-attachments'] : ""); 
                                                    if (!empty($attach_file)){
                                                        $file = FCPATH . urldecode( $attach_file );
                                                        if( file_exists( $file ) )
                                                        {
                                                            $f_info = get_file_info( $file );
                                                            $f_type = filetype( $file );

                    /*                                            $finfo = finfo_open(FILEINFO_MIME_TYPE);
                                                            $f_type = finfo_file($finfo, $file);*/

                                                            switch( $f_type )
                                                            {
                                                                case 'image/jpeg':
                                                                $icon = 'fa-picture-o';
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
                                                            $filepath = base_url()."applicants/download_file/".$details_data_id['test'][$count_test]['test-attachments'];
                                                            $file_view = base_url().$test['test-attachments'];

                                                            echo '<li class="padding-3" style="list-style:none;"><a href="'.$filepath.'">
                                                            <span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
                                                            <span>'. basename($f_info['name']) .'</span>
                                                            </a>
                                                            </li>';
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <?php } ?>
        </div>
        <div class="form-actions fluid">
            <div class="row" align="center">
                <div class="col-md-12">
                    <a href="{{ $mod->url }}" class="btn default btn-sm">{{ lang('common.back_to_list') }}</a>
                </div>
            </div>
        </div>