@extends('layouts.master')

@section('content')

<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
<!-- <div class="flex-1" > -->
	<div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">

		@include('flash-message')

		<div class="row">
			<div class="col col-md-6 col-lg-7 hidden-sm-down">
<!-- 				<h2 class="fs-xxl fw-500 mt-4">
					The simplest UI toolkit for developers & programmers
					<small class="h3 fw-300 mt-3 mb-5 opacity-60">Presenting you with the next level of innovative UX design and engineering. The most modular toolkit available with over 600+ layout permutations. Experience the simplicity of SmartAdmin, everywhere you go!
					</small>
				</h2> -->

				<h2 class="fs-xxl fw-500 mt-4">
					Welcome to your <b>HOMEBASE</b>
					<small class="h3 fw-300 mt-3 mb-5 opacity-80">This account is for your internal CWI applications. To reset your password, just fill-in your username and new password.
					</small>
				</h2>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
				<h1 class="fw-300 mb-3 d-sm-block d-md-none">Secure Login</h1>
				<div class="card p-4 rounded-plus bg-faded">
					<!-- <form id='js-login' action="#" novalidate> -->
					<form method="POST" action="{{ route('login') }}">
                        @csrf
						<div class="form-group">
							<label class="form-label" for="logon_id">Username</label>
							<input type="text" id="logon_id" name="logon_id" class="form-control form-control-lg" placeholder="your username" required>
							<div class="help-block">Your internal username...</div>
						</div>

						<div class="form-group">
							<label class="form-label" for="email">Email</label>
							<input type="text" id="email" name="email" class="form-control form-control-lg" placeholder="your email" required>
							<div class="help-block">Your email address...</div>

						</div>

						<div class="row no-gutters">
							<div class="col-lg-6 offset-lg-6 pr-lg-1 my-2">
								<button type="submit" class="btn btn-info btn-block btn-lg waves-effects waves-themed">Email Link</button>
							</div>
						</div>
					</form>

				</div>
		</div>

	</div>
<!-- </div> -->
</main>
<!-- this overlay is activated only when mobile menu is triggered -->
<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>

@endsection