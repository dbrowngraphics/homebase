@php
	function formatText($text) {

		return ucwords(strtolower($text));
	}

	$can_edit = session()->get('pc_den_edit') ?? '';
	$color = 'btn-secondary';
	$disabled = 'disabled';

	if ('Y' == $can_edit) {
		$color = 'btn-info';
		$disabled = '';
	}
@endphp

<div id="panel-single" class="panel panel-sortable">
    <div class="panel-hdr bg-primary-900">
        <h2>
        	<b>{{ $claim->batch_id }}</b>.{{ $claim->item_id }} &nbsp;&nbsp;&nbsp;&nbsp;
            Node: <span class="fw-300"><i>{{ $claim->node }}</i> &nbsp;&nbsp;-&nbsp;&nbsp; </span>
            Group: <span class="fw-300"><i>{{ $claim->group_id }}</i> &nbsp;&nbsp;-&nbsp;&nbsp; </span>
            Plan: <span class="fw-300"><i>{{ $claim->plan }}</i> &nbsp;&nbsp;-&nbsp;&nbsp; </span>
            DCN: <span class="fw-300"><i>{{ $claim->dcn }}</i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>

            <a class="scanviewer-icon" title="Scan Viewer" href="http://intranet.cwibenefits.com/scanviewer2/?dcn={{ $claim->dcn }}" target="popup"
        		onclick="window.open('http://intranet.cwibenefits.com/scanviewer2/?dcn={{ $claim->dcn }}', 'popup', 'width=800,height=800'); return false;">
        		<span class="fal fa-file-alt fa-2x"></span>
        	</a>
        </h2>
        <div class="panel-toolbar">
            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
        </div>
    </div>
    <div class="panel-container show">
        <div id="panel-datatables" class="panel-content" style="overflow-x: scroll;">

        	<h2>Dental Panel - {{ $claim->claim_type }} - {{ $claim->claim_type_desc }}</h2>
        	<form style="font-size: 0.9rem;">
        		<div class="row">
        			<div class="col-sm-7">
			        	<div class="form-group row mb-1">
			        		<label class="col-sm-3 col-form-label" style="text-align: right;"><b>Member Id</b></label>
			        		<div class="col-sm-5">
			        			<input class="form-control" value="{{ $claim->member_id }}" disabled>
			        		</div>

			        		<div class="col-sm-4">
			        			<div class="input-group">
			        				<div class="input-group-prepend">
			        					<span class="input-group-text text-success">
			        						<i class="ni ni-user fs-sm"></i>
			        					</span>
			        				</div>
			        				<input type="text" class="form-control" value="{{ formatText($claim->member_first . ' ' . $claim->member_middle . ' ' . $claim->member_last) }}">
			        			</div>
			        		</div>
			        	</div>

			        	<div class="form-group row mb-1">
			        		<label class="col-sm-3 col-form-label" style="text-align: right;"><b>Patient</b></label>
			        		<div class="col-sm-5">
			        			<input class="form-control" value="{{ formatText($claim->patient_first . ' ' . $claim->patient_middle . ' ' . $claim->patient_last) }}" disabled>
			        		</div>

			        		<div class="col-sm-4">
			        			<div class="input-group">
			        				<div class="input-group-prepend">
			        					<span class="input-group-text text-success">
			        						<i class="ni ni-user fs-sm"></i>
			        					</span>
			        				</div>
			        				<input type="text" class="form-control" value="{{ $claim->dependent_code }}  00/00/0000">
			        			</div>
			        		</div>
			        	</div>

			        	@php
			        		$physician_id = substr_replace( $claim->provider_id, '  ', 9, 0);
			        		$physician_id = substr_replace( $physician_id, '-', 2, 0);
			        	@endphp 

			        	<div class="form-group row mb-1">
			        		<label class="col-sm-3 col-form-label" style="text-align: right;"><b>Physician</b></label>
			        		<div class="col-sm-5">
			        			<input class="form-control" value="{{ $physician_id }}" disabled>
			        		</div>

			        		<div class="col-sm-4">
			        			<div class="input-group">
			        				<div class="input-group-prepend">
			        					<span class="input-group-text text-success">
			        						<i class="ni ni-user fs-sm"></i>
			        					</span>
			        				</div>
			        				<input type="text" class="form-control" value="Physician_Name">
			        			</div>
			        		</div>
			        	</div>

			        	<div class="form-group row mb-1">
			        		<label class="col-sm-3 col-form-label" style="text-align: right;"><b>Account</b></label>
			        		<div class="col-sm-5">
			        			<input class="form-control" value="{{ $claim->patient_account }}" disabled>
			        		</div>
			        	</div>

			        	<div class="row mb-3">
			        		<div class="col-sm-3"></div>
			        		<div class="col-sm-9">
			        			<div class="custom-control custom-checkbox">
			        				<input type="checkbox" id="ASBcheckbox" class="custom-control-input" <?= ('Y' == $claim->benefits_assigned) ? 'checked' : '' ?>>
			        				<label class="custom-control-label" for="ASBcheckbox">Assignment of Benefits</label>
			        			</div>

			        			<br />

			        			<div class="custom-control custom-radio">
			        				<input type="radio" class="custom-control-input" id="dentistPre" name="dentistRadio">
			        				<label class="custom-control-label" for="dentistPre">Dentist's pre-trement estimate</label>
			        			</div>
			        			<div class="custom-control custom-radio">
			        				<input type="radio" class="custom-control-input" id="dentistActual" name="dentistRadio">
			        				<label class="custom-control-label" for="dentistActual">Dentist's statement of actual services</label>
			        			</div>
			        		</div>
			        	</div>

			        	<div class="row mb-3">
			        		<div class="col-sm-3"></div>
			        		<div class="col-sm-5">
			        			<div class="custom-control custom-checkbox">
			        				<input type="checkbox" id="COBcheckbox" class="custom-control-input" <?= ('Y' == $claim->cob)? 'checked' : '' ?>>
			        				<label class="custom-control-label" for="COBcheckbox">Use COB</label>
			        			</div>
			        		</div>
			        	</div>

			        	<div class="row mb-1">
				        	<div class="form-group col-sm-3">
				        		<label  style="text-align: right; float: right"><b>Amount Covered</b></label>
				        		<input type="number" class="form-control custom-control" name="points" value="{{ $claim->cob_covered }}" step="0.01">
				        	</div>

				        	<div class="form-group col-sm-3">
				        		<label  style="text-align: right; float: right"><b>Amout Paid</b></label>
				        		<input type="number" class="form-control custom-control" name="points" value="{{ $claim->cob_paid }}" step="0.01">
				        	</div>

				        	<div class="form-group col-sm-3">
				        		<label  style="text-align: right; float: right"><b>Liability</b></label>
				        		<input type="number" class="form-control custom-control" name="points" value="0.00" step="0.01">
				        	</div>

				        	<div class="form-group col-sm-3">
				        		<label  style="text-align: right; float: right"><b>Adjustment</b></label>
				        		<input type="number" class="form-control custom-control" name="points" value="0.00" step="0.01">
				        	</div>

				        </div>

			        </div> <!-- End left .col-sm-4 -->

			        <!-- <div class="col-sm-3"></div> --> <!-- End middle .col-sm-4 -->

			        <div class="col-sm-4 ml-5">
			        	<div><b>Member Address:</b></div>
			        	<div>{{ formatText($claim->member_street) }}</div>
			        	<div>{{ formatText($claim->member_city) . ' ' . $claim->member_state . ' ' . $claim->member_zip }}</div>

			        	<hr />

			        	<div><b>Physician Address:</b></div>
			        	<div>{{ $claim->billing_street }}</div>
			        	<div>{{ $claim->billing_city}} {{ $claim->billing_state}} {{ $claim->billing_zip }}</div>

			        	<hr />

			        	<div><b>Diagnosis Descriptions</b></div>
			        	<ol>
			        		@php
			        			$num = 1;
			        		 	$diagnosis_code = 'diagnosis_' . $num;
			        		 	$diagnosis_desc = 'diagnosis_' . $num . '_desc';

			        		 	while(($claim->$diagnosis_desc != null)) {

			        				echo '<li title="' . $claim->$diagnosis_code . '">' . $claim->$diagnosis_code . ' - ' . $claim->$diagnosis_desc . '</li>';

			        				$num++;
			        				$diagnosis_desc = 'diagnosis_' . $num . '_desc';
			        				$diagnosis_code = 'diagnosis_' . $num;
			        		 	}
			        		@endphp
			        		
			        	</ol>

			        	<hr />

			        	<div><b>Other Insurance:</b></div>
			        	<div><br /></div>

			        	<hr />

			        	<div><b>Network:</b></div>
			        	<div>Need Network Code</div>

			        </div> <!-- End right .col-sm-4 -->
		        </div>
        	</form>

        	<div class="row">
        		<div class="flexDisplay">
        			<button class="btn btn-secondary waves-effect waves-themed"><b><span class="fal fa-plus"></span>  Add</b></button>
        			<button class="btn {{ $color }} waves-effect waves-themed" {{ $disabled }}><b><span class="fal fa-minus"></span>  Edit</b></button>
        			<button class="btn btn-danger bg-danger-300 waves-effect waves-themed"><b><span class="fal fa-times"></span>  Delete</b></button>
        			<button class="btn btn-secondary waves-effect waves-themed"><b><span class="fal fa-arrow-alt-up"></span>  Up</b></button>
        			<button class="btn btn-secondary waves-effect waves-themed"><b><span class="fal fa-arrow-alt-down"></span>  Down</b></button>
        			<button class="btn btn-secondary waves-effect waves-themed"><b><span class="fal fa-check"></span>  Validate</b></button>
        			<button class="btn btn-secondary waves-effect waves-themed"><b><span class="fal fa-vial"></span>  Discount</b></button>
        			<button class="btn btn-danger bg-danger-900 waves-effect waves-themed"><b><span class="fal fa-times-hexagon"></span>  Close Claim</b></button>
        			<button class="btn btn-fusion bg-fusion-900 waves-effect waves-themed">Exit</button>
        		</div>

	        	<table class="table table-sm table-striped table-bordered my-2">
	        		<thead class="bg-primary">
	        			<tr>
	        				<th>#</th>
	        				<th>Tooth</th>
	        				<th>Surface</th>
	        				<th>Proc.</th>
	        				<th>Description</th>
	        				<th>Date</th>
	        				<th>Charges</th>
	        				<th>Reprice</th>
	        				<th>Benefit</th>
	        				<th>Remark</th>
	        				<th>Paid</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        		@php

	        			$total_charges    = 0;
	        			$total_reprice    = 0;
	        			$total_paid       = 0;
	        			setlocale(LC_MONETARY, 'en_US.UTF-8');
	        		@endphp

	        		@foreach($claim->details as $detail)

	        			<tr>
	        				<td>{{ $detail->line_id }}</td>
	        				<td>{{ $detail->tooth }}</td>
	        				<td>{{ $detail->surface }}</td>
	        				<td>{{ $detail->cpt_code }}</td>
	        				<td>{{ $detail->place_of_service_desc }}</td>
	        				<td>{{ date('m/d/Y', strtotime($detail->to_date)) }}</td>
	        				<td class="text-right">{{ money_format('%.2n', $detail->charges) }}</td>
	        				<td class="text-right">{{ money_format('%.2n', $detail->reprice) }}</td>
	        				<td>{{ $detail->benefit_code }} - {{ $detail->benefit_code_desc }}</td>
	        				<td>{{ $detail->remark }} </td>
	        				<td class="text-right">{{ money_format('%.2n', $detail->amount_paid) }}</td>
	        			</tr>

	        		@php
	        			$total_charges    += (float) $detail->charges * 100;
	        			$total_reprice    += (float) $detail->reprice * 100;
	        			$total_paid       += (float) $detail->amount_paid * 100;
	        		@endphp

	        		@endforeach

	        			<tr>
	        				<th colspan="6" style="text-align: right;">Total:</th>
	        				<th class="text-right">{{ money_format('%.2n', $total_charges / 100) }}</th>
	        				<th class="text-right">{{ money_format('%.2n', $total_reprice / 100) }}</th>
	        				<td></td>
	        				<td></td>
	        				<th class="text-right">{{ money_format('%.2n', $total_paid / 100) }}</th>
	        			</tr>
	        		</tbody>
	        	</table>
        	</div>
        </div>
    </div>
</div>