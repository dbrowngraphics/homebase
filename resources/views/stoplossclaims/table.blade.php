@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection

@section('content')
<main id="js-page-content" role="main" class="page-content" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
<div class="container-fluid">
	<div class="row">
		<div class="col">

			<form id="stoplosschanges" action="{{ route('stoplosschanges') }}" method="POST">
				@csrf

				<table id="stoploss_table" class="table table-striped table-hover d-none d-lg-table">
					<thead class="bg-info-900">
						<tr>
							<th class="text-centered"></th>
							<th class="text-centered">Node</th>
							<th class="text-centered">FID</th>
							<th class="text-centered">Dependent Code</th>
							<th class="text-centered">Employee Name</th>
							<th class="text-centered">Dependent Name</th>
							<th class="text-centered">Provider</th>
							<th class="text-centered">Status</th>
							<th class="text-centered">Claim</th>
							<th class="text-centered">Date of Service</th>
							<th class="text-centered">Amount</th>
						</tr>
					</thead>
					<tbody>
					<?php $count = 1; ?>
					@foreach($claims as $claim)
						
						<tr>
							<td class="text-centered">
								<div class="custom-control custom-checkbox">
									<input id="checkbox{{ $count }}" name="claims[]" type="checkbox" class="custom-control-input checkbox" value="{{ $claim->claim }}" data-value="{{ $claim->amount }}" data-rownum="checkboxRow-{{ $count }}" />
									<label class="custom-control-label" for="checkbox{{ $count }}"></label>
								</div>
							</td>
							<td class="text-centered"><label for="checkbox{{ $count }}">{{ $claim->node }}</label></td>
							<td class="text-centered"><label for="checkbox{{ $count }}">{{ $claim->fid }}</label></td>
							<td class="text-centered"><label for="checkbox{{ $count }}">{{ $claim->dependent_code }}</label></td>
							<td class="text-centered"><label for="checkbox{{ $count }}">{{ $claim->employee_name }}</label></td>
							<td class="text-centered"><label for="checkbox{{ $count }}">{{ $claim->dependent_name }}</label></td>
							<td class="text-centered"><label for="checkbox{{ $count }}">{{ $claim->provider_name }}</label></td>
							<td class="text-centered"><label for="checkbox{{ $count }}">{{ $claim->pending }}</label></td>
							<td class="text-centered"><label for="checkbox{{ $count }}">{{ $claim->claim }}</label></td>
							<td class="text-centered"><label for="checkbox{{ $count }}">{{ date('M d, Y', strtotime($claim->date_of_service)) }}</label></td>
							<td style="text-align: right"><label for="checkbox{{ $count }}">${{ number_format($claim->amount, 2, '.', ',') }}</label></td>
						</tr>

					<?php $count++; ?>
					@endforeach
					</tbody>
					<tfoot class="">
						<tr>
							<td colspan="3">
								<div class="custom-control custom-checkbox">
									<input id="toggleAll" type="checkbox" class="custom-control-input toggleAll" />
									<label id="toggleOnOff" class="custom-control-label toggleOnOff" for="toggleAll"><b>Toggle All On</b></label>
								</div>
							</td>
							<td colspan="7" style="text-align: right"><b>Total Amount</b></td>
							<td id="totalAmount" class="totalAmount" style="text-align: right"><b>$0.00</b></td>
						</tr>
					</tfoot>
				</table>


<!-- Display for smaller screens -->

				<div class="claim-table-sm d-lg-none d-md-block">
					<div class="container-fluid">
						<div class="row bg-info-900 py-2">
							<div class="col-3">
								<div class="cell-title">Employee</div>
								<div>{{ $claims[0]->employee_name }}</div>
							</div>
							<div class="col">
								<div class="cell-title">Node</div>
								<div>{{ $claims[0]->node }}</div>
							</div>
							<div class="col">
								<div class="cell-title">FID</div>
								<div>{{ $claims[0]->fid }}</div>
							</div>
							<div class="col">
								<div class="cell-title">Dep. Code</div>
								<div>{{ $claims[0]->dependent_code }}</div>
							</div>
							<div class="col">
								<div class="cell-title">Status</div>
								<div>{{ $claims[0]->pending }}</div>
							</div>
						</div>		
					</div>
				<?php $count = 1; ?>
				@foreach ($claims as $claim)
					<div class="card-header d-sm bg-white stoploss-card-header-border-top">

						<div class="row">
							<div class="col-1">
								<div class="custom-control custom-checkbox">
									<input id="checkbox{{ $count }}-2" name="claims[]" type="checkbox" class="custom-control-input checkbox" value="{{ $claim->claim }}" data-value="{{ $claim->amount }}" data-rownum="checkboxRow-{{ $count }}" />

									<label class="custom-control-label" for="checkbox{{ $count }}-2"></label>
								</div>
							</div>

							<div class="col-4">
								<div class="cell-grow">
									<label for="checkbox{{ $count }}-2">
										<div class="cell-title">Dependent</div>
										<div>{{ $claim->dependent_name }}</div>
									</label>
								</div>
							</div>
							<div class="col-3">
								<div class="cell-grow">
									<label for="checkbox{{ $count }}-2">
										<div class="cell-title">Claim</div>
										<div>{{ $claim->claim }}</div>
									</label>
								</div>
							</div>
							<div class="col-3">
								<div class="cell-grow">
									<label for="checkbox{{ $count }}-2">
										<div class="cell-title" style="text-align: right;">Amount</div>
										<div style="text-align: right;">${{ number_format($claim->amount, 2, '.', ',') }}</div>
									</label>
								</div>
							</div>

							<div class="col-1" data-toggle="collapse" data-target="#dropdown-show{{ $count }}" aria-expanded="false">
								<span class="ml-auto">
									<span class="collapsed-reveal">
										<i class="fal fa-chevron-up fs-xl"></i>
									</span>
									<span class="collapsed-hidden">
										<i class="fal fa-chevron-down fs-xl"></i>
									</span>
								</span>
							</div>
						</div>

					</div>

					<div class="card-body bg-white">

						<div class="row collapse" id="dropdown-show{{ $count }}">
							<div class="col-4 offset-1">
								<div class="cell-grow">
									<label for="checkbox{{ $count }}-2">
										<div class="cell-title">Provider</div>
										<div>{{ $claim->provider_name }}</div>
									</label>
								</div>
							</div>
							<div class="col-4">
								<div class="cell-grow">
									<label for="checkbox{{ $count }}-2">
										<div class="cell-title">Date of Service</div>
										<div>{{ date('M d, Y', strtotime($claim->date_of_service)) }}</div>
									</label>
								</div>
							</div>
						</div>
					</div>
					<?php $count++; ?>
				@endforeach

					<div class="card-footer">
						<div class="row">
							<div class="col-4">
								<div class="custom-control custom-checkbox">
									<input id="toggleAll2" type="checkbox" class="custom-control-input toggleAll" 
									/>
									<label id="toggleOnOff" class="custom-control-label toggleOnOff" for="toggleAll2"><b>Toggle All On</b></label>
								</div>
							</div>

							<div class="col-7" style="text-align: right; font-weight: bold;">Total Amount <span id="totalAmount" class="totalAmount" style="padding-left: 15px"><b>$0.00</b></span></div>

							<div class="col-1"></div>
						</div>

					</div>

				</div> 

<!-- End Display for smaller screens -->



				<input type="hidden" id="currentStatus" name="currentStatus" value="{{ $status }}" />
				<input type="hidden" id="futureStatus" name="status" value="" />
				
				@if($status == 'K')
				<button class="btn btn-primary submit mr-3 mb-3" value="S" >Change Selected Claim Status S</button>
				@endif

				<button class="btn btn-info submit mb-3" value="T" >Change Selected Claim Status T</button>

			</form>
		</div>
	</div>
	
</div>
</main>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script type="text/javascript">
$(function() {
	$('.submit').prop('disabled', 'disabled');

	$('.submit').on('click', function(e) {
	
		e.preventDefault();

		var status = $(this).val();
		var total = $('#totalAmount').text();

		$('#futureStatus').val(status);

		$('.checkbox').each( function() {
			if (! $(this).is(":visible") && this.checked) {
				// removed checked if not visible
				$(this).prop('checked', false);
			}
		});

		$.confirm({
			title: 'Please Confirm',
			content: 'Are you sure that you would like to change the current status to <b>' + status + '</b> for the selected claims amounting in <b>' + total + '</b>?',
			icon: 'fas fa-exclamation-triangle',
			theme: 'modern',
			type: 'blue',
			buttons: {
		        confirm: {
		            text: 'Confirm',
		            btnClass: 'btn-green',
		            action: function(){
		            	$('#stoplosschanges').submit();
		            }
		        },
		        cancel: {
		            text: 'Cancel',
		            btnClass: 'btn-red'
		        }
	      	}
		});
	});

	// was #toggleAll
	$('.toggleAll').on('change', function() {

		if (this.checked) {

			$('.checkbox').each( function() {
				$(this).prop('checked', true);
			});

			// Force both sizes of the Toggle All button to be selected
			$('.toggleAll').prop('checked', true);
			// was #toggleOnOff
			$('.toggleOnOff').html("<b>Toggle All Off</b>");
			sumChecked();

		} else {

			$('.checkbox').each( function() {
				$(this).prop('checked', false);
			});

			// Force both sizes of the Toggle All button to be deselected
			$('.toggleAll').prop('checked', false);

			$('.toggleOnOff').html("<b>Toggle All On</b>");
			sumChecked();

		}
	});

	$('.checkbox').on('change', function() {
		var row = $(this).data('rownum');

		if (this.checked) {
			$('.checkbox[data-rownum="' + row + '"]').prop("checked", true);
		} else {
			$('.checkbox[data-rownum="' + row + '"]').prop("checked", false);
		}

		sumChecked();
	});

	function sumChecked () {

		var sum = parseFloat(0.00);
		var canSubmit = false;

		$('.checkbox').each( function() {
			if($(this).is(":visible") && this.checked) {
				console.log("Each Checkbox - isVisible & checked");

				sum += parseFloat($(this).data('value'));
				canSubmit = true;
			} 

			number = numberWithCommas(sum.toFixed(2));
			// was #totalAmount
			$('.totalAmount').html('<b>$' + number + '</b>' );

			if (sum > 0 || canSubmit) {
				$('.submit').prop('disabled', '');
			} else {
				$('.submit').prop('disabled', 'disabled');
			}

		});
	}

	function numberWithCommas(number) {

	    var parts = number.toString().split(".");
	    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	    return parts.join(".");
	}
});
</script>

@endpush