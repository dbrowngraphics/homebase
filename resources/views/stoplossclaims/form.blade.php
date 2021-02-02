@extends('layouts.master')

@section('content')
<main id="js-page-content" role="main" class="page-content" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
<div class="container-fluid">

	@include('flash-message')

	@php
		$fid      = isset($input['fid']) ? $input['fid'] : '';
		$dp_code  = isset($input['dependent_code']) ? $input['dependent_code'] : '';
		$pending  = isset($input['pending']) ? $input['pending'] : '';
		$selected = isset($input['pending']) ? 'selected' : '';

	@endphp

	<form id="stoplossform" action="{{ route('stoploss') }}" method="POST">
		@csrf
		<div class="row">
			<div class="offset-lg-2 col-lg-3 offset-md-1 col-md-4 col-sm-12  my-2">
		    	<div class="form-group">
		    		<label>FID:</label>
		            <input type="text" class="form-control form-control-lg target" id="fid" name="fid" value="{{ $fid }}" maxlength="8" onkeypress="return isNumberKey(event)" />
		            <!-- onkeypress="return isNumberKey(event)" -->
		        </div>
		    </div>

		    <div class="col-lg-3 col-md-3 col-sm-12 my-2">
		    	<div class="form-group">
		    		<label>Dependent Code:</label>
		            <input type="text" class="form-control form-control-lg target" id="dependent" name="dependent" value="{{ $dp_code }}" maxlength="2" />
		        </div>
		    </div>

		   	<div class="col-lg-3 col-md-2 col-sm-12 my-2">
		    	<div class="form-group">
		    		<label>Pending Type:</label>
		            <select class="form-control form-control-lg target" id="pending" name="pending"  value="{{ $pending }}">
		            	<option value="K" <?php if('K' == $pending) { echo "selected"; } ?> >K</option>
		            	<option value="S" <?php if('S' == $pending) { echo "selected"; } ?> >S</option>
		            </select>
		        </div>
		    </div>
		</div>

		<div class="row mt-3">
			<div class="offset-lg-10 col-lg-1 offset-md-8 col-md-2 offset-sm-6 col-sm-6">
	    		<button id="submitBtn" class="btn btn-lg btn-primary btn float-right" type="submit" disabled>Submit</button>
	    	</div>
	    </div>
	</form>
</div>
</main>
@endsection


@push('scripts')
<script>
	// Only accepts numbers
	function isNumberKey(event) {

		var keycode = event.keyCode;

		if (keycode >= 48 && keycode <= 57) {
			return true;
		}

		return false;
	}


$(document).ready( function() {

	function readyToSubmit() {
		var fid = $('#fid').val(),
		dep = $('#dependent').val(),
		pending = $('#pending').val();

		if ((fid.length == 8) && (dep.length == 2) && (pending != '0')) {
			$('#submitBtn').prop("disabled", false);
			console.log('Enable submitBtn');
		} else {
			$('#submitBtn').prop("disabled", true);
		}
	}

	$('#fid, #dependent, #pending').on("keyup change mouseup", function() {
		readyToSubmit();
	});

});
</script>
@endpush