<?php

namespace App\Http\Controllers;

use App\Repo\Faq\FaqInterface;
use App\Services\Form\Faq\FaqForm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    protected $faq;
    protected $faqForm;

    public function __construct(FaqInterface $faq, FaqForm $faqForm){
        $this->faq = $faq;
        $this->faqForm = $faqForm;
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
}
