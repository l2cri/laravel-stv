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
use App\Repo\Faq\FaqInterface;
use App\Repo\Favorite\FavoriteInterface;
use App\Repo\Product\ProductInterface;
use App\Repo\Section\SectionInterface;
use App\Repo\Supplier\SupplierInterface;
use App\Services\Form\Rating\RatingForm;
use App\StaticHelpers\ProductHelper;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    protected $product;
    protected $section;
    protected $supplier;
    protected $comments;
    protected $faq;
    protected $favorite;

    public function __construct(ProductInterface $product, SectionInterface $section,
                                    SupplierInterface $supplier, CommentInterface $comments, FaqInterface $faq,
                                    FavoriteInterface $favorite){
        $this->product = $product;
        $this->section = $section;
        $this->supplier = $supplier;
        $this->comments = $comments;
        $this->faq = $faq;
        $this->favorite = $favorite;
    }

    public function byCode($code, Request $request){

        $currentSection = $this->section->byCode($code);

        //TODO: валидация входящих параметров
        //TODO: убрать из формирования списка поставщиков зависимость от других поставщиков, чтобы
        // в фильре всегда были все поставщики удовлетворяющие цене и категории и в будующем другим критериям

        if ($request->has('minprice') && $request->has('maxprice')) {
            $this->product->pushCriteria( new MinMaxPrice($request->input('minprice'), $request->input('maxprice')));
        }

        // эту строку не убирать, вытаскиваем товары по категории, чтобы по ним вытащить список поставщиков
        $productsForSupplier = $this->product->bySection($currentSection->id);
        $suppliers = $this->supplier->byProducts($this->product->allProductsFromLastRequest());
        $maxProductPrice = ProductHelper::maxProductPrice($this->product->allProductsFromLastRequest());

        if ($request->has('suppliers')) {
            $this->product->pushCriteria( new SuppliersOnly($request->input('suppliers')) );
        }

        $products = $this->product->bySection($currentSection->id);



        //TODO: переместить в композер инициализацию мб?
        $sections = $this->section->getTree($currentSection->id);

        $prefix = $this->product->prefix();

        return view('catalog.index', compact('products', 'sections', 'currentSection',
                                                'maxProductPrice', 'suppliers', 'prefix'));
    }

    public function ajax(Request $request){

        $prefix = $this->product->prefix();

        if ($request->has('minprice') && $request->has('maxprice')) {
            $this->product->pushCriteria( new MinMaxPrice($request->input('minprice'), $request->input('maxprice')));
        }

        if ($request->has('suppliers')) {
            $this->product->pushCriteria( new SuppliersOnly($request->input('suppliers')) );
        }
        $products = $this->product->bySection($request->input('sectionId'));
        $currentSection = $this->section->byCode($request->input('sectionId'));

        return view('catalog.ajaxindex', compact('products', 'currentSection', 'prefix'));
    }

    public function product($id){
        $product = $this->product->byId($id);
        $comments = $this->comments->getByObject($product);
        $faq = $this->faq->paginateByProductId($id);
        $favorite = $this->favorite->byProduct($id);
        $randProducts = $this->supplier->getRandList($this->product,$product);
        return view('catalog.product', compact(['product','comments','faq','favorite','randProducts']));
    }

    public function rateProduct(Request $request,RatingForm $ratingForm,$id){

        $request->merge(array('rateable_id' => $id));
        $input = removeEmptyValues($request->all());

        if ($ratingForm->rateProduct($input) ){
            $item = $this->product->byId($id);
            return response()->json(['rating' => $item['rating'], 'status' => 'OK']);
        }
        else{
            $errors = $ratingForm->errors();
            return response()->json(['errors' => $errors, 'status' => 'ERROR']);
        }


    }

    public function main(){
        return view('catalog.main');
    }
}