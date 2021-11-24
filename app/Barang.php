<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $guarded = [];
    protected $table = 'barangs';
    protected $dates = ['created_at'];
}
