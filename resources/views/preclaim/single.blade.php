@extends('preclaim.master')

@section('content')

<main id="js-page-content" role="main" class="page-content" style="background: url(../img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
	<div class="container-flex">
	    <div id="main-page-content" class="row">
	    	<div class="col-xl-8">
	    		@include('preclaim.single_parts.single_panel')
	    	</div>

	    	<div class="col-xl-4">
	    		@include('preclaim.single_parts.errors_panel')
	    		@include('preclaim.single_parts.notes_panel')
	    		<!-- @ include('preclaim.single_parts.scanviewer_panel') -->
	    	</div>

	    </div>
	</div>

</main>
		
@endsection