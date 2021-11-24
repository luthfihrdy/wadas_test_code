<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];
    protected $table = 'transaksis';
    protected $dates = ['created_at'];
}
