<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\AttributeValue;
use Illuminate\Http\Request;

class AttributeController extends Controller
{

    public function index(Attribute $attribute) {
        return view('pages.attributes.index')->with('attribute', $attribute);
    }

    public function create(Attribute $attribute) {
        return view('pages.attributes.create')->with('attribute', $attribute);
    }

    public function store(Attribute $attribute, Request $request) {
        $validatedData = $request->validate([
            'value' => 'required'
        ]);

        $attributeValue = new AttributeValue(array(
            'attribute_id' => $attribute->id,
            'value' => $validatedData['value'],
            'details' => $request->get('details')
        ));

        $attributeValue->save();

        return redirect('/attributes/'. $attribute->id)
            ->with('success', 'Added New Attribute Value Successfully!')
            ->with('attribute', $attribute);
    }

    public function show($id) {
        return view('pages.attributes.show')->with('attribute', Attribute::find($id));
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
