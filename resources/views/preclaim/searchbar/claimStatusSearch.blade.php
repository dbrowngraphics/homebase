<select class="form-control form-control-lg" name="status_select">
	<option value="">Select A Claim Status</option>
	@foreach($claimSearchItems as $key => $value)
	<option value="{{ $key }}">{{ $value }}</option>
	@endforeach
</select>