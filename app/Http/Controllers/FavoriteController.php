<?php

namespace App\Http\Controllers;

use App\Repo\Favorite\FavoriteInterface;
use App\Repo\Product\ProductInterface;
use App\Services\Form\Favorite\FavoriteForm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    protected $favorite;
    protected $favoriteForm;
    protected $product;

    public function __construct(FavoriteInterface $favorite,FavoriteForm $favoriteForm, ProductInterface $product)
    {
        $this->favorite = $favorite;
        $this->favoriteForm = $favoriteForm;
        $this->product = $product;
    }

    public function favoriteProduct(Request $request)
    {
        $input = removeEmptyValues($request->all());
        $product_id = $input["id"];

        if ($this->favoriteForm->FavoriteProduct($input) ){

            $product = $this->product->byId($product_id);
            $favorite = $this->favorite->byProduct($product_id);

            return view('common.favorite',['item'=>$product,'routeName'=>'panel::favorite-product.add','check'=>isset($favorite)]);
        }
        else{
            $errors = $this->favoriteForm->errors();
            return response()->json(['errors' => $errors, 'status' => 'ERROR']);
        }
    }

}
