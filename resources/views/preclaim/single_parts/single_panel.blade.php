@if(isset($claim->claim_type) && 'D' == $claim->claim_type)
	
	@include('preclaim.single_parts.dental_panel')

@else

	@include('preclaim.single_parts.health_panel')

@endif