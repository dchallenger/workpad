@extends('layouts/master')

@section('page_styles')
	@parent
	@include('edit/page_styles')
@stop

@section('page_content')
	@parent
	<div class="row">
        <div class="col-md-12">
			<form class="form-horizontal" id="self-review">
				<input type="hidden" id="record_id" name="record_id" value="{{ $record_id }}">
				@if(empty($planning_applicable_fields))
					@include('pages/no_performance_planning')
				@else
					@include('edit/fgs')
				@endif
			</form>
       	</div>  		
	</div>
@stop

@section('page_plugins')
	@parent
	@include('edit/page_plugins')
@stop

@section('page_scripts')
	@parent
	@include('edit/page_scripts')
	<script type="text/javascript" src="{{ theme_path() }}modules/common/edit.js"></script> 
	<script type="text/javascript" src="{{ theme_path() }}modules/{{ $mod->mod_code }}/review.js"></script> 
@stop

@section('view_js')
	@parent
	{{ get_edit_js( $mod ) }}
@stop