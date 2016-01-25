<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 14.01.16
 * Time: 16:26
 */

namespace App\Http\Controllers;


use App\Repo\Product\ProductInterface;
use App\Repo\Section\SectionInterface;

class CatalogController extends Controller
{
    protected $product;
    protected $section;

    public function __construct(ProductInterface $product, SectionInterface $section){
        $this->product = $product;
        $this->section = $section;
    }

    public function byCode($code){

        $currentSection = $this->section->byCode($code);
        $products = $this->product->bySection($currentSection->id);

        //TODO: переместить в композер инициализацию
        $sections = $this->section->getTree();

        return view('catalog.index', compact('products', 'sections', 'currentSection'));
    }

    public function product($id){
        $product = $this->product->byId($id);
        return view('catalog.product', compact('product'));
    }
}