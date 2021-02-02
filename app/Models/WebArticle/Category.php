<?php

namespace App\Models\WebArticle;

use DB;

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    protected $table = 'cw.v3t_article_category'; 


    public static function findCategoryValue($categoryTitle)
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            if ($category->category == $categoryTitle) {
                return $category->id;
            }
        }

        return null;
    }
}