<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $guarded = [];
    protected $table = 'perusahaans';
    protected $dates = ['created_at'];
}
