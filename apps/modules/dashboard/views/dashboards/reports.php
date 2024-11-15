@extends('layouts.master')

@section('page-title')
	<h3 class="page-title">
		<?php echo lang('dashboard.reports') ?> <small><?php echo lang('dashboard.gen_set') ?></small>
	</h3>
@stop

@section('page_content')
	@parent
	<div class="row">
		<div class="col-md-11">
			<div class="row">
				<div class="col-md-12">
					@foreach( $categories as $key => $category  )
						@if( $category['reports']->num_rows() > 0 )
							<div class="portlet">
								<div class="portlet-title">
									<div class="caption">
										<h3 class="page-title">{{ $category['category'] }}: <small> {{ $category['caption'] }}</small></h3>
										<p class="small">{{ $category['description'] }}</p>
									</div>

									<div class="tools">
										<a href="javascript:;" <?php if($key > 0) echo 'class="expand"'; else echo 'class="collapse"'; ?> ></a>
									</div>
								</div>
								<div class="portlet-body form" <?php if($key > 0) echo 'style="display: none;"'; ?> >
									<div class="form-body" style="padding-bottom:0px;">
										<div class="note note-default">
											<!-- <h2><span class="module-title">{{ $category['category'] }}: </span><span class="module-caption"> {{ $category['caption'] }}</span></h2> -->
											<!-- <p class="small">{{ $category['description'] }}</p> -->

											<!-- <hr class="margin-bottom-25" /> -->
											@foreach( $category['reports']->result() as $report )

												<div>
													<div class="col-md-9 margin-bottom-10">
														<h4>{{ $report->report_name }}</h4>
														<div class="text-muted small">{{ $report->description }}</div>
													</div>
													@if( in_array($report->report_code, array('COE', 'COC', 'BIR2316')) )
													<div class="col-md-3 margin-bottom-25">
														<a class="btn btn-default" type="button" href="{{ get_mod_route('report_result') }}/files/{{ $report->report_id }}"><?php echo lang('dashboard.view_list_button') ?></a>
														<a class="btn btn-success" type="button" href="javascript:generate_certificate( '{{ strtolower($report->report_code) }}', {{ $report->report_id }} )"><?php echo lang('dashboard.generate') ?></a>
														<!-- <a class="btn btn-success" type="button" href="{{ get_mod_route('report_generator') }}/generate/{{ $report->report_id }}">Export</a> -->
													</div>
													@else
													<div class="col-md-3 margin-bottom-25">
														<a class="btn btn-default" type="button" href="{{ get_mod_route('report_result') }}/files/{{ $report->report_id }}"><?php echo lang('dashboard.view_list_button') ?></a>
														<a class="btn btn-success" type="button" href="javascript:get_param_form({{ $report->report_id }})"><?php echo lang('dashboard.generate') ?></a>
														<!-- <a class="btn btn-success" type="button" href="{{ get_mod_route('report_generator') }}/generate/{{ $report->report_id }}">Export</a> -->
													</div>
													@endif
													<div class="clearfix"></div>
												</div>
											@endforeach	
										</div>
									</div>
								</div>
							</div>
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
@stop

<script>
	function get_param_form( report_id )
	{
		$.blockUI({ message: loading_message(), 
			onBlock: function(){
				$.ajax({
					url: '{{ get_mod_route('report_generator') }}/get_param_form',
					type:"POST",
					dataType: "json",
					data: 'record_id='+report_id,
					async: false,
					success: function ( response ) {
						handle_ajax_message( response.message );

						if( typeof(response.quick_edit_form) != 'undefined' )
						{
							$('.modal-container').attr('data-width', '540');
							$('.modal-container').html(response.quick_edit_form);
							$('.modal-container').modal();

							if (report_id == 92){
								$("#full_name").select2("val", response.user_id);
							}
						}
					}
				});
			}
		});
		$.unblockUI();	
	}

	function ajax_export( form, file, custom )
	{
		var msgarray = [];
		$(".required").each(function() {
			var elem = $(this);
			var name = $(elem).attr('form-name');
			var label = $(elem).attr('label');
			var val = $('input[name="'+name+'"]').val();
			if (val != undefined){
				if (val.trim() == ''){
					msgarray.push({
						type: 'error',
						message: label + ' is required'
					});
				}
			}
		});		

		if (Object.keys(msgarray).length > 0){
			handle_ajax_message( msgarray );
			return;
		}

		$.blockUI({ message: '<div>'+lang.common.processing+'</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
			onBlock: function(){
				$.ajax({
					url: '{{ get_mod_route('report_generator') }}/export',
					type:"POST",
					dataType: "json",
					data: form.serialize() + '&file='+file + '&custom='+custom,
					async: false,
					success: function ( response ) {
						if( response.filename != undefined )
						{
							window.open( root_url + response.filename );
						}
						handle_ajax_message( response.message );
					}
				});
			},
			baseZ: 300000000
		});
		$.unblockUI();	
	}

	function ajax_export_custom( form, file, custom )
	{
		$.blockUI({ message: '<div>'+lang.common.processing+'</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
			onBlock: function(){
				$.ajax({
					url: '{{ get_mod_route('report_generator') }}/export_custom',
					type:"POST",
					dataType: "json",
					data: form.serialize() + '&file='+file + '&get_result=true',
					async: false,
					success: function ( response ) {
						if( response.filename != undefined )
						{
							window.open( root_url + response.filename );
						}
						handle_ajax_message( response.message );
					}
				});
			},
			baseZ: 300000000
		});
		$.unblockUI();	
	}

	function generate_certificate( certname, record_id )
	{
		$.blockUI({ message: loading_message(), 
			onBlock: function(){
				$.ajax({
					url: '{{ get_mod_route('report_generator') }}/generate_certificate',
					type:"POST",
					async: false,
					data: 'certname='+certname+'&record_id='+record_id,
					dataType: "json",
					beforeSend: function(){
					},
					success: function ( response ) {
						handle_ajax_message( response.message );

						if( typeof(response.quick_edit_form) != 'undefined' )
						{
							$('.modal-container').attr('data-width', '600');
							$('.modal-container').html(response.quick_edit_form);
							$('.modal-container').modal();
						}
					}
				});
			}
		});
		$.unblockUI();	
	}

	function download_certs( form, action, callback )
	{
		$.blockUI({ message: saving_message(),
			onBlock: function(){

				var hasCKItem = form.find("textarea.ckeditor");

				if(hasCKItem && (typeof editor != 'undefined')){
					
					for ( instance in CKEDITOR.instances )
	        			CKEDITOR.instances[instance].updateElement();
				}

				var data = form.find(":not('.dontserializeme')").serialize();
				$.ajax({
					url: '{{ get_mod_route('report_generator') }}/download_certs',
					type:"POST",
					data: data,
					dataType: "json",
					async: false,
					success: function ( response ) {
						if( response.filename != undefined )
						{
							window.open( root_url + response.filename );
						}
						handle_ajax_message( response.message );
					}
				});
			},
			baseZ: 300000000
		});
		$.unblockUI();
	}

</script>

@section('module_js')
	<!-- Add Module JS -->
	{{ get_module_js( $mod, false ) }}
@stop

