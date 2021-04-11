@extends('layouts.master')

@section('page_content')
@parent
<link href="{{ theme_path() }}plugins/select2/select2_metro.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
.table_organization_container {
  overflow: auto;
  min-height: 300px;
  width: 100%;
}
</style>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet">
			<div class="portlet-body form">
                <form action="#" class="form-horizontal">
                    <div class="form-body" style="padding-bottom:0px;">
						<div class="row">
							<div class="col-md-5">
                            	<div class="form-group">
                                    <label class="control-label col-md-3">{{ lang('table_organization.filter' )}}</label>
                                    <div class="col-md-9">
                                        <select id="filter" name="filter" class="form-control select2me" data-placeholder="Select...">
                                        	<option value="1">Management (Pres to Div Head)</option>
                                            <option value="2">Management (Pres to Managers)</option>
                                            <option value="3">Divisional Management</option>
                                            <option value="4">Divisional</option>
                                            <option value="5">Department</option>
                                        </select>
                                    </div>
                                </div>
							</div>
							<div class="col-md-5">
								<div class="form-group division_container" style="display:none">
									<label class="control-label col-md-3">{{ lang('table_organization.division') }}</label>
									<div class="col-md-9">
										{{ form_dropdown('filter_val[]',$division, '', 'class="form-control select2me div_dept" data-placeholder="Select..." multiple id="division"') }}
									</div>
								</div>
								<div class="form-group department_container" style="display:none">
									<label class="control-label col-md-3">{{ lang('table_organization.department') }}</label>
									<div class="col-md-9">
										{{ form_dropdown('filter_val[]',$department, '', 'class="form-control select2me div_dept" data-placeholder="Select..." multiple id="department"') }}
									</div>
								</div>								
							</div>						
						</div>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label class="control-label col-md-3">&nbsp;</label>
									<div class="col-md-9">
										<button type="button" class="btn green btn-sm generate_table_organization">Submit</button>
									</div>
								</div>
							</div>								
						</div>
					</div>
                </form>
			</div>
		</div>
		<div class="portlet">
			<hr>
			<div class="form-body" style="padding-bottom:0px;">
				<div class="col-md-12 table_organization_container" align="center">
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
<script src="{{ theme_path() }}plugins/select2/select2.min.js" type="text/javascript" ></script>
@stop

@section('view_js')
@parent
{{ get_list_js( $mod ) }}
@stop
