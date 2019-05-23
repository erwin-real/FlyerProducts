<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.dashboard');
//        return view('pages.products.index')->with('products', Product::all());
    }
}
