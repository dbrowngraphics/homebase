<?php

namespace App\Models\Preclaim;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class ClaimSearchBarOptions extends Model
{

	public static function GetBatchTypes()
	{

	    $batch_types = '';
	    $pdo = DB::connection()->getPDO();

	    $stmt = $pdo->prepare("BEGIN CW.WPC_GET_BATCH_TYPES(:p_batch_type); END;");

	    $stmt->bindParam(':p_batch_type', $batch_types, $pdo::PARAM_INPUT_OUTPUT, 1000);

	    $stmt->execute();

	    return ClaimSearchBarOptions::splitBatchType($batch_types);
	}

	public static function GetClaimStatuses()
	{
	    $batch_types = '';

	    $pdo = DB::connection()->getPDO();

	    $stmt = $pdo->prepare("BEGIN CW.WPC_GET_CLAIM_STATUSES(:p_claim_statuses); END;");

	    $stmt->bindParam(':p_claim_statuses', $batch_types, $pdo::PARAM_INPUT_OUTPUT, 1000);

	    $stmt->execute();

	    return ClaimSearchBarOptions::splitBatchType($batch_types);
	}

	public static function GetUserQueues()
	{
	    $batch_types = '';
	    $pdo = DB::connection()->getPDO();

	    $stmt = $pdo->prepare("BEGIN CW.WPC_GET_USER_QUEUES(:p_user_queues); END;");

	    $stmt->bindParam(':p_user_queues', $batch_types, $pdo::PARAM_INPUT_OUTPUT, 1000);

	    $stmt->execute();

	    return ClaimSearchBarOptions::splitBatchType($batch_types);
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

	private static function splitBatchType($batchTypes)
	{
	    $split = [];
	    $split = explode("|", $batchTypes);
	    $result = [];

	    foreach ($split as $bt) {

	      $bt_split = explode("=>", $bt);
	      // $list($k, $v) = $bt_split;
	      $result[$bt_split[0]] = $bt_split[1];

	    }

	    return $result;
	}

}