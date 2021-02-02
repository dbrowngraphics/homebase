@extends('preclaim.master')

@section('content')

<main id="js-page-content" role="main" class="page-content">
<div class="container-flex">
    <div class="row">
		<div class="col-xl-12">
		    <div id="panel-1" class="panel">
		        <div class="panel-hdr">
		            <h2>
		                Panel <span class="fw-300"><i>Title</i></span>
		            </h2>
		            <div class="panel-toolbar">
		                <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
		                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
		                <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
		            </div>
		        </div>
		        <div class="panel-container show">
		            <div id="panel-datatables" class="panel-content" style="overflow-x: scroll;">

		                <table id="dt_basic" class="table m-0 table-bordered table-striped table-hover table-sm dataTable no-footer" width="100%" role="grid" aria-describedby="dt_basic_info">
		                    <thead>
		                        <tr>
		                            <th class="batch">Batch</th>
		                            <th class="item">Item</th>
		                            <th class="node">Node</th>
		                            <th class="grp">Grp</th>
		                            <th class="group">Group</th>
		                            <th class="plan">Plan</th>
		                            <th class="queue">Queue</th>
		                            <th class="rcvd">Rcvd</th>
		                            <th class="statusType">Status</th>
		                            <th class="network">Network</th>
		                            <th class="agent">Agent</th>
		                            <th class="ssn">SSN</th>
		                            <th class="fid">FID</th>
		                            <th class="name">Name</th>
		                            <th class="patient">Patient</th>
		                            <th class="physicianId">Physician Id</th>
		                            <th class="physicianName">Physician</th>
		                            <th class="payee">Payee</th>
		                            <th class="billFrom">From</th>
		                            <th class="billTo">To</th>
		                            <!-- <th class="est">Est?</th> -->
		                            <th class="dcn">DCN</th>
		                            <th class="totalCharge">Charged</th>
		                            <th class="batchType">Batch Type</th>
		                            <th class="claimType">Type</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    @foreach ($claims as $claim)

		                        <tr id="{{ $claim->batch_id }}" data-status="{{ $claim->status }}">
		                            <td class="batch" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->batch_id }}</a></td>
		                            <td class="item" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->item_id }}</a></td>
		                            <td class="node" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->node }}</a></td>
		                            <td class="grp" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->group_id }}</a></td>
		                            <td class="group" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->group_name }}</a></td>
		                            <td class="plan" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->plan }}</a></td>
		                            <td class="queue" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->user_queue_id }}</a></td>
		                            <td class="rcvd" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->receive_date }}</a></td>
		                            <td class="statusType" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->status }}</a></td>
		                            <td class="network" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->reprice_network }}</a></td>
		                            <td class="agent" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->reprice_agent_id }}</a></td>
		                            <td class="ssn" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->member_id }}</a></td>
		                            <td class="fid" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->fid }}</a></td>
		                            <td class="name" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->member_name }}</a></td>
		                            <td class="patient" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->patient_name }}</a></td>
		                            <td class="physicianId" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->physician_id }}</a></td>
		                            <td class="physicianName" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->physician_name }}</a></td>
		                            <td class="payee" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->physician_payee_name }}</a></td>
		                            <td class="billFrom" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->bill_from }}</a></td>
		                            <td class="billTo" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->bill_to }}</a></td>
		                            <!-- <td class="est">{{ $claim->node }}</td> -->
		                            <td class="dcn" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->dcn }}</td>
		                            <td class="totalCharge" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->total_charge }}</td>
		                            <td class="batchType" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->type_desc }}</td>
		                            <td class="claimType" style="border-top: 3px solid {{ $claim->row_color }}"><a href="{!! route('single', ['batch_id' => $claim->batch_id, 'item_id' => $claim->item_id]) !!}">{{ $claim->type }}</td>
		                        </tr>
		                    @endforeach
		                    </tbody>
		                </table>

		                {{-- $claims->links() --}}
		            </div>
		        </div>
		    </div>
		</div>


    </div>
</div>
</main>

@endsection

@push('scripts')
<script>
	@php 
		$adjust_claim = session()->get('permissions.pc_adjust_claim') ?? '';
	@endphp


	$("table#dt_basic tr").on('click', function(e){

		var adjustClaim = "<?= $adjust_claim ?>";
		var status = $(this).data('status');

		if ('Y' != adjustClaim && 'P' == status) {
			e.preventDefault();
			alert("You don't have permission to view this claim.");

		}
	});

</script>
@endpush
