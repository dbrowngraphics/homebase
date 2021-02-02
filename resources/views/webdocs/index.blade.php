@extends('layouts.master')

@section('content')
<main id="js-page-content" role="main" class="page-content" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header bg-primary py-5"></div>

                <div class="card-body">
                    <small class="h3 fw-400 mt-3 mb-5 opacity-80">WebDocs WebDocs WebDocs! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </small>


                </div>
            </div>

            <form method="POST" action="{!! route('getNode') !!}" accept-charset="UTF-8" class="container" style="width: 80%; margin: 0 auto;">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="form-group col-md-3 col-md-offset-4">
                        <label>Pick A Node:</label>
                        {{ Form::select('node_id', $node_list, null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group col-md-1">
                        <label style="visibility: hidden;">Submit</label>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
</main>
@endsection