<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 14.01.16
 * Time: 16:26
 */

namespace App\Http\Controllers;


class CatalogController extends Controller
{
    public function byCode($code){
        return view('catalog.index');
    }
}