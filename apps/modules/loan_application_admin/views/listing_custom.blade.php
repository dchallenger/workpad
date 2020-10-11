@extends('layouts.master')

@section('page_styles')
	@parent
	
	<style>
		.popover {min-width: 400px !important;}
    </style>    
    
@stop

@section('page_content')
	@parent
   
	<!-- BEGIN EXAMPLE TABLE PORTLET-->
	<div class="row">
				<div class="col-md-9">
					<div class="portlet"> 
						<div class="portlet-body">
							<div class="tabbable-custom ">
								<ul class="nav nav-tabs ">
								@if ($permission_app_personal)
									<li class=""><a href="{{ get_mod_route('loan_application') }}">{{ lang('common.personal') }}</a></li>
								@endif
								@if ($permission_app_manage)
									<li class=""><a href="{{ get_mod_route('loan_application_manage') }}">{{ lang('common.manage') }}</a></li>
								@endif
								@if ($permission_app_admin)
									<li class="active"><a href="{{ get_mod_route('loan_application_admin') }}">{{ lang('common.admin') }}</a></li>
								@endif									
								</ul>
								<div class="tab-content" style="min-height: 500px;">
									<div id="tab_5_1" class="tab-pane active">
										<!-- Listing -->
										<div class="portlet margin-bottom-50 margin-top-20"> 
					                        <div class="breadcrumb hidden-lg hidden-md margin-bottom-20">
					                        	<form id="list-search-mobile" action="" method="post">
						                            <div class="block input-icon right ">
						                                <i class="fa fa-search"></i>
						                                <input name="list-search-mobile" type="text" value="{{ $search }}" class="form-control" placeholder="{{ lang('form_application.search') }}">
						                            </div>
					                            </form>
					                        </div>
											<div class="portlet-title">
												<div class="caption">{{ lang('loan_application.list_ofApp') }}</div>
					                            <div class="actions">
					                            	<!-- Filtering of loan type and status on  mobile -->
					                            	<div class="btn-group">
						                                <a class="btn btn-info btn-sm hidden-lg hidden-md" href="#" data-toggle="dropdown" data-close-others="true">
														<i class="fa fa-filter"></i> 
						                                </a>
						                                <div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right" style="width: 225px;">
						                                	<div class="scroller" style="height:350px" data-always-visible="1" data-rail-visible1="1">
							                                	<div class="portlet margin-bottom-10">
																	<div class="portlet-title">
																		<div class="caption margin-bottom-0"><h5>{{ lang('loan_application.loan_type') }}</h5></div>
																	</div>
																	<div class="portlet-body">
																		<div class="radio-list">
																			<label><input class="form-filter option" type="radio" name="optionsRadios" id="optionsRadios2" value="option1" data-form-id="0" checked> {{ lang('loan_application.all') }}</label>
																			@foreach ($loan_type as $loan_type_val)
																			<label><input class="form-filter option" type="radio" name="optionsRadios" id="optionsRadios2" value="option4" data-form-id="{{$loan_type_val['loan_type_id']}}"> {{$loan_type_val['loan_type']}}</label>
																			@endforeach
																		</div>
																	</div>
																</div>
																<div class="portlet">
																	<div class="portlet-title">
																		<div class="caption margin-bottom-0"><h5>{{ lang('form_application.status') }}</h5></div>
																	</div>
																	<div class="portlet-body">
																		<div class="radio-list">
																			@foreach ($loan_status->result() as $row)
																			<label><input class="form-filter option" type="radio" name="optionsRadios" id="optionsRadios2" value="option4" data-form-status-id="{{$row->loan_application_status_id}}"> {{$row->loan_application_status}}</label>
																			@endforeach
																		</div>
																	</div>
																</div>
															</div>
														</div>
					                            	</div>
					                                <!-- Filtering of loan type and status on  mobile -->
												</div>
											</div>		

											<div class="clearfix">
													<table class="table table-condensed table-striped table-hover">
														<thead>
									                        <tr>
									                            @include('list_template_header')
									                            <th width="20%">
									                                {{ lang('loan_application.actions') }}
									                            </th>
									                        </tr>
									                    </thead>
									                    <tbody id="form-list"></tbody>
													</table>
													<div id="no_record" class="well" style="display:none;">
														<p class="bold"><i class="fa fa-exclamation-triangle"></i>{{ lang('loan_application.no_records') }}</p>
														<span><p class="small margin-bottom-0">{{ lang('loan_application.no_apps') }}</p></span>
													</div>

													<div id="loader" class="text-center"><img src="{{ theme_path() }}img/ajax-loading.gif" alt="loading..." /> {{ lang('loan_application.fetch_rec') }}</div>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
                
                <div class="col-md-3 visible-lg visible-md">
					<div class="portlet margin-bottom-10">
						<div class="clearfix">
                        	@include('common/search-form')
						</div>
					</div>
					<div class="portlet">
						<div style="margin-bottom:3px;" class="portlet-title">
							<div class="caption">{{ lang('loan_application.loan_type') }}</div>
						</div>
						<div class="portlet-body">
							<span class="small text-muted">{{ lang('loan_application.loan_type_description') }}</span>
							<div class="margin-top-15">
								<span class="form-filter label label-info label-filter pading-3" filter_value="0">{{ lang('loan_application.all') }}</span>
								@foreach ($loan_type as $loan_type_val)
								<span class="form-filter label label-default label-filter pading-3" filter_value="{{$loan_type_val['loan_type_id']}}">{{$loan_type_val['loan_type']}}</span>
								@endforeach
							</div>
		                </div>
					</div>
					<div class="portlet">
						<div style="margin-bottom:3px;" class="portlet-title">
							<div class="caption">{{ lang('loan_application.status') }}</div>
						</div>
						<div class="portlet-body">
							<span class="small text-muted">{{ lang('loan_application.loan_status_description') }}</span>
							<div class="margin-top-15">
								@foreach ($loan_status->result() as $row)
								<span class="status-filter label label-default label-filter pading-3" filter_value="{{$row->loan_application_status_id}}">{{$row->loan_application_status}}</span>
								@endforeach
							</div>
		                </div>
					</div>					
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
	<script type="text/javascript">
		$(document).ready(function(){

			
			initPopup();

		});
	</script>
@stop