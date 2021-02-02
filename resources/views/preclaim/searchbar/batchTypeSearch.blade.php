<select class="form-control form-control-lg" name="batch_select">
	<option value="">Select Batch Type</option>
	@foreach($claimSearchItems as $key => $value)
	<option value="{{ $key }}">{{ $value }}</option>
	@endforeach
</select>