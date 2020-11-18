<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function index() {
        $products = DB::table('lots')
        ->select('products.*', DB::raw('max(lots.updated_at) as lastest_at'), DB::raw('sum(current_qty) as total'))
        ->groupBy('product_id')->join('products', 'id', '=', 'product_id')
        ->orderByDesc('lastest_at')
        ->get();

        return view("pages.home", [
            "products" => $products
        ]);
    }
}
