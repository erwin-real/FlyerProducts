<?php

namespace App\Http\Controllers;

use App\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Attribute $attribute) {
        dd($attribute);
    }
}
