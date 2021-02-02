<?php 

namespace App\Http\Controllers;

// use App\Models\Preclaim\ClaimSearch;
use App\Models\Preclaim\SingleClaim;

use App\Procedures\PreclaimListSP;
use DB;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class PreclaimController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
		return view('preclaim.index');
	}

	public function search(Request $request)
	{
		// dd($request);

        // $claimSearch = new ClaimSearch();
        // $claims = $claimSearch->getClaimSearch($request);

        $search = new PreclaimListSP($request);
        $claims = DB::table('cw.r_preclaims_for_process_web')->paginate(5);

        dd($claims);

		return view('preclaim.searchresults', compact('claims'));

	// This section is used if we are going to use AJAX to render the info on the same page/screen 

        $html = view('preclaim._inc.datatable', compact('claims'));
        $content = $html->render();

        return response()->json(['data' => $content]);

        // return Datatables::of($claims)->make(true);

        // return view('preclaim/index', compact('claims'));
	}


    public function singleClaim(Request $request, $batch_id, $item_id)
    {

        // 'p_batch_id' => '584218',
        // 'p_item_id' => '1',
        // 'p_adjuster' => ''


        $claim_info             = [];
        $claim_info['batch_id'] = $batch_id;
        $claim_info['item_id']  = $item_id;
        $claim_info['adjuster'] = '';

        // $singleClaim = new SingleClaim();
        // $claim = $singleClaim->singleClaimInfo($claim_info)->first();


        session()->put('claim_info', $claim_info);

        // $_SESSION['claim_info'] = $claim_info; 

        // var_dump($_SESSION);
        // die('session');

        // $this->singleview();

        return redirect()->route('singleview');



        // return redirect()->route('singleview')->with(['data' => $claim_info]);

        // return view('preclaim/single', compact('claim'));
    }

    public function singleview()
    {

    	// dd($_SESSION['claim_info']);

    	// dd(session('claim_info'));

        if (session()->has('claim_info')) { 

            $claim_info = session('claim_info');

            $singleClaim = new SingleClaim();
            // $claim = $singleClaim->singleClaimInfo($claim_info)->first();
            $claim = $singleClaim->singleClaimInfo($claim_info);

            return view('preclaim.single', compact('claim'));
        } else {

            return redirect('preclaim');
        }
    }
}