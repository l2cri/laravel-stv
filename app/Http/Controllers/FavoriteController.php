<?php

namespace App\Http\Controllers;

use App\Repo\Criteria\Product\MinMaxPrice;
use App\Repo\Criteria\Product\SuppliersOnly;
use App\Repo\Favorite\FavoriteInterface;
use App\Repo\Product\ProductInterface;
use App\Repo\Supplier\SupplierInterface;
use App\Services\Form\Favorite\FavoriteForm;
use Illuminate\Http\Request;
use App\StaticHelpers\ProductHelper;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    protected $favorite;
    protected $favoriteForm;
    protected $product;
    protected $supplier;

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

    public function favoriteList()
    {

        $products = $this->product->getUserFavorite();

        return view('panel.user.favorite', compact('products'));
    }

}
