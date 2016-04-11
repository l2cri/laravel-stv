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
use App\Services\Form\Supplier\SupplierForm;
use App\StaticHelpers\ProductHelper;
use Illuminate\Http\Request;
use Redirect;

class SupplierController extends Controller
{
    protected $product;
    protected $section;
    protected $supplier;
    protected $form;

    public function __construct(ProductInterface $product, SectionInterface $section,
                                SupplierInterface $supplier, SupplierForm $form){
        $this->section = $section;
        $this->product = $product;
        $this->supplier = $supplier;
        $this->form = $form;
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

    public function ajax(Request $request, $name){

        $supplier = $this->supplier->byCode($name);
//        $sections = $this->section->bySupplier($supplier->id);
        if ($request->input('sectionId')) $currentSection = $this->section->byCode($request->input('sectionId'));

        // фильтр по цене
        if ($request->has('minprice') && $request->has('maxprice')) {
            $this->product->pushCriteria( new MinMaxPrice($request->input('minprice'), $request->input('maxprice')));
        }

        // назначаем поставщика всегда
        $this->product->pushCriteria( new SuppliersOnly([$supplier->id]) );

        // секции - одна или много
        if (isset($currentSection) && !empty($currentSection))
            $products = $this->product->bySection($currentSection->id, false);
        else $products = $this->product->bySupplierPaginate($supplier->id);


//        $products = $this->product->bySection($request->input('sectionId'));
//        $currentSection = $this->section->byCode($request->input('sectionId'));

        return view('catalog.ajaxindex', compact('products', 'currentSection'));
    }

    public function settings(){
        $supplier = $this->supplier->byId(supplierId());
        return view('panel.supplier.settings', compact('supplier'));
    }

    public function updateSettings(Request $request) {
        $input = removeEmptyValues($request->all());

        if ($request->hasFile('logo')) {
            $input['logo'] = $request->file('logo');
        }

        if ($this->form->update( $input ) ){
            return Redirect::to( route('panel::supplier.settings') )->with('status', 'success');
        } else {
            return Redirect::to( route('panel::supplier.settings') )->withInput()
                ->withErrors( $this->form->errors() )
                ->with('status', 'error');
        }
    }

    /**
     * Каталог поставщиков
     */
    public function suppliers($sectionCode = null) {

        $sectionsPotreb = $this->section->getTree( config('marketplace.potrebSectionId') );
        $sectionsProm = $this->section->getTree( config('marketplace.promSectionId') );

        if ($sectionCode) {
            $currentSection = $this->section->byCode($sectionCode);
            $products = $this->product->bySection($currentSection->id);
            $suppliers = $this->supplier->byProducts($products);
        } else $suppliers = $this->supplier->all();

        return view('suppliers.index', compact('suppliers', 'sectionsPotreb', 'sectionsProm', 'currentSection'));
    }
}