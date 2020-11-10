<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use softDeletes;
    protected $guarded = [];

    protected $dates = ['deleted_at'];
}
