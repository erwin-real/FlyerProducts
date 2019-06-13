<?php

namespace App\Http\Controllers;

use App\AttributeCombination;
use App\AttributeValue;
use App\Price;
use App\Product;
use Illuminate\Http\Request;

class CombinationController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        return view('pages.combinations.index')->with('product', Product::find($request->get('id')));
    }

    public function create(Request $request) {
        $attributeValues = collect();

        foreach (explode(",",$request->input('ids')) as $item)
            $attributeValues->push(AttributeValue::find($item));

        return view('pages.combinations.create')
            ->with('attributeValues', $attributeValues)
            ->with('ids', $request->input('ids'))
            ->with('product', Product::find($request->get('id')));
    }

    public function store(Request $request) {
        $product = Product::find($request->get('id'));

        $attributeCombination = new AttributeCombination(array(
            'product_id' => $product->id,
            'attribute_value_ids' => $request->get('ids'),
            'parent' => 0
        ));

        $attributeCombination->save();

        for ($i = 0; $i < count($request->get('quantity')); $i++) {
            $price = new Price(array(
                'attribute_combination_id' => $attributeCombination->id,
                'quantity' => $request->get('quantity')[$i],
                'price' => $request->get('price')[$i]
            ));
            $price->save();
        }

        return redirect('/products/'. $product->id)
            ->with('success', 'Added New Combination Successfully!')
            ->with('product', $product);
    }

    public function show($id) {
        return view('pages.combinations.show')->with('attributeCombination', AttributeCombination::find($id));
    }

    public function edit($id, Request $request) {
        return view('pages.combinations.edit')
            ->with('ids', $request->input('ids'))
            ->with('attributeCombination', AttributeCombination::find($id));
    }

    public function update(Request $request, $id) {
        $attributeCombination = AttributeCombination::find($id);

        foreach ($attributeCombination->prices as $price) $price->delete();

        for ($i = 0; $i < count($request->get('quantity')); $i++) {
            $price = new Price(array(
                'attribute_combination_id' => $attributeCombination->id,
                'quantity' => $request->get('quantity')[$i],
                'price' => $request->get('price')[$i]
            ));
            $price->save();
        }

        return redirect('/products/'. $attributeCombination->product->id)
            ->with('success', 'Modified Combination Successfully!')
            ->with('product', $attributeCombination->product);
    }

    public function destroy($id) {
        //
    }

    public static function findById($id) {
        return AttributeValue::find($id);
    }

    public function testForm(Request $request) {
        return view('pages.combinations.testForm')->with('product', Product::find($request->input('id')));
    }

    public function evaluate(Request $request) {
        $attributeCombination = null;
        $attributeValues = collect();
        $combination = $request->input('combinations')[0];
        $attributeValues->push(AttributeValue::find($request->input('combinations')[0]));

        for ($i = 1; $i < count($request->input('combinations')); $i++) {
            $combination .= ',' . $request->input('combinations')[$i];
            $attributeValues->push(AttributeValue::find($request->input('combinations')[$i]));
        }

        foreach (AttributeCombination::all() as $item)
            if ($item->attribute_value_ids == $combination) $attributeCombination = $item->id;

        $data = array(
            'combination' => $combination,
            'attributeCombinationID' => $attributeCombination
        );

        return $data;

//        return view('pages.combinations.result')
//            ->with('product', Product::find($request->input('id')))
//            ->with('attributeCombination', $attributeCombination)
//            ->with('combination', $combination)
//            ->with('attributeValues', $attributeValues);
    }
}
