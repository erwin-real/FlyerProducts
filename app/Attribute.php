<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id', 'name', 'order'
    ];

    public function product() { return $this->belongsTo('App\Product'); }
}