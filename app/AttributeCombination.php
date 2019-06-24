<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeCombination extends Model
{
    protected $connection = 'mysql';

    public $timestamps = false;

    protected $fillable = [
        'product_entity_id', 'attribute_value_ids', 'parent'
    ];

    public function product() { return $this->belongsTo('App\Product'); }
    public function prices() { return $this->hasMany('App\Price'); }
}
