@extends('layouts.master')

@section('content')
<main id="js-page-content" role="main" class="page-content" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
<div class="container">
	<div class="row justify-content-center py-5 mt-5" style="background-color: #f9d2ce; border-radius: 10px;">

        @if (session('status'))
		    <div class="alert alert-success" role="alert">
		        {{ session('status') }}
		    </div>
		@endif

    	<div class="col-xl-3 col-lg-4 col-md-4"> 
    		<div style="border-radius: 50%; width: 200px; height: 200px; border: 2px solid #d23a3a; background-color: #d23a3a; float: left;">
    		
    			<i class="fas fa-lg fa-robot" style="font-size: 108px;color: #ffffff; text-align: center; margin-top: 50.5px; margin-left: 32.5px"></i>
    		</div>
    	</div>

    	<div class="col-lg-6 col-md-6 mt-5">
    		<small class="h3 fw-800 mb-5 opacity-80" style="color: #d23a3a;">Sorry {{ Auth::user()->first_name }}, you don't currently have permission to view this section. Please contact your manager or IT to have your permissions updated.</small>

		</div>

    </div>


</div>
</main>
@endsection
