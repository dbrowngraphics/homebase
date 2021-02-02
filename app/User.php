<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use DB;
use App\UserPermissions;

class User extends Authenticatable
{
    use Notifiable;

    const UPDATED_AT = 'last_modified';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $maps = [
    //     'email' => 'email_address'
    // ];

    protected $append = ['permissions'];

    /*
     * User's table
     */
    protected $table = 'cw.lh2_users';


    // public function email(){
    //     return $this->belongsTo(User::class);
    // }

    public function getEmailAttribute ($value) {
        return $this->email_address;
    }

    public function setUpdatedAtAttribute ($value) {
        $this->attributes['last_modified'] = $value;
    }

    // public function getPermissionsAttribute () {
    //     return $this->attributes['permissions'];
    // }

    public function setPermissionsAttribute ($value) {
        $this->attributes['permissions'] = $value;
    }

    public function setPermissions () {

        // dd('User - setPermissions - id: ' . $this->id);

        $params = ['p_user_id' => $this->id];

        DB::statement("BEGIN cw.wtp_get_logon_data(:p_user_id); END;", $params);
        
        $permissions = UserPermissions::all();

        $this->permissions =  
            $permissions->mapWithKeys(function ($item) {
                return [strtolower($item['permission_code']) => $item['permission_value']];
            });
    }
}
