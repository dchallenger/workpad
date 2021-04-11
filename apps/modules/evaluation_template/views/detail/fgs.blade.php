<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Template Evaluation</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">			
		<div class="form-group">
			<label class="control-label col-md-3">
				<span class="required">* </span>Evaluation Title
			</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="training_evaluation_template[title]" id="training_evaluation_template-title" value="{{ $record['training_evaluation_template.title'] }}" readonly/>
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">Description</label>
			<div class="col-md-7">							
				<textarea class="form-control" name="training_evaluation_template[description]" id="training_evaluation_template-description" readonly rows="4">{{ $record['training_evaluation_template.description'] }}</textarea> 				
			</div>	
		</div>	
	</div>
</div>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Template Sections</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div id="sectionsDiv" style="display:none;">
		<p class="small margin-bottom-25"></p>
		<div class="portlet-body form">	
			<div class="portlet margin-top-25">
				<div class="portlet-body" id="saved-sections">
				</div>
			</div>			
		</div>
	</div>
</div>