<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;

class Category extends Model
{
    use softDeletes;
    protected $guarded = [];
    
    protected $dates = ['deleted_at'];

    // Many to Many
    public function products(){
    	return $this->belongsToMany('App\Product');
    }

    // add as parent category in category_parent
    public function parents(){
        return $this->belongsToMany(Category::class,'category_parent','category_id','parent_id');
    }

    public function children(){
    	return $this->belongsToMany(Category::class, 'category_parent', 'category_id', 'parent_id');
    }
}
