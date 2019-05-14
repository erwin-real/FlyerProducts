<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'attribute_id', 'value', 'details', 'imagepath'
    ];

    public function forecast() { return $this->belongsTo('App\Attribute'); }
}
