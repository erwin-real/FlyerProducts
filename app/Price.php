<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'attribute_combination_id', 'quantity', 'price'
    ];

    public function attributeCombination() { return $this->belongsTo('App\AttributeCombination'); }

}
