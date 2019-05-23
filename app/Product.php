<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $timestamps = true;

    protected $fillable = [
        'name', 'details', 'imagepath'
    ];

    public function attributes() { return $this->hasMany('App\Attribute'); }
    public function attributeCombinations() { return $this->hasMany('App\AttributeCombination'); }

}
