<?php

namespace App\Http\Controllers;

use DB;
use App\Node;
use App\Models\WebArticle\Article;
use App\Models\WebArticle\Category;
use App\Models\WebArticle\WebForm;
use App\Models\WebArticle\WebDocs;

use Illuminate\Http\Request;
use Carbon\Carbon;
// use Illuminate\Routing\Redirector;

class WebDocsController extends Controller
{
	public function __construct()
    {
        // $this->middleware('auth');
    }

	public function index()
	{
		$url = 'http://ddb.cwibenefits.com/testsite/api/nodes';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        // Returns TRUE on success or FALSE on failure. However, if the CURLOPT_RETURNTRANSFER option is set, it will return the result on success, FALSE on failure.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        // curl_setopt($ch, CURLOPT_CAINFO, '/etc/ssl/certs/cacert.pem');

        $output = curl_exec($ch);

        $node_list = json_decode($output);
        // dd($responseContent);

		// $node_list = Node::pluck('node', 'node')->unique()->sort();

		return view('webdocs.index', compact('node_list'));
	}

	public function show($nodeId)
	{

		$node = Node::where('node', $nodeId)->first();
		// $forms = WebForm::findByNode($nodeId)->sortBy('article_title', SORT_NATURAL|SORT_FLAG_CASE);


		$json = ['node' => $nodeId];
		$url = 'http://ddb.cwibenefits.com/testsite/api/forms';

		try {
			$ch = curl_init();

	        curl_setopt($ch, CURLOPT_URL, $url);
	        // Returns TRUE on success or FALSE on failure. However, if the CURLOPT_RETURNTRANSFER option is set, it will return the result on success, FALSE on failure.
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	     //    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	     //    	'Content-Type: application/json',
	     //    	'Content-Length: ' . strlen($fields_string))
	   		// );

	        $output = curl_exec($ch);

	        $output = json_decode($output);
	        // var_dump($output);
	        // dd('Output');

		} catch (Exception $e) {
			echo '<h2>Curl Errors</h2>';
			echo sprintf('Curl Failed with Error #%d: %s', $e->getCode(), $e->getMessage());
		}

		// dd($output);
		$forms = $output;

        $isGroupCode = WebForm::isGroupCode($forms);

        $files = WebDocs::getFiles($nodeId);
        // dd($files);

        $articleCollection = collect([]);

        foreach ($forms as $form) {

            $begin_date = $form->begin_date ? (new Carbon($form->begin_date))->format('m/d/Y') : null;
            $end_date = $form->end_date ? (new Carbon($form->end_date))->format('m/d/Y') : null;

            $newArray = [
                'id'         => $form->id,
                'name'       => $form->article_title,
                'db'         => true,
                'file'       => $this->isInFilelist($form->article_link, $files), // create method to check if filename is in the FileList & remove from FileList
                'active'     => 'Y' == $form->active_yn,
                'filename'   => $form->article_link,
                'section'    => $form->article_section,
                'title'      => $form->article_title,
                'text'       => $form->article_text,
                'content'    => $form->article_content,
                'groupcd'    => $form->group_cd,
                'modified'   => new Carbon(substr($form->last_modified, 0, 10)),
                'category'   => $form->article_category,
                'categoryId' => Category::findCategoryValue($form->article_category),
                'begin_date' => $begin_date,
                'end_date'   => $end_date,
            ];

            $articleCollection->push(new Article($newArray));
        }

        foreach ($files as $file) {
            $newArray = [
                'id'         => null,
                'name'       => null,
                'db'         => false,
                'file'       => true,
                'active'     => false,
                'filename'   => $file,
                'section'    => 'FORMS',
                'title'      => null,
                'text'       => null,
                'content'    => null,
                'groupcd'    => null,
                'modified'   => Carbon::now(),
                'category'   => null,
                'categoryId' => null,
                'begin_date' => null,
                'end_date'   => null,
            ];

            $articleCollection->push(new Article($newArray));
        }

        $categories = Category::orderBy('id')->get();

        return view('webdocs.show', compact('node', 'forms', 'files', 'articleCollection', 'isGroupCode', 'categories'));
	}

	public function store(Request $request)
	{
		$json = [
			'node'       => $request->modal_node,
			'title'      => $request->modal_title,
			'link'       => $request->modal_link,
			'group_code' => $request->modal_group_code,
			'category'   => $request->modal_category,
			'begin_date' => $request->modal_begin_date,
			'end_date'   => $request->modal_end_date,
			'active'     => $request->modal_active
		];

		// dd($json);

		$encode = json_encode($json);
		// $decode = json_decode($encode);
		// dd($encode);

		$fields_string = http_build_query($json);

		// dd($fields_string);

		$url = 'http://ddb.cwibenefits.com/testsite/api/save';

		try{
			$ch = curl_init();

	        curl_setopt($ch, CURLOPT_URL, $url);
	        // Returns TRUE on success or FALSE on failure. However, if the CURLOPT_RETURNTRANSFER option is set, it will return the result on success, FALSE on failure.
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	     //    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	     //    	'Content-Type: application/json',
	     //    	'Content-Length: ' . strlen($fields_string))
	   		// );

	        $output = curl_exec($ch);

	        $output = json_decode($output);
	        var_dump($output);
	        dd('Output');

		} catch (Exception $e) {
			echo '<h2>Curl Errors</h2>';
			echo sprintf('Curl Failed with Error #%d: %s', $e->getCode(), $e->getMessage());
		}
		

        $return = json_decode($output);

	}



	public function update(Request $request, $node, $id)
	{

		$json = [
			'id'         => $id,
			'node'       => $request->modal_node,
			'title'      => $request->modal_title,
			'link'       => $request->modal_link,
			'group_code' => $request->modal_group_code,
			'category'   => $request->modal_category,
			'begin_date' => $request->modal_begin_date,
			'end_date'   => $request->modal_end_date,
			'active'     => $request->modal_active
		];

		$url = 'http://ddb.cwibenefits.com/testsite/api/update';

		try{
			$ch = curl_init();

	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

	        $output = curl_exec($ch);

	        $output = json_decode($output);

		} catch (Exception $e) {
			echo '<h2>Curl Errors</h2>';
			echo sprintf('Curl Failed with Error #%d: %s', $e->getCode(), $e->getMessage());
		}

		// var_dump($output);
		// dd('Update');
		return redirect()->action('WebDocsController@show', $node);
	}


	public function nodeFilter(Request $request)
	{
		$nodeId = strtoupper($request->node_id);
		// dd($nodeId);
        return redirect()->action('WebDocsController@show', $nodeId);
	}

	public function form($node, $id)
	{

	}

	private function isInFilelist($filename, &$filelist)
    {
        if (in_array($filename, $filelist)) {
            $filelist = array_diff($filelist, array($filename));
            // unset($filelist[array_search($filename, $filelist)]);
            return true;
        } else {
            return false;
        }
    }
}