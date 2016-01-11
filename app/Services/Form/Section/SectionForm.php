<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 24.12.15
 * Time: 15:04
 */

namespace App\Services\Form\Section;

use App\Services\Validation\ValidableInterface;
use App\Repo\Section\SectionInterface;
use Auth;

class SectionForm
{
    protected $data;
    protected $validator;
    protected $section;

    public function __construct(ValidableInterface $validator, SectionInterface $section){
        $this->validator = $validator;
        $this->section = $section;
    }

    public function save(array $input) {

        // null можно добавлять в parent_id, пустое значение выдаст ошибку в валидаторе
        $input['parent_id'] = (!empty($input['parent_id'])) ? $input['parent_id'] : null;

        if ( ! $this->valid($input) ) return false;

        $input['user_id'] = (int) Auth::user()->id;

        return $this->section->create($input);
    }

    public function errors() {
        return $this->validator->errors();
    }

    protected function valid(array $input){
        return $this->validator->with($input)->passes();
    }
}