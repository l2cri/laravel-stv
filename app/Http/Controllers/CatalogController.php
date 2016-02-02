<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 14.01.16
 * Time: 16:26
 */

namespace App\Http\Controllers;


use App\Repo\Criteria\Product\MinMaxPrice;
use App\Repo\Product\ProductInterface;
use App\Repo\Section\SectionInterface;
use App\StaticHelpers\ProductHelper;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    protected $product;
    protected $section;

    public function __construct(ProductInterface $product, SectionInterface $section){
        $this->product = $product;
        $this->section = $section;
    }

    public function byCode($code, Request $request){

        if ($request->has('minprice') && $request->has('maxprice')) {
            $this->product->pushCriteria( new MinMaxPrice($request->input('minprice'), $request->input('maxprice')));
        }

        $currentSection = $this->section->byCode($code);
        $products = $this->product->bySection($currentSection->id);
        $maxProductPrice = ProductHelper::maxProductPrice($this->product->allProductsFromLastRequest());

        //TODO: переместить в композер инициализацию?
        $sections = $this->section->getTree($currentSection->id);

        return view('catalog.index', compact('products', 'sections', 'currentSection', 'maxProductPrice'));
    }

    public function ajax(Request $request){

        $products = $this->product->pushCriteria( new MinMaxPrice($request->input('minprice'), $request->input('maxprice')))
                                        ->bySection($request->input('sectionId'));

        $currentSection = $this->section->byCode($request->input('sectionId'));
        return view('catalog.ajaxindex', compact('products', 'currentSection'));
    }

    public function product($id){
        $product = $this->product->byId($id);
        return view('catalog.product', compact('product'));
    }
}