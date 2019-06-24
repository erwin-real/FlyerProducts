<?php

namespace App\Http\Controllers;

use App\Attribute;
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
        $validatedData = $request->validate([ 'name' => 'required' ]);

        $product->sku = $validatedData['name'];
//        $product->details = $request->get('details');

        $product->save();

        foreach ($product->attributes as $attribute) $attribute->delete();

        for ($i = 0; $i < count($request->get('attribute')); $i++) {
            $attribute = new Attribute(array(
                'product_entity_id' => $product->entity_id,
                'name' => $request->get('attribute')[$i],
                'order' => $i+1
            ));

            $attribute->product_entity_id = $product->entity_id;
            $attribute->save();
        }
        $attribute = new Attribute(array(
            'product_entity_id' => $product->entity_id,
            'name' => 'Print, Run and Delivery',
            'order' => count($request->get('attribute'))+1
        ));

        $attribute->product_entity_id = $product->entity_id;
        $attribute->save();

        return redirect('/products/'. $product->entity_id)
            ->with('success', 'Updated Product Successfully!')
            ->with('product', $product);
    }

    public function destroy(Product $product) {
        //
    }
}
