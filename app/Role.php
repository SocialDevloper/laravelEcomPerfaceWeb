<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

class Role extends Model
{
    use softDeletes;
    protected $guarded = [];

    protected $dates = ['deleted_at'];

    // many inverse
    public function users(){
    	return $this->hasMany('App\User');
    }
}
