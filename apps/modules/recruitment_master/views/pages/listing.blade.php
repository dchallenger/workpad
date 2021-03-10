@extends('layouts.master')

@section('page_content')
@parent

<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="row">
	<div class="col-md-11">
		<!-- BEGIN FORM-->
		<div class="row">
			<!-- FORM -->
			<div class="col-md-12">

				<div class="portlet hidden">
					<div class="portlet-body form">
                        <form action="#" class="form-horizontal">
                            <div class="form-body" style="padding-bottom:0px;">

                            	<div class="note note-default">

				                    <h3 class="page-title">
				                    {{ lang('recruitment.layout') }}: <small> {{ lang('recruitment.layout_sub') }}</small>
				                    </h3>
				                    <p class="small">{{ lang('recruitment.layout_desc') }}</p>

				                    <hr/>

									<div>
										<div class="col-md-9 margin-bottom-10">
											<h4>{{ lang('recruitment.template')}}</h4>
											<div class="text-muted small">{{ lang('recruitment.template_desc')}}</div>
										</div>
										<div class="col-md-3 margin-bottom-25">
											<a class="btn btn-default" type="button" rel="{{ get_mod_route('appraisal_template') }}" href="{{ get_mod_route('appraisal_template') }}">{{ lang('recruitment.view_list_button') }}</a>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
                        </form>
					</div>
				</div>

				<div class="portlet">
					<div class="portlet-body form">
                        <form action="#" class="form-horizontal">
                            <div class="form-body" style="padding-bottom:0px;">

                            	<div class="note note-default">

				                    <h3 class="page-title">
				                    {{ lang('recruitment.resources') }}: <small> {{ lang('recruitment.resources_sub') }}</small>
				                    </h3>
				                    <p class="small">{{ lang('recruitment.resources_desc') }}</p>

				                    <hr/>

									<div>
										<div class="col-md-9 margin-bottom-10">
											<h4>{{ lang('recruitment.location')}}</h4>
											<div class="text-muted small">{{ lang('recruitment.location_desc')}}</div>
										</div>
										<div class="col-md-3 margin-bottom-25">
											<a class="btn btn-default" type="button" rel="{{ get_mod_route('interview_location') }}" href="{{ get_mod_route('interview_location') }}">{{ lang('recruitment.view_list_button') }}</a>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
                        </form>
					</div>
				</div>
			</div>
		</div>
        <!-- END FORM-->
	</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
@stop

@section('page_plugins')
@parent
<script type="text/javascript" src="{{ theme_path() }}plugins/jquery.infiniteScroll.js"></script>
<script type="text/javascript" src="{{ theme_path() }}modules/common/lists.js"></script>
@stop

@section('view_js')
@parent
{{ get_list_js( $mod ) }}
@stop
