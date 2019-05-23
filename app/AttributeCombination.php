<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeCombination extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id', 'attribute_value_ids'
    ];

    public function product() { return $this->belongsTo('App\Product'); }
    public function prices() { return $this->hasMany('App\Price'); }
}
