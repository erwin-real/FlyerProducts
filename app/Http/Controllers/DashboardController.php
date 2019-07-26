<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.dashboard')->with('products', Product::all());
//        return view('pages.products.index')->with('products', Product::all());
    }

//    public function welcome() {
//        dd(User::all());
//    }
}
