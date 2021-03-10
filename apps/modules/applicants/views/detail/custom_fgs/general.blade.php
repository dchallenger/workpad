<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('applicants.gen_info') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- <form action="#" class="form-horizontal"> -->
		<!-- <form class="form-horizontal" id="form-1" partner_id="1" method="POST"> -->
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label text-right text-muted col-md-3">{{ lang('applicants.last') }} :</label>
						<div class="col-md-5">
							<span>{{ $record['lastname'] }}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">					
					<div class="form-group">
						<label class="control-label text-right text-muted col-md-3">{{ lang('applicants.first') }} :</label>
						<div class="col-md-5">
							<span>{{ $record['firstname'] }} </span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">						
					<div class="form-group">
						<label class="control-label text-right text-muted col-md-3">{{ lang('applicants.middle') }} :</label>
						<div class="col-md-5">
							<span>{{ $record['middlename'] }} </span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">										
					<div class="form-group">
						<label class="control-label text-right text-muted col-md-3">{{ lang('applicants.maiden') }} :<br><small class="text-muted">(if applicable)</small></label>
						<div class="col-md-5">
							<span>{{ $record['maidenname'] }} </span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">														
					<div class="form-group">
						<label class="control-label text-right text-muted col-md-3">{{ lang('applicants.nick') }} :</label>
						<div class="col-md-5">
							<span>{{ $record['nickname'] }} </span>
						</div>
					</div>
				</div>
			</div>	                
        </div>
	</div>
</div>