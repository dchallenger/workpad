@extends('layouts.master')

@section('page_content')
	@parent
   
	<!-- BEGIN EXAMPLE TABLE PORTLET-->
	<div class="row">
		<div class="col-md-9">
			<div class="portlet">
				<div class="portlet-body">
					<div class="tabbable-custom ">
						<ul class="nav nav-tabs ">
							<li><a href="{{ get_mod_route('training_request') }}">Personal</a></li>
							@if($allow_manage)
							<li><a href="{{ get_mod_route('training_request_manage') }}">Manage</a></li>
							@endif
							@if($allow_admin)
							<li><a href="{{ get_mod_route('training_request_admin') }}">Admin</a></li>
							@endif
							@if($allow_training_confirmation)
							<li class="active"><a href="{{ get_mod_route('training_request_confirmation') }}">Training Confirmation</a></li>
							@endif							
						</ul>
					</div>
				</div>
				<br>
				<div class="portlet-title">
					<div class="caption"><i class="fa {{ $mod->icon}}"></i>List of Training Request for Confirmation</div>
					<div class="caption" id="head-caption">&nbsp;</div>
					<div class="actions hidden">
						@if( isset( $permission['add']) && $permission['add'] )
							<a id="goadd" href="{{ $mod->url }}/add" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
						@endif
						@if( isset( $permission['delete']) && $permission['delete'] )
							<a href="javascript:delete_records()" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
						@endif
					</div>
				</div>
				<div class="clearfix">
					<!-- <input type="hidden" name="appraisal_id" id="appraisal_id" value="{{$appraisal_id}}"> -->
					<table id="record-table" class="table table-condensed table-striped table-hover">
	                    <thead>
	                        <tr>
	                            @include('list_template_header')
	                            <th width="20%">
	                                Actions
	                            </th>
	                        </tr>
	                    </thead>
	                    <tbody id="record-list"></tbody>
	                </table>
	                <div id="no_record" class="well" style="display:none;">
						<p class="bold"><i class="fa fa-exclamation-triangle"></i> {{ lang('common.no_record_found') }}</p>
						<span><p class="small margin-bottom-0">{{ lang('common.zero_record') }}</p></span>
					</div>
					<div id="loader" class="text-center"><img src="{{ theme_path() }}img/ajax-loading.gif" alt="loading..." /> {{ lang('common.get_record') }}</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 visible-lg visible-md">
			<div class="portlet">
				<div class="clearfix margin-bottom-20">
                	@include('common/search-form')
                	<div class="actions margin-top-20 clearfix">
	                	<span class="pull-right"><a class="text-muted" id="trash" href="javascript:view_trash()">{{ lang('common.trash_folder') }} <i class="fa fa-trash-o"></i></a></span>
					</div>
				</div>
				
                @include('list_filter')
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
	{{ get_list_js( $mod ) }}
@stop
