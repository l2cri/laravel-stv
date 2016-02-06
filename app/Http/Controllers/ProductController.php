<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 20.01.16
 * Time: 20:16
 */

namespace App\Http\Controllers;

use App\Repo\Product\ProductInterface;
use App\Repo\Section\SectionInterface;
use App\Services\Form\Product\ProductForm;
use Input;
use Redirect;
use Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    protected $section;
    protected $form;

    public function __construct(ProductInterface $product, SectionInterface $section, ProductForm $form){
        $this->product = $product;
        $this->section = $section;
        $this->form = $form;
    }

    /*
     * GET /panel/supplier/products/add - форма для добавления товара
     */
    public function addform(){
        $sectionTree = $this->section->getTree();
        return view('panel.supplier.products.addform', compact('sectionTree'));
    }

    /*
     * POST panel/supplier/products/add - создать новую категорию
     */
    public function store(Request $request){

        $input = removeEmptyValues($request->all());
        if ($request->hasFile('photos')) {
            $input['photos'] = $request->file('photos');
        }

        //if ($this->form->save( $input ) ){
        if ($this->form->save( $input ) ){
            return Redirect::to( route('panel::products') )->with('status', 'success');
        } else {
            return Redirect::to( route('panel::products.addform') )->withInput()
                ->withErrors( $this->form->errors() )
                ->with('status', 'error');
        }

    }
}