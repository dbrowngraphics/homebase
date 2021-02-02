<?php

namespace App\Models\Preclaim;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class ClaimSearch extends Model
{
	protected $table = 'cw.r_preclaims_for_process_web';
  protected $date = ['receive_date', 'bill_from', 'bill_to'];
  protected $request;

  /* Hydrates:
      batch_id
      item_id
      adjuster
      create_day
      create_date
      receive_date
      status
      status_desc
      type
      type_desc
      claim_type
      claim_type_desc
      claim_status
      claim_status_desc
      node
      group_id
      group_name
      member_id
      fid
      member_name
      dependent_code
      patient_name
      physician_id
      physician_name
      physician_payee_name
      bill_from
      bill_to
      pretreatment
      dcn
      override_network
      override_network_desc
      reprice_network
      reprice_network_desc
      reprice_agent_id
      total_charge
      user_queue_id
      user_queue_desc
      user_queue_adjuster
      plan
      plan_description
      row_color
  */

  private $claim_type = '';
  private $batch_type = '';
  private $claim_status = '';
  private $user_queue = '';
  private $batch_id = '';
  private $claim = '';
  private $dcn = '';
  private $node = '';

	public function getClaimSearch($request){

    $this->setParams($request);

        
    $params = [

      // actual params:
      'p_claim_type' => $this->claim_type, // 'U', 'D', 'V'
      'p_batch_type' => $this->batch_type,
      'p_claim_status' => $this->claim_status,
      'p_user_queue_id' => $this->user_queue,
      'p_batch_id' => $this->batch_id,
      'p_claim' => $this->claim,
      'p_dcn' => $this->dcn,
      'p_node' => $this->node,
    ];

    // Parameters:
        // P_claim_type – Expects values of ‘H’ or ‘U’ (either one, treats them identically) for Medical Claims, ‘D’ for Dental, and ‘V’ for Vision.
        // P_batch_type – Might need to build you a procedure to build this list. It’s a predefined list of single character values.
        // P_claim_status – Another one that might need a procedure. Again, it’s a predefined list of values.
        // P_user_queue_id - … You need more procedures than I thought.
        // P_batch_id – This one takes in a number (currently 6 digits, will push into the 7’s before too long) as input from the user. It corresponds to the batch_id of the claim.
        // P_claim – Irrelevant. Doesn’t do anything nowadays.
        // P_dcn – takes in DCN number as input from the user. It’s in the format of 1 alpha character + 11 numbers, and corresponds to the DCN field on the claim.
        // P_node – just takes in node as user input – no pre-defined list.

    // It only expects for 1 parameter to be filled out at a time. All of these could return anywhere from 0 records to thousands of records.


    // cw.cwi_preclaims_for_process_web(p_claim_type varchar2, p_batch_type varchar2, p_claim_status varchar2, p_user_queue_id number, p_batch_id number, p_claim varchar2, p_dcn varchar2, p_node varchar2)

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

    // cw.v3t_claim_h
    // cw.r_preclaims_for_process_web

    // $claims = DB::select('batch_id, item_id, node from cw.r_preclaims_for_process_web');

    // $claims = DB::table('batch_id, item_id, node, from cw.r_preclaims_for_process_web')->get();

    // return $claims;

    return self::all();
	}


  /**
     * Get the date_format formatted.
     *
     * @param  string  $date
     * @return string - formatted date
  */
  public function getReceiveDateAttribute($date)
  {
    $carbonDate = Carbon::parse($date);
    return $carbonDate->format('m-d-Y');
  }

  /**
     * Get the bill_from formatted.
     *
     * @param  string  $date
     * @return string - formatted date
  */
  public function getBillFromAttribute($date)
  {
    $carbonDate = Carbon::parse($date);
    return $carbonDate->format('m-d-Y');
  }

    /**
     * Get the bill_to formatted.
     *
     * @param  string  $date
     * @return string - formatted date
  */
  public function getBillToAttribute($date)
  {
    $carbonDate = Carbon::parse($date);
    return $carbonDate->format('m-d-Y');
  }

  // private $claim_type;
  // private $batch_type;
  // private $claim_status;
  // private $user_queue;
  // private $batch_id;
  // private $claim;
  // private $dcn;
  // private $node;
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
}