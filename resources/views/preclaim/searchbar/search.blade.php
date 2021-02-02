<!-- <form id="searchClaims" action="#" method="GET"> -->
<form id="searchClaims" action="{{ route('search') }}" method="GET"> <!-- was POST -->
@csrf

	<div class="row pt-3">
	    <div class="col-lg-3 col-md-4 col-sm-12">
	        <div class="form-group">
	            <select id="selectClaimDropdown" class="form-control form-control-lg" name="claim_search_select">
	                <optgroup>
	                    <option id="med" value="U">Medical Claims</option>
	                    <option id="den" value="D">Dental Claims</option> 
	                    <option id="vis" value="V">Vision Claims</option>
	                </optgroup>
	                <optgroup label="---------------------------">
	                    <option id="nod" value="node">Node</option>
	                    <option id="bid" value="batchid">Batch Id</option>
	                    <option id="cnum" value="claimnum">Claim Number</option>
	                    <option id="dnum" value="dcn">DCN</option>
	                    <option id="btype" value="batchtype">Batch Type</option>
	                    <option id="cstat" value="claimstatus">Claim Status</option>
	                    <option id="auser" value="assigned">Assigned</option>
	                </optgroup>
	            </select>
	        </div>
	    </div> <!-- col-lg-3 col-md-4 col-sm-12 -->

	    <div class="col-lg-3 col-md-4 col-sm-12">
        	<div id="textInput" class="form-group">
                <input type="text" class="form-control form-control-lg"  name="text_select" />
            </div>
            <div id="batchType" class="form-group">
                @include('preclaim.searchbar.batchTypeSearch')
            </div>
            <div id="claimStatus" class="form-group">
                @include('preclaim.searchbar.claimStatusSearch')
            </div>
            <div id="userQueue" class="form-group">
                @include('preclaim.searchbar.userQueueSearch')
            </div>
        </div>

        <div class="col-lg-6 col-md-4 col-sm-12">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>

            <div class="button-group" style="display: inline-block;">
                <button type="button" class="btn btn-secondary btn-lg dropdown-toggle ml-3" data-toggle="dropdown"><i class="fal fa-cog mr-2"></i></span>Options<span class="caret"></span></button>

                <div class="dropdown-menu" style="padding: 10px;">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked1">
                        <label class="custom-control-label" for="defaultUnchecked1">Display Claim Image</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked2" checked disabled>
                        <label class="custom-control-label" for="defaultUnchecked2">Display Notes</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked3">
                        <label class="custom-control-label" for="defaultUnchecked3">Refresh Visual Triggers</label>
                    </div>

                    <hr style="" />

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked4">
                        <label class="custom-control-label" for="defaultUnchecked4">Warn About Previously Closed</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked5">
                        <label class="custom-control-label" for="defaultUnchecked5">Warn About Previously Paid</label>
                    </div>

                    <hr />

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input nodeGroup" id="defaultUnchecked6">
                        <label class="custom-control-label" for="defaultUnchecked6">Show Node/Group</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input familyId" id="defaultUnchecked7">
                        <label class="custom-control-label" for="defaultUnchecked7">Show Family ID</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input memberPatient" id="defaultUnchecked8">
                        <label class="custom-control-label" for="defaultUnchecked8">Show Member/Patient Names</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input physicianPayee" id="defaultUnchecked9">
                        <label class="custom-control-label" for="defaultUnchecked9">Show Physician/Payee Names</label>
                    </div>
                </div>

          </div>
        </div>


	</div> <!-- END .row -->

</form>


@push('scripts')
<script>
	$('#batchType, #claimStatus, #userQueue').hide();

	$('#selectClaimDropdown').on("focus change", function() {

        if($('#btype').is(":selected")) {

            $('#textInput, #claimStatus, #userQueue').hide();
            $('#batchType').show();
        }

        if($('#cstat').is(":selected")) {

            $('#textInput, #batchType, #userQueue').hide();
            $('#claimStatus').show();
        }

        if($('#auser').is(":selected")) {

            $('#textInput, #batchType, #claimStatus').hide();
            $('#userQueue').show();
        }

        if($('#nod, #bid, #cnum, #dnum').is(":selected")) {

            $('#batchType, #claimStatus, #userQueue').hide();
            $('#textInput').show();
            $('#textInput > input').prop("disabled", "");
        }

        if($('#med, #den, #vis').is(":selected")) {

            $('#batchType, #claimStatus, #userQueue').hide();
            $('#textInput').show();
            $('#textInput > input').prop("disabled", "disabled");
        }
    });


    // Ajax Form Submission
    // $('#searchClaims').submit( function( event ) {
    //     event.preventDefault();

    //     var url = '{{ route('search') }}';
    //     var formData = [];

    //     var 
    //       claimDropdown = $('#selectClaimDropdown').val(),
    //       textSelect    = $('input[name=text_select]').val(),
    //       batchSelect   = $('select[name=batch_select]').val(),
    //       claimSelect   = $('select[name=claim_select]').val(),
    //       userSelect    = $('select[name=user_select]').val();


    //     $.ajaxSetup({
    //     headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    //     });

    //     $.ajax({
    //         method   : 'GET', // define the type of HTTP verb we want to use (POST for our form)
    //         url      : url, // the url where we want to POST
    //         data     : {
    //         claim_search_select : claimDropdown,
    //         text_select         : textSelect,
    //         batch_select        : batchSelect,
    //         claim_select        : claimSelect,
    //         user_select         : userSelect
    //         }, // our data object
    //         dataType : 'json', // what type of data do we expect back from the server
    //         encode   : true
    //     })
    //     // using the done promise callback
    //     .done(function(data) {

    //         $('#main-page-content').html(data.data);
    //         $('#dt_basic').DataTable();


    //     // here we will handle errors and validation messages
    //     });

    // });

</script>
@endpush