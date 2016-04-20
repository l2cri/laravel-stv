<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Search;

class SearchController extends Controller
{
    protected $product;

    public function products(Request $request){
        $query = mb_strtolower($request->q,'UTF-8');
        $products = Search::products($query)->sortable()->paginable();

        return view('search.products',compact('products','query'));
    }

    public function suppliers(Request $request){
        $query =  mb_strtolower($request->q,'UTF-8');
        $suppliers = Search::suppliers($query)->sortable()->paginable();

        return view('search.suppliers',compact('suppliers','query'));
    }
}
