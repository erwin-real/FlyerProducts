<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.dashboard')->with('products', Product::all());
    }

}
