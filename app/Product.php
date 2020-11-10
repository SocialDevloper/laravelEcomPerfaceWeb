<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;

class Product extends Model
{
    use softDeletes;
    protected $guarded = [];

    protected $dates = ['deleted_at'];

    // Many to Many
    public function categories(){
    	return $this->belongsToMany('App\Category');
    }

    // edit mate slug use thay instead of id
    public function getRouteKeyName(){
   	 return 'slug';
	}
}
