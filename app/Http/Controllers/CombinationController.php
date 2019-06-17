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

        return redirect('/combinations/'. $attributeCombination->id)
            ->with('success', 'Added New Combination Successfully!')
            ->with('attributeCombination', $attributeCombination);
    }

    public function show($id) {
        $attributeCombination = AttributeCombination::find($id);
        $childs = collect();

        foreach (AttributeCombination::all() as $item)
            if ($item->parent == $id) $childs->push($item);

        return view('pages.combinations.show')
            ->with('attributeCombination', $attributeCombination)
            ->with('childs', $childs);
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

        return redirect('/combinations/'. $attributeCombination->id)
            ->with('success', 'Modified Combination Successfully!')
            ->with('product', $attributeCombination->product);
    }

    public function destroy($id) {
        //
    }

    public static function findAttributeValueById($id) { return AttributeValue::find($id); }
    public static function findAttributeCombinationById($id) { return AttributeCombination::find($id); }

//    public function testForm(Request $request) {
//        return view('pages.combinations.testForm')->with('product', Product::find($request->input('id')));
//    }

    public function evaluate(Request $request) {
        $attributeCombination = null;
        $combination = $request->input('combinations')[0];

        for ($i = 1; $i < count($request->input('combinations')); $i++)
            $combination .= ',' . $request->input('combinations')[$i];

        foreach (AttributeCombination::all() as $item)
            if ($item->attribute_value_ids == $combination) $attributeCombination = $item->id;

        $data = array(
            'combination' => $combination,
            'attributeCombinationID' => $attributeCombination
        );

        return $data;
    }

    public function copy(Request $request) {
        $attributeCombination = null;
        $isValid = true;

        $combination = $request->input('combinations')[0];
        for ($i = 1; $i < count($request->input('combinations')); $i++)
            $combination .= ',' . $request->input('combinations')[$i];

        foreach (AttributeCombination::all() as $item)
            if ($combination == $item->attribute_value_ids) {
                if ($item->parent == 0) $isValid = false;
                else $attributeCombination = $item;

                break;
            }

        if ($isValid) {
            if ($attributeCombination == null) {
                $attributeCombination = new AttributeCombination(array(
                    'product_id' => $request->input('productID'),
                    'attribute_value_ids' => $combination,
                    'parent' => $request->get('attributeCombinationID')
                ));
            } else
                $attributeCombination->parent = $request->get('attributeCombinationID');

            $attributeCombination->save();

            $attributeValues = collect();
            foreach (explode(',', $attributeCombination->attribute_value_ids) as $item)
                $attributeValues->push(AttributeValue::find($item));

            return array(
                "success" => true,
                "id" => $attributeCombination->id,
                "message" => "Copied Prices Successfully",
                "attributeValues" => $attributeValues
            );
        } else {
            return array(
                "success" => false,
                "message" => "Copied Prices Unsuccessfully. The desired combination is already a parent."
            );
        }
    }

    public function split(Request $request) {
        $combination = AttributeCombination::find($request->input('combinationID'));
        $parentCombination = AttributeCombination::find($request->input('parentCombinationID'));

        $combination->parent = 0;
        $combination->save();

        foreach ($parentCombination->prices as $price) {
            $newPrice = new Price(array(
                'attribute_combination_id' => $combination->id,
                'quantity' => $price->quantity,
                'price' => $price->price
            ));
            $newPrice->save();
        }

        return $request;
    }

    public function splitSingle(Request $request) {
        $combination = AttributeCombination::find($request->input('combinationID'));
        $parent = AttributeCombination::find($request->input('parentID'));

        $combination->parent = 0;
        $combination->save();

        foreach ($parent->prices as $price) {
            $newPrice = new Price(array(
                'attribute_combination_id' => $combination->id,
                'quantity' => $price->quantity,
                'price' => $price->price
            ));
            $newPrice->save();
        }

        $childs = collect();

        foreach (AttributeCombination::all() as $item) if ($item->parent == $combination->id) $childs->push($item);

        return redirect('/combinations/'. $combination->id)
            ->with('attributeCombination', $combination)
            ->with('success', "Split Combination Successfully!")
            ->with('childs', $childs);

    }
}
