<select class="form-control form-control-lg" name="user_select">
	<option value="">Select A User</option>
	@foreach($claimSearchItems as $key => $value)
	<option value="{{ $key }}">{{ $value }}</option>
	@endforeach
</select>