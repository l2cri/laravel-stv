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

        if ( ! $this->valid($input) ) return false;

        var_dump(Auth::user()); die();

        // TODO: откуда брать user_id и где его правильно добавить в массив данных

        return $this->section->create($input);
    }

    public function errors() {
        return $this->validator->errors();
    }

    protected function valid(array $input){
        return $this->validator->with($input)->passes();
    }
}