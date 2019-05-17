<?php

namespace App\Http\Controllers;

use App\AttributeCombination;
use App\Product;
use Illuminate\Http\Request;

class CombinationController extends Controller
{

    public function index() {
        //
    }

    public function create(Product $product) {
        return view('pages.combinations.create')->with('product', $product);
    }

    public function store(Product $product, Request $request) {
        $temp = $request->get('combinations')[0];
        for ($i = 1; $i < count($request->get('combinations')); $i++)
            $temp .= ','.$request->get('combinations')[$i];

        $attributeCombination = new AttributeCombination(array(
            'product_id' => $product->id,
            'attribute_value_ids' => $temp
        ));

        $attributeCombination->save();

        return redirect('/products/'. $product->id)
            ->with('success', 'Added New Combination Successfully!')
            ->with('product', $product);
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
