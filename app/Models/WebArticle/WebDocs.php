<?php

namespace App\Models\WebArticle;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class WebDocs extends Model
{
	// public function __construct($node)
	// {
	// 	return $this->getFiles($node);
	// }

	public static function getFiles($node)
	{
		// dd('Get Files');
		if ('CON' == $node) {
            $node = 'COND';
        }

        $dir = '/mnt/WebDocs/' . $node;

        if (! file_exists($dir)) {
            if (! mkdir($dir)) {
                // Throw an error & contact IT. Directory was not created.
                dd('The directory was not created');
            }
        }

        $fileDir = scandir($dir);
        $fileList = array_diff($fileDir, array('.', '..'));

        return $fileList;
	}
}