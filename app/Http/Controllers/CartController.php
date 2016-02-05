<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 04.02.16
 * Time: 19:27
 */

namespace App\Http\Controllers;

class CartController extends Controller {



    public function __construct() {

    }

    public function index(){
        return view('cart.index');
    }
}