<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $connection = 'mysql';

    public $timestamps = false;

    protected $fillable = [
        'attribute_id', 'value', 'details', 'imagepath'
    ];

    public function attribute() { return $this->belongsTo('App\Attribute'); }
}
