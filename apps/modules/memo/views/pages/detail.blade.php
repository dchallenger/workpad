@extends('layouts/master')

@section('page_styles')
	@parent
	@include('detail/page_styles')
@stop

@section('page_content')
	@parent

<div class="row">

    <div class="col-md-9">

    <form method="post" fg_id="1" class="form-horizontal">
        <!-- Edit -->
        <div class="row">
        <div class="col-md-11">
            <form class="form-horizontal">
                <input type="hidden" id="record_id" name="record_id" value="{{ $record_id }}">
                @include('detail/fgs')
                @include('buttons/detail')
            </form>
        </div>  
            
        </div>

            
        </form>
        <!-- End Edit -->
    </div>
	

    
</div>

@stop


@section('page_plugins')
	@parent
	@include('detail/page_plugins')
@stop


@section('page_scripts')
	@parent

	@include('detail/page_scripts')

    <script type="text/javascript" src="{{ theme_path() }}modules/common/edit.js"></script>
    <script src="{{ theme_path() }}plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript" ></script>

@stop


@section('view_js')
	@parent

	{{ get_edit_js( $mod ) }}

@stop
