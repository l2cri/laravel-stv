<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 28.11.15
 * Time: 0:04
 */

namespace App\Services\Validation;

use Illuminate\Validation\Factory as Validator;

class AbstractLaravelValidator implements ValidableInterface
{
    /**
     * @var \Illuminate\Validation\Factory
     */
    protected $validator;

    protected $data = array();
    protected $errors = array();
    protected $rules = array();
    protected $messages = array();

    public function __construct(Validator $validator) {
        $this->validator = $validator;
    }

    public function with(array $data) {
        $this->data = $data;
        return $this;
    }

    public function passes() {
        $validator = $this->validator->make(
            $this->data,
            $this->rules,
            $this->messages
        );

        if( $validator->fails() ) {
            $this->errors = $validator->messages();
            return false;
        }

       return true;
    }

    public function errors() {
        return $this->errors;
    }
}