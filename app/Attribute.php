<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $connection = 'mysql';

    public $timestamps = false;

    protected $fillable = [
        'product_id', 'name', 'order'
    ];

    public function product() { return $this->belongsTo('App\Product'); }
    public function attributeValues() { return $this->hasMany('App\AttributeValue'); }
}
