<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 09.04.16
 * Time: 16:36
 */

namespace App\Services\Form\Company;


use App\Repo\Company\CompanyInterface;
use App\Services\Validation\AbstractLaravelValidator;

class CompanyForm
{
    protected $validator;
    protected $company;

    public function __construct(AbstractLaravelValidator $validator, CompanyInterface $company) {
        $this->validator = $validator;
        $this->company = $company;
    }

    public function save(array $data){
        if ( ! $this->valid($data) ) return false;
    }

    public function update(array $data){
        if ( ! $this->valid($data) ) return false;
    }

    public function bindProfile(array $data){
        if ( ! $this->valid($data) ) return false;
    }
    public function unbindProfile(array $data){
        if ( ! $this->valid($data) ) return false;
    }

    public function bindSupplier(array $data){
        if ( ! $this->valid($data) ) return false;
    }
    public function unbindSupplier(array $data){
        if ( ! $this->valid($data) ) return false;
    }

}