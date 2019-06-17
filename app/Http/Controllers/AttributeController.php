<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\AttributeValue;
use Illuminate\Http\Request;

class AttributeController extends Controller
{

    public function index(Request $request) {
        return view('pages.attributes.index')->with('attribute', Attribute::find($request->get('id')));
    }

    public function create(Request $request) {
        return view('pages.attributes.create')->with('attribute', Attribute::find($request->get('id')));
    }

    public function store(Request $request) {
        $attribute = Attribute::find($request->get('id'));
        $validatedData = $request->validate([
            'value' => 'required',
            'imagepath' => 'image|nullable|max:1999'
        ]);


        //Handle File Upload
        if ($request->hasFile('imagepath')) {
            $filenameWithExt = $request->file('imagepath')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('imagepath')->getClientOriginalExtension();
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            $path = $request->file('imagepath')->storeAs('public/imagepaths', $fileNameToStore);
        } else $fileNameToStore = 'noimage.jpg';


        $attributeValue = new AttributeValue(array(
            'attribute_id' => $attribute->id,
            'value' => $validatedData['value'],
            'details' => $request->get('details'),
            'imagepath' => $fileNameToStore
        ));

        $attributeValue->save();

        return redirect('/attributes/'. $attributeValue->id)
            ->with('success', 'Added New Attribute Value Successfully!')
            ->with('attribute', $attribute);
    }

    public function show($id) {
        return view('pages.attributes.show')->with('attributeValue', AttributeValue::find($id));
    }

    public function edit($id) {
        return view('pages.attributes.edit')->with('attributeValue', AttributeValue::find($id));
    }

    public function update(Request $request, $id) {
        $attributeValue = AttributeValue::find($request->get('id'));
        $validatedData = $request->validate([
            'value' => 'required',
            'imagepath' => 'image|nullable|max:1999'
        ]);

        $attributeValue->value = $validatedData['value'];
        $attributeValue->details = $request->get('details');

        //Handle File Upload
        if ($request->hasFile('imagepath')) {
            $filenameWithExt = $request->file('imagepath')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('imagepath')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('imagepath')->storeAs('public/imagepaths', $fileNameToStore);
            $attributeValue->imagepath = $fileNameToStore;
        }
        $attributeValue->save();

        return redirect('/attributes/'. $attributeValue->id)
            ->with('success', 'Updated Attribute Value Successfully!')
            ->with('attributeValue', $attributeValue);
    }

    public function destroy($id) {
        //
    }
}
