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

class ProductController extends Controller
{
    protected $product;
    protected $section;

    public function __construct(ProductInterface $product, SectionInterface $section){
        $this->product = $product;
        $this->section = $section;
    }

    /*
     * GET /panel/supplier/products/add - форма для добавления товара
     */
    public function addform(){
        $sectionTree = $this->section->getTree();
        return view('panel.supplier.products.addform', compact('sectionTree'));
    }
}