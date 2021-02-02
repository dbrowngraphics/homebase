<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class LogLogin extends Model
{

	public function __construct($user_id)
	{

		$params = ['p_user_id' => $user_id, 'p_last_ip' => strtoupper($_SERVER['REMOTE_ADDR'])];

        DB::statement("BEGIN cw.wtp_log_login(:p_user_id, :p_last_ip); END;", $params);
	}

}