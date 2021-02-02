<?php

namespace App\Models\Preclaim;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

// use App\Notes;
use Carbon\Carbon;

class SingleClaim extends Model
{
	protected $table = 'cw.r_wpc_get_claim_h';
	// protected $table = 'cw.r_wpc_get_claim_d';
	protected $guarded = ['batch_id'];
	protected $primaryKey = 'batch_id';

	public function singleClaimInfo ($claim_info)
	{

		$params = [
			'p_batch_id' => $claim_info['batch_id'],
			'p_item_id' => $claim_info['item_id'],
			'p_adjuster' => $claim_info['adjuster']
		];

		DB::statement(
	        "BEGIN CW.WPC_GET_CLAIM(
	        :p_batch_id,
	        :p_item_id,
	        :p_adjuster);
	        END;",
	        $params
    	);

		$singleArray = self::all();

		$single = json_decode(json_encode($singleArray[0]->attributes));
		// dd($single);
		

		$claimsdetail = DB::table('cw.r_wpc_get_claim_d')->get();
		// $details = $this->makeArray($claimsdetail);

		$details = json_decode(json_encode($claimsdetail));

		$single->details = $details;

		// $notes = new Notes();

		$notesdetail = DB::table('cw.r_wpc_get_notes')->get();
		$notes = json_decode(json_encode($notesdetail));

		$single->notes = $notes;

		$errorsdetail = DB::table('claimsp.r2_process_errors')->get();
		$errors = json_decode(json_encode($errorsdetail));

		$single->errors = $errors;

    	return $single;
	}

	// public function detail()
	// {
	// 	return $this->hasMany('App\ClaimDetail', 'batch_id', 'batch_id');
	// }

	// private function makeArray($items)
	// {
	// 	$index = 0;
	// 	$array = [];

	// 	foreach ($items as $item) {

	// 		foreach ($item as $key => $value) {

	// 			$array[$index][$key] = $value;
	// 		}

	// 		$index++;
	// 	}

	// 	return json_decode(json_encode($array, false));
	// }
}