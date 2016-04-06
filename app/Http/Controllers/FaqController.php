<?php

namespace App\Http\Controllers;

use App\DataTables\FaqProductsDataTable;
use App\Repo\Faq\FaqInterface;
use App\Services\Form\Faq\FaqForm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class FaqController extends Controller
{
    protected $faq;
    protected $faqForm;
    protected $supplier;

    public function __construct(FaqInterface $faq, FaqForm $faqForm){
        $this->faq = $faq;
        $this->faqForm = $faqForm;
        $this->supplier = supplierId();
    }

    public function paginator($id){

        $items = $this->faq->paginateByProductId($id);

        return view('faq.list', compact('items','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //
        $errors = '';

        $request->merge(array('product_id' => $id));
        $input = removeEmptyValues($request->all());

        if ($this->faqForm->save($input) ){
            $status = 'success';
        } else {
            $status = 'error';
            $errors = $this->faqForm->errors();
        }

        $items = $this->faq->paginateByProductId($id);

        return view('faq.list',compact('items','id','status','errors'));
    }

    public function getBySupplier(FaqProductsDataTable $dataTable){

        return $dataTable->render('panel.supplier.faq.datatablesfaq');
    }

    public function edit($id){
        $faq = $this->faq->getForEdit($id,$this->supplier);

        return view('panel.supplier.faq.edit', compact('id','faq'));
    }

    public function delete($id){
        $this->faq->deleteSupplier($id,$this->supplier);
        return redirect()->back();
    }

    public function update(Request $request,$id){
        $faq = $this->faq->getForEdit($id,$this->supplier);

        if ($this->faqForm->update($request,$id,$faq) ){
            return Redirect::to( route('panel::faq.list') )->with('status', 'success');
        } else {
            return Redirect::to( route('panel::faq.edit',['id'=>$id]) )->withInput()
                ->withErrors( $this->faqForm->errors() )
                ->with('status', 'error');
        }
    }
}
