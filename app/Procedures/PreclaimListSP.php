<?php

namespace App\Procedures;

use DB;
use Illuminate\Http\Request;

class PreclaimListSP
{

	private $claim_type = '';
	private $batch_type = '';
	private $claim_status = '';
	private $user_queue = '';
	private $batch_id = '';
	private $claim = '';
	private $dcn = '';
	private $node = '';

	public function __construct(Request $request)
	{
		$this->setParams($request);
		$this->executeSP();
	}

	private function setParams($request)
	{
	    $claim_type = $request->input('claim_search_select');

	    if (1 == strlen($claim_type)) {

	      $this->claim_type = $claim_type;
	    } else {

			switch ($claim_type) {
				case 'node':
				    $this->node = $request->input('text_select');
				    break;
				case 'batchid':
				    $this->batch_id = $request->input('text_select');
				    break;
				case 'claimnum':
				    $this->claim = $request->input('text_select');
				    break;
				case 'dcn':
				    $this->dcn = $request->input('text_select');
				    break;
				case 'batchtype':
				    $this->batch_type = $request->input('batch_select');
				    break;
				case 'claimstatus':
				    $this->claim_status = $request->input('claim_select');
				    break;
				case 'assigned':
				    $this->user_queue = $request->input('user_select');
				    break;
				default:
				    break;
			}
	    }
	}

	private function executeSP()
	{
		$params = [
	    	'p_claim_type'    => $this->claim_type, // 'U', 'D', 'V'
	    	'p_batch_type'    => $this->batch_type,
	    	'p_claim_status'  => $this->claim_status,
	    	'p_user_queue_id' => $this->user_queue,
	    	'p_batch_id'      => $this->batch_id,
	    	'p_claim'         => $this->claim,
	    	'p_dcn'           => $this->dcn,
	    	'p_node'          => $this->node
    	];

    	DB::statement(
	        "BEGIN CW.CWI_PRECLAIMS_FOR_PROCESS_WEB(
	        :p_claim_type,
	        :p_batch_type,
	        :p_claim_status,
	        :p_user_queue_id,
	        :p_batch_id,
	        :p_claim,
	        :p_dcn,
	        :p_node);
	        END;",
	        $params
    	);
	}
	
}