<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $connection = 'mysql2';

    protected $table = 'catalog_product_entity';

    protected $primaryKey = 'entity_id';

//    public $timestamps = true;

//    protected $fillable = [
//        'name', 'details', 'imagepath'
//    ];

    public function attributes() { return $this->hasMany('App\Attribute'); }
    public function attributeCombinations() { return $this->hasMany('App\AttributeCombination'); }

}
