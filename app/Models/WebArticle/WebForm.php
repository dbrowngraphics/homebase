<?php

namespace App\Models\WebArticle;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class WebForm extends Model
{
    protected $table = 'CW.V3T_GET_ARTICLES';

    public static function isGroupCode($forms)
    {
        foreach ($forms as $form)
        {
            if(! is_null($form->group_cd)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'node';
    }

}