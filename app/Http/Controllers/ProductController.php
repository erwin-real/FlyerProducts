<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('pages.products.index')->with('products', Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $product = new Product(array(
            'name' => $validatedData['name'],
            'details' => $request->get('details')
        ));

        $product->save();

        return redirect('/products/'. $product->id)
            ->with('success', 'Added New Product Successfully!')
            ->with('product', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product) {
        return view('pages.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product) {
        return view('pages.products.edit')
            ->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product) {
        $validatedData = $request->validate([ 'name' => 'required' ]);

        $product->name = $validatedData['name'];
        $product->details = $request->get('details');

        $product->save();

        foreach ($product->attributes as $attribute) $attribute->delete();

        for ($i = 0; $i < count($request->get('attribute')); $i++) {
            $attribute = new Attribute(array(
                'product_id' => $product->id,
                'name' => $request->get('attribute')[$i],
                'order' => $i+1
            ));

            $attribute->save();
        }
        $attribute = new Attribute(array(
            'product_id' => $product->id,
            'name' => 'Print, Run and Delivery',
            'order' => count($request->get('attribute'))+1
        ));

        $attribute->save();

        return redirect('/products/'. $product->id)
            ->with('success', 'Updated Product Successfully!')
            ->with('product', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product) {
        //
    }
}
