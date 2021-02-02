<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class UserPermissions extends Model
{
	// Procedure used to fill in the user permissions
	// wtp_get_logon_data (:p_user_id)
	
	protected $table = 'CW.R_WT_GET_LOGON_PERMS';
}