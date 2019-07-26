<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\AttributeValue;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.products.index')->with('products', Product::all());
    }

    public function create() {
        return view('pages.products.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $product = new Product(array(
            'name' => $validatedData['name']
//            'details' => $request->get('details')
        ));

        $product->save();

        $attribute = new Attribute(array(
            'product_entity_id' => $product->entity_id,
            'name' => 'Print, Run and Delivery',
            'order' => 1
        ));

        $attribute->save();

        return redirect('/products/'. $product->entity_id)
            ->with('success', 'Added New Product Successfully!')
            ->with('product', $product);
    }

    public function show(Product $product) {
        return view('pages.products.show')->with('product', $product);
    }

    public function edit(Product $product) {
        return view('pages.products.edit')
            ->with('product', $product);
    }

    public function update(Request $request, Product $product) {
        $verifiedRequestAttributes = collect();
        $isSame = true;

        foreach ($request->get('attribute') as $attribute)
            if ($attribute != null) $verifiedRequestAttributes->push($attribute);

        if (count($verifiedRequestAttributes) == count($product->attributes)) {
            for ($i = 0; $i < count($verifiedRequestAttributes); $i++) {
                if (strtolower(preg_replace('/\s+/', '', $product->attributes[$i]->name)) != strtolower(preg_replace('/\s+/', '', $verifiedRequestAttributes[$i]))) {
                    $isSame = false;
                    break;
                }
            }
        }

        if ($isSame && count($verifiedRequestAttributes) == count($product->attributes)) {
            for ($i = 0; $i < count($verifiedRequestAttributes); $i++) {
                $product->attributes[$i]->name = $verifiedRequestAttributes[$i];
                $product->attributes[$i]->save();
            }

            return redirect('/products/'. $product->entity_id)
                ->with('success', 'Updated Product Successfully!')
                ->with('product', $product);
        }

        // DELETE ALL ATTRIBUTE VALUES AND COMBINATIONS
        $this->deleteAllAttributeValuesAndCombinations($product);

        if (count($verifiedRequestAttributes) == count($product->attributes)) {
            for ($i = 0; $i < count($verifiedRequestAttributes); $i++) {
                $product->attributes[$i]->name = $verifiedRequestAttributes[$i];
                $product->attributes[$i]->save();
            }
        } else if (count($verifiedRequestAttributes) > count($product->attributes)) {
            for ($i = 0; $i < count($product->attributes); $i++) {
                $product->attributes[$i]->name = $verifiedRequestAttributes[$i];
                $product->attributes[$i]->order = $i+1;
                $product->attributes[$i]->save();
            }

            for ($i = count($product->attributes); $i < count($verifiedRequestAttributes); $i++) {
                $attribute = new Attribute(array(
                    'name' => $verifiedRequestAttributes[$i],
                    'order' => $i+1
                ));
                $attribute->product_entity_id = $product->entity_id;
                $attribute->save();
            }
        } else {
            for ($i = 0; $i < count($verifiedRequestAttributes); $i++) {
                $product->attributes[$i]->name = $verifiedRequestAttributes[$i];
                $product->attributes[$i]->order = $i+1;
                $product->attributes[$i]->save();
            }

            for ($i = count($verifiedRequestAttributes); $i < count($product->attributes); $i++)
                $product->attributes[$i]->delete();
        }

        $validatedData = $request->validate([ 'name' => 'required' ]);
        $product->sku = $validatedData['name'];
        $product->save();

        return redirect('/products/'. $product->entity_id)
            ->with('success', 'Updated Product Successfully!')
            ->with('product', $product);
    }

    public function destroy(Product $product) {
        //
    }

    private function deleteAllAttributeValuesAndCombinations(Product $product) {
        foreach ($product->attributes as $attribute) {
            foreach ($attribute->attributeValues as $attributeValue)
                $attributeValue->delete();

            $attribute->delete();
        }

        foreach ($product->attributeCombinations as $attributeCombination) {
            foreach ($attributeCombination->prices as $price)
                $price->delete();

            $attributeCombination->delete();
        }
    }
}
