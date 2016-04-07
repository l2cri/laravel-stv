<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 06.04.16
 * Time: 18:16
 */

namespace App\Http\Controllers;


use App\Repo\Product\ProductInterface;
use App\Repo\Section\SectionInterface;
use App\Repo\Supplier\SupplierInterface;
use App\Repo\Criteria\Product\MinMaxPrice;
use App\Repo\Criteria\Product\SuppliersOnly;
use App\StaticHelpers\ProductHelper;

class SupplierController extends Controller
{
    protected $product;
    protected $section;
    protected $supplier;

    public function __construct(ProductInterface $product, SectionInterface $section, SupplierInterface $supplier){
        $this->section = $section;
        $this->product = $product;
        $this->supplier = $supplier;
    }

    public function catalog($name, $code = null) {

        if ($code) $currentSection = $this->section->byCode($code);

        $supplier = $this->supplier->byCode($name);
        $sections = $this->section->bySupplier($supplier->id);

        // назначаем поставщика
        $this->product->pushCriteria( new SuppliersOnly([$supplier->id]) );

        // вытаскиваем товары по категориям
        if (isset($currentSection) && !empty($currentSection)) {
            $sectionIds = [$currentSection->id];
        } else $sectionIds = $sections->lists('id')->all();
        $products = $this->product->bySectionIds( $sectionIds );

        $maxProductPrice = ProductHelper::maxProductPrice($this->product->allProductsFromLastRequest());

        return view('supplier.index', compact('products', 'sections', 'currentSection',
            'maxProductPrice', 'supplier'));
    }
}