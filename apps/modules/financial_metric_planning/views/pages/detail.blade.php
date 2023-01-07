@extends('layouts/master')

@section('page_content')
	@parent

	<div class="row">
        <div class="col-md-11">
			<form class="form-horizontal">
				<input type="hidden" id="record_id" name="record_id" value="{{ $record_id }}">
				@include('detail/fgs')
				@include('buttons/detail')
			</form>
       	</div>  		
	</div>
@stop