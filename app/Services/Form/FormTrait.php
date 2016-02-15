<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.02.16
 * Time: 20:20
 */

namespace App\Services\Form;


trait FormTrait
{
    public function errors() {
        return $this->validator->errors();
    }

    protected function valid(array $input){
        return $this->validator->with($input)->passes();
    }
}