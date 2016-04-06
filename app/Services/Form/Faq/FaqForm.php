<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 05.04.16
 * Time: 18:07
 */

namespace App\Services\Form\Faq;


use App\Repo\Faq\FaqInterface;
use App\Services\Form\FormTrait;
use App\Services\Validation\ValidableInterface;
use Auth;

class FaqForm
{
    use FormTrait;

    protected $data;
    protected $validator;
    protected $faq;

    public function __construct(ValidableInterface $validator,FaqInterface $faq){
        $this->validator = $validator;
        $this->faq = $faq;
    }

    public function save(array $input) {

        $input['user_id'] = (int) Auth::user()->id;

        if ( ! $this->valid($input) ) return false;

        return $this->faq->create($input);
    }

    public function update($request,$id,$old){

        $request->merge([
            'id' => $id,'product_id' => $old->product->id,'user_id' => $old->user->id ,
            'question' => $old->question, 'moderated' => ($request->get('moderated') ==1)?1:0
        ]);

        $input = removeEmptyValues($request->except('_method', '_token'));

        if ( ! $this->valid($input) ) return false;

        return $this->faq->update($input,$id);
    }
}
