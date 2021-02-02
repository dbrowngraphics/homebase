<?php

namespace App\Models\StopLossClaims;

use DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StopLossClaims extends Model
{
    protected $table = 'cw.slrt_get_claims_list'; 

    private $fid = '';

    // Procedure: cw.slrp_get_claims_list(p_fid, p_dependent_code, p_pending)
    public static function getClaimsList($request)
    {

        $params = [
            'p_fid'            => $request->input('fid'),
            'p_dependent_code' => $request->input('dependent'),
            'p_pending'        => $request->input('pending')
        ];

        DB::statement(
            "BEGIN cw.slrp_get_claims_list(
            :p_fid,
            :p_dependent_code,
            :p_pending);
            END;",
            $params
        );

        return self::orderBy('claim')->get();

    }

    public static function changeStatus($request)
    {

        $user = Auth::user()->logon_id;

        $claims       = $request->input('claims');
        $pending      = $request->input('currentStatus');
        $changeStatus = $request->input('status');

        foreach ($claims as $claim)
        {
            DB::table('cw.slrt_claims_list')->insert(
                ['claim' => $claim, 'pending' => $pending]
            );
        }

        $params = [
            'p_action' => $changeStatus,
            'p_last_modified_by' => $user,
            'p_last_modified_from' => strtoupper($_SERVER['REMOTE_ADDR'])
        ];

        $statement  = DB::statement(
            "BEGIN cw.slrp_update_claims(
            :p_action,
            :p_last_modified_by,
            :p_last_modified_from);
            END;",
            $params
        );

        return $statement;
    }

}
