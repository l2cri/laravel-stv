<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 14.01.16
 * Time: 16:26
 */

namespace App\Http\Controllers;


use App\Repo\Comment\CommentInterface;
use App\Repo\Criteria\Product\MinMaxPrice;
use App\Repo\Criteria\Product\SuppliersOnly;
use App\Repo\Product\ProductInterface;
use App\Repo\Section\SectionInterface;
use App\Repo\Supplier\SupplierInterface;
use App\StaticHelpers\ProductHelper;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    protected $product;
    protected $section;
    protected $supplier;

    public function __construct(ProductInterface $product, SectionInterface $section,
                                    SupplierInterface $supplier, CommentInterface $comments){
        $this->product = $product;
        $this->section = $section;
        $this->supplier = $supplier;
        $this->comments = $comments;
    }

    public function byCode($code, Request $request){

        $currentSection = $this->section->byCode($code);

        //TODO: валидация входящих параметров
        //TODO: убрать из формирования списка поставщиков зависимость от других поставщиков, чтобы
        // в фильре всегда были все поставщики удовлетворяющие цене и категории и в будующем другим критериям

        if ($request->has('minprice') && $request->has('maxprice')) {
            $this->product->pushCriteria( new MinMaxPrice($request->input('minprice'), $request->input('maxprice')));
        }

        $productsForSupplier = $this->product->bySection($currentSection->id);
        $suppliers = $this->supplier->byProducts($this->product->allProductsFromLastRequest());
        $maxProductPrice = ProductHelper::maxProductPrice($this->product->allProductsFromLastRequest());

        if ($request->has('suppliers')) {
            $this->product->pushCriteria( new SuppliersOnly($request->input('suppliers')) );
        }

        $products = $this->product->bySection($currentSection->id);



        //TODO: переместить в композер инициализацию мб?
        $sections = $this->section->getTree($currentSection->id);

        return view('catalog.index', compact('products', 'sections', 'currentSection',
                                                'maxProductPrice', 'suppliers'));
    }

    public function ajax(Request $request){

        if ($request->has('minprice') && $request->has('maxprice')) {
            $this->product->pushCriteria( new MinMaxPrice($request->input('minprice'), $request->input('maxprice')));
        }

        if ($request->has('suppliers')) {
            $this->product->pushCriteria( new SuppliersOnly($request->input('suppliers')) );
        }
        $products = $this->product->bySection($request->input('sectionId'));
        $currentSection = $this->section->byCode($request->input('sectionId'));
        return view('catalog.ajaxindex', compact('products', 'currentSection'));
    }

    public function product($id){
        $product = $this->product->byId($id);
        $comments = $this->comments->getByObject($product);
        $faq = $product->faq()->byProductItems($product->id);
        return view('catalog.product', compact(['product','comments','faq']));
    }
}