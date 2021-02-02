<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\StopLossClaims\StopLossClaims as SLC;

class StopLossClaimsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $permissions = Auth::user()->permissions;
        
        if(isset($permissions['stoplossclaims']) && ($permissions['stoplossclaims'] == 'Y')) {

            if (session()->has('input')) {

                $input = session()->pull('input');
                session()->forget('input');

                return view('stoplossclaims.form', compact('input'));
            }

        	return view('stoplossclaims.form');
        }

        return view('permissions');
    }

    public function formSubmit(Request $request)
    {
    	
    	$claims = SLC::getClaimsList($request);
      
        if(0 == count($claims)) {

            $input['fid']            = $request->input('fid');
            $input['dependent_code'] = $request->input('dependent');
            $input['pending']        = $request->input('pending');

            session()->put('input', $input);

            return redirect()->action('StopLossClaimsController@index')->with('error', 'There are no claims that meet your criteria!');

        }

    	$status = $request->input('pending');

    	return view('stoplossclaims.table', compact('claims', 'status'));

    }


    public function changeStatus(Request $request)
    {
        
    	$message = SLC::changeStatus($request);

    	if ($message) {

    		return redirect()->action('StopLossClaimsController@index')->with('success', 'The status has successfully been updated!');
    	}

    	return redirect()->action('StopLossClaimsController@index')->with('error', 'There was an error updating the claims.');
    }


}
